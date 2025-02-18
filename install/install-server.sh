#!/usr/bin/env bash
DIR=$( cd "$( dirname "${BASH_SOURCE[0]}" )" && pwd )
. $DIR/../.env

#Unzip database
gunzip latest.sql

#Build website
cd wordpress-website

#Set website
docker build -t antisense/website .
#docker logs antisense/website
#docker exec -it [container] /bin/bash

sudo mysql -D ${WORDPRESS_DB_NAME} < /home/$USER/latest.sql
mkdir /home/$USER/wordpress-website/wp-data/
## Can't have it inside
# mv /home/$USER/latest.sql /home/$USER/wordpress-website/wp-data/


sudo apt install nginx certbot python3-certbot-nginx
sudo systemctl start nginx
sudo cp nginx/antisense.conf /etc/nginx/sites-available/
sudo certbot certonly --standalone --agree-tos -m brunovasquescosta@gmail.com -d anti-sense.com


sudo systemctl stop nginx
sudo unlink /etc/nginx/sites-enabled/default
sudo ln -s /etc/nginx/sites-available/antisense.conf /etc/nginx/sites-enabled/antisense.conf
sudo systemctl start nginx
##Mounts the github folder "wp-add" instead of the Dockerfile content
docker run -d --network="host" --env-file $DIR/../.env  --mount type=bind,source=/home/$USER/wordpress-website/wp-app,target=/var/www/html --restart unless-stopped antisense/website

sudo chown -R www-data:www-data /home/$USER/wordpress-website/wp-app/
sudo chown -R www-data:www-data /home/$USER//wordpress-website/wp-app/wp-includes
sudo chown -R www-data:www-data /home/$USER//wordpress-website/wp-app/wp-admin
sudo chown -R www-data:www-data /home/$USER//wordpress-website/wp-app/wp-content


##Setup madreputa
