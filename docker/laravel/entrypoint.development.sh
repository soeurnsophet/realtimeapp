#!/bin/bash
set -e

composer install
wait $!
npm install
wait $!
php artisan key:generate
wait $!
php artisan migrate
wait $!
# php artisan storage:link

echo "Starting Queue Worker..."
php artisan queue:work --sleep=3 --tries=3 &

# Start Reverb WebSocket server in background
php artisan reverb:start --host=0.0.0.0 --port=8080 &

# Start Laravel development server
php artisan serve --host=0.0.0.0 --port=8000