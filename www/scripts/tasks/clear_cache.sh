#!/bin/bash

. $(dirname ${BASH_SOURCE[0]})/../../.env
. $(dirname ${BASH_SOURCE[0]})/../../.env.local

echo -e "${LIGHT_GREEN}Clear cache.${NC}"
php artisan cache:clear
