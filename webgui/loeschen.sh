for EMAIL in $(echo "use serienmails; SELECT user_email FROM einladungen WHERE antwort IS NULL" |  mysql -h localhost -u serienmails --password="garnix" | grep -v "name" | grep -v "email" ); do
        EVENT=$1;
	
	echo 'use serienmails; DELETE FROM "einladungen" WHERE "event_name" = "'$EVENT'"'  |  mysql -h localhost -u serienmails --password="garnix";
	echo 'use serienmails; DELETE FROM "events" WHERE name = "'$EVENT'"'  |  mysql -h localhost -u serienmails --password="garnix";
done
