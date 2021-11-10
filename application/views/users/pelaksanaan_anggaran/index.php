
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
                $level = $this->session->userdata('level');
              ?>
                    <div class="panel panel-inverse">
                        <div class="panel-heading">
                            <div class="panel-heading-btn">
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
                            </div>
                            <h4 class="panel-title">PELAKSANAAN ANGGARAN <?php echo strtoupper($judul_tabel); ?></h4>
                        </div>
                        <div class="panel-body">
                          <?php if ($id_dipa == '00'): ?>
                            <div class="row">
                              <div class="col-md-12"><b>Filter</b></div>
                                <div class="col-md-3">
                                  <select class="form-control default-select2" id="stt">
                                    <option value="">- Pilih -</option>
                                    <?php foreach($dipa_list as $baris): ?>

                                    <option value="<?php echo $baris['id'] ?>" <?php if($baris['id']==$link3){echo "selected";} ?>><?php echo ucwords($baris['nama']); ?></option>
                                    <?php endforeach; ?>
                                  </select>
                                </div>
                                <div class="col-md-1">
                                  <button class="btn btn-default" onclick="window.location.href='pelaksanaan_anggaran/v/'+$('#stt').val();"><i class="fa fa-search"></i> Filter</button>
                                </div>
                                <div class="col-md-6"></div>
                                <div class="col-md-2"></div>
                            </div>
                          <?php else: ?>
                            <a href="<?php echo strtolower($this->uri->segment(1)); ?>/<?php echo strtolower($this->uri->segment(2)); ?>/<?php echo $this->uri->segment(3); ?>/t.html" class="btn btn-primary"><i class="fa fa-plus-circle"></i> Input Pelaksanaan Anggaran</a>
                            <?php endif; ?>
                            <hr>
													<div class="table-responsive">
                            <table id="data-table" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th width="1%">NO.</th>
                                        <th>KETERANGAN</th>
                                        <th>DOKUMEN PERTANGGUNGJAWABAN</th>
                                        <th>REALISASI</th>
                                        <th>TANGGAL KEGIATAN</th>
                                        <th>TANGGAL INPUT</th>
                                        <th>VERIFIKASI</th>
                                        <th width="15%">Opsi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                  <?php
                                    $no=1;
                                   foreach ($pelaksanaan_anggaran as $value): ?>
                                    <tr>
                                        <td><?php echo $no++; ?>.</td>
																				<td><?php echo ucwords($value['uraian']); ?></td>
																				<td class="text-center"><a class="btn btn-info" href="<?php echo $value['url_file']; ?>" target="_blank"><i class="fa fa-download"></i> Download</a></td>
																				<td>100000</td>
																				<td><?php echo $this->Mcrud->tgl_id(date('d-m-Y', strtotime($value['tanggal_pelaksanaan'])),'full'); ?></td>
																				<td><?php echo $this->Mcrud->tgl_id(date('d-m-Y', strtotime($value['created_at'])),'full'); ?></td>
                                        <td class="text-center verifikasi-icon">
                                          <?php if ($value['status_verifikasi'] == 'sudah') {?><i class="fa fa-check-square-o" aria-hidden="true"></i>
                                          <?php } else {?><i class="fa fa-square-o" aria-hidden="true"></i>
                                          <?php } ?>
                                        </td>
																				<td align="center">
                                          <a href="<?php echo strtolower($this->uri->segment(1)); ?>/<?php echo strtolower($this->uri->segment(2)); ?>/<?php echo strtolower($this->uri->segment(3)); ?>/d/<?php echo hashids_encrypt($value['id']); ?>" class="btn btn-info btn-xs" title="Detail"><i class="fa fa-search"></i></a>
                                          <?php if($level == 'keuangan'){ ?>
                                            <a href="<?php echo strtolower($this->uri->segment(1)); ?>/<?php echo strtolower($this->uri->segment(2)); ?>/<?php echo $this->uri->segment(3); ?>/c/<?php echo hashids_encrypt($value['id']); ?>" class="btn btn-success btn-xs" title="Edit"><i class="fa fa-edit"></i> Verifikasi</a>
                                          <?php } else { ?>
																					  <a href="<?php echo strtolower($this->uri->segment(1)); ?>/<?php echo strtolower($this->uri->segment(2)); ?>/<?php echo $this->uri->segment(3); ?>/e/<?php echo hashids_encrypt($value['id']); ?>" class="btn btn-success btn-xs <?php if ($value['status_verifikasi'] == 'sudah') { echo 'disabled'; }; ?>" title="Edit"><i class="fa fa-edit"></i></a>
                                          <?php } ?>
                                          <?php if($level == 'pelaksana'){ ?>
                                            <a href="<?php echo strtolower($this->uri->segment(1)); ?>/<?php echo strtolower($this->uri->segment(2)); ?>/<?php echo $this->uri->segment(3); ?>/h/<?php echo hashids_encrypt($value['id']); ?>" class="btn btn-danger btn-xs <?php if ($value['status_verifikasi'] == 'sudah') { echo 'disabled'; }; ?>" title="Hapus" onclick="return confirm('Anda yakin? Seluruh dokumen akan ikut terhapus.');"><i class="fa fa-trash-o"></i></a>
                                          <?php } ?>
                                        </td>
                                    </tr>
                                  <?php endforeach; ?>
                                </tbody>
                                
                            </table>
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
