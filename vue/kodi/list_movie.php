<?php
foreach ($Raw as $data){
	$poster = _GetPoster_Movie($data["Art"], "posters", 0);
	if ($cmpt == 0) {
		echo '<div class="row">
    <center>';
	}
	$cmpt++;
?>
    <div class="col-md-2">
        <div class="thumbnail link_kodi">
            <a href="<?php echo $URI.$data["id"]; ?>" class="">
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