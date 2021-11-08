Vagrant.configure(2) do |config|

	config.vm.box = "generic/ubuntu1804"

	
	config.ssh.username = "vagrant"
	config.ssh.password = "vagrant"

	config.vm.provider "virtualbox" do |vb|
		# Display the VirtualBox GUI when booting the machine
		vb.gui = true
	  end
	
	  # Install xfce and virtualbox additions
	  config.vm.provision "shell", inline: "sudo apt-get update"
	  config.vm.provision "shell", inline: "sudo apt-get install -y xfce4 virtualbox-guest-dkms virtualbox-guest-utils virtualbox-guest-x11"
	  # Permit anyone to start the GUI
	  config.vm.provision "shell", inline: "sudo sed -i 's/allowed_users=.*$/allowed_users=anybody/' /etc/X11/Xwrapper.config"

		config.vm.define "vag" do|vag|
			vag.vm.hostname = "vag" 
			vag.vm.network "private_network", ip: "192.168.205.10"
			
			
			#vag.vm.provision :shell, path: "/home/dotwrk_internship/vagrant/install.sh" 
			#vag.vm.provision :shell, path: "/home/dotwrk_internship/vagrant/creatingFolder.sh"
			
			#vag.vm.synced_folder "/home/dotwrk_internship", "/var/www/intelpos.test/public_html"
			
			#vag.vm.synced_folder "/home/dotwrk_internship/config/conf_nginx", "/etc/nginx/sites-available"
			#vag.vm.synced_folder "config/conf_varnish", "/etc/varnish"
			
			#config.vm.network "forwarded_port", guest: 80, host: 8080, id: "nginx"
			
			#vag.vm.provision :shell, path: "vagrant/rewrite.sh"
		end
end


