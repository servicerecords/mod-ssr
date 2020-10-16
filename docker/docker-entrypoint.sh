#!/bin/sh

echo "Container IP Address: `awk 'END{print $1}' /etc/hosts`"

echo "Starting PHP-FPM Service"
service php7.3-fpm start
echo "Started PHP-FPM Service"

chmod 777 /run/php/php*.sock

nginx -g "daemon off;"
