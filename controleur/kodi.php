<?php

if (!isset($_SESSION["TYPE"]) || ($_SESSION["TYPE"] != "movieview" && $_SESSION["TYPE"] != "tvshowview")) {
    $_SESSION["TYPE"] = "tvshowview";
}

if (isset($_GET["type"])) {
    $_SESSION["TYPE"] = $_GET["type"];
}

$SCAN = "/www/controleur/kodi.php";
$CLEAN = "/www/controleur/kodi.php?CLEANUP";
$URI = $HOME.'index.php'.$_SERVER['PATH_INFO']."/ID/";
$JS = "";
$Nav_url = $_SERVER["QUERY_STRING"];
$Nav_url = preg_replace('/page=\d+/', '', $Nav_url);
	
if (!isset($bdd)) {
	include_once('sgbd.php');
}

$config = _GetConfig($bdd);

if (isset($_POST['directory'])) {
	include('../modele/xbmc.php');
	$directory = $_POST['directory'];
	echo "Lancement d'un scan du directory «".$directory."» ...";
	$xbmc = new xbmcJson($config);
    $xbmc->VideoLibrary->Scan('{ "directory": "'.$directory.'" }');
    exit;
}

if (isset($_GET['CLEANUP'])) {
	include('../modele/xbmc.php');
	echo "Lancement d'un « CleanUP » ...";
	$xbmc = new xbmcJson($config);
    $xbmc->VideoLibrary->Clean('{  }');
    exit;
}

// on se connecte à MySQL
include('modele/kodi_mysql.php');
try {
	$Mysql = new Mysql($config["host_bdd"], $config["database_bdd"], $config["user_bdd"], $config["mdp_bdd"]);
	$Mysql->ExecuteSQL("SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");
} catch (MySQLExeption $e) {
    echo $e -> RetourneErreur();
}


$slct_genre = "";
if ($Mysql) {
	$Resulats = $Mysql->GetGenre();
}
foreach ($Resulats as $Valeur){
    $slct_genre .= '<li><a href="'.$HOME.'index.php/'.$URL[1].'?Genres[]='.$Valeur['GENRE'].'">
    		<i class="glyphicon glyphicon-menu-right"></i> '.$Valeur['GENRE'].' <small class="badge pull-right bg-blue">'.$Valeur['NB'].'</small>
    		</a></li>';
}

if (isset($_GET["SerieStat"])) {
    $_SESSION["TYPE"] = "tvshowview";
    
    $sql = "SELECT idShow as Serie, c00, c19, c20, 
      (SELECT count(*) FROM `episode` where c12 = 0 and idShow = Serie ) AS SPECIAUX,
      (SELECT count(*) FROM `episode` where c12 != 0 and idShow = Serie ) AS EP
FROM `tvshowview`
where totalCount is not null ORDER by c19";	

	$Resulats = array();
	if ($Mysql) {
		$Resulats = $Mysql->TabResSQL($sql);
	}
	$LIST = "";
	foreach ($Resulats as $Valeur){
	    $class = "";
	    if ( $Valeur["c19"] - $Valeur["EP"] >= 1 ) {
	        $class = "class='danger'";
	    } elseif( $Valeur["c20"] - $Valeur["SPECIAUX"] >= 1 ) {
	        $class = "class='info'";
	    } else {
	        $class = "class='success'";
	    }
		$LIST .= '<tr '.$class.'>
			<td><a href="'.$URI.$Valeur["Serie"].'" >'.$Valeur["c00"].'</a></td>
			<td>'.$Valeur["EP"].' / '.$Valeur["c19"].'</td>
			<td>'.$Valeur["SPECIAUX"].' / '.$Valeur["c20"].'</td>
		</tr>';
	}
    
    
    
    $View = 'vue/kodi/stat_serie.php';
	include_once('vue/kodi/main.php');
	include_once('vue/foot.php');
	exit; 
}

