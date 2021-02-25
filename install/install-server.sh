#!/usr/bin/env bash
DIR=$( cd "$( dirname "${BASH_SOURCE[0]}" )" && pwd )
. DIR/../.env


#Build website
cd wordpress-website

#Set website
docker build -t antisense/website .
#docker logs antisense/website
#docker exec -it [container] /bin/bash

sudo mysql -D ${DB_PASSWORD} < mv /home/$USER/latest.sql
mkdir /home/$USER/wordpress-website/wp-data/
mv /home/$USER/latest.sql /home/$USER/wordpress-website/wp-data/


sudo apt install nginx certbot python3-certbot-nginx
sudo systemctl start nginx
sudo cp nginx/antisense.conf /etc/nginx/sites-available/
sudo certbot --nginx certonly -d anti-sense.com -d www.anti-sense.com
sudo systemctl stop nginx
sudo unlink /etc/nginx/sites-enabled/default
sudo ln -s /etc/nginx/sites-available/antisense.conf /etc/nginx/sites-enabled/antisense.conf
sudo systemctl start nginx
docker run -d --network="host" --mount source=wp-app,target=/var/www/html --restart unless-stopped antisense/website
sudo ln -s /var/lib/docker/volumes/wp-app/_data /home/$USER/wordpress-website/backup
sudo chown -R wwww-data:www-data /home/$USER/wordpress-website/backup/*
sudo chown -R wwww-data:www-data /home/$USER/wordpress-website/backup/.htaccess

##Setup madreputa
