#!/bin/bash

shopt -s expand_aliases
source .env

if [ -z "$(grep DOCKER_COMPOSE_PATH .env)" ]; then
	CONTAINER=''
	DOCKER_CONTAINERS=($(docker ps --format '{{.Names}}:{{.ID}}'))
	for container in ${DOCKER_CONTAINERS[@]}:
	do
		if [[ "$container" == "material-theme-builder"* ]]; then
			CONTAINER="$(cut -d':' -f2 <<< $container)"
			break
		fi
	done

	if [ ! -z "$CONTAINER" ]
	then
		DC_PLUGIN_PATH=$(docker inspect --format '{{ json .Config.Labels }}' $CONTAINER | grep -E -o '"com.docker.compose.project.working_dir":"([^"]+)"')
		if [ ! -z "$DC_PLUGIN_PATH" ]; then
			DC_PLUGIN_PATH=${DC_PLUGIN_PATH//'"com.docker.compose.project.working_dir":'/}
			DC_PLUGIN_PATH=${DC_PLUGIN_PATH//'"'/}
			DC_PLUGIN_PATH="$DC_PLUGIN_PATH/docker-compose.yml"

			echo "Found plugin docker-compose.yml file at $DC_PLUGIN_PATH"
			echo "Adding DOCKER_COMPOSE_PATH to .env file"
			echo "DOCKER_COMPOSE_PATH=$DC_PLUGIN_PATH" >> '.env'

			source .env
		fi
	fi
fi

if [[ ! -z "${DOCKER_COMPOSE_PATH}" ]]; then
	alias docker-compose="docker-compose --file=$DOCKER_COMPOSE_PATH --file=docker-compose-plugin-dev.yml"
fi

##
# WordPress helper
#
# Executes a request in the WordPress container.
#
# @param {string} host The host to check.
#
# @return {bool} Whether the host exists or not.
##
function is_wp_available() {
	RESULT=`curl -w "%{http_code}" -o /dev/null -s $1`

	if test "$RESULT" -ge 200 && test "$RESULT" -le 302; then
		return 0
	else
		return 1
	fi
}

##
# Check if the command exists as some sort of executable.
#
# The executable form of the command could be an alias, function, builtin, executable file or shell keyword.
#
# @param {string} command The command to check.
#
# @return {bool} Whether the command exists or not.
##
command_exists() {
	type -t "$1" >/dev/null 2>&1
}

##
# Add error message formatting to a string, and echo it.
#
# @param {string} message The string to add formatting to.
##
error_message() {
	echo -en "\033[31mERROR\033[0m: $1"
}

##
# Add warning message formatting to a string, and echo it.
#
# @param {string} message The string to add formatting to.
##
warning_message() {
	echo -en "\033[33mWARNING\033[0m: $1"
}

##
# Add formatting to an action string.
#
# @param {string} message The string to add formatting to.
##
action_format() {
	echo -en "\033[32m$1\033[0m"
}
