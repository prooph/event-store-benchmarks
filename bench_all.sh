#!/bin/bash -ex

declare -a arr=("arangodb" "postgres" "mariadb" "mysql")
arr=( $(shuf -e "${arr[@]}") )

for i in "${arr[@]}"
do
   bash bench.sh --driver ${i}
done
