<?php
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
	<!-- Dashboard Satker -->
	
		<h1 class="page-header">Dashboard <?php echo ucwords($nama_dipa);?></h1>

		<!-- Chart deviasi RPD dan realisasi anggaran  -->
		<!-- <div class="row">
			<div class="col-md-12">
				<div class="realisasi-card card">
					<div class="card-body">
						<canvas id="line_chart_rpd" ></canvas>
					</div>
				</div>
			</div>
		</div> -->
		<div class="row">
			<div class="col-md-12">
				<div class="realisasi-card card">
					<div class= card-body">
						<h6 class="text-white mt-0">PENYERAPAN ANGGARAN</h6>
						<div class="penyerapan-chart row">
							<div class="col-md-6">
								<canvas id="chart_penyerapan"></canvas>
							</div>
							<div class="col-md-4">
								<div class="dashboard-progress">
									<div class="progress-title">TOTAL PAGU</div>
									<div class="text-white progress-angka"><?php echo $total_pagu_rp; ?></div>
									<div class="progress">
										<div class="progress-bar progress-bar-striped" role="progressbar" style="width: 100%;" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
									</div>
								</div>
								<div class="dashboard-progress">
									<div class="progress-title">REALISASI ANGGARAN</div>
									<div class="text-white progress-angka"><?php echo $total_realisasi_rp; ?></div>
									<div class="progress">
										<div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="<?php echo $persen_realisasi ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $persen_realisasi ?>%">
											<span class="sr-only"></span>
										</div>
										</div>
								</div>
								<div class="dashboard-progress">
									<div class="progress-title">SISA ANGGARAN</div>
									<div class="text-white progress-angka"><?php echo $sisa_anggaran_rp; ?></div>
									<div class="progress">
										<div class="progress-bar progress-bar-danger" role="progressbar" style="width: <?php echo $persen_sisa ?>%;" aria-valuenow="<?php echo $persen_sisa ?>" aria-valuemin="0" aria-valuemax="100"></div>
									</div>

								</div>
								</div>
							<div class="col-md-2">
							</div>
						</div>
						<hr>
						<div class="row">
							<div class="col-md-4">
								<div class="dashboard-progress">
									<div class="progress-title">TOTAL BELANJA PEGAWAI</div>
									<div class="text-white progress-angka"><?php echo $realisasi_bp_rp; ?></div>
									<div class="progress">
										<div class="progress-bar progress-bar-bp" role="progressbar" style="width: 100%;" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
									</div>
								</div>
							</div>
							<div class="col-md-4">
								<div class="dashboard-progress">
									<div class="progress-title">TOTAL BELANJA BARANG</div>
									<div class="text-white progress-angka"><?php echo $realisasi_bb_rp; ?></div>
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
									<div class="text-white progress-angka"><?php echo $realisasi_bm_rp; ?></div>
									<div class="progress">
										<div class="progress-bar progress-bar-bm" role="progressbar" style="width: 100%;" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
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
<!-- end #content -->

<!-- <script src="assets/panel/plugins/chart-js/Chart.min.js"></script> -->
<script src="https://cdn.jsdelivr.net/npm/chart.js@2.7.3/dist/Chart.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@0.7.0"></script>
<script>
const total_realisasi = <?php echo $total_realisasi; ?>;
const sisa_anggaran = <?php echo $sisa_anggaran; ?>;

const ctx = document.getElementById('chart_penyerapan').getContext('2d');

var options = {
           tooltips: {
         enabled: true
    },
             plugins: {
            datalabels: {
                formatter: (value, ctx) => {
                
                  let sum = 0;
                  let dataArr = ctx.chart.data.datasets[0].data;
                  dataArr.map(data => {
                      sum += data;
                  });
                  let percentage = (value*100 / sum).toFixed(2)+"%";
				  if(percentage == "0.00%"){ percentage = "";}
                  return percentage;

              
                },
                color: '#fff',
                     }
        }
    };

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
//     options: {
// 		plugins: {
// 			labels: {
// 				render: 'label'
// 			}
// }
//     }
	options: options
});



</script>

<script>
let data_realisasi_pegawai = [4200000,7200000,6500000,6900000,2100000,6000000,2700000,110000,7400000,3100000,6600000,13000000];
let data_rpd_pegawai = [3100000,10200000,5300000,11400000,1500000,8600000,2700000,10800000,3900000,10100000,5200000,11300000];
let data_deviasi_pegawai = [];
data_realisasi_pegawai.forEach((val, key)=>{
	data_deviasi_pegawai[key] = data_realisasi_pegawai[key] - data_rpd_pegawai[key];
});

const data = {
  labels: ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'],
  datasets: [
    {
      label: 'Data Realisasi',
      fill: false,
      backgroundColor: 'cyan',
      borderColor: 'cyan',
      data: data_realisasi_pegawai
	//   ,fill: '+1'
    }, {
      label: 'Data RPD',
      fill: false,
      backgroundColor: 'cyan',
      borderColor: 'cyan',
      borderDash: [5, 7],
      data: data_rpd_pegawai
	//   fill: '0'
    }
    , {
      label: 'Deviasi',
      fill: false,
      backgroundColor: 'lime',
      borderColor: 'lime',
    //   borderDash: [5, 7],
      data: data_deviasi_pegawai,
	  datalabels:{
		  display: true
	  }
    }
	// , {
    //   label: 'Filled',
    //   backgroundColor: 'red',
    //   borderColor: 'red',
    //   data: [9,1,7,2,5,10,3,11],
    //   fill: true,
    // }
  ]
};



  var ctxrpd = document.getElementById('line_chart_rpd').getContext('2d');
  var line_chart_penyerapan = new Chart(ctxrpd, {
	type: 'line',
	data: data,
	options: {
		legend: {
            display: true,
            labels: {
                fontColor: 'white'
				// ,padding: 100
            }
			// ,position: 'bottom'
        },
		layout: {
            padding: {
                left: 0,
                right: 100,
                top: 0,
                bottom: 0
            }
        },
			
		responsive: true,
		plugins: {
			title: {
				display: false,
				text: 'Chart.js Line Chart'
			},
		},
		// interaction: {
		// mode: 'index',
		// intersect: false
		// },
		scales: {
			yAxes: [{
				display: true,
				ticks: {
					// beginAtZero: true,
					// max: 100,
					// min: 0
					fontColor: 'white',
					padding: 100
				}
			}],
			xAxes: [{
                  ticks: {
                      autoSkip: false,
                    //   maxRotation: 90,
                    //   minRotation: 90,
					//   padding: 20,
					  fontColor: 'white'
                  }
              }
			  ]
		}
		// ,plugins: {
		// 	datalabels: {
		// 		display: false
		// 	}
		// }
		,plugins: {
			datalabels: {
				anchor: 'end',
				align: 'bottom',
				formatter: (value, ctx) => {
					return 'Rp ' +  (value).toLocaleString().replace(/,/g,".");//toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,');
				},
				color: 'white',
				display: false
			}
		}
	}
  });

</script>