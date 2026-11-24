FROM node:24-alpine AS assets
WORKDIR /src
COPY package*.json ./
RUN npm ci
COPY . .
RUN npm run build

FROM dunglas/frankenphp:1-php8.4-alpine
WORKDIR /app
RUN install-php-extensions pdo_mysql mbstring intl zip bcmath opcache pcntl
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer
ENV COMPOSER_ALLOW_SUPERUSER=1
COPY . .
RUN composer install --no-dev --no-interaction --prefer-dist --optimize-autoloader --no-scripts
COPY --from=assets /src/public/build ./public/build
RUN mkdir -p storage/framework/cache/data storage/framework/sessions storage/framework/views storage/logs bootstrap/cache \
    && find /app/bootstrap/cache -maxdepth 1 -type f -name '*.php' -delete \
    && php artisan package:discover --ansi
COPY Caddyfile /etc/caddy/Caddyfile
ENV PORT=80
CMD ["sh", "/app/start.sh"]