if (isset($_GET["Dashboard"])) {
	$_SESSION["TYPE"] = "Dashboard";
    // Get Nb file || Get Nb TVShow || Get Nb Movie || Get Nb Episode
    $req = "SELECT
(SELECT COUNT(*) FROM movie) as Movie,
(SELECT COUNT(*) FROM movieview where playCount is not null) as MovieView,
(SELECT COUNT(*) FROM tvshow) as TvShow,
(SELECT COUNT(*) FROM episode) as Episode,
(SELECT count(*) FROM episodeview where playCount is not null) AS EpisodeView,
(SELECT COUNT(*) FROM files) as Files,
(select count(*) from files where dateAdded > NOW() - INTERVAL 30 DAY) as Files_last,
(select count(*) from tvshowcounts where dateAdded > NOW() - INTERVAL 30 DAY) as TvShow_last,
(SELECT COUNT(*) FROM episodeview where dateAdded > NOW() - INTERVAL 30 DAY) as Episode_last,
(select  count(*) from `movie` left join `files` on (`files`.`idFile` = `movie`.`idFile`)  where `files`.`dateAdded` > NOW() - INTERVAL 30 DAY) as Movie_last";
	if ($Mysql) {
    	$count = $Mysql->TabResSQL($req);
    	$count[0]['EpisodeView'] = $count[0]['EpisodeView'] / $count[0]['Episode'] * 100;
    	$count[0]['MovieView'] = $count[0]['MovieView'] / $count[0]['Movie'] * 100;
	}
    $sql = "SELECT idPath AS ID,
	               strPath,
	               strContent,
	               (SELECT COUNT(*) FROM path where idParentPath = ID) as path,
	               (select count(*) from files INNER JOIN path ON files.idPath = path.idPath where idParentPath = ID OR path.idPath = ID ) as files
	           FROM `path` where strContent is not null and idParentPath is null";	

	$Resulats = array();
	if ($Mysql) {
		$Resulats = $Mysql->TabResSQL($sql);
	}
	$slct_dir = "";
	foreach ($Resulats as $Valeur){
		$slct_dir .= '<tr>
			<td>'.$Valeur["strPath"].'</td>
			<td>'.$Valeur["strContent"].'</td>
			<td>'.$Valeur["path"].'</td>
			<td>'.$Valeur["files"].'</td>
			<td><i onClick="send_refresh(\''.$Valeur["strPath"].'\')" class="glyphicon glyphicon-refresh" style="cursor:pointer"></i></td>
		</tr>';
	}
    
    $View = 'vue/kodi/Dashboard.php';
	include_once('vue/kodi/main.php');
	include_once('vue/foot.php');
	exit;    
}


if($_SESSION["TYPE"] == "movieview") {
    $art = "c08";
    $idTable = "idMovie";
    $View = 'vue/kodi/list_movie.php';
	$ColGenre = "c14";
	$sql_detail = 'SELECT '.$idTable.', c00 AS label, c01 AS plot, c05 AS rating, c07 AS year, c18, c14 AS genre, c08 AS art, c21, c22, playCount, lastPlayed, dateAdded FROM movieview WHERE '.$idTable.' =';
} 
if ($_SESSION["TYPE"] == "tvshowview") {
    $art = "c06";
    $idTable = "idShow";
   	$sql_detail = 'SELECT '.$idTable.' as Serie, c00 AS label, c12, c01 AS plot, c04 AS rating, c05 AS year,
   	    c08 AS genre, c06 AS art, c12 AS id_tvdb, c14 AS Diff, c19, c20, strPath, dateAdded,
   	    lastPlayed, totalCount, watchedcount, totalSeasons,
        (SELECT count(*) FROM `episode` where c12 = 0 and idShow = Serie ) AS SPECIAUX,
        (SELECT count(*) FROM `episode` where c12 != 0 and idShow = Serie ) AS EP
   	  FROM tvshowview
   	    WHERE idShow =';
    $View = 'vue/kodi/list_tv.php';
    $ColGenre = "c08";
}

