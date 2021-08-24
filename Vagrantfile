# -*- mode: ruby -*-
# vi: set ft=ruby :

# A Vagrantfile to set up two VMs, a webserver and a database server,
# connected together using an internal network with manually-assigned
# IP addresses for the VMs.
Vagrant.configure("2") do |config|

# (We have used this box previously, so reusing it here should save a
  # bit of time by using a cached copy.)
  config.vm.box = "ubuntu/xenial64"

# This is a form of configuration not seen earlier in our use of
  # Vagrant: it defines a particular named VM, which is necessary when
  # your Vagrantfile will start up multiple interconnected VMs.
  config.vm.define "webserver" do |webserver|
     webserver.vm.hostname = "webserver"

# This means that our host computer can
    # connect to IP address 127.0.0.1 port 8080, and that network
    # request will reach our webserver VM's port 80.
     webserver.vm.network "forwarded_port", guest: 80, host: 8080, host_ip: "127.0.0.1"

# Set up a private network that our VMs will use to communicate
    # with each other.
     webserver.vm.network "private_network", ip: "192.168.2.11"
            
# Sets up permissions for CS labs to access. 
    webserver.vm.synced_folder ".", "/vagrant", owner: "vagrant", group: "vagrant", mount_options: ["dmode=775,fmode=777"]
        

# Change VM's webserver's configuration to use shared folder.
        # (Look inside test-website.conf for specifics.)
        cp /vagrant/test-website.conf /etc/apache2/sites-available/
        # install our website configuration and disable the default
        a2ensite test-website
        a2dissite 000-default
        service apache2 reload
     SHELL
  end
 
  config.vm.define "dbserver" do |dbserver|
     dbserver.vm.hostname = "dbserver"
     dbserver.vm.network "private_network", ip: "192.168.2.12"
  
# Sets up permissions for CS labs to access. 
     dbserver.vm.synced_folder ".", "/vagrant", owner: "vagrant", group: "vagrant", mount_options: ["dmode=775,fmode=777"]


# Now we have a section specifying the shell commands to provision
    # the webserver VM. Note that the file test-website.conf is copied
    # from this host to the VM through the shared folder mounted in
    # the VM at /vagrant
     dbserver.vm.provision "shell", inline: <<-SHELL
      
# Update Ubuntu software packages.
	apt-get update
      
      # We create a shell variable MYSQL_PWD that contains the MySQL root password
       export MYSQL_PWD='insecure_mysqlroot_pw'

# If you run the `apt-get install mysql-server` command
      # manually, it will prompt you to enter a MySQL root
      # password. The next two lines set up answers to the questions
      # the package installer would otherwise ask ahead of it asking,
      # so our automated provisioning script does not get stopped by
      # the software package management system attempting to ask the
      # user for configuration information.
       echo "mysql-server mysql-server/root_password password $MYSQL_PWD" | debconf-set-selections 
       echo "mysql-server mysql-server/root_password_again password $MYSQL_PWD" | debconf-set-selections
       
# Install the MySQL database server.
       apt-get -y install mysql-server


# Run some setup commands to get the database ready to use.
      # First create a database.       
echo "CREATE DATABASE fvision;" | mysql
       

# Then create a database user "webuser" with the given password.
echo "CREATE USER 'webuser'@'%' IDENTIFIED BY 'insecure_db_pw';" | mysql
   
    
# Grant all permissions to the database user "webuser" regarding
      # the "fvision" database that we just created, above.
echo "GRANT ALL PRIVILEGES ON fvision.* TO 'webuser'@'%'" | mysql      
  
     
# Set the MYSQL_PWD shell variable that the mysql command will
      # try to use as the database password ...
export MYSQL_PWD='insecure_db_pw'
       

# ... and run all of the SQL within the setup-database.sql file,
      # which is part of the repository containing this Vagrantfile, so you
      # can look at the file on your host.
cat /vagrant/setup-database.sql | mysql -u webuser fvision

       
# By default, MySQL only listens for local network requests,
      # i.e., that originate from within the dbserver VM. We need to
      # change this so that the webserver VM can connect to the
      # database on the dbserver VM.
sed -i'' -e '/bind-address/s/127.0.0.1/0.0.0.0/' /etc/mysql/mysql.conf.d/mysqld.cnf
       

# We then restart the MySQL server to ensure that it picks up
      # our configuration changes.
service mysql restart
     SHELL
  end

  
end