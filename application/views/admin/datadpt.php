<div class="row">
    <div class="col-lg-8">
        <div class="box">
            <div class="box-inner">
                <div class="box-header well">
                    <h2>DAFTAR DPT</h2>
                </div>
                <div class="box-content">
                    <table class="table table-striped table-bordered bootstrap-datatable datatable responsive" id="myTable">
                        <thead class="bg-success">
                            <th class="text-center">No</th>
                            <th class="text-center">NISN</th>
                            <th class="text-left">Nama Siswa</th>
                            <th class="text-center">L/P</th>
                            <th class="text-center">Kelas</th>
                            <th class="text-center">Aksi</th>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            foreach ($datadpt as $load) { ?>
                                <tr>
                                    <td style="width:5%" class="text-center"><?php echo $no++; ?></td>
                                    <td style="width:10%" class="text-center"><?php echo $load['username']; ?></td>
                                    <td style="width:30%" class="text-left"><?php echo $load['nm_siswa']; ?></td>
                                    <td style="width:5%" class="text-center"><?php echo $load['jk']; ?></td>
                                    <td style="width:15%" class="text-center"><?php echo $load['nm_kelas']; ?></td>
                                    <td style="width:15%" class="text-center">
                                        <div class="btn-group btn-group-sm pull-center">
                                            <a href="<?php echo base_url('index.php/admin/editdpt'); ?>/<?php echo $load['username']; ?>"><button type="button" class="btn btn-xs btn-info" title="Edit"><span class="glyphicon glyphicon-edit"></span></button></a>
                                            <a href="<?php echo base_url('index.php/admin/hapusdpt'); ?>/<?php echo $load['username']; ?>"><button type="button" class="btn btn-xs btn-danger" title="Delete"><span class="glyphicon glyphicon-remove"></span></button></a>
                                        </div>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="box">
            <div class="box-inner">
                <div class="box-header well">
                    <h2> TAMBAH DARTAR PEMILIH TETAP (DPT) </h2>
                </div>
                <div class="box-content">
                    <?php if ($this->session->flashdata('info')) { ?>
                        <div class="alert alert-success alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <?php echo $this->session->flashdata('info'); ?>
                        </div>
                    <?php } ?>
                    <?php if ($this->session->flashdata('failed')) { ?>
                        <div class="alert alert-danger alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <?php echo $this->session->flashdata('failed'); ?>
                        </div>
                    <?php } ?>
                    <?php
                    $form_attribute = array(
                        'method'    => 'post',
                        'class'        => 'form-horizontal'
                    );
                    echo form_open_multipart('admin/simpandpt', $form_attribute);
                    ?>
                    <label class="label-control">NISN</label>
                    <?php
                    $form_attribute = array(
                        'type'        => 'text',
                        'class'        => 'form-control',
                        'name'        => 'nisn'
                    );
                    echo form_input($form_attribute);
                    ?>
                    <label class="label-control">Nama</label>
                    <?php
                    $form_attribute = array(
                        'type'        => 'text',
                        'class'        => 'form-control',
                        'name'        => 'nm_siswa'
                    );
                    echo form_input($form_attribute);
                    ?>
                    <label class="label-control">Jenis Kelamin</label>
                    <select class="form-control" name="jk">
                        <option selected value="">Pilih Jenis Kelamin</option>
                        <option value="L">Laki-laki</option>
                        <option value="P">Perempuan</option>
                    </select>
                    <label class="label-control">Kelas</label>
                    <select class="form-control" name="kd_kelas">
                        <option selected value="">Pilih Daftar Kelas</option>
                        <?php foreach ($datakelas as $load) { ?>
                            <option value="<?php echo $load['kd_kelas']; ?>"> <?php echo $load['nm_kelas']; ?> </option>
                        <?php
                        }
                        ?>
                    </select>
                    <br />
                    <button type="submit" class="btn btn-sm btn-info"><span class="glyphicon glyphicon-floppy-saved"></span>&nbsp;&nbsp;SIMPAN DATA</button>
                </div>
                <?php
                echo form_close();
                ?>
            </div>
        </div>
        <div class="box">
            <div class="box-inner">
                <div class="box-header well">
                    <h2> UPLOAD TEMPLATE EXCEL</h2>
                </div>
                <div class="box-content">
                    <form name="f_siswa" action="<?php echo base_url(); ?>import/siswa" id="f_siswa" enctype="multipart/form-data" method="post">
                        <input type="file" class="form-control col-md-3" name="import_excel" required>
                        <br><br>
                        <button type="submit" class="btn btn-sm btn-warning"><span class="glyphicon glyphicon-cloud-upload"></span>&nbsp;&nbsp;UPLOAD DATA</button>
                        <a href="<?php echo base_url(); ?>upload/temp/template_upload_data.xlsx" class="btn btn-sm btn-success"><span class="glyphicon glyphicon-cloud-download"></span>&nbsp;&nbsp;DOWNLOAD EXCEL</a>
                        <br />
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>