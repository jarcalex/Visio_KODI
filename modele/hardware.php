<?php

function alive($ip) {
    $command = '/bin/ping -c1 -q -w1 '.$ip.' | grep transmitted | cut -f3 -d"," | cut -f1 -d"," | cut -f1 -d"%"';
	$output = array();
	exec($command, $output, $return_var);
	return $output[0];
}

function getPinState($pin,$pins){
	$commands = array();
	exec("gpio read ".$pins[$pin],$commands,$return);
	return (trim($commands[0])=="1"?'On':'Off');
}

function GetIPbyID ($ID,$bdd) {
    $res = $bdd->query("SELECT * from wol_config where id = ".$ID);
    while($tt = $res->fetchArray(SQLITE3_ASSOC)) {
	    return $tt['IP'];
    }
    return 0;
}

?>