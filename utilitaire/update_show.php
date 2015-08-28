<?php

$Mysql = mysql_connect("fenrir", "kodi", "kodi");
$Base = mysql_select_db("MyVideos90",$Mysql);

$where = "";

if (isset($argv[1])) {
	$where = "where idShow = $argv[1]";
}

$sql = "SELECT idShow,c00, c12 FROM tvshowview $where ORDER by idShow desc";

$Ressource = mysql_query($sql,$Mysql);

while ($Ligne = mysql_fetch_assoc($Ressource)) {
	_getInfo($Mysql,$Ligne["idShow"], $Ligne["c12"], $Ligne["c00"]);
}



function _getInfo($Mysql,$tvshowId,$tvdb_id, $title) {
	$ctx = stream_context_create(array('http' => array('timeout' => 5))); 
	$raw = file_get_contents('http://thetvdb.com/?tab=seasonall&id='.$tvdb_id.'&lid=17', 0, $ctx);
	$re = "/<tr><td class=\"(.+?)<\/tr>/im";
	
	preg_match_all($re, $raw, $matches);
	$nb_ep      = 0;
	$nb_special = 0;
	foreach ($matches[1] as $val) {
		$test = preg_split("/<td/mi", $val);
		if (preg_match("/><\/a>/mi", $test[1])) {
			echo "   - Pas de titre, on ignore l'épisode\n";
			continue;
		}elseif (preg_match("/TBA/m", $test[1])){
			echo "   - TBA, on passe\n";
			continue;
		}

		if (preg_match("/>Special</",$val)){
			$nb_special++;
		} else {
			if (preg_match("/>\s*<\/td>/mi", $test[2])) {
				echo "   - Episode pas de date de sortie\n";
				continue;
			}
			$nb_ep++;
		}

		//print_r($val);
	}
	echo "Name: $title // Ep: $nb_ep // Sp: $nb_special \n";
#	$nb = count($matches[1]);
	$req_update = "UPDATE tvshow set c19 = '$nb_ep', c20 = '$nb_special'  where idShow = $tvshowId";
	mysql_query($req_update,$Mysql);
}

?>
