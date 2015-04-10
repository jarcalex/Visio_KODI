<h2 style='text-align:center; color: #d8e0de'>WebStatus</h2>
<br />
  <div class="container details" style="padding-top: 10px">
	<div class="row">
	  <div class="col-sm-6 col-md-6" >
	   <div class="panel panel-info" >
	    <div class="panel-heading" > <h5><i class="glyphicon glyphicon-check"></i> Système</h5></div>
	    <div class="panel-body">
	     <i class="glyphicon glyphicon-cog"></i><strong>Distribution : </strong> <span class="text-info"><?php echo $distribution ?></span><br />
	     <i class="glyphicon glyphicon-cog"></i><strong>Kernel : </strong>  <?php echo $Kernel ?><br />
	     <i class="glyphicon glyphicon-cog"></i><strong>HostName : </strong> <span class="text-info"><?php echo $hostname ?></span><br />
	     <i class="glyphicon glyphicon-cog"></i><strong>Uptime : </strong> <?php echo $uptime; ?><br />
	     <i class="glyphicon glyphicon-cog"></i><strong>Firmware : </strong> <?php echo $Firmware ?><br />
	    </div></div> <!-- End panel -->
	    
        <div class="panel panel-danger" >
	    <div class="panel-heading" > <h5><i class="glyphicon glyphicon-tasks"></i> CPU <?php echo icon_alert($cpu['alert']); ?></h5></div>
	    <div class="panel-body">
	     <strong>Loads :</strong> <?php echo $cpu['loads']; ?> [1 min] &middot; <?php echo $cpu['loads5']; ?> [5 min] &middot; <?php echo $cpu['loads15']; ?> [15 min] <br />
	     <strong>Fréquence :</strong> <span class="label label-info"><?php echo $cpu['current']; ?></span> (Max <?php echo $cpu['max']; ?>/ Min <?php echo $cpu['min']; ?>)<br />
	     <strong>governor : </strong> <?php echo $cpu['governor']; ?>
	    </div></div><!-- End panel -->
	    
        <div class="panel panel-warning" >
	    <div class="panel-heading"><h5><i class="glyphicon glyphicon-globe"></i> Réseau <?php echo icon_alert($net_connections['alert']); ?></h5></div>
	    <div class="panel-body">
	     <strong>IP LAN :</strong> <code> <?php echo $IP; ?> </code> <br />
	     <strong>IP WAN :</strong> <code> <?php echo externalIp(); ?> </code> <br />
	     <strong>Ethernet :</strong> <?php echo $net_eth['up']; ?>Mb Montant  ·  <?php echo $net_eth['down']; ?>Mb Descendant <br />
	     <strong>Connexions :</strong>  <span class="label label-info"><?php echo $net_connections['connections']; ?></span> <br /><br />
	    </div></div><!-- End panel -->
	    
	    <div class="panel panel-success" >
	    <div class="panel-heading" ><h5><i class="glyphicon glyphicon-user"></i> Utilisateurs <span class="badge"><?php echo sizeof($users); ?> </h5></div>
	    <div class="panel-body">
	      <ul class="unstyled">
    	<?php
    	  if (sizeof($users) > 0) {
    	    for ($i=0; $i<sizeof($users); $i++)
    	      echo '<li><span class="label label-info">', $users[$i]['user'] ,'</span> le <strong>', $users[$i]['date'], '</strong> à <strong>', $users[$i]['hour'], '</strong> depuis <strong>', $users[$i]['ip'] ,'</strong> </li>', "\n";
    	  }
    	  else
    	    echo '<li>Aucun utilisateur de connecté</li>';
    	?>
	      </ul>
	</div></div><!-- End panel -->

</div><!-- End ROW -->

