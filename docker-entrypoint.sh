#!/bin/bash

until mysqladmin ping -h"db" --silent; do
  echo 'Aguardando o serviço de banco de dados...'
  sleep 1
done

php artisan migrate --force

exec "$@"
