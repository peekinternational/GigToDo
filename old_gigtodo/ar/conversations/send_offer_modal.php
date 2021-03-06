<?php
@session_start();
require_once("../includes/db.php");
if(!isset($_SESSION['seller_user_name'])){
echo "<script>window.open('../login','_self')</script>";
}
$login_seller_user_name = $_SESSION['seller_user_name'];
$select_login_seller = $db->select("sellers",array("seller_user_name" => $login_seller_user_name));
$row_login_seller = $select_login_seller->fetch();
$login_seller_id = $row_login_seller->seller_id;
$receiver_id = $input->post('receiver_id');
$message = $input->post('message');
$file = $input->post('file');
$request_id = $input->post('request_id');
?>
<div id="send-offer-modal" class="modal fade" tabindex="-1" role="dialog"  aria-hidden="true"><!-- send-offer-modal modal fade Starts -->
<div class="modal-dialog  modal-dialog-centered customer-order" role="document"><!-- modal-dialog Starts -->
<div class="modal-content"><!-- modal-content Starts -->
<div class="modal-header"><!-- modal-header Starts -->
<h5 class="modal-title"> حدد عرض / خدمة لعرضها </h5>
<!-- <button class="close" data-dismiss="modal"><span>&times;</span></button> -->
<a href="javascript:void(0);" class="closed" data-dismiss="modal" aria-label="Close">
	<img src="<?= $site_url; ?>/assets/img/seller-profile/popup-close-icon.png" />
</a>
</div><!-- modal-header Ends -->
<div class="modal-body p-0"><!-- modal-body p-0 Starts -->
<div class="request-proposals-list"><!--- request-proposals-list Starts --->
<?php
$get_proposals = $db->select("proposals",array("proposal_seller_id"=>$login_seller_id,"proposal_status"=>"active"));
while($row_proposals = $get_proposals->fetch()){
$proposal_id = $row_proposals->proposal_id;
$proposal_title = $row_proposals->proposal_title;
$proposal_img1 = $row_proposals->proposal_img1;
?>
<div class="proposal-picture"><!--- proposal-picture Starts --->
<input type="radio" id="radio-<?php echo $proposal_id; ?>" class="radio-custom" name="proposal_id" value="<?php echo $proposal_id; ?>" required>
<label for="radio-<?php echo $proposal_id; ?>" class="radio-custom-label"> </label>
<img src="<?php echo $site_url; ?>/proposals/proposal_files/<?php echo $proposal_img1; ?>" width="50" height="50">
</div><!--- proposal-picture Ends --->
<div class="proposal-title"><!--- proposal-title Starts --->
<p><?php echo $proposal_title; ?></p>
</div><!--- proposal-title Ends --->
<hr>
<?php } ?>
</div><!--- request-proposals-list Ends --->
</div><!-- modal-body p-0 Ends -->
<div class="border-top"><!--- modal-footer Starts --->
	<div class="form-group d-flex flex-row align-items-center justify-content-between">
<button class="button-close" data-dismiss="modal"> إلغاء </button>
<button id="submit-proposal" class="button" data-toggle="modal" data-dismiss="modal" data-target="#submit-proposal-details">يذهبون المقبل</button>
</div>
</div><!--- modal-footer Ends --->
</div><!-- modal-content Ends -->
</div><!-- modal-dialog Ends -->
</div><!-- send-offer-modal modal fade Ends -->
<div id="submit-proposal-details" class="modal fade" tabindex="-1" role="dialog"  aria-hidden="true"><!--- modal fade Starts --->
<div class="modal-dialog modal-dialog-centered customer-order" role="document"><!--- modal-dialog Starts --->
</div><!--- modal-dialog Ends --->
</div><!--- modal fade Ends --->
<textarea id="message" class="d-none"><?php echo $message; ?></textarea>
<script>
$(document).ready(function(){
	$("#send-offer-modal").modal('show');
	$("#submit-proposal").attr("disabled", "disabled");
	$(".radio-custom-label").click(function(){
		$("#submit-proposal").removeAttr("disabled");
	});
   $("#submit-proposal").click(function(){
   proposal_id = document.querySelector('input[name="proposal_id"]:checked').value;	   
   receiver_id = "<?php echo $receiver_id; ?>";
   request_id = "<?php echo $request_id ?>";
   message = $("#message").val();
   file = "<?php echo $file; ?>";
   $.ajax({
		method: "POST",   
		url: "<?php echo $site_url; ?>/ar/conversations/submit_proposal_details",
		data: { proposal_id: proposal_id, receiver_id: receiver_id, message: message, file: file, request_id: request_id}
		}).done(function(data){
		 $("#submit-proposal-details .modal-dialog").html(data);
		});
   });
});
</script>