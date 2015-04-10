    <center>
      <br />
      <div class="panel panel-warning" >
       <div class="panel-body">
	<!-- Begin page content -->
        <div class="alert alert-error hide" id="message"></div>
        <i id="insertionPoint"></i> 
        <table id="infotable" border=0>
          <tr><td></td></tr>
        </table>
        <div id="preloader" class="text-center"><img src="/www/img/preloader.gif"></div>
        <div id="mygraph"></div>
        <div id="push"></div>
      </div>
     </div>
     <div id="dialogs"></div>
   </center>

 
 <!-- JS statistics   -->
<script src="<?php echo $HOME; ?>js/jquery.min.js"></script>
<script src="<?php echo $HOME; ?>js/bootstrap.js"></script>
<!-- JS Home -->
<script src="<?php echo $HOME; ?>js/details.js"></script>
<script type="text/javascript" src="<?php echo $HOME; ?>js/javascriptrrd/binaryXHR.js"></script>
<script type="text/javascript" src="<?php echo $HOME; ?>js/javascriptrrd/rrdFile.js"></script>
<script type="text/javascript" src="<?php echo $HOME; ?>js/javascriptrrd/rrdMultiFile.js"></script>
<script type="text/javascript" src="<?php echo $HOME; ?>js/javascriptrrd/rrdFlotSupport.js"></script>
<script type="text/javascript" src="<?php echo $HOME; ?>js/javascriptrrd/rrdFlot.js"></script>
<script type="text/javascript" src="<?php echo $HOME; ?>js/javascriptrrd/rrdFilter.js"></script>

<script type="text/javascript" src="<?php echo $HOME; ?>js/flot/jquery.flot.min.js"></script>
<script type="text/javascript" src="<?php echo $HOME; ?>js/flot/jquery.flot.selection.min.js"></script>
<script type="text/javascript" src="<?php echo $HOME; ?>js/flot/jquery.flot.tooltip.min.js"></script>

<script src="<?php echo $HOME; ?>js/rpimonitor.js"></script>
<script src="<?php echo $HOME; ?>js/rpimonitor.statistics.js"></script>

<?php exit;?>