<?php
session_start();
require_once("../../includes/db.php");
if(!isset($_SESSION['seller_user_name'])){
echo "<script>window.open('../../login','_self')</script>";
}

$login_seller_user_name = $_SESSION['seller_user_name'];
$select_login_seller = $db->select("sellers",array("seller_user_name" => $login_seller_user_name));
$row_login_seller = $select_login_seller->fetch();
$login_seller_id = $row_login_seller->seller_id;
$message_group_id = $input->post('message_group_id');

$get_inbox_sellers = $db->select("inbox_sellers",array("message_group_id" => $message_group_id));
$row_inbox_sellers = $get_inbox_sellers->fetch();
$offer_id = $row_inbox_sellers->offer_id;
$sender_id = $row_inbox_sellers->sender_id;
$receiver_id = $row_inbox_sellers->receiver_id;
if($login_seller_id == $sender_id){
	$seller_id = $receiver_id;
}else{
	$seller_id = $sender_id;
}

$update_inbox_sellers = $db->update("inbox_sellers",array("message_status" => 'read'),array("receiver_id" => $login_seller_id,"message_status" => 'unread',"message_group_id" => $message_group_id));
$update_inbox_messages = $db->update("inbox_messages",array("message_status" => 'read'),array("message_receiver" => $login_seller_id,"message_status" => 'unread',"message_group_id" => $message_group_id));

$past_orders = $db->query("select * from orders where (seller_id='$seller_id' AND buyer_id='$login_seller_id') or (seller_id='$login_seller_id' AND buyer_id='$seller_id')");
$count_orders = $past_orders->rowCount();

$select_seller = $db->select("sellers",array("seller_id" => $seller_id));
$row_seller = $select_seller->fetch();
$seller_account_type = $row_seller->account_type;
$seller_image = $row_seller->seller_image;
$user_name = $row_seller->seller_user_name;
$seller_level = $row_seller->seller_level;
$seller_vacation = $row_seller->seller_vacation;
$seller_country = $row_seller->seller_country;
$seller_recent_delivery = $row_seller->seller_recent_delivery;
$seller_status = $row_seller->seller_status;
$seller_rating = $row_seller->seller_rating;
@$level_title = $db->select("seller_levels_meta",array("level_id"=>$seller_level,"language_id"=>$siteLanguage))->fetch()->title;

$count_active_proposals = $db->count("proposals",array("proposal_seller_id"=>$login_seller_id,"proposal_status"=>'active'));

?>
<!-- New Design -->
<div class="message-body-container d-flex flex-wrap">
	<div class="col-md-8 pr-0 pl-0 <?=($lang_dir == "right" ? 'order-2 order-sm-1 pl-0 pr-3':'pr-lg-0 ')?>">
		<div class="message-content d-flex flex-row" style="max-width: calc(100% - 0px)">
			<div class="message-content-card">
				<?php require_once("display_messages.php"); ?>
			</div>
			<?php require_once("sendMessage.php"); ?>
			<?php require_once("sendMessageJs.php"); ?>
		</div>
	</div>
	<div class="col-md-4 pl-0 pr-0 <?=($lang_dir == "right" ? 'order-1 order-sm-2 pr-0 border-right':'pl-0 border-left')?>" id="msgSidebar">
		<div class="message-about d-flex flex-column">
			<div class="message-about-header">
				<h4>عن</h4>
				<?php if($seller_account_type == "seller"){ ?>
				<div class="d-flex flex-column align-items-center justify-content-center">
					<div class="message-about-user">
						<a href="<?= $site_url; ?>/ar/<?= $user_name; ?>">
							<?php if(!empty($seller_image)){ ?>
							<img src="<?= $site_url; ?>/user_images/<?= $seller_image; ?>" width="80" class="rounded-circle">
							<?php }else{ ?>
							<img src="<?= $site_url; ?>/assets/img/emongez_cube.png" />
							<?php } ?>
						</a>
					</div>
					<div class="username"><a href="<?= $site_url; ?>/<?= $user_name; ?>" style="color: #1b1b1b;"><?= ucfirst($user_name); ?></a></div>
				</div>
				<?php }else{ ?>
				<div class="d-flex flex-column align-items-center justify-content-center">
					<div class="message-about-user">
						<a href="<?= $site_url; ?>/ar/profile?user_name=<?= $user_name; ?>">
							<?php if(!empty($seller_image)){ ?>
							<img src="<?= $site_url; ?>/user_images/<?= $seller_image; ?>" width="80" class="rounded-circle">
							<?php }else{ ?>
							<img src="<?= $site_url; ?>/assets/img/emongez_cube.png" />
							<?php } ?>
						</a>
					</div>
					<div class="username"><a href="<?= $site_url; ?>/profile?user_name=<?= $user_name; ?>" style="color: #1b1b1b;"><?= ucfirst($user_name); ?></a></div>
				</div>
				<?php } ?>
			</div>
			<div class="message-about-body">
				<div class="message-about-body-item d-flex flex-row justify-content-between align-items-center">
					<div class="title d-flex flex-row align-items-center">
						<span>
							<img src="<?= $site_url; ?>/assets/img/messages/icon-star.png" />
						</span>
						<span>تقييم</span>
					</div>
					<div class="item-value d-flex flex-row align-items-center">
						<!-- <span class="color-yellow">
							<i class="fas fa-star"></i>
							4.9
						</span> -->
						<span><?= $seller_rating; ?>%</span>
					</div>
				</div>
				<!-- Each item -->
				<div class="message-about-body-item d-flex flex-row justify-content-between align-items-center">
					<div class="title d-flex flex-row align-items-center">
						<span>
							<img src="<?= $site_url; ?>/assets/img/messages/icon-skills.png" />
						</span>
						<span>من عند</span>
					</div>
					<div class="item-value d-flex flex-row align-items-center">
						<span><?= $seller_country; ?></span>
					</div>
				</div>
				<!-- Each item -->
				<div class="message-about-body-item d-flex flex-row justify-content-between align-items-center">
					<div class="title d-flex flex-row align-items-center">
						<span>
							<img src="<?= $site_url; ?>/assets/img/messages/icon-language.png" />
						</span>
						<span>التسليم الأخير</span>
					</div>
					<div class="item-value d-flex flex-row align-items-center">
						<span><?= $seller_recent_delivery; ?></span>
					</div>
				</div>
				<!-- Each item -->
				<div class="message-about-body-item d-flex flex-row justify-content-between align-items-center">
					<div class="title d-flex flex-row align-items-center">
						<span>
							<img src="<?= $site_url; ?>/assets/img/messages/icon-language.png" />
						</span>
						<span>اللغات</span>
					</div>
					<div class="item-value d-flex flex-row align-items-center">
						<?php
						$select_languages_relation = $db->select("languages_relation",array("seller_id"=>$seller_id));
						while($row_languages_relation = $select_languages_relation->fetch()){
							$language_id = $row_languages_relation->language_id;
							$get_languages = $db->select("seller_languages",array("language_id"=>$language_id));
							$row_languages = $get_languages->fetch();
							$language_title = @$row_languages->language_title;
						?>
						<span><?= ucfirst($language_title); ?>,</span>
						<?php } ?>
					</div>
				</div>
				<!-- Each item -->
			</div>
		</div>
	</div>
