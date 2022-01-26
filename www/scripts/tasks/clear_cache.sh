#!/bin/bash

. $(dirname ${BASH_SOURCE[0]})/../../.env
. $(dirname ${BASH_SOURCE[0]})/../../.env.local

echo -e "${LIGHT_GREEN}Clear cache.${NC}"
php artisan cache:clear

if [ "${APP_ENV}" = "dev" ]; then
    # Will do something else
else
    # Optimizing Configuration Loading
    php artisan config:cache

    # Optimizing Route Loading
    php artisan route:cache

    # Optimizing View Loading
    php artisan view:cache
fi
