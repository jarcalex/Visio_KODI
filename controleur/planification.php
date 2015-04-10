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
    <i class='glyphicon glyphicon-edit' style='color:blue;cursor: pointer;' onClick='submit_edit(\"${machine}-${inc}\")'></i>
    <i class='glyphicon glyphicon-remove' style='color:red;cursor: pointer;' onClick='submit_delete(\"${machine}-${inc}\")'></i>
    </td>";
            $CronTab .= "  </tr>\n";
            $inc++;
        }
    }
}