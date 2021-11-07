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
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
                </div>
                <h4 class="panel-title"><?php echo $judul_web; ?></h4>
            </div>
            <div class="panel-body">
                <?php
                echo $this->session->flashdata('msg');
                ?>
                <form class="form-horizontal" action="" data-parsley-validate="true" method="post" enctype="multipart/form-data">
                  <style>
                    #wajib_isi{color:red;}
                  </style>
                  <div class="alert alert-success">
                    <strong><i>Catatan :</i></strong> Pastikan Laporan Pertanggungjawaban Anda telah lengkap dan sesuai dengan ketentuan. Ketentuan Pertanggungjawaban dapat dilihat pada link berikut ini <a class="btn btn-info btn-xs" href="file/ketentuan_pertanggungjawaban/Kelengkapan data pertanggungjawaban belanja.pdf" target="_blank"><i class="fa fa-download"></i> Kelengkapan Pertanggungjawaban</a>
                  </div>
                  <br>
                  <div class="form-group">
                    <label class="col-lg-3">Nama Pelaksanaan Anggaran<b id='wajib_isi'>*</b></label>
                    <div class="col-lg-9">
                      <input type="text" name="nama_pelaksanaan_anggaran" class="form-control" value="" placeholder="Nama Folder" required autofocus onfocus="this.value = this.value;">
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-lg-3">Upload File Pertanggungjawaban<b id='wajib_isi'>*</b></label>
                    <div class="col-lg-9">
                      <input type="file" name="file_pertanggungjawaban" class="form-control" value="" placeholder="File" required>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-lg-3">Tanggal Pelaksanaan<b id='wajib_isi'>*</b></label>
                    <div class="col-lg-9">
                      <div class="input-group">
                        <input type="date" name="tanggal_pelaksanaan" class="form-control daterange-single" value="" maxlength="10" required>
                      </div>
                    </div>
                  </div>
                  <hr>
                  <div class="form-group input-dinamis">
                    <div class="col-input-dinamis col-lg-3">
                      <input type="text" name="kode_akun" class="form-control" value="" placeholder="Kode Akun">
                    </div>
                    <div class="col-input-dinamis col-lg-5">
                      <input type="text" name="uraian_detil" class="form-control" value="" placeholder="Uraian">
                    </div>
                    <div class="col-input-dinamis col-lg-3">
                      <input type="text" name="jumlah_realisasi" class="form-control" value="" placeholder="Jumlah Realisasi" onkeypress="return hanyaAngka(event)">
                    </div>
                    <div class="col-input-dinamis col-lg-1">
                      <button class="btn btn-success add-more" type="button">
                        <i class="fa fa-plus-circle" aria-hidden="true"></i>
                      </button>
                    </div>
                  </div>
                  <hr>
                  <div class="form-group">
                    <label class="col-lg-3">Verifikasi<b id='wajib_isi'>*</b></label>
                    <div class="col-lg-9">
                      <input class="radio-btn-verifikasi" type="radio" name="status_verifikasi" value="belum">Tolak
                      <input class="radio-btn-verifikasi" type="radio" name="status_verifikasi" value="sudah">Setuju
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-lg-3">Catatan</label>
                    <div class="col-lg-9">
                      <textarea name="catatan" class="form-control" placeholder="Catatan Perbaikan" rows="4" cols="100" required></textarea>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-lg-3">Skor<b id='wajib_isi'>*</b></label>
                    <div class="col-lg-9">
                      <input class="radio-btn-verifikasi" type="radio" name="skor_warna" value="hijau">Hijau
                      <input class="radio-btn-verifikasi" type="radio" name="skor_warna" value="kuning">Kuning
                      <input class="radio-btn-verifikasi" type="radio" name="skor_warna" value="merah">Merah
                      
                    </div>
                  </div>
                  <hr>
                  <a href="<?php echo strtolower($this->uri->segment(1)); ?>/<?php echo strtolower($this->uri->segment(2)); ?>.html" class="btn btn-default"><< Kembali</a>
                  <button type="submit" name="btnsimpan" class="btn btn-primary" style="float:right;">Simpan</button>
                </form>
            </div>

        </div>
      </div>
    </div>
    <!-- /dashboard content -->