</div>
<!-- End New Design -->


<!-- <div class="col-md-8 <?=($lang_dir == "right" ? 'order-2 order-sm-1 pl-0 pr-3':'pr-lg-0 ')?>">
	<ul class="list-unstyled messages <?=($lang_dir == "right" ? 'direction-rtl':'')?>">
		<?php //require_once("display_messages.php"); ?>
	</ul>
	<?php //require_once("sendMessage.php"); ?>
	<?php //require_once("sendMessageJs.php"); ?>
</div>
<div class="col-md-4 <?=($lang_dir == "right" ? 'order-1 order-sm-2 pr-0 border-right':'pl-0 border-left')?>" id="msgSidebar">
	<h5 class="pt-3 p-2">Orders</h5>
	<div class="dropdown">
		<a class="lead text-muted p-2 pt-0" href="#" role="button" data-toggle="dropdown">Past Orders (<?= $count_orders; ?>)</a>
		<div class="dropdown-menu pt-1 pb-1">
			<a href="../buying_history?buyer_id=<?= $seller_id; ?>" class="dropdown-item">Buying History</a>
			<a href="../selling_history?seller_id=<?= $seller_id; ?>" class="dropdown-item">Selling History</a>
		</div>
	</div>
	<hr>
	<h5 class="pb-0 p-2">About</h5>
	<center class="mb-3">
		<?php if(!empty($seller_image)){ ?>
		<img src="../user_images/<?= $seller_image; ?>" width="50" class="rounded-circle">
		<?php }else{ ?>
		<img src="../user_images/empty-image.png" width="50" class="rounded-circle">
		<?php } ?>
		<a class="text-center" href="../<?= $seller_user_name; ?>">
			<h6 class="mb-0 mt-2"><?= ucfirst($seller_user_name); ?></h6>
		</a>
		<p class="text-muted text-center"><?= $level_title; ?></p>
	</center>
	<div class="row p-3">
		<div class="col-md-6">
			<p><i class="fa fa-star pr-1"></i> Rating </p>
			<p><i class="fa fa-globe pr-1"></i> From</p>
			<p><i class="fa fa-truck pr-1"></i> Last delivery</p>
			<?php
			$select_languages_relation = $db->select("languages_relation",array("seller_id"=>$seller_id));
			while($row_languages_relation = $select_languages_relation->fetch()){
				$language_id = $row_languages_relation->language_id;
				$get_languages = $db->select("seller_languages",array("language_id"=>$language_id));
				$row_languages = $get_languages->fetch();
				$language_title = @$row_languages->language_title;
			?>
			<p> <i class="fa fa-language pr-1"></i> <?= $language_title; ?></p>
			<?php } ?>
		</div>
		<div class="col-md-6 text-right">
			<p class="font-weight-bold"><?= $seller_rating; ?>%</p>
			<p class="font-weight-bold"><?= $seller_country; ?></p>
			<p class="font-weight-bold"><?= $seller_recent_delivery; ?></p>
			<?php
			$select_languages_relation = $db->select("languages_relation",array("seller_id"=>$seller_id));
			while($row_languages_relation = $select_languages_relation->fetch()){
			$language_level = $row_languages_relation->language_level;
			?>
			<p class="font-weight-bold"><?= ucfirst($language_level); ?></p>
			<?php } ?>
		</div>		
	</div>
</div> -->
<?php require_once("reportModal.php"); ?>