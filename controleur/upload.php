<?php

include_once('modele/gestion_file.php');

$info="";
$display_info="none";

if (isset($_FILES['nom_du_fichier'])) {
    $display_info="block";
    $chemin_destination = '/app/www/upload/';
    if (move_uploaded_file($_FILES['nom_du_fichier']['tmp_name'], $chemin_destination.$_FILES['nom_du_fichier']['name'])) {
        $info='<span style="color:green" ><strong>Upload effectué avec succès !</strong></span>';
    } else {
        $info='<span style="color:red" ><strong>Echec de l\'upload !</strong></span><br />'.$_FILES['nom_du_fichier']['error'];
    }
}

if (isset($_POST['del']) && $_POST['del'] == "Suppr" && isset($_POST['select'])) {
	$display_info="block";
	foreach ($_POST['select'] as &$value) {
		$value = str_replace("'", "\'",$value);
		$value = str_replace(" ", "\ ",$value);
		$value = str_replace("[", "\[",$value);
		$value = str_replace("]", "\]",$value);
		$value = str_replace("(", "\(",$value);
		$value = str_replace(")", "\)",$value);
		$value = str_replace("!", "\!",$value);
		$value = str_replace("&", "\&",$value);
		$command = 'sudo /opt/valhalla/rm.sh '.$value.' 2>&1';
		$output = array();
		exec($command, $output, $return_var);
		
		if($return_var == 0) {
			$info.="File: ".$value." ==> <span style='color:#00FF00'>OK</span><br />";
		}
		else {
			$info.="File: ".$value." ==> <span style='color:#FF0000'>KO</span><br />";
			$info.="Cmd: ".$command."<br />";
		}
	}
  }
