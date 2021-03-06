<?php
  session_start();
  
  require_once("../includes/db.php");
  
  if(!isset($_SESSION['seller_user_name'])){
  
  echo "<script>window.open('../login','_self')</script>";
  
  }
  
  $login_seller_user_name = $_SESSION['seller_user_name'];
  $select_login_seller = $db->select("sellers",array("seller_user_name" => $login_seller_user_name));
  $row_login_seller = $select_login_seller->fetch();
  $login_seller_id = $row_login_seller->seller_id;
  $login_seller_offers = $row_login_seller->seller_offers;
  $login_seller_image = $row_login_seller->seller_image;
  
  $request_cat_ids = array();
  // $select_proposals = $db->query("select DISTINCT proposal_child_id from proposals where proposal_seller_id='$login_seller_id' and proposal_status='active'");
  $select_proposals = $db->query("select DISTINCT proposal_cat_id from proposals where proposal_seller_id='$login_seller_id' and proposal_status='active'");
  while($row_proposals = $select_proposals->fetch()){
   $proposal_cat_id = $row_proposals->proposal_cat_id;
   array_push($request_cat_ids, $proposal_cat_id);
  }
  
  $where_cat_id = array();
  foreach($request_cat_ids as $cat_id){
   $where_cat_id[] = "cat_id=" . $cat_id; 
  }
  
  if(count($where_cat_id) > 0){
   $requests_query = " and (" . implode(" or ", $where_cat_id) . ")";
   $child_cats_query = "(" . implode(" or ", $where_cat_id) . ")";
  }
  $relevant_requests = $row_general_settings->relevant_requests;
  
  ?>
