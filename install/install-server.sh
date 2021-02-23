#!/usr/bin/env bash
#Build website
cd wordpress-website

#Set website
docker build -t antisense/website .
docker run -d --network="host" --mount source=wp-app,target=/var/www/html --restart unless-stopped antisense/website
#docker logs antisense/website
#docker exec -it [container] /bin/bash

sudo apt install nginx certbot python3-certbot-nginx
sudo cp nginx/antisense.conf /etc/nginx/sites-enabled/
sudo systemctl start nginx

sudo certbot --nginx certonly -d anti-sense.com -d www.anti-sense.com