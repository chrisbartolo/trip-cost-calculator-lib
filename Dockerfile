FROM php:7.4-apache
COPY . /var/www/html
WORKDIR /var/www/html

RUN apt-get update
#RUN pear config-set php_ini /usr/local/etc/php/php.ini-development

RUN apt-get install -y libmpdec-dev libzip-dev

RUN pecl install decimal
RUN echo "extension=decimal.so" > /usr/local/etc/php/conf.d/docker-php-ext-decimal.ini

RUN docker-php-ext-install zip

RUN yes | pecl install xdebug \
    && echo "zend_extension=$(find /usr/local/lib/php/extensions/ -name xdebug.so)" > /usr/local/etc/php/conf.d/xdebug.ini \
    && echo "xdebug.remote_enable=on" >> /usr/local/etc/php/conf.d/xdebug.ini \
    && echo "xdebug.remote_autostart=off" >> /usr/local/etc/php/conf.d/xdebug.ini \
    && echo "xdebug.mode=coverage" >> /usr/local/etc/php/conf.d/xdebug.ini


RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN cd /var/www/html
RUN composer install
CMD cd /var/www/html && composer dumpautoload && ./vendor/bin/phpunit