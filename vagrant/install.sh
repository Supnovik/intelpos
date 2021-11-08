#!/bin/bash


sudo apt-get -y update

sudo apt install nginx -y

sudo systemctl start nginx
sudo systemctl enable nginx


sudo apt install varnish -y

sudo systemctl start varnish
sudo systemctl enable varnish


