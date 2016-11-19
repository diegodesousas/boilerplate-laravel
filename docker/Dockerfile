FROM ubuntu:16.04

MAINTAINER Diego de Sousa <diegodesousas@yahoo.com.br>

#update apt-get
RUN apt-get update

#install php
RUN apt-get install -y php7.0 php7.0-cli php7.0-json php7.0-mbstring php7.0-mysql php7.0-xml

#install apache2
RUN apt-get install -y apache2 libapache2-mod-php7.0
RUN a2enmod rewrite

#install composer
RUN apt-get install -y curl
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

#install git
RUN apt-get install -y git

#external ports
EXPOSE 8081