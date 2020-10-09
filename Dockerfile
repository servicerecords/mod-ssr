# FROM ubuntu:20.04
FROM nginx:latest

ENV DEBIAN_FRONTEND=noninteractive
ENV TZ=Europe/London

# --- Start Sandbox Build
#ENV APP_NAME="Apply for a deceased's military record"
#ENV LAND_EMAIL=liam.cusack582@mod.gov.uk
#ENV SEA_EMAIL=liam.cusack582@mod.gov.uk
#ENV AIR_EMAIL=liam.cusack582@mod.gov.uk
#ENV ACCOUNTS_EMAIL=liam.cusack582@mod.gov.uk
#ENV FEEDBACK_EMAIL=liam.cusack582@mod.gov.uk
#ENV UNKNOWN_EMAIL=liam.cusack582@mod.gov.uk
#ENV GOV_PAY_RETURN_URL=https://srrdigital-sandbox.cloudapps.digital
#ENV APP_URL=https://srrdigital-sandbox.cloudapps.digital/
#ENV APP_KEY=base64:D+46PLyWMals3yMD3OjYG1kqa9D7f81c7599yhEfsPo=
#ENV APP_DEBUG=false
#ENV DEBUGBAR_ENABLED=false
#ENV LOG_CHANNEL=stack
#ENV BROADCAST_DRIVER=log
#ENV CACHE_DRIVER=file
#ENV QUEUE_CONNECTION=sync
#ENV SESSION_DRIVER=file
#ENV SESSION_LIFETIME=20
#ENV SESSION_SECURE_COOKIE=true
#ENV SENTRY_LARAVEL_DSN=https://3adb3e786b9c430c8a6c9bed07ad0ef2@o430224.ingest.sentry.io/5378341
#ENV NOTIFY_API_KEY=srrdigitalproduction-8ae4b688-c5e2-45ff-a873-eb149b3e23ff-ed3db9dd-d928-4d4c-89dc-8d22b4265e75
#ENV GA_ID=UA-176740731-2
# --- End Sandbox Build

# --- Start QA Build
#ENV APP_NAME="Apply for a deceased's military record"
#ENV LAND_EMAIL=lauren.phillips225@mod.gov.uk
#ENV SEA_EMAIL=lauren.phillips225@mod.gov.uk
#ENV AIR_EMAIL=lauren.phillips225@mod.gov.uk
#ENV ACCOUNTS_EMAIL=lauren.phillips225@mod.gov.uk
#ENV FEEDBACK_EMAIL=lauren.phillips225@mod.gov.uk
#ENV UNKNOWN_EMAIL=lauren.phillips225@mod.gov.uk
#ENV GOV_PAY_RETURN_URL="https://srrdigital-qa.cloudapps.digital"
#ENV APP_URL="https://srrdigital-qa.cloudapps.digital/"
#ENV APP_KEY="base64:D+46PLyWMals3yMD3OjYG1kqa9D7f81c7599yhEfsPo="
#ENV APP_DEBUG=false
#ENV DEBUGBAR_ENABLED=false
#ENV LOG_CHANNEL=stack
#ENV BROADCAST_DRIVER=log
#ENV CACHE_DRIVER=file
#ENV QUEUE_CONNECTION=sync
#ENV SESSION_DRIVER=file
#ENV SESSION_LIFETIME=20
#ENV SESSION_SECURE_COOKIE=true
#ENV SENTRY_LARAVEL_DSN="https://3adb3e786b9c430c8a6c9bed07ad0ef2@o430224.ingest.sentry.io/5378341"
#ENV NOTIFY_API_KEY="srrdigitalproduction-8ae4b688-c5e2-45ff-a873-eb149b3e23ff-ed3db9dd-d928-4d4c-89dc-8d22b4265e75"
#ENV GA_ID="UA-176740731-3"
# --- End Sandbox Build

#ENV NOTIFY_API_KEY=srrdigitalproduction-8ae4b688-c5e2-45ff-a873-eb149b3e23ff-ed3db9dd-d928-4d4c-89dc-8d22b4265e75
#ENV GOV_PAY_API_KEY=srrdigitalproduction-8ae4b688-c5e2-45ff-a873-eb149b3e23ff-ed3db9dd-d928-4d4c-89dc-8d22b4265e75

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
RUN apt -y --no-install-recommends install nodejs yarn

# Move our application into the container
COPY application/ /app
COPY ./docker/000-default.conf /etc/nginx/conf.d/default.conf
COPY ./docker/nginx.conf /etc/nginx/nginx.conf
COPY ./docker/policy.xml /etc/ImageMagick-6/policy.xml
COPY ./docker/php.ini /etc/php/7.3/fpm/php.ini

# Install our application dependencies
RUN cd /app
RUN composer install
RUN npm install
RUN npm run prod

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
