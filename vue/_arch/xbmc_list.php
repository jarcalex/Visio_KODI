<br />
<div class="row">
    <div role="complementary" class="col-md-3 col-md-pull-9 nav_media">
        <form name="form1" method="post" class="well form-inline" style="padding:8px">
            <input class="form-control" style='width:100%' type="text" id="formGroupInputSmall" placeholder="Titre..." name="titre" value="<?php if (isset($_POST["titre"])) { echo $_POST["titre"]; } ?>" >
            <select class='form-control' name='operator' style ='padding:0; width:20%'><option value="contains">=</option><option value="lessthan"><</option><option value="greaterthan">></option></select><input class="form-control" style='width:80%;padding:0;' type="text" id="formGroupInputSmall" placeholder="    Année..." name="annee" value="<?php if (isset($_POST["annee"])) { echo $_POST["annee"]; } ?>" >
            <select class='form-control' name='Genres[]' style='width:100%' multiple >
                <option value="">Choisir un genre...</option>
                <?php echo $slct_genre ?>
            </select><br /><br />
            <center><input type='submit' value='Search' name='Action' class='btn btn-info' /></center><br />
        
        </form>
        <div class="thumbnail">
        <fieldset>  
            <legend><i class="glyphicon glyphicon-film"></i> Gestion Mediatech</legend><center>
            <input type="button" class="btn btn-warning" <?php echo $UP;?> id="scan" value="Rescan" />
            </center>
        </fieldset>  
        </div>
    </div>
    <div role="main" class="col-md-9 col-md-push-3 main_media">
<?php
foreach ($Raw as $data){
	$poster = _GetPoster($data["Art"], "posters", 0);
	if ($cmpt == 0) {
		echo '<div class="row">
    <center>';
	}
	$cmpt++;
?>
    <div class="col-md-2 kodi_list">
        <div class="thumbnail" style="min-height:230px; text-align:">
            <a href="<?php echo $URI.$data["id"]; ?>" class="link_kodi">
	            <img src="<?php echo  $poster[0]; ?>" class="img-responsive img-thumbnail" alt="" style="width:140px;">
	            <h5><?php echo $data["Titre"]; ?></h5>
	        </a>
	    </div>
	</div> <!-- End div col-md-3 -->
<?php
	if ($cmpt == 6) {
		echo "</div>\n";
		$cmpt = 0;
	}
}
if ($cmpt != 0) { echo "</div>\n"; }
?>
    </div>
</div>


  <script src="/www/js/jquery.min.js"></script>
  <script type="text/javascript">

    $(document).ready(function () {
      $("input#scan").click(function(){
		$.ajax({
			type: "POST",
			url: "<?php echo $SCAN; ?>", // 
			data: "",
			success: function(msg){
				alert("Cool");
			},
			error: function(){
				alert("failure");
			}
		});
	  });
    });

	function post(path, params, method) {
	    method = method || "post"; // Set method to post by default if not specified.
	
	    // The rest of this code assumes you are not using a library.
	    // It can be made less wordy if you use one.
	    var form = document.createElement("form");
	    form.setAttribute("method", method);
	    form.setAttribute("action", path);
	
	    for(var key in params) {
	        if(params.hasOwnProperty(key)) {
	            var hiddenField = document.createElement("input");
	            hiddenField.setAttribute("type", "hidden");
	            hiddenField.setAttribute("name", key);
	            hiddenField.setAttribute("value", params[key]);
	
	            form.appendChild(hiddenField);
	         }
	    }
	
	    document.body.appendChild(form);
	    form.submit();
	}
  </script>

