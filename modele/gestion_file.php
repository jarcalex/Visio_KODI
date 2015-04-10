<?php
/*
Fonction qui vérifie qu'il y a au moins plusieurs fichiers 
<= 2 car on exclut . et ..
*/
function isEmptyDir($dir){
    return (($files = @scandir($dir)) && count($files) <= 2);
} 

/*
Fonction qui adapte la valeur à l'unité optimale
*/
function decodeSize( $bytes ) {
    $types = array( 'B', 'KB', 'MB', 'GB', 'TB' );
    for( $i = 0; $bytes >= 1024 && $i < ( count( $types ) -1 ); $bytes /= 1024, $i++ );
    return( round( $bytes, 2 ) . " " . $types[$i] );
}

  
/*
Fonction qui liste un dossier de façon récursive et renvoi dans un tab html
*/
function listeDossier($dossier,$filtre) {

    if ($filtre != "") {
        $time = $filtre * 24 * 60 * 60;
        $time = time() - $time;
    }
    
    $files = array();
    
    if (is_dir($dossier)) {
    	if($dossierOuvert=opendir($dossier)) {
    		while(($fichier=readdir($dossierOuvert))!== false) {
    			if ($fichier==".." || $fichier=="." || $fichier=="index.php") continue;
    
    			if(is_dir("$dossier/$fichier")) {
    				if (!isEmptyDir("$dossier/$fichier")) {
    					echo "<tr class='success'>
    					        <th><input type='checkbox' value=\"".$dossier."/".$fichier."\" name='select[]'/></th>
    					        <th colspan=3>$fichier</th>";
    					listeDossier("$dossier/$fichier", $filtre);
    					echo "</tr>";
    				}
    			}
    			else {
    				$files[filemtime("$dossier/$fichier")] = $fichier;
    			}
    		}
    		ksort($files);
    		$i = 1;
    		foreach($files as $file) {
                $page = $dossier."/".$file;
                if ($time && filemtime($page) < $time) {
                    continue;
                }

    			$taille_file = decodeSize(filesize($page));
    			
    			$date = date ("F d Y H:i:s", filemtime($page));
    			$page= substr($page,stripos($page,'/',1));
    			$encod = utf8_encode($page);
    			echo "<tr id='dfl_r".$i."' >";
    			echo "<td><input type='checkbox' value=\"".$dossier."/".$file."\" name='select[]'/> </td>";
    			echo "<td><a href=\"".$encod."\">".$file."</a></td>";
    			echo "<td>$taille_file</td>";
    			echo "<td>$date</td>";
    			echo "</tr>";
    			$i++;
    		}
    	}
    }
    else {
    	echo "Erreur, le paramètre précisé dans la fonction n'est pas un dossier!";
    }
}