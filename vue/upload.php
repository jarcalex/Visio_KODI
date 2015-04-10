<center>
	<br />
	<div class="panel panel-primary" >
		<div class="panel-heading"><strong>Liste des fichiers</strong></div>
		<div class="panel-body">
		<div class='table-responsive'>
			<form name="download"  method='POST'>
				<table class='table'>
					<?php listeDossier("/app/www/upload",""); ?>
				</table>
				<input type="submit" name="del" style="width:100px" class="btn btn-warning" value="Suppr" />
			</form>
		</div>
		</div>
	</div>
	
	<br />
	
	<form method="post" enctype="multipart/form-data">     
		<input type="hidden" name="MAX_FILE_SIZE" value="10485760">     
		<input type="file" name="nom_du_fichier"> <br /><br />  
		<input type="submit" class="btn btn-default" value="Envoyer">    
	</form>
	<br />
	
	<div class="alert alert-success" id="note_wake" style="display:<?php echo $display_info; ?>" ><?php echo $info; ?></div>
</center>