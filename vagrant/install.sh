#!/bin/bash

sudo apt-get update -y
sudo apt-get upgrade -y


sudo apt install nginx -y

sudo systemctl start nginx
sudo systemctl enable nginx

sudo apt install software-properties-common
sudo add-apt-repository ppa:ondrej/php
sudo apt update
sudo apt install php7.4-fpm php7.4-cli php7.4-mysql php7.4-curl php7.4-json -y

#sudo apt install varnish -y

#sudo systemctl start varnish
#sudo systemctl enable varnish


