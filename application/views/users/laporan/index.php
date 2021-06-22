
<!-- begin #content -->
		<div id="content" class="content">
			<!-- begin breadcrumb -->
			<ol class="breadcrumb pull-right">
				<li><a href="dashboard.html">Dashboard</a></li>
				<li class="active"><?php echo $judul_web; ?></li>
			</ol>
			<!-- end breadcrumb -->
			<!-- begin page-header -->
			<h1 class="page-header"> <small><?php echo $judul_web; ?></small></h1>
			<!-- end page-header -->

			<!-- begin row -->
			<div class="row">
			    <!-- begin col-12 -->
			    <div class="col-md-12">
			        <!-- begin panel -->
              <?php
                echo $this->session->flashdata('msg');
								$level 	= $this->session->userdata('level');
                $link3  = strtolower($this->uri->segment(3));
              ?>
                    <div class="panel panel-inverse">
                        <div class="panel-heading">
                            <div class="panel-heading-btn">
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
                            </div>
                            <h4 class="panel-title">Daftar Laporan</h4>
                        </div>
                        <div class="panel-body">
													<div class="row">
														<div class="col-md-12"><b>Filter</b></div>
														<div class="col-md-3">
															<select class="form-control default-select2" id="stt">
																<option value="">- Semua -</option>
																<option value="proses" <?php if('proses'==$link3){echo "selected";} ?>>Belum di Tanggapi</option>
																<option value="konfirmasi" <?php if('konfirmasi'==$link3){echo "selected";} ?>>Sedang di Proses</option>
																<option value="selesai" <?php if('selesai'==$link3){echo "selected";} ?>>Selesai</option>
															</select>
														</div>
														<div class="col-md-1">
															<button class="btn btn-default" onclick="window.location.href='laporan/v/'+$('#stt').val();"><i class="fa fa-search"></i> Filter</button>
														</div>
														<div class="col-md-6"></div>
														<div class="col-md-2">
															<?php if ($level=='obh'): ?>
																<a href="<?php echo strtolower($this->uri->segment(1)); ?>/<?php echo strtolower($this->uri->segment(2)); ?>/t.html" class="btn btn-primary" style="float:right;">Buat Laporan</a>
															<?php endif; ?>
														</div>
													</div>

													<br>
						<div class="table-responsive">
                            <table id="data-table" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th width="1%">No.</th>
                                        <th width="15%">Hari/Tgl</th>
                                        <th width="55%">Uraian Laporan</th>
                                        <th width="14%">Status</th>
                                        <th width="15%">Opsi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                  <?php
                                  $no=1;
                                   foreach ($query->result() as $baris):?>
                                    <tr>
                                       <td><b><?php echo $no++; ?>.</b> </td>
													<td><?php echo $this->Mcrud->tgl_id(date('d-m-Y H:i:s', strtotime($baris->tgl_laporan)),'full'); ?></td>
													<td><?php echo $baris->isi_laporan; ?></td>
													<td><?php echo $this->Mcrud->cek_status($baris->status); ?></td>
													<td align="center">
														<a href="<?php echo strtolower($this->uri->segment(1)); ?>/<?php echo strtolower($this->uri->segment(2)); ?>/d/<?php echo hashids_encrypt($baris->id_laporan); ?>" class="btn btn-info btn-xs" title="Detail"><i class="fa fa-search"></i></a>
														<?php if ($level=='superadmin'){ ?>
															
															<?php //if ($baris->status=='konfirmasi'){ ?>
																<a class="btn btn-success btn-xs" title="Edit" data-toggle="modal" onclick="modal_show(<?php echo $baris->id_laporan; ?>);"><i class="fa fa-pencil"></i> Edit</a>
																
														<?php }else{ ?>
															<?php if ($baris->status=='proses'){ ?>
																<a href="<?php echo strtolower($this->uri->segment(1)); ?>/<?php echo strtolower($this->uri->segment(2)); ?>/h/<?php echo hashids_encrypt($baris->id_laporan); ?>" class="btn btn-danger btn-xs" title="Hapus" onclick="return confirm('Anda yakin?');"><i class="fa fa-trash-o"></i></a>
															<?php }else{ ?>
																<a href="javascript:;" class="btn btn-danger btn-xs" title="Hapus" disabled><i class="fa fa-trash-o"></i></a>
															<?php } ?>
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

<?php $this->load->view('users/laporan/modal_konfirm'); ?>
