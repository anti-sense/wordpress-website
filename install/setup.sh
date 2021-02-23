#!/usr/bin/env bash

DB_PASSWORD=password
DB_NAME=wordpress
DB_USER=wordpress

#Necessary stuff
sudo apt update
sudo apt upgrade
sudo apt install build-essential

#DOCKER
sudo apt-get update
sudo apt-get upgrade
curl -fsSL test.docker.com -o get-docker.sh && sh get-docker.sh
sudo usermod -aG docker ${USERNAME}

#MYSQL 
sudo apt install mysql-server
sudo mysql_secure_installation

#SET GLOBAL validate_password_policy=low
sudo mysql -e "CREATE DATABASE ${DB_NAME};"
sudo mysql -e "Create USER '${DB_USER}'@'localhost' IDENTIFIED WITH mysql_native_password BY '${DB_PASSWORD}';" 
sudo mysql -e "GRANT ALL PRIVILEGES ON ${DB_NAME}.* TO '${DB_USER}'@'localhost';FLUSH PRIVILEGES;" 

#### On Remote backup
#
#  scp backup/ antisense2:~/
#  
#
#############################
#sudo mysql -D wordpress < backup/wp-data/*.sql
####


#Build website
cd wordpress-website

#Set website
docker build -t antisense/website .
docker run -d --network="host" --mount source=wp-app,target=/var/www/html --restart unless-stopped antisense/website
#docker logs antisense/website
#docker exec -it [container] /bin/bash

sudo apt install nginx certbot python3-certbox-nginx
sudo cp nginx/antisense.conf /etc/nginx/sites-enabled/
sudo systemctl start nginx

sudo certbot --nginx certonly -d anti-sense.com -d www.anti-sense.com