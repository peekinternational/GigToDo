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

$relevant_requests = $row_general_settings->relevant_requests;


$request_child_ids = array();

$select_proposals = $db->query("select DISTINCT proposal_child_id from proposals where proposal_seller_id='$login_seller_id'");

while($row_proposals = $select_proposals->fetch()){

$proposal_child_id = $row_proposals->proposal_child_id;

array_push($request_child_ids, $proposal_child_id);

}

$where_child_id = array();

foreach($request_child_ids as $child_id){

$where_child_id[] = "child_id=" . $child_id; 

}

if(count($where_child_id) > 0){

$requests_query = " and (" . implode(" or ", $where_child_id) . ")";

}



if($relevant_requests == "no"){ $requests_query = ""; }

if(!empty($requests_query) or $relevant_requests == "no"){

$child_id = $input->post('child_id');
	
if($child_id == "all"){
	
$select_requests = $db->query("select * from buyer_requests where request_status='active'" . $requests_query . " AND NOT seller_id='$login_seller_id' order by 1 DESC");

}else{
	
$select_requests = $db->query("select * from buyer_requests where request_status='active' AND child_id=:child_id AND NOT seller_id='$login_seller_id' order by 1 DESC",array("child_id"=>$child_id));
	
}

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

<tr id="request_tr_<?php echo $request_id; ?>" role="row">
	<td data-label="Buyer">
	  <div class="d-flex flex-column align-items-center">
	    <div class="buyer-image">
	      <?php if(!empty($request_seller_image)){ ?>
	      <img alt class="img-fluid d-block request-img rounded-circle" src="../user_images/<?php echo $request_seller_image; ?>" />
	      <?php }else{ ?>
	      <img alt class="img-fluid d-block" src="<?= $site_url; ?>/assets/img/emongez_cube.png" />
	      <?php } ?>
	    </div>
	    <div class="buyer-id"><?php echo $request_seller_user_name; ?></div>
	    <span><?php echo $request_date; ?></span>
	  </div>
	</td>
	<td data-label="Request">
	  <p><?php echo $request_description; ?></p>
	  <div class="attachment d-flex flex-row align-items-center">
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
	<td data-label="Offers">
	  <div class="offers-button"><?php echo $count_send_offers; ?> offers</div>
	</td>
	<td data-label="Delivery"><?php echo $delivery_time; ?></td>
	<td data-label="Budget">
	  <div class="d-flex flex-column">
	    <?php if(!empty($request_budget)){ ?> 
	    <span><?php echo $s_currency; ?><?php echo $request_budget; ?></span>
	    <?php }else{ ?> ----- <?php } ?>
	    <?php if($login_seller_offers == "0"){ ?>
	      <a class="send-offer send_button_<?php echo $request_id; ?>" data-toggle="modal" data-target="#quota-finish">Send offer</a>
	    <!-- <button class="btn btn-success btn-sm mt-4 send_button_<?php echo $request_id; ?>" data-toggle="modal" data-target="#quota-finish">Send Offer</button> -->
	    <?php }else{ ?>
	      <a class="send-offer send_button_<?php echo $request_id; ?>">Send offer</a>
	    <!-- <button class="btn btn-success btn-sm mt-4 send_button_<?php echo $request_id; ?>">Send Offer</button> -->
	    <?php } ?>
	    
	  </div>
	</td>


	<!-- <td>
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
		<a href="request_files/ <?php echo $request_file; ?>" download>
			<i class="fa fa-arrow-circle-down"></i>  <?php echo $request_file; ?>
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
		<?php echo $delivery_time; ?> <a href="#" class="remove-link remove_request_<?php echo $request_id; ?>"> Remove Request </a>
	</td>
	<td class="text-success font-weight-bold">
		$<?php if(!empty($request_budget)){ ?>
		<?php echo $request_budget; ?>
		<?php }else{ ?>
		---
		<?php } ?>
		<br>
		<?php if($login_seller_offers == "0"){ ?>
		<button class="btn btn-success btn-sm mt-4 send_button_<?php echo $request_id; ?>" data-toggle="modal" data-target="#quota-finish">
		Send Offer
		</button>
		<?php }else{ ?>
		<button class="btn btn-success btn-sm mt-4 send_button_<?php echo $request_id; ?>">
		Send Offer
		</button>
		<?php } ?>
	</td> -->
	<script>
	$(".send_button_<?php echo $request_id; ?>").css("visibility","hidden");
	$(".remove_request_<?php echo $request_id; ?>").css("visibility","hidden");
	$(document).on("mouseenter", "#request_tr_<?php echo $request_id; ?>", function(){
	
	$(".send_button_<?php echo $request_id; ?>").css("visibility","visible");
	
	$(".remove_request_<?php echo $request_id; ?>").css("visibility","visible");
	
	});
	$(document).on("mouseleave", "#request_tr_<?php echo $request_id; ?>", function(){
	
	$(".send_button_<?php echo $request_id; ?>").css("visibility","hidden");
	
	$(".remove_request_<?php echo $request_id; ?>").css("visibility","hidden");
	
	});
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

<?php 

}

}



}

?>