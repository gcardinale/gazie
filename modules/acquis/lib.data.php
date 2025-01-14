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
function bodytextInsert ($newValue)
{
    $table = 'body_text';
    $columns = array('table_name_ref','id_ref','body_text','lang_id');
    $last_id=tableInsert($table, $columns, $newValue);
	  return $last_id;
}

function bodytextUpdate ($codice, $newValue)
{
    $table = 'body_text';
    $columns = array('table_name_ref','id_ref','body_text','lang_id');
    tableUpdate($table, $columns, $codice, $newValue);
}

function lotmagInsert($newValue)
{
    $table = 'lotmag';
    $columns = array('codart','id_movmag','id_rigdoc','identifier','expiry');
    $last_id=tableInsert($table, $columns, $newValue);
    return $last_id;
}

function expdocInsert($newValue)
{
    $table = 'expdoc';
    $columns = array('id_tes','ModalitaPagamento','DataScadenzaPagamento','ImportoPagamento');
    $last_id=tableInsert($table, $columns, $newValue);
    return $last_id;
}

?>