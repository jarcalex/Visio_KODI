<center>
<?php
foreach ($Raw as $data){
	$poster = _GetPoster_TV($data["Art"], "posters", 1);
	if ($cmpt == 0) {
		echo "<div class='row'>\n";
	}
	$cmpt++;
?>
    <div class="col-md-2">
        <div class="thumbnail link_kodi">
            <a href="<?php echo $URI.$data["id"]; ?>" class="" data-toggle="tooltip" data-placement="bottom" title="<?php echo $data["Titre"]; ?>">
	            <img src="<?php echo  $poster[0]; ?>" class="img-responsive img-thumbnail"  style="width:140px;">
	            <h5><?php echo mb_strimwidth($data["Titre"], 0, 18, "..."); ?></h5>
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
</center>

<style>
@media screen and (min-height: 800px) {
html,
body {
  overflow-x: hidden!important;
  overflow-y: hidden!important;
  -webkit-font-smoothing: antialiased;
  min-height: 100%;
  /*background: #f9f9f9;*/
}
}
</style>