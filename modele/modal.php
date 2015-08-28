<?php
function CreateModal ($content, $buttondata, $url) {
    echo '
<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="exampleModalLabel">New message</h4>
      </div>
      <div class="modal-body">
        <div class="alert alert-info hidden" id="msg_modal"> </div>
        <form class="ModalForm" id="ModalForm" name="ModalForm" method="post">
        '.$content.'
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="submit" > Save </button>
      </div>
    </div>
  </div>
</div>
<!-- /.modal -->';

    echo " <script>
$('#myModal').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget) // Button that triggered the modal
  var title = button.data('title')
  
  var modal = $(this)
  modal.find('.modal-title').text(title)
  
  ${buttondata}

});

$(document).ready(function () {
	$('button#submit').click(function(){
		var modal = $('#myModal')
		var form = modal.find('.ModalForm')
		$.ajax({
			type: 'POST',
			url: ${url}, // 
			data: form.serialize(),
			success: function(msg){
				$('#msg_modal').html(msg)
				//$('#msg_modal.hidden').css('visibility','visible').hide().fadeIn().removeClass('hidden');	
			},
			error: function(){
				alert('failure');
			}
		});
		
        $('#msg_modal').delay(2400).show(500);
        $('#msg_modal.hidden').css('visibility','visible').hide().fadeIn().removeClass('hidden');
        $('#msg_modal').delay(3600).hide(500);
	});
});
</script>";

}
?>