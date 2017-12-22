#!/usr/bin/env sh

echo ""
printf "Testing databases are "

for i in arangodb postgres mariadb mysql
do
   printf  "%s " "${i}"
done

echo ""
sleep 2;

for i in arangodb postgres mariadb mysql
do
   ./bench.sh --driver ${i}
done
