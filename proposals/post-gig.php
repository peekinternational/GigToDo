<?php
session_start();
require_once("../includes/db.php");
// if(!isset($_SESSION['email'])){
// echo "<script>window.open('../login','_self')</script>";
// }
$user_email = $_SESSION['email'];
$login_seller_user_name = $_SESSION['seller_user_name'];
$select_login_seller = $db->select("sellers",array("seller_user_name" => $login_seller_user_name));
$row_login_seller = $select_login_seller->fetch();
$login_seller_id = $row_login_seller->seller_id;
$login_seller_level = $row_login_seller->seller_level;
$login_seller_language = $row_login_seller->seller_language;
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <!--====== Required meta tags ======-->
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <!--====== Title ======-->
  <title><?php echo $site_name; ?> - Post a Gigs</title>
  <!--====== Favicon Icon ======-->
  <?php if(!empty($site_favicon)){ ?>
  <link rel="shortcut icon" href="../images/<?php echo $site_favicon; ?>" type="image/x-icon">
  <?php } ?>
  <!-- ==============Google Fonts============= -->
  <link href="https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&display=swap" rel="stylesheet">
  <!--====== Bootstrap css ======-->
  <link href="<?= $site_url; ?>/assets/css/bootstrap.min.css" rel="stylesheet">
  <!--====== PreLoader css ======-->
  <link href="<?= $site_url; ?>/assets/css/preloader.css" rel="stylesheet">
  <!--====== Animate css ======-->
  <link href="<?= $site_url; ?>/assets/css/animate.min.css" rel="stylesheet">
  <!--====== Fontawesome css ======-->
  <link href="<?= $site_url; ?>/assets/css/fontawesome.min.css" rel="stylesheet">
  <!--====== Owl carousel css ======-->
  <link href="<?= $site_url; ?>/assets/css/owl.carousel.min.css" rel="stylesheet">
  <!--====== Nice select css ======-->
  <link href="<?= $site_url; ?>/assets/css/nice-select.css" rel="stylesheet">
  <!--====== Default css ======-->
  <link href="<?= $site_url; ?>/assets/css/default.css" rel="stylesheet">
  <!--====== Style css ======-->
  <link href="<?= $site_url; ?>/assets/css/style.css" rel="stylesheet">
  <!--====== Responsive css ======-->
  <link href="<?= $site_url; ?>/assets/css/responsive.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote-bs4.css" rel="stylesheet">
  <!-- <link href="../styles/styles.css" rel="stylesheet"> -->
  <!-- <link href="../styles/user_nav_styles.css" rel="stylesheet">
  <link href="../font_awesome/css/font-awesome.css" rel="stylesheet">
  <link href="../styles/owl.carousel.css" rel="stylesheet">
  <link href="../styles/owl.theme.default.css" rel="stylesheet"> -->
  <link href="../styles/tagsinput.css" rel="stylesheet" >
  <link href="../styles/sweat_alert.css" rel="stylesheet">
  <link href="../styles/animate.css" rel="stylesheet">
  <link href="../styles/croppie.css" rel="stylesheet">
  <link href="../styles/create-proposal.css" rel="stylesheet">
  <!-- Optional: include a polyfill for ES6 Promises for IE11 and Android browser -->
  <script src="../js/ie.js"></script>
  <script type="text/javascript" src="../js/sweat_alert.js"></script>
  <script type="text/javascript" src="../js/jquery.min.js"></script>
  <script type="text/javascript" src="../js/croppie.js"></script>
  <script src="https://checkout.stripe.com/checkout.js"></script>
  <style>
    .gig-category-item{
      display: -webkit-box;
      display: -webkit-flex;
      display: -moz-box;
      display: -ms-flexbox;
      display: flex;
      -webkit-flex-wrap: wrap;
      -ms-flex-wrap: wrap;
      flex-wrap: wrap;
      -webkit-flex-basis: 100%;
      -ms-flex-preferred-size: 100%;
      flex-basis: 100%;
      -webkit-box-pack: justify;
      -webkit-justify-content: space-between;
      -moz-box-pack: justify;
      -ms-flex-pack: justify;
      justify-content: space-between;
      max-width: 100%;
      margin: 0;
      -webkit-flex-basis: -webkit-calc(100% - 10px) !important;
      -ms-flex-preferred-size: calc(100% - 10px) !important;
      flex-basis: -moz-calc(100% - 10px) !important;
      flex-basis: calc(100% - 10px) !important;
      max-width: -webkit-calc(100% - 10px) !important;
      max-width: -moz-calc(100% - 10px) !important;
      max-width: calc(100% - 10px) !important;
    }
    .gig-category-select{
      -webkit-flex-basis: -webkit-calc(100% - 10px);
      -ms-flex-preferred-size: calc(100% - 10px);
      flex-basis: -moz-calc(100% - 10px);
      flex-basis: calc1050% - 10px);
      max-width: -webkit-calc(100% - 10px);
      max-width: -moz-calc(100% - 10px);
      max-width: calc(100% - 10px);
    }
    .cat_item-content{
      -webkit-flex-basis: -webkit-calc(50% - 10px) !important;
      -ms-flex-preferred-size: calc(50% - 10px) !important;
      flex-basis: -moz-calc(50% - 10px) !important;
      flex-basis: calc(50% - 10px) !important;
      max-width: -webkit-calc(50% - 10px) !important;
      max-width: -moz-calc(50% - 10px) !important;
      max-width: calc(50% - 10px) !important;
    }
    .cat_item-content.item-active .gig-category-select {
      -webkit-flex-basis: -webkit-calc(50% - 10px);
      -ms-flex-preferred-size: calc(50% - 10px);
      flex-basis: -moz-calc(50% - 10px);
      flex-basis: calc(100% - 0px);
      max-width: -webkit-calc(50% - 10px);
      max-width: -moz-calc(50% - 10px);
      max-width: calc(100% - 0px);
    }
    .postagig .create-gig .form-group .gig-category .cat_item-content.item-active {
      display: -webkit-box;
      display: -webkit-flex;
      display: -moz-box;
      display: -ms-flexbox;
      display: flex;
      -webkit-flex-wrap: wrap;
      -ms-flex-wrap: wrap;
      flex-wrap: wrap;
      -webkit-flex-basis: 100%;
      -ms-flex-preferred-size: 100%;
      flex-basis: 100%;
      -webkit-box-pack: justify;
      -webkit-justify-content: space-between;
      -moz-box-pack: justify;
      -ms-flex-pack: justify;
      justify-content: space-between;
      max-width: 100%;
      margin: 0;
    }
    .postagig .create-gig .form-group .gig-category .cat_item-content.item-active .gig-category-select {
        -webkit-flex-basis: -webkit-calc(100% - 10px);
        -ms-flex-preferred-size: calc(100% - 10px);
        flex-basis: -moz-calc(100% - 10px);
        flex-basis: calc(100% - 10px);
        max-width: -webkit-calc(100% - 10px);
        max-width: -moz-calc(100% - 10px);
        max-width: calc(100% - 10px);
    }
    .postagig .create-gig .form-group .gig-category .cat_item-content.item-active .gig-category-tags {
        -webkit-flex-basis: -webkit-calc(50% - 10px);
        -ms-flex-preferred-size: calc(50% - 10px);
        flex-basis: -moz-calc(50% - 10px);
        flex-basis: calc(50% - 10px);
        margin-bottom: 20px;
        height: auto;
        max-width: -webkit-calc(50% - 10px);
        max-width: -moz-calc(50% - 10px);
        max-width: calc(50% - 10px);
    }
    .postagig .create-gig .form-group .gig-category .cat_item-content.item-removed {
        display: none;
    }
    .postagig .create-gig .form-group .gig-category .cat_item-content.item-active .backto-main {
        display: -webkit-box;
        display: -webkit-flex;
        display: -moz-box;
        display: -ms-flexbox;
        display: flex;
    }
    .bootstrap-tagsinput{
      line-height: 40px;
    }
    #next{
      background-color: #ff0707;
      border: 2px solid #ff0707;
      -webkit-border-radius: 5px;
      -moz-border-radius: 5px;
      border-radius: 5px;
      color: white;
      font-size: 16px;
      font-weight: 600;
      line-height: 45px;
      height: 60px;
      text-transform: uppercase;
      -webkit-transition: all 0.3s ease-in-out 0s;
      -o-transition: all 0.3s ease-in-out 0s;
      -moz-transition: all 0.3s ease-in-out 0s;
      transition: all 0.3s ease-in-out 0s;
      width: 250px;
    }
    .header-top {
      background-color: #fff;
    }
  </style>
