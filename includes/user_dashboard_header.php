<?php 
  require_once("db.php"); 
  require_once("extra_script.php");
  if(!isset($_SESSION['error_array'])){ $error_array = array(); }else{ $error_array = $_SESSION['error_array']; }
  if(isset($_SESSION['seller_user_name'])){
  require_once("seller_levels.php");
  $seller_user_name = $_SESSION['seller_user_name'];
  $get_seller = $db->select("sellers",array("seller_user_name" => $seller_user_name));
  $row_seller = $get_seller->fetch();
  $seller_id = $row_seller->seller_id;
  $seller_email = $row_seller->seller_email;
  $seller_verification = $row_seller->seller_verification;
  $seller_image = $row_seller->seller_image;
  $count_cart = $db->count("cart",array("seller_id" => $seller_id));
  $select_seller_accounts = $db->select("seller_accounts",array("seller_id" => $seller_id));
  $row_seller_accounts = $select_seller_accounts->fetch();
  $current_balance = $row_seller_accounts->current_balance;
  $get_general_settings = $db->select("general_settings");   
  $row_general_settings = $get_general_settings->fetch();
  $enable_referrals = $row_general_settings->enable_referrals;
  $count_active_proposals = $db->count("proposals",array("proposal_seller_id"=>$seller_id,"proposal_status"=>'active'));
  }
  function get_real_user_ip(){
  	/// This is to check ip from shared internet network
  	if(!empty($_SERVER['HTTP_CLIENT_IP'])){
  	$ip = $_SERVER['HTTP_CLIENT_IP'];
  	}
  	/// This is to check ip if it is passing from proxy network
  	elseif(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
  	$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
  	}
  	else{
  	$ip = $_SERVER['REMOTE_ADDR'];
  	}
  	return $ip;
  }
  $ip = get_real_user_ip();

  if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on')   
       $url = "https://";   
  else  
       $url = "http://";   
  // Append the host(domain name, ip) to the URL.   
  $url.= $_SERVER['HTTP_HOST'];   

  // Append the requested resource location to the URL   
  $url.= $_SERVER['REQUEST_URI'];    
  $full_url = $_SERVER['REQUEST_URI'];

  $page_url = substr("$full_url", 15);
?>
<style>
  .activate-email-class #send-email{background-color: #ff0707; border-color: #ff0707;}
  .total-user-count.count.c-notifications-header{right: 13%;}
</style>
<link href="<?php echo $site_url; ?>/styles/scoped_responsive_and_nav.css" rel="stylesheet">
<link href="<?php echo $site_url; ?>/styles/vesta_homepage.css" rel="stylesheet">

