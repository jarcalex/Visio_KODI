<?php
include_once('modele/hardware.php');

$array_hard = array();
$res = $bdd->query("SELECT * from wol_config");
while($tt = $res->fetchArray(SQLITE3_ASSOC)) {
	array_push($array_hard, $tt);
}
foreach( $array_hard as $cle=>$arrayValue ) {
    if (isset($arrayValue['IP']) and $arrayValue['IP'] != ""){
		$output = alive($arrayValue['IP']);
		if($output == "0") {
			$array_hard[$cle]['status'] = "ok' style='color:green";
		} else {
			$array_hard[$cle]['status'] = "warning-sign' style='color:orange";
		}
	} else {
		$array_hard[$cle]['status'] = "remove' style='color:red";
	}
}

$option_WOL = "";
$option_Off = "";
foreach( $array_hard as $cle=>$arrayValue ) {
    if (preg_match("/ok/",$arrayValue['status'])) {
        $option_Off .= "<option value='".$arrayValue['id']."'>".$arrayValue['Hostname']."</option>";
    } elseif (preg_match("/warning/",$arrayValue['status'])) {
	    $option_WOL .= "<option value='".$arrayValue['MAC']."'>".$arrayValue['Hostname']."</option>";	
    }
}

$info="";
$display_info="none";

if(isset($_POST['wake'] ) && $_POST['wake'] == "Send" && isset($_POST['Mac']) ) {
    $display_info="block";
    $command = "";
    $wake = "/opt/valhalla/wake.sh --mac ".$_POST['Mac'];
    if (isset($_POST['periode']) && $_POST['periode'] != "NOW" ) {
        $command = $wake." --sleep ".$_POST['periode_start'].$_POST['periode']." >/dev/null &";
    } else {
        $command = $wake." 2>&1";
    }
    $output = array();
    exec($command, $output, $return_var);
    $info = "Execution de la cmd: ".$command."<br />";
    
    foreach ($output AS $line) {
        $info .= $line."<br />";
    }
}

if(isset($_POST['down'] ) && $_POST['down'] == "Send" && isset($_POST['id']) ) {
    $display_info="block";
    $command = "";
   $res = $bdd->query("SELECT * from wol_config where id = ".$_POST['id']);
	while($tt = $res->fetchArray(SQLITE3_ASSOC)) {
		$wake = $tt['cmd_shutdown'];
	}
   
   
    if (isset($_POST['periode']) && $_POST['periode'] != "NOW" ) {
        $command = $wake." --sleep ".$_POST['periode_start'].$_POST['periode']." >/dev/null &";
    } else {
        $command = $wake." 2>&1";
    }
    $output = array();
    exec($command, $output, $return_var);
    $info = "Execution de la cmd: ".$command."<br />";
    
    foreach ($output AS $line) {
        $info .= $line."<br />";
    }
}
