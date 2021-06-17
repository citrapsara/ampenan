<!-- BEGIN: PAGE CONTAINER -->
<div class="c-layout-page">
	<!-- BEGIN: LAYOUT/BREADCRUMBS/BREADCRUMBS-2 -->
	<div class="c-layout-breadcrumbs-1 c-subtitle c-fonts-uppercase c-fonts-bold c-bordered c-bordered-both">
		<div class="container">
			<div class="c-page-title c-pull-left">
				<h3 class="c-font-uppercase c-font-sbold">Tracking Pengaduan</h3>
			</div>
		</div>
	</div>
	<style>
		#c_ktp{
			font-size: 20px;
			height: 50px;
			padding: 10px;
			text-align: center;
			border-bottom-left-radius:0px;border-bottom-right-radius:0px;
		}
		#btn-cek{
			width:100%;border-top-left-radius:0px;border-top-right-radius:0px;
		}
	</style>
	<div class="c-content-box c-size-md c-bg-grey">
		<div class="container">
			<center>
					<!-- <div class="panel-heading">Silahkan Masukkan Nomor KTP Anda.</div> -->
				<input type="text" name="nik_pelapor" required="required" class="form-control" id="c_ktp" value="<?php echo $nik_pelapor; ?>" placeholder="Silahkan Masukkan Nomor KTP Anda..." autofocus onfocus="this.value=this.value" onkeypress="return hanyaAngka(event);" onkeydown="if(event.key==='Enter'){link();}">
				<button class="btn btn-primary btn-lg" id="btn-cek" onclick="link();">C E K</button>
			</center>

			<?php if ($nik_pelapor!=''): ?>
				<br>
				<style>
					#bg-white{color:#fff;}
				</style>
				<div class="row">
					<div class="col-md-12">
						<div class="panel-body">
							<div class="panel panel-primary">
								<div class="panel-heading"> <b>Pengaduan Yang Pernah Anda Adukan</b> </div>
									<table class="table table-bordered table-striped">
										<thead>
											<tr style="background:gray;">
												<th id="bg-white" width="1">No.</th>
												<th id="bg-white">PENGADUAN</th>
												<th id="bg-white" width="210">TANGGAL LAPORAN</th>
												<th id="bg-white" width="150">STATUS</th>
											</tr>
										</thead>
										<tbody>
											<?php
	                    $no=1;
	                    foreach ($query->result() as $key => $value): ?>
	                      <tr>
	                        <td><b><?php echo $no++; ?>.</b></td>
	                        <td><?php echo $value->isi_pengaduan; ?></td>
	                        <td><?php echo $this->Mcrud->waktu($value->tgl_pengaduan,'full'); ?></td>
	                        <td>
										<?php echo $this->Mcrud->cek_status($value->status); ?>
										<?php if ($value->status == 'selesai') { ?>
											<div><?php echo $value->pesan_petugas; ?></div>
										<?php } ?>
									</td>
	                      </tr>
	                    <?php endforeach; ?>
											<?php if ($query->num_rows()==0): ?>
												<tr>
													<td colspan="4" align="center" style="color:red">
														No. KTP <b>"<?php echo $no_ktp; ?>"</b> tidak ditemukan!
													</td>
												</tr>
											<?php endif; ?>
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
			<?php endif; ?>
		</div>
	</div>
	</div>

	<!-- END: PAGE CONTAINER -->
	<script type="text/javascript">
		function link()
		{
			window.location.href='pengaduan/cek/'+$('#c_ktp').val();
		}
	</script>
