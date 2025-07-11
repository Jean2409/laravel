#!/usr/bin/env bash

composer install
php artisan config:clear
php artisan cache:clear
php artisan migrate --force
