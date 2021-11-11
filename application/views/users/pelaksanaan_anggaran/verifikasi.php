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
            <div class="panel-body pelaksanaan-anggaran">
                <?php
                echo $this->session->flashdata('msg');
                $level = $this->session->userdata('level');
                ?>
                <form class="form-horizontal" action="" data-parsley-validate="true" method="post" enctype="multipart/form-data">
                  <style>
                    #wajib_isi{color:red;}
                  </style>
                  <div class="alert alert-success">
                    <strong><i>Catatan :</i></strong> Pastikan Laporan Pertanggungjawaban Anda telah lengkap dan sesuai dengan ketentuan. Ketentuan Pertanggungjawaban dapat dilihat pada link berikut ini    <a class="btn btn-info btn-xs" href="file/ketentuan_pertanggungjawaban/Kelengkapan data pertanggungjawaban belanja.pdf" target="_blank"><i class="fa fa-download"></i> Kelengkapan Pertanggungjawaban</a>
                  </div>
                  <br>
                  <div class="form-group" methode="post">
                    <label class="col-lg-3">Nama Pelaksanaan Anggaran<b id='wajib_isi'>*</b></label>
                    <div class="col-lg-9">
                      <input type="text" name="nama_pelaksanaan_anggaran" class="form-control" value="<?php echo $pelaksanaan_anggaran['uraian']; ?>" placeholder="Nama Pelaksanaan Anggaran" required autofocus onfocus="this.value = this.value;" readonly>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-lg-3">Upload File Pertanggungjawaban<b id='wajib_isi'>*</b></label>
                    <div class="col-lg-9">
                      <!-- <input type="file" name="file_pertanggungjawaban" class="form-control" value="" placeholder="File" required> -->
                      <a href="<?php echo $pelaksanaan_anggaran['uraian']; ?>" target="_blank"><?php echo $pelaksanaan_anggaran['url_file']; ?></a>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-lg-3">Tanggal Pelaksanaan<b id='wajib_isi'>*</b></label>
                    <div class="col-lg-9">
                      <div class="input-group">
                        <input type="date" name="tanggal_pelaksanaan" class="form-control daterange-single" value="<?php echo $pelaksanaan_anggaran['tanggal_pelaksanaan']; ?>" maxlength="10" required readonly>
                      </div>
                    </div>
                  </div>
                  <hr>
                  <?php foreach ($pelaksanaan_anggaran_akun_detil as $key => $value):?>
                  <!-- <div class="control-group after-add-more"> -->
                  <!-- <div class="field_wrapper"> -->
                    <div class="form-group input-dinamis">
                      <div class="col-input-dinamis col-lg-3">
                        <label>Kode Akun</label>
                        <input type="text" name="kode_akun[]" class="form-control" value="<?php echo $value['kode_akun']; ?>" placeholder="Kode Akun" required readonly>
                      </div>
                      <div class="col-input-dinamis col-lg-5">
                        <label>Uraian</label>
                        <input type="text" name="uraian_detil[]" class="form-control" value="<?php echo $value['uraian_detil']; ?>" placeholder="Uraian" required readonly>
                      </div>
                      <div class="col-input-dinamis col-lg-3">
                        <label>Realisasi</label>
                        <input type="text" name="jumlah_realisasi[]" class="form-control" value="<?php echo $value['jumlah_realisasi']; ?>" placeholder="Jumlah Realisasi" onkeypress="return hanyaAngka(event)" required readonly>
                      </div>
                      <!-- <div class="col-input-dinamis col-lg-1">
                        <button class="btn btn-success add-more" type="button">
                          <i class="fa fa-plus-circle" aria-hidden="true"></i>
                        </button>
                      </div> -->
                    </div>
                  <!-- </div> -->
                  <?php endforeach; ?>
                  <?php if($level == 'keuangan'): ?>
                  <hr>
                  <div class="form-group">
                    <label class="col-lg-3">Verifikasi</label>
                    <div class="col-lg-9">
                      <input class="radio-btn-verifikasi" type="radio" name="status_verifikasi" value="belum"><span class="radio-text">Tolak</span>
                      <input class="radio-btn-verifikasi" type="radio" name="status_verifikasi" value="sudah"><span class="radio-text">Setuju</span>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-lg-3">Catatan</label>
                    <div class="col-lg-9">
                      <textarea name="catatan" class="form-control" placeholder="Catatan Perbaikan" rows="4" cols="100"><?php echo $pelaksanaan_anggaran['catatan_verifikator']; ?></textarea>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-lg-3">Skor</label>
                    <div class="col-lg-9">
                      <input class="radio-btn-verifikasi" type="radio" name="skor_warna" value="merah"><span class="label skor-warna label-danger radio-text">warna</span>
                      <input class="radio-btn-verifikasi" type="radio" name="skor_warna" value="kuning"><span class="label skor-warna label-warning radio-text">warna</span>
                      <input class="radio-btn-verifikasi" type="radio" name="skor_warna" value="hijau"><span class="label skor-warna label-success radio-text">warna</span>
                    </div>
                  </div>
                  <?php endif; ?>
                  <hr>
                  <a href="<?php echo strtolower($this->uri->segment(1)); ?>/<?php echo strtolower($this->uri->segment(2)); ?>.html" class="btn btn-default"><< Kembali</a>
                  <button type="submit" name="btnupdate" class="btn btn-primary" style="float:right;">Simpan</button>
                </form>
            </div>

        </div>
      </div>
    </div>
    <!-- /dashboard content -->

<script type="text/javascript">
  // Radio Button 
  var val_status = <?php echo json_encode($pelaksanaan_anggaran['status_verifikasi']); ?>;
  $('input:radio[name=status_verifikasi]').val([val_status]);

  var val_skor = <?php echo json_encode($pelaksanaan_anggaran['skor_warna']); ?>;
  $('input:radio[name=skor_warna]').val([val_skor]);

  // Dynamic Form 
  var addButton = $('.add-more'); //Add button selector
  var wrapper = $('.field_wrapper'); //Input field wrapper

  var fieldHTML = '<div class="form-group input-dinamis"><div class="col-input-dinamis col-lg-3"><input type="text" name="kode_akun[]" class="form-control" value="" placeholder="Kode Akun" required></div><div class="col-input-dinamis col-lg-5"><input type="text" name="uraian_detil[]" class="form-control" value="" placeholder="Uraian" required></div><div class="col-input-dinamis col-lg-3"><input type="text" name="jumlah_realisasi[]" class="form-control" value="" placeholder="Jumlah Realisasi" onkeypress="return hanyaAngka(event)" required></div><div class="col-input-dinamis col-lg-1"><button class="btn btn-danger remove" type="button"><i class="fa fa-minus-circle"></i></button></div></div>'; //New input field html 

  // var x = 1; //Initial field counter is 1

  //Once add button is clicked
  $(addButton).click(function(){
      //Check maximum number of input fields
      $(wrapper).append(fieldHTML); //Add field html
  });
  
  //Once remove button is clicked
  $(wrapper).on('click', '.remove', function(e){
      e.preventDefault();
      $(this).parents('.input-dinamis').remove(); //Remove field html
  });
  

</script>
