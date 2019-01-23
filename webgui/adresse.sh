# $1 ist der Name des Events bitte per php uebergeben

for EMAIL in $(echo "use serienmails; SELECT user_email FROM einladungen WHERE antwort IS NULL" |  mysql -h localhost -u serienmails --password="garnix" | grep -v "name" | grep -v "email" ); do
	
	NAME=$(echo 'use serienmails; SELECT name FROM users WHERE email = "'$EMAIL'"' |  mysql -h localhost -u serienmails --password="garnix"  | grep -v "name" | grep -v "email");
	ADRESSE1=$(echo 'use serienmails; SELECT Adresse1 FROM users WHERE email = "'$EMAIL'"' |  mysql -h localhost -u serienmails --password="garnix"  | grep -v "Adresse1" | grep -v "email");
	ADRESSE2=$(echo 'use serienmails; SELECT Adresse2 FROM users WHERE email = "'$EMAIL'"' |  mysql -h localhost -u serienmails --password="garnix"  | grep -v "Adresse2" | grep -v "email");
	ID=$(echo 'use serienmails; SELECT id FROM users WHERE email = "'$EMAIL'"' |  mysql -h localhost -u serienmails --password="garnix"  | grep -v "id" | grep -v "email");
	HASH=$(echo $NAME + $RAMDOM + $1 | md5sum | sed -e "s/-//g" | sed -e "s/ //g");	
	EVENT=$1;
	#echo "Variable: "$NAME", "$ADRESSE1", "$ADRESSE2", "$EVENT;

	touch /tmp/mail.txt;
	echo $ADRESSE1 >> /tmp/mail.txt; 
	echo $ADRESSE2 >> /tmp/mail.txt; 
	echo "" >> /tmp/mail.txt;
	echo "" >> /tmp/mail.txt;
	cp -p /home/luca/serienmails/webgui/inhalte/$1 /tmp/mail1.txt;
	cat /tmp/mail1.txt >> /tmp/mail.txt;
	echo "" >> /tmp/mail.txt;
	rm /tmp/mail1.txt;
	SYNTAX="mv /tmp/mail.txt /home/luca/serienmails/webgui/adressen/$EVENT/$ID.txt"
	#mv /tmp/mail.txt /home/luca/serienmails/webgui/adressen/$(echo $1)/$(echo $NAME).txt
	
	echo $SYNTAX | bash;
	#mv /tmp/mail.txt adressen/$EVENT/$ID.txt
	#echo 'use serienmails; DELETE FROM einladungen WHERE "user_email" = "'$EMAIL'"'  |  mysql -h localhost -u serienmails --password="garnix";
	#echo 'use serienmails; DELETE FROM events WHERE name = "'$EVENT'"'  |  mysql -h localhost -u serienmails --password="garnix";
	ZIP="zip /home/luca/serienmails/webgui/adressen/smt/$EVENT.zip /home/luca/serienmails/webgui/adressen/$EVENT/*"
	echo $ZIP | bash;
done
