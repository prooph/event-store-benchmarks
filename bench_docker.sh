#!/usr/bin/env sh

USAGE="Usage: bench_docker.sh --driver [arangodb | postgres | mysql | mariadb]"

IDLE_TIME=20
DRIVER=

while [ "${1}" ]; do
    case "${1}" in
        --driver)
            DRIVER=${2}
            shift
            ;;
        *)
            echo "${USAGE}" >&2
            return 1
    esac

    if ! shift; then
        echo "Missing parameter argument. $USAGE" >&2
        return 1
    fi
done

if [ -z "${DRIVER}" ]; then
    echo "${USAGE}" >&2
    return 1
fi

CPU=$(($(grep -c ^processor /proc/cpuinfo) / 2))
MEM=$( (grep -E 'MemAvailable' /proc/meminfo) | (rev) | (cut -d " " -f 2) | (rev) )
MEM=$((MEM / 1024 - 1024))
BUFFER_POOL_SIZE=$((MEM * 70 / 100))
PHP_CPU=
DB_CPU=

COUNTER=0
while [  $COUNTER -lt ${CPU} ]; do
    if [ $COUNTER -ne 0 ]; then
        PHP_CPU=${PHP_CPU}","
        DB_CPU=${DB_CPU}","
    fi

    PHP_CPU=${PHP_CPU}$((COUNTER * 2))
    DB_CPU=${DB_CPU}$((COUNTER * 2 + 1))
    COUNTER=$((COUNTER + 1))
done

cp docker-compose-"${DRIVER}".yml docker-compose.yml
sed -i "s/#cpuset: phpcpuset/cpuset: ${PHP_CPU}/g" docker-compose.yml
sed -i "s/#cpu_count: phpcpu_count/cpu_count: ${CPU}/g" docker-compose.yml
sed -i "s/#mem_limit: phpmem_limit/mem_limit: 768M/g" docker-compose.yml
sed -i "s/#mem_reservation: phpmem_reservation/mem_reservation: 768M/g" docker-compose.yml

sed -i "s/#cpuset: dbcpuset/cpuset: ${DB_CPU}/g" docker-compose.yml
sed -i "s/#cpu_count: dbcpu_count/cpu_count: ${CPU}/g" docker-compose.yml
sed -i "s/#mem_limit: dbmem_limit/mem_limit: ${MEM}M/g" docker-compose.yml
sed -i "s/#mem_reservation: dbmem_reservation/mem_reservation: ${MEM}M/g" docker-compose.yml

sed -i "s/BUFFER_POOL_SIZE/${BUFFER_POOL_SIZE}M/g" docker-compose.yml

docker-compose up -d --no-recreate database
docker-compose ps

echo ""
echo ""
echo "Docker Info"
docker info

echo ""
echo ""
echo "Hardware Info"
lscpu

echo ""
echo ""
echo "Using ${CPU} CPUs for each service and ${MEM} MB memory for database."

echo "Waiting for ${DRIVER} database, lean back to enjoy the timer."
until [ $IDLE_TIME -lt 1 ]; do

    IDLE_TIME=$((IDLE_TIME - 1))
    printf "%s " "${IDLE_TIME}"
    sleep 1
done
docker-compose run --rm --entrypoint=sh php ./bench.sh --driver "${DRIVER}"

echo ""
echo "Dumping logs ${DRIVER}!"
docker-compose logs

docker-compose down -v
