#!/usr/bin/env bash
DIR=$( cd "$( dirname "${BASH_SOURCE[0]}" )" && pwd )
. DIR/../.env


_now=$(date +"%m_%d_%Y")
_file="wp-data/data_$_now.sql"

sudo mysqldump "$DB_NAME" > /home/${USER}/wordpress-website/$_file

cp /home/${USER}/wordpress-website/$_file /home/${USER}/wordpress-website/latest.sql
#scp /home/${USER}/wordpress-website/$_file brunocosta@madreputa.no-ip.org:~/~/data/Backups/computers/antisense/wp-data/
##run dated backup copy & compress 

#cd ~/wordpress/backup
#git add .
#git commit -m "Weekly backup"
#git push origin master



