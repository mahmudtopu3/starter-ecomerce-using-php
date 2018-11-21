<?php 
	include_once 'lib/Session.php';
    Session::init();
	$login = Session::get("Custlogin");
	if ($login == false) {
		header("Location: index.php");
	}
 ?>
<?php include_once 'inc/header.php'; ?>
<?php 

	


	if (isset($_GET['delpro'])) {
		$delId = preg_replace('/[^-a-zA-Z0-9_]/', '', $_GET['delpro']);
		$delProduct = $ct->delProductByCart($delId);
	}

	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		$cartId = $_POST['cartId'];
		$quantity = $_POST['quantity'];
		$updateCart = $ct->updateCartQuantity($cartId, $quantity);
		if ($quantity <= 0) {
			$delProduct = $ct->delProductByCart($cartId);
		}
	}

	if (!isset($_GET['id'])) {
		echo "<meta http-equiv='refresh' content='0;URL=?id=live'/>";
	}
 ?>

    <!-- Page Content -->
    <div class="container">

       


          <!-- Title -->
          <div class="row text-center">
            <div class="col-lg-12">
                <h3 >Your Cart:<b>
                   
                </b></h3>

            <?php 
		    	if (isset($updateCart)) {
		    		echo $updateCart;
		    	}

		    	if (isset($delProduct)) {
		    		echo $delProduct;
		    	}
		     ?>
					<table class="table table-bordered">
						<tr>
							<th width="5%">Sl.</th>
							<th width="30%">Product Name</th>
							<th width="10%">Image</th>
							<th width="15%">Price</th>
							<th width="15%">Quantity</th>
							<th width="15%">Total Price</th>
							<th width="10%">Action</th>
						</tr>
			<?php 
				$getPro = $ct->getCartProduct();
				if ($getPro) {
					$i = 0;
					$sum = 0;
					$qty = 0;
					while ($result = $getPro->fetch_assoc()) {
						$i++;
			 ?>
						<tr>
							<td><?php echo $i; ?></td>
							<td><?php echo $result['productName']; ?></td>
							<td><img src="superadmin/<?php echo $result['image']; ?>" alt="" class="img img-responsive"/></td>
							<td>Tk. <?php echo $result['price']; ?></td>
					<td>
						<form action="" method="post">
                        <div class="form-group">
							<input type="hidden" name="cartId" value="<?php echo $result['cartId']; ?>"/>
							<input class="form-control"type="number" name="quantity" value="<?php echo $result['quantity']; ?>"/>
							<hr>
                            <input class="btn btn-success btn-block" type="submit" name="submit" value="Update"/>
                            </div>
                            </div>
						</form>
					</td>
							<td>Tk. <?php 
								$total = $result['price'] * $result['quantity'];
								echo $total;
							 ?></td>
							<td><a class="btn btn-danger"onclick="return confirm('Are you sure to delete !');" href="?delpro=<?php echo $result['cartId']; ?>">X</a></td>
						</tr>
						<?php
							$qty = $qty + $result['quantity'];
							$sum = $sum+$total;
							Session::set("qty", $qty);
							Session::set("sum", $sum);
						 ?>
			<?php } } ?>
					</table>
					<table style="float:right;text-align:left;" width="40%">
					<?php 
						$getData = $ct->checkCartTable();
							if ($getData) {
					 ?>
						<tr>
							<th>Sub Total : </th>
							<td>TK. <?php echo $sum; ?></td>
						</tr>
						<tr>
							<th>VAT : </th>
							<td>TK. 10%</td>
						</tr>
						<tr>
							<th>Grand Total :</th>
							<td>TK.<?php 
								$vat = $sum * 0.10;
								$gtotal = $sum + $vat;
								 echo $gtotal;
							 ?></td>
						</tr>
					<?php }else{
						//echo "Cart empty !";
						
					} ?>
				   </table>
            
        </div>
         
        <hr>
        <div class="row text-center">
            <div class="col-lg-12">
            <hr>
                <a href="index.php" class="btn btn-danger">Continue Shoping</a>
                <a href="checkout.php" class="btn btn-success">Checkout</a>
            </div>
        </div>

    </div>
   
       
      
        <hr>


  <?php include_once 'inc/footer.php'; ?>
