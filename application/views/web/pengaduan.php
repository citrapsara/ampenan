<!-- BEGIN: PAGE CONTAINER -->
<div class="c-layout-page">
  <!-- BEGIN: LAYOUT/BREADCRUMBS/BREADCRUMBS-2 -->
	<!-- <div class="c-layout-breadcrumbs-1 c-subtitle c-fonts-uppercase c-fonts-bold c-bordered c-bordered-both">
		<div class="container">
			<div class="c-page-title c-pull-left">
				<h3 class="c-font-uppercase c-font-sbold">Halaman Pengaduan</h3>
			</div>
		</div>
	</div> -->
  <!-- <div class="panel-heading" style="text-align: center;">
    <div class="alert alert-info">
      <h4 class="panel-title">SILAHKAN LOGIN/DAFTAR TERLEBIH DAHULU UNTUK MELAKUKAN PENGADUAN</h4>
      <br>
      <a href="web/login.html" class="btn bg-danger">MASUK</a>
      <a href="web/user_register.html" class="btn bg-success">REGISTER</a>
    </div>
  </div> -->

  <div class="c-content-box c-bg-grey-1">
		<div class="container">
      <br>
      <h1 align="center"><b>BUAT PENGADUAN</b></h1>
      <hr>

      <p>Laporkan penyimpangan dalam proses pemberian Bantuan Hukum dengan mengisi Form Pengaduan berikut:</p>

      <hr>

      <div class="alert alert-warning">
				<strong>Note :</strong> Isikan data aduan dengan jujur & bertanggung Jawab. Bersama kita wujudkan NTB yang Bersih & jujur!
			</div>

			<?php
                echo $this->session->flashdata('msg');
                
                ?>

      <form class="form-horizontal" action="" data-parsley-validate="true" method="post" enctype="multipart/form-data">
        <div class="form-group">
				 	<label for="inputEmail3" class="col-md-4 control-label">Nama</label>
				 	<div class="col-md-6">
				 		<input type="text" name="nama_pelapor" class="form-control  c-square c-theme" id="inputEmail3" placeholder="Nama">
				 	</div>
				</div>
        <div class="form-group">
				 	<label for="inputEmail3" class="col-md-4 control-label">Nomor Identitas</label>
				 	<div class="col-md-6">
				 		<input type="text" name="nik_pelapor" class="form-control  c-square c-theme" id="inputEmail3" placeholder="Nomor Identitas">
				 	</div>
				</div>
        <div class="form-group">
				 	<label for="inputEmail3" class="col-md-4 control-label">Kontak yang Dapat Dihubungi <b id='wajib_isi'>*</b></label>
				 	<div class="col-md-6">
				 		<input type="text" name="kontak_pelapor" class="form-control  c-square c-theme" id="inputEmail3" placeholder="Nomor Telepon" required>
				 	</div>
				</div>
        <div class="form-group">
				 	<label for="inputEmail3" class="col-md-4 control-label">Alamat</label>
				 	<div class="col-md-6">
				 		<input type="text" name="alamat_pelapor" class="form-control  c-square c-theme" id="inputEmail3" placeholder="Alamat">
				 	</div>
				</div>
        <div class="form-group">
				 	<label for="inputEmail3" class="col-md-4 control-label">Uraian Laporan <b id='wajib_isi'>*</b></label>
				 	<div class="col-md-6">
            <textarea name="isi_pengaduan" class="form-control  c-square c-theme" rows="3" placeholder="Jabarkan dengan jelas.." required></textarea>
				 	</div>
				</div>
        <div class="form-group">
					<label for="exampleInputFile" class="col-md-4 control-label">Lampirkan Bukti <b id='wajib_isi'>*</b></label>
					<div class="col-md-6">
						<input type="file" name="bukti" id="exampleInputFile" class="c-font-14" required>
					</div>
				</div>
              			
				<div class="form-group c-margin-t-20">
				  <div class="col-sm-offset-4 col-md-8">
					  <button type="submit" name="btnsimpan" class="btn c-theme-btn c-btn-square c-btn-uppercase c-btn-bold">Submit</button> 
				 	</div>
				</div>
			</form>


    </div>
    <br>
  </div>

</div>
<!-- END: PAGE CONTAINER -->
