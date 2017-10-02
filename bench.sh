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

COMPOSE_FILES=docker-compose-${DRIVER}.yml

# Docker Compose
export COMPOSE_PROJECT_NAME=proophbenchmark
export COMPOSE_FILE=${COMPOSE_FILES}

echo "Using $COMPOSE_FILE"

docker-compose up -d --no-recreate
docker-compose ps

echo "${GREEN}Waiting for ${DRIVER} database, lean back to enjoy the timer.${RESET}"
until [ $IDLE_TIME -lt 1 ]; do
    let IDLE_TIME-=1
    printf "${IDLE_TIME} "
    sleep 1
done

echo ""
echo "${GREEN}Starting benchmark ${DRIVER}!${RESET}"

docker-compose run --rm php php src/benchmark.php
docker-compose down
