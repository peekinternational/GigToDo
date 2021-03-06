<?php
  $search_query = @$_SESSION['search_query'];
  $s_value = "%$search_query%";
  $online_sellers = array();
  $cat_id = array();
  $delivery_time = array();
  $seller_level = array();
  $seller_language = array();
  if(isset($_GET['online_sellers'])){
    foreach($_GET['online_sellers'] as $value){
      $online_sellers[$value] = $value;
    }
  }
  if(isset($_GET['cat_id'])){
    foreach($_GET['cat_id'] as $value){
      $cat_id[$value] = $value;
    }
  }
  if(isset($_GET['delivery_time'])){
    foreach($_GET['delivery_time'] as $value){
      $delivery_time[$value] = $value;
    }
  }
  if(isset($_GET['seller_level'])){
    foreach($_GET['seller_level'] as $value){
      $seller_level[$value] = $value;
    }
  }
  if(isset($_GET['seller_language'])){
    foreach($_GET['seller_language'] as $value){
      $seller_language[$value] = $value;
    }
  }
?>

<!-- New Design Start -->
<button class="filter-results" type="button" role="button">
  <img src="<?= $site_url; ?>/assets/img/gigs/filter.png" alt="" />Filter by
</button>
<div class="gigs-sidebar">
  <div class="gigs-sidebar-filter">
    <div class="gigs-sidebar-title">
      <h4 class="title"><img src="<?= $site_url; ?>/assets/img/gigs/filter.png" alt="">Filter by</h4>
    </div>
    <div class="gigs-filter-content ">
      <div class="single-filter clearfix">
        <select id="category" name="cat_value">
          <?php
            $get_proposals = $db->query("select DISTINCT proposal_cat_id from proposals where proposal_title like :proposal_title AND proposal_status='active'",array(":proposal_title"=>$s_value));
            while($row_proposals = $get_proposals->fetch()){
            $proposal_cat_id = $row_proposals->proposal_cat_id;
            $get_meta = $db->select("cats_meta",array("cat_id"=>$proposal_cat_id,"language_id"=>$siteLanguage));
            $category_title = @$get_meta->fetch()->cat_title;
            if(!empty($category_title)){
          ?>
          
          <option value="<?php echo $proposal_cat_id; ?>" <?php
          if($cat_id == @$_SESSION['cat_id']){ echo "selected"; }
          if($cat_id == @$child_parent_id){ echo "selected"; }
          ?> ><?= $category_title; ?></option>
          <?php } }?>
        </select>
      </div>
      <div class="single-filter clearfix cat_hide">
        <select id="cat_<?php echo $page_cat_id; ?>" onChange="window.location.href=this.value">
          <?php
            $get_child_cat = $db->select("categories_children",array("child_parent_id" => $proposal_cat_id));
            while($row_child_cat = $get_child_cat->fetch()){

              $child_id = $row_child_cat->child_id;
              $child_url = $row_child_cat->child_url;
              $get_meta = $db->select("child_cats_meta",array("child_id" => $child_id, "language_id" => $siteLanguage));
              $row_meta = $get_meta->fetch();
              $child_title = $row_meta->child_title;
              if(!empty($child_title)){
          ?>
          <option <?php if($child_id == @$_SESSION['cat_child_id']){ echo "selected"; } ?> value="<?php echo $site_url; ?>/categories/<?php echo $cat_page_url; ?>/<?php echo $child_url; ?>"><?php echo $child_title; ?></option>
          <?php } } ?>
        </select>
        
      </div>
      <div class="single-filter clearfix d-none" id="sub-cat">
        <select id="sub-category" class="form-control" onChange="window.location.href=this.value">
          
        </select>
        
      </div>
    </div>
  </div>
  
  <div class="gigs-sidebar-price">
    <div class="gigs-sidebar-title">
      <h4 class="title"><img src="<?= $site_url;?>/assets/img/gigs/price.png" alt="">Price</h4>
    </div>
    <div class="gigs-price-content ">
      <input id="price" type="text" name="price_slider" value="" class="irs-hidden-input" tabindex="-1" readonly="">
      <input type="hidden" id="price_range" name="">
    </div>
  </div>

  <div class="gigs-sidebar-status">
    <div class="gigs-sidebar-title">
      <h4 class="title"><img src="<?= $site_url;?>/assets/img/gigs/status.png" alt="">Status</h4>
    </div>
    <div class="gigs-status-content d-flex justify-content-between align-items-center">
      <div class="status-text pt-20">
        <p class="text">Online</p>
      </div>
      <div class="status-switch pt-20">
        <div class="md_switch">
          <input class="switch get_online_sellers" id="switch" value="1" type="checkbox" <?php if(isset($online_sellers["1"])){ echo "checked"; } ?> >
          <label for="switch"></label>
        </div>
      </div>
    </div>
  </div>

  <!-- <div class="gigs-sidebar-titme">
    <div class="gigs-sidebar-title">
      <h4 class="title"></h4>
    </div>
    <div class="gigs-titme-content pt-20">
      <ul class="radio_titme radio_style2">
        <?php
          $get_proposals = $db->query("select DISTINCT proposal_cat_id from proposals where proposal_title like :proposal_title AND proposal_status='active'",array(":proposal_title"=>$s_value));
          while($row_proposals = $get_proposals->fetch()){
          $proposal_cat_id = $row_proposals->proposal_cat_id;
          $get_meta = $db->select("cats_meta",array("cat_id"=>$proposal_cat_id,"language_id"=>$siteLanguage));
          $category_title = @$get_meta->fetch()->cat_title;
          if(!empty($category_title)){
        ?>
        <li>
          <input type="radio" name="radio_titme" checked="" id="cate<?php echo $proposal_cat_id; ?>" class="get_delivery_time" value="<?php echo $proposal_cat_id; ?>" <?php if(isset($cat_id[$proposal_cat_id])){ echo "checked"; } ?> >
          <label for="cate<?php echo $proposal_cat_id; ?>"><span></span><?php echo $category_title; ?></label>
        </li>
        <?php }} ?>
      </ul>
    </div>
  </div> -->

  <div class="gigs-sidebar-titme">
    <div class="gigs-sidebar-title">
      <h4 class="title"><img src="<?= $site_url;?>/assets/img/gigs/time.png" alt="">Delivery Time</h4>
    </div>
    <div class="gigs-titme-content pt-20">
      <ul class="radio_titme radio_style2">
        <?php
          $get_proposals = $db->query("select DISTINCT delivery_id from proposals where proposal_title like :proposal_title AND proposal_status ='active'",array(":proposal_title"=>$s_value));
          while($row_proposals = $get_proposals->fetch()){
          $delivery_id = $row_proposals->delivery_id;
          $select_delivery_time = $db->select("delivery_times",array('delivery_id' => $delivery_id));
          $delivery_title = @$select_delivery_time->fetch()->delivery_title;
          if(!empty($delivery_title)){
        ?>
        <li>
          <input type="radio" name="radio_titme" checked="" id="time<?php echo $delivery_id; ?>" class="get_delivery_time" value="<?php echo $delivery_id; ?>" <?php if(isset($delivery_time[$delivery_id])){ echo "checked"; } ?> >
          <label for="time<?php echo $delivery_id; ?>"><span></span><?php echo $delivery_title; ?></label>
        </li>
        <?php }} ?>
      </ul>
    </div>
  </div>
  <div class="gigs-sidebar-search">
    <div class="gigs-sidebar-title">
      <h4 class="title"><img src="<?= $site_url;?>/assets/img/gigs/keyword.png" alt="">Keywords</h4>
    </div>
    <div class="gigs-search-content mt-20">
      <input type="search" id="keyword" onkeyup="getgig()" placeholder="Search by Keywords">
    </div>
  </div>
  
  <div class="gigs-sidebar-button">
    <div class="gigs-button-content">
      <button>Update Search</button>
    </div>
  </div>
