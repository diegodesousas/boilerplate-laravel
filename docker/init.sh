#!/bin/bash

git pull origin master
composer install
php artisan migrate
service php7.0-fpm start
service nginx start

# keep running
while :; do
  php artisan inspire
  sleep 300
done
