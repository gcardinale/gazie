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
>>>>>> Aurora SRL -- MOSTRA Lotti  <<<<<<
 */
require("../../library/include/datlib.inc.php");
require("../../modules/vendit/lib.function.php");
$lm = new lotmag;
$gForm = new magazzForm;
$admin_aziend=checkAdmin();
$codice = filter_input(INPUT_GET, 'codice');
$lm -> getAvailableLots($codice,0,"",1);
$date = date("Y-m-d");
$artico = gaz_dbi_get_row($gTables['artico'], "codice", $codice);

// Aurora SRL - vedo se ci sono stati degli inventari fino alla data
//$rs_last_inventory = gaz_dbi_dyn_query("*", $gTables['movmag'], "artico = '$codice' AND caumag = 99 AND (datreg <= '" . $date . "')", "datreg DESC, id_mov DESC");
// Aurora SRL -gli inventari, adesso, vengono tolti direttamente nella function getAvailableLots

// Aurora SRL - la data di creazione del primo lotto per il dato articolo
$first_lot_date=gaz_dbi_get_row($gTables['movmag'], "artico", $codice, " AND id_lotmag > '1' AND caumag <> '99' AND operat = '1'", "MIN(datdoc)");
if (isset($first_lot_date)){
// Aurora SRL - controllo se ci sono articoli con movimenti di magazzino orfani del lotto
$where= $gTables['movmag'] . ".artico = '" . $codice. "' AND ". $gTables['movmag'] . ".id_lotmag < '1' AND ". $gTables['movmag'] . ".caumag <> '99' AND datdoc >= '". $first_lot_date ."'";
$resorf = gaz_dbi_dyn_query($gTables['movmag'] . ".artico,".
 $gTables['movmag'] . ".quanti,".
 $gTables['movmag'] . ".tipdoc,".
 $gTables['movmag'] . ".desdoc,".
 $gTables['movmag'] . ".datdoc,".
 $gTables['movmag'] . ".id_mov,".
 $gTables['rigdoc'] . ".id_tes,".
 $gTables['tesdoc'] . ".numdoc,".
 $gTables['tesdoc'] . ".numfat,".
 $gTables['tesdoc'] . ".protoc ",
 $gTables['movmag'] . " LEFT JOIN " . $gTables['rigdoc'] . " ON ". $gTables['movmag'] . ".id_rif = " . $gTables['rigdoc'] . ".id_rig ". " LEFT JOIN " . $gTables['tesdoc'] . " ON ". $gTables['rigdoc'] . ".id_tes = " . $gTables['tesdoc'] . ".id_tes ",$where, "datdoc ASC");
}
require("../../library/include/header.php");
$script_transl = HeadMain();

if (isset($_POST['close'])){
	foreach (glob("../../modules/camp/tmp/*") as $fn) {// prima cancello eventuali precedenti file temporanei
             unlink($fn);
    } // poi chiudo la finestra e esco
	echo "<script>window.close();</script>";exit;
}

?>
<!-- Visto che il tema LTE non funziona senza header (HeadMain) spengo i menù perché questo è un popup e i menù occuperebbero spazio -->
<style>
.content-header {
	display:none;
}
.main-sidebar {
	display:none;
}
.main-header{
	display:none;
}
.navbar {
	display:none;
}
</style>

<div align="center" class="FacetFormHeaderFont">Elenco lotti disponibili per <?php echo $codice," - ", substr($artico['descri'],0,60); ?></div>
<table class="Tlarge table table-striped table-bordered table-condensed table-responsive">
    	<thead>
            <tr class="FacetDataTD">
				<th align="center" >Id lotto
                </th>
                <th align="center" >Numero lotto
                </th>
				<th align="center" >Scadenza
                </th>
				<th align="center" >Disponibilità
                </th>
                <th align="center" >Certificato
                </th>
				<th align="center" >Entrati
                </th>
				<th align="center" >Usciti
                </th>
            </tr>
			</thead>
