<?php
session_start();
require_once("includes/db.php");
if(!isset($_SESSION['seller_user_name'])){
	
echo "<script>window.open('login','_self')</script>";

}
$login_seller_user_name = $_SESSION['seller_user_name'];
$select_login_seller = $db->select("sellers",array("seller_user_name" => $login_seller_user_name));
$row_login_seller = $select_login_seller->fetch();
$login_seller_id = $row_login_seller->seller_id;
?>
<!DOCTYPE html>
<html dir="rtl" lang="ar" class="ui-toolkit">
	<head>
		<!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-TF82RTH');</script>
<!-- End Google Tag Manager -->
		<title><?= $site_name; ?> - Proposals Ordered</title>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<meta name="keywords" content="<?= $site_keywords; ?>">
		<meta name="author" content="<?= $site_author; ?>">
		<?php if(!empty($site_favicon)){ ?>
		<link rel="shortcut icon" href="images/<?= $site_favicon; ?>" type="image/x-icon">
		<?php } ?>
		<!--====== Favicon Icon ======-->
		<?php if(!empty($site_favicon)){ ?>
			<link rel="shortcut icon" href="<?= $site_url; ?>/images/<?= $site_favicon; ?>" type="image/x-icon">
		<?php } ?>
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
		<!--====== Nice select css ======-->
	  <link href="<?= $site_url; ?>/ar/assets/css/tagsinput.css" rel="stylesheet">
		<!--====== Range Slider css ======-->
		<link href="<?= $site_url; ?>/ar/assets/css/ion.rangeSlider.min.css" rel="stylesheet">
		<!--====== Default css ======-->
		<link href="<?= $site_url; ?>/ar/assets/css/default.css" rel="stylesheet">
		<!--====== Style css ======-->
		<link href="<?= $site_url; ?>/ar/assets/css/style.css" rel="stylesheet">
		<!--====== Responsive css ======-->
		<link href="<?= $site_url; ?>/ar/assets/css/responsive.css" rel="stylesheet">
		<!-- <link href="styles/bootstrap.css" rel="stylesheet"> -->
		<!-- <link href="styles/custom.css" rel="stylesheet">  -->
		<!-- Custom css code from modified in admin panel --->
		<link href="<?= $site_url; ?>/ar/styles/styles.css" rel="stylesheet">
		<link href="styles/user_nav_styles.css" rel="stylesheet">
		<link href="font_awesome/css/font-awesome.css" rel="stylesheet">
		<link href="styles/owl.carousel.css" rel="stylesheet">
		<link href="styles/owl.theme.default.css" rel="stylesheet">
		<script type="text/javascript" src="js/jquery.min.js"></script>
		<style>
			.orders-list .orders-table tbody tr td .button.button-darkgray {
			    background-color: darkgray;
			    border-color: darkgray;
			    color: white;
			}
			.orders-list .orders-table tbody tr td .button:hover.button-darkgray {
			    background-color: white;
			    color: darkgray;
			}
		</style>
	</head>
	<body class="all-content">
		<?php require_once("includes/buyer-header.php"); ?>
		<!-- Preloader Start -->
		<div class="proloader">
			<div class="loader">
				<img src="<?= $site_url; ?>/assets/img/emongez_cube.png" />
			</div>
		</div>
		<!-- Preloader End -->
		<main>
			<section class="container-fluid orders-list">
				<div class="row">
					<div class="container">
						<div class="row">
							<div class="col-12">
								<h1 class="title">
								المشاريع
								</h1>
							</div>
						</div>
						<!-- Row -->
						<div class="row">
							<div class="col-12">
								<div class="orders-summary d-flex flex-wrap">
									<?php
									  // $get_purchases = $db->select("purchases",array("seller_id" => $login_seller_id),"DESC");
									  $get_purchases = $db->query("select * from purchases where seller_id=$login_seller_id and method != 'order_cancellation'");
									  $count_purchases = $get_purchases->rowCount();
									  $total_purchase = array();
									  $active_order_price = 0;
									  while($row_purchases = $get_purchases->fetch()){
									    $order_id = $row_purchases->order_id;
									    $amount = $row_purchases->amount;
									    array_push($total_purchase,$amount);

									    $get_order = $db->select("orders",array("order_id" => $order_id, "order_status" => "active"));
									    $order_amount_price = 0;
									    $order_fee_price = 0;
									    while($row_order = $get_order->fetch()){
									      $order_price = $row_order->order_price;
									      $order_fee = $row_order->order_fee;
									      $order_amount_price += $order_price;
									      $order_fee_price += $order_fee;
									      
									      $active_order_price += $order_amount_price + $order_fee_price;
									    }
									  }
									  $total_purchase_amount = array_sum($total_purchase);

									?>
									<div class="orders-summary-item d-flex flex-column align-items-center justify-content-between">
										<span class="image-icon">
											<img alt="" class="img-fluid d-block" src="assets/img/order/purchases-icon.png" />
										</span>
										<div class="d-flex flex-column">
											<span class="description">
												المشتريات الكلية
											</span>
											<span class="amount"><?php if ($to == 'EGP'){ echo $to.' '; echo $total_purchase_amount;}elseif($to == 'USD'){  echo $to.' '; echo round($cur_amount * $total_purchase_amount,2);}else{  echo $s_currency.' '; echo $total_purchase_amount; } ?></span>
										</div>
									</div>
									<!-- Each item -->
									<?php
									  $get_order = $db->select("orders",array("buyer_id" => $login_seller_id, "order_status" => "completed"));
									  $completed_order_price = 0;
									  $order_amount_price = 0;
									  $order_fee_price = 0;
									  while($row_order = $get_order->fetch()){
									    $order_price = $row_order->order_price;
									    $order_fee = $row_order->order_fee;
									    $order_amount_price += $order_price;
									    $order_fee_price += $order_fee;
									    
									    $completed_order_price += $order_amount_price + $order_fee_price;
									  }

									?>
									<div class="orders-summary-item d-flex flex-column align-items-center justify-content-between">
										<span class="image-icon">
											<img alt="" class="img-fluid d-block" src="assets/img/order/completed-icon.png" />
										</span>
										<div class="d-flex flex-column">
											<span class="description">
												خلصت
											</span>
											<span class="amount"><?php if ($to == 'EGP'){ echo $to.' '; echo $completed_order_price;}elseif($to == 'USD'){  echo $to.' '; echo round($cur_amount * $completed_order_price,2);}else{  echo $s_currency.' '; echo $completed_order_price; } ?></span>
										</div>
									</div>
									<!-- Each item -->
									<?php
								    $get_order = $db->select("orders",array("buyer_id" => $login_seller_id, "order_status" => "delivered"));
								    $delivered_order_price = 0;
								    $order_amount_price = 0;
								    $order_fee_price = 0;
								    while($row_order = $get_order->fetch()){
								      $order_price = $row_order->order_price;
								      $order_fee = $row_order->order_fee;
								      $order_amount_price += $order_price;
								      $order_fee_price += $order_fee;
								      
								      $delivered_order_price += $order_amount_price + $order_fee_price;
								    }
									?>
									<div class="orders-summary-item d-flex flex-column align-items-center justify-content-between">
										<span class="image-icon">
											<img alt="" class="img-fluid d-block" src="assets/img/order/review-icon.png" />
										</span>
										<div class="d-flex flex-column">
											<span class="description">هيتم تقييمها و مراجعتها</span>
											<span class="amount"><?php if ($to == 'EGP'){ echo $to.' '; echo $delivered_order_price;}elseif($to == 'USD'){  echo $to.' '; echo round($cur_amount * $delivered_order_price,2);}else{  echo $s_currency.' '; echo $delivered_order_price; } ?></span>
										</div>
									</div>
									<!-- Each item -->
										<?php
									    $get_order = $db->select("orders",array("buyer_id" => $login_seller_id, "order_status" => "cancelled"));
									    $cancelled_order_price = 0;
									    $order_amount_price = 0;
									    $order_fee_price = 0;
									    while($row_order = $get_order->fetch()){
									      $order_price = $row_order->order_price;
									      $order_fee = $row_order->order_fee;
									      $order_amount_price += $order_price;
									      $order_fee_price += $order_fee;
									      
									      $cancelled_order_price += $order_amount_price + $order_fee_price;
									    }

										?>
									<div class="orders-summary-item d-flex flex-column align-items-center justify-content-between">
										<span class="image-icon">
											<img alt="" class="img-fluid d-block" src="assets/img/order/cancelled-icon.png" />
										</span>
										<div class="d-flex flex-column">
											<span class="description">ملغية</span>
											<span class="amount"><?php if ($to == 'EGP'){ echo $to.' '; echo $cancelled_order_price;}elseif($to == 'USD'){  echo $to.' '; echo round($cur_amount * $cancelled_order_price,2);}else{  echo $s_currency.' '; echo $cancelled_order_price; } ?></span>
										</div>
									</div>
									<!-- Each item -->
									<?php
								    // $get_order = $db->select("orders",array("order_id" => $order_id, "order_status" => "pending"));
								    $get_order = $db->query("select * from orders where buyer_id=$login_seller_id and order_status='progress' or order_status='pending'");
								    $overdue_order_price = 0;
								    $order_amount_price = 0;
								    $order_fee_price = 0;
								    while($row_order = $get_order->fetch()){
								    	$order_status = $row_order->order_status;
								      $order_price = $row_order->order_price;
								      $order_fee = $row_order->order_fee;
								      $total_amount = $order_price + $order_fee;
					            $order_duration = intval($row_order->order_duration);
					      			$order_date = $row_order->order_date;
					      			$order_due = date("F d, Y", strtotime($order_date . " + $order_duration days"));
					            $today_date = date("F d, Y");
					            $new_date_today = strtotime($today_date);
					      
					      		  $date1 = date('Y-m-d',$new_date_today);

					      		  $new_date_order = strtotime($order_due);
					      		   
					      		  $date2 = date('Y-m-d',$new_date_order);
								      
							        if($date1 > $date2){
							        	$overdue_order_price += $total_amount;
							      	}
								    }
									?>
									<div class="orders-summary-item d-flex flex-column align-items-center justify-content-between">
										<span class="image-icon">
											<img alt="" class="img-fluid d-block" src="assets/img/order/overdue-icon.png" />
										</span>
										<div class="d-flex flex-column">
											<span class="description">متأخرة</span>
											<span class="amount"><?php if ($to == 'EGP'){ echo $to.' '; echo $overdue_order_price;}elseif($to == 'USD'){  echo $to.' '; echo round($cur_amount * $overdue_order_price,2);}else{  echo $s_currency.' '; echo $overdue_order_price; } ?></span>
										</div>
									</div>
									<!-- Each item -->
								</div>
							</div>
						</div>
						<!-- Row -->
						<div class="row">
							<div class="col-12">
								<!-- <div class="orders-header d-flex flex-column flex-md-row justify-content-between">
									<div class="orders-status d-flex flex-row align-items-center">
										<span>اعرض</span>
										<div>
											<select class="wide">
												<option>كله</option>
												<option>order again</option>
												<option>in progress</option>
												<option>awaiting review</option>
												<option>cancelled</option>
												<option>overdue</option>
											</select>
										</div>
									</div>
									<div class="orders-pagination">
										<ul class="pagination">
											<li class="pagination-item">
												<a class="pagination-link" href="javascript:void(0);">
													<i class="fal fa-angle-right"></i>
												</a>
											</li>
											<li class="pagination-item">
												<a class="pagination-link" href="javascript:void(0);">1</a>
											</li>
											<li class="pagination-item">
												<div class="pagination-status d-flex flex-row align-items-center">
													<span>Of</span>
													<span>1</span>
												</div>
											</li>
											<li class="pagination-item">
												<a class="pagination-link" href="javascript:void(0);">
													<i class="fal fa-angle-left"></i>
												</a>
											</li>
										</ul>
									</div>
								</div> -->
							</div>
						</div>
						<!-- Row -->
						<div class="row">
							<div class="col-12">
								<?php require_once("manage_orders/order_all_buying.php") ?>
							</div>
						</div>
						<!-- Row -->
					</div>
				</div>
			</section>
		</main>


		<!-- <div class="container-fluid mt-5">
			<div class="row">
				<div class="col-md-12">
					<h1 class="<?=($lang_dir == "right" ? 'text-right':'')?>"><?= $lang["titles"]["buying_orders"]; ?></h1>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12 mt-5 mb-3">
					<ul class="nav nav-tabs flex-column flex-sm-row">
						<li class="nav-item">
							
							<?php
							$count_orders = $db->count("orders",array("buyer_id" => $login_seller_id, "order_active" => 'yes'));
							?>
							<a href="#active" data-toggle="tab" class="nav-link active make-black">
								<?= $lang['tabs']['active']; ?> <span class="badge badge-success"> <?= $count_orders; ?></span>
								
							</a>
						</li>
						<li class="nav-item">
							
							<?php
							$count_orders = $db->count("orders",array("buyer_id" => $login_seller_id, "order_status" => 'delivered'));
							?>
							<a href="#delivered" data-toggle="tab" class="nav-link make-black">
								<?= $lang['tabs']['delivered']; ?> <span class="badge badge-success"><?= $count_orders; ?> </span>
							</a>
						</li>
						<li class="nav-item">
							
							<?php
							$count_orders = $db->count("orders",array("buyer_id" => $login_seller_id, "order_status" => 'completed'));
							?>
							<a href="#completed" data-toggle="tab" class="nav-link make-black">
								<?= $lang['tabs']['completed']; ?> <span class="badge badge-success"><?= $count_orders; ?></span>
								
							</a>
							
						</li>
						<li class="nav-item">
							
							<?php
							$count_orders = $db->count("orders",array("buyer_id" => $login_seller_id, "order_status" => 'cancelled'));
							?>
							<a href="#cancelled" data-toggle="tab" class="nav-link make-black">
								<?= $lang['tabs']['cancelled']; ?> <span class="badge badge-success"><?= $count_orders; ?> </span>
								
							</a>
						</li>
						<li class="nav-item">
							
							<?php
													$count_orders = $db->count("orders",array("buyer_id" => $login_seller_id));
							?>
							<a href="#all" data-toggle="tab" class="nav-link make-black">
								<?= $lang['tabs']['all']; ?> <span class="badge badge-success"><?= $count_orders; ?></span>
								
							</a>
							
						</li>
					</ul>
					<div class="tab-content">
						<div class="tab-pane fade show active" id="active">
							<?php require_once("manage_orders/order_active_buying.php") ?>
						</div>
						<div class="tab-pane" id="delivered">
							<?php require_once("manage_orders/order_delivered_buying.php") ?>
						</div>
						<div class="tab-pane" id="completed">
							<?php require_once("manage_orders/order_completed_buying.php") ?>
						</div>
						<div class="tab-pane" id="cancelled">
							<?php require_once("manage_orders/order_cancelled_buying.php") ?>
						</div>
						<div class="tab-pane" id="all">
							<?php require_once("manage_orders/order_all_buying.php") ?>
						</div>
					</div>
				</div>
			</div>
		</div> -->
		<?php require_once("includes/footer.php"); ?>
		<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-TF82RTH"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->
	</body>
</html>