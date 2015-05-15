<?php

if (!empty($_POST)) {
	include_once('sgbd.php');
	if ($_POST['id'] == 0) {
		$main = "FALSE";
		if (isset($_POST['main-check'])) {
			$main = "TRUE"; 
		}
		
		$req = 'INSERT INTO nav_section (label, parameters, file, style, haveinderlink, Parent, Order)
    VALUES ("'.$_POST["label-text"].'",
            "'.$_POST["parametre-text"].'","'.$_POST["file-text"].'",
            "'.$_POST["style-text"].'","'.$_POST["label-text"].'","'.$main.'",
            '.$_POST["parent-text"].','.$_POST["order-text"].'
            )';
        echo $req;
    	$bdd->query();
           
		echo "Inserted new link<br />";
	}
    exit;
}

$res = $bdd->query("SELECT * from nav_section where haveinderlink = 'TRUE'");
$parent = "<option value=''> </option>";
while($tmp = $res->fetchArray(SQLITE3_ASSOC)) {
    $parent .= "<option value='".$tmp['id']."'>".$tmp['label']."</option>";
}
?>

