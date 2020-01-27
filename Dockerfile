FROM amazonlinux:2
MAINTAINER r-kojima

RUN yum update -y

RUN amazon-linux-extras install -y php7.2 nginx1.12

RUN yum install -y php php-cli php-devel php-pdo php-mbstring php-pear php-soap php-mysqlnd php-fpm php-bcmath \
       php-gd php-pecl-memcached php-pecl-apcu php-pecl-zip

RUN php -v

RUN sed -i -e "s/\;date.timezone =/date.timezone = 'Asia\/Tokyo'/g" /etc/php.ini
ADD .docker/web/www.conf /etc/php-fpm.d/www.conf

#Install Nginx
RUN yum install -y nginx
ADD ./.docker/web/server.conf /etc/nginx/conf.d/default.conf
ADD ./.docker/web/nginx.conf /etc/nginx/nginx.conf


# Install composer
RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" \
    && php composer-setup.php --install-dir=/usr/local/bin --filename=composer \
    && php -r "unlink('composer-setup.php');" \
    && ln -s /usr/local/bin/composer /usr/local/bin/composer.phar

EXPOSE 80
ADD .docker/web/entrypoint.sh /entrypoint.sh
RUN chmod +x /entrypoint.sh

ENTRYPOINT /entrypoint.sh
