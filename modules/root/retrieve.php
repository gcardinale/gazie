<?php
/*
 --------------------------------------------------------------------------
                            GAzie - Gestione Azienda
    Copyright (C) 2004-2023 - Aurora SRL Alia (PA)
         (http://www.aurorasrl.it)
           <http://gazie.sourceforge.net>
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
    scriva   alla   Free  Software Foundation, 51 Franklin Street,
    Fifth Floor Boston, MA 02110-1335 USA Stati Uniti.
 --------------------------------------------------------------------------
*/
require("../../library/include/datlib.inc.php");
$admin_aziend=checkAdmin();
$doc = gaz_dbi_get_row($gTables['files'],'id_doc',intval($_GET['id_doc']));
if ($doc['id_ref']==1) {
	$doc['id_doc']=$admin_aziend['company_id']."/images/".$doc['id_doc'];
} else {
	$doc['id_doc']=$admin_aziend['company_id']."/doc/".$doc['id_doc'];
}
header("Content-Type: application/".$doc['extension']);
header('Content-Disposition: attachment; filename="Doc_'.intval($_GET['id_doc']).'.'.$doc['extension'].'"');
// data retrieved from filesystem
$doc=file_get_contents(DATA_DIR.'files/'.$doc['id_doc'].'.'.$doc['extension']);
echo $doc;
?>
