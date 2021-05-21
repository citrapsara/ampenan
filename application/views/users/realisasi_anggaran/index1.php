<?php
$link1 = strtolower($this->uri->segment(1));
$link2 = strtolower($this->uri->segment(2));
$link3 = strtolower($this->uri->segment(3));
$link4 = strtolower($this->uri->segment(4));
?>
<!-- begin #content -->
	<div id="content" class="content">
			<!-- begin breadcrumb -->
			<ol class="breadcrumb pull-right">
				<li><a href="dashboard.html">Dashboard</a></li>
				<li class="active"><?php echo $judul_web; ?></li>
			</ol>
			<!-- end breadcrumb -->
			<!-- begin page-header -->
			<h1 class="page-header">Data <small><?php echo $judul_web; ?></small></h1>
			<!-- end page-header -->

			<!-- begin row -->
			<div class="row">
			    <!-- begin col-12 -->
			    <div class="col-md-12">
			        <!-- begin panel -->
              <?php
                echo $this->session->flashdata('msg');
								$level 	= $this->session->userdata('level');
              ?>
                    <div class="panel panel-inverse">
                        <div class="panel-heading">
                            <div class="panel-heading-btn">
								<a href="obh/v/cetak" class="btn btn-success btn-xs" target="_blank"><i class="fa fa-file"></i> Cetak</a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
                            </div>
                            <h4 class="panel-title"><?php echo $judul_web; ?></h4>
                        </div>
                        <div class="panel-body">
                          <h3 class="text-center">Data Anggaran Seluruh Indonesia TA 2021</h3>

                          <!-- Info Anggaran -->
                          <div class="row current-anggaran">
                            <div class="col-md-4">
                                <div class="info-anggaran total-anggaran text-center">
                                    <span class="info-title">Total Anggaran</span><br>
                                    <span class="info-number" id="total_anggaran"></span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="info-anggaran penyerapan-anggaran text-center">
                                    <span class="info-title">Penyerapan Anggaran</span><br>
                                    <span class="info-number" id="penyerapan_anggaran"></span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="info-anggaran sisa-anggaran text-center">
                                    <span class="info-title">Sisa Anggaran</span><br>
                                    <span class="info-number" id="sisa_anggaran"></span>
                                </div>
                            </div>
                          </div>

                            <!-- Edit Anggaran -->
                            <div class="edit-anggaran">
                                <button class="btn btn-success btn-edit-anggaran" data-toggle="collapse" data-target="#edit_anggaran">Edit Anggaran</button>

                                <div id="edit_anggaran" class="collapse">
                                <form class="form-horizontal" action="" data-parsley-validate="true" method="post" enctype="multipart/form-data">
                                    <input type="hidden" name="id_anggaran" value="<?php echo $query->id_anggaran; ?>">
                                    <div class="form-group">
                                        <label class="control-label col-lg-3">Total Anggaran</label>
                                        <div class="col-lg-9">
                                        <input type="text" name="total_anggaran" class="form-control" value="<?php echo $query->total_anggaran; ?>" placeholder="Total Anggaran" required>
                                        <i style="color: red;">*Masukan hanya angka.</i>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-lg-3">Penyerapan Anggaran</label>
                                        <div class="col-lg-9">
                                        <input type="text" name="penyerapan_anggaran" class="form-control" value="<?php echo $query->penyerapan_anggaran; ?>" placeholder="Penyerapan Anggaran" onkeypress="return hanyaAngka(event)" required autofocus onfocus="this.value = this.value;">
                                        <i style="color: red;">*Masukan hanya angka.</i>
                                        </div>
                                    </div>
                                    
                                    <hr>
                                    
                                    <button type="submit" name="btnupdate" class="btn btn-primary">Simpan</button>
                                    </form>
                                </div>

                            </div>
                        </div>
                    </div>
                    <!-- end panel -->
                </div>
                <!-- end col-12 -->
            </div>
            <!-- end row -->
		</div>
		<!-- end #content -->

<script type="text/javascript">
    var total_anggaran = <?php echo $query->total_anggaran; ?>;
    var penyerapan_anggaran = <?php echo $query->penyerapan_anggaran; ?>;
    var sisa_anggaran = <?php echo $query->total_anggaran - $query->penyerapan_anggaran; ?>;

    function pisah_ribuan(bilangan) {
        var	reverse = bilangan.toString().split('').reverse().join(''),
        ribuan 	= reverse.match(/\d{1,3}/g);
        ribuan	= ribuan.join('.').split('').reverse().join('');
        return ribuan;
    }

    document.getElementById("total_anggaran").innerHTML = pisah_ribuan(total_anggaran);
    document.getElementById("penyerapan_anggaran").innerHTML = pisah_ribuan(penyerapan_anggaran);
    document.getElementById("sisa_anggaran").innerHTML = pisah_ribuan(sisa_anggaran);
</script>
