<section dir="ltr" id="home">
<div class="limiter" >
	<!-- <div class="bg-img"></div> -->
	<!-- <div class="bg-img2"></div> -->
	<div class="bg-img1"></div>

	<div class="container-login100">
		<div class="wrap-login100">
			<div class="col-lg-8">
				<div class="login100-pic">
					<center>
						<img src="img/img-login.png" alt="IMG">
						<small>
							<a class="img-attribute" href="https://www.freepik.com/vectors/background">Background vector created by jcomp - www.freepik.com</a>
						</small>
					</center>
				</div>
			</div>
			<div class="col-lg-4">
				<center>
					<img src="assets/login/images/logo_ampenan.png" alt="IMG" style="width: 40%;">

					<form class="login100-form validate-form" action="" method="post">
						<!-- <span class="login100-form-title" style="padding-bottom:0px;font-size: 53px;
   						color: #00acac;">
							AMPENAN
						</span> -->

						<span class="login100-form-title" style="padding:7px 13px 40px;font-size:15px;">
							APLIKASI MANAJEMEN PROGRAM KEGIATAN DAN ANGGARAN
						</span>
						<!-- <span class="login100-form-title" style="padding-bottom:40px;font-size: 19px;">
							PROGRAM DAN ANGGARAN
						</span> -->
						<?php
							echo $this->session->flashdata('msg');
						?>
						<div class="wrap-input100 validate-input" data-validate = "Username is required">
							<input class="input100" type="text" placeholder="Username" name="username" autofocus>
							<span class="focus-input100"></span>
							<span class="symbol-input100">
								<i class="fa fa-user" aria-hidden="true"></i>
							</span>
						</div>
		
						<div class="wrap-input100 validate-input" data-validate = "Password is required">
							<input class="input100" type="password" placeholder="Password" name="password">
							<span class="focus-input100"></span>
							<span class="symbol-input100">
								<i class="fa fa-lock" aria-hidden="true"></i>
							</span>
						</div>
		
						<div class="container-login100-form-btn">
							<button type="submit" name="btnlogin" class="login100-form-btn">
								Login
							</button>
						</div>
					</form>
					<!-- <hr> -->
					<!-- <p class="c-copyright c-font-grey">Kanwil Kemenkumham NTB 
						<span class="c-font-grey-3">Copyright &#169; <script type='text/javascript'>var creditsyear = new Date();document.write(creditsyear.getFullYear());</script></span>
					</p> -->
				</center>
			</div>
			
		</div>
	</div>
</div>
</section >
