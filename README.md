docker-compose up -d --build
docker exec -it php_logistic /bin/sh
php artisan config:cache
php artisan route:cache
php artisan migrate
php artisan db:seed
