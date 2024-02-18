#!/bin/bash

until mysqladmin ping -h"db" --silent; do
  echo 'Aguardando o serviço de banco de dados...'
  sleep 1
done

# Movendo para o diretório do código da aplicação Laravel
cd /var/www/html

# Executando as migrações do Laravel
php artisan migrate --force

# Iniciando o servidor web
php artisan serve --host=0.0.0.0 --port=8000 &

# Rodando o schedule:work
php artisan schedule:work

exec "$@"
