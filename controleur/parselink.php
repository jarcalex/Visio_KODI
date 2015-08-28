<?php

if (isset($_POST['url'])) {
	echo "<h1>Zub!!</h1>";

	$ary = explode("\n",$_POST['url']);
	foreach($ary as $key => $val) {
$val = rtrim($val);
		$cmd = "/opt/valhalla/linux.pl -u ".$val;
		echo $cmd."<br />";
		$output = shell_exec($cmd);
		echo "<pre>$output</pre>";
	}
}else {
	# Création de l'ajax de chargement des status
	$JS = "<script type='text/javascript'>";
    $JS .= "$(document).ready(function () {
	$('button#download').click(function(){
		$.ajax({
			type: 'POST',
			url: '".$HOME."controleur/parselink.php',
			data: $('form.download').serialize(),
			success: function(msg){
				$('#msg').html(msg)
				$('#msg').show();
        		$('#msg.hidden').css('visibility','visible').hide().fadeIn().removeClass('hidden');
			},
			error: function(){
				alert('failure');
			}
		});
	});
});";
	$JS .= "</script>\n";
    
}
?>

