<center>
  <div class="alert alert-info hidden" id="msg"></div>
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
<?php if ($Nb_sp_have != 0 && $Nb_sp_total != 0) { ?>          
          <div class="progress">
            <div style="width: <?php echo $progress_sp; ?>%" class="progress-bar"><b><?php echo $Nb_sp_have."/".$Nb_sp_total; ?></b></div>
          </div>
<?php } ?>
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
            echo '<img src="'.$art.'" onerror="onImgErrorLast(this)" class="img-responsive img-thumbnail" alt="" style="width:180px;" id="image-'.$i.'">';
            $i++;
        }
        ?>
        </center><hr />
        <?php if ( $haveEP == 1 ) {?>
        <center><h2 class="sub-header">Liste des Episodes</h2></center>
        
        <div class="nav-tabs-custom">
          <ul class="nav nav-tabs">
        		<?php echo $ListeSaison; ?>
          </ul>
          <div class="tab-content">
            <?php echo $Episodedetail; ?>
          </div>
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

<script language="javascript" type="text/javascript">
function send_play(ID) {
    $.ajax({
        type: "POST",
        url: "<?php echo $ACTION; ?>?type=tvshow_view", //
        data: 'play=' + ID,
        success: function(msg){
                $("#msg").html(msg)
                $('#msg.hidden').css('visibility','visible').hide().fadeIn().removeClass('hidden');
        },
        error: function(){
                alert("failure");
        }
    });
}

function onImgError(source, url){
    source.onerror = null;
    source.src = url;
    var oImg=new Image;
    oImg.src = url

    if(oImg.complete){
      console.info("Utilisation de l'image cache Complete");
      source.src = oImg.src;
      
    } else {
      source.onerror = onImgErrorLast(source);
  }
}

function onImgErrorLast(source){
  console.info("Mise en place de l'image d'erreur");
  source.style = "display: none";
  source.src = "/img/out.png";
}

</script>



