FROM ubuntu:20.04

ENV DEBIAN_FRONTEND=noninteractive
ENV TZ=Europe/London

WORKDIR /app

# Install all requirements
RUN apt -y update --fix-missing
RUN apt -y upgrade
RUN apt -y install build-essential wget nginx php-fpm \
                   php-bcmath php-bz2 php-calendar \
                   php-curl php-intl php-json php-imagick \
                   php-xml php-zip composer git \
                   nodejs npm ghostscript imagemagick

# Move our application into the container
COPY application/ /app
COPY nginx.conf /etc/nginx/sites-available/default
COPY policy.xml /etc/ImageMagick-6/policy.xml

# Install our application dependencies
RUN cd /app
RUN composer install
RUN npm install
RUN npm run development

# Add the entryscript to fire up Nginx and PHP-FPM
COPY docker-entrypoint.sh /etc/docker-entrypoint.sh

# Add Chrome for smoke testing
RUN wget https://dl.google.com/linux/direct/google-chrome-stable_current_amd64.deb
RUN apt -y install ./google-chrome-stable_current_amd64.deb
RUN rm ./google-chrome-stable_current_amd64.deb

# Bit of a clean up
RUN apt -y remove build-essential wget nodejs npm
RUN apt -y autoremove
RUN rm -rf /var/lib/apt/lists/*

# Set basic permissions
RUN chmod -R 777 /app/public
RUN chmod -R 777 /app/storage

# Expose our HTTP port to the Host
EXPOSE 80

# Fire up the entrypoint script
CMD ["/etc/docker-entrypoint.sh"]
