#!/bin/bash
# Copyright 2020 Google LLC
#
# Licensed under the Apache License, Version 2.0 (the "License");
# you may not use this file except in compliance with the License.
# You may obtain a copy of the License at
#
#      http://www.apache.org/licenses/LICENSE-2.0
#
# Unless required by applicable law or agreed to in writing, software
# distributed under the License is distributed on an "AS IS" BASIS,
# WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
# See the License for the specific language governing permissions and
# limitations under the License.


source .env
source ./bin/includes.sh

if [[ -z "$(grep DOCKER_COMPOSE_PATH .env)" ]]; then
	CONTAINER=''
	DOCKER_CONTAINERS=($(docker ps --format '{{.Names}}:{{.ID}}'))
	for container in ${DOCKER_CONTAINERS[@]}:
	do
		if [[ "$container" == "material-design"* ]]; then
			CONTAINER="$(cut -d':' -f2 <<< $container)"
			break
		fi
	done

	if [[ ! -z "$CONTAINER" ]]; then
		DC_PLUGIN_PATH=$(docker inspect --format '{{ json .Config.Labels }}' $CONTAINER | grep -E -o '"com.docker.compose.project.working_dir":"([^"]+)"')
		if [[ ! -z "$DC_PLUGIN_PATH" ]]; then
			DC_PLUGIN_PATH=${DC_PLUGIN_PATH//'"com.docker.compose.project.working_dir":'/}
			DC_PLUGIN_PATH=${DC_PLUGIN_PATH//'"'/}
			DC_PLUGIN_PATH=$( echo "$DC_PLUGIN_PATH/docker-compose.yml" | sed 's/ /\\ /g' )

			echo "The $(action_format "docker-compose.yml") file for the Material Design plugin was found at:"
			echo "$(action_format "$DC_PLUGIN_PATH")"
			echo "Updating the $(action_format ".env") file to use the development environment from the plugin."
			echo ""
			echo "$(warning_message "Make sure you stop the running Docker environment for the plugin before starting this theme environment.")"
			echo "DOCKER_COMPOSE_PATH=$DC_PLUGIN_PATH" >> '.env'
			echo ""
		fi
	else
		echo "The $(action_format "docker-compose.yml") file for the Material Design plugin was not found."
		echo "The Docker containers for the plugin must be running for this script to work properly."
		echo "You may need to setup and/or start the plugin Docker environment before running this script again."
		echo ""
	fi
else
	echo "The $(action_format ".env") has already been updated."
	echo "Remove $(action_format "DOCKER_COMPOSE_PATH") from the $(action_format ".env") file and run this script again to update the path."
	echo ""
fi
