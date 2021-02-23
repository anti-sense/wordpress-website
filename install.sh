#!/usr/bin/env bash
USERNAME="brunocosta"
echo -n USERNAME: 
read USERNAME

#NEW USER
sudo adduser ${USERNAME}
sudo usermod -aG sudo,adm ${USERNAME}

sudo mkdir /home/${USERNAME}/.ssh
sudo cp /home/ubuntu/.ssh/authorized_keys /home/${USERNAME}/.ssh/authorized_keys
sudo chown ${USERNAME}:${USERNAME} /home/${USERNAME}/.ssh/authorized_keys
sudo chmod 644 /home/${USERNAME}/.ssh/authorized_keys

echo '#!/usr/bin/env bash' > /home/${USERNAME}/build.sh
echo 'git clone https://github.com/anti-sense/wordpress-website.git' >> /home/${USERNAME}/build.sh
echo 'wordpress-website/install/./setup.sh' >> /home/${USERNAME}/build.sh

echo 'now run: cd;./build.sh'
sudo su ${USERNAME}