FROM ubuntu:16.04

MAINTAINER Diego de Sousa <diegodesousas@yahoo.com.br>

# external ports
EXPOSE 8081

# update apt-get
RUN apt-get update

# install php
RUN apt-get install -y php7.0 php7.0-cli php7.0-json php7.0-mbstring php7.0-mysql php7.0-xml php7.0-fpm php7.0-cgi

# install composer
RUN apt-get install -y curl
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# install git
RUN apt-get install -y git

# ngnix
RUN apt-get install -y nginx

# nginx configuration
COPY boilerplate.conf /etc/nginx/sites-enabled/boilerplate.conf

# user
RUN useradd -ms /bin/bash server-user
#USER server-user
