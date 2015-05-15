<script language="javascript" type="text/javascript">
/* <![CDATA[ */
function init() {
	JSL.dom(".chooser").click(function(e) {
		var for_element = this.name.replace(/_chooser/,"");

		JSL.dom(for_element).disabled = (this.value !== "1");
	});
	
	JSL.dom("crontab-form").on("submit", function(e) {
		JSL.event(e).stop();
		
		var minute, hour, day, month, weekday;
		
		minute	= getSelection('minute');
		hour	= getSelection('hour');
		day		= getSelection('day');
		month	= getSelection('month');
		weekday	= getSelection('weekday');
		
		var command = JSL.dom("command").value;
		JSL.dom("cron").value = minute + " " + hour + " " + day + " " + month + " " + weekday + " " + command;
		
		$.ajax({
			type: "POST",
			url: "<?php echo $HOME.'controleur/planification.php'; ?>", // 
			data: $('form.crontab-form').serialize(),
			success: function(msg){
				$("#msg").html(msg)
				$('#msg.hidden').css('visibility','visible').hide().fadeIn().removeClass('hidden');	
			},
			error: function(){
				alert("failure");
			}
		});
		
	});
}

function getSelection(name) {
	var chosen;
	if(JSL.dom(name + "_chooser_every").checked) {
		chosen = '*';
	} else {
		var all_selected = [];
		JSL.dom("#" + name+ " option").each(function(ele) {
			if(ele.selected)
				all_selected.push(ele.value);
		});
		if(all_selected.length)
			chosen = all_selected.join(",");
		else
			chosen = '*';
	}
	return chosen;
}
function submit_delete(val) {
	document.getElementById("select").value = val;
	document.getElementById("del").value = "Delete";
	document.forms.delete.submit();
}
function submit_edit(val) {
    alert("TODO");
}

/* ]]> */
</script>

<br />
<form  name="delete" method="POST">
    <input type="hidden" name="select" id="select" value="" />
    <input type="hidden" name="del" id="del" value="" />
    <center>
        <br />
        <div class="panel panel-black" >
            <div class="panel-heading"><strong>Régles en place</strong></div>
            <div class="panel-body">
                <div class='table-responsive'>
                    <table class='table table-hover'>
                        <thead>
                            <tr>
                                <th>Min</th>
                                <th>Hour</th>
                                <th>Day</th>
                                <th>Month</th>
                                <th>Weekday</th>
                                <th>Commande</th>
                                <th style='padding:0;vertical-align:middle;text-align:center' >#</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php echo $CronTab;?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </center>
