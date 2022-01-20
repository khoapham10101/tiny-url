#!/bin/bash

. $(dirname ${BASH_SOURCE[0]})/../../.env
. $(dirname ${BASH_SOURCE[0]})/../../.env.local

echo -e "${LIGHT_GREEN}Run Laravel Default Artisan commands.${NC}"
php artisan package:discover --ansi
php artisan vendor:publish --tag=laravel-assets --ansi --force
php -r \"file_exists('.env') || copy('.env.example', '.env');\"
php artisan key:generate --ansi

echo -e "${LIGHT_GREEN}Run Laravel Migration.${NC}"
php artisan migrate
