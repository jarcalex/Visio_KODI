<div class="row">
	<div class="col-md-4">
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