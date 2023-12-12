FROM php:8.1.4-fpm

ARG USER_ID
ARG USER_NAME
ARG GROUP_ID
ARG WWW_DATA_GROUP_ID

RUN apt-get update -y \
    # npm
    && apt-get install -y nodejs npm \
    # git
    && apt-get install -y git \
    # composer
    && php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" \
    && php -r "if (hash_file('sha384', 'composer-setup.php') === 'e21205b207c3ff031906575712edab6f13eb0b361f2085f1f1237b7126d785e826a450292b6cfd1d64d92e6563bbde02') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;" \
    && php composer-setup.php \
    && php -r "unlink('composer-setup.php');" \
    && mv composer.phar /usr/local/bin/composer \
    # other
    && apt-get install -y libzip-dev zip libsodium-dev \
    # php extensions
    && pecl install xdebug-3.1.4 \
    && docker-php-ext-enable xdebug \
    && docker-php-ext-install zip bcmath sodium sockets pdo_mysql

# add default user (same as current host user)
# to sync permissions between this container files and host files
RUN groupadd -g ${GROUP_ID} ${USER_NAME} \
    && useradd -u ${USER_ID} -g ${GROUP_ID} -G ${WWW_DATA_GROUP_ID} ${USER_NAME} \
    && mkdir /home/${USER_NAME} \
    && chown ${USER_ID}:${GROUP_ID} /home/${USER_NAME} \
    && chmod 755 /home/${USER_NAME}
USER ${USER_ID}
