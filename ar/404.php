<?php

session_start();
require_once("includes/db.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
<!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-TF82RTH');</script>
<!-- End Google Tag Manager -->
	<!--====== Required meta tags ======-->
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<!--====== Title ======-->
	<title>eMongez | 404 Error</title>

	<!--====== Favicon Icon ======-->
	<link rel="shortcut icon" href="assets/img/favicon.ico" type="image/png">

	<!-- ==============Google Fonts============= -->
	<link href="https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&display=swap" rel="stylesheet">

	<!--====== Bootstrap css ======-->
	<link href="<?= $site_url; ?>/ar/assets/css/bootstrap.min.css" rel="stylesheet">

	<!--====== PreLoader css ======-->
	<link href="<?= $site_url; ?>/ar/assets/css/preloader.css" rel="stylesheet">

	<!--====== Animate css ======-->
	<link href="<?= $site_url; ?>/ar/assets/css/animate.min.css" rel="stylesheet">

	<!--====== Fontawesome css ======-->
	<link href="<?= $site_url; ?>/ar/assets/css/fontawesome.min.css" rel="stylesheet">

	<!--====== Owl carousel css ======-->
	<link href="<?= $site_url; ?>/ar/assets/css/owl.carousel.min.css" rel="stylesheet">

	<!--====== Nice select css ======-->
	<link href="<?= $site_url; ?>/ar/assets/css/nice-select.css" rel="stylesheet">

	<!--====== Default css ======-->
	<link href="<?= $site_url; ?>/ar/assets/css/default.css" rel="stylesheet">

	<!--====== Style css ======-->
	<link href="<?= $site_url; ?>/ar/assets/css/style1.css" rel="stylesheet">

	<!--====== Responsive css ======-->
	<link href="<?= $site_url; ?>/ar/assets/css/responsive.css" rel="stylesheet">


</head>

<body class="all-content">

	<div class="pagewrapper">
		<!-- Preloader Start -->
		<div class="proloader">
			<div class="loader">
				<img src="<?= $site_url; ?>/assets/img/emongez_cube.png" />
			</div>
		</div>
		<!-- Preloader End -->
		<!-- Header -->
		<header>
			<div class="header-top">
				<div class="container">
					<div class="row align-items-center">
						<div class="col-6 col-md-3 d-flex flex-row">
							<div class="logo">
								<a class="home-logo" href="<?= $site_url; ?>/ar"><img src="<?= $site_url; ?>/images/ar/<?= $site_arabic_logo; ?>" alt=""></a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</header>
		<!-- Header END-->
		<!-- Close-overlay -->
		<div class="overlay-bg"></div>
		<!-- Offcanvas-menu END-->

		<!-- Main content -->
		<main class="emongez-content-main">

			<section class="container-fluid error-404">
				<div class="row">
					<div class="container">
						<div class="row flex-md-row-reverse justify-content-between align-items-center">
							<div class="col-12 col-md-6 col-lg-6">
								<img alt="Error 404" class="img-fluid d-block ml-auto mr-auto mb-3 mb-md-0" src="assets/img/error/image-404.png" />
							</div>
							<div class="col-12 col-md-6 col-lg-5">
								<h1>
									صفحة 404<br />
									مش موجودة
								</h1>
								<div class="d-flex flex-row">
									<a class="d-flex flex-row align-items-center justify-content-center error-404-button" href="javascript:void(0);">إرجع للصفحة</a>
								</div>
							</div>
						</div>
					</div>
				</div>
			</section>

		</main>
		<!-- Main content end -->

		<?php require_once("includes/footer.php"); ?>

<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-TF82RTH"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->
</body>

</html>
