<?php
$link1 = strtolower($this->uri->segment(1));
$link2 = strtolower($this->uri->segment(2));
$link3 = strtolower($this->uri->segment(3));
$link4 = strtolower($this->uri->segment(4));
?>
<!-- Main content -->
<div class="content-wrapper">
  <!-- Content area -->
  <div class="content">

    <!-- Dashboard content -->
    <div class="row">
      <div class="col-md-3"></div>
      <div class="col-md-6">
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
				  <div class="form-group">
                    <label class="control-label col-lg-3">Nomor SK</label>
                    <div class="col-lg-9">
                      <input type="text" name="no_sk" class="form-control" value="<?php echo $query->no_sk; ?>" placeholder="No SK/ Tanggal Pengukuhan" required>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-lg-3">No.Registrasi</label>
                    <div class="col-lg-9">
                      <input type="text" name="no_idn" class="form-control" value="<?php echo $query->no_idn; ?>" placeholder="Nomor Registrasi OBH" onkeypress="return hanyaAngka(event)" required autofocus onfocus="this.value = this.value;">
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-lg-3">Nama</label>
                    <div class="col-lg-9">
                      <input type="text" name="nama" class="form-control" value="<?php echo $query->nama; ?>" placeholder="Nama" required autofocus onfocus="this.value = this.value;">
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-lg-3">Nama Singkat</label>
                    <div class="col-lg-9">
                      <input type="text" name="nama_singkat" class="form-control" value="<?php echo $query->nama_singkat; ?>" placeholder="Nama Singkat" required autofocus onfocus="this.value = this.value;">
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-lg-3">Kota / Kabupaten</label>
                    <div class="col-lg-9">
                    <select class="form-control default-select2" name="kota" selected="<?php echo $query->kota; ?>" required>
                        <option value="">- Pilih -</option>
                        <option value="Mataram" <?php if($query->kota=="Mataram") echo 'selected="selected"'; ?> >Mataram</option>
                        <option value="Lombok Barat" <?php if($query->kota=="Lombok Barat") echo 'selected="selected"'; ?> >Lombok Barat</option>
                        <option value="Lombok Timur" <?php if($query->kota=="Lombok Timur") echo 'selected="selected"'; ?> >Lombok Timur</option>
                        <option value="Lombok Tengah" <?php if($query->kota=="Lombok Tengah") echo 'selected="selected"'; ?> >Lombok Tengah</option>
                        <option value="Lombok Utara" <?php if($query->kota=="Lombok Utara") echo 'selected="selected"'; ?> >Lombok Utara</option>
                        <option value="Bima" <?php if($query->kota=="Bima") echo 'selected="selected"'; ?> >Bima</option>
                        <option value="Dompu" <?php if($query->kota=="Dompu") echo 'selected="selected"'; ?> >Dompu</option>
                        <option value="Sumbawa" <?php if($query->kota=="Sumbawa") echo 'selected="selected"'; ?> >Sumbawa</option>
                        <option value="Sumbawa Barat" <?php if($query->kota=="Sumbawa Barat") echo 'selected="selected"'; ?> >Sumbawa Barat</option>
                      </select>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-lg-3">Alamat</label>
                    <div class="col-lg-9">
                      <input type="text" name="alamat_notaris" class="form-control" value="<?php echo $query->alamat_notaris; ?>" placeholder="Alamat" required>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-lg-3">Latitude</label>
                    <div class="col-lg-9">
                      <input type="text" name="latitude" class="form-control" value="<?php echo $query->latitude; ?>" placeholder="Latitude Kantor OBH" required>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-lg-3">Longitude</label>
                    <div class="col-lg-9">
                      <input type="text" name="longitude" class="form-control" value="<?php echo $query->longitude; ?>" placeholder="Longitude Kantor OBH" required>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-lg-3">No. Telp</label>
                    <div class="col-lg-9">
                      <input type="text" name="telpon" class="form-control" value="<?php echo $query->telpon; ?>" placeholder="No. Telp" onkeypress="return hanyaAngka(event);" required>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-lg-3">Email</label>
                    <div class="col-lg-9">
                      <input type="email" name="email_notaris" class="form-control" value="<?php echo $query->email_notaris; ?>" placeholder="Email" required>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-lg-3">Username</label>
                    <div class="col-lg-9">
                      <input type="text" name="username" class="form-control" value="<?php echo $query->username; ?>" placeholder="Username" required>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-lg-3">Password</label>
                    <div class="col-lg-9">
                      <input type="password" name="password" class="form-control" value="" placeholder="Password" required>
					  <i style="color: red;">*Password tidak boleh kosong.</i>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-lg-3">Re-Password</label>
                    <div class="col-lg-9">
                      <input type="password" name="password2" class="form-control" value="" placeholder="Konfirmasi Password" required>
                    </div>
                  </div>
                  <hr>
                  <a href="<?php echo $link1; ?>/<?php echo $link2; ?>.html" class="btn btn-default"><< Kembali</a>
                  <button type="submit" name="btnupdate" class="btn btn-primary" style="float:right;">Simpan</button>
                </form>
            </div>

        </div>
      </div>
    </div>
    <!-- /dashboard content -->
