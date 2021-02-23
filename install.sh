USERNAME="brunocosta"
echo -n USERNAME: 
read USERNAME
DB_PASSWORD=password
DB_NAME=wordpress
DB_USER=wordpress

#NEW USER
sudo adduser ${USERNAME}
sudo usermod -aG sudo,adm ${USERNAME}
sudo su ${USERNAME}
cd /home/${USERNAME}
mkdir .ssh
sudo cp /home/ubuntu/.ssh/authorized_keys ~/.ssh/authorized_keys
sudo chown ${USERNAME}:${USERNAME} ~/.ssh/authorized_keys
sudo chmod 644 ~/.ssh/authorized_keys

#Necessary stuff
sudo apt update
sudo apt upgrade
sudo apt install build-essential

#DOCKER
sudo apt-get update
sudo apt-get upgrade
curl -fsSL test.docker.com -o get-docker.sh && sh get-docker.sh
sudo usermod -aG docker ${USERNAME}

sudo apt install nginx certbot python3-certbox-nginx



####
# replace /etc/nginx/sites-enabled/default with the following 
```
server {
        listen 443 ssl;
        server_name www.anti-sense.com anti-sense.com;
        ssl_certificate /etc/letsencrypt/live/anti-sense.com/fullchain.pem;
        ssl_certificate_key /etc/letsencrypt/live/anti-sense.com/privkey.pem;

        location / {
                proxy_set_header X-Real-IP $remote_addr;
                proxy_set_header X-Forward-Proto $scheme;
                proxy_set_header X-Forwarded-Proto $scheme;
                proxy_set_header X-Forwarded-Host $host;
                proxy_pass       http://localhost:80;
                proxy_http_version 1.1;
                proxy_set_header Upgrade $http_upgrade;
                proxy_set_header Connection 'upgrade';
                proxy_set_header Host $host;
                proxy_cache_bypass $http_upgrade;
        }
}
````


sudo certbot --nginx certonly -d anti-sense.com -d www.anti-sense.com


#MYSQL 
sudo apt install mysql-server
sudo mysql_secure_installation

echo -n Root Password: 
read -s root_password


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


#Set website
docker build -t antisense/website .
docker run -d --network="host"  antisense/website

#docker logs antisense/website






```
docker build -t antisense/website .
docker run -d --network="host" antisense/website
#docker logs antisense/website






  wp:
    image: wordpress:latest # https://hub.docker.com/_/wordpress/
    ports:
      - ${IP}:3022:80 # change ip if required
    volumes:
      - ./config/php.conf.ini:/usr/local/etc/php/conf.d/conf.ini
      - ./wp-app:/var/www/html # Full wordpress project
      #- ./plugin-name/trunk/:/var/www/html/wp-content/plugins/plugin-name # Plugin development
      #- ./theme-name/trunk/:/var/www/html/wp-content/themes/theme-name # Theme development
    environment:
      WORDPRESS_DB_HOST: db
      WORDPRESS_DB_NAME: "${DB_NAME}"
      WORDPRESS_DB_USER: root
      WORDPRESS_DB_PASSWORD: "${DB_ROOT_PASSWORD}"
    depends_on:
      - db
    links:
      - db


docker run --name antisense-wordpress --network="host" \ 
-e WORDPRESS_DB_HOST=127.0.0.1:3306 \
-e WORDPRESS_DB_USER=wordpress \
-e WORDPRESS_DB_PASSWORD=password \
-e WORDPRESS_DB_NAME=wordpress wordpress \ 
-e WORDPRESS_CONFIG_EXTRA=define('WP_SITEURL','https://54.166.185.175/') 
-d wordpress



docker run --mount source=wp-app,target=/var/www/html --network="host"