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
                      <th valign="top" width="160">Jenis Revisi</th>
                      <th valign="top" width="1">:</th>
                      <td><?php echo $revisi_dipa['jenis_revisi']; ?></td>
                    </tr>
                    <tr>
                      <th valign="top" width="160">Keterangan</th>
                      <th valign="top" width="1">:</th>
                      <td><?php echo $revisi_dipa['keterangan']; ?></td>
                    </tr>
                    <tr>
                      <th valign="top">File Pertanggungjawaban</th>
                      <th valign="top">:</th>
                      <td><a class="btn btn-info btn-xs" href="<?php echo $revisi_dipa['url_file']; ?>" target="_blank"><i class="fa fa-download"></i> Download</a></td>
                    </tr>
                    <tr>
                      <th valign="top" width="160">Tanggal Input</th>
                      <th valign="top" width="1">:</th>
                      <td><?php echo $this->Mcrud->tgl_id(date('d-m-Y', strtotime($revisi_dipa['created_at'])),'full'); ?></td>
                    </tr>
                    <tr>
                      <th valign="top">Yang Mengesahkan</th>
                      <th valign="top">:</th>
                      <td><?php echo ucfirst($this->Mcrud->get_user_name_by_id($revisi_dipa['id_user_verifikator_terakhir'])); ?></td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <div class="table-responsive">
			          <table class="table table-bordered table-striped" width="100%">
                  <tbody>
                    <?php foreach ($verifikasi_usulan as $key => $value): ?>
                    <tr>
                      <th valign="top">Verifikator</th>
                      <th valign="top">:</th>
                      <td><?php echo ucfirst($this->Mcrud->get_user_name_by_id($value['id_user_verifikator'])); ?></td>
                    </tr>
                    <tr>
                      <th valign="top" width="160">Status</th>
                      <th valign="top" width="1">:</th>
                      <td><?php 
                            if($value['status_verifikasi'] == 'sudah') { 
                              echo '<label class="label label-success">SUDAH DIVERIFIKASI</label>';
                            } elseif($value['status_verifikasi'] == 'tolak') {
                              echo '<label class="label label-danger">PERLU PERBAIKAN</label>';
                            } else {
                              echo '<label class="label label-default">BELUM DIVERIFIKASI</label>';
                            }?></td>
                    </tr>
                    <tr>
                      <th valign="top">Catatan Verifikator</th>
                      <th valign="top">:</th>
                      <td><?php echo ucfirst($value['komentar']); ?></td>
                    </tr>
                    <?php endforeach; ?>
                  </tbody>
                </table>
              </div>

              <hr style="margin-top:0px;">
              <a href="<?php echo strtolower($this->uri->segment(1)); ?>/<?php echo strtolower($this->uri->segment(2)); ?>/<?php echo strtolower($this->uri->segment(3)); ?>.html" class="btn btn-default"><< Kembali</a>
              <?php if ($level=='superadmin'){ ?>
                <a class="btn btn-success" title="Edit" data-toggle="modal" onclick="modal_show(<?php echo $query->id_laporan; ?>);" style="float:right;"><i class="fa fa-pencil"></i> Edit</a>
              <?php } ?>
            </div>

        </div>
      </div>
    </div>
    <!-- /dashboard content -->