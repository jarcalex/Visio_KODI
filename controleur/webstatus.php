<?php

/* Lit l'adresse IP du serveur de destination */
$address = "localhost";
if (isset($parameters['host'])) {
    $address = $parameters['host'];
}
/* Lit le port du service WebDetail. */
$service_port = 9500;

/* Crée un socket TCP/IP. */
$socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
if ($socket === false) {
    echo "socket_create() a échoué : raison :  " . socket_strerror(socket_last_error()) . "\n";
}
$dataRaw = "";
#echo "Essai de connexion à '$address' sur le port '$service_port'...";
$result = socket_connect($socket, $address, $service_port);
while ($out = socket_read($socket, 2048)) {
    $dataRaw .= $out ;
}
include_once('modele/WebStatus.php');

$line = explode ("<--------------------------->", $dataRaw);
foreach ($line as $key_value) {
    $tab = explode ("\n", $key_value);
	if ($tab[0] == "") {
		$test = array_shift($tab);
	}
	
	switch ($tab[0]) {
		case '[UpTime]':
		    $uptime = uptime($tab[1]);
			break;
		case '[FS]':
			$test = array_shift($tab);
			$hdd = hdd($tab); 
			break;
		case '[getLoad]':
			$load = explode(". ",$tab[1]);
			$cpu['loads']   = $load[0];
			$cpu['loads5']  = $load[1];
			$cpu['loads15'] = $load[2];
			if ($load[0] > 1)
			    $cpu['alert'] = 'danger';
			else
			    $cpu['alert'] = 'success';
			break;
		case '[cpuCurFreq]':
			$cpu['current'] = $tab[1];
			break;
		case '[cpuMinFreq]':
			$cpu['min'] = $tab[1];
			break;
		case '[cpuMaxFreq]':
			$cpu['max'] = $tab[1];
			break;
		case '[cpuFreqGovernor]':
			$cpu['governor'] = $tab[1];
			break;
		case '[cpuDetails]':
			$data = preg_replace('/\[cpuDetails\][\r\n]+/', '', $key_value);
			$data = trim($data);
			$cpu_heat['detail'] = $data;
			break;
		case '[TEMP]':
			$cpu_heat = heat($tab[1]);
			break;
		case '[RESEAU]':
			$net_eth = ethernet($tab[1]);
			break;
		case '[CONNEXION]':
			$net_connections = connections($tab[1]);
			break;
		case '[RPI]':
			$hostname = $tab[1];
			$Firmware = $tab[2];
			$Kernel = $tab[3];
			$distribution = $tab[4];
			$distribution = str_ireplace('PRETTY_NAME="', '', $distribution);
			$distribution = str_ireplace('"', '', $distribution);
			$IP = $tab[5];
			break;
		case '[RAM-SWAP]':
			$ram = ram($tab[2]);
			$swap = swap($tab[3]);
			break;
		case '[RamDetails]':
			$data = preg_replace('/\[RamDetails\][\r\n]+/', '', $key_value);
			$data = trim($data);
			$ram['detail'] = $data;
			break;
		case '[USERS]':
			$users = users_login($tab);
			break;
	}
}
