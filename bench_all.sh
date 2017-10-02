#!/bin/bash -ex

declare -a arr=("arangodb" "postgres" "mariadb" "mysql")

for i in "${arr[@]}"
do
   bash bench.sh --driver ${i}
done
