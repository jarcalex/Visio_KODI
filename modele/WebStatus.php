<?php

function uptime() {
    $numargs = func_num_args();
    if ($numargs >= 1) {
        $arg = func_get_arg(0);
        $uptime = $arg;
    } else {
        $uptime = shell_exec("cat /proc/uptime");
    } 
    $uptime = explode(" ", $uptime); 
    return readbleTime($uptime[0]);
}

function readbleTime($seconds) {
    $y = floor($seconds / 60/60/24/365);
    $d = floor($seconds / 60/60/24) % 365;
    $h = floor(($seconds / 3600) % 24);
    $m = floor(($seconds / 60) % 60);
    $s = $seconds % 60;
    $string = '';
    if ($y > 0) {
        $yw = $y > 1 ? ' Années ' : ' Année ';
        $string .= $y . $yw;
    }
    if ($d > 0) {
        $dw = $d > 1 ? ' Jours ' : ' Jour ';
        $string .= $d . $dw;
    }
    if ($h > 0) {
        $hw = $h > 1 ? ' Heurs ' : ' Heure ';
        $string .= $h . $hw;
    }
    if ($m > 0) {
        $mw = $m > 1 ? ' Minutes ' : ' Minute ';
        $string .= $m . $mw;
    }
    if ($s > 0) {
        $sw = $s > 1 ? ' Secondes ' : ' Seconde ';
        $string .= $s . $sw;
    }
    return preg_replace('/\s+/', ' ', $string);
}

function hdd() {
    $result = array();
    $drivesarray = func_get_arg(0);
    
    for ($i=0; $i<count($drivesarray); $i++) {
        $drivesarray[$i] = preg_replace('!\s+!', ' ', $drivesarray[$i]);
        preg_match_all('/\S+/', $drivesarray[$i], $drivedetails);
        
        if (sizeof($drivedetails[0]) == 0) {
            continue;
        }
        
        list($fs, $type, $size, $used, $available, $percentage, $mounted) = $drivedetails[0];
        
        $result[$i]['name'] = $mounted;
        $result[$i]['total'] = kConv($size);
        $result[$i]['free'] = kConv($available);
        $result[$i]['used'] = kConv($size - $available);
        $result[$i]['format'] = $type;
        
        $result[$i]['percentage'] = rtrim($percentage, '%');
        
        if($result[$i]['percentage'] > '80')
            $result[$i]['alert'] = 'warning';
        else
            $result[$i]['alert'] = 'success';
    }
    return $result;
}
  
function kConv($kSize){
    $unit = array('K', 'M', 'G', 'T');
    $i = 0;
    $size = $kSize;
    while($i < 3 && $size > 1024){
        $i++;
        $size = $size / 1024;
    }
    return round($size, 2).$unit[$i];
}

function heat() {
    $result = array();
    $arg1 = func_get_arg(0);
    $arg1 = str_replace("Temperature: ","",$arg1);
    $result['degrees'] = round($arg1);
    $MaxTemp = 85;
    
    $result['percentage'] = round($result['degrees'] / $MaxTemp * 100);

    if ($result['percentage'] >= '80')
        $result['alert'] = 'danger';
    elseif ($result['percentage'] > '65')
        $result['alert'] = 'warning';
    else
        $result['alert'] = 'success';

    return $result;
}



function connections() {
    $arg1 = func_get_arg(0);
    $connections = $arg1;
    $connections = $connections." ";

    $connections--;
    return array(
      'connections' => substr($connections, 0, -1),
      'alert' => ($connections >= 50 ? 'warning' : 'success')
    );
}

function ethernet() {
    $data = func_get_arg(0);
    $data = str_ireplace("RX bytes:", "", $data);
    $data = str_ireplace("TX bytes:", "", $data);
    $data = trim($data);
    $data = explode(" ", $data);
    
    $rxRaw = $data[0] / 1024 / 1024;
    $txRaw = $data[4] / 1024 / 1024;
    $rx = round($rxRaw, 2);
    $tx = round($txRaw, 2);

    return array(
      'up' => $tx,
      'down' => $rx,
      'total' => $rx + $tx
    );
}