<!-- Header -->
<header>
  <div class="header-top dashboard-page">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-6 col-lg-4 col-md-3">
          <div class="logo <?php if(isset($_SESSION["seller_user_name"])){echo"loggedInLogo";} ?>">
            <a href="<?php echo $site_url; ?>/dashboard">
              
              <?php if($site_logo_type == "image"){ ?>
              <img src="<?= $site_url; ?>/assets/img/<?= $site_sticky_logo; ?>">
              <?php }else{ ?>
              <?php echo $site_logo_text; ?>
              <?php } ?>
            </a>
          </div>
        </div>
        <div class="col-6 col-lg-8 col-md-9">
          <div class="header-right d-flex flex-row align-items-center justify-content-end">
            <div class="menu-inner">
              <ul>
                <li><a href="<?= $site_url; ?>/dashboard">Dashboard</a></li>
                <li><a href="<?= $site_url; ?>/proposals/view_proposals">Gigs</a></li>
                <li><a href="<?= $site_url; ?>/requests/buyer_requests">Buyer Request</a></li>
              </ul>
            </div>
            <?php if($language_switcher == 1){ ?>
            <div class="language-inner">
              <select name="" id="" onChange="window.location.href=this.value">
                <option value="" selected="">EN</option>
                <option value="<?= $site_url?>/ar/<?php echo $page_url; ?>">AR</option>
              </select>
            </div>
            <?php } ?>
            <div class="usd-inner">
              <select name="" id="">
                <option value="">USD</option>
                <option value="">EGP</option>
              </select>
            </div>
            <div class="message-inner">
              <a class="message-inner-toggle" href="javascript:void(0);"><img src="<?php echo $site_url; ?>/assets/img/message-2.png" alt="">
                <!-- <span class="total-user-count count c-messages-header"></span> -->
                <span class="total-user-count count c-notifications-header"></span>
              </a>
            </div>
            <div class="menubar menubar-2 d-flex flex-row align-items-center">
              <div class="image">
                <?php if(!empty($seller_image)){ ?>
                <img src="<?php echo $site_url; ?>/user_images/<?php echo $seller_image; ?>" width="32" height="32" class="rounded-circle">
                <?php }else{ ?>
                <img src="<?php echo $site_url; ?>/assets/img/menu-left-logo-2.png">
                <?php } ?>
                <!-- <img src="assets/img/menu-left-logo-2.png" alt=""> -->
              </div>
              <div class="icon">
                <span></span>
                <span></span>
                <span></span>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- Message box -->
      <div class="message-box" style="box-shadow: none;">
        <ul class="nav nav-tabs" id="myTab" role="tablist">
          <li class="nav-item">
            <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">
              <div class="m-item">
                <i class="fal fa-bell"></i>
                Notification
              </div>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">
              <div class="m-item">
                <i class="far fa-comment-alt-dots"></i>
                Inbox
              </div>
            </a>
          </li>
        </ul>
        <div class="tab-content" id="myTabContent">
          <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
            <div class="mesagee-item-box notifications-dropdown">
              <!-- <div class="mesagee-single-item">
                <div class="notifiction-user-img">
                  <img src="assets/img/user3.png" alt="">
                </div>
                <h5><span>snazzydegreat delivered</span> your order</h5>
                <p>1 month ago . <span>Branding Services</span> <i class="fal fa-angle-right"></i></p>
                <div class="notifiction-right">
                  <img src="assets/img/message-img.png" alt="">
                </div>
              </div>
              <div class="mesagee-single-item">
                <div class="notifiction-user-img">
                  <img src="assets/img/user3.png" alt="">
                </div>
                <h5><span>snazzydegreat delivered</span> your order</h5>
                <p>1 month ago . <span>Branding Services</span> <i class="fal fa-angle-right"></i></p>
                <div class="notifiction-right">
                  <img src="assets/img/message-img.png" alt="">
                </div>
              </div>
              <div class="mesagee-single-item">
                <div class="notifiction-user-img">
                  <img src="assets/img/user3.png" alt="">
                </div>
                <h5><span>snazzydegreat delivered</span> your order</h5>
                <p>1 month ago . <span>Branding Services</span> <i class="fal fa-angle-right"></i></p>
                <div class="notifiction-right">
                  <img src="assets/img/message-img.png" alt="">
                </div>
              </div>
              <div class="mesagee-single-item">
                <div class="notifiction-user-img">
                  <img src="assets/img/user3.png" alt="">
                </div>
                <h5><span>snazzydegreat delivered</span> your order</h5>
                <p>1 month ago . <span>Branding Services</span> <i class="fal fa-angle-right"></i></p>
                <div class="notifiction-right">
                  <img src="assets/img/message-img.png" alt="">
                </div>
              </div>
              <div class="mesagee-single-item">
                <div class="notifiction-user-img">
                  <img src="assets/img/user3.png" alt="">
                </div>
                <h5><span>snazzydegreat delivered</span> your order</h5>
                <p>1 month ago . <span>Branding Services</span> <i class="fal fa-angle-right"></i></p>
                <div class="notifiction-right">
                  <img src="assets/img/message-img.png" alt="">
                </div>
              </div> -->
            </div>
          </div>
          <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
            <div class="mesagee-item-box messages-dropdown">
              <!-- <div class="mesagee-single-item">
                <div class="notifiction-user-img">
                  <img src="assets/img/user3.png" alt="">
                </div>
                <h5><span>snazzydegreat delivered</span> your order</h5>
                <p>1 month ago . <span>Branding Services</span> <i class="fal fa-angle-right"></i></p>
                <div class="notifiction-right">
                  <img src="assets/img/message-img.png" alt="">
                </div>
              </div>
              <div class="mesagee-single-item">
                <div class="notifiction-user-img">
                  <img src="assets/img/user3.png" alt="">
                </div>
                <h5><span>snazzydegreat delivered</span> your order</h5>
                <p>1 month ago . <span>Branding Services</span> <i class="fal fa-angle-right"></i></p>
                <div class="notifiction-right">
                  <img src="assets/img/message-img.png" alt="">
                </div>
              </div>
              <div class="mesagee-single-item">
                <div class="notifiction-user-img">
                  <img src="assets/img/user3.png" alt="">
                </div>
                <h5><span>snazzydegreat delivered</span> your order</h5>
                <p>1 month ago . <span>Branding Services</span> <i class="fal fa-angle-right"></i></p>
                <div class="notifiction-right">
                  <img src="assets/img/message-img.png" alt="">
                </div>
              </div>
              <div class="mesagee-single-item">
                <div class="notifiction-user-img">
                  <img src="assets/img/user3.png" alt="">
                </div>
                <h5><span>snazzydegreat delivered</span> your order</h5>
                <p>1 month ago . <span>Branding Services</span> <i class="fal fa-angle-right"></i></p>
                <div class="notifiction-right">
                  <img src="assets/img/message-img.png" alt="">
                </div>
              </div>
              <div class="mesagee-single-item">
                <div class="notifiction-user-img">
                  <img src="assets/img/user3.png" alt="">
                </div>
                <h5><span>snazzydegreat delivered</span> your order</h5>
                <p>1 month ago . <span>Branding Services</span> <i class="fal fa-angle-right"></i></p>
                <div class="notifiction-right">
                  <img src="assets/img/message-img.png" alt="">
                </div>
              </div> -->
            </div>
          </div>
        </div>
        <div class="notification-setting">
          <div class="row align-items-center">
            <div class="col-6">
              <div class="noti-option-icon">
                <button><i class="fal fa-cog"></i></button>
                <button><i class="fal fa-volume-up"></i></button>
              </div>
            </div>
            <div class="col-6 text-right">
              <a href="javascript:void(0);" class="see-all-noti">See All In Notification ></a>
            </div>
          </div>
        </div>
      </div>
      <!-- Message box end -->
    </div>
  </div>
