<?php
/*
	  --------------------------------------------------------------------------
	  GAzie - Gestione Azienda
	  Copyright (C) 2004-2023 - Aurora SRL Alia (PA)
	  (http://www.aurorasrl.it)
	  <http://gazie.sourceforge.net>
	  --------------------------------------------------------------------------
	  Vacation Rental è un modulo creato per GAzie da Aurora SRL, Alia PA
	  Copyright (C) 2018-2021 - Aurora SRL, Alia (PA)
	  http://www.aurorasrl.it
	  https://www.aurorasrl.it
	  --------------------------------------------------------------------------
	  Questo programma e` free software;   e` lecito redistribuirlo  e/o
	  modificarlo secondo i  termini della Licenza Pubblica Generica GNU
	  come e` pubblicata dalla Free Software Foundation; o la versione 2
	  della licenza o (a propria scelta) una versione successiva.

	  Questo programma  e` distribuito nella speranza  che sia utile, ma
	  SENZA   ALCUNA GARANZIA; senza  neppure  la  garanzia implicita di
	  NEGOZIABILITA` o di  APPLICABILITA` PER UN  PARTICOLARE SCOPO.  Si
	  veda la Licenza Pubblica Generica GNU per avere maggiori dettagli.

	  Ognuno dovrebbe avere   ricevuto una copia  della Licenza Pubblica
	  Generica GNU insieme a   questo programma; in caso  contrario,  si
	  scriva   alla   Free  Software Foundation,  Inc.,   59
	  Temple Place, Suite 330, Boston, MA 02111-1307 USA Stati Uniti.
	  --------------------------------------------------------------------------
	  # free to use, Author name and references must be left untouched  #
	  --------------------------------------------------------------------------
*/
//upgrade database per il modulo CAMP - registro di campagna
$dbname = constant("Database");
global $table_prefix;

// da qui in poi iserire le query che saranno eseguite su ogni azienda con il modulo attivo

/*  >>> esempio di come vanno impostate le query il numero [147] rappresenta la versione dell'update di GAzie
$upgrade_db[147][]="ALTER TABLE ".$table_prefix."_XXXrental_discounts ADD `test2` TINYINT(2) NOT NULL DEFAULT '0' COMMENT 'test update 2';";
*/

$upgrade_db[148][]="ALTER TABLE ".$table_prefix."_camp_fitofarmaci ADD INDEX(`PRODOTTO`);";


?>
