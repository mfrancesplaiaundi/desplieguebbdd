FROM php:8.3-apache
ARG APP_NAME
ENV APP_NAME=$APP_NAME
COPY src/ /var/www/html

