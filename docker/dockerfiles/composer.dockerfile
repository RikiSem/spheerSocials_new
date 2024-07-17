FROM composer:latest

WORKDIR /var/www/musich

ENTRYPOINT ["composer", "--ignore-platform-reqs"]