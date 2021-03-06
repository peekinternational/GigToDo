<?php

session_start();

require_once("includes/db.php");

require_once("social-config.php");

if(isset($_SESSION['seller_user_name'])){
	
	echo "<script> window.open('home.php','_self'); </script>";
	
}
?>
<!DOCTYPE html>

<html lang="en" class="ui-toolkit">

<head>

	<title><?php echo $site_name; ?> - <?php echo $lang['titles']['login']; ?></title>

	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="Login or register for an account on <?php echo $site_name; ?>, a fast growing freelance marketplace, where sellers provide their services at extremely affordable prices.">
	<meta name="keywords" content="<?php echo $site_keywords; ?>">
	<meta name="author" content="<?php echo $site_author; ?>">

	<!--====== Favicon Icon ======-->
	<link rel="shortcut icon" href="images/<?php echo $site_favicon; ?>" type="image/png">

	<!-- ==============Google Fonts============= -->
	<link href="https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&display=swap" rel="stylesheet">

	<!--====== Bootstrap css ======-->
	<link href="assets/css/bootstrap.min.css" rel="stylesheet">

	<!--====== PreLoader css ======-->
	<link href="assets/css/preloader.css" rel="stylesheet">

	<!--====== Animate css ======-->
	<link href="assets/css/animate.min.css" rel="stylesheet">

	<!--====== Fontawesome css ======-->
	<link href="assets/css/fontawesome.min.css" rel="stylesheet">

	<!--====== Owl carousel css ======-->
	<link href="assets/css/owl.carousel.min.css" rel="stylesheet">

	<!--====== Nice select css ======-->
	<link href="assets/css/nice-select.css" rel="stylesheet">

	<!--====== Default css ======-->
	<link href="assets/css/default.css" rel="stylesheet">

	<!--====== Style css ======-->
	<link href="assets/css/style.css" rel="stylesheet">

	<!--====== Responsive css ======-->
	<link href="assets/css/responsive.css" rel="stylesheet">

	<link href="styles/sweat_alert.css" rel="stylesheet">
	<link href="styles/animate.css" rel="stylesheet">
	<!-- Optional: include a polyfill for ES6 Promises for IE11 and Android browser -->
	<script src="js/ie.js"></script>
	<script type="text/javascript" src="js/sweat_alert.js"></script>
	<script type="text/javascript" src="js/jquery.min.js"></script>
	<style>.swal2-popup .swal2-styled.swal2-confirm{background-color: #ff0707;}.swal2-popup .swal2-select{display: none;}</style>
</head>

<body class="home-content">


<?php require_once("includes/header-top.php"); ?>
	<!-- Preloader Start -->
	<div class="proloader">
		<div class="loader">
			<img src="assets/img/emongez_cube.png" />
		</div>
	</div>
	<!-- Preloader End -->
	<!-- Main content -->
	<main>
		<section class="container-fluid login-signup">
			<div class="row">
				<div class="container">
					<div class="login-signup-wrapper signup-wrapper">
						<div class="login-signup-header">
							<h3 class="text-center">التسجيل</h3>
							<p class="text-center">عندك حساب أصلا ؟ <a href="login.php">الدخول</a></p>
						</div>
						<?php if($enable_social_login == "yes"){ ?>
						<div class="login-by-social d-flex flex-column flex-lg-row align-items-center justify-content-center">
							<a class="social-button facebook d-flex flex-row align-items-center" href="javascript:void(0);" onclick="window.location = '<?= $fLoginURL ?>';">
								<span>
									<i class="fab fa-facebook-f"></i>
								</span>
								<span>التسجيل عن طريق Facebook</span>
							</a>
							<a class="social-button linkedin d-flex flex-row align-items-center" href="javascript:void(0);">
								<span>
									<i class="fab fa-linkedin-in"></i>
								</span>
								<span>التسجيل عن طريقlinkedin</span>
							</a>
							<a class="social-button google d-flex flex-row align-items-center" href="javascript:void(0);" onclick="window.location = '<?= $gLoginURL ?>';">
								<span>
									<i class="fab fa-google"></i>
								</span>
								<span>التسجيل عن طريقGoogle</span>
							</a>
						</div>
						<?php } ?>
						<div class="login-with-credentials">
							<?php
							$form_errors = Flash::render("register_errors");
							$form_data = Flash::render("form_data");
							if(is_array($form_errors)){
							?>
							<div class="alert alert-danger">
								<!--- alert alert-danger Starts --->
								<ul class="list-unstyled mb-0">
									<?php $i = 0; foreach ($form_errors as $error) { $i++; ?>
									<li class="list-unstyled-item"><?= $i ?>. <?= ucfirst($error); ?></li>
									<?php } ?>
								</ul>
							</div>
							<?php } ?>
							<form action="" method="POST">
								<!-- <div class="form-group">
									<label class="control-label">الاسم الأول</label>
									<input class="form-control" type="text" name="name" placeholder="أدخل اسمك الكامل" value="<?php if(isset($_SESSION['name'])) echo $_SESSION['name']; ?>" />
									<span class="form-text text-danger"><?php echo ucfirst(@$form_errors['name']); ?></span>
								</div> -->
								<!-- <div class="form-group">
										<label class="control-label">Last Name</label>
										<input class="form-control" type="text" name="" />
								</div> -->
								<div class="form-group">
									<label class="control-label">الاسم الأخير</label>
									<input class="form-control" type="text" name="u_name" placeholder="أدخل اسم المستخدم الخاص بك" value="<?php if(isset($_SESSION['u_name'])) echo $_SESSION['u_name']; ?>" />
									<small class="form-text text-muted">ملاحظة: لن تتمكن من تغيير اسم المستخدم بمجرد إنشاء حسابك</small>
									<?php if(in_array("Opps! This username has already been taken. Please try another one", $error_array)) echo "<span style='color:red;'>This username has already been taken. Please try another one.</span> <br>"; ?>
									<?php if(in_array("Username must be greater that 4 characters long or less than 25 characters.", $error_array)) echo "<span style='color:red;'>Username must be greater that 4 characters or less than 25.</span> <br>"; ?>
									<?php if(in_array("Foreign characters are not allowed in username, Please try another one.", $error_array)) echo "<span style='color:red;'>Foreign characters are not allowed in username, Please try another one.</span> <br>"; ?>
									<span class="form-text text-danger"><?php echo ucfirst(@$form_errors['u_name']); ?></span>
								</div>
								<div class="form-group">
									<label class="control-label">الإيميل</label>
									<input class="form-control" type="email" name="email" placeholder="أدخل البريد الإلكتروني" value="<?php if(isset($_SESSION['email'])) echo $_SESSION['email']; ?>">
									<?php if(in_array("Email has already been taken. Try logging in instead.", $error_array)) echo "<span style='color:red;'>Email has already been taken. Try logging in instead.</span> <br>"; ?>
									<span class="form-text text-danger"><?php echo ucfirst(@$form_errors['email']); ?></span>
								</div>
								<div class="form-group">
									<label class="control-label">الباسوورد</label>
									<input class="form-control" type="password" name="pass" placeholder="أدخل كلمة المرور"/>
									<span class="form-text text-danger"><?php echo ucfirst(@$form_errors['pass']); ?></span>
								</div>
								<div class="form-group">
									<label class="control-label"> تؤكد  الباسوورد</label>
									<input type="password" class="form-control" name="con_pass" placeholder="تأكيد كلمة المرور">
									<?php if(in_array("Passwords don't match. Please try again.", $error_array)) echo "<span style='color:red;'>Passwords don't match. Please try again.</span> <br>"; ?>
									<span class="form-text text-danger"><?php echo ucfirst(@$form_errors['con_pass']); ?></span>
								</div>
								<?php if(isset($_GET['referral'])){ ?>
								<input type="hidden" class="form-control" name="referral" value="<?= $input->get('referral'); ?>">
								<?php }else{ ?>
								<input type="hidden" class="form-control" name="referral" value="">
								<?php } ?>
								<input type="hidden" name="timezone" value="">
								<div class="row">
									<div class="col-12">
										<label class="control-label">نوع الحساب</label>
									</div>
									<div class="col-12 col-sm-6">
										<div class="form-group">
											<label for="customRadio1" class="custom-control custom-radio">
												<input type="radio" hidden id="customRadio1" name="accountType" class="custom-control-input" value="buyer">
												<div class="custom-control-label">مشترى</div>
											</label>
										</div>
									</div>
									<div class="col-12 col-sm-6">
										<div class="form-group">
											<label for="customRadio2" class="custom-control custom-radio">
												<input type="radio" hidden id="customRadio2" name="accountType" class="custom-control-input" value="seller">
												<div class="custom-control-label">بائع</div>
											</label>
										</div>
									</div>
									<span class="form-text text-danger"><?php echo ucfirst(@$form_errors['accountType']); ?></span>
								</div>
								<div class="form-group d-flex flex-row align-items-center justify-content-between mb-0">
									<div class="custom-control custom-checkbox">
										<input type="checkbox" class="custom-control-input" name="term" id="terms">
										<label class="custom-control-label" style="text-transform: none;" for="terms">اوافق على  <a href="javascript:void(0);">الشروط والأحكام</a></label>
									</div>
								</div>
								<span class="form-text text-danger"><?php echo ucfirst(@$form_errors['term']); ?></span>
								<div class="form-group">
									<button class="login-button" role="button" type="submit" name="register" >التسجيل</button>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</section>
	</main>
	<!-- Main content end -->


<script>
// $(document).on("click","#terms",function(){
// 		if($(this).prop("checked") == true){
// 			$(':input[type="submit"]').prop('disabled', false);
// 		}
// 		else if($(this).prop("checked") == false){
// 			$(':input[type="submit"]').prop('disabled', true);
// 		}
// 	});
</script>
<?php 
	if(isset($_POST['register'])){
		$rules = array(
		"u_name" => "required",
		"email" => "email|required",
		"pass" => "required",
		"con_pass" => "required",
		"accountType" => "required",
		"term" => "required");

		$messages = array("name" => "الإسم الكامل ضروري.","u_name" => "اسم المستخدم مطلوب.","pass" => "كلمة المرور مطلوبة.","con_pass" => "تأكيد كلمة المرور مطلوب.", "accountType" => "نوع الحساب مطلوب.", 'email' => 'البريد الالكتروني مطلوب' , "term" => "يرجى التحقق من الشروط والأحكام");
		$val = new Validator($_POST,$rules,$messages);

		if($val->run() == false){
			$_SESSION['error_array'] = array();
			Flash::add("register_errors",$val->get_all_errors());
			Flash::add("form_data",$_POST);
			echo "<script>window.open('register','_self')</script>";
		}else{
			$error_array = array();
			$name = strip_tags($input->post('name'));
			$name = strip_tags($name);
			$name = ucfirst(strtolower($name));
			$_SESSION['name']= $name;
			$u_name = strip_tags($input->post('u_name'));
			$u_name = strip_tags($u_name);
			$_SESSION['u_name']= $u_name;
			$email = strip_tags($input->post('email'));
			$email = strip_tags($email);
			$_SESSION['email']=$email;
			$pass = strip_tags($input->post('pass'));
			$con_pass = strip_tags($input->post('con_pass'));
			$accountType = strip_tags($input->post('accountType'));
			$referral = strip_tags($input->post('referral'));
			$geoplugin = unserialize(file_get_contents('http://www.geoplugin.net/php.gp?ip='.$ip));
			$country = $geoplugin['geoplugin_countryName'];
			if(empty($country)){ $country = ""; }
			$regsiter_date = date("F d, Y");
			$date = date("F d, Y");
		
			$check_seller_username = $db->count("sellers",array("seller_user_name" => $u_name));
			$check_seller_email = $db->count("sellers",array("seller_email" => $email));
			if(preg_match('/[اأإء-ي]/ui', $input->post('u_name'))){
			  array_push($error_array, "الأحرف الأجنبية غير مسموح بها في اسم المستخدم ، يرجى تجربة حرف آخر.");
			}
			if($check_seller_username > 0 ){
			  array_push($error_array, "عذراً! وقد تم بالفعل اتخاذ هذا المستخدم. يرجى تجربة واحدة أخرى");
			}
			if($check_seller_email > 0){
			  array_push($error_array, "لقد اخذ الايميل من قبل. حاول تسجيل الدخول بدلاً من ذلك.");
			}
			if($pass != $con_pass){
	     	  array_push($error_array, "كلمتا المرور غير متطابقتين. حاول مرة اخرى.");
			}
	    
			if(empty($error_array)){

				$referral_code = mt_rand();
				if($signup_email == "yes"){
					$verification_code = mt_rand();
				}else{
					$verification_code = "ok";
				}
				$encrypted_password = password_hash($pass, PASSWORD_DEFAULT);
				$seller_activity = date("Y-m-d H:i:s");
				
				// This is just an example. In application this will come from Javascript (via an AJAX or something)
				$timezone_offset_minutes = $input->post('timezone');  // $_GET['timezone_offset_minutes']
				// Convert minutes to seconds and get timezone
				$timezone = timezone_name_from_abbr("", $timezone_offset_minutes*60, false);
				
				$insert_seller = $db->insert("sellers",array("seller_name" => $name,"seller_user_name" => $u_name,"seller_email" => $email,"seller_pass" => $encrypted_password,"account_type" => $accountType,"seller_country"=>$country,"seller_level" => 1,"seller_recent_delivery" => 'none',"seller_rating" => 100,"seller_offers" => 10,"seller_referral" => $referral_code,"seller_ip" => $ip,"seller_verification" => $verification_code,"seller_vacation" => 'off',"seller_register_date" => $regsiter_date,"seller_activity"=>$seller_activity,"seller_timezone"=>$timezone,"seller_status" => 'online'));
						
				$regsiter_seller_id = $db->lastInsertId();
				if($insert_seller){
				  $_SESSION['seller_user_name'] = $u_name;
					$insert_seller_account = $db->insert("seller_accounts",array("seller_id" => $regsiter_seller_id));
					if($paymentGateway == 1){
						$insert_seller_settings = $db->insert("seller_settings",array("seller_id" => $regsiter_seller_id));
					}
					if($insert_seller_account){
						if(!empty($referral)){
					    $sel_seller = $db->select("sellers",array("seller_referral" => $referral));		
							$row_seller = $sel_seller->fetch();
							$seller_id = $row_seller->seller_id;	
							$seller_ip = $row_seller->seller_ip;
							if($seller_ip == $ip){
								echo "<script>alert('You Cannot Referral Yourself To Make Money.');</script>";
							}else{
								$count_referrals = $db->count("referrals",array("ip" => $ip));	
								if($count_referrals == 1){
							    echo "<script>alert('You are trying to referral yourself more then one time.');</script>";
								}else{
									$insert_referral = $db->insert("referrals",array("seller_id" => $seller_id,"referred_id" => $regsiter_seller_id,"comission" => $referral_money,"date" => $date,"ip" => $ip,"status" => 'pending'));
								}
							}	
						}
						if($signup_email == "yes"){
							userSignupEmail($email);
					  }
					      $get_seller = $db->select("sellers",array("seller_id" => $regsiter_seller_id));		
					  		$seller_meta = $get_seller->fetch();
					  		//print_r($seller_meta); die();
					  		if($seller_meta->account_type == 'buyer'){

			           
			           
			          echo "
			          <script>
			          swal({
			          type: 'success',
			          text: 'سجلت بنجاح! مرحبًا بكم على متن   $name. ',
			          timer: 6000,
			          onOpen: function(){
			          swal.showLoading()
			          }
			          }).then(function(){
			          if (
			          // Read more about handling dismissals
			          window.open('$site_url/ar/','_self')
			          ) {
			          console.log('Successful Registration')
			          }
			          })
			          </script>
			          ";
			          $_SESSION['name'] = "";
			          $_SESSION['u_name']="";
			          $_SESSION['email']= "";
			          $_SESSION['error_array'] = array();
					      }else{

							echo "
							<script>
							swal({
							type: 'success',
							text: 'سجلت بنجاح! مرحبًا بكم على متن   $name. ',
							timer: 6000,
							onOpen: function(){
							swal.showLoading()
							}
							}).then(function(){
							if (
							// Read more about handling dismissals
							window.open('$site_url/ar/dashboard','_self')
							) {
							console.log('Successful Registration')
							}
							})
							</script>
							";
							$_SESSION['name'] = "";
							$_SESSION['u_name']="";
							$_SESSION['email']= "";
							$_SESSION['error_array'] = array();
						}
					}
				}
			}
			if(!empty($error_array)){
				$_SESSION['error_array'] = $error_array;
				echo "
				<script>
				swal({
					type: 'warning',
					html: $('<div>').text('عذراً! هناك بعض الأخطاء في النموذج. حاول مرة اخرى.'),
					animation: false,
					customClass: 'animated tada'
				}).then(function(){
					window.open('index','_self')
				});
				</script>";
			}
		}
	}
?>
<?php require_once("includes/footer.php"); ?>
<?php require_once("includes/footerJs.php"); ?>



</body>

</html>