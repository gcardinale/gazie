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

$strScript = array("report_letter.php" =>
    array("Letters Report ",
        "Date ",
        "Number ",
        "Type ",
        "Company name ",
        "Object ",
        "Write new letter",
        'mail_alert0' => 'Invio lettera con email',
        'mail_alert1' => 'Hai scelto di inviare una e-mail all\'indirizzo: ',
        'mail_alert2' => 'con allegato la seguente lettera:'),
    "admin_letter.php" =>
    array('title' => " Letter ",
        'mesg' => array('The search yielded no results!',
            'Insert at least 2 characters!',
            'Changing customer'
        ),
        array("LET" => " Normal ", "DIC" => "Declaration", "SOL" => " Sollecito ", "PRE" => " Preventivo " ),
        " of ",
        " at ",
        " number ",
        "Object ",
        "to the kind attention ",
        "affix user signature ",
        "Type ",
        "Body ",
        "User Name",
        "The date is not corrected!",
        "You must select a customer or a supplier!"
    ),
    "update_control.php" =>
    array('title' => " Check for updates ",
        'new_ver1' => 'It\'s available upgrade to new version (',
        'new_ver2' => ') of GAzie! <br>To upgrade you can download files from: ',
        'is_align' => 'No new updates. This version is updated to the latest available GAzie.',
        'no_conn' => 'There are problems connecting to the server to version control!',
        'disabled' => 'The latest version control has been disabled. You can reactivate it by choosing one of the services available to check the following sites',
        'zone' => 'Zone',
        'city' => 'City',
        'sms' => 'SMS',
        'web' => 'WEB',
        'choice' => 'CHOICE',
        'check_value' => array(0 => 'Enable!', 1 => 'Enabled'),
        'check_title_value' => array(0 => 'Enable version control from this site!', 1 => 'Disable version control from this site!'),
        'all_disabling' => array(0 => 'Disable all!', 1 => 'Disable all sites for Version Control!')
    ),
    "gazie_site_update.php" =>
    array('title' => "Aggiornamento del sito web",
        'errors' => array('Il server non &egrave; stato trovato',
            'Impossibile fare il login, credenziali errate',
            'Direttorio inesistente',
            'Uno o pi&ugrave; file non sono stati aggiornati'
        ),
        'server' => 'Nome del server FTP es: ftp.devincentiis.it',
        'user' => 'User - Nome utente per l\'autenticazione',
        'pass' => 'Password per l\'autenticazione',
        'path' => 'Directory radice del sito es. public_html/ opp. www/',
        'head_title' => 'Descrizione aggiuntiva al titolo',
        'head_subtitle' => 'Descrizione aggiuntiva al sottotitolo',
        'author' => 'Autore del sito (meta author)',
        'keywords' => 'Parole chiave del sito (meta keywords)',
        'listin' => 'Pubblicazione',
        'listin_value' => array(0 => 'Non pubblicare il listino', 1 => 'Listino senza prezzi', 2 => 'Listino con prezzi online'),
        'addpage' => 'Aggiungi pagina al sito'
    ),
    "gaziecart_update.php" =>
    array('title' => "Updating the online catalog, GAzieCart extension for Joomla!",
        'errors' => array('FTP server not found',
            'Authentication: the credentials are incorrect',
            'Directory not found',
            'One or more files were not updated'
        ),
        'server' => 'Name of FTP server Ex: devincentiis.it',
        'user' => 'User - User name for authentication',
        'pass' => 'Password for authentication',
        'path' => 'Joomla root directory Ex: joomla/ or nothing',
        'listin' => 'Price list',
        'listin_value' => array(1 => ' of sales 1', 2 => ' of sales 2', 3 => ' of sales 3', 'web' => 'of web sales')
    ),
    "backup.php" =>
    array('title' => "Store up data to avoid losing work!",
        'errors' => array(),
        'instructions' => 'Add the following statements',
        'table_selection' => 'Backup of',
        'table_selection_value' => array(0 => ' all tables of database ', 1 => ' only tables with prefix '),
        'text_encoding' => 'Encoding',
        'sql_submit' => 'Generate sql file',
    ),
    "report_backup.php" =>
    array('title' => "Lista dei backup interni ",
        'errors' => array(),
        'id' => 'Identificativo',
        'name' => 'Nome file',
        'size' => 'Dimensione',
        'rec' => 'Ripristina',
        'dow' => 'Scarica',
        'del' => 'Elimina',
        'backup_mode' => 'Modalità di backup',
        'backup_mode_value' => array('automatic' => 'Automatico', 'internal' => 'Interno', 'external' => 'Download')
    ),
    "report_anagra.php" =>
    array('title' => "Anagrafiche comuni"
    ),
    "admin_anagra.php" =>
    array('title' => 'Modifica anagrafica comune',
        'err' => array('ragso1' => '&Egrave; necessario indicare la Ragione Sociale',
            'indspe' => '&Egrave; necessario indicare l\'indirizzo',
            'capspe' => 'Il codice di avviamento postale (CAP) &egrave; sbagliato',
            'citspe' => '&Egrave; necessario indicare la citt&agrave;',
            'prospe' => '&Egrave; necessario indicare la provincia',
            'sexper' => '&Egrave; necessario indicare il sesso',
            'pf_no_codfis' => 'Codice fiscale sbagliato per una persona fisica',
            'pariva' => 'La partita IVA &egrave; formalmente errata!',
            'same_pariva' => 'Esiste gi&agrave una anagrafica con la stessa Partita IVA',
            'codfis' => 'Il codice fiscale &egrave; formalmente errato',
            'same_codfis' => 'Esiste gi&agrave; una anagrafica con lo stesso Codice Fiscale',
            'pf_ins_codfis' => 'E\' una persona fisica, inserire il codice fiscale',
            'datnas' => 'La data di nascita &egrave; sbagliata',
            'pec_email' => 'Indirizzo posta elettronica certificata formalmente sbagliato',
            'e_mail' => 'Indirizzo email formalmente sbagliato',
            'cf_pi_set' => 'E\' stata impostato un codice fiscale uguale alla partita IVA, se giusto, conferma nuovamente la modifica',
        ),
        'id' => "Codice ",
        'ragso1' => "Ragione sociale 1",
        'ragso1_placeholder' => "opp. nome cognome legale rappresentante",
        'ragso2' => "Ragione sociale 2",
        'sedleg' => 'Sede legale',
        'legrap_pf_nome' => 'Legale rappresentante',
        'legrap_pf_title' => "la ragione sociale lasciata vuota verrà riempita con questi campi",
        'luonas' => 'Luogo di nascita',
        'datnas' => 'Data di Nascita',
        'pronas' => 'Provincia di nascita',
        'counas' => 'Nazione di Nascita',
        'id_language' => 'Lingua',
        'id_currency' => 'Valuta',
        'sexper' => "Sesso/pers.giuridica ",
        'sexper_value' => array('' => '-', 'M' => 'Maschio', 'F' => 'Femmina', 'G' => 'Giuridica'),
        'indspe' => 'Indirizzo',
        'capspe' => 'Codice Postale',
        'citspe' => 'Citt&agrave; - Provincia',
        'prospe' => 'Provincia',
        'country' => 'Nazione',
        'latitude' => 'Latitudine',
        'longitude' => 'Longitudine',
        'telefo' => 'Telefono',
        'fax' => 'Fax',
        'cell' => 'Cellulare',
        'codfis' => 'Codice Fiscale',
        'pariva' => 'Partita IVA',
        'fe_cod_univoco' => 'Cod.Univoco Destinatario (fatt.elettronica)',
        'pec_email' => 'Posta Elettronica Certificata',
        'e_mail' => 'e mail',
        'fatt_email' => 'Invio fattura:',
        'fatt_email_value' => array(0 => 'No, solo stampa PDF', 1 => 'In formato PDF su email', 2 => 'In formato XML su PEC', 3 => 'In formato PDF su email + XML su PEC')
    ),
	"report_municipalities.php" =>
    array('title' => 'Lista dei comuni',
        'id' => "ID",
        'name' => "Nome",
        'id_province' => "Provincia",
        'postal_code' => "Codice postale",
        'dialing_code' => "Prefisso tel.",
        'insert_mun' => 'Inserisci un nuovo comune',
		'name_search'=>'aggiungi "%" e invia per ricerca, oppure seleziona'
    ),
	"admin_municipalities.php" =>
    array('title' => 'Gestione archivio dei comuni',
        'ins_this' => "Inserimento nuovo comune",
        'upd_this' => "Modifica il comune con ID:",
        'err' => array('name' => '&Egrave; necessario indicare il nome del comune',
            'postal_code' => '&Egrave; necessario indicare il codice postale',
            'email' => 'L\'indirizzo e-mail è sbagliato',
            'web_url' => 'L\'indirizzo del sito web è sbagliato'
        ),
        'id' => "ID",
        'name' => "Nome",
        'id_province' => "Provincia",
        'postal_code' => "Codice postale",
        'dialing_code' => "Prefisso telefonico",
        'stat_code' => 'Codice statistico',
		'code_register'=>'Codice alfanumerico',
		'web_url'=>'Sito web',
		'email'=>'E-Mail'
    ),
	"report_provinces.php" =>
    array('title' => 'Lista delle province',
        'id' => "ID",
        'name' => "Nome",
        'id_region' => "Regione",
        'abbreviation' => "Sigla provincia",
        'stat_code' => "Codice statistico",
        'insert_pro' => 'Inserisci una nuova provincia',
		'name_search'=>'aggiungi "%" e invia per ricerca, oppure seleziona'
    ),
	"admin_provinces.php" =>
    array('title' => 'Gestione archivio delle province',
        'ins_this' => "Inserimento nuova provincia",
        'upd_this' => "Modifica la provincia con ID:",
        'err' => array('name' => '&Egrave; necessario indicare il nome della provincia',
            'abbreviation' => '&Egrave; necessario indicare la sigla della provincia',
            'email' => 'L\'indirizzo e-mail è sbagliato',
            'web_url' => 'L\'indirizzo del sito web è sbagliato'
        ),
        'id' => "ID",
        'name' => "Nome",
        'abbreviation' => "Sigla provincia",
        'id_region' => "Regione",
        'stat_code' => 'Codice statistico',
		'web_url'=>'Sito web',
		'email'=>'E-Mail'
    ),
	"admin_bank.php" =>
    array('title' => 'Gestione archivio dei sportelli bancari',
        'ins_this' => "Inserimento nuovo sportello bancario",
        'upd_this' => "Modifica sportello bancario ID:",
        'err' => array('name' => '&Egrave; necessario indicare il nome del comune',
            'postal_code' => '&Egrave; necessario indicare il codice postale',
            'email' => 'L\'indirizzo e-mail è sbagliato',
            'web_url' => 'L\'indirizzo del sito web è sbagliato'
        ),
        'id' => "ID",
        'iso_country' => "Nazione",
        'codabi' => "Codice ABI",
		'descriabi'=>'Banca',
        'codcab' => "Codice CAB",
		'descricab'=>'Descrizione sportello',
		'indiri'=>'Indirizzo',
		'id_municipalities'=>'Comune'

    ),
    "report_ruburl.php" =>
    array('title'       => 'Gestione archivio dei siti internet',
        'subtitle'      => 'Accesso rapido ai siti aziendali',
        'ins_this'      => "Inserimento nuovo indirizzo",
        'upd_this'      => "Modifica l'indirizzo",
        'id'            => "id",
        'description'   => "Descrizione",
        'address'       => "Indirizzo",
        'open'          => "Visita",
        'opentab'       => "Apri in un'altra finestra",
        'search'        => "Cerca",
        'delete'        => "Elimina",
        'category'      => "Categoria"
    ),
    "admin_ruburl.php"  =>
    array('title'       => 'Aggiungi sito internet',
        'subtitle'      => 'Inserisci la descrizione e l\'indirizzo completo del tipo protocollo',
        'description'   => 'Descrizione',
        'address'       => 'Indirizzo',
        'category'      => 'Categoria',
        'other'         => 'Altro',
        'inscat'        => 'Inserisci una categoria',
        'insdes'        => 'Inserisci una descrizione',
        'insadd'        => 'Inserisci l\'indirizzo in formato URL',
        'back'          => 'Torna alla rubrica',
        'add'           => 'Aggiungi'
    )

);
?>