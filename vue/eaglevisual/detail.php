<div class="row">
	<div class="col-md-2">
        <img src="<?php echo  $poster; ?>" class="img-responsive img-thumbnail" alt="" style="width:280px;">
        <br /><br />
    </div>
    
    <div class="col-md-8">
        <h4>
        <?php echo $Raw["titre"]; ?>
        </h4>
        <p><b>Année de diffusion: </b><span class="label label-primary"><?php echo $Raw["annee"]; ?></span></p>
        <p><b>Nb d'épisodes: </b><span class="label label-primary"><?php echo $Raw["nb_ep"]; ?></span></p>
        <p><b>Version: </b><span class="label label-primary"><?php echo $Raw["version"]; ?></span></p>
        <p><b>Synopsis: </b><?php echo $Raw["desc"]; ?></p>
        <p><b>Genre: </b><span class="label label-primary"><?php echo $Raw["genre"]; ?></span></p>
        <p>
        <?php
            foreach (explode(",", $Raw["emplacement"]) as $empl) {
        ?>
	        <span class="label label-danger"><span class="glyphicon glyphicon-link"></span> <?php echo $empl; ?></span>    	
        <?php } ?>
        </p>
        <hr />
   	</div>
</div>
