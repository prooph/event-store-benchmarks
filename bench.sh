#!/usr/bin/env sh

USAGE="Usage: bench.sh --driver [arangodb | postgres | mysql | mariadb] [--strategy Single | Simple | Aggregate]"

DRIVER=
STREAM_STRATEGY=

while [ ${1} ]; do
    case "${1}" in
        --driver)
            DRIVER=${2}
            shift
            ;;
        --strategy)
            STRATEGY=${2}
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

if [ -z "${STRATEGY}" ]; then
    STRATEGY=Aggregate
fi


export DRIVER=${DRIVER}
export STREAM_STRATEGY=${STRATEGY}

echo ""
php -v

echo "Starting benchmark ${DRIVER}!"
php src/prepare.php
php src/benchmark.php
php src/cleanup.php

echo ""
echo "Starting real world benchmark ${DRIVER} with strategy ${STRATEGY}!"

#real world test
php src/prepare.php

WRITER_COUNTER=0
WRITER_ITERATIONS=10

read up rest </proc/uptime;
start=${up%.*}${up#*.}

while [  ${WRITER_COUNTER} -lt ${WRITER_ITERATIONS} ]; do
    for type in user post todo blog comment
    do
        php src/writer.php writer${WRITER_COUNTER} ${type} | tee logs/writer${WRITER_COUNTER}${type}.log &
    done
    WRITER_COUNTER=$((WRITER_COUNTER + 1))
done

for type in user post todo blog comment all
do
    php src/projector.php projectors${type} ${type} | tee logs/projector${type}.log &
done

echo "Waiting ... stay patient!"
wait

read up rest </proc/uptime;
end=${up%.*}${up#*.}

echo ""
# it's in ms
duration=$((10*(end - start)))

duration=$(printf ${duration} | awk '{ printf("%.08f\n", $1/1000.0) }' )
printf "%s real world test duration %s seconds\\n" "${DRIVER} - ${STRATEGY}" "${duration}";

avgWriters=$(printf ${duration} | awk '{ printf("%.08f\n", 12500/$1) }' )
printf "%s avg writes %s events/second\\n" "${DRIVER} - ${STRATEGY}" "${avgWriters}";

avgReaders=$(printf ${duration} | awk '{ printf("%.08f\n", 15000/$1) }' )
printf "%s avg reads %s events/second\\n" "${DRIVER} - ${STRATEGY}" "${avgReaders}";
