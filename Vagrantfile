Vagrant.configure(2) do |config|

	config.vm.box = "generic/ubuntu1804"

	
	config.ssh.username = "vagrant"
	config.ssh.password = "vagrant"

	
		config.vm.define "vag" do|vag|
			vag.vm.hostname = "vag" 
			vag.vm.network "private_network", ip: "192.168.205.10"
			
			
			vag.vm.provision :shell, path: "vagrant/install.sh" 
			vag.vm.provision :shell, path: "vagrant/creatingFolder.sh"
			
			vag.vm.synced_folder "", "/var/www/intelpos.test/public_html"
			
			vag.vm.synced_folder "config/conf_nginx", "/etc/nginx/sites-available"
			#vag.vm.synced_folder "config/conf_varnish", "/etc/varnish"
			
			config.vm.network "forwarded_port", guest: 80, host: 8080, id: "nginx"
			
			vag.vm.provision :shell, path: "vagrant/rewrite.sh"
		end
end


