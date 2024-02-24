#!/bin/bash

until mysqladmin ping -h"db" --silent; do
  echo 'Aguardando o serviço de banco de dados...'
  sleep 1
done

php artisan migrate --force

# Roda o php artisan serve em segundo plano
php artisan serve --host=0.0.0.0 --port=8000 &

# Roda o schedule:work
php artisan schedule:work

exec "$@"
