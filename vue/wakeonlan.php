<script type="text/javascript">
    function display_delai(VAL) {
        if (VAL == "true") {
    		document.wake.periode_start.disabled = false
    		document.getElementById('line_delai').style.display = 'block';
    	}
    	else {
    		document.wake.periode_start.disabled = true;
    		document.getElementById('line_delai').style.display = 'none';
    	}
    }
</script>
<br />
<div class="row">
	<div class="col-md-4">
		<div class="panel panel-primary">
		  <div class="panel-heading"><strong>Liste des Machines</strong></div>
		  <div class="panel-body">
		    <div class='table-responsive'>
		      <table class="table" >
		        <tr>
		            <th>Hostname</th>
		            <th>Adress IP</th>
		            <th>Adress MAC</th>
		        </tr>
		<?php
			foreach( $array_hard as $cle=>$arrayValue ) {
		?>
				<tr>
				    <td> <i class='glyphicon glyphicon-<?php echo $arrayValue['status']; ?>'></i> <?php echo $arrayValue['Hostname']; ?></td>
				    <td><?php echo $arrayValue['IP']; ?></td>
		    		<td><?php echo $arrayValue['MAC']; ?></td>
				</tr>
		<?php
			}
		?>
		      </table>
		    </div>
		  </div>
		</div>
	</div>

	<div class="col-md-4">
		<div class="panel panel-primary" >
		    <div class="panel-heading"><strong>WakeOnLan</strong></div>
		    <div class="panel-body">
		        <form name="wake"  method='POST'>
		            <table class="table" >
		                <tr>
		                    <th> Echelle de la période </th>
		                    <th> HostName </th>
		                </tr>
		                <tr>
		                    <td>
		                        <input type='radio' name='periode' value='m' onClick="display_delai('true')" /> Minutes<br />
		                        <input type='radio' name='periode' value='h' onClick="display_delai('true')" /> Heures <br />
		                        <input type='radio' name='periode' value='NOW' checked onClick="display_delai('false')" /> Immédiat
		                    </td>
		                    <td>
		                        <select name="Mac" >
		                        <?php echo $option_WOL; ?>
		                        </select>
		                    </td>
		                </tr>
		                <tr id="line_delai" width=100% style="display:none">
		                    <td colspan='2' > Délai : <input type='text' name='periode_start' size='3' disabled value='1'></td>
		                </tr>
		            </table>
		            <input type='submit' id='bp' name='wake' value='Send' class="btn btn-info"/>
		        </form>
		    </div>
		</div>
    </div>
	<div class="col-md-4">
		<div class="panel panel-primary" >
		    <div class="panel-heading"><strong>Shutdown</strong></div>
		    <div class="panel-body">
		        <form name="down"  method='POST'>
		            <table class="table" >
		                <tr>
		                    <th> Echelle de la période </th>
		                    <th> HostName </th>
		                </tr>
		                <tr>
		                    <td>
		                        <input type='radio' name='periode' value='m' onClick="display_delai('true')" /> Minutes<br />
		                        <input type='radio' name='periode' value='h' onClick="display_delai('true')" /> Heures <br />
		                        <input type='radio' name='periode' value='NOW' checked onClick="display_delai('false')" /> Immédiat
		                    </td>
		                    <td>
		                        <select name="id" >
		                        <?php echo $option_Off; ?>
		                        </select>
		                    </td>
		                </tr>
		                <tr id="line_delai" width=100% style="display:none">
		                    <td colspan='2' > Délai : <input type='text' name='periode_start' size='3' disabled value='1'></td>
		                </tr>
		            </table>
		            <input type='submit' id='bp' name='down' value='Send' class="btn btn-info"/>
		        </form>
		    </div>
		</div>
    </div>
</div>

<div class="alert alert-success" style="display:<?php echo $display_info ?>"><?php echo $info; ?></div>