</header>
<!-- Header END-->
<!-- Offcanvas-menu -->
<div class="ofcanvas-menu">
  <div class="close-icon">
    <i class="fal fa-times"></i>
  </div>
  <div class="profile-inner">
    <?php if(!empty($seller_image)){ ?>
    <img src="<?php echo $site_url; ?>/user_images/<?php echo $seller_image; ?>" width="32" height="32" class="rounded-circle">
    <?php }else{ ?>
    <img src="assets/img/user2.png" alt="">
    <?php } ?>
    
    <h4>Welcome back, <span><?php echo $_SESSION['seller_user_name']; ?></span></h4>
  </div>
  <div class="canvs-menu">
    <ul>
      <li><a href="<?php echo $site_url; ?>/<?php echo $_SESSION['seller_user_name']; ?>"> <img src="assets/img/icon/1.png" alt=""> Profile</a></li>
      <li><a href="<?= $site_url; ?>/settings?account_settings"> <img src="assets/img/icon/2.png" alt=""> Setting </a></li>
      <li><a href="<?= $site_url; ?>/dashboard"> <img src="assets/img/icon/12.png" alt=""> Dashboard </a></li>
      <li><a href="<?= $site_url; ?>/proposals/view_proposals"> <img src="assets/img/icon/3.png" alt=""> Gigs</a></li>
      <li><a href="<?= $site_url; ?>/proposals/create_proposal"> <img src="assets/img/icon/13.png" alt=""> Post a Gig</a></li>
      <li><a href="<?= $site_url; ?>/requests/buyer_requests"> <img src="assets/img/icon/14.png" alt=""> Buyers Requests</a></li>
      <li><a href="<?= $site_url ?>/selling_orders"> <img src="assets/img/icon/5.png" alt=""> Orders</a></li>
      <li><a href="<?= $site_url ?>/revenue"> <img src="assets/img/icon/15.png" alt=""> Revenue</a></li>
      <li><a href="<?= $site_url; ?>/portfolio"> <img src="assets/img/icon/16.png" alt=""> Portfolio</a></li>
      <!-- <li><a href="javascript:void(0);"> <img src="assets/img/icon/6.png" alt=""> Purchases</a></li> -->
      <li><a href="<?= $site_url; ?>/invite_friend"> <img src="assets/img/icon/7.png" alt=""> Invite a Friend</a></li>
      <li><a href="<?= $site_url; ?>/conversations/inbox"> <img src="assets/img/icon/indox.png" alt=""> Inbox</a></li>
      <li><a href="<?= $site_url; ?>/how-it-works-seller.php"> <img src="assets/img/icon/how-it-work.png" alt=""> How it works</a></li>
      <li><a href="<?= $site_url; ?>/logout.php"> <img src="assets/img/icon/logout.png" alt=""> Logout</a></li>
    </ul>
  </div>
</div>
<!-- Close-overlay -->
<div class="overlay-bg"></div>
<!-- Offcanvas-menu END-->