</head>

<body class="all-content">

  <!-- Preloader Start -->
  <div class="proloader">
        <div class="loader">
            <img src="<?= $site_url; ?>/assets/img/emongez_cube.png" />
        </div>
    </div>
  <!-- Preloader End -->
  <!-- Header -->
  <header>
    <!-- Post a gig header -->
    <section class="container-fluid header-top post-gig">
      <div class="row">
        <div class="container">
          <div class="row align-items-center">
            <div class="col-12 col-md-3 col-lg-2 d-flex flex-row justify-content-center">
              <div class="logo <?php if(isset($_SESSION["seller_user_name"])){echo"loggedInLogo";} ?>">
                <a href="<?php echo $site_url; ?>">
                  <?php if($site_logo_type == "image"){ ?>
                  <img src="<?= $site_url; ?>/images/<?= $site_logo_image; ?>" alt="" width="150">
                  <?php }else{ ?>
                  <?php echo $site_logo_text; ?>
                  <?php } ?>
                </a>
              </div>
            </div>
            <div class="col-12 col-md-9 col-lg-10">
              <ul class="list-inline d-flex flex-row align-items-center justify-content-center justify-content-md-start post-gig-step">
                <li class="list-inline-item post-gig-step-item d-flex flex-row align-items-center active">
                  <span class="icon">1</span>
                  <span class="text">Join</span>
                </li>
                <li class="list-inline-item post-gig-step-item d-flex flex-row align-items-center">
                  <i class="fal fa-angle-right"></i>
                </li>
                <li class="list-inline-item post-gig-step-item d-flex flex-row align-items-center active" id="post">
                  <span class="icon">2</span>
                  <span class="text">Post</span>
                </li>
                <li class="list-inline-item post-gig-step-item d-flex flex-row align-items-center">
                  <i class="fal fa-angle-right"></i>
                </li>
                <li class="list-inline-item post-gig-step-item d-flex flex-row align-items-center" id="publish_tab">
                  <span class="icon">3</span>
                  <span class="text">Publish</span>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- Post a gig header end -->
  </header>
  <!-- Header END-->
  <!-- Main content -->
  <main>
    <form action="" method="post">
      
    <div class="tab-content">
      <div class="tab-pane fade show active" id="post_gig">
        <section class="container-fluid postagig">
          <div class="row">
            <div class="container">
              <div class="row">
                <div class="col-12">
                  <h2>Post a Gig</h2>
                </div>
              </div>
              <div class="row">
                <div class="col-12 col-lg-8">
                  <div class="row">
                    <div class="col-12 col-md-8">
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
                      <div class="create-gig proposal-form form-field">
                        <div class="form-group">
                          <label class="control-label d-flex flex-row align-items-center">
                            <span>
                              <img alt="" class="img-fluid d-block" src="<?= $site_url; ?>/assets/img/post-a-gig/create-gig-icon.png" />
                            </span>
                            <span>What can you do?</span>
                          </label>
                          <input class="form-control" type="text" name="proposal_title" placeholder="I can..." required="" />
                          <small class="form-text text-danger"><?php echo ucfirst(@$form_errors['proposal_description']); ?></small>
                          <!-- <label class="bottom-label text-right"><span class="descCount">0</span>/2500 Chars Max</label> -->
                          <div class="popup">
                            <img alt="" class="lamp-icon" src="<?= $site_url; ?>/assets/img/post-a-gig/lamp-icon.png" />
                            <img alt="Ask our Community" class="img-fluid d-block" src="<?= $site_url; ?>/assets/img/post-a-gig/ask-our-community.png" width="100%" />
                            <p>Create a catchy title that captivates viewers. Using well known keywords in your title will help your gig stand out in the eyes of buyers.</p>
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="control-label d-flex flex-row align-items-center">
                            <span>
                              <img alt="" class="img-fluid d-block" src="<?= $site_url; ?>/assets/img/post-a-gig/price-icon.png" />
                            </span>
                            <span>For How much?</span>
                          </label>
                          <div class="input-group">
                            <div class="input-group-prepend">
                              <select class="form-control">
                                <option value="1">USD</option>
                                <option value="2">GBP</option>
                              </select>
                            </div>
                            <input class="form-control" type="text" name="proposal_price" min="0" required="" />
                          </div>
                          <div class="popup">
                            <img alt="" class="lamp-icon" src="<?= $site_url; ?>/assets/img/post-a-gig/lamp-icon.png" />
                            <img alt="Ask our Community" class="img-fluid d-block" src="<?= $site_url; ?>/assets/img/post-a-gig/ask-our-community.png" width="100%" />
                            <p>Set an appropriate budget for the quality and quantity of work you produce. Communicate your budget expectations to your buyers clearly from the start through to completion of your order.</p>
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="control-label d-flex flex-row align-items-center">
                            <span>
                              <img alt="" class="img-fluid d-block" src="<?= $site_url; ?>/assets/img/post-a-gig/category-icon.png" />
                            </span>
                            <span>Choose a category</span>
                          </label>
                          <div class="gig-category d-flex flex-wrap align-items-start">
                            <?php 
                              $get_cats = $db->select("categories");
                              while($row_cats = $get_cats->fetch()){
                              
                              $cat_id = $row_cats->cat_id;
                              $cat_icon = $row_cats->cat_icon;
                              $get_meta = $db->select("cats_meta",array("cat_id" => $cat_id,"language_id" => $siteLanguage));
                              $row_meta = $get_meta->fetch();
                              $cat_title = $row_meta->cat_title;
                              
                            ?>

                            <div class="gig-category-item">
                              <?php
                                $get_cats = $db->select("categories");
                                while($row_cats = $get_cats->fetch()){
                                $cat_id = $row_cats->cat_id;
                                $cat_image = $row_cats->cat_image;
                                $cat_icon = $row_cats->cat_icon;

                                $get_meta = $db->select("cats_meta",array("cat_id" => $cat_id,"language_id" => $siteLanguage));
                                $row_meta = $get_meta->fetch();
                                $cat_title = $row_meta->cat_title;

                                if($cat_id == 1){
                                $cat_class= "gd";
                                }elseif ($cat_id == 2) {
                                  $cat_class = "dm";
                                }elseif ($cat_id == 3) {
                                  $cat_class = "wt";
                                }elseif ($cat_id == 4) {
                                  $cat_class = "va";
                                }elseif ($cat_id == 7) {
                                  $cat_class = "ma";
                                }elseif ($cat_id == 6) {
                                  $cat_class = "pt";
                                }elseif($cat_id == 8){
                                  $cat_class= "va";
                                }else{
                                  $cat_class= "ma";
                                }
                                ?>
                                <div class="cat_item-content" data-id="<?= $cat_class; ?>">
                                  <div class="gig-category-select <?php echo $cat_class; ?> d-flex flex-column align-items-center justify-content-between" onclick="categoryItem(<?= $cat_id; ?>);">
                                    
                                    <label for="categoryItem-<?= $cat_id; ?>" class="d-flex flex-column align-items-center justify-content-between">
                                      <input id="categoryItem-<?= $cat_id; ?>" class="cat_value" value="<?= $cat_id; ?>" type="radio" name="proposal_cat_id" hidden required />
                                      <span class="icon">
                                          <img class="img-fluid white-icon" src="<?= $site_url; ?>/assets/img/category/<?= $cat_icon; ?>" width="75" height="75" />
                                          <img class="img-fluid color-icon" src="<?= $site_url; ?>/assets/img/category/<?= $cat_icon; ?>" width="75" height="75" />
                                      </span>
                                      <span class="text"><?= $cat_title; ?></span>
                                    </label>
                                  </div>
                                </div>
                              <?php } ?>

                              <!-- <select class="form-control" name="child_id" required="" style="display: none;">
                                
                              </select> -->
                              <div class="gig-category-tags"  id="sub-category" style="display: none;">
                                
                              </div>
                              <div class="backto-main flex-row">
                                  <a href="javascript:void(0)" class="d-flex flex-row align-items-center">
                                      <span>
                                          <i class="fal fa-angle-left"></i>
                                      </span>
                                      <span>Go Back</span>
                                  </a>
                              </div>
                            </div>
                          <?php } ?>
                          <small class="form-text text-danger"><?php echo ucfirst(@$form_errors['proposal_cat_id']); ?></small>
                            <!-- Each item -->
                          </div>
                          <div class="popup">
                            <img alt="" class="lamp-icon" src="<?= $site_url; ?>/assets/img/post-a-gig/lamp-icon.png" />
                            <img alt="Ask our Community" class="img-fluid d-block" src="<?= $site_url; ?>/assets/img/post-a-gig/ask-our-community.png" width="100%" />
                            <p>
                              Choosing a relevant category and subcategory for your gig will give you the best possible chance of securing buyers.
                            </p>
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="control-label d-flex flex-row align-items-center">
                            <span>
                              <img alt="" class="img-fluid d-block" src="<?= $site_url; ?>/assets/img/post-a-gig/document-icon.png" />
                            </span>
                            <span>What do you need from the buyer to get started?</span>
                          </label>
                          <textarea rows="6" class="form-control text-count" name="proposal_desc" placeholder="I need...." required=""></textarea>
                          <label class="bottom-label text-right"><span class="descCount">0</span>/2500 Chars Max</label>
                          <div class="popup">
                            <img alt="" class="lamp-icon" src="<?= $site_url; ?>/assets/img/post-a-gig/lamp-icon.png" />
                            <img alt="Ask our Community" class="img-fluid d-block" src="<?= $site_url; ?>/assets/img/post-a-gig/ask-our-community.png" width="100%" />
                            <p>
                              Set a few gig requirements for your buyers to complete. This will ensure that you have all the necessary information before you begin working on a project.
                            </p>
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="control-label d-flex flex-row align-items-center">
                            <span>
                              <img alt="" class="img-fluid d-block" src="<?= $site_url; ?>/assets/img/post-a-gig/passage-of-time.png" />
                            </span>
                            <span>when will you deliver the work?</span>
                          </label>
                          <div class="deliver-time d-flex flex-wrap">
                            <?php
                            $get_delivery_times = $db->select("delivery_times");
                            while($row_delivery_times = $get_delivery_times->fetch()){
                            $delivery_id = $row_delivery_times->delivery_id;
                            $delivery_proposal_title = $row_delivery_times->delivery_proposal_title;
                            ?>
                            <label class="deliver-time-item" for="hours<?php echo $delivery_id; ?>">
                              <input id="hours<?php echo $delivery_id; ?>" type="radio" name="delivery_id" value="<?php echo $delivery_id; ?>" hidden required="" />
                              <div class="deliver-time-item-content d-flex flex-column justify-content-center align-items-center">
                                <span class="color-icon">
                                  <span>-</span>
                                  <span>+</span>
                                </span>
                                <span class="d-flex flex-row align-items-end time">
                                  <span><?php echo $delivery_proposal_title; ?></span>
                                  <!-- <span>HRS</span> -->
                                </span>
                              </div>
                            </label>
                            <?php } ?>
                          </div>
                          <small class="form-text text-danger"><?php echo ucfirst(@$form_errors['delivery_id']); ?></small>
                          <div class="popup">
                            <img alt="" class="lamp-icon" src="<?= $site_url; ?>/assets/img/post-a-gig/lamp-icon.png" />
                            <img alt="Ask our Community" class="img-fluid d-block" src="<?= $site_url; ?>/assets/img/post-a-gig/ask-our-community.png" width="100%" />
                            <p>Set realistic deadlines for the work you produce. You can always edit your delivery deadline. Please let your buyer know in advance if you chose to do so.</p>
                          </div>
                        </div>
                        <!--- form-group row Ends --->
                        <?php if($enable_referrals == "yes"){ ?>
                        <div class="form-group">
                          <div class="d-flex flex-column">
                            <!--- form-group row Starts --->
                            <label class="bottom-label">Enable Referrals : </label>
                            <div class="d-flex flex-row mt-10 mb-10">
                              <select name="proposal_enable_referrals" class="proposal_enable_referrals form-control wide">
                                <?php if(@$form_data['proposal_enable_referrals'] == "yes"){ ?>
                                <option value="yes"> Yes </option>
                                <option value="no"> No </option>
                                <?php }else{ ?>
                                <option value="no"> No </option>
                                <option value="yes"> Yes </option>
                                <?php } ?>
                              </select>
                            </div>
                              <small>If enabled, other users can promote your proposal by sharing it on different platforms.</small>
                              <small class="form-text text-danger"><?php echo ucfirst(@$form_errors['proposal_enable_referrals']); ?></small>
                          </div>
                        </div>
                        <!--- form-group row Ends --->
                        <div class="form-group proposal_referral_money">
                          <div class="d-flex flex-column">
                            <!--- form-group row Starts --->
                            <label class="bottom-label">Promotion Commission: </label>
                            <!-- <div class="d-flex flex-row mt-10 mb-10"> -->
                              <input type="number" name="proposal_referral_money" class="form-control" min="1" value="<?php echo @$form_data['proposal_referral_money']; ?>" placeholder="Figure should be in percentage e.g 20">
                              <small>Figure should be in percentage. E.g 20 is the same as 20% from the sale of this proposal.</small>
                              <br>
                              <small> When another user promotes your proposal, how much would you like that user to get from the sale? (in percentage) </small>
                            <!-- </div> -->
                          </div>
                        </div>
                        <!--- form-group row Ends --->
                        <?php } ?>
                        <div class="form-group">
                          <div class="d-flex flex-column">
                            <!--- form-group row Starts --->
                            <label class="bottom-label">Tags</label>
                            <div class="d-flex flex-row mt-10 mb-10">
                              <input type="text" name="proposal_tags" class="form-control" data-role="tagsinput">
                              <small class="form-text text-danger"><?php echo ucfirst(@$form_errors['proposal_tags']); ?></small>
                            </div>
                          </div>
                        </div>
                        <!--- form-group row Ends --->
                        <div class="form-group mb-0">
                          <a class="button btn" id="next">Next</a>
                        </div>
                      </div>
                    </div>
                    <div class="col-12 col-md-4" id="popupWidth"></div>
                  </div>
                </div>
                <div class="col-12 col-lg-4">
                  <div class="howitwork-card">
                    <div class="howitwork-card-title d-flex align-items-center">How it Works</div>
                    <div class="howitwork-list d-flex flex-column">
                      <div class="howitwork-list-item d-flex flex-row align-items-start">
                        <div class="howitwork-list-icon">
                          <img alt="Post a gig" class="img-fluid d-block" src="<?= $site_url; ?>/assets/img/post-a-gig/postagig.png" />
                        </div>
                        <div class="howitwork-list-content">
                          <h3>1. Post A Gig</h3>
                          <p>Create and customise services so that buyers can understand clearly the services you provide in order to meet their requirements.</p>
                        </div>
                      </div>
                      <!-- How it work each item -->
                      <div class="howitwork-list-item d-flex flex-row align-items-start">
                        <div class="howitwork-list-icon">
                          <img alt="Get Hired" class="img-fluid d-block" src="<?= $site_url; ?>/assets/img/post-a-gig/gethired.png" />
                        </div>
                        <div class="howitwork-list-content">
                          <h3>2. Get Hired</h3>
                          <p>Communicate with the buyer to work out the specific details of the project. Once you and the seller agree on the requirements, you can begin working.</p>
                        </div>
                      </div>
                      <!-- How it work each item -->
                      <div class="howitwork-list-item d-flex flex-row align-items-start">
                        <div class="howitwork-list-icon">
                          <img alt="Work" class="img-fluid d-block" src="<?= $site_url; ?>/assets/img/post-a-gig/work.png" />
                        </div>
                        <div class="howitwork-list-content">
                          <h3>3. Work</h3>
                          <p>Once you finish your gig, deliver your awesome work on our platform for your client to approve.</p>
                        </div>
                      </div>
                      <!-- How it work each item -->
                      <div class="howitwork-list-item d-flex flex-row align-items-start">
                        <div class="howitwork-list-icon">
                          <img alt="Get Paid" class="img-fluid d-block" src="<?= $site_url; ?>/assets/img/post-a-gig/getpaid.png" />
                        </div>
                        <div class="howitwork-list-content">
                          <h3>4. Get Paid</h3>
                          <p>When the client approves your professional delivery, your funds will be released into your eMongez account. Keep your funds in your eMongez account or transfer them to your bank account</p>
                        </div>
                      </div>
                      <!-- How it work each item -->
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
      </div>
      <div class="tab-pane fade" id="publish_section">
        <section class="container-fluid publish-gig">
          <div class="row">
            <div class="container">
              <div class="row">
                <div class="col-12">
                  <div class="publish-gig-wrapper">
                    <div class="publish-gig-header text-center">Publish a Gig</div>
                    <div class="publish-gig-body">
                     
                      <div class="d-flex flex-column">
                        <input type="hidden" name="email" value="<?= $user_email; ?>">
                        <div class="form-group d-flex flex-column">
                          <label class="control-label" for="fname">First Name</label>
                          <input class="form-control" id="fname" name="name" type="text" />
                        </div>
                        <!-- Each item -->
                        <div class="form-group d-flex flex-column">
                          <label class="control-label" for="lname">User Name</label>
                          <input class="form-control" id="lname" name="u_name" type="text" />
                          <?php if(in_array("Opps! This username has already been taken. Please try another one", $error_array)) echo "<span style='color:red;'>This username has already been taken. Please try another one.</span> <br>"; ?>
                          <?php if(in_array("Username must be greater that 4 characters long or less than 25 characters.", $error_array)) echo "<span style='color:red;'>Username must be greater that 4 characters or less than 25.</span> <br>"; ?>
                          <?php if(in_array("Foreign characters are not allowed in username, Please try another one.", $error_array)) echo "<span style='color:red;'>Foreign characters are not allowed in username, Please try another one.</span> <br>"; ?>
                        </div>
                        <!-- Each item -->
                        <div class="form-group d-flex flex-column">
                          <label class="control-label" for="password">Password</label>
                          <input class="form-control" id="password" name="pass" type="password" />
                        </div>
                        <!-- Each item -->
                        <div class="form-group d-flex flex-column">
                          <button class="publish-gig-button" name="publish" type="submit">Publish Now</button>
                        </div>
                        <!-- Each item -->
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
      </div>
    </div>
  </form>
  </main>
  <!-- Main content end -->
  
