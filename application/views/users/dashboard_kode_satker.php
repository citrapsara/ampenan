<?php
$cek    = $user->row();
$level  = $this->session->userdata('level');
$id_dipa = $this->session->userdata('id_dipa');
?>
<!-- begin #content -->
<div id="content" class="content dashboard">
	<!-- begin breadcrumb -->
	<ol class="breadcrumb pull-right">
	  <li class="active">Dashboard</li>
	</ol>
	<!-- end breadcrumb -->
	<!-- begin page-header -->
	<!-- Dashboard Superadmin dan Koordinator Wilayah -->
	<?php if ($id_dipa == '00') { ?>
		<h1 class="page-header">Dashboard</h1>
		<div class="row">
			<div class="col-md-12">
				<div class="realisasi-card card">
					<div class="card-body">
						<!-- <canvas id="bar-chart-realisasi-satker"></canvas> -->
					</div>
				</div>
			</div>
		</div>
		<?php foreach($dipa_list as $key): 
			if($key['id'] == '00') continue;?>
			<div class="row">
				<div class="col-md-12">
					<div class="realisasi-card card">
						<div class= card-body">
							<h6 class="text-white mt-0">PENYERAPAN ANGGARAN <?php echo strtoupper($key['nama']); ?></h6>
							<div class="penyerapan-chart row">
								<div class="col-md-7">
									<canvas id="chart_penyerapan<?php echo $key['id']; ?>"></canvas>
								</div>
								<div class="col-md-5">
									<!-- <img class="" src="img/img-1.svg" alt="image realisasi"> -->
									<div class="progress-title">TOTAL BELANJA PEGAWAI</div>
									<div class="text-white progress-angka"><?php 
										if ($realisasi_satker_bp_rp[$key['id']] != null) {
											echo $realisasi_satker_bp_rp[$key['id']];
										} else {
											echo 'Rp 0';
										}
									 ?></div>
									<hr>
									<div class="progress-title">TOTAL BELANJA BARANG</div>
									<div class="text-white progress-angka"><?php 
										if ($realisasi_satker_bb_rp[$key['id']] != null) {
											echo $realisasi_satker_bb_rp[$key['id']];
										} else {
											echo 'Rp 0';
										}
									 ?></div>
									<hr>
									<div class="progress-title">TOTAL BELANJA MODAL</div>
									<div class="text-white progress-angka"><?php 
										if ($realisasi_satker_bm_rp[$key['id']] != null) {
											echo $realisasi_satker_bm_rp[$key['id']]; 
										} else {
											echo 'Rp 0';
										}
									?></div>
								</div>
							</div>
							<hr>
							<div class="row">
								<div class="col-md-4">
									<div class="dashboard-progress">
										<div class="progress-title">TOTAL PAGU</div>
										<div class="text-white progress-angka"><?php 
											echo $pagu_satker_rp[$key['id']]; 
										?></div>
										<div class="progress">
											<div class="progress-bar progress-bar-striped" role="progressbar" style="width: 100%;" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
										</div>
									</div>
								</div>
								<div class="col-md-4">
									<div class="dashboard-progress">
										<div class="progress-title">REALISASI ANGGARAN</div>
										<div class="text-white progress-angka"><?php 
											echo $realisasi_satker_total_rp[$key['id']];
										?></div>
										<div class="progress">
											<div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="<?php echo $realisasi_satker_persen[$key['id']] ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $realisasi_satker_persen[$key['id']] ?>%">
												<span class="sr-only"></span>
											</div>
											</div>
									</div>
								</div>
								<div class="col-md-4">
									<div class="dashboard-progress">
										<div class="progress-title">SISA ANGGARAN</div>
										<div class="text-white progress-angka"><?php echo $sisa_satker_rp[$key['id']]; ?></div>
										<div class="progress">
											<div class="progress-bar progress-bar-danger" role="progressbar" style="width: <?php echo $sisa_satker_persen[$key['id']]; ?>%;" aria-valuenow="<?php echo $sisa_satker_persen[$key['id']]; ?>" aria-valuemin="0" aria-valuemax="100"></div>
										</div>

									</div>
								</div>						
							</div>
						</div>
					</div>
				</div>
				<!-- <div class="col-md-4">
					<div class="realisasi-card card">
						<div class="card-body">
							<canvas id="chart_belanja"></canvas>
						</div>
					</div>
				</div> -->
			</div>
		<?php endforeach; ?>
		
	<?php } else { ?> 
		<h1 class="page-header">Dashboard <?php echo ucwords($nama_dipa);?></h1>

		<div class="row">
			<div class="col-md-12">
				<div class="realisasi-card card">
					<div class= card-body">
						<h6 class="text-white mt-0">PENYERAPAN ANGGARAN</h6>
						<div class="penyerapan-chart row">
							<div class="col-md-7">
								<canvas id="chart_penyerapan"></canvas>
							</div>
							<div class="col-md-5">
								<div class="progress-title">TOTAL BELANJA PEGAWAI</div>
								<div class="text-white progress-angka"><?php echo $realisasi_bp_rp; ?></div>
								<hr>
								<div class="progress-title">TOTAL BELANJA BARANG</div>
								<div class="text-white progress-angka"><?php echo $realisasi_bb_rp; ?></div>
								<hr>
								<div class="progress-title">TOTAL BELANJA MODAL</div>
								<div class="text-white progress-angka"><?php echo $realisasi_bm_rp; ?></div>
							</div>
							<!-- <div class="col-md-3">
								<img class="" src="img/img-1.svg" alt="image realisasi">
							</div> -->
						</div>
						<hr>
						<div class="row">
							<div class="col-md-4">
								<div class="dashboard-progress">
									<div class="progress-title">TOTAL PAGU</div>
									<div class="text-white progress-angka"><?php echo $total_pagu_rp; ?></div>
									<div class="progress">
										<div class="progress-bar progress-bar-striped" role="progressbar" style="width: 100%;" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
									</div>
								</div>
							</div>
							<div class="col-md-4">
								<div class="dashboard-progress">
									<div class="progress-title">REALISASI ANGGARAN</div>
									<div class="text-white progress-angka"><?php echo $total_realisasi_rp; ?></div>
									<div class="progress">
										<div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="<?php echo $persen_realisasi ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $persen_realisasi ?>%">
											<span class="sr-only"></span>
										</div>
										</div>
								</div>
							</div>
							<div class="col-md-4">
								<div class="dashboard-progress">
									<div class="progress-title">SISA ANGGARAN</div>
									<div class="text-white progress-angka"><?php echo $sisa_anggaran_rp; ?></div>
									<div class="progress">
										<div class="progress-bar progress-bar-danger" role="progressbar" style="width: <?php echo $persen_sisa ?>%;" aria-valuenow="<?php echo $persen_sisa ?>" aria-valuemin="0" aria-valuemax="100"></div>
									</div>

								</div>
							</div>						
						</div>
					</div>
				</div>
			</div>			
			<!-- <div class="col-md-4">
				<div class="realisasi-card card">
					<div class="card-body">
						<canvas id="chart_belanja"></canvas>
					</div>
				</div>
			</div> -->
		</div>
	<?php } ?>
	<!-- <?php echo '<pre>'; print_r($dipa_list); echo '</pre>';?> -->
</div>
<!-- end #content -->

<script src="assets/panel/plugins/chart-js/Chart.min.js"></script>
<script>
const total_realisasi = <?php echo $total_realisasi; ?>;
const sisa_anggaran = <?php echo $sisa_anggaran; ?>;

const ctx = document.getElementById('chart_penyerapan').getContext('2d');

const chart_penyerapan = new Chart(ctx, {
    type: 'pie',
    data: {
        labels: ['Penyerapan Anggaran', 'Sisa Anggaran'],
        datasets: [{
            // label: '# of Votes',
            data: [total_realisasi, sisa_anggaran],
            backgroundColor: [
                'rgba(0, 172, 172, 1)',
                'rgba(234, 66, 114, 1)'
            ],
            borderColor: [
                'rgba(45, 53, 60, 1)',
				'rgba(45, 53, 60, 1)'
            ],
            borderWidth: 5
        }]
    },
    options: {
		plugins: {
  labels: {
    render: 'label'
  }
}
    }
});



</script>