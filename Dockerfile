# FROM ubuntu:20.04
FROM nginx:latest

ENV DEBIAN_FRONTEND=noninteractive
ENV TZ=Europe/London

WORKDIR /app

# Install all requirements
RUN apt update
RUN apt -y upgrade
RUN apt -y --no-install-recommends install unzip \
                   php-fpm php-bcmath php-bz2 php-calendar \
                   php-curl php-intl php-json php-imagick wget \
                   php-xml php-zip composer ghostscript imagemagick

RUN curl -sL https://deb.nodesource.com/setup_12.x -o nodesource_setup.sh
RUN bash nodesource_setup.sh
RUN rm nodesource_setup.sh
RUN apt -y  --no-install-recommends install nodejs yarn

# Move our application into the container
COPY application/ /app
# COPY nginx.conf /etc/nginx/sites-available/default
COPY ./docker/nginx.conf /etc/nginx/conf.d/default.conf
COPY ./docker/policy.xml /etc/ImageMagick-6/policy.xml

# Install our application dependencies
RUN cd /app
RUN composer install
RUN npm install
RUN npm run development

# Add the entryscript to fire up Nginx and PHP-FPM
COPY ./docker/docker-entrypoint.sh /usr/local/bin/docker-entrypoint.sh
COPY ./docker/docker-entrypoint.sh /etc/entrypoint.sh

# Add Chrome for smoke testing
RUN wget https://dl.google.com/linux/direct/google-chrome-stable_current_amd64.deb
RUN apt -y install ./google-chrome-stable_current_amd64.deb
RUN rm google-chrome-stable_current_amd64.deb
RUN chmod 755 /usr/local/bin/docker-entrypoint.sh
RUN chmod 755 /etc/entrypoint.sh

# Bit of a clean up
RUN apt -y remove build-essential wget && rm -rf /var/lib/apt/lists/*

# Set basic permissions
RUN chmod -R 777 /app/public
RUN chmod -R 777 /app/storage

# Expose our HTTP port to the Host
EXPOSE 80

# Fire up the entrypoint script
CMD ["/usr/local/bin/docker-entrypoint.sh"]
CMD ["/etc/entrypoint.sh"]
