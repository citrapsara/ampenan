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
          </div>
        </div>
      </div>
    </div>
  </section>

  <section id="home-content">
    <div class="home-content-title">
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

    <div class="home-content">
      <div class="container-fluid">
        <!-- REALISASI ANGGARAN -->
        <div class="col-md-6"></div>

        <!-- PETA SEBARAN OBH NTB -->
        <div class="col-md-6 peta-sebaran">
          <div id='map'></div>
        </div>

      </div>
    </div>
  </section>


</div>

<script src="assets/web/plugins/leafletjs/leaflet.js"></script>
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

</script>
