for L in $(echo "use serienmails; SELECT email FROM users" |  mysql -h localhost -u serienmails --password="garnix" | grep -v "name" | grep -v "email" ); do
        cd /home/luca/serienmails/webgui/	
	cp -p mail.txt /tmp/;
	name=$(echo 'use serienmails; SELECT name FROM users WHERE email = "'$L'"' |  mysql -h localhost -u serienmails --password="garnix"  | grep -v "name" | grep -v "email");
	echo "Variable: "$name","$L;
	echo "Bitte auf den Link https://lucalutz.org/bestaetigung.php?hash="$(echo $name  | md5sum | sed -e "s/-//g" | sed -e "s/ //g")" klicken" >> /tmp/mail.txt; 
	cat /tmp/mail.txt | sed -e "s/ANREDE/$name/g" | cat > /tmp/mail1.txt
	cat  /tmp/mail1.txt | mailx -s "Aktuelle Veranstaltung" $L
	rm /tmp/mail.txt
	rm /tmp/mail1.txt
	echo "An gesendet!" $L; 
done
