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

      <?php
                echo $this->session->flashdata('msg');
                $link4 = strtolower($this->uri->segment(4));
                ?>
                <form class="form-horizontal" action="" data-parsley-validate="true" method="post" enctype="multipart/form-data">
                  <div class="form-group">
                    <label class="control-label col-lg-3">Pilih Kategori Pengaduan</label>
                    <div class="col-lg-9">
                      <select class="form-control default-select2" name="id_kategori" required onchange="window.location.href='pengaduan/v/t/'+this.value;">
                        <option value="">- Pilih -</option>
                        <?php
                                      $this->db->order_by('nama_kategori','ASC');
                        $v_kategori = $this->db->get('tbl_kategori');
                        foreach ($v_kategori->result() as $key => $value): ?>
                          <option value="<?php echo $value->id_kategori; ?>" <?php if($value->id_kategori==$link4){echo "selected";} ?>><?php echo ucwords($value->nama_kategori); ?></option>
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
											<strong>Note :</strong> Isikan data aduan dengan jujur & bertanggung Jawab. Bersama kita wujudkan NTB yang Bersih & jujur!
										</div>
                    <br>
                  <div class="form-group">
                    <label class="col-lg-12">Pilih Sub Kategori yang akan di Adukan<b id='wajib_isi'>*</b></label>
                    <div class="col-lg-12">
                      <select class="form-control default-select2" name="id_sub_kategori" required>
                        <option value="">- Pilih -</option>
                        <?php
                                      $this->db->order_by('nama_sub_kategori','ASC');
                        $v_sub_kategori = $this->db->get_where('tbl_sub_kategori', array('id_kategori'=>$link4));
                        foreach ($v_sub_kategori->result() as $key => $value): ?>
                          <option value="<?php echo $value->id_sub_kategori; ?>"><?php echo ucwords($value->nama_sub_kategori); ?></option>
                        <?php
                        endforeach; ?>
                      </select>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-lg-12">Uraian Aduan<b id='wajib_isi'>*</b></label>
                    <div class="col-lg-12">
                      <input type="text" name="isi_pengaduan" class="form-control" value="" placeholder="Jabarkan dengan jelas..!" required>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-lg-12">Keterangan Tambahan<b id='wajib_isi'>*</b></label>
                    <div class="col-lg-12">
                      <textarea name="ket_pengaduan" class="form-control" rows="4" cols="80" placeholder="Keterangan Tambahan.." required></textarea>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-lg-12">Lampirkan Bukti<b id='wajib_isi'>*</b></label>
                    <div class="col-lg-12">
                      <input type="file" name="bukti" class="form-control" required>
                    </div>
                  </div>
                  <?php endif; ?>

                  <hr>
                  <a href="<?php echo strtolower($this->uri->segment(1)); ?>/<?php echo strtolower($this->uri->segment(2)); ?>.html" class="btn btn-default"><< Kembali</a>
                  <button type="submit" name="btnsimpan" class="btn btn-primary" style="float:right;">Simpan</button>
                </form>

      <!-- Table data pengaduan  -->
      <br>
      <hr>
      <h1 align="center"><b>DAFTAR PENGADUAN</b></h1>
      <hr>
      
      <style>
        #bg-white{color:#fff;}
      </style>
      <div class="table-responsive">
        <table id="myTable" class="table table-bordered table-striped">
          <thead>
            <tr style="background:gray;">
              <th id="bg-white" width="1">No.</th>
              <th id="bg-white">PENGADUAN</th>
              <th id="bg-white" width="210">TANGGAL LAPORAN</th>
              <th id="bg-white" width="150">STATUS</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $no=1;
            foreach ($query->result() as $key => $value): ?>
              <tr>
                <td><b><?php echo $no++; ?>.</b></td>
                <td><?php echo $value->isi_pengaduan; ?></td>
                <td><?php echo $this->Mcrud->waktu($value->tgl_pengaduan,'full'); ?></td>
                <td align="center"><?php echo $this->Mcrud->cek_status($value->status); ?></td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>
    <br>
  </div>

</div>
<!-- END: PAGE CONTAINER -->
