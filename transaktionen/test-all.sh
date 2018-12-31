(
cd /home/luca/serienmails/doku/transaktionen
./Erstelle_Datenbank.sh
echo "";
./lade_ein.sh '"Weihnachtsfeiher"' '"/tmp/einladung.txt"'


echo "";
echo 'USE serienmails; INSERT INTO `users` (`name`, `IP`, `email`) VALUES ("Luca Lutz",     "82.212.26.101",  "lucas.handy.1234@gmail.com");' | mysql -h localhost -u serienmails --password="garnix"
echo 'USE serienmails; INSERT INTO `users` (`name`, `IP`, `email`) VALUES ("Peter Wirsing", "87.155.20.175",  "pater.wirsing@gmx.de");'       | mysql -h localhost -u serienmails --password="garnix"
echo 'USE serienmails; INSERT INTO `users` (`name`, `IP`, `email`) VALUES ("Anita Lutz",    "225.103.40.164", "lutzens@kabelbw.de");'         | mysql -h localhost -u serienmails --password="garnix"
echo 'Benutzer: (Tabelle: Users)'
echo "USE serienmails; SELECT * FROM  users;"                                                                                                 | mysql -h localhost -u serienmails --password="garnix"
echo "";

)
