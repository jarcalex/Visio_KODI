<br />
  <center>
   <form name="download"  method='POST'>
    <select name="periode" class="form-control" onChange="submit()" style="width:120px">
	    <option value=""></option>
	    <option value="1" <?php if(isset($_POST[periode]) && $_POST[periode] == 1) echo "selected";?>>24h</option>
	    <option value="7" <?php if(isset($_POST[periode]) && $_POST[periode] == 7) echo "selected";?>>1 semaine</option>
	    <option value="15" <?php if(isset($_POST[periode]) && $_POST[periode] == 15) echo "selected";?>>2 semaine</option>
	    <option value="30" <?php if(isset($_POST[periode]) && $_POST[periode] == 30) echo "selected";?>>1 mois</option>
	  </select><br />
	<div class="panel panel-primary" >
	  <div class="panel-heading"><strong>Liste des fichiers</strong></div>
	  <div class="panel-body">
	  <div class='table-responsive'>
	    <table class='table table-hover'>
<?php listeDossier("/app/www/dl",$filtre); ?>
        </table>
      </div>
      </div>
    </div>
    <input type="submit" name="del" style="width:100px" class="btn btn-warning" value="Suppr" />
	<!-- <input type="submit" name="move" style="width:100px" class="btn btn-info" value="Migrate" /> -->
   </form>
  </center>
  <br />
  <br />
<div class="alert alert-success" id="note_wake" style="display:<?php echo $display_info; ?>" ><?php echo $info; ?></div>


<script type="text/javascript">
function selectRow(row)
{
    var firstInput = row.getElementsByTagName('input')[0];
    firstInput.checked = !firstInput.checked;
}
</script>