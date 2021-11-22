
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
                $id_dipa = $this->session->userdata('id_dipa');
                $link3 = $this->uri->segment(3);
                $link4 = $this->uri->segment(4);

              ?>
                    <div class="panel panel-inverse">
                        <div class="panel-heading">
                            <div class="panel-heading-btn">
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
                            </div>
                            <h4 class="panel-title">RPD DIPA <?php echo strtoupper($judul_tabel); ?></h4>
                        </div>
                        <div class="panel-body">
                            <div class="row">
                              <?php if ($id_dipa == '00'): ?>
                                <div class="col-md-3">
                                  <select class="form-control default-select2" id="stt_dipa">
                                    <option value="">- Pilih DIPA -</option>
                                    <?php foreach($dipa_list as $baris):
                                          if ($baris['id']=='00') continue;
                                    ?>
                                    <option value="<?php echo $baris['id'] ?>" <?php if($baris['id']==$link3){echo "selected";} ?>><?php echo ucwords($baris['nama']); ?></option>
                                    <?php endforeach; ?>
                                  </select>
                                </div>
                                <div class="col-md-2">
                                  <button class="btn btn-default" onclick="window.location.href='rpd/v/'+$('#stt_dipa').val();"><i class="fa fa-search"></i> Pilih DIPA</button>
                                </div>
                                <div class="col-md-3">
                                  <select class="form-control default-select2" id="stt_revisi">
                                    <option value="">- Pilih Revisi-</option>
                                    <?php for($i=0; $i < count($rpd_dipa); $i++): ?>
                                      <option value="<?php echo $i ?>" <?php if ($i == $link4) { echo "selected"; } ?>>
                                        <?php if ($i == 0):?> Disbursement Plan
                                        <?php else:?>Revisi ke <?php echo $i; endif;?> 
                                      </option>
                                    <?php endfor; ?>
                                  </select>
                                </div>
                                <div class="col-md-2">
                                  <button class="btn btn-default" onclick="window.location.href='rpd/v/<?php echo $link3;?>/'+$('#stt_revisi').val();"><i class="fa fa-search"></i> Pilih Revisi</button>
                                </div>
                              <?php endif; ?>
                            </div>
                            <hr>
                            <?php if ($rpd == null):?>
                              <div class="text-center">-- Belum ada data RPD --</div>
                            <?php else:?>
                            <div class="table-responsive">
                            <table class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                      <th width="25%">BULAN</th>
                                      <th width="25%">BELANJA PEGAWAI</th>
                                      <th width="25%">BELANJA BARANG</th>
                                      <th width="25%">BELANJA MODAL</th>
                                    </tr>
                                </thead>
                                <tbody>
                                  <?php
                                   foreach ($rpd as $value): ?>
                                    <tr>
                                      <td>Januari</td>
                                      <td><?php echo $this->Mcrud->rupiah($value['januari_pegawai']); ?></td>
                                      <td><?php echo $this->Mcrud->rupiah($value['januari_barang']); ?></td>
                                      <td><?php echo $this->Mcrud->rupiah($value['januari_modal']); ?></td>
                                    </tr>
                                    <tr>
                                      <td>Februari</td>
                                      <td><?php echo $this->Mcrud->rupiah($value['februari_pegawai']); ?></td>
                                      <td><?php echo $this->Mcrud->rupiah($value['februari_barang']); ?></td>
                                      <td><?php echo $this->Mcrud->rupiah($value['februari_modal']); ?></td>
                                    </tr>
                                    <tr>
                                      <td>Maret</td>
                                      <td><?php echo $this->Mcrud->rupiah($value['maret_pegawai']); ?></td>
                                      <td><?php echo $this->Mcrud->rupiah($value['maret_barang']); ?></td>
                                      <td><?php echo $this->Mcrud->rupiah($value['maret_modal']); ?></td>
                                    </tr>
                                    <tr>
                                      <td>April</td>
                                      <td><?php echo $this->Mcrud->rupiah($value['april_pegawai']); ?></td>
                                      <td><?php echo $this->Mcrud->rupiah($value['april_barang']); ?></td>
                                      <td><?php echo $this->Mcrud->rupiah($value['april_modal']); ?></td>
                                    </tr>
                                    <tr>
                                      <td>Mei</td>
                                      <td><?php echo $this->Mcrud->rupiah($value['mei_pegawai']); ?></td>
                                      <td><?php echo $this->Mcrud->rupiah($value['mei_barang']); ?></td>
                                      <td><?php echo $this->Mcrud->rupiah($value['mei_modal']); ?></td>
                                    </tr>
                                    <tr>
                                      <td>Juni</td>
                                      <td><?php echo $this->Mcrud->rupiah($value['juni_pegawai']); ?></td>
                                      <td><?php echo $this->Mcrud->rupiah($value['juni_barang']); ?></td>
                                      <td><?php echo $this->Mcrud->rupiah($value['juni_modal']); ?></td>
                                    </tr>
                                    <tr>
                                      <td>Juli</td>
                                      <td><?php echo $this->Mcrud->rupiah($value['juli_pegawai']); ?></td>
                                      <td><?php echo $this->Mcrud->rupiah($value['juli_barang']); ?></td>
                                      <td><?php echo $this->Mcrud->rupiah($value['juli_modal']); ?></td>
                                    </tr>
                                    <tr>
                                      <td>Agustus</td>
                                      <td><?php echo $this->Mcrud->rupiah($value['agustus_pegawai']); ?></td>
                                      <td><?php echo $this->Mcrud->rupiah($value['agustus_barang']); ?></td>
                                      <td><?php echo $this->Mcrud->rupiah($value['agustus_modal']); ?></td>
                                    </tr>
                                    <tr>
                                      <td>September</td>
                                      <td><?php echo $this->Mcrud->rupiah($value['september_pegawai']); ?></td>
                                      <td><?php echo $this->Mcrud->rupiah($value['september_barang']); ?></td>
                                      <td><?php echo $this->Mcrud->rupiah($value['september_modal']); ?></td>
                                    </tr>
                                    <tr>
                                      <td>Oktober</td>
                                      <td><?php echo $this->Mcrud->rupiah($value['oktober_pegawai']); ?></td>
                                      <td><?php echo $this->Mcrud->rupiah($value['oktober_barang']); ?></td>
                                      <td><?php echo $this->Mcrud->rupiah($value['oktober_modal']); ?></td>
                                    </tr>
                                    <tr>
                                      <td>November</td>
                                      <td><?php echo $this->Mcrud->rupiah($value['november_pegawai']); ?></td>
                                      <td><?php echo $this->Mcrud->rupiah($value['november_barang']); ?></td>
                                      <td><?php echo $this->Mcrud->rupiah($value['november_modal']); ?></td>
                                    </tr>
                                    <tr>
                                    <td>Desember</td>
                                    <td><?php echo $this->Mcrud->rupiah($value['desember_pegawai']); ?></td>
                                    <td><?php echo $this->Mcrud->rupiah($value['desember_barang']); ?></td>
                                    <td><?php echo $this->Mcrud->rupiah($value['desember_modal']); ?></td>
                                    </tr>
                                  <?php endforeach; ?>
                                </tbody>
                                
                            </table>
													</div>
                          <?php endif; ?>
                        </div>
                    </div>
                    <!-- end panel -->
                </div>
                <!-- end col-12 -->
            </div>
            <!-- end row -->
		</div>
		<!-- end #content -->

<script>
$(document).ready(function(){
  $('#right').tooltip();
});
</script>