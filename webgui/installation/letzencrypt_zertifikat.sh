# https://www.sslforfree.com/

echo "deb http://mirrordirector.raspbian.org/raspbian/ jessie main contrib non-free rpi" >> /etc/apt/sources.list
sudo apt install apache2 php5 postfix squirrelmail
sudo apt install dovecot-imapd dovecot-pop3d

echo "ssl = yes" >> /etc/dovecot/dovecot.conf
echo "ssl_cert = </etc/ssl/server.crt" /etc/dovecot/dovecot.conf
echo "ssl_key = </etc/ssl/server.key"/etc/dovecot/dovecot.conf

echo 'erstens 2'
echo 'zweitens 1'
echo 'drittens "papier.lucalutz.org"'
echo 'viertens "R"'
echo 'fuenftens 4'
echo 'sextens 11'
echo 'siebtens "y"'
echo 'achens "S"'
echo 'Neuntens "Q"'
sudo squirrelmail-configure

sudo cp /etc/squirrelmail/apache.conf /etc/apache2/sites-available/squirrelmail.conf
sudo a2ensite squirrelmail.conf

sudo useradd testmail
echo 'password: testpass'
sudo passwd testmail

sudo mkdir -p /var/www/html/testmail
usermod -m -d /var/www/html/testmail testmail

sudo chown -R testmail:testmail /var/www/html/testmail

echo 'Auf https://www.sslforfree.com/ gehen und papier.lucalutz.org eingeben dann mannuele verification und die dateien downloaden und an gewuenschtm Pfad ablegen und die Files downloaden'

# Beta Letsencrypt zertigikat selbst generiren
#sudo apt-get install git
#cd ~
#git clone https://github.com/letsencrypt/letsencrypt
#cd letsencrypt
#sudo ./letsencrypt-auto -d papier.lucalutz.org -d www.papier.lucalutz.org --redirect -m lucas.handy.1234@gmail.com


#echo ''
#echo ''
#echo ''
#echo ''
#letsencrypt certonly -d papier.lucalutz.org
#sudo openssl rsa -outform der -in /etc/letsencrypt/live/papier.lucalutz.org/privkey.pem -out private.key
#sudo openssl x509 -outform der -in /etc/letsencrypt/live/papier.lucalutz.org/privkey.pem -out your-cert.crt

/etc/init.d/dovecot restart
