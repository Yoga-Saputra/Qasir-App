cd /var/www/Qasir-App
git pull origin master
composer install -q --no-ansi --no-interaction --no-scripts --no-progress --prefer-dist
php artisan config:cache
php artisan config:clear
ls -lah
sudo chown -R www-data.www-data /var/www/Qasir-App/storage
chown -R www-data.www-data /var/www/Qasir-App/bootstrap/cache
