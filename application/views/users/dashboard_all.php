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
		

		<div class="c-content-accordion-1 c-theme dashboard-all">
			<div class="panel-group" id="accordion" role="tablist">
         	<?php
					$isFirst = true;
					foreach ($dipa_list as $key): 
					if($key['id'] == '00') continue;
					?>
						<div class="panel">
							<div class="panel-heading dipa-accordion-btn" role="tab" id="heading<?php echo $key['id']; ?>">
								<h4 class="panel-title">
									<a class="c-font-bold c-font-19"  data-toggle="collapse" data-parent="#accordion" href="#collapse<?php echo $key['id']; ?>" aria-expanded="true" aria-controls="collapse<?php echo $key['id']; ?>">PENYERAPAN ANGGARAN <?php echo strtoupper($key['nama']); ?></a>
								</h4>
							</div>
							<div id="collapse<?php echo $key['id']; ?>" class="panel-collapse collapse <?php if ($isFirst) {
								echo "in";
							} ?>" role="tabpanel" aria-labelledby="heading<?php echo $key['id']; ?>">
								<div class="panel-body c-font-18">
									<div class="row">
							<div class="col-md-12">
								<div class="realisasi-card card">
									<div class= card-body">
										<!-- <h6 class="text-white mt-0">PENYERAPAN ANGGARAN <?php echo strtoupper($key['nama']); ?></h6> -->
										<div class="penyerapan-chart row">
											<div class="col-md-6">
												<canvas id="chart_penyerapan<?php echo $key['id']; ?>"></canvas>
											</div>
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
												<div class="dashboard-progress">
													<div class="progress-title">SISA ANGGARAN</div>
													<div class="text-white progress-angka"><?php echo $sisa_satker_rp[$key['id']]; ?></div>
													<div class="progress">
														<div class="progress-bar progress-bar-danger" role="progressbar" style="width: <?php echo $sisa_satker_persen[$key['id']]; ?>%;" aria-valuenow="<?php echo $sisa_satker_persen[$key['id']]; ?>" aria-valuemin="0" aria-valuemax="100"></div>
													</div>
												</div>
											</div>
											<div class="col-md-2"></div>
										</div>
										<hr>
										<div class="row">
											<div class="col-md-4">
												<div class="dashboard-progress">
													<div class="progress-title">TOTAL BELANJA PEGAWAI</div>
													<div class="text-white progress-angka"><?php 
													if ($realisasi_satker_bp_rp[$key['id']] != null) {
														echo $realisasi_satker_bp_rp[$key['id']];
													} else {
														echo 'Rp 0';
													}
												 ?></div>
													<div class="progress">
														<div class="progress-bar progress-bar-bp" role="progressbar" style="width: 100%;" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
													</div>
												</div>
											</div>
											<div class="col-md-4">
												<div class="dashboard-progress">
													<div class="progress-title">TOTAL BELANJA BARANG</div>
													<div class="text-white progress-angka"><?php 
													if ($realisasi_satker_bb_rp[$key['id']] != null) {
														echo $realisasi_satker_bb_rp[$key['id']];
													} else {
														echo 'Rp 0';
													}
												 ?></div>
													<div class="progress">
														<div class="progress-bar progress-bar-bb" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%">
															<span class="sr-only"></span>
														</div>
														</div>
												</div>
											</div>
											<div class="col-md-4">
												<div class="dashboard-progress">
													<div class="progress-title">TOTAL BELANJA MODAL</div>
													<div class="text-white progress-angka"><?php 
														if ($realisasi_satker_bm_rp[$key['id']] != null) {
															echo $realisasi_satker_bm_rp[$key['id']]; 
														} else {
															echo 'Rp 0';
														}
													?></div>
													<div class="progress">
														<div class="progress-bar progress-bar-bm" role="progressbar" style="width: 100%;" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
													</div>
			
												</div>
											</div>						
										</div>
									</div>
								</div>
							</div>
						</div>
								</div>
							</div>
						</div>
					<?php 
						$isFirst = false;
						endforeach; ?>
			</div>
		</div>
		
	
		</div>
</div>
<!-- end #content -->

<script src="assets/panel/plugins/chart-js/Chart.min.js"></script>
<script>
var dipa_id = <?php echo json_encode($dipa_id);  ?>;
const realisasi_satker_total = <?php echo json_encode($realisasi_satker_total); ?>;
const sisa_satker = <?php echo json_encode($sisa_satker_pie_chart); ?>;

dipa_id.forEach(myFunction);

function myFunction(value, key) {
//   text += index + ": " + item + "<br>"; 
  var ctx = document.getElementById('chart_penyerapan' + value).getContext('2d');
  var chart_penyerapan = new Chart(ctx, {
	  type: 'pie',
	  data: {
		  labels: ['Penyerapan Anggaran', 'Sisa Anggaran'],
		  datasets: [{
			  // label: '# of Votes',
			  data: [realisasi_satker_total[value], sisa_satker[value]],
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
}





</script>