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
/*  $(document).ready(function(){
     function fix_height_body(){
       var h = $("body").height();
       if (h > 1600 ) {
            $("body").attr("style", "background-size:auto");
       }
     }
     $(window).resize(function(){ fix_height_body(); }).resize();
  });*/
</script>

<!-- JS Console && Pyload-->
<?php
if (isset($URL[1]) && (preg_match('/Console/i',$URL[1]) || preg_match('/nas/i',$URL[1]) || preg_match('/pyload/i',$URL[1]) ||
                       preg_match('/Codiad/i',$URL[1]) || preg_match('/owncloud/i',$URL[1]) || preg_match('/MyAdmin/i',$URL[1])  )) {
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
<script type="text/javascript">
<?php
	if (isset($URL[1]) && (preg_match('/Service/i',$URL[1]))) {
		foreach( $array_SVC as $cle=>$arrayValue ) {
		    $namecourt = str_replace(" ", "_", $arrayValue['Service name']);
	        echo "esm.get".$namecourt.$arrayValue['id']." = function() {\n";
	        echo '$( "#'.$namecourt.$arrayValue['id'].'" ).load( "'.$HOME.'controleur/services.php?srv='.$arrayValue['id'].'" );';
	        echo "\n}\n";
	    }
	    echo "\nesm.getAll = function() {\n";
	    $res = $bdd->query("SELECT * from service");
		while($tt = $res->fetchArray(SQLITE3_ASSOC)) {
	        $namecourt = str_replace(" ", "_", $tt['Service name']);
	        echo "   esm.get".$namecourt.$tt['id']."();\n";
	    }
	    echo "}\n";
	    echo "esm.getAll();\n";
	}
?>
</script>
<!--
<script src="<?php echo $HOME; ?>js/app.js" type="text/javascript"></script>
<script src="<?php echo $HOME; ?>js/demo.js" type="text/javascript"></script>
-->
</body>
</html>