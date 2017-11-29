FROM php:7.1-apache

COPY config/uploads.ini /usr/local/etc/php/conf.d/uploads.ini
COPY config/docker-entrypoint.sh /usr/local/bin/docker-entrypoint.sh
COPY config/apache-config.conf /etc/apache2/sites-enabled/000-default.conf
COPY config/wp-su.sh /usr/local/bin/wp

RUN set -ex; \
    curl -sL https://deb.nodesource.com/setup_6.x | bash -; \
    apt-get update && apt-get install -y \
      libjpeg-dev \
      libpng-dev \
      git \
      less \
      mysql-client \
      nodejs \
      rsync \
      sudo \
      unzip \
      vim \
      zip \
    ; \
    rm -rf /var/lib/apt/lists/*; \
    docker-php-ext-configure gd --with-png-dir=/usr --with-jpeg-dir=/usr; \
    docker-php-ext-install gd mysqli opcache zip; \
    curl -sS https://getcomposer.org/installer | \
      php -- --install-dir=/usr/local/bin --filename=composer; \
    curl -o /usr/local/bin/wp-cli.phar \
      https://raw.githubusercontent.com/wp-cli/builds/gh-pages/phar/wp-cli.phar; \
    chmod +x /usr/local/bin/docker-entrypoint.sh; \
    chmod +x /usr/local/bin/wp-cli.phar; \
    chmod +x /usr/local/bin/wp; \
    mkdir -p /var/www/site/wp

COPY wp-config.php /var/www/site

# https://secure.php.net/manual/en/opcache.installation.php
RUN { \
      echo 'opcache.memory_consumption=128'; \
      echo 'opcache.interned_strings_buffer=8'; \
      echo 'opcache.max_accelerated_files=4000'; \
      echo 'opcache.revalidate_freq=2'; \
      echo 'opcache.fast_shutdown=1'; \
      echo 'opcache.enable_cli=1'; \
    } > /usr/local/etc/php/conf.d/opcache-recommended.ini

RUN a2enmod rewrite expires; \
    service apache2 restart

RUN set -ex; \
    curl -o wordpress.tar.gz -fSL "https://wordpress.org/latest.tar.gz"; \
    tar -xzf wordpress.tar.gz -C /usr/src/; \
    rm wordpress.tar.gz; \
    chown -R www-data:www-data /usr/src/wordpress

WORKDIR /var/www/site

ENTRYPOINT ["docker-entrypoint.sh"]
CMD ["apache2-foreground"]
