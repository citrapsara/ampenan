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
                  
                  <hr>
                  
                    <style>
                      #wajib_isi{color:red;}
                    </style>
                    


                    <h4>Informasi</h4>
                    
				    <div class="form-group">
                    <label class="col-lg-12">Nomor Permohonan<b id='wajib_isi'>*</b></label>
                    <div class="col-lg-12">
                      <input type="text" name="no_permohonan" class="form-control" value="" placeholder="Nomor Permohonan.." required>
                    </div>
                  </div>
                 
				 <div class="form-group">
                    <label class="col-lg-12">Nama Penerima Bantuan Hukum<b id='wajib_isi'>*</b></label>
                    <div class="col-lg-12">
                      <input type="text" name="nama_client" class="form-control" value="" placeholder="Nama Penerima Bantuan Hukum..." required>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-lg-12">Tanggal Wawancara<b id='wajib_isi'>*</b></label>
                    <div class="col-lg-12">
                      <div class="input-group">
                        <input type="date" name="tgl_kegiatan" class="form-control daterange-single" value="" maxlength="10" required>
                      </div>
                    </div>
                  </div>
                  <hr>
                  <h4>Unggah Scan Kuesioner</h4>
                  <div class="alert alert-success">
					<strong><i>Catatan :</i></strong> Scan lembar kuesioner yang telah diisi oleh Penerima Bantuan Hukum.
					</div>
          <br>
                  <div class="form-group">
                    <label class="col-lg-12">Scan Kuesioner<b id='wajib_isi'>*</b></label>
                    <div class="col-lg-12">
                      <input type="file" name="lamp_scan_kuesioner" class="form-control" required>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-lg-12">Foto Tanda Tangan / Cap Jempol Penerima Bantuan Hukum<b id='wajib_isi'>*</b></label>
                    <div class="col-lg-12">
                      <input type="file" name="lamp_ttd" class="form-control" required>
                    </div>
                  </div>
                  <hr>
                  <h4>Unggah Dokumentasi</h4>
                  <div class="form-group">
                    <label class="col-lg-12">Foto 1<b id='wajib_isi'>*</b></label>
                    <div class="col-lg-12">
                      <input type="file" name="lamp_foto1" class="form-control" required>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-lg-12">Foto 2<b id='wajib_isi'>*</b></label>
                    <div class="col-lg-12">
                      <input type="file" name="lamp_foto2" class="form-control" required>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-lg-12">Foto 3<b id='wajib_isi'>*</b></label>
                    <div class="col-lg-12">
                      <input type="file" name="lamp_foto3" class="form-control" required>
                    </div>
                  </div>

                  <hr>
                  <a href="<?php echo strtolower($this->uri->segment(1)); ?>/<?php echo strtolower($this->uri->segment(2)); ?>.html" class="btn btn-default"><< Kembali</a>
                  <button type="submit" name="btnsimpan" class="btn btn-primary" style="float:right;">Kirim</button>
                </form>
            </div>

        </div>
      </div>
    </div>
    <!-- /dashboard content -->
