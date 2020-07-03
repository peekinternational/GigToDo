<table class="table orders-table" border="0" cellpadding="0" cellspacing="0">
	<thead>
		<tr role="row">
			<th role="column">Orders Description</th>
			<th role="column">Order Date</th>
			<th role="column">Due On</th>
			<th role="column">Total</th>
			<th role="column">Status</th>
		</tr>
	</thead>
	<tbody>
		<?php
		$sel_orders = $db->select("orders",array("buyer_id" => $login_seller_id),"DESC");
		
		$count_orders = $sel_orders->rowCount();
		while($row_orders = $sel_orders->fetch()){
		$order_id = $row_orders->order_id;
		$proposal_id = $row_orders->proposal_id;
		$order_price = $row_orders->order_price;
		$order_status = $row_orders->order_status;
		$order_number = $row_orders->order_number;
		$order_duration = intval($row_orders->order_duration);
		$order_date = $row_orders->order_date;
		$order_due = date("F d, Y", strtotime($order_date . " + $order_duration days"));
						$select_proposals = $db->select("proposals",array("proposal_id" => $proposal_id));
						$row_proposals = $select_proposals->fetch();
						$proposal_title = $row_proposals->proposal_title;
		$proposal_img1 = $row_proposals->proposal_img1;
		$today_date = date("F d, Y");
		
		?>
		<tr role="row">
			<td data-label="Description" role="column">
				<div class="order-desc d-flex flex-wrap">
					<div class="order-image">
						<?php if (!empty($proposal_img1)){ ?>
						<img src="<?= $site_url; ?>/proposals/proposal_files/<?php echo $proposal_img1; ?>" class="img-fluid d-block" width="100%" style="height: 85px;" />
						<?php }else{ ?>
						<img src="<?= $site_url; ?>/assets/img/emongez_cube.png" class="img-fluid d-block" width="100%" />
						<?php } ?>
					</div>
					<div class="order-desc-text">
						<p><?php echo $proposal_title;?></p>
					</div>
				</div>
			</td>
			<td data-label="Order Date" role="column">
				<div class="date"><?php echo $order_date; ?></div>
			</td>
			<td data-label="Due On" role="column">
				<div class="date"><?php echo $order_due; ?></div>
			</td>
			<td data-label="Total" role="column">
				<div class="amount"><?php if ($to == 'EGP'){ echo $to.' '; echo $order_price;}elseif($to == 'USD'){  echo $to.' '; echo round($cur_amount * $order_price,2);}else{  echo $s_currency.' '; echo $order_price; } ?></div>
			</td>
			<td data-label="Status" role="column">
				<?php if ($order_status == "delivered"){ ?>
				<a class="button button-red" href="javascript:void(0);"><?php echo ucwords($order_status); ?></a>
				<?php }elseif($order_status == "active"){ ?>
					<a class="button button-limerick" href="javascript:void(0);">In Progress</a>
				<?php }elseif($order_status == "completed"){ ?>
					<a class="button button-yellow" href="javascript:void(0);"><?php echo ucwords($order_status); ?></a>
				<?php }elseif($order_status == "cancelled"){ ?>
					<a class="button button-white" href="javascript:void(0);"><?php echo ucwords($order_status); ?></a>
				<?php }elseif($order_status == "pending"){ ?>
					<a class="button button-darkgray" href="javascript:void(0);"><?php echo ucwords($order_status); ?></a>
				<?php }elseif($today_date > $order_due && $order_status != "delivered"){ ?>
					<a class="button button-lochmara" href="javascript:void(0);">overdue</a>
				<?php } ?>
			</td>
		</tr>
		<?php } ?>
	</tbody>
</table>
<?php
	if( $count_orders == 0){
	echo "<center><h3 class='pb-4 pt-4'><i class='fa fa-meh-o'></i> No proposals/services purchases at the momment.</h3></center>";
	}
	?>
<!-- <div class="table-responsive box-table mt-3">
	<table class="table table-bordered">
		<thead>
			
			<tr>
				<th>ORDER SUMMARY</th>
				<th>ORDER DATE</th>
				<th>DUE ON</th>
				<th>TOTAL</th>
				<th>STATUS</th>
				
			</tr>
		</thead>
		<tbody>
			<tr>
				
				<?php
				$sel_orders = $db->select("orders",array("buyer_id" => $login_seller_id),"DESC");
				
				$count_orders = $sel_orders->rowCount();
				while($row_orders = $sel_orders->fetch()){
				$order_id = $row_orders->order_id;
				$proposal_id = $row_orders->proposal_id;
				$order_price = $row_orders->order_price;
				$order_status = $row_orders->order_status;
				$order_number = $row_orders->order_number;
				$order_duration = intval($row_orders->order_duration);
				$order_date = $row_orders->order_date;
				$order_due = date("F d, Y", strtotime($order_date . " + $order_duration days"));
								$select_proposals = $db->select("proposals",array("proposal_id" => $proposal_id));
								$row_proposals = $select_proposals->fetch();
								$proposal_title = $row_proposals->proposal_title;
				$proposal_img1 = $row_proposals->proposal_img1;
				?>
				<td>
					<a href="order_details?order_id=<?php echo $order_id; ?>" class="make-black">
						<img class="order-proposal-image " src="proposals/proposal_files/<?php echo $proposal_img1; ?>">
						<p class="order-proposal-title"><?php echo $proposal_title; ?></p>
						
					</a>
					
				</td>
				<td><?php echo $order_date; ?></td>
				<td><?php echo $order_due; ?></td>
				<td><?php echo $s_currency; ?><?php echo $order_price; ?></td>
				<td><button class="btn btn-success"><?php echo ucwords($order_status); ?></button></td>
				
			</tr>
			
			<?php } ?>
			
		</tbody>
		
	</table>
	
	<?php
	
	if( $count_orders == 0){
	
	echo "<center><h3 class='pb-4 pt-4'><i class='fa fa-meh-o'></i> No proposals/services purchases at the momment.</h3></center>";
	}
	
	
	
	?>
</div> -->