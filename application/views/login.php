<!--
Author: W3layouts
Author URL: http://w3layouts.com
-->
<!DOCTYPE html>
<html lang="zxx">

<head>
	<title>Seguridad</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta charset="UTF-8" />
	<meta name="keywords"/>
	<script>
		addEventListener("load", function () {
			setTimeout(hideURLbar, 0);
		}, false);

		function hideURLbar() {
			window.scrollTo(0, 1);
		}
	</script>
	<!-- //Meta tag Keywords -->
	<!--/Style-CSS -->
	<link rel="stylesheet" href="<?= base_url() ?>assets/login/css/style.css" type="text/css" media="all" />
	<!--//Style-CSS -->
</head>

<body>
	<!-- /login-section -->

	<section class="w3l-forms-23">
		<div class="forms23-block-hny">
			<div class="wrapper">
				<h1>MEGA SEGURIDAD</h1>
				<!-- if logo is image enable this   
					<a class="logo" href="index.html">
					  <img src="image-path" alt="Your logo" title="Your logo" style="height:35px;" />
					</a> 
				-->
				<div class="d-grid forms23-grids">
					<div class="form23">
						<div class="main-bg">
							<h6 class="sec-one"></h6>
							<div class="speci-login first-look">
								<img src="<?= base_url() ?>assets/login/images/user.png" alt="" class="img-responsive">
							</div>
						</div>
						<div>
	                        <p class="login-box-msg" style="padding: 1px">
	                          <?php if($this->session->flashdata('usuario_incorrecto')) { ?>
	                          <?=$this->session->flashdata('usuario_incorrecto')?>
	                          <?php } ?>
	                        </p>
	                    </div>
						<div class="bottom-content">
							<form action="<?= base_url() ?>session" method="post">
								<input type="email" name="usuario" class="input-form" placeholder="Ingresa tu correo"
										required="required" />
								<input type="password" name="contrasena" class="input-form"
										placeholder="Ingresa tu password" required="required" />
								<input type="hidden" name="token" id="token" value="<?= $token ?>">
								<button type="submit" class="loginhny-btn btn">Iniciar</button>
							</form>
							<p>Olvidaste tu Contraseña? <a href="#">Pulsa aquí!</a></p>
						</div>
					</div>
				</div>
				<div class="w3l-copy-right text-center">
				</div>
			</div>
		</div>
	</section>
	<!-- //login-section -->
</body>

</html>