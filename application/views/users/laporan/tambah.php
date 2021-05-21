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
                $link4 = strtolower($this->uri->segment(4));
                ?>
                <form class="form-horizontal" action="" data-parsley-validate="true" method="post" enctype="multipart/form-data">
                  <div class="form-group">
                   <label class="control-label col-lg-3">Kategori Laporan</label>
                    <div class="col-lg-9">
                      <select class="form-control default-select2" name="id_kategori_lap" required onchange="window.location.href='laporan/v/t/'+this.value;">
                        <option value="">- Pilih -</option>
                        <?php
                        $this->db->order_by('nama_kategori_lap','ASC');
                        $v_kategori_lap = $this->db->get('tbl_kategori_lap');
                        foreach ($v_kategori_lap->result() as $key => $value): ?>
                          <option value="<?php echo $value->id_kategori_lap; ?>" <?php if($value->id_kategori_lap==$link4){echo "selected";} ?>><?php echo ucwords($value->nama_kategori_lap); ?></option>
                        <?php
                        endforeach; ?>
                      </select>
                    </div>
                  </div>
                  <hr>
                  <?php if ($link4!=''): ?>
                    <style>
                      #wajib_isi{color:red;}
                    </style>
                    <div class="alert alert-success">
					<strong><i>Catatan :</i></strong> Pastikan Laporan Telah Anda Periksa & Telah Lengkap.!
					</div>
                    <br>
				    <div class="form-group">
                    <label class="col-lg-12">Nomor Pembukuan<b id='wajib_isi'>*</b></label>
                    <div class="col-lg-12">
                      <input type="text" name="no_buku" class="form-control" value="" placeholder="Nomor Pembukuan.." >
                    </div>
                  </div>
				 <div class="form-group">
                    <label class="col-lg-12">NIK & Nama Client<b id='wajib_isi'>*</b></label>
                    <div class="col-lg-12">
                      <input type="text" name="nama_client" class="form-control" value="" placeholder="Nama Client..." >
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-lg-12">Alamat Client<b id='wajib_isi'>*</b></label>
                    <div class="col-lg-12">
                      <input type="text" name="alamat_client" class="form-control" value="" placeholder="Alamat Client..." required>
                    </div>
                  </div>
				 <div class="form-group">
                    <label class="col-lg-12">Hari, Tanggal Pelaksanaan<b id='wajib_isi'>*</b></label>
						<div class="col-lg-12">
						<div class="input-group">
							<input type="date" name="tgl_kegiatan" class="form-control daterange-single" value="" maxlength="10" required>
						</div>
						</div>
                  </div>
                  <div class="form-group">
                    <label class="col-lg-12">Uraian Laporan<b id='wajib_isi'>*</b></label>
                    <div class="col-lg-12">
                      <textarea name="isi_laporan" class="form-control" rows="4" cols="80" placeholder="Uraian laporan..." required></textarea>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-lg-12">Lampiran Dokumen pendukung<b id='wajib_isi'>*</b></label>
                    <div class="col-lg-12">
                      <input type="file" name="lampiran" class="form-control" required>
                    </div>
                  </div>
                  <?php endif; ?>

                  <hr>
                  <a href="<?php echo strtolower($this->uri->segment(1)); ?>/<?php echo strtolower($this->uri->segment(2)); ?>.html" class="btn btn-default"><< Kembali</a>
                  <button type="submit" name="btnsimpan" class="btn btn-primary" style="float:right;">Kirim</button>
                </form>
            </div>

        </div>
      </div>
    </div>
    <!-- /dashboard content -->
