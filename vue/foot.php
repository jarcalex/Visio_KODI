	<!-- Page Content -->	
	</div>
	
<script src="<?php echo $HOME; ?>js/jquery.min.js"></script>
<script src="<?php echo $HOME; ?>js/bootstrap.js"></script>
<!-- JS Home -->
<script src="<?php echo $HOME; ?>js/details.js"></script>
<!-- JS Domotique -->
<script src="<?php echo $HOME; ?>js/bootstrap.switch.js"></script>
<script src="<?php echo $HOME; ?>js/tmp.js"></script>

<script type="text/javascript">
    $(document).ready( function ()
    {
        $("#msg").delay(4000).hide(500);
    });
</script>


<script>

$(document).ready(function(){
    function fix_sidebar(){
        var h = $("body").width();
        if (h > 450) {
            $('.left-side').removeClass("collapse-left");
            $(".right-side").removeClass("strech");
        } else {
            $('.left-side').addClass("collapse-left");
            $(".right-side").addClass("strech");
        }
    }
    $(window).resize(function(){ fix_sidebar(); }).resize();
    
    /*fix_sidebar();*/
 });
     function sidebar() {
        if ($('.left-side').hasClass("collapse-left")){
            $('.left-side').removeClass("collapse-left");
            $(".right-side").removeClass("strech");
        } else {
            $('.left-side').addClass("collapse-left");
            $(".right-side").addClass("strech");
        }
    }

</script>

<!-- JS Console && Pyload-->
<?php
if (isset($URL[1]) && (preg_match('/Console/i',$URL[1]) || preg_match('/nas/i',$URL[1]) || preg_match('/pyload/i',$URL[1]) ||
                       preg_match('/Codiad/i',$URL[1]) || preg_match('/owncloud/i',$URL[1]) || preg_match('/APC/i',$URL[1]) || preg_match('/SQLAdmin/i',$URL[1])  )) {
?>
<script>
  $(document).ready(function(){
     function fix_height(){
       var h = $("#header").height();
       if (/nas/i.test("<?php echo $URL[1];?>")) {
        $("#frame_content").attr("height", (($(window).height()) - h + 30) + "px");
       } else {
        $("#frame_content").attr("height", (($(window).height()) - h - 50) + "px");
       }
       $("#body").attr("style", "width:100%;padding:0");
     }
     $(window).resize(function(){ fix_height(); }).resize();
  });
</script>
<?php
} 
?>

<?php if (isset($JS)){ echo $JS; } ?>

<?php
if (isset($MODAL)) {
    include_once('modele/modal.php');
    CreateModal ($MODAL[0], $MODAL[1], $MODAL[2]);
}
?>

</body>
</html>