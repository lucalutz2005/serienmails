#!/bin/bash
hallo='USE serienmails; INSERT INTO `events` (`name`, `inhalt_pfad`, `anhang_pfad`) VALUES ('$1', '$2', NULL);';
echo 'USE serienmails; INSERT INTO `events` (`name`, `inhalt_pfad`, `anhang_pfad`) VALUES ('$1', '$2', NULL);'             | mysql -h localhost -u serienmails --password="garnix"
echo 'Veranstaltungen: (Tabelle: Events)'
echo "USE serienmails; SELECT * FROM  events;"                                                            | mysql -h localhost -u serienmails --password="garnix"
