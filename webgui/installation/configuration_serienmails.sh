#alles installieren
sudo apt install -y apache2 php7.0 libapache2-mod-php libapache2-mod-php7.0
sudo apt install -y mariadb-server mariadb-client mysql-common
sudo service mysql start
sudo apt install install php7.3-mbstring
sudo apt install phpmyadmin # server apache2 passwort leer lassen
#sudo apt install -y mysql-server mysql-client phpmyadmin
sudo apt install -y git

#PHPMyAdmin zu apache2 hinzufuegen
sudo ln -s /usr/share/phpmyadmin /var/www/html
sudo -i
  echo 'Include /etc/phpmyadmin/apache.conf' >> sudo /etc/apache2/apache2.conf

#Datenbanken und 'serienmails' benutzer anlegen
#sudo mysql < ./counfigure_mysql.sql
sudo ./Erstelle_Datenbank.sh

#services reloaden
sudo service apache2 restart

#Bei git anmelden
git config --global user.email "lucas.handy.1234@gmail.com"
git config --global user.name "Luca Lutz"

#Aus git clonen
(
  sudo cd /var/www/html/
  sudo mv index.html /tmp/
  sudo git clone https://lucalutz@bitbucket.org/lucalutz/serienmails.git
  sudo chown www-data:www-data $(find)
  sudo chmod o-wx $(find)
  sudo chmod ug+rwx $find)
)

#Webgui verlinken - nur auf papier
#sudo ln -s /media/jufo/serienmails/webgui/ /var/www/html/
