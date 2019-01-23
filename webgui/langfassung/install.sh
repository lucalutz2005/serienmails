#alles installieren
sudo apt install -y apache2 php7.0 libapache2-mod-php libapache2-mod-php7.0
sudo apt install -y mariadb-server mariadb-client mysql-common
sudo service mysql start
sudo apt install install php7.3-mbstring
sudo apt install phpmyadmin # server apache2 passwort leer lassen
#sudo apt install -y mysql-server mysql-client phpmyadmin
sudo apt install -y git

cat  /tmp/mail1.txt | mailx -s "Aktuelle Veranstaltung" $EMAIL
