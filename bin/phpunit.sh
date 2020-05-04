#!/bin/bash
shopt -s expand_aliases

source ./bin/includes.sh

docker-compose run --rm -u 1000 --workdir=/var/www/html/wp-content/themes/material-theme wordpress -- composer test
