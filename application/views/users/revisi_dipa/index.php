
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
						    $id_dipa 	= $this->session->userdata('id_dipa');
                $level = $this->session->userdata('level');
		          ?>
                            

                          <!-- Accordion (only show in Superadmin/Koor Wilayah) -->
                          <?php if($id_dipa == '00'): ?>
                            <?php foreach ($dipa_list as $baris): 
                              // if($baris['id'] == "111" || $baris['id'] == "999") continue;
                              ?>
                            <div class="accordion dipa-collapse <?php if($baris['id'] == "00") echo "invisible" ?>" id="accordionExample">
                              <div class="card">
                                <div class="card-header" id="heading<?php echo $baris['id']; ?>">
                                  <h2 class="mb-0">
                                    <button class="dipa-accordion-btn btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapse<?php echo $baris['id']; ?>" aria-expanded="false" aria-controls="collapse<?php echo $baris['id']; ?>">
                                      <?php echo ucwords($baris['nama']); ?>
                                      <b class="caret"></b>
                                    </button>
                                  </h2>
                                </div>
                                <div id="collapse<?php echo $baris['id']; ?>" class="collapse" aria-labelledby="heading<?php echo $baris['id']; ?>" data-parent="#accordionExample">
                                  <div class="card-body">

                                    <!-- Table  -->
                                    <div class="table-responsive">
                                      <table id="data-table" class="table table-striped table-bordered display">
                                          <thead>
                                              <tr>
                                                  <th width="1%">NO.</th>
                                                  <th width="20%">JENIS REVISI</th>
                                                  <th width="25%">KETERANGAN</th>
                                                  <th width="15%">FILE USULAN REVISI</th>
                                                  <th width="15%">VERIFIKASI</th>
                                                  <th width="14%">Opsi</th>
                                              </tr>
                                          </thead>
                                          <tbody>
                                            <?php
                                              $no=1;
                                              $dipa = $this->Guzzle_model->getRevisiDipaByDipaId($baris['id']);
                                            foreach ($dipa as $value): ?>
                                              <tr>
                                                  <td><?php echo $no++; ?>.</td>
                                                  <td><?php echo ucwords($value['jenis_revisi']); ?></td>
                                                  <td><?php echo $value['keterangan']; ?></td>
                                                  <td><a class="btn btn-info" href="<?php echo $value['url_file']; ?>" target="_blank"><i class="fa fa-download"></i> Download</a></td>
                                                  <td class="text-center verifikasi-icon">
                                                    <?php if ($value['status_verifikasi'] == 'sudah') {?><i class="fa fa-check-square-o" aria-hidden="true"></i>
                                                    <?php } else {?><i class="fa fa-square-o" aria-hidden="true"></i>
                                                    <?php } ?>
                                                  </td>
                                                  <td align="center">
                                                    <a href="<?php echo strtolower($this->uri->segment(1)); ?>/<?php echo strtolower($this->uri->segment(2)); ?>/d/<?php echo hashids_encrypt($value['id']); ?>" class="btn btn-info btn-xs" title="Detail"><i class="fa fa-search"></i></a>
                                                  </td>
                                              </tr>
                                            <?php endforeach; ?>
                                          </tbody>
                                          
                                      </table>
                                    </div>
                                    <!-- End of Table  -->

                                  </div>
                                </div>
                              </div>
                            </div>
                            <?php endforeach; ?>
                          <?php else: ?>
                            <div class="panel panel-inverse">
                              <div class="panel-heading">
                                
                                  <div class="panel-heading-btn">
                                      <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                                      <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                                      <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                                      <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
                                  </div>
                                  <h4 class="panel-title">USULAN REVISI DIPA</h4>
                              </div>
                              <div class="panel-body">
                              <?php if ($level == 'pelaksana' OR $level == 'perencana'): ?>
                                <a href="<?php echo strtolower($this->uri->segment(1)); ?>/<?php echo strtolower($this->uri->segment(2)); ?>/t.html" class="btn btn-primary"><i class="fa fa-plus-circle"></i> Input Usulan Revisi DIPA</a>
                                <hr>
                              <?php endif; ?>
                            <!-- Table  -->
                            <div class="table-responsive">
                              <table id="data-table" class="table table-striped table-bordered">
                                  <thead>
                                      <tr>
                                          <th width="1%">NO.</th>
                                          <th>JENIS REVISI</th>
                                          <th>KETERANGAN</th>
                                          <th width="15%">FILE USULAN REVISI</th>
                                          <th width="15%">VERIFIKASI</th>
                                          <th width="15%">Opsi</th>
                                      </tr>
                                  </thead>
                                  <tbody>
                                    <?php
                                      $no=1;
                                    foreach ($revisi_dipa as $value): ?>
                                      <tr>
                                          <td><?php echo $no++; ?>.</td>
                                          <td><?php echo ucwords($value['jenis_revisi']); ?></td>
                                          <td><?php echo $value['keterangan']; ?></td>
                                          <td><a class="btn btn-info" href="<?php echo $value['url_file']; ?>" target="_blank"><i class="fa fa-download"></i> Download</a></td>
                                          <td class="text-center verifikasi-icon">
                                            <?php if ($value['status_verifikasi'] == 'sudah') {?><i class="fa fa-check-square-o" aria-hidden="true"></i>
                                            <?php } else {?><i class="fa fa-square-o" aria-hidden="true"></i>
                                            <?php } ?>
                                          </td>
                                          <td align="center">
                                            <a href="<?php echo strtolower($this->uri->segment(1)); ?>/<?php echo strtolower($this->uri->segment(2)); ?>/d/<?php echo hashids_encrypt($value['id']); ?>" class="btn btn-info btn-xs" title="Detail"><i class="fa fa-search"></i></a>

                                            <a href="<?php echo strtolower($this->uri->segment(1)); ?>/<?php echo strtolower($this->uri->segment(2)); ?>/e/<?php echo hashids_encrypt($value['id']); ?>" class="btn btn-success btn-xs <?php if ($level != 'pelaksana') { echo "hidden"; } ?>" title="Edit"><i class="fa fa-edit"></i></a>

                                            <a href="<?php echo strtolower($this->uri->segment(1)); ?>/<?php echo strtolower($this->uri->segment(2)); ?>/h/<?php echo hashids_encrypt($value['id']); ?>" class="btn btn-danger btn-xs <?php if ($level != 'pelaksana') { echo "hidden"; } ?>" title="Hapus" onclick="return confirm('Anda yakin? Seluruh dokumen akan ikut terhapus.');"><i class="fa fa-trash-o"></i></a>
                                            
                                            <!-- <a href="<?php echo strtolower($this->uri->segment(1)); ?>/<?php echo strtolower($this->uri->segment(2)); ?>/v/<?php echo hashids_encrypt($value['id']); ?>" class="btn btn-success btn-xs <?php if ($id_user != 'pelaksana') { echo "hidden"; } ?>" title="Edit"><i class="fa fa-edit"></i> Verifikasi</a> -->
                                          </td>
                                      </tr>
                                    <?php endforeach; ?>
                                  </tbody>
                              </table>
                            </div>
                            <!-- End of Table  -->
                               </div>
                    </div>
                    <!-- end panel -->
                            
                          <?php endif; ?>
                            <!-- End Accordion -->

                </div>
                <!-- end col-12 -->
            </div>
            <!-- end row -->
		</div>
		<!-- end #content -->

    <script>
      $(document).ready(function() {
    $('table.display').DataTable();
} );
    </script>