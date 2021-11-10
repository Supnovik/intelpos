#!/bin/bash


sudo apt -y update


sudo apt -y install apache2

sudo apt -y install mysql-server

sudo apt install software-properties-common
sudo add-apt-repository ppa:ondrej/php
sudo apt update
sudo apt  -y install php7.4

sudo apt -y install php7.4 php7.4-mysql php-common php7.4-cli php7.4-common php7.4-json php7.4-opcache php7.4-readline
