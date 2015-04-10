<center>
  <br />
  <br />
  <img src="<?php echo  $banner[0]; ?>" class="img-responsive img-thumbnail" alt="" >
  <br /> <br />
</center>
<div class="row">
	<div class="col-md-2">
        <img src="<?php echo  $poster[0]; ?>" class="img-responsive img-thumbnail" alt="" style="width:280px;">
        <br /><br />
    </div>
    
    <div class="col-md-8">
        <h4>
        <?php echo $Raw["label"]; ?>
        </h4>
        <p><b>Première Diffusion: </b><span><?php echo $Raw["year"]; ?></span></p>
        <p><b>Diffuseur: </b><?php foreach(explode(" / ", $Raw["Diff"]) as $Diff) { ?><span class="label label-primary"><?php echo $Diff; }?></span></p>
    
        <p><b>Note: </b><span class="label label-primary"><?php echo number_format($Raw["rating"], 1); ?></span></p>
        <p><b>Nb de saisons: </b><span class="badge"><?php echo $Raw["totalSeasons"]; ?></span></p>
        <p><b>Nb d'épisodes: </b> <!--<span class="label label-primary"><?php echo $Raw["totalCount"]; ?></span>-->
          <div class="progress">
            <div style="width: <?php echo $progress; ?>%" class="progress-bar"><b><?php echo $Raw["totalCount"]."/".$info; ?></b></div>
          </div>
        </p>
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

        <p><span class="label label-danger"><span class="glyphicon glyphicon-link"></span> <?php echo $Raw["strPath"]; ?></span></p>
        <center><?php foreach ($fanart as $art) {?><img src="<?php echo  $art; ?>" class="img-responsive img-thumbnail" alt="" style="width:180px;">
        <?php } ?>
        </center><hr />
        <?php if ($detail != "") {?>
        <center><h2 class="sub-header">Liste des Episodes</h2></center>
        <div class="table-responsive" style="border-radius:8px; background-color:#81BEF7;font-weight:bold">
          <table class="table table-striped">
          <thead>
            <tr>
              <th>#</th>
              <th>Titre</th>
              <th>Durée</th>
              <th></th>
            </tr>
          </thead>
          <tbody>
            <?php echo $detail; ?>
          </tbody>
          </table>
   		</div>
   	</div>
</div>
   		<?php } ?>
