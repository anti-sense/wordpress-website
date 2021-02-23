FROM wordpress:latest


ENV WORDPRESS_DB_HOST=127.0.0.1:3306
ENV WORDPRESS_DB_USER=wordpress
ENV WORDPRESS_DB_PASSWORD=password
ENV WORDPRESS_DB_NAME=wordpress

EXPOSE 80:80

copy wp-app /var/www/html