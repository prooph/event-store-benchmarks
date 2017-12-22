#!/usr/bin/env sh

USAGE="Usage: bench.sh --driver [arangodb | postgres | mysql | mariadb]"

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

echo ""
echo "Starting benchmark ${DRIVER}!"
php src/prepare.php
php src/benchmark.php
php src/cleanup.php

echo ""
echo "Starting real world benchmark ${DRIVER}!"

#real world test
php src/prepare.php

WRITER_COUNTER=0
WRITER_ITERATIONS=10

start=$(date +%s)

while [  ${WRITER_COUNTER} -lt ${WRITER_ITERATIONS} ]; do
    for type in user post todo blog comment
    do
        php src/writer.php writer${WRITER_COUNTER} ${type} >logs/writer${WRITER_COUNTER}${type}.log &
    done
    WRITER_COUNTER=$((WRITER_COUNTER + 1))
done

for type in user post todo blog comment all
do
    php src/projector.php projectors${type} ${type} >logs/projector${type}.log &
done

echo "Waiting ... stay patient!"
wait

end=$(date +%s)

WRITER_COUNTER=0
while [  ${WRITER_COUNTER} -lt ${WRITER_ITERATIONS} ]; do
    for type in user post todo blog comment
    do
        cat logs/writer${WRITER_COUNTER}${type}.log
    done

    WRITER_COUNTER=$((WRITER_COUNTER + 1))
done

for type in user post todo blog comment all
do
   cat logs/projector${type}.log
done

echo ""
duration=$((end - start))
printf "%s real world test duration %s seconds\\n" "${DRIVER}" "${duration}";

avgWriters=$((12500 / (end - start) ))
printf "%s avg writes %s events/second\\n" "${DRIVER}" "${avgWriters}";

avgReaders=$((25000 / (end - start) ))
printf "%s avg reads %s events/second\\n" "${DRIVER}" "${avgReaders}";
