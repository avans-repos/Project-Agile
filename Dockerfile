FROM php:8

RUN curl -sL https://deb.nodesource.com/setup_current.x | sudo -E bash -
RUN apt-get update -y && apt-get install -y --no-install-recommends openssl zip unzip git nodejs

ADD https://github.com/mlocati/docker-php-extension-installer/releases/latest/download/install-php-extensions /usr/local/bin/
RUN chmod +x /usr/local/bin/install-php-extensions && sync && \
    install-php-extensions @composer curl gd mbstring openssl fileinfo mysqli pdo_mysql

WORKDIR /app
COPY . /app

RUN composer install
RUN npm install
RUN npm run prod

RUN apt-get -y autoremove \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*

CMD php artisan queue:work \ 
  & php artisan serve --host=0.0.0.0 --port=8080

EXPOSE 8080
