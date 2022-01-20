#!/bin/bash

. $(dirname ${BASH_SOURCE[0]})/../.env
. $(dirname ${BASH_SOURCE[0]})/../.env.local

echo -e "${LIGHT_GREEN}Start updating...${NC}"

${SCRIPT_PATH}/tasks/database_backup.sh

. ${SCRIPT_PATH}/tasks/composer_install.sh

. ${SCRIPT_PATH}/tasks/npm_install.sh

. ${SCRIPT_PATH}/tasks/clear_cache.sh

. ${SCRIPT_PATH}/tasks/migrate.sh

. ${SCRIPT_PATH}/tasks/clear_cache.sh
