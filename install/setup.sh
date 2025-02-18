#!/usr/bin/env bash
echo -n Database name?: 
read DB_NAME
echo "DB_NAME=${DB_NAME}" > ../.env

echo -n Database user?: 
read DB_USER
echo "DB_USER=${DB_USER}" >> ../.env

echo -n Database password?: 
read DB_PASSWORD
echo "DB_PASSWORD=${DB_PASSWORD}" >> ../.env


../.env
DIR=$( cd "$( dirname "${BASH_SOURCE[0]}" )" && pwd )
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
sudo mysql -e "CREATE DATABASE ${DB_NAME};"
sudo mysql -e "Create USER '${DB_USER}'@'localhost' IDENTIFIED WITH mysql_native_password BY '${DB_PASSWORD}';" 
sudo mysql -e "GRANT ALL PRIVILEGES ON ${DB_NAME}.* TO '${DB_USER}'@'localhost';FLUSH PRIVILEGES;" 

echo '#################################################'
echo '#  Build-Essential, Docker and MySQL installed  #'
echo '#################################################'
echo 'Send database and github key'
echo 'run on desktop: ./remote.sh'
echo "Point your domain A records to this ip: $(wget -qO- ipinfo.io/ip)"
echo 'run: wordpress-website/install/./install-server.sh'
sudo su brunocosta
