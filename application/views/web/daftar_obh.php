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

      <div class="c-content-accordion-1 c-theme">
					<div class="panel-group" id="accordion" role="tablist">
          <?php
            foreach ($kota->result() as $baris):
					?>
						<div class="panel">
							<div class="panel-heading" role="tab" id="heading<?php echo $baris->id_kota; ?>">
								<h4 class="panel-title">
									<a class="c-font-bold c-font-19" data-toggle="collapse" data-parent="#accordion" href="#collapse<?php echo $baris->id_kota; ?>" aria-expanded="true" aria-controls="collapse<?php echo $baris->id_kota; ?>"><?php echo $baris->nama_kota; ?></a>
								</h4>
							</div>
							<div id="collapse<?php echo $baris->id_kota; ?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading<?php echo $baris->id_kota; ?>">
								<div class="panel-body c-font-18">
									Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco.
								</div>
							</div>
						</div>
						<?php endforeach; ?>
						
					</div>
				</div>
			</div>
      <br>
  </div>

</div>
<!-- END: PAGE CONTAINER -->

<script type="text/javascript">
  console.log(<?php print_r($data); ?>);
</script>