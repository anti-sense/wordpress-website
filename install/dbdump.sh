#!/usr/bin/env bash
set -e 

DIR=$( cd "$( dirname "${BASH_SOURCE[0]}" )" && pwd )
. $DIR/../.env


_now=$(date +"%Y_%m_%d")
_file="wp-data/data_$_now.sql.gz"


sudo mysqldump "$DB_NAME" | gzip > /home/${USER}/wordpress-website/$_file

cp /home/${USER}/wordpress-website/$_file /home/${USER}/wordpress-website/wp-data/latest.sql.gz

systemctl start website-backup