$new = 0;
$Resulats = array();
if ($Mysql) {
	$Resulats = $Mysql->GetNew($idTable, $art, $_SESSION["TYPE"]);
}

if (isset($URL[3]) && is_numeric($URL[3])) {
	$id = $URL[3];
	$sql_detail .= $id;

	$RawAll = array();
	$Raw = array();
	if ($Mysql) {
		$RawAll = $Mysql->TabResSQL($sql_detail);
		$Raw = $RawAll[0];
	}
	if ($_SESSION["TYPE"] == "tvshowview") {
		$Nb_ep_total    = $Raw["c19"];
		$Nb_sp_total    = $Raw["c20"];
		
		$Nb_ep_have    = $Raw["EP"];
		$Nb_sp_have    = $Raw["SPECIAUX"];
		
		$progress_ep = ($Nb_ep_have * 100 / $Nb_ep_total);
		$progress_sp = ($Nb_sp_have * 100 / $Nb_sp_total);
		

		
		$detail   = _getEpisodes($Mysql,$id);
		$poster   = _GetPoster_TV($Raw["art"],"posters",1);
		$banner   = _GetPoster_TV($Raw["art"],"graphical",1);
		$fanart   = _GetPoster_TV($Raw["art"],"posters",0);
		$JS .= "<script>";
		$i = 0;
		foreach ($fanart as $art) {
			$JS .= '$("#image-'.$i.'").on("click", function() {
	   			$(\'#imagepreview\').attr(\'src\', $(\'#image-'.$i.'\').attr(\'src\'));
	   			$(\'#imagemodal\').modal(\'show\');
		});';
			$i++;
		}
		$JS .= "</script>";

		
		$View     = 'vue/kodi/detail_tv.php';
	} else {
		$poster   = _GetPoster_Movie($Raw["art"],"posters",1);
		$View     = 'vue/kodi/detail_movie.php';
	}
	include_once('vue/kodi/main.php');
	include_once('vue/foot.php');
	exit;

} else {
    if (!isset($_GET['page'])) {
        $page = 1;
    } else {
        $page = $_GET['page'];
    }
    
    $page_previous = $page - 1;
    $page_next = $page + 1;
    
    $range = 18;
	
	$end  = $range * $page;
	$start = $end - $range;
    
	$sql = 'SELECT '.$idTable.' AS id, c00 AS Titre, '.$art.' AS Art FROM '.$_SESSION["TYPE"];
	
	$filtre = array();
	if (isset($_GET["titre"]) and $_GET["titre"] != "") {
		array_push($filtre, "c00 like '%".$_GET["titre"]."%'");
	}
	if (isset($_GET["Genres"])) {
		$genre = array();
		foreach($_GET['Genres'] as $choise) {
			array_push($genre, $ColGenre." LIKE '%".$choise."%'");
		}
		array_push($filtre, "(".implode(' OR ', $genre).")");
	}
	if(isset($_POST["annee"]) && $_POST["annee"] != "") {
		array_push($filtre, "YEAR(c05)  ".$_POST["operator"]." '".$_POST["annee"]."'");	
	}
	
	if (!empty($filtre)) {
		$sql .= " WHERE ".implode(' AND ', $filtre );
	}
	if (isset($_GET["last"])) {
		$sql .= " ORDER BY dateAdded DESC LIMIT ".$range." OFFSET ".$start;
	} else {
		$sql .= " ORDER BY c00 LIMIT ".$range." OFFSET ".$start;
	}
	$Raw = array();
	if ($Mysql) {
		$Raw = $Mysql->TabResSQL($sql);
	}
	
	$cmpt = 0;
	include_once('vue/kodi/main.php');
	include_once('vue/foot.php');
	exit;
}


