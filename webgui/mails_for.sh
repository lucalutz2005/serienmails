# $1 ist der Name des Events bitte per php uebergeben

for EMAIL in $(echo "use serienmails; SELECT email FROM users" |  mysql -h localhost -u serienmails --password="garnix" | grep -v "name" | grep -v "email" ); do
	
	NAME=$(echo 'use serienmails; SELECT name FROM users WHERE email = "'$EMAIL'"' |  mysql -h localhost -u serienmails --password="garnix"  | grep -v "name" | grep -v "email");
	HASH=$(echo $NAME + $RAMDOM + $1 | md5sum | sed -e "s/-//g" | sed -e "s/ //g");	
	echo "Variable: "$NAME","$EMAIL","$HASH;

	#cp -p /home/luca/serienmails/webgui/mail.txt /tmp/mail.txt;
	cp -p /home/luca/serienmails/webgui/inhalte/$1 /tmp/mail.txt;
	echo "" >> /tmp/mail.txt;
	echo "" >> /tmp/mail.txt;
	echo "Bitte auf den Link https://lucalutz.org/webgui/bestaetigung.php?hash=$HASH&signup= klicken" >> /tmp/mail.txt; 
	echo 'use serienmails; INSERT INTO `einladungen` (`user_email`, `user_name`, `event_name`, `antwort`,`IP` ,`hash`) VALUES ("'$EMAIL'"," '$NAME' ","'$1'", NULL, NULL,"'$HASH'");' |  mysql -h localhost -u serienmails --password="garnix"

        cat /tmp/mail.txt   | sed -e "s/ANREDE/$name/g" | cat > /tmp/mail1.txt
	echo ""  >> /tmp/mail1.txt
	cat  /tmp/mail1.txt | mailx -s "Aktuelle Veranstaltung" $EMAIL
        rm /tmp/mail.txt
        rm /tmp/mail1.txt
        echo "An gesendet!" $EMAIL; 
done
