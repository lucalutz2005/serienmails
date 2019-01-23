#Nach anleitung unter https://easyengine.io/tutorials/linux/ubuntu-postfix-gmail-smtp/
#zuerst alles intallieren
sudo apt-get install postfix mailutils libsasl2-2 ca-certificates libsasl2-modules
#dann folgendes unten anhaengen:
vim /etc/postfix/main.cf
relayhost = [smtp.gmail.com]:587
smtp_sasl_auth_enable = yes
smtp_sasl_password_maps = hash:/etc/postfix/sasl_passwd
smtp_sasl_security_options = noanonymous
smtp_tls_CAfile = /etc/postfix/cacert.pem
smtp_use_tls = yes
#dann Vertrauliche daten in der folgenden Datei eingeben indem man 
[smtp.gmail.com]:587    USERNAME@gmail.com:PASSWORD 
#hinzufuegt und anpasst
vim /etc/postfix/sasl_passwd
#nun um Zertifikate kuemmern
sudo chmod 400 /etc/postfix/sasl_passwd
sudo postmap /etc/postfix/sasl_passwd
cat /etc/ssl/certs/Thawte_Premium_Server_CA.pem | sudo tee -a /etc/postfix/cacert.pem
#Postfix restarten
sudo /etc/init.d/postfix reload
#Testmail senden
echo "Test mail from postfix" | mail -s "Test Postfix" you@example.com
