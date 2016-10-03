#!/usr/bin/env bash

apt-get update

#install php/check php ok
apt-get install  libapache2-mod-php5 php5-mcrypt -y

apt-get install software-properties-common python-software-properties -y
add-apt-repository ppa:ondrej/php
apt-get update
apt-get install php5.6

#install apache/check apache.
apt-get install apache2 -y
apt-get install git -y
apt-get install php5-gd -y

mkdir -p /opt/procbox
mkdir -p /opt/procbox/rest
#set vhost
cd /opt/procbox/rest
if [ ! -d  /opt/procbox/rest/ImageBox ]; then
    git clone https://github.com/denshade/ImageBox.git
else
    cd /opt/procbox/rest/ImageBox
    git pull origin
fi

ln -s /opt/procbox/rest/ImageBox /var/www

cd /opt/procbox/rest/ImageBox
if [ ! -f  composer.phar ]; then
    php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
    php -r "if (hash_file('SHA384', 'composer-setup.php') === 'e115a8dc7871f15d853148a7fbac7da27d6c0030b848d9b3dc09e2a0388afed865e6a3d6b3c0fad45c48e2b5fc1196ae') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;"
    php composer-setup.php
    php -r "unlink('composer-setup.php');"
fi


php composer.phar update

