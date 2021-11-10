<!-- Main content -->
<div class="content-wrapper">
  <!-- Content area -->
  <div class="content">

    <!-- Dashboard content -->
    <div class="row">
      <div class="col-md-2"></div>
      <div class="col-md-8">
        <div class="panel panel-inverse">
            <div class="panel-heading">
                <div class="panel-heading-btn">
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
                </div>
                <h4 class="panel-title"><?php echo $judul_web; ?></h4>
            </div>
            <div class="panel-body">
                <?php
                echo $this->session->flashdata('msg');
                $level 	= $this->session->userdata('level');
                ?>

              <div class="table-responsive">
			                  <table class="table table-bordered table-striped" width="100%">
                  <tbody>
                    <tr>
                      <th valign="top" width="160">Nama Pelaksanaan Anggaran</th>
                      <th valign="top" width="1">:</th>
                      <td><?php echo $pelaksanaan_anggaran['uraian']; ?></td>
                    </tr>
                    <tr>
                      <th valign="top">File Pertanggungjawaban</th>
                      <th valign="top">:</th>
                      <td><a class="btn btn-info btn-xs" href="<?php echo $pelaksanaan_anggaran['url_file']; ?>" target="_blank"><i class="fa fa-download"></i> Download</a></td>
                    </tr>
                    <tr>
                      <th valign="top" width="160">Tanggal Pelaksanaan</th>
                      <th valign="top" width="1">:</th>
                      <td><?php echo $this->Mcrud->tgl_id(date('d-m-Y', strtotime($pelaksanaan_anggaran['tanggal_pelaksanaan'])),'full'); ?></td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <div class="table-responsive">
			                  <table class="table table-bordered table-striped" width="100%">
                  <tbody>
                    <tr>
                      <th valign="top" width="160">Status</th>
                      <th valign="top" width="1">:</th>
                      <td><?php echo $pelaksanaan_anggaran['status_verifikasi']; ?></td>
                    </tr>
                    <tr>
                      <th valign="top">Catatan Administrator</th>
                      <th valign="top">:</th>
                      <td><?php echo $pelaksanaan_anggaran['catatan_administrator']; ?></td>
                    </tr>
                     <tr>
                      <th valign="top">Skor</th>
                      <th valign="top">:</th>
                      <td><?php echo $pelaksanaan_anggaran['skor_warna']; ?></td>
                    </tr>
                  </tbody>
                </table>
              </div>

              <hr style="margin-top:0px;">
              <a href="<?php echo strtolower($this->uri->segment(1)); ?>/<?php echo strtolower($this->uri->segment(2)); ?>.html" class="btn btn-default"><< Kembali</a>
              <?php if ($level=='superadmin'){ ?>
                <a class="btn btn-success" title="Edit" data-toggle="modal" onclick="modal_show(<?php echo $query->id_laporan; ?>);" style="float:right;"><i class="fa fa-pencil"></i> Edit</a>
              <?php } ?>
            </div>

        </div>
      </div>
    </div>
    <!-- /dashboard content -->