function _GetPoster_TV ($poster, $type, $orig) {
	if ($poster == "") return "";

	$re = "/>(http:\\/\\/thetvdb.com\\/banners\\/$type\\/.+?)</im"; 
	if (preg_match_all($re, $poster, $matches)) {
		$poster = $matches[1];
		if ($orig == 0) $poster = str_replace("/$type/","/_cache/$type/", $poster);

		//$poster = str_replace('http:','https:', $poster);
		$poster = array_unique($poster);
		return $poster;
    }
    return "";
}

function _GetPoster_Movie($poster, $type, $orig) {
	if ($poster == "") return "";

	$re = "/aspect=\"(.+?)\" preview=\"(.+?)\"/im"; 
	if (preg_match_all($re, $poster, $matches)) {
		$poster = $matches[2];
		if ($orig == 0) {
		    $poster = str_replace("/w500/","/w300/", $poster);
		} else {
		    $poster = str_replace("/w500/","/original/", $poster);
		}

		$poster = str_replace('http:','https:', $poster);
		$poster = array_unique($poster);
		return $poster;
    }
    return "";
}

function hostAlive($host, $port = "8080") {
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_URL, "http://".$host.":".$port);
	curl_exec($ch);
	$info = curl_getinfo($ch);
	if($info['http_code'] == "200" || $info['http_code'] == "401") {
		return true;
	} else {
		return false;
	}
}

function _getEpisodes($Mysql,$tvshowId) {
	$html = "";
	$sql = 'select 
   `episode`.`idEpisode` AS `idEpisode`,
   `episode`.`idFile` AS `idFile`,
   `episode`.`c00` AS `c00`,
   `episode`.`c05` AS `c05`,
   `episode`.`c12` AS `c12`,
   `episode`.`c13` AS `c13`,
   `streamdetails`.`strVideoCodec` AS `strVideoCodec`,
   `streamdetails`.`iVideoWidth` AS `iVideoWidth`,
   `streamdetails`.`iVideoHeight` AS `iVideoHeight`,
   `streamdetails`.`iVideoDuration` AS `iVideoDuration`,
   `files`.`playCount` AS `playCount`,
   `files`.`lastPlayed` AS `lastPlayed`,
   `files`.`dateAdded` AS `dateAdded`
   from ((((`episode` join `files` on((`files`.`idFile` = `episode`.`idFile`))) left join `streamdetails` on(((`streamdetails`.`idFile` = `episode`.`idFile`) and (`streamdetails`.`iStreamType` = 0)))) ) )
   where idShow = '.$tvshowId.' ORDER BY CAST(c12 as SIGNED INTEGER), CAST(c13 as SIGNED INTEGER) ASC';
	$Raw = $Mysql->TabResSQL($sql);
	foreach ( $Raw as $Element) {
	    if ($Element["iVideoHeight"] == "") {
	        $format = "";
        } elseif ($Element["iVideoHeight"] < 720) {
            $format = "sd-video";
        } else {
            $format = "hd-video";
        }
        $vue = "eye-close' style='color:red";
        if ($Element["playCount"] >= 1) {
            $vue = "eye-open' style='color:green";
        }
		$html .= "<tr>
		<td>".$Element["c12"]."x".$Element["c13"]."</td>
		<td>".$Element["c00"]."</td>
		<td>".gmdate("H:i:s", (int)$Element["iVideoDuration"]) ."</td>";
		$html .= "<td>";
		if ($format != "") $html .= "<i class='glyphicon glyphicon-".$format."'></i>";

		$html .= " <i class='glyphicon glyphicon-".$vue."'></i> </td>
		</tr>";
	}
	return $html;
}

function _GetConfig($bdd) {

	$res = $bdd->query("SELECT * from kodi_config");
	while($kodi = $res->fetchArray(SQLITE3_ASSOC)) {
		$config = $kodi;
	}
	return $config;
}
