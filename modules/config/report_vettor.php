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
require("../../library/include/header.php");
$script_transl=HeadMain('','','admin_vettore');
?>
<script>
$(function() {
	$("#dialog_delete").dialog({ autoOpen: false });
	$('.dialog_delete').click(function() {
		$("p#idcodice").html($(this).attr("ref"));
		$("p#iddescri").html($(this).attr("ragso"));
		var id = $(this).attr('ref');
		$( "#dialog_delete" ).dialog({
			minHeight: 1,
			width: "auto",
			modal: "true",
			show: "blind",
			hide: "explode",
			buttons: {
   			close: {
					text:'Non eliminare',
					'class':'btn btn-default',
          click:function() {
            $(this).dialog("close");
          }
        },
				delete:{
					text:'Elimina',
					'class':'btn btn-danger',
					click:function (event, ui) {
					$.ajax({
						data: {'type':'vettor',ref:id},
						type: 'POST',
						url: '../config/delete.php',
						success: function(output){
							window.location.replace("./report_vettor.php");
						}
					});
				}}
			}
		});
		$("#dialog_delete" ).dialog( "open" );
	});
});
</script>
<div style="display:none" id="dialog_delete" title="Conferma eliminazione">
	<p><b>Vettore:</b></p>
	<p>Codice:</p>
	<p class="ui-state-highlight" id="idcodice"></p>
	<p>Ragione sociale:</p>
	<p class="ui-state-highlight" id="iddescri"></p>
</div>
<div align="center" class="FacetFormHeaderFont"><?php echo $script_transl['report']; ?></div>
<?php
$recordnav = new recordnav($gTables['vettor'], $where, $limit, $passo);
$recordnav -> output();
?>
<div class="table-responsive"><table class="Tlarge table table-striped table-bordered table-condensed">
<?php
$headers_vettor = array  (
              $script_transl['codice'] => "codice",
              $script_transl['ragso1'] => "ragione_sociale",
              $script_transl['citspe'] => "citta",
              $script_transl['telefo'] => "telefo",
              $script_transl['delete'] => ""
              );
$linkHeaders = new linkHeaders($headers_vettor);
$linkHeaders -> output();
$result = gaz_dbi_dyn_query ('*', $gTables['vettor'], $where, $orderby, $limit, $passo);
while ($a_row = gaz_dbi_fetch_array($result)) {
	$rs_check_doc = gaz_dbi_dyn_query("id_tes", $gTables['tesdoc'], "vettor = '{$a_row['codice']}'", "id_tes", 0, 1);
  $check_doc = gaz_dbi_num_rows($rs_check_doc);
  echo "<tr class=\"FacetDataTD\">";
  echo "<td align=\"center\"><a class=\"btn btn-xs btn-edit\" href=\"admin_vettore.php?Update&codice=".$a_row["codice"]."\"><i class=\"glyphicon glyphicon-edit\"></i>&nbsp;".$a_row["codice"]."</a> &nbsp</td>";
  echo "<td>".$a_row["ragione_sociale"]." &nbsp;</td>";
  echo "<td align=\"center\">".$a_row["citta"]." &nbsp;</td>";
  echo "<td align=\"center\">".$a_row["telefo"]." &nbsp;</td>";
  echo "<td align=\"center\">";
  if ($check_doc > 0 ){
		?>
		<button title="Impossibile cancellare perché usato sui documenti" class="btn btn-xs btn-default btn-elimina disabled"><i class="glyphicon glyphicon-remove"></i></button>
		<?php
	} else {
		?>
		<a class="btn btn-xs btn-default btn-elimina dialog_delete" title="Cancella il vettore" ref="<?php echo $a_row['codice'];?>" ragso="<?php echo $a_row['ragione_sociale'];?>">
			<i class="glyphicon glyphicon-remove"></i>
		</a>
		<?php
	}
  echo "</td></tr>";
}
?>
</table></div>
<?php
require("../../library/include/footer.php");
?>
