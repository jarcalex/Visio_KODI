<br />
<div class="row">
    <div class="col-md-12">
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">Navigation</h3>
                <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse"> <i class="glyphicon glyphicon-minus"></i> </button>
                </div>
            </div>
        	<div class="box-body">
				<lu style="list-style:none">
<?php
foreach($nav_bar as $onglet)
{
?>
					<li style="cursor:pointer;list-style:none">
    <?php if ($onglet['haveinderlink'] != "FALSE") { 
		echo "<a data-toggle='modal' data-target='#myModal' data-title='Edit Mode' data-whatever='' data-label='".$onglet['label']."' data-parametre='".$onglet['parameters']."' data-style='".$onglet['style']."' data-file='".$onglet['file']."' data-order='".$onglet['Order']."' data-parent='' data-main='TRUE' >";
		?>
        <i class='<?php echo $onglet['style']; ?>' ></i>
		<?php 
		echo $onglet['label'];
		?>
        <span class='caret'></span>
        <span class='sr-only'>Toggle Dropdown</span> </a>
		<ul style="list-style:none" class=''>
		<?php foreach($onglet['Child'] as $underlink) {
			if ($underlink['label'] == "") {
			    echo "<li style='list-style:none' class='divider'>-- SEPARATEUR --</li>\n";
		    } else {
				echo "<li style='list-style:none'>";
				echo "<a data-toggle='modal' data-target='#myModal' data-title='Edit Mode' data-whatever='' data-label='".$underlink['label']."' data-parametre='".$underlink['parameters']."' data-style='".$underlink['style']."' data-file='".$underlink['file']."' data-order='".$underlink['Order']."' data-parent='".$onglet['id']."' data-main='FALSE' data-id=".$underlink['id'].">";
			    if ($underlink['style'] != "") {
                    echo "<i class='".$underlink['style']."'></i>  ";
			    }
			    echo $underlink['label']."</a></li>\n ";
		    }
	    } ?>
	    </ul>
<?php
    } else {
?>
		<a data-toggle='modal' data-target='#myModal' data-title='Edit Mode' data-whatever='' >
		<i class='".$onglet['style']."'></i>
		<?php echo $onglet['label']; ?></a>
<?php
}
?>
					</li>
<?php
}
?>
				</lu>
            </div>
            <div class="box-footer clearfix">
                <button type="button" class="btn btn-sm btn-info btn-flat pull-left" data-toggle="modal" data-target="#myModal" data-title="New link" data-whatever="">Add Nav link</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="exampleModalLabel">New message</h4>
      </div>
      <div class="modal-body">
        <div class="alert alert-info hidden" id="msg"> </div>
        <form class='linkform' id='linkform' name='linkform' method='post'>
          <input type="hidden" class="form-control" id="id" name="id" value="0">
          <div class="form-group">
            <label for="label-text" class="control-label">Label:</label>
            <input type="text" class="form-control" id="label-text" name="label-text">
          </div>
          <div class="form-group">
            <label for="parametre-text" class="control-label">Parametre:</label>
            <input type="text" class="form-control" id="parametre-text" name="parametre-text">
          </div>
          <div class="form-group">
            <label for="style-text" class="control-label">Style:</label>
            <input type="text" class="form-control" id="style-text" name="style-text">
          </div>
          <div class="form-group">
            <label for="file-text" class="control-label">File:</label>
            <input type="text" class="form-control" id="file-text" name="file-text">
          </div>
          <div class="form-group">
            <label for="order-text" class="control-label">Order:</label>
            <input type="text" class="form-control" id="order-text" name="order-text">
          </div>
          <div class="form-group">
            <label for="main-check" class="control-label">Maitre:</label>
            <input type="checkbox" class="form-control" id="main-check" name="main-check">
          </div>
          <div class="form-group">
            <label for="parent-text" class="control-label">Parent:</label>
            <select class="form-control" id="parent-text" name="parent-text">
    <?php echo $parent; ?>
            </select>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="submit" > Save </button>
      </div>
      
    </div>
  </div>
</div> <!-- /.modal -->


<script>
$('#myModal').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget) // Button that triggered the modal
  var title = button.data('title')
  var id = button.data('id')
  var recipient = button.data('whatever') // reset
  var label = button.data('label')
  var parametre = button.data('parametre')
  var file = button.data('file')
  var style = button.data('style')
  var order = button.data('order')
  var main = button.data('main')
  if (main == "TRUE") {
    $('input[name=main-check]').attr('checked', true);
  } else {
    $('input[name=main-check]').attr('checked', false);
  }
  var parent = button.data('parent')
  
  var modal = $(this)
  modal.find('.modal-title').text(title)
  modal.find('.modal-body input').val(recipient)
  modal.find('#label-text').val(label)
  modal.find('#style-text').val(style)
  modal.find('#id').val(id)
  modal.find('#parametre-text').val(parametre)
  modal.find('#file-text').val(file)
  modal.find('#order-text').val(order)
  modal.find('#parent-text').val(parent)

});

$(document).ready(function () {
	$("button#submit").click(function(){
		var modal = $('#myModal')
		var form = modal.find('.linkform')
		$.ajax({
			type: "POST",
			url: "/www/controleur/test.php", // 
			data: form.serialize(),
			success: function(msg){
				$("#msg").html(msg)
				//$('#msg.hidden').css('visibility','visible').hide().fadeIn().removeClass('hidden');	
			},
			error: function(){
				alert("failure");
			}
		});
		$('#msg.hidden').css('visibility','visible').hide().fadeIn().removeClass('hidden');
        $("#msg").delay(400).show(500);
        $("#msg").delay(400).hide(500);
	});
});
</script>