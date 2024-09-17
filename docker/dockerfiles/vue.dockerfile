FROM node:lts-alpine

RUN mkdir front
WORKDIR /var/www/spheer/front

RUN npm install
RUN npm install -g @vue/cli

