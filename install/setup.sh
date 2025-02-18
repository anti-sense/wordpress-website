#!/usr/bin/env bash
DIR=$( cd "$( dirname "${BASH_SOURCE[0]}" )" && pwd )

echo -n Database name?: 
read DB_NAME
echo "WORDPRESS_DB_NAME=${DB_NAME}" > $DIR/../.env

echo -n Database user?: 
read DB_USER
echo "WORDPRESS_DB_USER=${DB_USER}" >> $DIR/../.env

echo -n Database password?: 
read DB_PASSWORD
echo "WORDPRESS_DB_PASSWORD=${DB_PASSWORD}" >> $DIR/../.env

#LOAD SAVED ENV
. $DIR/../.env


#Necessary stuff
sudo apt update
sudo apt upgrade
sudo apt install build-essential

#DOCKER
sudo apt-get update
sudo apt-get upgrade

curl -fsSL test.docker.com -o get-docker.sh && sh get-docker.sh
sudo usermod -aG docker ${USER}

#MYSQL 
sudo apt install mysql-server
sudo mysql_secure_installation

#SET GLOBAL validate_password_policy=low
sudo mysql -e "CREATE DATABASE ${WORDPRESS_DB_NAME};"
sudo mysql -e "Create USER '${WORDPRESS_DB_USER}'@'localhost' IDENTIFIED WITH mysql_native_password BY '${WORDPRESS_DB_PASSWORD}';" 
sudo mysql -e "GRANT ALL PRIVILEGES ON ${WORDPRESS_DB_NAME}.* TO '${WORDPRESS_DB_USER}'@'localhost';FLUSH PRIVILEGES;" 

#SET Credentials for wp-app in docker
sed -i "s/'DB_NAME', '.*'/'DB_NAME', '${WORDPRESS_DB_NAME}'/" wordpress-website/wp-app/wp-config.php
sed -i "s/'DB_USER', '.*'/'DB_USER', '${WORDPRESS_DB_USER}'/" wordpress-website/wp-app/wp-config.php
sed -i "s/'DB_PASSWORD', '.*'/'DB_PASSWORD', '${WORDPRESS_DB_PASSWORD}'/" wordpress-website/wp-app/wp-config.php


echo '#################################################'
echo '#  Build-Essential, Docker and MySQL installed  #'
echo '#################################################'
echo 'Send database and github key'
echo 'run on desktop: ./remote.sh'
echo "Point your domain A records to this ip: $(wget -qO- ipinfo.io/ip)"
echo 'run: wordpress-website/install/./install-server.sh'
sudo su brunocosta
