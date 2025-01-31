<?php
/*
    --------------------------------------------------------------------------
  GAzie - MODULO 'VACATION RENTAL'
  Copyright (C) 2022-2023 - Aurora SRL, Alia (PA)
  (http://www.programmisitiweb.lacasettabio.it)

  --------------------------------------------------------------------------
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
include_once("manual_settings.php");
if ($_GET['token'] == md5($token.date('Y-m-d'))){
  //require("../../library/include/datlib.inc.php");
  include ("../../config/config/gconfig.myconf.php");

  include_once("manual_settings.php");
  $azTables = constant("table_prefix").$idDB;
  $IDaz=preg_replace("/[^1-9]/", "", $azTables );

  $servername = constant("Host");
  $username = constant("User");
  $pass = constant("Password");
  $dbname = constant("Database");
  $genTables = constant("table_prefix")."_";

  // Create connection
  $link = mysqli_connect($servername, $username, $pass, $dbname);
  // Check connection
  if (!$link) {
      die("Connection DB failed: " . mysqli_connect_error());
  }
  $link -> set_charset("utf8");
  $data = array();

  if(isset($_GET['id'])){
    $sql = "SELECT * FROM ".$azTables."rental_events WHERE house_code='".substr(mysqli_escape_string($link,$_GET['id']), 0, 32)."' AND (start >= '".date('Y-m-d')."' OR end >= '".date('Y-m-d')."') ORDER BY id ASC";
    $result = mysqli_query($link, $sql);
    if (isset($result)){
    foreach($result as $row){
      $data[] = array(
      'id'   => $row["id"],
      'title'   => addslashes($row["title"]),
      'start'   => $row["start"],
      'end'   => $row["end"]
      );
    }
    }
    echo json_encode($data);
  }
}
?>
