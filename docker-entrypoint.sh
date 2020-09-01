#!/bin/sh

echo "Container IP Address: `awk 'END{print $1}' /etc/hosts`"

#echo "Starting Nginx Service"
#service nginx start
#echo "Started Nginx Service"

echo "Starting PHP-FPM Service"
service php7.4-fpm start
echo "Started PHP-FPM Service"


nginx -g "daemon off;"
