ssh-keygen -f ~/.ssh/antisense-website
#Send DB
scp ~/data/Backups/computers/antisense/wp-data/latest.sql.gz antisense-web:~/latest.sql.gz
#Send Github privkey
#Using this one now
scp ~/.ssh/antisense-website antisense-web:~/.ssh/
cat ~/.ssh/antisense-website.pub >> ~/.ssh/authorized_keys

ssh antisense-web 'echo -e "Host backup\n\tHostname drive.anti-sense.com\n\tPort 22\n\tUser brunocosta\n\tIdentityfile ~/.ssh/antisense-website\n\tIdentitiesOnly yes" >> ~/.ssh/config'
