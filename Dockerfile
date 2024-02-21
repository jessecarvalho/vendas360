FROM php:8.3-fpm

# Instalação do cliente MySQL
RUN apt-get update && \
    apt-get install -y \
        git \
        zip \
        unzip \
        libpng-dev \
        libjpeg-dev \
        libfreetype6-dev \
        default-mysql-client && \
    docker-php-ext-configure gd --with-freetype --with-jpeg && \
    docker-php-ext-install gd pdo pdo_mysql && \
    apt-get clean && \
    rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*

# Install Node.js and npm
RUN curl -sL https://deb.nodesource.com/setup_21.x | bash - && \
    apt-get install -y nodejs

# Instalação do Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Configuração do driver de log
RUN mkdir -p /etc/docker && echo '{ "log-driver": "json-file" }' > /etc/docker/daemon.json

WORKDIR /var/www/html

# Copia o código da aplicação
COPY . .

RUN mv .env.production .env

# Instalação das dependências PHP
RUN composer install --no-interaction

# Instalação das dependências do frontend
RUN npm install

# Compilação dos assets
RUN npm run build

# Geração da chave de aplicação Laravel
RUN php artisan key:generate

EXPOSE 8000

CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]

