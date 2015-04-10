<?php
while($data = $Raw->fetchArray(SQLITE3_ASSOC)) {
	$poster = "/www/ressource/image_movie/".$data["image_url"];
	if ($cmpt == 0) {
		echo '<div class="row">
    <center>';
	}
	$cmpt++;
?>
    <div class="col-md-2">
        <div class="thumbnail link_kodi">
            <a href="<?php echo $URI.$data["id_movie"]; ?>" class="">
	            <img src="<?php echo  $poster; ?>" class="img-responsive img-thumbnail" alt="" style="width:140px;">
	            <h5><?php echo $data["titre"]; ?></h5>
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
