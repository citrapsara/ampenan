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
                $foto = "img/user/user-default.jpg";
                $foto_k = $query->foto_obh;
              	if ($foto_k!='') {
              		if(file_exists("$foto_k")){
              			$foto = $foto_k;
              		}
              	}
                ?>
                <div class="table-responsive">
                  <table class="table table-bordered table-striped" width="100%">
                    <tbody>
                      <tr>
                        <th colspan="3">
                          <center><img src="<?php echo $foto; ?>" alt="image obh" width="100"></center>
                        </th>
                      </tr>
					   <tr>
                        <th>N a m a</th>
                        <th>:</th>
                        <th><?php echo $query->nama; ?></th>
                      </tr>
                      <tr>
                        <th>Nama Singkat</th>
                        <th>:</th>
                        <th><?php echo $query->nama_singkat; ?></th>
                      </tr>
                      <tr>
                        <th>Tanggal Berdiri</th>
                        <th>:</th>
                        <th><?php echo $this->Mcrud->tgl_id(date('d-m-Y', strtotime($query->tgl_berdiri)),'full'); ?></th>
                      </tr>
                      <tr>
                        <th>Status Badan Hukum</th>
                        <th>:</th>
                        <th><?php echo $query->status_obh; ?></th>
                      </tr>
                      <tr>
                        <th>Akta OBH</th>
                        <th>:</th>
                        <th><?php echo $query->akta_obh; ?></th>
                      </tr>
                      <tr>
                        <th>NPWP OBH</th>
                        <th>:</th>
                        <th><?php echo $query->npwp_obh; ?></th>
                      </tr>
                      <tr>
                        <th>Akreditasi</th>
                        <th>:</th>
                        <th><?php echo $query->akreditasi_obh; ?></th>
                      </tr>
                      <tr>
                        <th>Pagu Awal Anggaran Litigasi</th>
                        <th>:</th>
                        <th id="pagu_litigasi"></th>
                      </tr>
                      <tr>
                        <th>Pagu Awal Anggaran Non Litigasi</th>
                        <th>:</th>
                        <th id="pagu_non_litigasi"></th>
                      </tr>
					            <tr>
                        <th>Nomor SK AHU</th>
                        <th>:</th>
                        <th><?php echo $query->no_sk; ?></th>
                      </tr>
                      <tr>
                        <th>Tanggal SK</th>
                        <th>:</th>
                        <th><?php echo $this->Mcrud->tgl_id(date('d-m-Y', strtotime($query->tgl_sk)),'full'); ?></th>
                      </tr>
                      <tr>
                        <th>Nomor Kontrak</th>
                        <th>:</th>
                        <th><?php echo $query->no_kontrak; ?></th>
                      </tr>
                      <tr>
                        <th>Tanggal Kontrak</th>
                        <th>:</th>
                        <th><?php echo $this->Mcrud->tgl_id(date('d-m-Y', strtotime($query->tgl_kontrak)),'full'); ?></th>
                      </tr>
                      <tr>
                        <th>Kota</th>
                        <th>:</th>
                        <th><?php echo $query->kota; ?></th>
                      </tr>
                      <tr>
                        <th>Alamat</th>
                        <th>:</th>
                        <th><?php echo $query->alamat_notaris; ?></th>
                      </tr>
                      <tr>
                        <th>Latitude</th>
                        <th>:</th>
                        <th><?php echo $query->latitude; ?></th>
                      </tr>
                      <tr>
                        <th>Longitude</th>
                        <th>:</th>
                        <th><?php echo $query->longitude; ?></th>
                      </tr>
                      <tr>
                        <th>No. Telp</th>
                        <th>:</th>
                        <th><?php echo $query->telpon; ?></th>
                      </tr>
                      <tr>
                        <th>Email</th>
                        <th>:</th>
                        <th><?php echo $query->email_notaris; ?></th>
                      </tr>
					  <tr>
                        <th width="135">No. Registrasi</th>
                        <th width="1">:</th>
                        <th><?php echo $query->no_idn; ?></th>
                      </tr>
                    </tbody>
                  </table>
                </div>
                <hr style="margin-top:0px;">
                <a href="<?php echo $link1; ?>/<?php echo $link2; ?>.html" class="btn btn-default"><< Kembali</a>
            </div>

        </div>
      </div>
    </div>
    <!-- /dashboard content -->

<script type="text/javascript">
  var pagu_litigasi = <?php echo $query->pagu_litigasi; ?>;
  var pagu_non_litigasi = <?php echo $query->pagu_non_litigasi; ?>;

  function pisah_ribuan(bilangan) {
    var	reverse = bilangan.toString().split('').reverse().join(''),
    ribuan 	= reverse.match(/\d{1,3}/g);
    ribuan	= ribuan.join('.').split('').reverse().join('');
    return ribuan;
  }

  document.getElementById("pagu_litigasi").innerHTML = 'Rp ' +  pisah_ribuan(pagu_litigasi);
  document.getElementById("pagu_non_litigasi").innerHTML = 'Rp ' +  pisah_ribuan(pagu_non_litigasi);

</script>