function ram() {
	$result = array();
	$arg1 = func_get_arg(0);

	preg_match_all('/\s+([0-9]+)/', $arg1, $matches);
	list($total, $used, $free, $shared, $buffers, $cached) = $matches[1];

	$result['percentage'] = round(($used - $buffers - $cached) / $total * 100);
	if ($result['percentage'] >= '80')
		$result['alert'] = 'warning';
	else
		$result['alert'] = 'success';

	$result['free'] = $free + $buffers + $cached;
	$result['used'] = $used - $buffers - $cached;
	$result['total'] = $total;

	return $result;
}

function swap() {
	$arg1 = func_get_arg(0);
	$result = array();

	preg_match_all('/\s+([0-9]+)/', $arg1, $matches);
	list($total, $used, $free) = $matches[1];

	$result['percentage'] = round($used / $total * 100);
	if ($result['percentage'] >= '80')
		$result['alert'] = 'warning';
	else
		$result['alert'] = 'success';

	$result['free'] = $free;
	$result['used'] = $used;
	$result['total'] = $total;

	return $result;
}


function icon_alert($alert) {
  echo '<i class="glyphicon glyphicon-';
  switch($alert) {
    case 'success':
      echo 'ok" style="color:#5cb85c" ';
      break;
    case 'warning"':
      echo 'warning-sign" style="color:#f0ad4e"';
      break;
    default:
      echo 'exclamation-sign" style="color:#d9534f"';
  }
  echo '></i>';
}

function shell_to_html_table_result($shellExecOutput) {
	$shellExecOutput = preg_split('/[\r\n]+/', $shellExecOutput);

	// remove double (or more) spaces for all itemsrrayValue['titre']
	foreach ($shellExecOutput as &$item) {
	$item = preg_replace('/[[:blank:]]+/', ' ', $item);
	$item = trim($item);
	}

	// remove empty lines
	//$shellExecOutput = array_filter($shellExecOutput);
	if ($shellExecOutput[0] == "") {
		array_shift($shellExecOutput);
	}
	// the first line contains titles
	$columnCount = preg_match_all('/\s+/', $shellExecOutput[0]);
	$shellExecOutput[0] = '<tr><th>' . preg_replace('/\s+/', '</th><th>', $shellExecOutput[0], $columnCount) . '</th></tr>';
	$tableHead = $shellExecOutput[0];
	unset($shellExecOutput[0]);

	// others lines contains table lines
	foreach ($shellExecOutput as &$item) {
	$item = '<tr><td>' . preg_replace('/\s+/', '</td><td>', $item, $columnCount) . '</td></tr>';
	}

	// return the build table
	return '<table class=\'table table-striped\'>'
		. '<thead>' . $tableHead . '</thead>'
		. '<tbody>' . implode($shellExecOutput) . '</tbody>'
		. '</table>';
}

function externalIp() {
    $ip = loadUrl('http://whatismyip.akamai.com');
    if(filter_var($ip, FILTER_VALIDATE_IP) === false)
        $ip = self::loadUrl('http://ipecho.net/plain');
    if(filter_var($ip, FILTER_VALIDATE_IP) === false)
        return 'Unavailable';
    return $ip;
}

  
function loadUrl($url){
    if(function_exists('curl_init')){
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $content = curl_exec($curl);
        curl_close($curl);
        return trim($content);
    } elseif(function_exists('file_get_contents')){
        return trim(file_get_contents($url));
    }else{
        return false;
    }
}

function users_login ($dataRaw) {
    $result = array();
    $titre = array_shift($dataRaw);
    foreach ($dataRaw as $line) {
      $line = preg_replace("/ +/", " ", $line);
      
      if (strlen($line)>0) {
        $line = explode(" ", $line);
          
        $result[] = array(
          'user' => $line[0],
          'ip' => $line[2],
          'date' => $line[5] .' '. $line[4],
          'hour' => $line[6]
          );
      }
    }
    return $result;
}



