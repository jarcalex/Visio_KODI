<?php

if(isset($_POST["cron"])) {
    $cron_line = $_POST["cron"];
    echo $cron_line."<br />";
    if (! isset($_POST["schedule"])) {
        $ret = shell_exec('ssh xbian@darksurt "(crontab -l ; echo \"'.$cron_line.'\") 2>&1 | sed \"s/no crontab for xbian//\" | uniq | crontab - "');
        echo "Add distant schedule<br />";
    } else {
        $ret = shell_exec('(crontab -l ; echo "'.$cron_line.'") 2>&1 | sed "s/no crontab for www-data//" | uniq | crontab - ');
        echo "Add local schedule<br />";
    }
    exit;
}

if (isset($_POST["del"],$_POST['select']) && $_POST['del'] == "Delete") {
    $other["DarkSurt"] = shell_exec('ssh xbian@darksurt "crontab -l" ');
    $other["Valhalla"] = shell_exec('crontab -l');

    list($schedule,$line) = explode("-", $_POST['select']);
    $array = explode("\n",$other[$schedule]);
    $num_line = 0;
    $contenu = "";
    #echo "Scheduler: ".$schedule." Line: ".$line."<br />";
    foreach ($array as $buffer) {
        if (preg_match('/^#/',$buffer) or preg_match('/^$/',$buffer)) {
            $contenu .= $buffer."\n";
            continue;
        }
        $num_line++;
        if ($num_line == $line) {
            continue;
        }
        $contenu .= $buffer."\n";
    }
    if ($schedule == "Valhalla") {
        $ret = shell_exec('(echo "'.$contenu.'") 2>&1 | crontab - ');
    } else {
        $ret = shell_exec('ssh xbian@darksurt "(echo \"'.$contenu.'\") 2>&1 | crontab - "');
    }
}


if(isset($_POST["cmd-text"]) && isset($_POST["host-text"]) && isset($_POST["planif-text"])	) {
    $other["DarkSurt"] = shell_exec('ssh xbian@darksurt "crontab -l" ');
    $other["Valhalla"] = shell_exec('crontab -l');

    list($schedule,$line) = explode("-", $_POST['host-text']);
    $array = explode("\n",$other[$schedule]);
    $num_line = 0;
    $contenu = "";
    #echo "Scheduler: ".$schedule." Line: ".$line."<br />";
    foreach ($array as $buffer) {
        if (preg_match('/^#/',$buffer) or preg_match('/^$/',$buffer)) {
            $contenu .= $buffer."\n";
            continue;
        }
        $num_line++;
        if ($num_line == $line) {
            $contenu .= $_POST["planif-text"]." ".$_POST["cmd-text"]."\n";
            continue;
        }
        $contenu .= $buffer."\n";
    }
    if ($schedule == "Valhalla") {
        $ret = shell_exec('(echo "'.$contenu.'") 2>&1 | crontab - ');
    } else {
        $ret = shell_exec('ssh xbian@darksurt "(echo \"'.$contenu.'\") 2>&1 | crontab - "');
    }
    echo "TEST";
    exit;
}

$other["DarkSurt"] = shell_exec('ssh xbian@darksurt "crontab -l" ');
$other["Valhalla"] = shell_exec('crontab -l');
$CronTab = "";
if ($other) {
    foreach ($other as $machine => $crontab) {
        $array = explode("\n",$crontab);
        $inc = 1;
        foreach ($array as $buffer) {
            if (preg_match('/^#/',$buffer) or preg_match('/^$/',$buffer)) {
                continue;
            }
            if ($inc == 1) {
                $CronTab .= "<tr class='success'><td colspan=7><strong>${machine}</strong></td></tr>\n";
            }	
            list($min,$heur,$dom,$mon,$dow) = explode(" ", $buffer);
            $cmd = $buffer;
            $cmd = preg_replace('/\S*\s*\S*\s*\S*\s*\S*\s*\S*\s*(.+)/', '$1', $cmd);
            $CronTab .= "  <tr>";
            $CronTab .= "    <td> ${min} </td>";
            $CronTab .= "    <td> ${heur} </td>";
            $CronTab .= "    <td> ${dom} </td>";
            $CronTab .= "    <td> ${mon} </td>";
            $CronTab .= "    <td> ${dow} </td>";
            $CronTab .= "    <td> ${cmd} </td>";
            $CronTab .= "    <td style='padding:0;vertical-align:middle;text-align:center'>
    
    <button type='button' style='background: none repeat scroll 0 0 rgba(0, 0, 0, 0); border: medium none;' data-toggle='modal' data-target='#myModal' data-title='Modification Cron' data-host='${machine}-${inc}' data-cmd='${cmd}' data-planif='${min} ${heur} ${dom} ${mon} ${dow}'><i class='glyphicon glyphicon-edit' style='color:blue;cursor: pointer;' ></i></button>
    <i class='glyphicon glyphicon-remove' style='color:red;cursor: pointer;' onClick='submit_delete(\"${machine}-${inc}\")'></i>
    </td>";
            $CronTab .= "  </tr>\n";
            $inc++;
        }
    }
}

$MODAL = array();
$MODAL[0] = ' <input type="hidden" class="form-control" id="id" name="id" value="0">
          <div class="form-group">
            <label for="planif-text" style="font-weight: bold;text-decoration:underline;" class="control-label">Planif:</label>
            <input type="text" class="form-control" id="planif-text" name="planif-text">
          </div>
          <div class="form-group">
            <label for="cmd-text" class="control-label" style="font-weight: bold;text-decoration:underline;">Commande:</label>
            <input type="text" class="form-control" id="cmd-text" name="cmd-text">
          </div>
          <input type="hidden" class="form-control" id="host-text" name="host-text">';
$MODAL[1] = "
  var cmd = button.data('cmd')
  var host = button.data('host')
  var planif = button.data('planif')
  modal.find('#cmd-text').val(cmd)
  modal.find('#planif-text').val(planif)
  modal.find('#host-text').val(host)";
$MODAL[2] = '"/www/controleur/planification.php"';