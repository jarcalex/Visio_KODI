<?php
    include_once('modele/hardware.php');
    
    if(isset($_POST['id_bouton']) && isset($_POST['PIN']) && isset($_POST['telecommande'])) {
        $state = "off";
        if (isset($_POST['state'])) { $state = "on";}
        if (isset($_GET['state'])) { $state = "on";}
        
        #ex: radioEmission 3 11077822 0 on
        $command = "sudo /opt/valhalla/domotique.sh --pin ".$_POST['PIN']." --telecommand ".$_POST['telecommande']." --bouton ".$_POST['id_bouton']." --state ".$state;
        if (isset($_POST['after']) and $_POST['after'] != "0" and $_POST['times'] != "") {
            $command .= " --sleep ".$_POST['times']."m  >/dev/null &";
        } else {
            $command = $command." 2>&1";
        }
        $output = array();
        exec($command, $output, $return_var);
        echo "Execution de la cmd: ".$command."<br />";
        foreach ($output AS $line) {
            echo $line."<br />";
        }
        exit;
    }
    $action = $HOME."index.php/Domotique";
    $variables = $bdd->querySingle('SELECT (SELECT value FROM global_config where key="pin.emetteur") AS PIN, (SELECT value FROM global_config     where key="code.emetteur") AS CODE FROM global_config limit 1', true);
    $variables['ON']  =  $HOME."img/Generic48_On.png";
    $variables['OFF'] =  $HOME."img/Generic48_Off.png";
    $array_domotique = array();
    $radio = $bdd->query("SELECT * from Radio_config");
    $inc = 0;
    while($tt = $radio->fetchArray(SQLITE3_ASSOC)) {
        $inc++;
        $tt['inc'] = "dfr_".$inc;
        $tt['img'] = $HOME."img/".$tt['img'];
        if ($tt['hardware'] != 0) {
            $ip = GetIPbyID($tt['hardware'],$bdd);
            $tt['status'] = alive($ip);
        }
        array_push($array_domotique, $tt);
    }
    