<?php 

function insertPackages($proposal_id){
  global $db;
  $insertPackage1 = $db->insert("proposal_packages",array("proposal_id"=>$proposal_id,"package_name"=>'Basic',"price"=>5));
  $insertPackage2 = $db->insert("proposal_packages",array("proposal_id"=>$proposal_id,"package_name"=>'Standard',"price"=>10));
  $insertPackage3 = $db->insert("proposal_packages",array("proposal_id"=>$proposal_id,"package_name"=>'Advance',"price"=>15));
  if($insertPackage3){return true;}
}

if(isset($_POST['publish'])){

  $rules = array(
  "name" => "required",
  "u_name" => "required",
  "pass" => "required");

  $messages = array("name" => "Full Name Is Required.","u_name" => "User Name Is Required.","pass" => "Password Is Required.");
  $val = new Validator($_POST,$rules,$messages);

  if($val->run() == false){
    $_SESSION['error_array'] = array();
    Flash::add("register_errors",$val->get_all_errors());
    Flash::add("form_data",$_POST);
    echo "<script>window.open('post-gig#publish_section','_self')</script>";
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
    $accountType = 'seller';

    $country = '';
    $regsiter_date = date("F d, Y");
    $date = date("F d, Y");

    $check_seller_username = $db->count("sellers",array("seller_user_name" => $u_name));
    $check_seller_email = $db->count("sellers",array("seller_email" => $email));
    if(preg_match('/[اأإء-ي]/ui', $input->post('u_name'))){
      array_push($error_array, "Foreign characters are not allowed in username, Please try another one.");
    }
    if($check_seller_username > 0 ){
      array_push($error_array, "Opps! This username has already been taken. Please try another one");
    }
    if($check_seller_email > 0){
      array_push($error_array, "Email has already been taken. Try logging in instead.");
    }
    if(empty($error_array)){
      $referral_code = mt_rand();

      if($signup_email == "yes"){
        $verification_code = mt_rand();
      }else{
        $verification_code = "ok";
      }
      $encrypted_password = password_hash($pass, PASSWORD_DEFAULT);
      $insert_seller = $db->insert("sellers",array("seller_name" => $name,"seller_user_name" => $u_name,"seller_email" => $email,"seller_pass" => $encrypted_password,"account_type" => $accountType,"seller_country"=>$country,"seller_level" => 1,"seller_recent_delivery" => 'none',"seller_rating" => 100,"seller_offers" => 10,"seller_referral" => $referral_code,"seller_ip" => $ip,"seller_verification" => $verification_code,"seller_vacation" => 'off',"seller_register_date" => $regsiter_date,"seller_status" => 'online'));

      $regsiter_seller_id = $db->lastInsertId();

        if($insert_seller){
          
          $_SESSION['seller_user_name'] = $u_name;
          $insert_seller_account = $db->insert("seller_accounts",array("seller_id" => $regsiter_seller_id));

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

            $rules = array(
            "proposal_title" => "required",
            "proposal_cat_id" => "required",
            "proposal_child_id" => "required",
            "proposal_tags" => "required",);

            $messages = array("proposal_cat_id" => "you must need to select a category","proposal_child_id" => "you must need to select a child category","proposal_enable_referrals"=>"you must need to enable or disable proposal referrals.");
            $val = new Validator($_POST,$rules,$messages);

            if($val->run() == false){
              Flash::add("form_errors",$val->get_all_errors());
              Flash::add("form_data",$_POST);
              echo "<script> window.open('post-gig#post_gig','_self');</script>";
            }else{
              $proposal_title = $input->post('proposal_title');

              function proposalUrl($string, $space="-"){
                 
                if(preg_match('/[اأإء-ي]/ui', $string)){
                  return urlencode($string);
                }else{
                  $turkcefrom = array("/Ğ/","/Ü/","/Ş/","/İ/","/Ö/","/Ç/","/ğ/","/ü/","/ş/","/ı/","/ö/","/ç/");
                  $turkceto = array("G","U","S","I","O","C","g","u","s","i","o","c");

                  $string = utf8_encode($string);
                  if(function_exists('iconv')) {
                    $string = iconv('UTF-8', 'ASCII//TRANSLIT', $string);
                  }

                  $string = preg_replace("/[^a-zA-Z0-9 \-]/", "", $string);
                  $string = trim(preg_replace("/\\s+/", " ", $string));
                  $string = strtolower($string);
                  $string = str_replace(" ", $space, $string);

                  $string = preg_replace("/[^0-9a-zA-ZÄzÜŞİÖÇğüşıöç]/"," ",$string);
                  $string = preg_replace($turkcefrom,$turkceto,$string);
                  $string = preg_replace("/ +/"," ",$string);
                  $string = preg_replace("/ /","-",$string);
                  $string = preg_replace("/\s/","",$string);
                  $string = strtolower($string);
                  $string = preg_replace("/^-/","",$string);
                  $string = preg_replace("/-$/","",$string);
                  return $string;
               }

              }

              $sanitize_url = proposalUrl($proposal_title);
              $select_proposals = $db->select("proposals",array("proposal_seller_id" => $regsiter_seller_id,"proposal_url" => $sanitize_url));
              $count_proposals = $select_proposals->rowCount();
              if($count_proposals ==  1){
                echo "<script>
                swal({
                type: 'warning',
                text: 'Opps! Your Already Made A Proposal With Same Title Try Another.',
                })</script>";
              }else{
                $proposal_referral_code = mt_rand();
                $get_general_settings = $db->select("general_settings");   
                $row_general_settings = $get_general_settings->fetch();
                $proposal_email = $row_general_settings->proposal_email;
                $site_email_address = $row_general_settings->site_email_address;
                $site_logo = $row_general_settings->site_logo;
                // $data = $input->post();

                $data = array();



                // var_dump($data);die;
                // unset($data['submit']);
                $data['proposal_title'] = $input->post('proposal_title');
                $data['proposal_desc'] = $input->post('proposal_desc');
                $data['proposal_cat_id'] = $input->post('proposal_cat_id');
                $data['proposal_child_id'] = $input->post('proposal_child_id');
                $data['proposal_tags'] = $input->post('proposal_tags');
                $data['proposal_price'] = $input->post('proposal_price');
                $data['delivery_id'] = $input->post('delivery_id');
                
                $data['proposal_url'] = $sanitize_url;
                $data['proposal_seller_id'] = $regsiter_seller_id;
                $data['proposal_featured'] = "no";
                if($enable_referrals == "no"){ 
                $data['proposal_enable_referrals'] = "no"; 
                }

                $data['level_id'] = '1';
                $data['language_id'] = '1';
                $data['proposal_status'] = "draft";
// var_dump($data);die;
                $insert_proposal = $db->insert("proposals",$data);

                if($insert_proposal){

                  $proposal_id = $db->lastInsertId();

                  if($videoPlugin == 1){
                    include("$dir/plugins/videoPlugin/proposals/checkVideo.php");
                  }else{
                    $redirect = "pricing";
                  }

                  insertPackages($proposal_id);

                  echo "<script>
                  swal({
                  type: 'success',
                  text: 'Details Saved.',
                  timer: 2000,
                  onOpen: function(){
                  swal.showLoading()
                  }
                  }).then(function(){
                    window.open('view_proposals','_self')
                  });
                  </script>";
                }
              }

            }
          }
        }
    }
    if(!empty($error_array)){
      $_SESSION['error_array'] = $error_array;
      echo "
      <script>
      swal({
      type: 'error',
      html: $('<div>').text('Opps! There are some errors on the form. Please try again.'),
      animation: false,
      customClass: 'animated tada'
      }).then(function(){
      window.open('post-gig#publish_section','_self')
      });
      </script>";
    }
  }

}

