<div class="col-lg-4">
    <div class="box">
        <div class="box-inner">
            <div class="box-header well">
                <h2> UPLOAD TEMPLATE EXCEL</h2>
            </div>
            <div class="box-content">
                <button class="btn btn-sm btn-success" style="width: 100%;"><span class="glyphicon glyphicon-cloud-download"></span>&nbsp;&nbsp;DOWNLOAD EXCEL</button> <br /> <br />
                <form name="f_siswa" action="<?php echo base_url(); ?>import/siswa" id="f_siswa" enctype="multipart/form-data" method="post">
                    <input type="file" class="form-control col-md-3" name="import_excel" required>
                    <br>
                    <button type="submit" class="btn btn-sm btn-warning" style="width: 100%;"><span class="glyphicon glyphicon-cloud-upload"></span>&nbsp;&nbsp;UPLOAD DATA</button>
                </form>
            </div>
        </div>
    </div>
</div>