
<div class="row">
	<div class="col-md-2">
        <img src="<?php echo  $poster[0]; ?>" class="img-responsive img-thumbnail" alt="" style="width:280px;">
        <br /><br />
    </div>
    
    <div class="col-md-8">
        <h4>
        <?php echo $Raw["label"]; ?>
        </h4>
        <p><b>Sortie: </b><span><?php echo $Raw["year"]; ?></span></p>
        <p><b>Studio: </b><?php foreach(explode(" / ", $Raw["c18"]) as $stud) { ?><span class="label label-primary"><?php echo $stud; }?></span></p>
        <p><b>Note: </b><span class="label label-primary"><?php echo number_format($Raw["rating"], 1); ?></span></p>
        <p><b>Pays d'origine: </b><span class="badge"><?php echo $Raw["c21"]; ?></span></p>
        <p><b>Date d'ajout: </b><span class="badge"><?php echo $Raw["dateAdded"]; ?></span></p>
        <p><b>Synopsis: </b><?php echo $Raw["plot"]; ?></p>
        <p>
	        <b>Genre: </b>
	        <?php
	        	foreach (explode(" / ", $Raw["genre"]) as $genre) {
	        ?>
	        	<span class="label label-primary"><?php echo $genre; ?></span>
	        <?php		
	        	}
	        ?>
        </p>
        <div class="row">
            <div class="col-md-4">
                <p><b>Play: </b>
                <span class="badge">
                     <?php if (isset($Raw["playCount"])) { echo $Raw["playCount"]; } else { echo "N/A";} ?>
                </span>
                </p>
            </div>
            <div class="col-md-4">
            </div>
            <div class="col-md-4">
            	<p>
            	<?php
            	if ($Raw["lastPlayed"] == '') {
            		
            	}else {
                ?>
                <b>LastPlay: </b>
                    <?php echo $Raw["lastPlayed"]; ?>
                <?php
                }
                ?>
                </p>
            </div>
        </div>

        <p><span class="label label-danger"><span class="glyphicon glyphicon-link"></span> <?php echo $Raw["c22"]; ?></span></p>
        <center><?php foreach ($poster as $art) {?><img src="<?php echo  $art; ?>" class="img-responsive img-thumbnail" alt="" style="width:180px;">
        <?php } ?>
        </center><hr />
   	</div>
</div>