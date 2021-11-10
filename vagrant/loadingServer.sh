#!/bin/bash

sudo a2ensite intelpos.test.conf
sudo a2dissite 000-default.conf
sudo a2enmod rewrite
sudo systemctl restart apache2