</div>
<!-- New Design -->
<!-- <div class="card border-success mb-3">
  <div class="card-body pb-2 pt-3 <?=($lang_dir == "right" ? 'text-right':'')?>">
    <ul class="nav flex-column">
      <li class="nav-item checkbox checkbox-success">
        <label>
        <input type="checkbox" value="1" class="get_online_sellers" 
          <?php if(isset($online_sellers["1"])){ echo "checked"; } ?> >
        <span><?php echo $lang['sidebar']['online_sellers']; ?></span>
        </label>
      </li>
    </ul>
  </div>
</div> -->
<!-- <div class="card border-success mb-3">
  <div class="card-header bg-success">
    <h3 class="<?=($lang_dir == "right" ? 'float-right':'float-left')?> text-white h5"><?php echo $lang['sidebar']['categories']; ?></h3>
    <button class="btn btn-secondary btn-sm <?=($lang_dir == "right" ? 'float-left':'float-right')?> clear_cat_id clearlink" onclick="clearCat()">
    <?php echo $lang['sidebar']['clear_filter']; ?>
    </button>
  </div>
  <div class="card-body">
    <ul class="nav flex-column">
      <?php
        $get_proposals = $db->query("select DISTINCT proposal_cat_id from proposals where proposal_title like :proposal_title AND proposal_status='active'",array(":proposal_title"=>$s_value));
        while($row_proposals = $get_proposals->fetch()){
        $proposal_cat_id = $row_proposals->proposal_cat_id;
        $get_meta = $db->select("cats_meta",array("cat_id"=>$proposal_cat_id,"language_id"=>$siteLanguage));
        $category_title = @$get_meta->fetch()->cat_title;
        if(!empty($category_title)){
      ?>
      <li class="nav-item checkbox checkbox-success">
        <label>
        <input type="checkbox" value="<?php echo $proposal_cat_id; ?>" class="get_cat_id"
          <?php if(isset($cat_id[$proposal_cat_id])){ echo "checked"; } ?>>
        <span><?php echo $category_title; ?></span>
        </label>
      </li>
      <?php }} ?>
    </ul>
  </div>
