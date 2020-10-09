# FROM ubuntu:20.04
FROM codesure/srrdigital:baseline

ENV DEBIAN_FRONTEND=noninteractive
ENV TZ=Europe/London

WORKDIR /app

# Move our application into the container
COPY application/ /app

# Install our application dependencies
RUN cd /app
RUN composer install
RUN npm install
RUN npm run prod

# Set basic permissions
RUN chmod -R 777 /app/public
RUN chmod -R 777 /app/storage

# Expose our HTTP port to the Host
EXPOSE 80

# Fire up the entrypoint script
CMD ["/usr/local/bin/docker-entrypoint.sh"]
CMD ["/etc/entrypoint.sh"]
