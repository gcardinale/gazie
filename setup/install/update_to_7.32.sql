UPDATE `gaz_config` SET `cvalue` = '127' WHERE `id` =2;
-- START_WHILE ( questo e' un tag che serve per istruire install.php ad INIZIARE ad eseguire le query seguenti su tutte le aziende dell'installazione)
UPDATE `gaz_admin` SET `style`='default.css',`skin`='default.css' WHERE 1;
ALTER TABLE `gaz_breadcrumb` ADD COLUMN `grid_class` VARCHAR(127) NOT NULL DEFAULT '' AFTER `icon`;
-- STOP_WHILE ( questo e' un tag che serve per istruire install.php a SMETTERE di eseguire le query su tutte le aziende dell'installazione)