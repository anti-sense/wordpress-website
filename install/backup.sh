#!/usr/bin/env bash
set -e 

DIR=$( cd "$( dirname "${BASH_SOURCE[0]}" )" && pwd )
. $DIR/../.env


_now=$(date +"%Y_%m_%d")
_file="wp-data/data_$_now.sql.gz"

rsync -Pvzb --suffix=.$(date +"%Y_%m_%d") /home/${USER}/wordpress-website/$_file backup:~/data/Backups/computers/antisense/wp-data/
rsync -Pvzb /home/${USER}/wordpress-website/wp-data/latest.sql.gz backup:~/data/Backups/computers/antisense/wp-data/
##run dated backup copy & compress 

cd /home/brunocosta/wordpress-website
git add .
git commit -m "Weekly backup"
git push https://${GITHUB_TOKEN}@github.com/anti-sense/wordpress-website.git




