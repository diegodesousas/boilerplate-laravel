#!/bin/bash

git pull origin master
composer install
php artisan migrate

# keep running
while :; do
  sleep 300
done
