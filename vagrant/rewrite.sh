#!/bin/bash



sudo rm /etc/nginx/sites-available/default
sudo rm /etc/nginx/sites-enabled/default


sudo sed -i 's/# server_names_hash_bucket_size 64;/server_names_hash_bucket_size 64;/' /etc/nginx/nginx.conf


sudo ln -s /etc/nginx/sites-available/intelpos.test /etc/nginx/sites-enabled/


#sudo sed -i 's/:6081/:80/' /etc/default/varnish

#sudo sed -i 's/-a :6081 -T/-a :80 -T/' /lib/systemd/system/varnish.service


sudo service nginx restart


sudo systemctl daemon-reload
#sudo service varnish restart

