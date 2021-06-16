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
         <h1 align="center" class="text-uppercase"><b>Profil <?php echo $query->nama_singkat; ?></b></h1>
         <hr>

         <br>

         <?php
                $foto = "img/user/user-default.jpg";
                $foto_k = $query->foto_obh;
              	if ($foto_k!='') {
              		if(file_exists("$foto_k")){
              			$foto = $foto_k;
              		}
              	}
                ?>

         <div class="col-md-4 wow animate slideInUp img-obh" style="visibility: visible; animation-name: slideInUp; opacity: 1;">
            <center><img src="<?php echo $foto; ?>" alt="iamge obh"></center>
         </div>
         <div class="col-md-8">
            <ul class="ul-detail-obh">
               <li class="wow animate fadeInUp" style="visibility: visible; animation-name: fadeInUp; opacity: 1;">
                  <h4>Nama OBH</h4>
                  <p><?php echo $query->nama; ?></p>
                </li>
               <li class="wow animate fadeInUp" style="visibility: visible; animation-name: fadeInUp; opacity: 1;">
                  <h4>Nama Singkat</h4>
                  <p><?php echo $query->nama_singkat; ?></p>
                </li>
                <li class="wow animate fadeInUp" style="visibility: visible; animation-name: fadeInUp; opacity: 1;">
                  <h4>Tanggal Berdiri</h4>
                  <p><?php echo $this->Mcrud->tgl_id(date('d-m-Y', strtotime($query->tgl_berdiri)),'full'); ?></p>
                </li>
                <li class="wow animate fadeInUp" style="visibility: visible; animation-name: fadeInUp; opacity: 1;">
                  <h4>Status Badan Hukum</h4>
                  <p><?php echo $query->status_obh; ?></p>
                </li>
                <li class="wow animate fadeInUp" style="visibility: visible; animation-name: fadeInUp; opacity: 1;">
                  <h4>Akta OBH</h4>
                  <p><?php echo $query->akta_obh; ?></p>
                </li>
               <li class="wow animate fadeInUp" style="visibility: visible; animation-name: fadeInUp; opacity: 1;">
                  <h4>Nomor SK AHU</h4>
                  <p><?php echo $query->no_sk; ?></p>
                </li>
                <li class="wow animate fadeInUp" style="visibility: visible; animation-name: fadeInUp; opacity: 1;">
                  <h4>Akreditasi</h4>
                  <p><?php echo $query->akreditasi_obh; ?></p>
                </li>
               <li class="wow animate fadeInUp" style="visibility: visible; animation-name: fadeInUp; opacity: 1;">
                  <h4>Kota / Kabupaten</h4>
                  <p><?php echo $query->kota; ?></p>
                </li>
               <li class="wow animate fadeInUp" style="visibility: visible; animation-name: fadeInUp; opacity: 1;">
                  <h4>Alamat</h4>
                  <p><?php echo $query->alamat_notaris; ?></p>
                </li>
               <li class="wow animate fadeInUp" style="visibility: visible; animation-name: fadeInUp; opacity: 1;">
                  <h4>Nomor Telepon</h4>
                  <p><?php echo $query->telpon; ?></p>
                </li>
               <li class="wow animate fadeInUp" style="visibility: visible; animation-name: fadeInUp; opacity: 1;">
                  <h4>Email</h4>
                  <p><?php echo $query->email_notaris; ?></p>
                </li>
            </ul>
         </div>
         <div class="col-md-12 wow animate slideInUp peta-sebaran" style="visibility: visible; animation-name: slideInUp; opacity: 1;">
             <div id='map'></div>
           </div>
		</div>
      
  </div>
  

</div>
<!-- END: PAGE CONTAINER -->

<script src="assets/web/plugins/leafletjs/leaflet.js"></script>
<script type="text/javascript">
// --- Leaflet untuk peta sebaran OBH ---
var locations = [
  <?php 
    echo '["'.$query->nama.'", '.$query->latitude.', '.$query->longitude.']';  
  ?>
];

var map = L.map('map', {
    scrollWheelZoom: false
}).setView([
   <?php
      echo ''.$query->latitude.', '.$query->longitude.'';
   ?>
   ], 17);
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