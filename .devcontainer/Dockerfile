FROM php:8.3-cli

ARG USERNAME=vscode
ARG USER_UID=1000
ARG USER_GID=$USER_UID

ENV DEBIAN_FRONTEND=noninteractive

RUN apt-get update && apt-get install -y --no-install-recommends \
    git curl unzip zip ca-certificates gnupg \
    libzip-dev libpng-dev libonig-dev libxml2-dev \
    libicu-dev libpq-dev libsqlite3-dev sqlite3 \
    default-mysql-client \
    && rm -rf /var/lib/apt/lists/*

RUN docker-php-ext-install \
    pdo pdo_mysql pdo_sqlite mbstring exif pcntl bcmath \
    gd zip intl opcache sockets

RUN pecl install redis xdebug \
    && docker-php-ext-enable redis xdebug

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

RUN curl -fsSL https://deb.nodesource.com/setup_22.x | bash - \
    && apt-get install -y nodejs \
    && rm -rf /var/lib/apt/lists/*

RUN groupadd --gid $USER_GID $USERNAME \
    && useradd --uid $USER_UID --gid $USER_GID -m $USERNAME -s /bin/bash \
    && apt-get update && apt-get install -y sudo \
    && echo "$USERNAME ALL=(ALL) NOPASSWD:ALL" > /etc/sudoers.d/$USERNAME \
    && chmod 0440 /etc/sudoers.d/$USERNAME \
    && rm -rf /var/lib/apt/lists/*

WORKDIR /var/www/html

USER $USERNAME
