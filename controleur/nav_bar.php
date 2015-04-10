<?php


//$bdd = new SQLite3('/app/www/new/db/database.db');

$modules = array();
$nav_bar = array();



$res = $bdd->query("SELECT * from nav_section order by \"Order\", id");
while($onglet = $res->fetchArray(SQLITE3_ASSOC)) {
    
    if ( isset($URL[1]) and $URL[1] == $onglet['label'] ) {
        $onglet['class'] = " class='active' ";
        parse_str($onglet['parameters'], $parameters);
    } else {
        $onglet['class'] = " ";
    }
	if  (isset($onglet['Parent']) and $onglet['Parent'] != "" ) {
		$id_parent = $onglet['Parent'];
		if (!isset($nav_bar[$id_parent]['Child'])) {
			$nav_bar[$id_parent]['Child'] = array();
		}
		array_push($nav_bar[$id_parent]['Child'],  $onglet);
	} else {
		$nav_bar[$onglet['id']] = $onglet;
	}
	array_push($modules, $onglet);
}

//var_dump($parameters);
include_once('modele/nav_bar.php');

include_once('vue/nav_bar.php');