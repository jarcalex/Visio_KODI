<?php

// on se connecte à la base
$db_visual = new SQLite3('/app/www/ressource/visual.sqlite');
// gestion des erreurs
if (empty($db_visual)) {
	die('Erreur SQLite ');
} 

$URI = $HOME.'index.php'.$_SERVER['PATH_INFO']."/ID/";


if (!isset($_SESSION["TYPE"]) || ($_SESSION["TYPE"] != "anime" && $_SESSION["TYPE"] != "movie")) {
	$_SESSION["TYPE"] = "anime";
}
if (isset($_GET["type"])) {
	$_SESSION["TYPE"] = $_GET["type"];
}
if($_SESSION["TYPE"] == "movie") {
	$View = 'vue/eaglevisual/list_movie.php';
} 
if ($_SESSION["TYPE"] == "anime") {
	$View = 'vue/eaglevisual/list_anime.php';
}
$slct_genre = "";
$sql = 'SELECT DISTINCT(genre) from '.$_SESSION["TYPE"].' order by genre';
$genre = $db_visual->query($sql);
while($Valeur = $genre->fetchArray(SQLITE3_ASSOC)) {
	$slct_genre .= '<li><a href="?Genres[]='.$Valeur['genre'].'"><i class="glyphicon glyphicon-chevron-right"></i> '.$Valeur['genre'].'</a></li>';
}

if (isset($URL[3]) && is_numeric($URL[3])) {
	$View = 'vue/eaglevisual/detail.php';
	$id = $URL[3];
	$sql_detail = 'SELECT * FROM '.$_SESSION["TYPE"].' WHERE id_'.$_SESSION["TYPE"].' = ';
	$sql_detail .= $id;
	$RawAll = $db_visual->query($sql_detail);
	$Raw=$RawAll->fetchArray(SQLITE3_ASSOC);
	$poster = "/www/ressource/image_anime/".$Raw["image_url"];
	include_once('vue/eaglevisual/main.php');
	include_once('vue/foot.php');
	exit;

} else {
	$sql = 'SELECT * FROM '.$_SESSION["TYPE"];
	$filtre = array();
	if (isset($_GET["titre"]) and $_GET["titre"] != "") {
		array_push($filtre, "titre like '%".$_GET["titre"]."%'");
	}
	if (isset($_GET["Genres"])) {
		$genre = array();
		foreach($_GET['Genres'] as $choise) {
			array_push($genre, "genre LIKE '%".$choise."%'");
		}
		array_push($filtre, "(".implode(' OR ', $genre).")");
	}
	if(isset($_POST["annee"]) && $_POST["annee"] != "") {
		array_push($filtre, "YEAR(c05)  ".$_POST["operator"]." '".$_POST["annee"]."'");	
	}
	if (!empty($filtre)) {
		$sql .= " WHERE ".implode(' AND ', $filtre );
	}
	$sql .= " ORDER BY titre";
	$Raw = $db_visual->query($sql);
	
	$cmpt = 0;
	include_once('vue/eaglevisual/main.php');
	include_once('vue/foot.php');
	exit;
}