<!-- <div id="gnav-header" class="gnav-header global-nav clear gnav-3">
  <header id="gnav-header-inner" class="gnav-header-inner clear apply-nav-height col-group has-svg-icons body-max-width">
    <div class="col-xs-12">
      <div id="gigtodo-logo" class="apply-nav-height gigtodo-logo-svg gigtodo-logo-svg-logged-in <?php if(isset($_SESSION["seller_user_name"])){echo"loggedInLogo";} ?>">
        <a href="<?php echo $site_url; ?>">
        <?php if($site_logo_type == "image"){ ?>
        <img class="desktop" src="<?php echo $site_url; ?>/images/<?php echo $site_logo_image; ?>" width="150">
        <?php }else{ ?>
        <?php echo $site_logo_text; ?>
        <?php } ?>
        </a>
      </div>
      <button id="mobilemenu" class="unstyled-button mobile-catnav-trigger apply-nav-height icon-b-1 tablet-catnav-enabled <?php if(!isset($_SESSION["seller_user_name"])){ echo "left"; } ?>">
        <span class="screen-reader-only"></span>
        <div class="text-gray-lighter text-body-larger">
          <span class="gigtodo-icon hamburger-icon nav-icon">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
              <path d="M20,6H4A1,1,0,1,1,4,4H20A1,1,0,0,1,20,6Z" />
              <path d="M20,13H4a1,1,0,0,1,0-2H20A1,1,0,0,1,20,13Z" />
              <path d="M20,20H4a1,1,0,0,1,0-2H20A1,1,0,0,1,20,20Z" />
            </svg>
          </span>
        </div>
      </button>
      <div class="catnav-search-bar search-browse-wrapper with-catnav">
        <div class="search-browse-inner">
          <form id="gnav-search" class="search-nav expanded-search apply-nav-height" method="post">
            <div class="gnav-search-inner clearable">
              <label for="search-query" class="screen-reader-only">Search for items</label>
              <div class="search-input-wrapper text-field-wrapper">
                <input id="search-query" class="rounded" name="search_query"
                  placeholder="<?php echo $lang['search']['placeholder']; ?>" value="<?php echo @$_SESSION["search_query"]; ?>"  autocomplete="off">
              </div>
              <div class="search-button-wrapper hide">
                <button class="btn btn-primary" name="search" type="submit" value="Search">
                <?php echo $lang['search']['button']; ?>
                </button>
              </div>
            </div>
            <ul class="search-bar-panel d-none"></ul>
          </form>
        </div>
      </div>
      <?php
        if (isset($_POST['search'])) {
            $search_query = $input->post('search_query');
            $_SESSION['search_query'] = $search_query;
            echo "<script>window.open('$site_url/search.php','_self')</script>";
        }
      ?>
      <ul class="account-nav apply-nav-height">
        <?php 
         // require_once("comp/UserMenu.php");
        ?>
      </ul>
    </div>
  </header>
</div> -->

<div class="clearfix"></div>
<?php //require_once("comp/user_nav.php"); ?>
<div class="clearfix"></div>
<?php //include("comp/mobile_menu.php"); ?>

<?php if(isset($_GET['not_available'])) { ?>
<div class="alert alert-danger text-center mb-0 h6">
<!-- Alert to show wrong url or unregistered account start -->
<i class="fa fa-exclamation-circle"></i> The page or user you searched for is no longer available.
</div>
<!-- Alert to show wrong url or unregistered account end -->
<?php } ?>
<?php if(isset($_SESSION['seller_user_name'])) { 
if($seller_verification != "ok"){
?>
<div class="alert alert-warning clearfix activate-email-class mb-0">
<div class="float-left mt-2">
<i style="font-size: 125%;" class="fa fa-exclamation-circle"></i> 
<?php 
$message = $lang['popup']['email_confirm']['text'];
$message = str_replace('{seller_email}', $seller_email, $message);
$message = str_replace('{link}', "$site_url/customer_support", $message);
echo $message;
?>
</div>
<div class="float-right">
<button id="send-email" class="btn btn-success float-right text-white"><?php echo $lang["popup"]["email_confirm"]['button']; ?></button>
</div>
</div>
<script>
$(document).ready(function(){
$("#send-email").click(function(){
$.ajax({
method: "POST",
url: "<?php echo $site_url; ?>/includes/send_email",
success:function(){
$("#send-email").html("Resend Email");
swal({
  type: 'success',
text: 'Confirmation email sent. Please check your email.',
});
}
});
});
});
</script>
<?php  } } ?>