  <br />
  <div class="alert alert-info hidden" id="msg"></div>
  <div class='row'>
    <div class='col-md-6 col-md-offset-3'>
      <div class='panel panel-black'>
       <div class='panel-heading' style='text-align:center'><strong>Réglage</strong></div>
        <div class='panel-body'>
          <strong>Code Telecommande: </strong> <code><?php echo $variables['CODE'];?></code>
          <input type='text' name='telecommande' class='hidden' style='margin:0;padding:0' value='<?php echo $variables['CODE'];?>'> <br />
          <strong>N° du PIN emetteur: </strong> <code><?php echo $variables['PIN']; ?></code>
          <input type='text' name='PIN' class='hidden' style='margin:0;padding:0' value='<?php echo $variables['PIN']; ?>'> <br /><br />
          <a class="btn btn-primary btn-xs" href=""> Edit </a>
        </div>
      </div>
    </div>
  </div>
<?php
    $inc = 0;
    foreach( $materials as $cle=>$pin ) {
        $pinState = getPinState($pin,$pins);
        if ($inc % 3 == 0) {
            echo "<br /><div class='row'>";
        }
        $inc++; ?>
    <div class='col-md-4'><br />
        <div class='panel panel-black box box-solid collapsed-box' >
            <div class='panel-heading box-header' style='text-align:left'>
            	<!--<h3 class="box-title"></h3>--><strong><?php echo $cle; ?></strong>
            	<div class="box-tools pull-right" style="float: right;">
					<button class="btn btn-info btn-sm" data-widget="collapse" style="padding-top: 1px;"><i class="glyphicon glyphicon-plus"></i></button>
				</div>
            </div>
            <div class='panel-body box-body' style="display: none;"><img src='' style='float:left; '/>
                <form class='' name='' method='post'>
                    <hr />
                    <div style="float:right" >
                        <img src="<?php echo $HOME;?>img/Generic48_<?php echo $pinState; ?>.png" />
                    </div>

                    <div id="_Block_differer" class="input-group hidden" style="padding-left:40px;padding-top: 25px;padding-right: 40px">
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-addon">Durée</div>
                                <input class="form-control" type="text" name="times" placeholder="Dans X min">
                                <input type="text" name="after" id="after" class="hidden" style="margin:0;padding:0" value="0">
                            </div>
                        </div>
                    </div>
                </form>
            </div> <!-- End panel-body -->
        </div> <!-- End panel panel-black -->
    </div> <!-- End  col-md-4 -->
<?php
    if ($inc % 3 == 0) {
        echo "</div>";
    }
  }
?>
  
  <script src="<?php echo $HOME;?>js/jquery.min.js"></script>