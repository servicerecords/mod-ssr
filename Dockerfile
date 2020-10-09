# FROM ubuntu:20.04
FROM codesure/srrdigital:baseline

ENV DEBIAN_FRONTEND=noninteractive
ENV TZ=Europe/London

WORKDIR /app

# Move our application into the container
COPY application/ /app
RUN sed -i 's/{{APP_URL}}/"$APP_URL"/g' ./docker/.env
RUN sed -i 's/{{LAND_EMAIL}}/"$LAND_EMAIL"/g' ./docker/.env
RUN sed -i 's/{{SEA_EMAIL}}/"$SEA_EMAIL"/g' ./docker/.env
RUN sed -i 's/{{AIR_EMAIL}}/"$AIR_EMAIL"/g' ./docker/.env
RUN sed -i 's/{{ACCOUNTS_EMAIL}}/"$ACCOUNTS_EMAIL"/g' ./docker/.env
RUN sed -i 's/{{FEEDBACK_EMAIL}}/"$FEEDBACK_EMAIL"/g' ./docker/.env
RUN sed -i 's/{{UNKNOWN_EMAIL}}/"$UNKNOWN_EMAIL"/g' ./docker/.env
RUN sed -i 's/{{GOV_PAY_RETURN_URL}}/"$GOV_PAY_RETURN_URL"/g' ./docker/.env
RUN sed -i 's/{{NOTIFY_API_KEY}}/"$NOTIFY_API_KEY"/g' ./docker/.env
RUN sed -i 's/{{GA_ID}}/"$GA_ID"/g' ./docker/.env
COPY ./docker/.env /app/.env

# Install our application dependencies
RUN cd /app
RUN composer install
RUN npm install
RUN npm run prod

# Set basic permissions
RUN chmod -R 777 /app/public
RUN chmod -R 777 /app/storage

RUN cd /app
RUN ./artisan dusk

# Expose our HTTP port to the Host
EXPOSE 80

# Fire up the entrypoint script
CMD ["/usr/local/bin/docker-entrypoint.sh"]
CMD ["/etc/entrypoint.sh"]
