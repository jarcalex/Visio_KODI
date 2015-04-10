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
    foreach( $array_domotique as $cle=>$arrayValue ) {
	    if ($inc == 0) {
            echo "<br />\n<div class='row'>";
	    }
	    $inc++; ?>
    <div class='col-md-3'><br />
        <div class='panel panel-black box box-solid collapsed-box' >
            <div class='panel-heading box-header' style='text-align:left'>
            	<!--<h3 class="box-title"></h3>--><strong><?php echo $arrayValue['name']; ?></strong>
            	<div class="box-tools pull-right" style="float: right;">
					<button class="btn btn-primary btn-sm" data-widget="collapse" style="padding-top: 3px; font-size:10px"><i class="glyphicon glyphicon-plus"></i></button>
				</div>
            </div>
            <div class='panel-body box-body' style="display: none;"><img src='<?php echo $arrayValue['img']; ?>' style='float:left; '/>
                <form class='<?php echo $arrayValue['inc']; ?>' name='<?php echo $arrayValue['inc']; ?>' method='post'>
                    <input type='text' name='telecommande' class='hidden' style='margin:0;padding:0' value='<?php echo $variables['CODE']; ?>'>
                    <input type='text' name='PIN' class='hidden' style='margin:0;padding:0' value='<?php echo $variables['PIN']; ?>'>
                    <input type='text' name='id_bouton' class='hidden' style='margin:0;padding:0' value='<?php echo $arrayValue['Id_Interrupteur']; ?>'>
                    <ul  style='margin-left:30px;margin-bottom:30px' >
                        <li>Emplacement : <?php echo $arrayValue['description']; ?></li>
                        <li>N° de l'interrupteur : <code><?php echo $arrayValue['Id_Interrupteur']; ?></code></li>
                    </ul>
                    <hr style="margin-top:10px;margin-bottom:10px" />
                    <div style="float:left" >
                        <a onClick="Send('on','<?php echo $arrayValue['inc']; ?>')"  class="glyphicon glyphicon-off Buttom_on" ></a>
                    </div>
                    <div style="float:right" >
                        <a onClick="Send('off','<?php echo $arrayValue['inc']; ?>')" class="glyphicon glyphicon-off Buttom_off" <?php if (isset($arrayValue['status']) && $arrayValue['status'] == 0) { echo "disabled=disabled"; } ?> ></a>
                    </div>
                    <div style="text-align:center;padding-top:10px">
                        <input type="button" class="btn btn-primary btn-xs" name="" id="" onClick="alert('TODO')" value="Edit"/>
                        <input type="button" class="btn btn-primary btn-xs" name="" id="" onClick="Affiche('<?php echo $arrayValue['inc']; ?>_Block_differer','<?php echo $arrayValue['inc']; ?>')" value="Timer"/>
                    </div>
                    <div id="<?php echo $arrayValue['inc']; ?>_Block_differer" class="input-group hidden" style="padding-left:40px;padding-top: 25px;padding-right: 40px">
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
    </div> <!-- End  col-md-3 -->
<?php
       if ($inc == 4) {
            echo "</div> <!-- End Row-->\n";
            $inc = 0;
        }
    }
?>

<script src="<?php echo $HOME;?>js/jquery.min.js"></script>

<script type="text/javascript">

    function Affiche (id,form){
        if (document.getElementById(id).style.visibility=="visible" && document.getElementById(id).style.display=="block" ) {
            $("#"+id).delay(400).hide(500);
            document.forms[form].elements["after"].value=0
        } else {
            $('#'+id+'.hidden').css('visibility','visible').hide().fadeIn().removeClass('hidden');
            $("#"+id).delay(400).show(500);
            document.forms[form].elements["after"].value=1
        }
    }

    function Send (type,form){
    	
    	action = '<?php echo $action?>'
    	if (type == 'on') {
    		action = '<?php echo $action?>?state=1'
    	}
    	//alert("TEST: " + type + " form: "+ form + " action: "+ action);
    	$.ajax({
    		type: "POST",
    		url: action, // 
    		data: $('form.' + form).serialize(),
    		success: function(msg){
    			$("#msg").html(msg)
    			$('#msg.hidden').css('visibility','visible').hide().fadeIn().removeClass('hidden');	
    		},
    		error: function(){
    			alert("failure");
    		}
    	});
    	//$("#msg").delay(4000).hide(500);
    };
</script>