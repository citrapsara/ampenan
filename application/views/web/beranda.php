<div class="c-layout-page">
  <!-- BEGIN: PAGE CONTENT -->

  <!-- BANNER -->
  <section id="banner">
    <div class="banner">
      <div class="container">
        <div class="row">
          <div class="col-md-8 banner-text">
            <img class="img-banner img-fluid" src="img/banner/kakanwil.png" alt="image home banner">
            <h3 class="web-title">E-MANDALIKA</h3>
            <h4 class="title-content">Monitoring Dan Pengawasan</br>Akses Layanan Informasi Bantuan Hukum Cuma-Cuma</h4>
            <div class="banner-btn-group">
              <a href="pengaduan" class="btn btn-banner">Buat Pengaduan</a>
              <a href="daftarobh" class="btn btn-banner">Daftar OBH</a>
            </div>
          </div>
          <div class="col-md-4">
            <img class="img-fluid img-pengayoman-banner" src="img/banner/pengayoman.png" alt="image logo pengayoman">
          </div>
        </div>
      </div>
    </div>
  </section>

  <section id="home-content">
    <div class="home-content-title home-content-title-1">
      <div class="container">
        <div class="row">

          <!-- REALISASI ANGGARAN -->
          <div class="col-md-6">
            <h3 class="title-realisasi-anggaran">Realisasi Anggaran</h3>
          </div>

          <!-- PETA SEBARAN OBH NTB -->
          <div class="col-md-6">
            <h3 class="title-peta-sebaran">Peta Sebaran OBH</h3>
          </div>
        </div>
      </div>
    </div>

    <div class="home-content home-content-1">
      <div class="container-fluid">
        <!-- REALISASI ANGGARAN -->
        <div class="col-md-6 realisasi-anggaran">
          <div class="chart-anggaran">
            <canvas id="myChart" width="300" height="300"></canvas>
          </div>
          <div class="current-anggaran">
            <h4 class="text-center">Realisasi Anggaran OBH Seluruh Indonesia</h4>
            <div class="row">
              <div class="col-md-4">
                  <div class="info-anggaran total-anggaran text-center">
                      <span class="info-title">Total Anggaran</span><br>
                      <span class="info-number" id="total_anggaran"></span>
                  </div>
              </div>
              <div class="col-md-4">
                  <div class="info-anggaran penyerapan-anggaran text-center">
                      <span class="info-title">Penyerapan Anggaran</span><br>
                      <span class="info-number" id="penyerapan_anggaran"></span>
                  </div>
              </div>
              <div class="col-md-4">
                  <div class="info-anggaran sisa-anggaran text-center">
                      <span class="info-title">Sisa Anggaran</span><br>
                      <span class="info-number" id="sisa_anggaran"></span>
                  </div>
              </div>
            
            </div>
          </div>
        </div>

        <!-- PETA SEBARAN OBH NTB -->
        <div class="col-md-6 peta-sebaran">
          <div id='map'></div>
        </div>

      </div>
    </div>

    <div class="home-content-title home-content-title-2">
      <div class="container">
        <div class="row">
          <!-- PERATURAN TERKAIT -->
          <div class="col-md-12">
            <h3 class="text-center">Peraturan Terkait</h3>
          </div>
        </div>
      </div>
    </div>

    <div class="home-content home-content-2">
      <div class="container">
        <!-- REALISASI ANGGARAN -->
        <div class="col-md-12">
        <style>
                      #bg-white{color:#fff;}
                    </style>

                    <div class="table-responsive table-home">
                      <table id="myTable" class="table table-bordered table-striped">
                        <thead>
                          <tr style="background:gray;">
                            <th id="bg-white" width="2%">N0.</th>
                            <th id="bg-white" width="78%">PERATURAN</th>
                            <th id="bg-white" width="20%" class="text-center">DETAIL</th>
                            
                          </tr>
                        </thead>
                        <tbody>
                          <?php
                            $no=1;
                            foreach ($query->result() as $value):
                          ?>
                            <tr>
                              <td><b><?php echo $no++; ?>.</b></td>
                              <td><?php echo $value->name_file; ?></td>
                              <td class="text-center"><a href="<?php echo $value->dir_file; ?>" class="btn btn-primary btn-sm" target="_blank" >Lihat</a></td>
                              
                              
                            </tr>
                          <?php endforeach; ?>
                        </tbody>
                      </table>
                    </div>
        </div>

        <!-- PETA SEBARAN OBH NTB -->
        <div class="col-md-6 peta-sebaran">
          <div id='map'></div>
        </div>

      </div>
    </div>
  </section>


</div>

<script src="assets/web/plugins/leafletjs/leaflet.js"></script>
<script src="assets/panel/plugins/chart-js/Chart.min.js"></script>
<script type="text/javascript">
// --- Leaflet untuk peta sebaran OBH ---
var locations = [
  <?php 
    foreach ($query->result() as $baris) {
      if (!empty($baris->latitude) && !empty($baris->longitude)) {
        echo '["'.$baris->nama.'", '.$baris->latitude.', '.$baris->longitude.'],';
      }
    }  
  ?>
];

var map = L.map('map', {
    scrollWheelZoom: false
}).setView([-8.615086468066592, 117.38529098263584], 8);
mapLink =
  '<a href="http://openstreetmap.org">OpenStreetMap</a>';
L.tileLayer(
  'http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '&copy; ' + mapLink + ' Contributors',
    maxZoom: 18,
  }).addTo(map);
  map.on('click', function() {
  if (map.scrollWheelZoom.enabled()) {
    map.scrollWheelZoom.disable();
    }
    else {
    map.scrollWheelZoom.enable();
    }
  });
for (var i = 0; i < locations.length; i++) {
  marker = new L.marker([locations[i][1], locations[i][2]])
    .bindPopup(locations[i][0])
    .addTo(map);
}

// --- Pie Chart Realisasi Anggaran ---
var ctx = document.getElementById('myChart').getContext('2d');

var myChart = new Chart(ctx, {
    type: 'pie',
    data: {
        labels: ['Penyerapan Anggaran', 'Sisa Anggaran'],
        datasets: [{
            label: '# of Votes',
            data: [<?php echo $chart->penyerapan_anggaran; ?>, <?php echo $chart->total_anggaran - $chart->penyerapan_anggaran; ?>],
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)'
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)'
            ],
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            y: {
                beginAtZero: true
            }
        },
        responsive: true,
            maintainAspectRatio: false
    }
});

// Data Anggaran
var total_anggaran = <?php echo $chart->total_anggaran; ?>;
var penyerapan_anggaran = <?php echo $chart->penyerapan_anggaran; ?>;
var sisa_anggaran = <?php echo $chart->total_anggaran - $chart->penyerapan_anggaran; ?>;

function pisah_ribuan(bilangan) {
    var	reverse = bilangan.toString().split('').reverse().join(''),
    ribuan 	= reverse.match(/\d{1,3}/g);
    ribuan	= ribuan.join('.').split('').reverse().join('');
    return ribuan;
}

document.getElementById("total_anggaran").innerHTML = 'Rp ' + pisah_ribuan(total_anggaran);
document.getElementById("penyerapan_anggaran").innerHTML = 'Rp ' + pisah_ribuan(penyerapan_anggaran);
document.getElementById("sisa_anggaran").innerHTML = 'Rp ' + pisah_ribuan(sisa_anggaran);


</script>
