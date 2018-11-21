<?php 
	if (!isset($_GET['orderId']) || $_GET['orderId'] == NULL) {
        echo "<script>window.location = '404.php';</script>";
    }else{
        $orderId = preg_replace('/[^-a-zA-Z0-9_]/', '', $_GET['orderId']);
       
    }
 ?>
<?php 
	include_once 'lib/Session.php';
    Session::init();
	$login = Session::get("Custlogin");
	if ($login == false) {
		header("Location: index.php");
	}
 ?>
<?php include_once 'inc/header.php'; ?>

<style>
.invoice-title h2, .invoice-title h3 {
    display: inline-block;
}

.table > tbody > tr > .no-line {
    border-top: none;
}

.table > thead > tr > .no-line {
    border-bottom: none;
}

.table > tbody > tr > .thick-line {
    border-top: 2px solid;
}
</style>
<!------ Include the above in your HEAD tag ---------->

<div class="container">
    <div class="row">
        <div class="col-xs-12">
    		
            <div class="invoice-title">
    			<h2>Invoice</h2><h3 class="pull-right">Order # <?php echo $orderId; ?></h3>
    		</div>
    		<hr>
    		<div class="row">
    			<div class="col-xs-6">
    				<address>
    				<strong>Billed To:</strong><br>
                    <?php
                     $id = Session::get("cmrId");
                     $getdata = $cmr->getCustomerData($id);
                       if ($getdata) {
                            while ($result = $getdata->fetch_assoc()) {
                         ?>
    					<b>Name: </b><?php echo $result['name']; ?><br>
    					<b>Name: </b><?php echo $result['phone']; ?><br>
    					<b>Email: </b><?php echo $result['email']; ?><br>
    					<b>Address: </b><?php echo $result['address']; ?><br>
    					<b>City: </b><?php echo $result['city']; ?><br>
    					<b>Zip: </b><?php echo $result['zip']; ?><br>
    					<b>Country: </b><?php echo $result['country']; ?><br>
    				
                        <?php } } ?>    
    				</address>
    			</div>
    			
    		</div>
    		<div class="row">
    			<div class="col-xs-6">
    				<address>
    					<strong>Payment Method:</strong><br>
    					Cash On Delivery
    				</address>
    			</div>
    			<div class="col-xs-6 text-right">
    				<address>
    					<strong>Order Date:</strong><br>
                        <?php
                            $cmrId = Session::get("cmrId");
                            $getdata = $ct->getIovioce($orderId,$cmrId);
                            if ($getdata) {
                                    while ($result = $getdata->fetch_assoc()) {
                                ?>

                                <?php echo $result['date']; ?>
    					<?php } }  ?>
    				</address>
    			</div>
    		</div>
    	</div>
    </div>
    
    <div class="row">
    	<div class="col-md-12">
    		<div class="panel panel-default">
    			<div class="panel-heading">
    				<h3 class="panel-title"><strong>Order summary</strong></h3>
    			</div>
    			<div class="panel-body">
    				<div class="table-responsive">
    					<table class="table table-striped">
    						<thead>
                                <tr>
        							
        							<td class="text-center"><strong>Product</strong></td>
        							<td class="text-center"><strong>Image</strong></td>
        							<td class="text-center"><strong>Quantity</strong></td>
                                    <td class="text-center"><strong>Price</strong></td>
        							<td class="text-right"><strong>Status</strong></td>
                                </tr>
    						</thead>
    						<tbody>
    							<!-- foreach ($order->lineItems as $line) or some such thing here -->
                                <?php
                                    $cmrId = Session::get("cmrId");
                                    $getdata = $ct->getIovioce($orderId,$cmrId);
                                    if ($getdata) {
                                            while ($result = $getdata->fetch_assoc()) {
                                        ?>
                                <tr>
        							
        							<td class="text-center"><?php echo $result['productName']; ?></td>
                                    <td class="text-center"><img src="superadmin/<?php echo $result['image']; ?>" alt="" class="img img-responsive"/></td>
        							<td class="text-center"><?php echo $result['quantity']; ?></td>
        							<td class="text-center"><?php echo $result['price']; ?></td>
                                    <td class="text-center"><?php 
                                        if ($result['status'] == '0') {
                                            echo "<span style='color:red'>Pending</span>";
                                        }else{
                                            echo "<span style='color:green'>Delivered</span>";
                                        }
                                    ?></td>        						
                                </tr>
                                            <?php } } ?>
    							
    						
    						</tbody>
    					</table>

    				</div>
    			</div>
    		</div>
    	</div>
    </div>
</div>

<?php include_once 'inc/footer.php'; ?>
