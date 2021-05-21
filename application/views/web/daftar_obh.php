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
      <h1 align="center"><b>DAFTAR OBH</b></h1>
      <hr>

      <br>

      <div class="panel-group" id="accordion">
        <div class="panel panel-default">
          <div class="panel-heading">
            <h4 class="panel-title">
              <a href="#collapseone" data-toggle="collapse" data-parent="accordion">Collapsible panel 1</a>  
            </h4>
          </div>
          <div id="collapseone" class="panel-collapse collapse in">
            <div class="panel-body">
              jabdadallalls nsndbjnd sdnsadnkjsd kasksdnjbd
            </div>
          </div>  
          <div class="panel-heading">
            <h4 class="panel-title">
              <a href="#collapsetwo" data-toggle="collapse" data-parent="accordion">Collapsible panel 2</a>  
            </h4>
          </div>
          <div id="collapsetwo" class="panel-collapse collapse">
            <div class="panel-body">
              aaaaa jabdadallalls nsndbjnd sdnsadnkjsd kasksdnjbd
            </div>
          </div>  
          <div class="panel-heading">
            <h4 class="panel-title">
              <a href="#collapsethree" data-toggle="collapse" data-parent="accordion">Collapsible panel 3</a>  
            </h4>
          </div>
          <div id="collapsethree" class="panel-collapse collapse">
            <div class="panel-body">
              vvv jabdadallalls nsndbjnd sdnsadnkjsd kasksdnjbd
            </div>
          </div>
        </div>
      </div>


      <!-- Tabel  -->
              <style>
                #bg-white{color:#fff;}
              </style>
              <div class="table-responsive">
								<table id="myTable" class="table table-bordered table-striped">
									<thead>
										<tr style="background:gray;">
                      <th width="1%">No.</th>
                      <th width="12%">Kota</th>
                      <th>Nama</th>
                      <th>Alamat</th>
                      <th width="15%">No.Telp</th>
                      <th width="15%">Email</th>
                      <th width="10%">Detail</th>
										</tr>
									</thead>
                  <tbody>
                    <?php
                    $no=1;
                     foreach ($query->result() as $baris):
                         ?>
                      <tr>
                        <td><b><?php echo $no++; ?>.</b></td>
                        <td><?php echo $baris->kota; ?></td>
                        <td><?php echo $baris->nama; ?></td>
                        <td><?php echo $baris->nama_singkat; ?></td>
                        <td><?php echo $baris->alamat_notaris; ?></td>
                        <td><?php echo $baris->telpon; ?></td>
                        <td><?php echo $baris->email_notaris; ?></td>
                        <td align="center">
                          <a href="<?php echo $link1; ?>/<?php echo $link2; ?>/d/<?php echo hashids_encrypt($baris->id_user); ?>" class="btn btn-info btn-xs" title="Detail"><i class="fa fa-search"></i></a>
                          <?php if ($level=='superadmin'): ?>
                          <a href="<?php echo $link1; ?>/<?php echo $link2; ?>/h/<?php echo hashids_encrypt($baris->id_user); ?>" class="btn btn-danger btn-xs" title="Hapus" onclick="return confirm('Anda yakin?');"><i class="fa fa-trash-o"></i></a>
                          <?php endif; ?>
                        </td>
                      </tr>
                    <?php endforeach; ?>
                  </tbody>
                    
									<!-- <tbody>
										<?php
                    // $no=1;
                    // foreach ($query->result() as $key => $value): ?>
                      <tr>
                        <td><b><?php //echo $no++; ?>.</b></td>
                        <td><?php //echo $value->isi_pengaduan; ?></td>
                        <td><?php //echo $this->Mcrud->waktu($value->tgl_pengaduan,'full'); ?></td>
                        <td align="center"><?php //echo $this->Mcrud->cek_status($value->status); ?></td>
                      </tr>
                    <?php //endforeach; ?>
									</tbody> -->
								</table>
              </div>
			</div>
      <br>
  </div>

</div>
<!-- END: PAGE CONTAINER -->
