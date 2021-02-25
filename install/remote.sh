ssh-keygen -f ~/.ssh/antisense-website
#Send DB
scp ~/data/Backups/computers/antisense/wp-data/latest.sql antisense2:~/latest.sql
#Send Github privkey
scp ~/.ssh/antisense-website antisense2:~/.ssh/
cat ~/.ssh/antisense-website.pub >> ~/.ssh/authorized_keys

ssh antisense2 'echo -e "Host backup\n\tHostname madreputa.no-ip.org\n\tPort 22\n\tUser brunocosta\n\tIdentityfile ~/.ssh/antisense-website\n\tIdentitiesOnly yes" >> ~/.ssh/config'