FROM php:7.3

RUN apt-get update -y && apt-get install -y openssl zip unzip git
ADD https://github.com/mlocati/docker-php-extension-installer/releases/latest/download/install-php-extensions /usr/local/bin/
RUN chmod +x /usr/local/bin/install-php-extensions && sync && \
    install-php-extensions @composer oauth

WORKDIR /app
COPY . /app

RUN composer install

RUN apt-get -y autoremove \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*

CMD php artisan serve --host=0.0.0.0 --port=8080
EXPOSE 8080
