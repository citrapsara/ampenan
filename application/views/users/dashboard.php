<?php
$cek    = $user->row();
$level  = $cek->level;

?>
<!-- begin #content -->
<div id="content" class="content">
	  <!-- begin breadcrumb -->
	  <ol class="breadcrumb pull-right">
		<li class="active">Dashboard</li>
	  </ol>
	  <!-- end breadcrumb -->
	  <!-- begin page-header -->
	  <h1 class="page-header">Dashboard <small> <?php echo ucwords($cek->level);?></small></h1>
	  <!-- end page-header -->
	  <!-- begin row -->
	  <!-- <div class="row">
		<div class="col-md-12">
			<div class="widget widget-stats bg-white text-inverse">
				<div class="stats-icon stats-icon-lg stats-icon-square bg-gradient-black"><i class="fa fa-file"></i></div>
				<div class="stats-title"><?php echo $this->Mcrud->judul_web(); ?></div>
				<div class="stats-number">Selamat Datang <?php echo ucwords($cek->nama_lengkap); ?></div>
				<div class="stats-progress progress">
						  <div class="progress-bar" style="width: 70.1%;"></div>
				</div>
					  <div class="stats-desc">Better than last week (70.1%)</div>
			</div>
		</div>
	  </div> -->


	<div class="row">
		<!-- MASYARAKAT -->
		<div class="row">
			<?php if ($level=='user'): ?>
				
				<!-- begin col-12 -->
				<?php if ($level!=='user'): ?>
					<div class="col-md-3">
						<div class="widget widget-stats bg-info text-inverse">
							<div class="stats-icon stats-icon-lg stats-icon-square bg-gradient-yellow">
							  <i class="fa fa-user"></i>
							</div>
							<div class="stats-desc">Data Masyarakat</div>
							<div class="stats-number">
							  <?php echo number_format($this->db->get_where('tbl_user', array('level'=>'user'))->num_rows(),0,",","."); ?>
							</div>
							<div class="stats-progress progress">
								<div class="progress-bar" style="width: 70.1%;"></div>
							</div>
						</div>
					</div>
				<?php endif; ?>
					<div class="col-md-<?php if($level=='user'){echo "4";}else{echo "3";}?>">
						<div class="widget widget-stats bg-orange text-inverse">
							<div class="stats-icon stats-icon-lg stats-icon-square bg-gradient-yellow">
							  <i class="fa fa-commenting"></i>
							</div>
							<div class="stats-desc">Belum Diperiksa</div>
							<div class="stats-number">
							  <?php
							  if($level=='user'){
								$this->db->where('user',$cek->id_user);
							  }
							  echo number_format($this->db->get_where('tbl_pengaduan', array('status'=>'proses'))->num_rows(),0,",","."); ?>
							</div>
							<div class="stats-progress progress">
								<div class="progress-bar" style="width: 70.1%;"></div>
							</div>
							 <div class="stats-desc">Laporan Belum Dikonfirmasi</div>
						</div>
					</div>
					<div class="col-md-<?php if($level=='user'){echo "4";}else{echo "3";}?>">
						<div class="widget widget-stats bg-blue text-inverse">
							<div class="stats-icon stats-icon-lg stats-icon-square bg-gradient-yellow">
							  <i class="fa fa-spinner"></i>
							</div>
							<div class="stats-desc">Ditindak Lanjuti</div>
							<div class="stats-number">
							  <?php
							  if($level=='user'){
								$this->db->where('user',$cek->id_user);
							  }
							  echo number_format($this->db->get_where('tbl_pengaduan', array('status'=>'konfirmasi'))->num_rows(),0,",","."); ?>
							</div>
							<div class="stats-progress progress">
								<div class="progress-bar" style="width: 70.1%;"></div>
							</div>
								  <div class="stats-desc">Laporan Sedang diProses</div>
						</div>
					</div>
					<div class="col-md-<?php if($level=='user'){echo "4";}else{echo "3";}?>">
						<div class="widget widget-stats bg-green text-inverse">
							<div class="stats-icon stats-icon-lg stats-icon-square bg-gradient-yellow">
							  <i class="fa fa-check-square-o"></i>
							</div>
							<div class="stats-desc">Selesai</div>
							<div class="stats-number">
							  <?php
							  if($level=='user'){
								$this->db->where('user',$cek->id_user);
							  }
							  echo number_format($this->db->get_where('tbl_pengaduan', array('status'=>'selesai'))->num_rows(),0,",","."); ?>
							</div>
							<div class="stats-progress progress">
								<div class="progress-bar" style="width: 70.1%;"></div>
							</div>
								  <div class="stats-desc">Laporan Selesai</div>
						</div>
					</div>
			<?php endif; ?>
		</div>
		
		<!-- U USER NOTARIS  -->
		<div class="row">
			<?php if ($level=='obh'): ?>
					  <?php if ($level!='obh'): ?>
						<div class="col-md-3">
							<div class="widget widget-stats bg-info text-inverse">
								<div class="stats-icon stats-icon-lg stats-icon-square bg-gradient-purple">
								  <i class="fa fa-user"></i>
								</div>
								<div class="stats-desc">Daftar OBH</div>
								<div class="stats-number">
								  <?php echo number_format($this->db->get_where('tbl_user', array('level'=>'obh'))->num_rows(),0,",","."); ?>
								</div>
								<div class="stats-progress progress">
									<div class="progress-bar" style="width: 70.1%;"></div>
								</div>
									  <!-- <div class="stats-desc">Better than last week (70.1%)</div> -->
							</div>
						</div>
						<?php endif; ?>
						<div class="col-md-<?php if($level=='obh'){echo "4";}else{echo "3";}?>">
							<div class="widget widget-stats bg-orange text-inverse">
								<div class="stats-icon stats-icon-lg stats-icon-square bg-gradient-purple">
								  <i class="fa fa-file-text"></i>
								</div>
								<div class="stats-desc">Belum Konfirmasi</div>
								<div class="stats-number">
								  <?php
								  if($level=='obh'){
									$this->db->where('notaris',$cek->id_notaris);
								  }
								  echo number_format($this->db->get_where('tbl_laporan', array('status'=>'proses'))->num_rows(),0,",","."); ?>
								</div>
								<div class="stats-progress progress">
									<div class="progress-bar" style="width: 70.1%;"></div>
								</div>
									  <div class="stats-desc">Laporan Belum Diperiksa</div>
							</div>
						</div>
						<div class="col-md-<?php if($level=='obh'){echo "4";}else{echo "3";}?>">
							<div class="widget widget-stats bg-blue text-inverse">
								<div class="stats-icon stats-icon-lg stats-icon-square bg-gradient-purple">
								  <i class="fa fa-spinner"></i>
								</div>
								<div class="stats-desc">Laporan Diperiksa</div>
								<div class="stats-number">
								  <?php
								  if($level=='obh'){
									$this->db->where('notaris',$cek->id_notaris);
								  }
								  echo number_format($this->db->get_where('tbl_laporan', array('status'=>'konfirmasi'))->num_rows(),0,",","."); ?>
								</div>
								<div class="stats-progress progress">
									<div class="progress-bar" style="width: 70.1%;"></div>
								</div>
									  <div class="stats-desc">Laporan Sedang Diperiksa</div>
							</div>
						</div>
						<div class="col-md-<?php if($level=='obh'){echo "4";}else{echo "3";}?>">
							<div class="widget widget-stats bg-green text-inverse">
								<div class="stats-icon stats-icon-lg stats-icon-square bg-gradient-purple">
								  <i class="fa fa-check-square-o"></i>
								</div>
								<div class="stats-desc"> Selesai</div>
								<div class="stats-number">
								  <?php
								  if($level=='obh'){
									$this->db->where('notaris',$cek->id_notaris);
								  }
								  echo number_format($this->db->get_where('tbl_laporan', array('status'=>'selesai'))->num_rows(),0,",","."); ?>
								</div>
								<div class="stats-progress progress">
									<div class="progress-bar" style="width: 70.1%;"></div>
								</div>
									  <div class="stats-desc">Laporan Selesai</div>
							</div>
						</div>
			<?php endif; ?>
		</div>
	</div>
	<!-- DASHBOARD superADMIN -->

	<div class="row">
		  <?php if ($level=='superadmin'): ?>
			<div class="row">
				<?php if ($level!=='user'): ?>
					<div class="col-md-3">
						<div class="widget widget-stats bg-grey text-inverse">
							<div class="stats-icon stats-icon-lg stats-icon-square bg-gradient-yellow">
							  <i class="fa fa-user"></i>
							</div>
							<div class="stats-desc">Masyarakat</div>
							<div class="stats-number">
							  <?php echo number_format($this->db->get_where('tbl_user', array('level'=>'user'))->num_rows(),0,",","."); ?>
							</div>
							<div class="stats-progress progress">
								<div class="progress-bar" style="width: 70.1%;"></div>
							</div>
							<div class="stats-desc">Masyarakat Terdaftar</div>
						</div>
					</div>
					<?php endif; ?>
					<div class="col-md-<?php if($level=='user'){echo "4";}else{echo "3";}?>">
						<div class="widget widget-stats bg-blue text-inverse">
							<div class="stats-icon stats-icon-lg stats-icon-square bg-gradient-yellow">
							  <i class="fa fa-commenting"></i>
							</div>
							<div class="stats-desc">Belum Diperiksa</div>
							<div class="stats-number">
							  <?php
							  if($level=='user'){
								$this->db->where('user',$cek->id_user);
							  }
							  echo number_format($this->db->get_where('tbl_pengaduan', array('status'=>'proses'))->num_rows(),0,",","."); ?>
							</div>
							<div class="stats-progress progress">
								<div class="progress-bar" style="width: 70.1%;"></div>
							</div>
							<div class="stats-desc">Aduan Belum Diperiksa</div>
						</div>
					</div>
					<div class="col-md-<?php if($level=='user'){echo "4";}else{echo "3";}?>">
						<div class="widget widget-stats bg-orange text-inverse">
							<div class="stats-icon stats-icon-lg stats-icon-square bg-gradient-yellow">
							  <i class="fa fa-spinner"></i>
							</div>
							<div class="stats-desc">Ditindak Lanjuti</div>
							<div class="stats-number">
							  <?php
							  if($level=='user'){
								$this->db->where('user',$cek->id_user);
							  }
							  echo number_format($this->db->get_where('tbl_pengaduan', array('status'=>'konfirmasi'))->num_rows(),0,",","."); ?>
							</div>
							<div class="stats-progress progress">
								<div class="progress-bar" style="width: 70.1%;"></div>
							</div>
								  <div class="stats-desc">Aduan Ditindak Lanjuti</div>
						</div>
					</div>
					<div class="col-md-<?php if($level=='user'){echo "4";}else{echo "3";}?>">
						<div class="widget widget-stats bg-green text-inverse">
							<div class="stats-icon stats-icon-lg stats-icon-square bg-gradient-yellow">
							  <i class="fa fa-check-square-o"></i>
							</div>
							<div class="stats-desc">Total Selesai</div>
							<div class="stats-number">
							  <?php
							  if($level=='user'){
								$this->db->where('user',$cek->id_user);
							  }
							  echo number_format($this->db->get_where('tbl_pengaduan', array('status'=>'selesai'))->num_rows(),0,",","."); ?>
							</div>
							<div class="stats-progress progress">
								<div class="progress-bar" style="width: 70.1%;"></div>
							</div>
								   <div class="stats-desc">Pengaduan Masyarakat</div> 
						</div>
					</div>
			</div>
			<!-- DASHBOARD UNTUK ADMIN -->
				<div class="row">
						<div class="col-md-3">
							<div class="widget widget-stats bg-grey text-inverse">
								<div class="stats-icon stats-icon-lg stats-icon-square bg-gradient-purple">
								  <i class="fa fa-user"></i>
								</div>
								<div class="stats-desc">OBH Terdaftar</div>
								<div class="stats-number">
								  <?php echo number_format($this->db->get_where('tbl_user', array('level'=>'obh'))->num_rows(),0,",","."); ?>
								</div>
								<div class="stats-progress progress">
									<div class="progress-bar" style="width: 70.1%;"></div>
								</div>
									  <div class="stats-desc">OBH yang Terdaftar</div>
							</div>
						</div>
						<div class="col-md-<?php if($level=='obh'){echo "4";}else{echo "3";}?>">
							<div class="widget widget-stats bg-blue text-inverse">
								<div class="stats-icon stats-icon-lg stats-icon-square bg-gradient-purple">
								  <i class="fa fa-file-text"></i>
								</div>
								<div class="stats-title">Belum Diperiksa</div>
								<div class="stats-number">
								  <?php
								  if($level=='obh'){
									$this->db->where('notaris',$cek->id_notaris);
								  }
								  echo number_format($this->db->get_where('tbl_laporan', array('status'=>'proses'))->num_rows(),0,",","."); ?>
								</div>
								<div class="stats-progress progress">
									<div class="progress-bar" style="width: 70.1%;"></div>
								</div>
									  <div class="stats-desc">Laporan Belum Diperiksa</div>
							</div>
						</div>
						<div class="col-md-<?php if($level=='obh'){echo "4";}else{echo "3";}?>">
							<div class="widget widget-stats bg-orange text-inverse">
								<div class="stats-icon stats-icon-lg stats-icon-square bg-gradient-purple">
								  <i class="fa fa-spinner"></i>
								</div>
								<div class="stats-desc">Laporan Diperiksa</div>
								<div class="stats-number">
								  <?php
								  if($level=='obh'){
									$this->db->where('notaris',$cek->id_notaris);
								  }
								  echo number_format($this->db->get_where('tbl_laporan', array('status'=>'konfirmasi'))->num_rows(),0,",","."); ?>
								</div>
								<div class="stats-progress progress">
									<div class="progress-bar" style="width: 70.1%;"></div>
								</div>
									  <div class="stats-desc">Laporan yang sedang Diperiksa</div>
							</div>
						</div>
						<div class="col-md-<?php if($level=='obh'){echo "4";}else{echo "3";}?>">
							<div class="widget widget-stats bg-green text-inverse">
								<div class="stats-icon stats-icon-lg stats-icon-square bg-gradient-purple">
								  <i class="fa fa-check-square-o"></i>
								</div>
								<div class="stats-desc">Laporan Selesai</div>
								<div class="stats-number">
								  <?php
								  if($level=='obh'){
									$this->db->where('notaris',$cek->id_notaris);
								  }
								  echo number_format($this->db->get_where('tbl_laporan', array('status'=>'selesai'))->num_rows(),0,",","."); ?>
								</div>
								<div class="stats-progress progress">
									<div class="progress-bar" style="width: 70.1%;"></div>
								</div>
									  <div class="stats-desc">Laporan Telah Diterima</div>
							</div>
						</div>
				</div>
		<?php endif; ?>
	</div>

	<!-- DASHBOARD PETUGAS -->
	<div class="row">
		  <?php if ($level=='petugas'): ?>
			<div class="row">
				<?php if ($level!=='user'): ?>
					<div class="col-md-3">
						<div class="widget widget-stats bg-grey text-inverse">
							<div class="stats-icon stats-icon-lg stats-icon-square bg-gradient-yellow">
							  <i class="fa fa-user"></i>
							</div>
							<div class="stats-desc">Masyarakat</div>
							<div class="stats-number">
							  <?php echo number_format($this->db->get_where('tbl_user', array('level'=>'user'))->num_rows(),0,",","."); ?>
							</div>
							<div class="stats-progress progress">
								<div class="progress-bar" style="width: 70.1%;"></div>
							</div>
							<div class="stats-desc">Masyarakat Telah Terdaftar</div>
						</div>
					</div>
					<?php endif; ?>
					<div class="col-md-<?php if($level=='user'){echo "4";}else{echo "3";}?>">
						<div class="widget widget-stats bg-orange text-inverse">
							<div class="stats-icon stats-icon-lg stats-icon-square bg-gradient-yellow">
							  <i class="fa fa-commenting"></i>
							</div>
							<div class="stats-desc">Belum Diperiksa</div>
							<div class="stats-number">
							  <?php
							  if($level=='user'){
								$this->db->where('user',$cek->id_user);
							  }
							  echo number_format($this->db->get_where('tbl_pengaduan', array('status'=>'proses'))->num_rows(),0,",","."); ?>
							</div>
							<div class="stats-progress progress">
								<div class="progress-bar" style="width: 70.1%;"></div>
							</div>
							<div class="stats-desc">Aduan Belum Diperiksa</div>
						</div>
					</div>
					<div class="col-md-<?php if($level=='user'){echo "4";}else{echo "3";}?>">
						<div class="widget widget-stats bg-blue text-inverse">
							<div class="stats-icon stats-icon-lg stats-icon-square bg-gradient-yellow">
							  <i class="fa fa-spinner"></i>
							</div>
							<div class="stats-desc">Aduan Ditindak Lanjuti</div>
							<div class="stats-number">
							  <?php
							  if($level=='user'){
								$this->db->where('user',$cek->id_user);
							  }
							  echo number_format($this->db->get_where('tbl_pengaduan', array('status'=>'konfirmasi'))->num_rows(),0,",","."); ?>
							</div>
							<div class="stats-progress progress">
								<div class="progress-bar" style="width: 70.1%;"></div>
							</div>
								  <div class="stats-desc">Aduan Sedang Ditindak Lanjuti</div>
						</div>
					</div>
					<div class="col-md-<?php if($level=='user'){echo "4";}else{echo "3";}?>">
						<div class="widget widget-stats bg-green text-inverse">
							<div class="stats-icon stats-icon-lg stats-icon-square bg-gradient-yellow">
							  <i class="fa fa-check-square-o"></i>
							</div>
							<div class="stats-desc">Aduan Selesai</div>
							<div class="stats-number">
							  <?php
							  if($level=='user'){
								$this->db->where('user',$cek->id_user);
							  }
							  echo number_format($this->db->get_where('tbl_pengaduan', array('status'=>'selesai'))->num_rows(),0,",","."); ?>
							</div>
							<div class="stats-progress progress">
								<div class="progress-bar" style="width: 70.1%;"></div>
							</div>
								  <div class="stats-desc">Aduan Masyarakat Telah Selesai</div>
						</div>
					</div>
			</div>
			<!-- DASHBOARD notaris untuk PETUGAS -->
				<div class="row">
						<div class="col-md-3">
							<div class="widget widget-stats bg-grey text-inverse">
								<div class="stats-icon stats-icon-lg stats-icon-square bg-gradient-purple">
								  <i class="fa fa-user"></i>
								</div>
								<div class="stats-desc">OBH Terdaftar</div>
								<div class="stats-number">
								  <?php echo number_format($this->db->get_where('tbl_user', array('level'=>'obh'))->num_rows(),0,",","."); ?>
								</div>
								<div class="stats-progress progress">
									<div class="progress-bar" style="width: 70.1%;"></div>
								</div>
									  <div class="stats-desc">OBH Terdaftar</div>
							</div>
						</div>
						<div class="col-md-<?php if($level=='obh'){echo "4";}else{echo "3";}?>">
							<div class="widget widget-stats bg-orange text-inverse">
								<div class="stats-icon stats-icon-lg stats-icon-square bg-gradient-purple">
								  <i class="fa fa-file-text"></i>
								</div>
								<div class="stats-desc">Laporan Belum Diperiksa</div>
								<div class="stats-number">
								  <?php
								  if($level=='obh'){
									$this->db->where('notaris',$cek->id_notaris);
								  }
								  echo number_format($this->db->get_where('tbl_laporan', array('status'=>'proses'))->num_rows(),0,",","."); ?>
								</div>
								<div class="stats-progress progress">
									<div class="progress-bar" style="width: 70.1%;"></div>
								</div>
									  <div class="stats-desc">Laporan Belum Diperiksa</div>
							</div>
						</div>
						<div class="col-md-<?php if($level=='obh'){echo "4";}else{echo "3";}?>">
							<div class="widget widget-stats bg-blue text-inverse">
								<div class="stats-icon stats-icon-lg stats-icon-square bg-gradient-purple">
								  <i class="fa fa-spinner"></i>
								</div>
								<div class="stats-desc">Laporan Diperiksa</div>
								<div class="stats-number">
								  <?php
								  if($level=='obh'){
									$this->db->where('notaris',$cek->id_notaris);
								  }
								  echo number_format($this->db->get_where('tbl_laporan', array('status'=>'konfirmasi'))->num_rows(),0,",","."); ?>
								</div>
								<div class="stats-progress progress">
									<div class="progress-bar" style="width: 70.1%;"></div>
								</div>
									  <div class="stats-desc">Laporan Sedang Diperiksa</div>
							</div>
						</div>
						<div class="col-md-<?php if($level=='obh'){echo "4";}else{echo "3";}?>">
							<div class="widget widget-stats bg-green text-inverse">
								<div class="stats-icon stats-icon-lg stats-icon-square bg-gradient-purple">
								  <i class="fa fa-check-square-o"></i>
								</div>
								<div class="stats-desc">Laporan Selesai</div>
								<div class="stats-number">
								  <?php
								  if($level=='obh'){
									$this->db->where('notaris',$cek->id_notaris);
								  }
								  echo number_format($this->db->get_where('tbl_laporan', array('status'=>'selesai'))->num_rows(),0,",","."); ?>
								</div>
								<div class="stats-progress progress">
									<div class="progress-bar" style="width: 70.1%;"></div>
								</div>
									  <div class="stats-desc">Laporan Telah Diterima</div>
							</div>
						</div>
				</div>
		<?php endif; ?>
	</div>
</div>
<!-- end #content -->
