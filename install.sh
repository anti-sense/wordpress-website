#!/usr/bin/env bash
#############################################################################################
# Bruno Costa
# copy this file 
#       or 
# wget https://raw.githubusercontent.com/anti-sense/wordpress-website/master/install.sh
#############################################################################################
echo -n USERNAME: 
read USERNAME

#NEW USER
sudo adduser ${USERNAME}
sudo usermod -aG sudo,adm ${USERNAME}

sudo mkdir /home/${USERNAME}/.ssh
sudo cp /home/ubuntu/.ssh/authorized_keys /home/${USERNAME}/.ssh/authorized_keys
sudo chown ${USERNAME}:${USERNAME} /home/${USERNAME}/.ssh/authorized_keys
sudo chmod 644 /home/${USERNAME}/.ssh/authorized_keys

sudo echo '#!/usr/bin/env bash' > build.sh
sudo echo 'git clone https://github.com/anti-sense/wordpress-website.git' >> build.sh
sudo echo 'wordpress-website/install/./setup.sh' >> build.sh
sudo chmod +x build.sh
sudo cp /home/ubuntu/build.sh /home/${USERNAME}/build.sh
sudo chown ${USERNAME}:${USERNAME} /home/${USERNAME}/build.sh

echo 'now run: cd;./build.sh'
sudo su ${USERNAME}
sudo apt -y install certbot
sudo certbot certonly --standalone --agree-tos -m brunovasquescosta@gmail.com -d anti-sense.com