</div> -->
<!-- <div class="card border-success mb-3">
  <div class="card-header bg-success">
    <h3 class="<?=($lang_dir == "right" ? 'float-right':'float-left')?> text-white h5"><?php echo $lang['sidebar']['delivery_time']; ?></h3>
    <button class="btn btn-secondary btn-sm <?=($lang_dir == "right" ? 'float-left':'float-right')?> clear_delivery_time clearlink" onclick="clearDelivery()">
    <?php echo $lang['sidebar']['clear_filter']; ?>
    </button>
  </div>
  <div class="card-body">
    <ul class="nav flex-column">
      <?php
        $get_proposals = $db->query("select DISTINCT delivery_id from proposals where proposal_title like :proposal_title AND proposal_status ='active'",array(":proposal_title"=>$s_value));
        while($row_proposals = $get_proposals->fetch()){
        $delivery_id = $row_proposals->delivery_id;
        $select_delivery_time = $db->select("delivery_times",array('delivery_id' => $delivery_id));
        $delivery_title = @$select_delivery_time->fetch()->delivery_title;
        if(!empty($delivery_title)){
      ?>
      <li class="nav-item checkbox checkbox-success">
        <label>
        <input type="checkbox" value="<?php echo $delivery_id; ?>" class="get_delivery_time"
          <?php if(isset($delivery_time[$delivery_id])){ echo "checked"; } ?>>
        <span><?php echo $delivery_title; ?></span>
        </label>
      </li>
      <?php }} ?>
    </ul>
  </div>
</div> -->
<!-- <div class="card border-success mb-3">
  <div class="card-header bg-success">
    <h3 class="<?=($lang_dir == "right" ? 'float-right':'float-left')?> text-white h5"><?php echo $lang['sidebar']['seller_level']; ?></h3>
    <button class="btn btn-secondary btn-sm <?=($lang_dir == "right" ? 'float-left':'float-right')?> clear_seller_level clearlink" onclick="clearLevel()">
    <?php echo $lang['sidebar']['clear_filter']; ?>
    </button>
  </div>
  <div class="card-body">
    <ul class="nav flex-column">
      <?php
        $get_proposals = $db->query("select DISTINCT level_id from proposals where proposal_title like :proposal_title AND proposal_status='active'",array(":proposal_title"=>$s_value));
        while($row_proposals = $get_proposals->fetch()){
        $level_id = $row_proposals->level_id;
        $select_seller_levels = $db->select("seller_levels",array('level_id' => $level_id));
        $level_title = @$db->select("seller_levels_meta",array("level_id"=>$level_id,"language_id"=>$siteLanguage))->fetch()->title;
        if(!empty($level_title)){
      ?>
      <li class="nav-item checkbox checkbox-success">
        <label>
        <input type="checkbox" value="<?php echo $level_id; ?>" class="get_seller_level"
          <?php if(isset($seller_level[$level_id])){ echo "checked"; } ?>>
        <span><?php echo $level_title; ?></span>
        </label>
      </li>
      <?php }} ?>
    </ul>
  </div>
</div> -->
<!-- <div class="card border-success mb-3">
  <div class="card-header bg-success">
    <h3 class="<?=($lang_dir == "right" ? 'float-right':'float-left')?> text-white h5"><?php echo $lang['sidebar']['seller_lang']; ?></h3>
    <button class="btn btn-secondary btn-sm <?=($lang_dir == "right" ? 'float-left':'float-right')?> clear_seller_language clearlink" onclick="clearLanguage()">
    <?php echo $lang['sidebar']['clear_filter']; ?>
    </button>
  </div>
  <div class="card-body">
    <ul class="nav flex-column">
      <?php
        $get_proposals = $db->query("select DISTINCT language_id from proposals where not language_id='0' and proposal_title like :proposal_title AND proposal_status='active'",array(":proposal_title"=>$s_value));
        while($row_proposals = $get_proposals->fetch()){
        $language_id = $row_proposals->language_id;
        $select_seller_languges = $db->select("seller_languages",array('language_id' => $language_id));
        $language_title = @$select_seller_languges->fetch()->language_title;
        if(!empty($language_title)){
        ?>
      <li class="nav-item checkbox checkbox-success">
        <label>
        <input type="checkbox" value="<?php echo $language_id; ?>" class="get_seller_language"
          <?php if(isset($seller_language[$language_id])){ echo "checked"; } ?>>
        <span><?php echo $language_title; ?></span>
        </label>
      </li>
      <?php }} ?>
    </ul>
  </div>
</div> -->