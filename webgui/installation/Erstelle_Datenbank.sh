
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
echo ') ENGINE=InnoDB DEFAULT CHARSET=latin1'

#echo 'CREATE TABLE `einladungen` ('
#echo '`user_email` VARCHAR(100) NOT NULL,'
#echo '`event_name` VARCHAR(100) NOT NULL,'
#echo '`antwort` INT(100) NULL DEFAULT NULL,'
#echo '`IP` VARCHAR(100) NOT NULL ,'
#echo '`Uhrzeit` DATETIME on update CURRENT_TIMESTAMP NULL DEFAULT NULL,'
#echo '`hash` VARCHAR(100) NOT NULL'
#echo ') ENGINE = InnoDB;';
#
#
#echo 'ALTER TABLE `einladungen` CHANGE `IP` `IP` VARCHAR(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL;'
#echo 'ALTER TABLE `einladungen` ADD `user_name` VARCHAR(100) NOT NULL AFTER `user_email`;'

echo 'CREATE TABLE `einladungen` ('
echo '  `user_email` varchar(100) NOT     NULL,'
echo '  `user_name`  varchar(100) NOT     NULL,'
echo '  `event_name` varchar(100) NOT     NULL,'
echo '  `antwort`        int(100) DEFAULT NULL,'
echo '  `IP`         varchar(100) DEFAULT NULL,'
echo '  `Uhrzeit`        datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,'
echo '  `hash`       varchar(100) NOT     NULL'
echo ') ENGINE=InnoDB DEFAULT CHARSET=latin1;'

) | mysql -h localhost -u serienmails --password="garnix"
#--password="Luca.1111" 
#Muell
#--  ALTER TABLE `events`
#--    MODIFY `name` char(59) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=0;
#--  ALTER TABLE `users`
#--    MODIFY `name` char(59) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=0;
#--  COMMIT;
