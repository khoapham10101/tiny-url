#!/bin/bash

. $(dirname ${BASH_SOURCE[0]})/../../.env
. $(dirname ${BASH_SOURCE[0]})/../../.env.local

echo -e "${LIGHT_GREEN}Composer install.${NC}"
if [ "${APP_ENV}" = "dev" ]; then
    composer install
else
    composer install --no-dev --prefer-dist --optimize-autoloader
fi
