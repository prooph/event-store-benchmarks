#!/bin/bash -ex

GREEN=`tput setaf 2`
RESET=`tput sgr0`

USAGE="Usage: ${BASH_SOURCE[0]} --driver [arangodb | postgres | mysql | mariadb]"

IDLE_TIME=20
PARAMETERS=
DRIVER=
COMPOSE_FILES=

while [[ ${1} ]]; do
    case "${1}" in
        --driver)
            DRIVER=${2}
            shift
            ;;
        *)
            echo ${USAGE} >&2
            return 1
    esac

    if ! shift; then
        echo "Missing parameter argument. $USAGE" >&2
        return 1
    fi
done

if [[ -z ${DRIVER} ]]; then
    echo ${USAGE} >&2
    return 1
fi

CPU=$[`grep -c ^processor /proc/cpuinfo`/2]
#MEM=$[`grep -E 'MemAvailable' /proc/meminfo | rev | cut -d " " -f 2 | rev`/1024/2-500]
MEM=$[`grep -E 'MemAvailable' /proc/meminfo | rev | cut -d " " -f 2 | rev`/1024-800]
PHP_CPU=
DB_CPU=

COUNTER=0
while [  $COUNTER -lt ${CPU} ]; do
    if [ $COUNTER -ne 0 ]; then
        PHP_CPU=${PHP_CPU},
        DB_CPU=${DB_CPU},
    fi

    PHP_CPU=${PHP_CPU}$[COUNTER*2]
    DB_CPU=${DB_CPU}$[COUNTER*2+1]
    let COUNTER=COUNTER+1
done

cp docker-compose-${DRIVER}.yml docker-compose.yml
sed -i "s/#cpuset: phpcpuset/cpuset: ${PHP_CPU}/g" docker-compose.yml
sed -i "s/#cpu_count: phpcpu_count/cpu_count: ${CPU}/g" docker-compose.yml
sed -i "s/#mem_limit: phpmem_limit/mem_limit: 512M/g" docker-compose.yml
sed -i "s/#mem_reservation: phpmem_reservation/mem_reservation: 512M/g" docker-compose.yml

sed -i "s/#cpuset: dbcpuset/cpuset: ${DB_CPU}/g" docker-compose.yml
sed -i "s/#cpu_count: dbcpu_count/cpu_count: ${CPU}/g" docker-compose.yml
sed -i "s/#mem_limit: dbmem_limit/mem_limit: ${MEM}M/g" docker-compose.yml
sed -i "s/#mem_reservation: dbmem_reservation/mem_reservation: ${MEM}M/g" docker-compose.yml

docker-compose up -d --no-recreate
docker-compose ps

echo ""
echo "${GREEN}Docker Info${RESET}"
docker info

echo ""
echo "${GREEN}Hardware Info${RESET}"
lscpu

echo "${GREEN}Using ${CPU} CPUs for each service and ${MEM} MB memory for database.${RESET}"

echo "${GREEN}Waiting for ${DRIVER} database, lean back to enjoy the timer.${RESET}"
until [ $IDLE_TIME -lt 1 ]; do
    let IDLE_TIME-=1
    printf "${IDLE_TIME} "
    sleep 1
done

echo ""
echo "${GREEN}Starting benchmark warmup ${DRIVER}!${RESET}"
docker-compose run --rm php php src/benchmark.php

echo ""
echo "${GREEN}Starting benchmark ${DRIVER}!${RESET}"

docker-compose run --rm php php src/benchmark.php

echo ""
echo "${GREEN}Dumping logs ${DRIVER}!${RESET}"
docker-compose logs

docker-compose down -v
