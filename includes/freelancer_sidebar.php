<?php
$search_query = @$_SESSION['search_query'];
$s_value = "%$search_query%";
$online_sellers = array();
$sellerCountry = array();
$seller_level = array();
$seller_language = array();

if(isset($_GET['online_sellers'])){
	foreach($_GET['online_sellers'] as $value){
		$online_sellers[$value] = $value;
	}
}
if(isset($_GET['seller_country'])){
	foreach($_GET['seller_country'] as $value){
		$sellerCountry[$value] = $value;
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
<div class="search-results-categories">
	<div class="search-categories-header">Filter by category</div>
	<div class="search-categories-body">
		<?php
		$select_categories = $db->select("categories");
		while($row_categories = $select_categories->fetch()){
			$cat_id = $row_categories->cat_id;
			$select_cats_meta = $db->select('cats_meta', array("cat_id" => $cat_id));
		$cat_title = $select_cats_meta->fetch()->cat_title;
		if (!empty($cat_title)) {
		?>
		<a class="search-categories-item d-flex flex-row align-items-center" onclick="get_cat_freelancers(<?= $cat_id ?>)" href="javascript:void(0);" data-id="<?= $cat_id ?>"><?= $cat_title; ?></a>
		<?php } } ?>
	</div>
</div>
<div class="card border-success mb-3" style="border-color: #ff0707 !important;">
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
</div>

<div class="card border-success mb-3" style="border-color: #ff0707 !important;">
	<div class="card-header bg-success" style="background-color: #ff0707 !important;">
		<h3 class="<?=($lang_dir == "right" ? 'float-right':'float-left')?> text-white h5">Seller Location</h3>
		<button class="btn btn-secondary btn-sm <?=($lang_dir == "right" ? 'float-left':'float-right')?> clear_seller_country clearlink" onclick="clearCountry()">
			<?php echo $lang['sidebar']['clear_filter']; ?>
		</button>
	</div>
	<div class="card-body">
		<ul class="nav flex-column">
	 <?php
    $sellers = $db->query("select DISTINCT seller_country from sellers");
		while($seller = $sellers->fetch()){
    $seller_country = $seller->seller_country;
    if (!empty($seller_country)){
    ?>
		<li class="nav-item checkbox checkbox-success">
			<label>
			<input type="checkbox" value="<?php echo $seller_country; ?>" class="get_seller_country"
      <?php if(isset($sellerCountry["$seller_country"])){ echo "checked"; } ?>>
			<span><?php echo $seller_country; ?></span>
			</label>
		</li>
    <?php }} ?>
    </ul>
	</div>
</div>

<!-- <div class="card border-success mb-3" style="border-color: #ff0707 !important;">
	<div class="card-header bg-success" style="background-color: #ff0707 !important;">
		<h3 class="<?=($lang_dir == "right" ? 'float-right':'float-left')?> text-white h5"><?php echo $lang['sidebar']['seller_level']; ?></h3>
		<button class="btn btn-secondary btn-sm <?=($lang_dir == "right" ? 'float-left':'float-right')?> clear_seller_level clearlink" onclick="clearLevel()">
			<?php echo $lang['sidebar']['clear_filter']; ?>
		</button>
	</div>
	<div class="card-body">
		<ul class="nav flex-column">
      <?php
      $sellers = $db->query("select DISTINCT seller_level from sellers");
  		while($seller = $sellers->fetch()){
      $level_id = $seller->seller_level;
      $select_seller_levels = $db->select("seller_levels",array('level_id' => $level_id));
      $level_title = $db->select("seller_levels_meta",array("level_id"=>$level_id,"language_id"=>$siteLanguage))->fetch()->title;
      ?>
			<li class="nav-item checkbox checkbox-success">
				<label>
				<input type="checkbox" value="<?php echo $level_id; ?>" class="get_seller_level"
        <?php if(isset($seller_level[$level_id])){ echo "checked"; } ?>>
				<span><?php echo $level_title; ?></span>
				</label>
			</li>
      <?php } ?>
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
			$sellers = $db->query("select DISTINCT seller_language from sellers");
  		while($seller = $sellers->fetch()){
      $language_id = $seller->seller_language;
      if(!empty($language_id)){
			$select_seller_languges = $db->select("seller_languages",array('language_id' => $language_id));
			$language_title = @$select_seller_languges->fetch()->language_title;
			if (!empty($language_title)) {
			?>
			<li class="nav-item checkbox checkbox-success">
				<label>
				<input type="checkbox" value="<?php echo $language_id; ?>" class="get_seller_language"
       	<?php if(isset($seller_language[$language_id])){ echo "checked"; } ?>>
				<span><?php echo $language_title; ?></span>
				</label>
			</li>
      <?php }}} ?>
		</ul>
	</div>
</div> -->