<?php
	foreach (glob("../../modules/camp/tmp/*") as $fn) {// prima cancello eventuali precedenti file temporanei
             unlink($fn);
    }
	$tot=0;
	if (count($lm->available) > 0) {
		$count=array();
        foreach ($lm->available as $v_lm) {
			// Aurora SRL - vedo quanti sono entrati
				$query="SELECT SUM(quanti) FROM ". $gTables['movmag'] . " WHERE artico='" .$codice. "' AND id_lotmag='" .$v_lm['id']. "' AND operat='1' AND caumag < '99'";
				$sum_in=gaz_dbi_query($query);
				$in =gaz_dbi_fetch_array($sum_in);
			// Aurora SRL - vedo quanti sono usciti
				$query="SELECT SUM(quanti) FROM ". $gTables['movmag'] . " WHERE artico='" .$codice. "' AND id_lotmag='" .$v_lm['id']. "' AND operat='-1' AND caumag < '99'";
				$sum_out=gaz_dbi_query($query);
				$out =gaz_dbi_fetch_array($sum_out);
			if ((intval($v_lm['expiry']))>0){
				$exp=gaz_format_date($v_lm['expiry']);
			} else {
				$exp="";
			}
			$key=$v_lm['identifier']." - ".$exp; // chiave per il conteggio dei totali raggruppati per lotto e scadenza
			if( !array_key_exists($key, $count) ){ // se la chiave ancora non c'è nell'array
				// Aggiungo la chiave con il rispettivo valore iniziale
				$count[$key] = $v_lm['rest'];
			} else {
				// Altrimenti, aggiorno il valore della chiave
				$count[$key] += $v_lm['rest'];
			}
			$tot+=$v_lm['rest'];
			$n=0;
			/* Aurora SRL - gli inventari, adesso, vengono tolti direttamente nella function getAvailableLots
			foreach ($rs_last_inventory as $idlot){ // se ci sono stati degli inventari che si riferiscono a quello specifico lotto, tolgo la quantità di ciascuno tranne l'ultimo fatto
				if (intval($n)>0){
					if ($idlot['id_lotmag']==$v_lm['id']){
						$v_lm['rest']=$v_lm['rest']-$idlot['quanti'];
						$count[$key]=$count[$key]-$idlot['quanti'];
						$tot=$tot-$idlot['quanti'];
					}
				}
				$n++;
			}*/
            $img="";
            echo '<tr class="FacetDataTD"><td class="FacetFieldCaptionTD">'
               . $v_lm['id']
               . '</td><td>' . $v_lm['identifier']. '</td>';
			   if (intval($v_lm['expiry']>0)){
				   echo '<td>' . gaz_format_date($v_lm['expiry']). '</td>';
			   } else {
				   echo '<td></td>';
			   }
               echo '<td>' . gaz_format_quantity($v_lm['rest'], 0, $admin_aziend['decimal_quantity'])
                .'</td><td>';

				If (file_exists(DATA_DIR.'files/' . $admin_aziend['company_id'])>0) {
					// recupero il filename
					$dh = opendir(DATA_DIR.'files/' . $admin_aziend['company_id']);
					while (false !== ($filename = readdir($dh))) {
						$fd = pathinfo($filename);
						$r = explode('_', $fd['filename']);
						if ($r[0] == 'lotmag' && $r[1] == $v_lm['id']) {
							// assegno il nome file a img
							$img = $fd['basename'];
							}
						}
						if (strlen($img)>0) {
							$tmp_file = DATA_DIR."files/".$admin_aziend['company_id']."/".$img;
							// sposto nella cartella di lettura il relativo file temporaneo
							copy($tmp_file, "../../modules/camp/tmp/".$img);
							echo '<img src="../../modules/camp/tmp/'.$img.'" alt="certificato lotto" width="50" border="1" style="cursor: -moz-zoom-in;" onclick="this.width=500;" ondblclick="this.width=50;" />';
							echo '<a class="btn btn-xs btn-default btn-elimina" href="../../modules/camp/tmp/'.$img.'" download><i class="glyphicon glyphicon-download"></i></a></td>';
							} else {
									echo '<i class="glyphicon glyphicon-eye-close"></i>';
								}
				}
				echo '<td>' . gaz_format_quantity($in['SUM(quanti)'], 0, $admin_aziend['decimal_quantity'])
                .'</td>';
				echo '<td>' . gaz_format_quantity($out['SUM(quanti)'], 0, $admin_aziend['decimal_quantity'])
                .'</td>';
        }
?>
		</table>
		<div class="panel panel-default gaz-table-form">
			<div class="container-fluid">
				<div class="row">
					<div class="form-group">
						<div class="col-md-12">
							<div class="text-center"><b>Totale disponibilità per lotti raggruppati</b>
							</div>
						</div>
					</div>
				</div><!-- chiude row  -->
				<?php
				foreach($count as $key => $val){
					?>
					<div class="row">
						<div class="form-group">
							<div class="col-sm-6">
							<?php
							echo "<b>Lotto:</b> ",$key;
							?>
							</div>
							<div class="col-sm-6">
							<?php
							echo "<b>Disponibile:</b> ",$val;
							?>
							</div>
						</div>
					</div><!-- chiude row  -->
					<?php
				}
				?>
				<div class="row">
						<div class="form-group">
							<div class="col-sm-6">
							<?php
							echo "<b>Totale prodotto disponibile:</b> ";
							?>
							</div>
							<div class="col-sm-6">
							<?php
							echo $tot;
							?>
							</div>
						</div>
					</div>
			</div>
		</div>
		<?php

		if ($resorf->num_rows>0){
		?>
		<div class="panel panel-default gaz-table-form">
			<div class="container-fluid">
				<div class="row">
					<div class="form-group">
						<div class="col-md-12">
							<div class="text-center"><b>Movimenti orfani di lotto</b>
							</div>
						</div>
					</div>
				</div><!-- chiude row  -->
				<?php
				foreach($resorf as $orf){
					?>
					<div class="row">
						<div class="form-group">
							<div class="col-sm-3">
							<?php
							echo "<b>Q.tà:</b> ",gaz_format_quantity($orf['quanti']);
							?>
							</div>
							<div class="col-sm-3">
							<?php
							echo "<b>tipo doc.:</b> ",$orf['tipdoc'];
							?>
							</div>
							<div class="col-sm-3">
							<?php
							echo "<b>ID:</b> ",$orf['id_tes'];
							?>
							</div>
							<div class="col-sm-3">
							<?php
							echo "<b>Prot:</b> ",$orf['protoc'];
							?>
							</div>
							<div class="col-sm-2">
							<?php
							echo "<b>Rif.:</b> ",$orf['numdoc']," - ",$orf['numfat'];
							?>
							</div>
							<div class="col-sm-3">
							<?php
							echo "<b>Del:</b> ",gaz_format_date($orf['datdoc']);
							?>
							</div>
							<div class="col-sm-7">
							<?php
							if ($orf['tipdoc']=="AFA" || $orf['tipdoc']=="AFT" || $orf['tipdoc']=="ADT"){
								echo "<b>Descr.: </b><a class=\"btn btn-xs btn-default\" href=\"../acquis/admin_docacq.php?Update&id_tes=".$orf['id_tes']."\">".$orf['desdoc']."</a>";
								echo "<b> Mov.mag.: </b><a class=\"btn btn-xs btn-default\" href=\"../magazz/admin_movmag.php?id_mov=".$orf['id_mov']."&Update\">".$orf['id_mov']."</a>";

							} else if ($orf['tipdoc']=="VRI" or $orf['tipdoc']=="DDT" or $orf['tipdoc']=="FAI" or $orf['tipdoc']=="FAD"){
									echo "<b>Descr.: </b><a class=\"btn btn-xs btn-default\" href=\"../vendit/admin_docven.php?Update&id_tes=".$orf['id_tes']."\">".$orf['desdoc']."</a>";
									echo "<b> Mov.mag.: </b><a class=\"btn btn-xs btn-default\" href=\"../magazz/admin_movmag.php?id_mov=".$orf['id_mov']."&Update\">".$orf['id_mov']."</a>";
								} else {
									echo "<b>Descr.: </b>".$orf['desdoc'];
								}
							?>
							</div>
						</div>
					</div><!-- chiude row  -->
					<?php
				}
				?>
			</div>
		</div>
		<?php
		}
	} else {
		echo '<div><button class="btn btn-xs btn-danger" type="image" >Non ci sono lotti disponibili.</button></div>';
    }
	?>
	<form method="post" name="closewindow">
	<div>
	<a class="btn btn-info btn-md" title="Stampa tutti i movimenti per ciascun lotto" href="../../modules/magazz/stampa_lotti.php?codice=<?php echo $codice;?>" style="float:left"><span class="glyphicon glyphicon-print"></span></a>
	<button class="btn btn-info btn-md" type="submit" title="Elimina file temporanei e chiudi finestra" name="close" style="float:right"><span class="glyphicon glyphicon-remove"></span>
	</button>
	</div>
	</form>
