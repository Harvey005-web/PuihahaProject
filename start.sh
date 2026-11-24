#!/bin/sh
set -eu
if [ "${RUN_INITIAL_MIGRATIONS:-false}" = "true" ]; then
    php artisan migrate --force
fi
exec frankenphp run --config /etc/caddy/Caddyfile
