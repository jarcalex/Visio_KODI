<?php

include_once('modele/gestion_file.php');

$info="";
$display_info="none";
$filtre = "";
if (isset($_POST['periode'])) {
    $filtre = $_POST['periode'];
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

