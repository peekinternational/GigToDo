<?php
session_start();
require_once("../includes/db.php");
require_once("../functions/email.php");
if(!isset($_SESSION['seller_user_name'])){
  echo "<script>window.open('../login','_self');</script>";
}
$login_seller_user_name = $_SESSION['seller_user_name'];
$select_login_seller = $db->select("sellers",array("seller_user_name" => $login_seller_user_name));
$row_login_seller = $select_login_seller->fetch();
$login_seller_id = $row_login_seller->seller_id;
$login_seller_account_type = $row_login_seller->account_type;
require("includes/inboxFunctions.php");
?>
<!DOCTYPE html>
<html dir="rtl" lang="ar" class="ui-toolkit">
<head>
  <title><?php echo $site_name; ?> - <?php echo $lang["titles"]["inbox"]; ?></title>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="<?php echo $site_desc; ?>">
  <meta name="keywords" content="<?php echo $site_keywords; ?>">
  <meta name="author" content="<?php echo $site_author; ?>">
  
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
  <!--====== Range Slider css ======-->
  <link href="<?= $site_url; ?>/ar/assets/css/ion.rangeSlider.min.css" rel="stylesheet">
  <!--====== Default css ======-->
  <link href="<?= $site_url; ?>/ar/assets/css/default.css" rel="stylesheet">
  <!--====== Style css ======-->
  <link href="<?= $site_url; ?>/ar/assets/css/style.css" rel="stylesheet">
  <!--====== Responsive css ======-->
  <link href="<?= $site_url; ?>/ar/assets/css/responsive.css" rel="stylesheet">
  <!-- <link href="../styles/bootstrap.css" rel="stylesheet"> -->
  <!-- <link href="../styles/custom.css" rel="stylesheet">  -->
  <!-- Custom css code from modified in admin panel --->
  <link href="../styles/inbox-style.css" rel="stylesheet"> 
  <!-- Custom css code from modified in admin panel - -->
  <link href="../styles/styles.css" rel="stylesheet">
  <link href="../styles/user_nav_styles.css" rel="stylesheet">
  <link href="../font_awesome/css/font-awesome.css" rel="stylesheet">
  <link href="../styles/sweat_alert.css" rel="stylesheet">
  <link href="../styles/emoji.css" rel="stylesheet">
  <script type="text/javascript" src="../js/sweat_alert.js"></script>
  <script type="text/javascript" src="../js/jquery.min.js"></script>
  <script src="https://checkout.stripe.com/checkout.js"></script>
  <script src="../js/emoji.js<?php echo '?v='.mt_rand(); ?>"></script>
  <?php if(!empty($site_favicon)){ ?>
  <link rel="shortcut icon" href="../images/<?php echo $site_favicon; ?>" type="image/x-icon">
  <?php } ?>
  <style>.media.selected{background-color: #f7f7f7 !important;}.user-status{background: transparent !important; padding: 0 !important; margin-bottom: 0;}.message-sender-area{padding: 0 30px 20px !important;}.header-top{background-color: white;}</style>
</head>
<body class="all-content">
  <?php
    if ($login_seller_account_type == 'seller') {
      require_once("../includes/user_header.php");
    }else{
      require_once("../includes/buyer-header.php");
    }
   // require_once("../includes/user_header-inbox.php"); ?>

  <main>
    <section class="container-fluid messages-wrapper">
      <div class="row">
        <div class="container">
          <div class="messages-container d-flex flex-wrap">
            <?php require_once("includes/sidebar.php"); ?>
            <?php require_once("includes/body.php"); ?>
          </div>
        </div>
      </div>
    </section>
  </main>

<!-- <div class="container-fluid pl-md-5 pr-md-5 p-0">
  <div class="row mr-0 ml-0 mt-sm-0 mt-md-4 mb-md-4 box-inbox">
    <?php //require_once("includes/sidebar.php"); ?>
    <?php //require_once("includes/body.php"); ?>
  </div>
</div> -->
<!-- Preloader Start -->
  <div class="proloader">
    <div class="loader">
      <img src="<?= $site_url; ?>/assets/img/emongez_cube.png" />
    </div>
  </div>
  <!-- Preloader End -->
<div id="upload_file_div"></div>
<div id="accept-offer-div"></div>
<div id="send-offer-div"></div>
<?php require_once("includes/javascript.php"); ?>
<?php require_once("../includes/footerInbox.php"); ?>
</body>
</html>