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
                        <th>Kode Akun</th>
                        <th>Uraian</th>
                        <th>Jumlah Realisasi</th>
                      </tr>
                      <?php if($pelaksanaan_anggaran_akun_detil != null):
                            foreach($pelaksanaan_anggaran_akun_detil as $key => $value): ?>
                        <tr>
                          <td><?php echo $value['kode_akun']; ?></td>
                          <td><?php echo $value['uraian_detil']; ?></td>
                          <td><?php echo $value['jumlah_realisasi']; ?></td>
                        </tr>
                      <?php endforeach; ?>
                        <tr>
                          <th colspan="2" class="text-right">Total Realisasi</th>
                          <td><?php echo $total_realisasi; ?></td>
                        </tr>
                      <?php else: ?>
                          <tr>
                            <td colspan="3" class="text-center">- Detil realisasi belum diinput -</td>
                          </tr>
                      <?php endif; ?>
                  </tbody>
                </table>
              </div>
              <div class="table-responsive">
			                  <table class="table table-bordered table-striped" width="100%">
                  <tbody>
                    <tr>
                      <th valign="top" width="160">Status</th>
                      <th valign="top" width="1">:</th>
                      <td><?php 
                            if($pelaksanaan_anggaran['status_verifikasi'] == 'sudah') { 
                              echo '<label class="label label-success">SUDAH DIVERIFIKASI</label>';
                            } elseif($pelaksanaan_anggaran['status_verifikasi'] == 'tolak') {
                              echo '<label class="label label-danger">PERLU PERBAIKAN</label>';
                            } else {
                              echo '<label class="label label-default">BELUM DIVERIFIKASI</label>';
                            }?></td>
                    </tr>
                    <tr>
                      <th valign="top">Catatan Administrator</th>
                      <th valign="top">:</th>
                      <td><?php echo ucfirst($pelaksanaan_anggaran['catatan_verifikator']); ?></td>
                    </tr>
                     <tr>
                      <th valign="top">Skor</th>
                      <th valign="top">:</th>
                      <td><?php 
                            if($pelaksanaan_anggaran['skor_warna'] == 'kuning') {
                              echo '<span class="label skor-warna label-warning">warna</span>';
                            } elseif($pelaksanaan_anggaran['skor_warna'] == 'hijau') {
                              echo '<span class="label skor-warna label-success">warna</span>';
                            } elseif($pelaksanaan_anggaran['skor_warna'] == 'merah') {
                              echo '<span class="label skor-warna label-danger">warna</span>';
                            } else {
                              echo '<label class="label label-default">BELUM DINILAI</label>';
                            }
                       ?></td>
                    </tr>
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