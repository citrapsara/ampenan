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
						<canvas id="line_chart_rpd" ></canvas>
					</div>
				</div>
			</div>
		</div>
		<h1 class="page-header">Dashboard</h1>
		<div class="row">
			<div class="col-md-12">
				<div class="realisasi-card card">
					<div class="card-body">
						<canvas id="bar_chart_realisasi_satker" height="220"></canvas>
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

<!-- <script src="assets/panel/plugins/chart-js/Chart.min.js"></script> -->
<script src="https://cdn.jsdelivr.net/npm/chart.js@2.7.3/dist/Chart.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@0.7.0"></script>
<!-- <script src="https://github.com/chartjs/Chart.js/blob/master/docs/scripts/utils.js"></script> -->
<script>
var dipa_id = <?php echo json_encode($dipa_id);  ?>;
const realisasi_satker_total = <?php echo json_encode($realisasi_satker_total); ?>;
const sisa_satker = <?php echo json_encode($sisa_satker_pie_chart); ?>;

dipa_id.forEach(myFunction);

function myFunction(value, key) {
//   text += index + ": " + item + "<br>"; 
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
	  options: options
// 	  options: {
// 		  plugins: {
// 	labels: {
// 	  render: 'label'
// 	}
//   }
// 	  }
  });
}
</script>

<script>

// const labels = [
//   'January',
//   'February',
//   'March',
//   'April',
//   'May',
//   'June',
//   'juli',
//   'agustus'
// ];
// console.log(labels);
// const data = {
//   labels: labels,
//   datasets: [{
//     label: 'Realisasi',
//     backgroundColor: 'rgb(255, 99, 132)',
//     borderColor: 'rgb(255, 99, 132)',
//     data: [55, 10, 5, 2, 20, 30, 45,1,2,3,4,5],
//   }]
// };
// const config = {
//   type: 'bar',
//   data: data,
//   options: {}
// };

// const myChart = new Chart(
//     document.getElementById('bar_chart_realisasi_satker').getContext('2d')	,
//     config
//   );
</script>

<script>
var dipa_list = <?php echo json_encode($dipa_list);  ?>;
var nama_dipa = [];
var persen_realisasi = [];

dipa_list.forEach(fungsi);
function fungsi(val, key){
	if(key > 0){
		nama_dipa[key-1] = val.nama;
		let realisasi = realisasi_satker_total[val.id];
		let sisa = sisa_satker[val.id];

		persen_realisasi[key-1] = (Math.round(((realisasi / (realisasi + sisa)) * 100) * 100) / 100).toFixed(2)
	}
	
}
// console.log(realisasi_satker_total);
// console.log(sisa_satker);
// console.log(persen_realisasi);
const labels = nama_dipa;
const ctx = document.getElementById('bar_chart_realisasi_satker');
const myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: nama_dipa,
        datasets: [{
            label: 'Penyerapan Anggaran (%)',
            data: persen_realisasi,//[100,2,4,5,6,7,8,9,10,11,12,13,14,5.5,16,17,18,19,20,21,22,23,24,25], //[100.0,75.6,87.8,100.0,91.6,84.9,74.4,86.2,71.7,86.8,83.0,78.5,75.9,85.5,91.6,89.5,94.9,84.0,64.7,90.3,67.9,90.2,80.8,88.4,92.3]
            backgroundColor: 'rgba(54, 162, 235, 0.2)',
            borderColor: 'rgba(54, 162, 235, 1)',
            borderWidth: 1
        }]
    },
    options: {
		legend: {
             labels: {
                  fontColor: 'white'
                 }
              },
        scales: {
			yAxes: [{
				display: true,
				ticks: {
					// beginAtZero: true,
					max: 100,
					// min: 0
					fontColor: 'white'
				}
			}],
            // y: {
            //     beginAtZero: true
            // },
			xAxes: [{
                  ticks: {
                      autoSkip: false,
                      maxRotation: 90,
                      minRotation: 90,
					  padding: 20,
					  fontColor: 'white'
                  }
              }]
        }
		,plugins: {
            datalabels: {
				anchor: 'end',
        		align: 'top',
                formatter: (value, ctx) => {
                return value;
                //   let sum = 0;
                //   let dataArr = ctx.chart.data.datasets[0].data;
                //   dataArr.map(data => {
                //       sum += data;
                //   });
				  
                //   let percentage = (value*100 / sum).toFixed(2)+"%";
				//   if(percentage == "0.00%"){ percentage = "";}
                //   return percentage;

              
                },
                color: 'cyan',
                     }
        }
    },
	// onAnimationComplete: function () {
	// 	var ctx = this.chart.ctx;
	// 	ctx.font = this.scale.font;
	// 	ctx.fillStyle = this.scale.textColor
	// 	ctx.textAlign = "center";
	// 	ctx.textBaseline = "bottom";

	// 	this.datasets.forEach(function (dataset) {
	// 		dataset.bars.forEach(function (bar) {
	// 			ctx.fillText(bar.value, bar.x, bar.y );
	// 		});
	// 	})
	// }
});

</script>


<script>
// var dipa_id = <?php echo json_encode($dipa_id);  ?>;
// const realisasi_satker_total = <?php echo json_encode($realisasi_satker_total); ?>;
// const sisa_satker = <?php echo json_encode($sisa_satker_pie_chart); ?>;

// const labelsrpd = Utils.months({count: DATA_COUNT});

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
  var chart_penyerapan = new Chart(ctxrpd, {
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