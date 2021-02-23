#!/usr/bin/env bash
USERNAME="brunocosta"
echo -n USERNAME: 
read USERNAME

#NEW USER
sudo adduser ${USERNAME}
sudo usermod -aG sudo,adm ${USERNAME}
cd /home/${USERNAME}
mkdir .ssh
sudo cp /home/ubuntu/.ssh/authorized_keys ~/.ssh/authorized_keys
sudo chown ${USERNAME}:${USERNAME} ~/.ssh/authorized_keys
sudo chmod 644 ~/.ssh/authorized_keys

sudo su ${USERNAME}
cd /home/${USERNAME}
git clone https://github.com/anti-sense/wordpress-website.git
echo now run: install/./setup.sh
