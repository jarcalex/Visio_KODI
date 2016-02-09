<div class="row">
  <div class="alert alert-info hidden" id="msg"></div>
	<div class="col-md-2">
    <center>
        <img src="<?php echo  $poster[0]; ?>" class="img-responsive img-thumbnail" alt="" style="width:280px;">
        <br /><br />
        <p style="font-size: 20px; padding-left: 10px; cursor:pointer;" onClick="send_play(<?php echo $URL[3]; ?>)" > <i class="glyphicon glyphicon-play"> </i> Play </p>
      </center>
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


<script language="javascript" type="text/javascript">
function send_play(ID) {
    $.ajax({
        type: "POST",
        url: "<?php echo $ACTION; ?>?type=movie_view", //
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
</script>