<!DOCTYPE html>
<html lang="en" class="ui-toolkit">
  <head>
    <title><?php echo $site_name; ?> - Recent Buyer Requests.</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="<?php echo $site_desc; ?>">
    <meta name="keywords" content="<?php echo $site_keywords; ?>">
    <meta name="author" content="<?php echo $site_author; ?>">
    <?php if(!empty($site_favicon)){ ?>
    <!--====== Favicon Icon ======-->
    <link rel="shortcut icon" href="../images/<?= $site_favicon; ?>" type="image/png">
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
    <!--====== Range Slider css ======-->
    <link href="<?= $site_url; ?>/ar/assets/css/ion.rangeSlider.min.css" rel="stylesheet">
    <!--====== Default css ======-->
    <link href="<?= $site_url; ?>/ar/assets/css/default.css" rel="stylesheet">
    <!--====== Style css ======-->
    <link href="<?= $site_url; ?>/ar/assets/css/style.css" rel="stylesheet">
    <!--====== Responsive css ======-->
    <link href="<?= $site_url; ?>/ar/assets/css/responsive.css" rel="stylesheet">

    <!-- <link href="../styles/bootstrap.css" rel="stylesheet">
    <link href="../styles/custom.css" rel="stylesheet"> -->
    <!-- Custom css code from modified in admin panel --->
    <link href="../styles/styles.css" rel="stylesheet">
    <!-- <link href="../styles/user_nav_styles.css" rel="stylesheet"> -->
    <!-- <link href="../font_awesome/css/font-awesome.css" rel="stylesheet"> -->
    <link href="../styles/sweat_alert.css" rel="stylesheet">
    <script type="text/javascript" src="../js/sweat_alert.js"></script>
    <script type="text/javascript" src="../js/jquery.min.js"></script>
    <style>.attachment a{color: #ff0707;}</style>
    <style>
      .modal-body .request-proposals-list .proposal-title{margin-right: 135px;}
      @media(min-width: 767px){
        .page-height{
          position: relative;
          min-height: 80%;
        }
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
  <?php require_once("../includes/user_header.php"); ?>
  <main class="page-height">
    <section class="container-fluid list-page">
      <div class="row">
        <div class="container">
          <div class="row align-items-start">
            <div class="col-12 col-sm-6">
              <h1 class="list-page-title">
                المشريع
              </h1>
            </div>
            <div class="col-12 col-sm-6 d-flex flex-column flex-sm-row justify-content-end">
              <a class="button button-red" href="../proposals/create_proposal">
                انشر خدمة
              </a>
            </div>
          </div>
          <!-- Row -->
          <div class="list-page-filter">
            <div class="row flex-md-row-reverse">
              <div class="col-12 col-md-6">
                <select id="sub-category" class="form-control float-left sort-by">
                  <option value="all"> جميع الفئات </option>
                  <?php
                    if(count($where_cat_id) > 0){
                    $get_c_cats = $db->query("select * from categories where ".$child_cats_query);
                    while($row_c_cats = @$get_c_cats->fetch()){
                    $cat_id = $row_c_cats->cat_id;
                    $get_meta = $db->select("cats_meta",array("cat_id" => $cat_id, "language_id" => $siteLanguage));
                    $row_meta = $get_meta->fetch();
                    $cat_title = $row_meta->cat_title;
                    $arabic_title = $row_meta->arabic_title;
                    echo "<option value='$cat_id'> $arabic_title </option>";
                    }
                    }
                    ?>
                </select>
                <!-- <ul class="pagination">
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
                </ul> -->
              </div>
              <div class="col-12 col-md-6">
                <nav class="list-page-nav">
                  <div class="nav nav-tabs" id="nav-tab" role="tablist">
                    <a class="nav-item nav-link limerick active" id="active-tab" data-toggle="tab" href="#nav-active" role="tab" aria-controls="nav-active" aria-selected="true"> جديد<span class="badge">
                      <?php 
                        $i_requests = 0;
                        $i_send_offers = 0;
                        if($relevant_requests == "no"){ $requests_query = ""; }
                        if(!empty($requests_query) or $relevant_requests == "no"){
                        $get_requests = $db->query("select * from buyer_requests where request_status='active'" . $requests_query . " AND NOT seller_id='$login_seller_id' order by request_id DESC");
                        while($row_requets = $get_requests->fetch()){
                        $request_id = $row_requets->request_id;
                        $count_offers = $db->count("send_offers",array("request_id" => $request_id,"sender_id" => $login_seller_id));
                        if($count_offers == 1){
                        $i_send_offers++;
                        }
                        $i_requests++;
                        }
                        }
                      ?>
                      <?php echo $i_requests-$i_send_offers; ?>
                    </span></a>
                    <?php $count_offers = $db->count("send_offers",array("sender_id" => $login_seller_id)); ?>
                    <a class="nav-item nav-link selective-yellow" id="paused-tab" data-toggle="tab" href="#nav-paused" role="tab" aria-controls="nav-paused" aria-selected="false">بعت عرض <span class="badge"><?php echo $count_offers; ?></span></a>
                  </div>
                </nav>
              </div>
            </div>
            <!-- Row -->
          </div>
          <div class="row">
            <div class="col-12">
              <div class="tab-content" id="nav-tabContent">
                <div class="tab-pane fade show active" id="nav-active" role="tabpanel" aria-labelledby="active-tab">
                  <table class="table managerequest-table limerick" cellpadding="0" cellspacing="0" border="0">
                    <thead>
                      <tr role="row">
                        <th role="column">
                          المشترى
                        </th>
                        <th role="column">
                          الطلب
                        </th>
                        <th role="column">العروض</th>
                        <th role="column">
                          التسليم
                        </th>
                        <th role="column">
                          الميزانية
                        </th>
                      </tr>
                    </thead>
                    <tbody id="load-data">
                      <?php 
                        if(!empty($requests_query) or $relevant_requests == "no"){
                        $select_requests = $db->query("select * from buyer_requests where request_status='active'".$requests_query." AND NOT seller_id='$login_seller_id' order by 1 DESC");
                        $count_requests = $select_requests->rowCount();
                        while($row_requests = $select_requests->fetch()){
                        $request_id = $row_requests->request_id;
                        $seller_id = $row_requests->seller_id;
                        $cat_id = $row_requests->cat_id;
                        $child_id = $row_requests->child_id;
                        $request_title = $row_requests->request_title;
                        $request_description = $row_requests->request_description;
                        $delivery_time = $row_requests->delivery_time;
                        $request_budget = $row_requests->request_budget;
                        $request_file = $row_requests->request_file;
                        $request_date = $row_requests->request_date;
                        $get_meta = $db->select("cats_meta",array("cat_id" => $cat_id, "language_id" => $siteLanguage));
                        $row_meta = $get_meta->fetch();
                        $cat_title = $row_meta->cat_title;
                        $get_meta = $db->select("child_cats_meta",array("child_id" => $child_id, "language_id" => $siteLanguage));
                        $row_meta = $get_meta->fetch();
                        $child_title = $row_meta->child_title;
                        $select_request_seller = $db->select("sellers",array("seller_id" => $seller_id));
                        $row_request_seller = $select_request_seller->fetch();
                        $request_seller_user_name = $row_request_seller->seller_user_name;
                        $request_seller_image = $row_request_seller->seller_image;
                        $count_send_offers = $db->count("send_offers",array("request_id" => $request_id));
                        $count_offers = $db->count("send_offers",array("request_id" => $request_id,"sender_id" => $login_seller_id));
                        if($count_offers == 0){
                        ?>
                      <tr role="row">
                        <td data-label="المشترى">
                          <div class="d-flex flex-column align-items-center">
                            <div class="buyer-image">
                              <?php if(!empty($request_seller_image)){ ?>
                              <img alt class="img-fluid d-block request-img rounded-circle" src="<?= $site_url; ?>/user_images/<?php echo $request_seller_image; ?>" />
                              <?php }else{ ?>
                              <img alt class="img-fluid d-block" src="<?= $site_url; ?>/assets/img/emongez_cube.png" />
                              <?php } ?>
                            </div>
                            <div class="buyer-id"><?php echo $request_seller_user_name; ?></div>
                            <span><?php echo $request_date; ?></span>
                          </div>
                        </td>
                        <td data-label="الطلب">
                          <p><?php echo $request_description; ?></p>
                          <div class="attachment d-flex flex-row align-items-center">
                            <?php if(!empty($request_file)){ ?>
                            <a href="<?= $site_url; ?>/request_files/<?php echo $request_file; ?>" download>
                            <span><i class="fal fa-paperclip"></i></span> <span><?php echo $request_file; ?></span>
                            </a>
                            <?php } ?>
                          </div>
                          <div class="tags">
                            <a href="javascript:void(0);" class="taga-item"><?php echo $cat_title; ?></a>
                            <a href="javascript:void(0);" class="taga-item"><?php echo $child_title; ?></a>
                          </div>
                        </td>
                        <td data-label="العروض">
                          <div class="offers-button">
                            <?php echo $count_send_offers; ?> عروض
                          </div>
                        </td>
                        <td data-label="التسليم">
                          <?php echo $delivery_time; ?>
                        </td>
                        <td data-label="الميزانية">
                          <div class="d-flex flex-column">
                            <?php if(!empty($request_budget)){ ?> 
                            <span><?php if ($to == 'EGP'){ echo $to.' '; echo $request_budget;}elseif($to == 'USD'){  echo $to.' '; echo round($cur_amount * $request_budget,2);}else{  echo $s_currency.' '; echo $request_budget; } ?></span>
                            <?php }else{ ?> ----- <?php } ?>
                            <?php if($login_seller_offers == "0"){ ?>
                              <a class="send-offer send_button_<?php echo $request_id; ?>" data-toggle="modal" data-target="#quota-finish">ابعت عرض   </a>
                            <!-- <button class="btn btn-success btn-sm mt-4 send_button_<?php echo $request_id; ?>" data-toggle="modal" data-target="#quota-finish">Send Offer</button> -->
                            <?php }else{ ?>
                              <a class="send-offer send_button_<?php echo $request_id; ?>">ابعت عرض   </a>
                            <!-- <button class="btn btn-success btn-sm mt-4 send_button_<?php echo $request_id; ?>">Send Offer</button> -->
                            <?php } ?>
                          </div>
                        </td>
                        <script>
                          $(".remove_request_<?php echo $request_id; ?>").click(function(event){
                          event.preventDefault();
                          $("#request_tr_<?php echo $request_id; ?>").fadeOut().remove();
                          });
                          <?php if($login_seller_offers == "0"){ ?>
                          <?php }else{ ?>
                          $(".send_button_<?php echo $request_id; ?>").click(function(){
                          request_id = "<?php echo $request_id; ?>";
                          $.ajax({
                          method: "POST",
                          url: "send_offer_modal",
                          data: {request_id: request_id}
                          })
                          .done(function(data){
                          $(".append-modal").html(data);
                          });
                          });
                          <?php } ?>
                        </script>
                      </tr>
                      <?php } } } ?>
                    </tbody>
                  </table>
                  <?php
                    if(empty($count_requests)){
                    echo"<center><h3 class='pb-4 pt-4'><i class='fa fa-frown-o'></i> لا توجد طلبات تطابق أي من مقترحاتك / خدماتك حتى الآن!</h3></center>";
                    }
                  ?>
                </div>
                <div class="tab-pane fade" id="nav-paused" role="tabpanel" aria-labelledby="paused-tab">
                  <table class="table managerequest-table selective-yellow" cellpadding="0" cellspacing="0" border="0">
                    <thead>
                      <tr role="row">
                        <th role="column" style="display: none;">
                          تاجر
                        </th>
                        <th role="column">عرض</th>
                        <!-- <th role="column">العروض</th> -->
                        <th role="column">
                          التسليم
                        </th>
                        <th role="column">
                          الميزانية
                        </th>
                        <th role="column">
                          الطلب
                        </th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                        $select_offers = $db->select("send_offers",array("sender_id"=>$login_seller_id),"DESC");
                        $count_offers = $select_offers->rowCount();
                        while($row_offers = $select_offers->fetch()){
                        $request_id = $row_offers->request_id;
                        $proposal_id = $row_offers->proposal_id;
                        $description = $row_offers->description;
                        $delivery_time = $row_offers->delivery_time;
                        $amount = $row_offers->amount;
                        $select_proposals = $db->select("proposals",array("proposal_id" => $proposal_id));
                        $row_proposals = $select_proposals->fetch();
                        $proposal_title = @$row_proposals->proposal_title;
                        $get_requests = $db->select("buyer_requests",array("request_id"=>$request_id));
                        $row_requests = $get_requests->fetch();
                        $request_id = $row_requests->request_id;
                        $seller_id = $row_requests->seller_id;
                        $cat_id = $row_requests->cat_id;
                        $child_id = $row_requests->child_id;
                        $request_title = $row_requests->request_title;
                        $request_description = $row_requests->request_description;
                        $get_meta = $db->select("cats_meta",array("cat_id" => $cat_id, "language_id" => $siteLanguage));
                        $row_meta = $get_meta->fetch();
                        $cat_title = $row_meta->cat_title;
                        $get_meta = $db->select("child_cats_meta",array("child_id" => $child_id, "language_id" => $siteLanguage));
                        $row_meta = $get_meta->fetch();
                        $child_title = $row_meta->child_title;
                        $select_request_seller = $db->select("sellers",array("seller_id" => $seller_id));
                        $row_request_seller = $select_request_seller->fetch();
                        $request_seller_user_name = $row_request_seller->seller_user_name;
                        $request_seller_image = $row_request_seller->seller_image;
                      ?>
                      <tr role="row">
                        <td data-label="المشترى  " style="display: none;">
                          <div class="d-flex flex-column align-items-center">
                            <div class="buyer-image">
                              <?php if(!empty($login_seller_image)){ ?>
                              <img alt class="img-fluid d-block request-img rounded-circle" src="<?= $site_url; ?>/user_images/<?php echo $login_seller_image; ?>" />
                              <?php }else{ ?>
                              <img alt class="img-fluid d-block" src="<?= $site_url; ?>/assets/img/emongez_cube.png" />
                              <?php } ?>
                            </div>
                            <div class="buyer-id"><?php echo $login_seller_user_name; ?></div>
                            <!-- <span><?php echo $request_date; ?></span> -->
                          </div>
                        </td>
                        <td data-label="الطلب">
                          <p><?php echo $description; ?></p>
                          
                        </td>
                        <!-- <td data-label="العروض">
                          <div class="offers-button">
                            4 عروض
                          </div>
                        </td> -->
                        <td data-label="التسليم"><?php echo $delivery_time; ?></td>
                        <td data-label="الميزانية">
                          <div class="d-flex flex-column">
                            <span><?php if ($to == 'EGP'){ echo $to.' '; echo $amount;}elseif($to == 'USD'){  echo $to.' '; echo round($cur_amount * $amount,2);}else{  echo $s_currency.' '; echo $amount; } ?></span>
                            
                          </div>
                        </td>
                        <td data-label="لمشترى ">
                          <div class="d-flex flex-column align-items-center">
                            <div class="buyer-image">
                              <?php if(!empty($request_seller_image)){ ?>
                              <img alt class="img-fluid d-block request-img rounded-circle" src="<?= $site_url; ?>/user_images/<?php echo $request_seller_image; ?>" />
                              <?php }else{ ?>
                              <img alt class="img-fluid d-block" src="<?= $site_url; ?>/assets/img/emongez_cube.png" />
                              <?php } ?>
                            </div>
                            <strong> <?php echo $request_seller_user_name; ?></strong>
                          </div>
                            <p>
                              <?php echo $request_description; ?>
                            </p>
                            <div class="attachment d-flex flex-row">
                            <?php if(!empty($request_file)){ ?>
                            <a href="request_files/<?php echo $request_file; ?>" download>
                            <span><i class="fal fa-paperclip"></i></span> <span><?php echo $request_file; ?></span>
                            </a>
                            <?php } ?>
                            <!-- <span><i class="fal fa-paperclip"></i></span>
                            <span>attatchme...jpg</span>
                            <span>(1048KB)</span> -->
                          </div>
                          <div class="tags">
                            <a href="javascript:void(0);" class="taga-item"><?php echo $cat_title; ?></a>
                            <a href="javascript:void(0);" class="taga-item"><?php echo $child_title; ?></a>
                          </div>
                          
                        </td>
                      </tr>
                      <?php } ?>
                    </tbody>
                  </table>
                  <?php
                    if($count_offers == 0){
                    echo"<center><h3 class='pb-4 pt-4'><i class='fa fa-meh-o'></i> لم ترسل أي عروض حتى الآن!</h3></center>";
                    }
                  ?>
                </div>
              </div>
            </div>
            <div class="col-12 d-flex flex-row justify-content-end">
              <a class="offer-left" href="javascript:void(0);">
                <span><i class="fas fa-exclamation-circle"></i></span>
                <span>
                  <?php echo $login_seller_offers; ?> عروض موجودة النهاردة
                </span>
              </a>
            </div>
          </div>
          <!-- Row -->
        </div>
      </div>
      <!-- Row -->
    </section>
    <div class="append-modal"></div>
    <div id="quota-finish" class="modal fade">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title h5"><i class="fa fa-frown-o fa-move-up"></i> Request Quota Reached</h5>
            <button class="close" data-dismiss="modal"> &times; </button>
          </div>
          <div class="modal-body">
            <center>
              <h5>You can only send a max of 10 offers per day. Today you've maxed out. Try again tomorrow. </h5>
            </center>
          </div>
          <div class="modal-footer">
            <button class="btn btn-success" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>
  </main>


  <!-- <div class="container-fluid">
    <div class="row buyer-requests">
      <div class="col-md-12 mt-5">
        <h1 class="col-md-9 float-left">
        <?php echo $lang["titles"]["buyer_requests"]; ?>
        <h1>
        <div class="col-md-3 float-right">
          <div class="input-group">
            <input type="text" id="search-input"  placeholder="Search Buyer Requests" class="form-control" >
            <span class="input-group-btn">
            <button class="btn btn-success"> <i class="fa fa-search"></i> </button>
            </span>
          </div>
        </div>
      </div>
      <div class="col-md-12 mt-4">
        <h5 class="text-right mr-3">
          <i class="fa fa-list-alt"></i> <?php echo $login_seller_offers; ?> Offers Left Today
        </h5>
        <div class="clearfix"></div>
        <ul class="nav nav-tabs mt-3">
          
          <li class="nav-item">
            <a href="#active-requests" data-toggle="tab" class="nav-link active make-black">
            <?= $lang['tabs']['active2']; ?> <span class="badge badge-success"> 
            <?php 
              $i_requests = 0;
              $i_send_offers = 0;
              if($relevant_requests == "no"){ $requests_query = ""; }
              if(!empty($requests_query) or $relevant_requests == "no"){
              $get_requests = $db->query("select * from buyer_requests where request_status='active'" . $requests_query . " AND NOT seller_id='$login_seller_id' order by request_id DESC");
              while($row_requets = $get_requests->fetch()){
              $request_id = $row_requets->request_id;
              $count_offers = $db->count("send_offers",array("request_id" => $request_id,"sender_id" => $login_seller_id));
              if($count_offers == 1){
              $i_send_offers++;
              }
              $i_requests++;
              }
              }
              ?>
            <?php echo $i_requests-$i_send_offers; ?>
            </span>
            </a>
          </li>
          <?php $count_offers = $db->count("send_offers",array("sender_id" => $login_seller_id)); ?>
          <li class="nav-item">
            <a href="#sent-offers" data-toggle="tab" class="nav-link make-black">
            <?= $lang['tabs']['offers_sent']; ?> <span class="badge badge-success"> <?php echo $count_offers; ?>  </span>
            </a>
          </li>
        </ul>
        <div class="tab-content mt-4">
          <div id="active-requests" class="tab-pane fade show active">
            <div class="table-responsive box-table">
              <h3 class="float-left ml-2 mt-3 mb-3"> Buyer Requests </h3>
              <select id="sub-category" class="form-control float-right sort-by mt-3 mb-3 mr-3">
                <option value="all"> All Subcategories </option>
                <?php
                  if(count($where_child_id) > 0){
                  $get_c_cats = $db->query("select * from categories_children where ".$child_cats_query);
                  while($row_c_cats = @$get_c_cats->fetch()){
                  $child_id = $row_c_cats->child_id;
                  $get_meta = $db->select("child_cats_meta",array("child_id" => $child_id, "language_id" => $siteLanguage));
                  $row_meta = $get_meta->fetch();
                  $child_title = $row_meta->child_title;
                  echo "<option value='$child_id'> $child_title </option>";
                  }
                  }
                  ?>
              </select>
              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th>Request</th>
                    <th>Offers</th>
                    <th>Date</th>
                    <th>Duration</th>
                    <th>Budget</th>
                  </tr>
                </thead>
                <tbody id="load-data">
                  <?php 
                    if(!empty($requests_query) or $relevant_requests == "no"){
                    $select_requests = $db->query("select * from buyer_requests where request_status='active'".$requests_query." AND NOT seller_id='$login_seller_id' order by 1 DESC");
                    $count_requests = $select_requests->rowCount();
                    while($row_requests = $select_requests->fetch()){
                    $request_id = $row_requests->request_id;
                    $seller_id = $row_requests->seller_id;
                    $cat_id = $row_requests->cat_id;
                    $child_id = $row_requests->child_id;
                    $request_title = $row_requests->request_title;
                    $request_description = $row_requests->request_description;
                    $delivery_time = $row_requests->delivery_time;
                    $request_budget = $row_requests->request_budget;
                    $request_file = $row_requests->request_file;
                    $request_date = $row_requests->request_date;
                    $get_meta = $db->select("cats_meta",array("cat_id" => $cat_id, "language_id" => $siteLanguage));
                    $row_meta = $get_meta->fetch();
                    $cat_title = $row_meta->cat_title;
                    $get_meta = $db->select("child_cats_meta",array("child_id" => $child_id, "language_id" => $siteLanguage));
                    $row_meta = $get_meta->fetch();
                    $child_title = $row_meta->child_title;
                    $select_request_seller = $db->select("sellers",array("seller_id" => $seller_id));
                    $row_request_seller = $select_request_seller->fetch();
                    $request_seller_user_name = $row_request_seller->seller_user_name;
                    $request_seller_image = $row_request_seller->seller_image;
                    $count_send_offers = $db->count("send_offers",array("request_id" => $request_id));
                    $count_offers = $db->count("send_offers",array("request_id" => $request_id,"sender_id" => $login_seller_id));
                    if($count_offers == 0){
                    ?>
                  <tr id="request_tr_<?php echo $request_id; ?>">
                    <td width="1000">
                      <?php if(!empty($request_seller_image)){ ?>
                      <img src="../user_images/<?php echo $request_seller_image; ?>" class="request-img rounded-circle" >
                      <?php }else{ ?>
                      <img src="../user_images/empty-image.png" class="request-img rounded-circle" >
                      <?php } ?>
                      <div class="request-description">
                        <h6> <?php echo $request_seller_user_name; ?> </h6>
                        <h5 class="text-success"> <?php echo $request_title; ?> </h5>
                        <p class="lead mb-2"> <?php echo $request_description; ?> </p>
                        <?php if(!empty($request_file)){ ?>
                        <a href="request_files/<?php echo $request_file; ?>" download>
                        <i class="fa fa-arrow-circle-down"></i> <?php echo $request_file; ?>
                        </a>
                        <?php } ?>
                        <ul class="request-category">
                          <li> <?php echo $cat_title; ?> </li>
                          <li> <?php echo $child_title; ?> </li>
                        </ul>
                      </div>
                    </td>
                    <td><?php echo $count_send_offers; ?></td>
                    <td> <?php echo $request_date; ?> </td>
                    <td> 
                      <?php echo $delivery_time; ?> 
                      <a href="#" class="remove-link text-danger remove_request_<?php echo $request_id; ?>"> Remove Request </a>
                    </td>
                    <td class="text-success font-weight-bold">
                      <?php if(!empty($request_budget)){ ?> 
                      <?php echo $s_currency; ?><?php echo $request_budget; ?>
                      <?php }else{ ?> ----- <?php } ?>
                      <br>
                      <?php if($login_seller_offers == "0"){ ?>
                      <button class="btn btn-success btn-sm mt-4 send_button_<?php echo $request_id; ?>" data-toggle="modal" data-target="#quota-finish">Send Offer</button>
                      <?php }else{ ?>
                      <button class="btn btn-success btn-sm mt-4 send_button_<?php echo $request_id; ?>">Send Offer</button>
                      <?php } ?>
                    </td>
                    <script>
                      $(".remove_request_<?php echo $request_id; ?>").click(function(event){
                      event.preventDefault();
                      $("#request_tr_<?php echo $request_id; ?>").fadeOut().remove();
                      });
                      <?php if($login_seller_offers == "0"){ ?>
                      <?php }else{ ?>
                      $(".send_button_<?php echo $request_id; ?>").click(function(){
                      request_id = "<?php echo $request_id; ?>";
                      $.ajax({
                      method: "POST",
                      url: "send_offer_modal",
                      data: {request_id: request_id}
                      })
                      .done(function(data){
                      $(".append-modal").html(data);
                      });
                      });
                      <?php } ?>
                    </script>
                  </tr>
                  <?php } } } ?>
                </tbody>
              </table>
              <?php
                if(empty($count_requests)){
                echo"<center><h3 class='pb-4 pt-4'><i class='fa fa-frown-o'></i> No requests that matches any of your proposals/services yet!</h3></center>";
                }
              ?>
            </div>
          </div>
          <div id="sent-offers" class="tab-pane fade">
            <div class="table-responsive box-table">
              <h3 class="ml-2 mt-3 mb-3"> OFFERS SUBMITTED </h3>
              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th>Request</th>
                    <th>Duration</th>
                    <th>Price</th>
                    <th>Your Pitch</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                    $select_offers = $db->select("send_offers",array("sender_id"=>$login_seller_id),"DESC");
                    $count_offers = $select_offers->rowCount();
                    while($row_offers = $select_offers->fetch()){
                    $request_id = $row_offers->request_id;
                    $proposal_id = $row_offers->proposal_id;
                    $description = $row_offers->description;
                    $delivery_time = $row_offers->delivery_time;
                    $amount = $row_offers->amount;
                    $select_proposals = $db->select("proposals",array("proposal_id" => $proposal_id));
                    $row_proposals = $select_proposals->fetch();
                    $proposal_title = @$row_proposals->proposal_title;
                    $get_requests = $db->select("buyer_requests",array("request_id"=>$request_id));
                    $row_requests = $get_requests->fetch();
                    $request_id = $row_requests->request_id;
                    $seller_id = $row_requests->seller_id;
                    $cat_id = $row_requests->cat_id;
                    $child_id = $row_requests->child_id;
                    $request_title = $row_requests->request_title;
                    $request_description = $row_requests->request_description;
                    $get_meta = $db->select("cats_meta",array("cat_id" => $cat_id, "language_id" => $siteLanguage));
                    $row_meta = $get_meta->fetch();
                    $cat_title = $row_meta->cat_title;
                    $get_meta = $db->select("child_cats_meta",array("child_id" => $child_id, "language_id" => $siteLanguage));
                    $row_meta = $get_meta->fetch();
                    $child_title = $row_meta->child_title;
                    $select_request_seller = $db->select("sellers",array("seller_id" => $seller_id));
                    $row_request_seller = $select_request_seller->fetch();
                    $request_seller_user_name = $row_request_seller->seller_user_name;
                    $request_seller_image = $row_request_seller->seller_image;
                    ?>
                  <tr>
                    <td width="1000">
                      <?php if(!empty($request_seller_image)){ ?>
                      <img src="../user_images/<?php echo $request_seller_image; ?>" class="request-img rounded-circle mt-0" >
                      <?php }else{ ?>
                      <img src="../user_images/empty-image.png" class="request-img rounded-circle mt-0" >
                      <?php } ?>
                      <div class="request-description">
                        <h6> <?php echo $request_seller_user_name; ?> </h6>
                        <h5 class="text-success"> <?php echo $request_title; ?> </h5>
                        <p class="lead mb-2"> <?php echo $request_description; ?> </p>
                        <?php if(!empty($request_file)){ ?>
                        <a href="request_files/<?php echo $request_file; ?>" download>
                        <i class="fa fa-arrow-circle-down"></i> <?php echo $request_file; ?>
                        </a>
                        <?php } ?>
                        <ul class="request-category">
                          <li> <?php echo $cat_title; ?> </li>
                          <li> <?php echo $child_title; ?> </li>
                        </ul>
                      </div>
                    </td>
                    <td> <?php echo $delivery_time; ?> </td>
                    <td> <?php echo $s_currency; ?><?php echo $amount; ?>  </td>
                    <td>
                      <strong> <?php echo $proposal_title; ?></strong>
                      <p><br>
                        <?php echo $description; ?>
                      </p>
                    </td>
                  </tr>
                  <?php } ?>
                </tbody>
              </table>
              <?php
                if($count_offers == 0){
                echo"<center><h3 class='pb-4 pt-4'><i class='fa fa-meh-o'></i> You've sent no offers yet!</h3></center>";
                }
                ?>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="append-modal"></div>
    <div id="quota-finish" class="modal fade">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title h5"><i class="fa fa-frown-o fa-move-up"></i> Request Quota Reached</h5>
            <button class="close" data-dismiss="modal"> &times; </button>
          </div>
          <div class="modal-body">
            <center>
              <h5>You can only send a max of 10 offers per day. Today you've maxed out. Try again tomorrow. </h5>
            </center>
          </div>
          <div class="modal-footer">
            <button class="btn btn-success" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>
  </div> -->
  <script>
    $(document).ready(function(){
    $('#search-input').keyup(function(){
    var search = $(this).val();
    $('#load-data').html("");
    $.ajax({
    url:"load_search_data",
    method:"POST",
    data:{search:search},
    success:function(data){
    $('#load-data').html(data);
    }
    });
    });
    $('#sub-category').change(function(){
    var cat_id = $(this).val();
    $('#load-data').html("");
    $.ajax({
    url:"load_category_data",
    method:"POST",
    data:{cat_id:cat_id},
    success:function(data){
    $('#load-data').html(data);
    }
    });
    });
    });
  </script>
  <?php require_once("../includes/footer.php"); ?>
</body>
</html>