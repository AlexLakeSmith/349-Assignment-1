# -*- mode: ruby -*-
# vi: set ft=ruby :


Vagrant.configure("2") do |config|

  config.vm.box = "ubuntu/xenial64"

 
  config.vm.network "forwarded_port", guest: 80, host: 8080, host_ip: "127.0.0.1"


  config.vm.provision "shell", inline: <<-SHELL
    apt-get update
    apt-get install -y apache2 php libapache2-mod-php 
  
# Change VM's webserver's configuration to use shared folder.
    # (Look inside test-website.conf for specifics.)
    cp /vagrant/test-website.conf /etc/apache2/sites-available/
    # install our website configuration and disable the default
    a2ensite test-website
    a2dissite 000-default
    service apache2 reload
  SHELL
end