?>
  <script>
    $(document).ready(function(){
      $('.proposal_referral_money').hide();
      <?php if(@$form_data['proposal_enable_referrals'] == "yes"){ ?>
        $('.proposal_referral_money').show();
      <?php } ?>
      $(".proposal_enable_referrals").change(function(){
        var value = $(this).val();
        if(value == "yes"){
          $(".proposal_referral_money input").attr("required","");
          $('.proposal_referral_money').show();
        }else if(value == "no"){
          $(".proposal_referral_money input").removeAttr("required");
          $('.proposal_referral_money').hide();
        }
      });

      <?php if(@$form_data['proposal_child_id']){ ?>
      <?php }else{ ?>
      $("#sub-category").hide();
      <?php } ?>

      
    });

      $(function(){
          $(window).on('load resize', function(){
              var popupWidth = $('#popupWidth').outerWidth();
              $('.popup').css({
                  'width': popupWidth + 30 + 'px'
              });
          });
          $('.gig-category-select').on('click', function(){
              $('.cat_item-content').addClass('item-removed');
              $('.gig-category-item').addClass('item-removed');
              $(this).parents('.cat_item-content').removeClass('item-removed');
              $(this).parents('.cat_item-content').addClass('item-active');
              $(this).parents('.gig-category-item').removeClass('item-removed');
              $(this).parents('.gig-category-item').addClass('item-active');
          });
          $('.gig-category-tag').on('click', function(){
              $(this).toggleClass('tag-selected');
          });
          $('.backto-main').on('click', function(){
              $('.gig-category-item').removeClass('item-active');
              $('.gig-category-item').removeClass('item-removed');
              $('.cat_item-content').removeClass('item-active');
              $('.cat_item-content').removeClass('item-removed');
              $('.gig-category-tag').removeClass('tag-selected');
              $('.gig-category-item').find('input[type="radio"]').prop('checked', false);
          });
          $('.deliver-time-item[for="days30"]').on('click', function(){
              $('.input-number').focus();
          });
          $(".gig-category-select").on('click', function(){
            var cat_class = $(this).parents('.cat_item-content').attr("data-id");
              $(".gig-category-tags").removeAttr('class').addClass('gig-category-tags '+cat_class);
              // $('.gig-category-tags').addClass(cat_class);
          });
      });

      $(".text-count").keydown(function(){
      var textarea = $(".text-count").val();
      $(".descCount").text(textarea.length);  
      }); 

      $(".gig-category-tags  .nice-select.form-control").remove();

      
      $("#sub-category").hide();

      function categoryItem(id){
        $("#sub-category").show();  
        var category_id =  id;
        $.ajax({
        url:"fetch_subcategory",
        method:"POST",
        data:{category_id:category_id},

        success:function(data){
          console.log(data);
        $("#sub-category").html(data);
        }
        });
      }

        $('#next').click(function(){
                $('#post_gig').removeClass('show active');
                $('#publish_section').addClass('show active');
                $('#publish_tab').addClass('active');
              });
        // function validateForm() {
        //   var isValid = true;
        //   $('.form-field').each(function() {
        //     if ( $(this).val() === '' ){
        //          isValid = false;
        //     }else{
              
        //     }
        //   });
        // }
    </script>
  <?php require_once("../includes/footer.php"); ?>
  <script src="../js/tagsinput.js"></script>
</body>
</html>