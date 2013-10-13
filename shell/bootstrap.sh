#!/usr/bin/env bash

debconf-set-selections <<< 'mysql-server-5.5 mysql-server/root_password password password'
debconf-set-selections <<< 'mysql-server-5.5 mysql-server/root_password_again password password'

apt-get update
apt-get -y install python-software-properties
apt-add-repository -y ppa:git-core/ppa
apt-add-repository -y ppa:ondrej/php5-oldstable
apt-get update
apt-get install -y apache2 libapache2-mod-php5 libapache2-mod-auth-mysql mysql-server php5-mysql php5-mcrypt
apt-get -y --allow-unauthenticated install git

if [ ! -h /var/www ];
then

    rm -rf /var/www sudo
    ln -s /vagrant/public_html /var/www

    a2enmod rewrite

    sed -i '/AllowOverride None/c AllowOverride All' /etc/apache2/sites-available/default

    if [ ! -f /etc/apache2/sites-available/security-application.dev ];
    then
        cp /vagrant/setup/security-application.dev /etc/apache2/sites-available
        a2ensite security-application.dev
    fi
    service apache2 restart
fi

if [ ! -f /var/log/databasesetup ];
then
    echo "CREATE DATABASE secapp" | mysql -uroot -ppassword

    php /vagrant/artisan migrate
    php /vagrant/artisan db:seed

    touch /var/log/databasesetup
fi