<div class="col-sm-6 col-md-6">
	<table>
	  <tr id="check-cpu-heat">
	    <td class="check"><i class="glyphicon glyphicon-fire"></i> CPU</td>
	    <td class="icon"><?php echo icon_alert($cpu_heat['alert']); ?></td>
	    <td class="infos">
		<div class="progress" id="popover-cpu">
	<div class="progress-bar progress-bar-<?php echo $cpu_heat['alert']; ?>" style="width: <?php echo $cpu_heat['percentage']; ?>%;"><?php echo $cpu_heat['percentage']; ?>%</div>
	    </div>
		<div id="popover-cpu-head" class="hide">Top CPU eaters</div>
		<div id="popover-cpu-body" class="hide"><?php echo shell_to_html_table_result($cpu_heat['detail']); ?></div>
	      Temperature: <span class="text-info"><?php echo $cpu_heat['degrees']; ?>°C</span>
	    </td>
	  </tr>

	  <tr id="check-ram">
	    <td class="check"><i class="glyphicon glyphicon-asterisk"></i> RAM</td>
	    <td class="icon"><?php echo icon_alert($ram['alert']); ?></td>
	    <td class="infos">
		<div class="progress" id="popover-ram">
	<div class="progress-bar progress-bar-<?php echo $ram['alert']; ?>" style="width: <?php echo $ram['percentage']; ?>%;"><?php echo $ram['percentage']; ?>%</div>
	    </div>
		<div id="popover-ram-head" class="hide">Top RAM eaters</div>
		<div id="popover-ram-body" class="hide"><?php echo shell_to_html_table_result($ram['detail']); ?></div>
	      free: <span class="text-success"><?php echo $ram['free']; ?>Mb</span>  &middot; used: <span class="text-warning"><?php echo $ram['used']; ?>Mb</span> &middot; total: <?php echo $ram['total']; ?>Mb
		</td>
	  </tr>

	  <tr id="check-swap">
	    <td class="check"><i class="glyphicon glyphicon-refresh"></i> Swap</td>
	    <td class="icon"><?php echo icon_alert($swap['alert']); ?></td>
	    <td class="infos">
	      <div class="progress">
	<div class="progress-bar progress-bar-<?php echo $swap['alert'];?>" style="width: <?php echo $swap['percentage'];?>%;"><?php echo $swap['percentage'];?>%</div>
	      </div>
	      free: <span class="text-success"><?php echo $swap['free'];?>Mb</span>  &middot; used: <span class="text-warning"><?php echo $swap['used'];?>Mb</span> &middot; total: <?php echo $swap['total']; ?>Mb
	    </td>
	  </tr>

	  <tr class="storage" id="check-storage">
	    <td class="check" rowspan="<?php echo sizeof($hdd); ?>"><i class="glyphicon glyphicon-hdd"></i> Storage</td>
	    <?php
	      for ($i=0; $i<sizeof($hdd); $i++) {
        	if ($hdd[$i]['name'] == "") {
        		continue;
        	} ?>
    	<td class="icon" style="padding-left: 10px;"><?php echo icon_alert($hdd[$i]['alert']) ?></td>
    	<td class="infos">
    	  <i class="glyphicon glyphicon-folder-open"></i> <?php echo $hdd[$i]['name'] ?>
    	  <div class="progress">
    	    <div class="progress-bar progress-bar-<?php echo $hdd[$i]['alert'];?>" style="width: <?php echo $hdd[$i]['percentage']; ?>%;"><?php echo $hdd[$i]['percentage'];?>%</div>
    	  </div>
    	    free: <span class="text-success"><?php echo $hdd[$i]['free'] ?>b</span> &middot; used: <span class="text-warning"><?php echo $hdd[$i]['used'] ?>b</span> &middot; total: <?php echo  $hdd[$i]['total']?>b &middot; format: <?php echo $hdd[$i]['format'] ?>
    	</td>
	  </tr>
	   <?php echo ($i == sizeof($hdd)-1) ? null : ' <tr class="storage">';
	      }
	    ?>
	    </table>
      </div>
    </div>