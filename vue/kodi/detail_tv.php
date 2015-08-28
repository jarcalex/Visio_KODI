<center>
  <br />
  <img src="<?php echo  $banner[0]; ?>" class="img-responsive img-thumbnail" alt="" >
  <br /> <br />
</center>
<div class="row">
    <div class="col-md-12">
        <h4>
        <?php echo $Raw["label"]; ?>
        </h4>
        <p><b>Première Diffusion: </b><span><?php echo $Raw["year"]; ?></span></p>
        <p><b>Diffuseur: </b><?php foreach(explode(" / ", $Raw["Diff"]) as $Diff) { ?><span class="label label-primary"><?php echo $Diff; }?></span></p>
    
        <p><b>Note: </b><span class="label label-primary"><?php echo number_format($Raw["rating"], 1); ?></span></p>
        <p><b>Nb de saisons: </b><span class="badge"><?php echo $Raw["totalSeasons"]; ?></span></p>
        <p><b>Nb d'épisodes: </b>
          <div class="progress">
            <div style="width: <?php echo $progress_ep; ?>%" class="progress-bar"><b><?php echo $Nb_ep_have."/".$Nb_ep_total; ?></b></div>
          </div>
          
          <div class="progress">
            <div style="width: <?php echo $progress_sp; ?>%" class="progress-bar"><b><?php echo $Nb_sp_have."/".$Nb_sp_total; ?></b></div>
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
        <p><b>TVDB: </b><a href="http://thetvdb.com/index.php?tab=series&id=<?php echo $Raw["id_tvdb"]; ?>&lid=17"> Link </a></p>
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
        <center><?php
        $i=0;
        foreach ($fanart as $art) {
            echo '<img src="'.$art.'" class="img-responsive img-thumbnail" alt="" style="width:180px;" id="image-'.$i.'">';
            $i++;
        }
        ?>
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
   		
<!-- Creates the bootstrap modal where the image will appear -->
<div class="modal fade" id="imagemodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog" style="width:400px">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel">Image preview</h4>
      </div>
      <div class="modal-body" style="text-align:center">
        <img src="" id="imagepreview" >
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
