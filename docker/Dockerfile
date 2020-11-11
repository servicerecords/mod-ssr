FROM nginx:latest

ENV DEBIAN_FRONTEND=noninteractive
ENV TZ=Europe/London

WORKDIR /app

# Install all requirements
RUN apt update
RUN apt -y upgrade
RUN apt -y --no-install-recommends install unzip \
                   php-fpm php-bcmath php-bz2 php-calendar \
                   php-mbstring \
                   php-curl php-intl php-json php-imagick wget \
                   php-xml php-zip ghostscript imagemagick \
                   libasound2 libatk-bridge2.0 libatk1.0-0 libatspi2.0-0 \
                   libcairo2 libdrm2 libgdk-pixbuf2.0-0 libgtk-3-0 libnspr4 \
                   libnss3 libpango-1.0-0 libpangocairo-1.0-0 libx11-xcb1 libxcb-dri3-0 \
                   libxcomposite1 libxdamage1 libxfixes3 libxrandr2 xdg-utils \
                   fonts-liberation libgbm1

RUN curl -sL https://deb.nodesource.com/setup_12.x -o nodesource_setup.sh
RUN bash nodesource_setup.sh
RUN rm nodesource_setup.sh
RUN apt -y --no-install-recommends install nodejs yarn
RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
RUN php -r "if (hash_file('sha384', 'composer-setup.php') === 'c31c1e292ad7be5f49291169c0ac8f683499edddcfd4e42232982d0fd193004208a58ff6f353fde0012d35fdd72bc394') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;"
RUN php composer-setup.php
RUN php -r "unlink('composer-setup.php');"

# Move our application into the container
COPY ./docker/000-default.conf /etc/nginx/conf.d/default.conf
COPY ./docker/nginx.conf /etc/nginx/nginx.conf
COPY ./docker/policy.xml /etc/ImageMagick-6/policy.xml
COPY ./docker/php.ini /etc/php/7.3/fpm/php.ini

# Add the entryscript to fire up Nginx and PHP-FPM
COPY ./docker/docker-entrypoint.sh /usr/local/bin/docker-entrypoint.sh
COPY ./docker/docker-entrypoint.sh /etc/entrypoint.sh

# Add Chrome for smoke testing
RUN wget https://dl.google.com/linux/direct/google-chrome-stable_current_amd64.deb
# RUN apt -y install ./google-chrome-stable_current_amd64.deb
RUN dpkg -i google-chrome-stable_current_amd64.deb
RUN ln -s /usr/bin/google-chrome /usr/bin/chromium

#RUN rm google-chrome-stable_current_amd64.deb
RUN chmod 755 /usr/local/bin/docker-entrypoint.sh
RUN chmod 755 /etc/entrypoint.sh
COPY docker/chromedriver /usr/local/bin/chromedriver

# Bit of a clean up
# RUN apt -y remove wget && rm -rf /var/lib/apt/lists/*

# Set basic permissions
RUN mkdir -p /app/public
RUN mkdir -p /app/storage
RUN chmod -R 777 /app/public
RUN chmod -R 777 /app/storage

# Expose our HTTP port to the Host
EXPOSE 80

# Fire up the entrypoint script
CMD ["/usr/local/bin/docker-entrypoint.sh"]
CMD ["/etc/entrypoint.sh"]
