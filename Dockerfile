FROM php:7.2-apache 

LABEL maintener="LEFRANCOIS Rémy"

RUN useradd -G www-data -m user && \
    sed -i "s/DocumentRoot.*$/DocumentRoot \/home\/user\/sources\//" $(grep -l DocumentRoot $(find /etc/apache2 -type f)) && \
    sed -i "s/\<Directory \/var\/www.*$/Directory \/home\/user\/sources\/\>/" $(grep -l "<Directory /var/www/>" $(find /etc/apache2 -type f)) && \
    mkdir /home/user/sources && \
    chown www-data /home/user/sources -Rf && \
    chmod 775 -R /home/user/sources && \
    docker-php-ext-install pdo pdo_mysql

    