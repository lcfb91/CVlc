FROM romeoz/docker-apache-php:7.3

RUN apt-get update \
    && apt-get install -y php-mongo \
    && rm -rf /var/lib/apt/lists/* 

WORKDIR /var/www/app/

COPY . /var/www/app/

CMD ["/sbin/entrypoint.sh"]