<form name="srvc" method="post">
<input type="hidden" name="serviceID" id="serviceID" value="">
<input type="hidden" name="etat" id="etat" value="">

<?php
	$inc = 0;
    
	foreach( $array_SVC as $cle=>$arrayValue ) {
	    $namecourt = str_replace(" ", "_", $arrayValue['Service name']);

	    if ($inc == 0) {
            echo "<br />\n<div class='row'>";
	    }
	    $inc++;
?>
    <div class="col-md-3">
       <div class="panel panel-black">
         <div class="panel-heading" style="text-align:center"><strong><?php echo $arrayValue['Service name']; ?></strong></div>
         <div class="panel-body" id="<?php echo $namecourt.$arrayValue['id']; ?>"  style="min-height: 130px">
           <center>
             <img src="<?php echo $HOME; ?>img/ajax-loader.gif" id="loading-indicator" />
           </center>
         </div><!-- End panel-body -->
       </div><!-- End panel -->
    </div> <!-- End  col-md-3 -->
    
<?php
       if ($inc == 4) {
            echo "</div> <!-- End Row-->\n";
            $inc = 0;
	    }
	}
?>
</form>
<script type="text/javascript">
    function submitsrvc(e,f) {
        document.getElementById("serviceID").value = e;
        document.getElementById("etat").value = f;
        window.document.srvc.submit();
    }
    var esm = {};
</script>