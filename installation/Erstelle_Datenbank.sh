
(
echo 'DROP User IF EXISTS serienmails;'
echo 'CREATE USER "serienmails"@"%" IDENTIFIED BY "garnix";'
echo 'GRANT ALL PRIVILEGES ON *.* TO "serienmails"@"%" WITH GRANT OPTION;'

echo 'SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";'
echo 'SET AUTOCOMMIT = 0;'
echo 'START TRANSACTION;'
echo 'SET time_zone = "+02:00";'

echo 'DROP   DATABASE IF     EXISTS serienmails;'
echo 'CREATE DATABASE IF NOT EXISTS serienmails;'
echo 'USE serienmails;'

echo 'CREATE TABLE `events` ('
echo '  `name`        varchar(59) NOT NULL PRIMARY KEY,'
echo '  `inhalt_pfad` varchar(59) NOT NULL,'
echo '  `anhang_pfad` varchar(59)'
echo ') ENGINE=InnoDB DEFAULT CHARSET=latin1;'

echo 'CREATE TABLE `users` ('
echo '  `name`  char(59) NOT NULL PRIMARY KEY,'
echo '  `IP`    tinytext NOT NULL,'
echo '  `email` tinytext NOT NULL'
echo ') ENGINE=MyISAM DEFAULT CHARSET=latin1;'

echo 'CREATE TABLE `bestaetigung` ('
echo '  `events_name`char(59) NOT NULL PRIMARY KEY,'
echo '  `datum`      tinytext NOT NULL,' 
echo '  `IP`         tinytext NOT NULL,'
echo '  `Users_Name` tinytext NOT NULL'
echo ') ENGINE=InnoDB DEFAULT CHARSET=latin1';

) | mysql -h localhost -u serienmails --password="garnix"
#--password="Luca.1111" 
#Muell
#--  ALTER TABLE `events`
#--    MODIFY `name` char(59) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=0;
#--  ALTER TABLE `users`
#--    MODIFY `name` char(59) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=0;
#--  COMMIT;
