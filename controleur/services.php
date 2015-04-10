<?php


if (isset($_GET['srv'])) {
    include_once('sgbd.php');
    $res = $bdd->query("SELECT * from service where id = ".$_GET['srv']);
    while($tt = $res->fetchArray(SQLITE3_ASSOC)) {
	$output = array();
        exec($tt["cmd_status"], $output, $return_var);
        if(isset($output[0]) && $output[0] >= "1") {
        	$status = "ok' style='color: #5cb85c'";
        } else {
            $status = "warning-sign' style='color: #d9534f'";
            $output[0] = "-1";
        }
?>
       <div class='span5' style="margin-bottom:10px">
         <i class="glyphicon glyphicon-cog"></i><strong>Descritption‌·:‌·</strong><?php echo $tt["detail"]; ?><br />
         <i class="glyphicon glyphicon-cog"></i><strong>Host‌·:‌·</strong><?php echo $tt["local"]; ?><br />  
         <i class="glyphicon glyphicon-cog"></i><strong>Status‌·:‌·</strong><i class='glyphicon glyphicon-<?php echo $status; ?>'></i><br /> 
       </div>
       <div style='text-align:center'>
         <div class="btn-group">
          <button type="button" class="btn btn-success btn-sm" onclick="submitsrvc('<?php echo $tt['id'];?>','start')" <?php if ($output[0] >= "1") {echo "disabled";}?>><span class="glyphicon glyphicon-play"></span> Start</button>
          <button type="button" class="btn btn-info btn-sm" onclick="submitsrvc('<?php echo $tt['id'];?>','restart')"  <?php if ($output[0] == "0" || $output[0] == "-1" ) {echo "disabled";}?>><span class="glyphicon glyphicon-refresh"></span> Restart</button>
          <button type="button" class="btn btn-danger btn-sm" onclick="submitsrvc('<?php echo $tt['id'];?>','stop')"   <?php if ($output[0] == "0" || $output[0] == "-1" ) {echo "disabled";}?>><span class="glyphicon glyphicon-stop"></span> Stop</button>
         </div>
       </div>
<?php
	}
	exit;
}


if (isset($_POST['serviceID']) and isset($_POST['etat'])) {
    $res = $bdd->query("SELECT * from service where id = ".$_POST['serviceID']);
    while($tt = $res->fetchArray(SQLITE3_ASSOC)) {
        $detail = array();
        #echo "Cmd: ".$tt["cmd"]." ".$_POST['etat']."<br />";
        exec($tt["cmd"]." ".$_POST['etat'], $detail, $return_var);
	$result  =  join(",",$detail);
        echo "<br /><div class='row'>
<div class='col-md-6 col-md-offset-3'><div class='alert alert-info' id='msg'>Code retour: ".$return_var." - ".$result."</div></div>
</div>";
    }
}



$array_SVC = array();
$res = $bdd->query("SELECT * from service");
while($tt = $res->fetchArray(SQLITE3_ASSOC)) {
	array_push($array_SVC, $tt);
}
$inc = 0;