</form>
<br />
<div class="panel panel-black" >
    <div class="panel-heading"><strong>Ajout d'une planification</strong></div>
    <div class="panel-body">
        <form method="post" action="" id="crontab-form" name="crontab-form" class="crontab-form">
            <div class='row' style="margin-left:5px;margin-right:5px">
                <span style='font-weight: bold;text-decoration:underline;margin-right: 25px;'>Planificateur:</span>
                <div class="bootstrap-switch-id-switch-handleWidth label-toggle-switch make-switch switch-medium" data-on="primary" data-off="primary" data-on-label=" Valhalla "  handleWidth="100" data-off-label=" DarkSurt " style="width: 200px;">
                    <input name="schedule" type="checkbox" >
                </div>
                <br />
                <br />
                <span style='font-weight: bold;text-decoration:underline;margin-right: 35px;'>Commande:</span> <input placeholder="Renseigner une cmd…" type="text" name="command" id="command" class="form-control" />
                <br />
            </div>
            <div class='row'>
            <center>
                <div class="col-md-2">
                    <h3>Minute</h3>
                    <label for="minute_chooser_every">Every</label>
                    <input type="radio" name="minute_chooser" id="minute_chooser_every" class="chooser" value="0" checked="checked" />
                    <br />
                    <label for="minute_chooser_choose">Choose</label>
                    <input type="radio" name="minute_chooser" id="minute_chooser_choose" class="chooser" value="1" />
                    <br />
                    <select name="minute" id="minute" class="form-control" multiple="multiple" disabled="disabled" style="width:50%">
                        <?php for ($i = 0; $i <= 59; $i++) { echo '<option value="'.$i.'">'.$i.'</option>';  } ?>
                    </select>
                </div>

                <div class="col-md-2">
                    <h3>Hour</h3>
                    <label for="hour_chooser_every">Every</label>
                    <input type="radio" name="hour_chooser" id="hour_chooser_every" class="chooser" value="0" checked="checked" />
                    <br />
                    <label for="hour_chooser_choose">Choose</label>
                    <input type="radio" name="hour_chooser" id="hour_chooser_choose" class="chooser" value="1" />
                    <br />
                    <select name="hour" id="hour" class="form-control" multiple="multiple" disabled="disabled" style="width:50%">
                        <?php for ($i = 0; $i <= 23; $i++) { echo '<option value="'.$i.'">'.$i.'</option>'; } ?>
                    </select>
                </div>

                <div class="col-md-2">
                    <h3>Day</h3>
                    <label for="day_chooser_every">Every</label>
                    <input type="radio" name="day_chooser" id="day_chooser_every" class="chooser" value="0" checked="checked" />
                    <br />
                    <label for="day_chooser_choose">Choose</label>
                    <input type="radio" name="day_chooser" id="day_chooser_choose" class="chooser" value="1" />
                    <br />
                    <select name="day" id="day" class="form-control" multiple="multiple" disabled="disabled" style="width:50%">
                        <?php for ($i = 1; $i <= 31; $i++) { echo '<option value="'.$i.'">'.$i.'</option>'; } ?>
                    </select>
                </div>

                <div class="col-md-2">
                    <h3>Month</h3>
                    <label for="month_chooser_every">Every</label>
                    <input type="radio" name="month_chooser" id="month_chooser_every" class="chooser" value="0" checked="checked" />
                    <br />
                    <label for="month_chooser_choose">Choose</label>
                    <input type="radio" name="month_chooser" id="month_chooser_choose" class="chooser" value="1" />
                    <br />
                    <select name="month" id="month" class="form-control" multiple="multiple" disabled="disabled" style="width:50%">
                        <option value="1">Janvier</option>
                        <option value="2">Fevrier</option>
                        <option value="3">Mars</option>
                        <option value="4">Avril</option>
                        <option value="5">Mai</option>
                        <option value="6">Juin</option>
                        <option value="7">Juillet</option>
                        <option value="8">Août</option>
                        <option value="9">Septembre</option>
                        <option value="10">Octobre</option>
                        <option value="11">Novembre</option>
                        <option value="12">Decembre</option>
                    </select>
                </div>

                <div class="col-md-2">
                    <h3>Weekday</h3>
                    <label for="weekday_chooser_every">Every</label>
                    <input type="radio" name="weekday_chooser" id="weekday_chooser_every" class="chooser" value="0" checked="checked" />
                    <br />
                    <label for="weekday_chooser_choose">Choose</label>
                    <input type="radio" name="weekday_chooser" id="weekday_chooser_choose" class="chooser" value="1" />
                    <br />
                    <select name="weekday" id="weekday" class="form-control" multiple="multiple" disabled="disabled" style="width:50%">
                        <option value="0">Dimanche</option>
                        <option value="1">Lundi</option>
                        <option value="2">Mardi</option>
                        <option value="3">Mercredi</option>
                        <option value="4">Jeudi</option>
                        <option value="5">Vendredi</option>
                        <option value="6">Samedi</option>
                    </select>
                </div>
            </center>
            </div>
            <br /><br />
            <div class='row'>
            <center>
                <input class="btn btn-success" type="submit" name="action" id="action" value="Create Crontab Line" />
                <br />
                <br />
                <textarea name="cron" id="cron" rows="2" col="60" style="display:none"></textarea>
            </center>
            </div>
        </form>
        <div class="alert alert-info hidden" id="msg"></div>
    </div>
</div>

<script src="<?php echo $HOME ?>js/tmp/jsl.js" type="text/javascript"></script>
<script src="<?php echo $HOME ?>js/tmp/common.js" type="text/javascript"></script>

