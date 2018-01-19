#!/bin/bash -ex

GREEN=`tput setaf 2`
RESET=`tput sgr0`

declare -a arr=("arangodb" "postgres" "mariadb" "mysql")
arr=( $(shuf -e "${arr[@]}") )

echo ""
printf "${GREEN}Testing databases are ${RESET}"
for i in "${arr[@]}"
do
   printf  ${i}
   printf " "
done

echo ""
sleep 2;

for i in "${arr[@]}"
do
   bash bench_docker.sh --driver ${i}
done
