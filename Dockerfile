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

# Copia o script de entrada
COPY docker-entrypoint.sh /usr/local/bin/

# Garante que o script de entrada seja executável
RUN chmod +x /usr/local/bin/docker-entrypoint.sh

WORKDIR /var/www/html

# Copia o código da aplicação
COPY . .

# Instalação das dependências PHP
RUN composer install --no-interaction

# Instalação das dependências do frontend
RUN npm install

# Compilação dos assets
RUN npm run build

# Geração da chave de aplicação Laravel
RUN php artisan key:generate

# Define o script de entrada como ponto de entrada do contêiner
ENTRYPOINT ["/usr/local/bin/docker-entrypoint.sh"]

# Comando padrão
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]
