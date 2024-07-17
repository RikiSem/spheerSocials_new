FROM node:lts-alpine

RUN npm install -g @vue/cli
RUN mkdir front
WORKDIR /var/www/spheer/front

