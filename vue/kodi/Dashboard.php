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
        	</div>
        </div>
    </div>
</div>

<div class="alert alert-info hidden" id="msg"></div>

<script language="javascript" type="text/javascript">
function send_refresh(val) {
    $.ajax({
    	type: "POST",
    	url: "<?php echo $SCAN; ?>", // 
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
                	    <div class="info-box bg-green">
                	        <span class="info-box-icon"><i class="glyphicon glyphicon-film"></i></span>
                            <div class="info-box-content">
                              <span class="info-box-text">Nombre de Movie</span>
                              <span class="info-box-number"><?php echo $count[0]['Movie']; ?></span>
                              <div class="progress">
                                <div style="width: 70%" class="progress-bar"></div>
                              </div>
                              <span class="progress-description">
                                <?php echo $count[0]['Movie_last']; ?> in 30 Days
                              </span>
                            </div><!-- /.info-box-content -->
                	    </div>
                        <div class="info-box bg-red">
                            <span class="info-box-icon"><i class="glyphicon glyphicon-blackboard" style="-webkit-transform:  rotate(180deg);-moz-transform:  rotate(180deg);-o-transform:  rotate(180deg);writing-mode: lr-tb;"></i></span>
                            <div class="info-box-content">
                              <span class="info-box-text">Nombre de TVShow</span>
                              <span class="info-box-number"><?php echo $count[0]['TvShow']; ?></span>
                              <div class="progress">
                                <div style="width: 70%" class="progress-bar"></div>
                              </div>
                              <span class="progress-description">
                                <?php echo $count[0]['TvShow_last']; ?> in 30 Days
                              </span>
                            </div><!-- /.info-box-content -->
                        </div>
                    </div>        
                    <div class="col-md-6">
                        <div class="info-box bg-blue">
                            <span class="info-box-icon"><i class="glyphicon glyphicon-file"></i></span>
                            <div class="info-box-content">
                              <span class="info-box-text">Nombre de Fichier</span>
                              <span class="info-box-number"><?php echo $count[0]['Files']; ?></span>
                              <div class="progress">
                                <div style="width: 70%" class="progress-bar"></div>
                              </div>
                              <span class="progress-description">
                                <?php echo $count[0]['Files_last']; ?> in 30 Days
                              </span>
                            </div><!-- /.info-box-content -->
                        </div>
                        <div class="info-box bg-yellow">
                            <span class="info-box-icon"><i class="glyphicon glyphicon-th-list"></i></span>
                            <div class="info-box-content">
                              <span class="info-box-text">Nombre d'épisode</span>
                              <span class="info-box-number"><?php echo $count[0]['Episode']; ?></span>
                              <div class="progress">
                                <div style="width: 70%" class="progress-bar"></div>
                              </div>
                              <span class="progress-description">
                                <?php echo $count[0]['Episode_last']; ?> in 30 Days
                              </span>
                            </div><!-- /.info-box-content -->
                        </div>
                	</div>
                </div>
            </div>
        </div>
    </div>
</div>