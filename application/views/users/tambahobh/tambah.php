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
						<label class="control-label col-lg-3">Foto OBH</label>
						<div class="col-lg-9">
            <input type="file" name="foto" class="form-control" value="" placeholder="Foto OBH" required>
						</div>
					</div>
            <div class="form-group">
              <label class="control-label col-lg-3">No.Registrasi</label>
              <div class="col-lg-9">
                <input type="text" id="noPaste" name="no_idn" class="form-control" value="" placeholder="Nomor Registrasi OBH " onkeypress="return hanyaAngka(event)" required autofocus onfocus="this.value = this.value;">
                <i style="color: red;">*Masukkan hanya angka.</i>
              </div>
            </div>
                  <div class="form-group">
                    <label class="control-label col-lg-3">Nama OBH</label>
                    <div class="col-lg-9">
                      <input type="text" name="nama" class="form-control" value="" placeholder="Nama" required autofocus onfocus="this.value = this.value;">
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-lg-3">Nama Singkat OBH</label>
                    <div class="col-lg-9">
                      <input type="text" name="nama_singkat" class="form-control" value="" placeholder="Nama Singkat OBH" required autofocus onfocus="this.value = this.value;">
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-lg-3">Tanggal Berdiri</label>
                    <div class="col-lg-9">
                      <div class="input-group">
                        <input type="date" name="tgl_berdiri" class="form-control daterange-single" value="" maxlength="10" required>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-lg-3">Status Badan Hukum</label>
                    <div class="col-lg-9">
                      <input type="text" name="status_obh" class="form-control" value="" placeholder="Status Badan Hukum" required>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-lg-3">Akta OBH</label>
                    <div class="col-lg-9">
                      <input type="text" name="akta_obh" class="form-control" value="" placeholder="Akta OBH" required>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-lg-3">NPWP OBH</label>
                    <div class="col-lg-9">
                      <input type="text" name="npwp_obh" class="form-control" value="" placeholder="NPWP OBH" required>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-lg-3">Akreditasi</label>
                    <div class="col-lg-9">
                      <select class="form-control default-select2" name="akreditasi_obh" required>
                        <option value="">- Pilih -</option>
                        <option value="A">A</option>
                        <option value="B">B</option>
                        <option value="C">C</option>
                      </select>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-lg-3">Pagu Awal Anggaran Litigasi</label>
                    <div class="col-lg-9">
                      <input type="text" name="pagu_litigasi" class="form-control" value="" onkeypress="return hanyaAngka(event)" onpaste="return false;" placeholder="Pagu Awal Anggaran Litigasi" required>
                      <i style="color: red;">*Masukkan hanya angka.</i>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-lg-3">Pagu Awal Anggaran Non Litigasi</label>
                    <div class="col-lg-9">
                      <input type="text" name="pagu_non_litigasi" class="form-control" value="" onkeypress="return hanyaAngka(event)" onpaste="return false;" placeholder="Pagu Awal Anggaran Non Litigasi" required>
                      <i style="color: red;">*Masukkan hanya angka.</i>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-lg-3">Kota / Kabupaten</label>
                    <div class="col-lg-9">
                      <select class="form-control default-select2" name="kota" required>
                        <option value="">- Pilih -</option>
                        <?php
                          $this->db->order_by('nama_kota','ASC');
                          $v_kota = $this->db->get('tbl_kota_ntb');
                          foreach ($v_kota->result() as $key => $value): ?>
                            <option value="<?php echo $value->nama_kota; ?>"><?php echo ucwords($value->nama_kota); ?></option>
                        <?php endforeach; ?>
                      </select>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-lg-3">Alamat</label>
                    <div class="col-lg-9">
                      <input type="text" name="alamat_notaris" class="form-control" value="" placeholder="Alamat Lengkap OBH" required>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-lg-3">Latitude</label>
                    <div class="col-lg-9">
                      <input type="text" name="latitude" class="form-control" value="" placeholder="Latitude Kantor OBH" required>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-lg-3">Longitude</label>
                    <div class="col-lg-9">
                      <input type="text" name="longitude" class="form-control" value="" placeholder="Longitude Kantor OBH" required>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-lg-3">No. Telp</label>
                    <div class="col-lg-9">
                      <input type="text" name="telpon" class="form-control" value="" placeholder="No. Telepon" onkeypress="return hanyaAngka(event);" required>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-lg-3">Email</label>
                    <div class="col-lg-9">
                      <input type="email" name="email_notaris" class="form-control" value="" placeholder="Email" required>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-lg-3">Nomor SK AHU</label>
                    <div class="col-lg-9">
                      <input type="text" name="no_sk" class="form-control" value="" placeholder="Nomor SK OBH" required>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-lg-3">Tanggal SK</label>
                    <div class="col-lg-9">
                      <div class="input-group">
                        <input type="date" name="tgl_sk" class="form-control daterange-single" value="" maxlength="10" required>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-lg-3">Nomor Kontrak</label>
                    <div class="col-lg-9">
                      <input type="text" name="no_kontrak" class="form-control" value="" placeholder="Nomor Kontrak" required>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-lg-3">Tanggal Kontrak</label>
                    <div class="col-lg-9">
                      <div class="input-group">
                        <input type="date" name="tgl_kontrak" class="form-control daterange-single" value="" maxlength="10" required>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-lg-3">Username</label>
                    <div class="col-lg-9">
                      <input type="text" name="username" class="form-control" value="" placeholder="Username" required>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-lg-3">Password</label>
                    <div class="col-lg-9">
                      <input type="password" name="password" class="form-control" value="" placeholder="Password" required>
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
                  <button type="submit" name="btnsimpan" class="btn btn-primary" style="float:right;">Simpan</button>
                </form>
            </div>

        </div>
      </div>
    </div>
    <!-- /dashboard content -->
