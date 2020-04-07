#!/bin/bash

docker-compose --file=../../plugins/material-theme-builder/docker-compose.yml run --rm -u 1000 --workdir=/var/www/md/wp-content/themes/material-theme phpfpm -- composer test
