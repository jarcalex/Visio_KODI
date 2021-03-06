<div class="row">
    <div class="col-md-12">
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">Source</h3>
                <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse"> <i class="glyphicon glyphicon-minus"></i> </button>
                </div>
            </div>
        	<div class="box-body">
        	    <div class="table-responsive">
                    <table class="table no-margin">
                        <tr>
                            <th>Path</th>
                            <th>Type</th>
                            <th>Nb de sous-dossier</th>
                            <th>Nb de fichier</th>
                            <th>Action</th>
                        </tr>
                        <?php echo $slct_dir;?>
                    </table>
                </div>
                <h3 class="box-title">CleanUp <i onClick="send_clean()" class="glyphicon glyphicon-erase" style="cursor:pointer"></i></h3>
        	</div>
        </div>
    </div>
</div>

<div class="alert alert-info hidden" id="msg"></div>

<script language="javascript" type="text/javascript">
function send_refresh(val) {
    $.ajax({
    	type: "POST",
    	url: "<?php echo $ACTION; ?>", // 
    	data: 'directory=' + val,
    	success: function(msg){
    		$("#msg").html(msg)
    		$('#msg.hidden').css('visibility','visible').hide().fadeIn().removeClass('hidden');	
    	},
    	error: function(){
    		alert("failure");
    	}
    });
}

function send_clean() {
    $.ajax({
    	type: "POST",
    	url: "<?php echo $ACTION; ?>", // 
    	data: 'CLEANUP=1',
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


<div class="row">
    <div class="col-md-12">
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">Stats</h3>
                <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse"> <i class="glyphicon glyphicon-minus"></i> </button>
                </div>
            </div>
        	<div class="box-body">
            	<div class="row">
                	<div class="col-md-6">
                	    <div class="info-box" style="background-color: #00a65a;color:#f9f9f9">
                	        <span class="info-box-icon"><i class="glyphicon glyphicon-film"></i></span>
                            <div class="info-box-content">
                              <span class="info-box-text">Nombre de Movie</span>
                              <span class="info-box-number"><strong><?php echo $count[0]['Movie']; ?></strong></span>
                              <div class="progress" style="height:10px">
                                <div style="width: <?php echo $count[0]['MovieView']; ?>%" class="progress-bar"></div>
                              </div>
                              <span class="progress-description">
                                <i class="glyphicon glyphicon-plus"></i> <strong><?php echo $count[0]['Movie_last']; ?></strong> en 30 Jours
                              </span>
                            </div><!-- /.info-box-content -->
                	    </div>
                        <div class="info-box" style="background-color: #f56954;color:#f9f9f9">
                            <span class="info-box-icon"><i class="glyphicon glyphicon-blackboard" style="-webkit-transform:  rotate(180deg);-moz-transform:  rotate(180deg);-o-transform:  rotate(180deg);writing-mode: lr-tb;"></i></span>
                            <div class="info-box-content">
                              <span class="info-box-text">Nombre de TVShow</span>
                              <span class="info-box-number"><strong><?php echo $count[0]['TvShow']; ?></strong></span>
                              <br />
                              <span class="progress-description">
                                <i class="glyphicon glyphicon-plus"></i> <strong><?php echo $count[0]['TvShow_last']; ?></strong> en 30 Jours
                              </span>
                            </div><!-- /.info-box-content -->
                        </div>
                    </div>        
                    <div class="col-md-6">
                        <div class="info-box" style="background-color: #0073b7;color:#f9f9f9">
                            <span class="info-box-icon"><i class="glyphicon glyphicon-file"></i></span>
                            <div class="info-box-content">
                              <span class="info-box-text">Nombre de Fichier</span>
                              <span class="info-box-number"><strong><?php echo $count[0]['Files']; ?></strong></span>
                              <br />
                              <span class="progress-description">
                                <i class="glyphicon glyphicon-plus"></i> <strong><?php echo $count[0]['Files_last']; ?></strong> en 30 Jours
                              </span>
                            </div><!-- /.info-box-content -->
                        </div>
                        <div class="info-box" style="background-color: #f39c12;color:#f9f9f9">
                            <span class="info-box-icon"><i class="glyphicon glyphicon-th-list"></i></span>
                            <div class="info-box-content">
                              <span class="info-box-text">Nombre d'épisode</span>
                              <span class="info-box-number"><strong><?php echo $count[0]['Episode']; ?></strong></span>
                              <div class="progress" style="height:10px">
                                <div style="width: <?php echo $count[0]['EpisodeView']; ?>%" class="progress-bar"></div>
                              </div>
                              <span class="progress-description">
                                <i class="glyphicon glyphicon-plus"></i> <strong><?php echo $count[0]['Episode_last']; ?></strong> en 30 Jours
                              </span>
                            </div><!-- /.info-box-content -->
                        </div>
                	</div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title"> Stat Video Codec </h3>
                <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse"> <i class="glyphicon glyphicon-minus"></i> </button>
                </div>
            </div>
        	<div class="box-body">
            	<div class="table-responsive">
                    <table class="table no-margin">
                        <tr>
                            <th>Codec</th>
                            <th>Nombre</th>
                        </tr>
						<?php echo $codec; ?>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>


