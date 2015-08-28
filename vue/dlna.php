<form name="srvc" id="srvc" class="srvc" method='POST'>
    <input type="hidden" name="action" id="action" value="">
    <br />
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="panel panel-success">
                <div class="panel-heading" style='text-align:center'><strong>DLNA</strong></div>
                <div class="panel-body">
                    <div class='span5'>
                        <ul>
                            <li>Host : Valhalla</li>
                        </ul>
                    </div>
                    <div style='text-align:center'>
                        <div class="btn-group">
                            <button type="button" name="rescan" id="rescan" class="btn btn-info" ><span class="glyphicon glyphicon-refresh"></span> RESCAN</button>
                        </div>
                    </div>
                    <br />
                    <?php echo $LstFile;?>
                </div><!-- End panel-body -->
            </div><!-- End panel -->
        </div><!-- End col-sm-6 col-md-6 -->
    </div><!-- End row -->
</from>

<div class="alert alert-info hidden" id="msg"></div>