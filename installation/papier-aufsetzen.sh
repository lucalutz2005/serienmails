#DNS
Neuen DNS record anlegen als papier.lucalutz.org als 82.212.26.101 unter dynu.com 

#tbd Software installieren fuer dynamische IP
#IPS auf statisch stellen
#router weiterleitung konfigurieren

# Image besorgen
wget -O - https://downloads.raspberrypi.org/raspbian_lite_latest > /media/backup/raspbian_lite_latest-$(date +%m-%Y)
(cd /media/backup/; unzip                                          /media/backup/raspbian_lite_latest-$(date +%m-%Y))
sudo losetup -P /dev/loop0   /media/backup/2018-11-13-raspbian-stretch-lite.img
sudo  mount     /dev/loop0p1 /mnt/
sudo touch                   /mnt/ssh
sudo umount                  /mnt/
sudo losetup -d /dev/loop0
ls -l                        /media/backup/2018-11-13-raspbian-stretch-lite.img # das auf die Karte kopieren 

sudo raspi-config
#  |->  1 Change User Password -> Passwort eingeben
#  |-> 4 Localisation Options  -> I1 Change Locale  ->  de_DE@euro ISO-8859-15   
#  |-> 2 Network Options    ->  N1 Hostname -> papier

#Benutzer
  #Benutzer anlegen
  sudo adduser luca
  sudo adduser wirsing

  #Gruppen anlegen
  sudo addgroup papier

  #Benutzer gruppen zuweisen
  sudo usermod -a -G papier luca
  sudo usermod -a -G papier wirsing

#Platte
  #Ordner anlegen
  sudo mkdir /media/privat
  sudo mkdir /media/eltern
  sudo mkdir /media/jufo
  sudo mkdir /media/backup
  
  #Gruppe "Papier" admin rechte geben
  echo '%papier ALL=(ALL:ALL) ALL' >> /etc/sudoers
  
  #Rechte verwalten
  sudo chown luca:papier /media/*
  sudo chmod g+rwx /media/*
  sudo chmod o-rwx /media/*

#Startup
(
  echo '#!/bin/sh -e' 
  echo '# rc.local' 
  echo 'sudo mount /dev/sda6 /media/backup/' 
  echo 'sudo mount /dev/sda2 /media/eltern/' 
  echo 'sudo mount /dev/sda7 /media/jufo/' 
  echo '# sudo mount /dev/sda5 /media/MGHSY/' 
  echo 'sudo mount /dev/sda3 /media/privat/' 
  echo '_IP=$(hostname -I) || true' 
  echo 'if [ "$_IP" ]; then' 
  echo '  printf "My IP address is %s\n" "$_IP"' 
  echo 'fi' 
  echo 'exit 0' 
) >       /etc/rc.local 
chmod a+x /etc/rc.local

#Crontabs anlegen
echo '* * * * * /home/pi/Skripte/Datensammler.sh  >/dev/null 2>&1' > /tmp/cron-pi
crontab -u pi /tmp/cron-pi
rm            /tmp/cron-pi

echo '0 0 * * * /home/pi/Skripte/night.sh /home/* >/dev/null 2>&1'       > /tmp/cron-root
echo '0 * * * * /home/pi/Skripte/hour.sh /home/luca/*  >/dev/null 2>&1' >> /tmp/cron-root
crontab -u root /tmp/cron-root
rm              /tmp/cron-root
