<center><h1 style='color:#014051'>Etat de la Freebox</h1></center>

<?php
$nb = 0;
foreach ($array as &$value) {
	
	$titre = array_slice(explode("\n", $value),0, 1);
	$value = implode("\n", array_slice(explode("\n", $value),3));
	if ($nb == 0) {
		echo '<div class="col-sm-6 col-md-6">';
	}
	
	$nb++;
	
	echo '<div class="panel panel-primary" >
	  <div class="panel-heading"><strong>'.$titre[0].'</strong></div>
	    <div class="panel-body" style="font-family:\'DejaVu Sans Mono\',\'Everson Mono\',FreeMono,\'Andale Mono\',monospace">';
	$contenu = explode("\n", $value);
	foreach ( $contenu as &$line) {
		$line = preg_replace('/\s/','&nbsp;', $line);
		
		#$line = preg_replace("/^&nbsp;[-]+$/",'<hr style="border-style:1px groove black;">', $line);
		echo $line."<br />";
	}
	#echo nl2br($value);
	echo '</div></div>';
	if ($nb == 3) {
		echo '</div>';
		$nb = 0;
	}
}
?>