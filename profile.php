<?php 
	include_once 'lib/Session.php';
    Session::init();
	$login = Session::get("Custlogin");
	if ($login == false) {
		header("Location: index.php");
	}
 ?>
<?php include_once 'inc/header.php'; ?>


      

        <!-- Page Features -->
        <div class="row text-center">

       
                <div class="row">
                <div class="col-lg-12">
                   <?php
                        $id = Session::get("cmrId");
                        $getdata = $cmr->getCustomerData($id);
                        if ($getdata) {
                            while ($result = $getdata->fetch_assoc()) {
                    ?>
                    <table class="table">
				<tr>
					<td colspan="3"><h2>User Profile Details</h2></td>
				</tr>
				<tr>
					<td width="20%">Name</td>
					<td width="5%">:</td>
					<td><?php echo $result['name']; ?></td>
				</tr>
				<tr>
					<td>Phone</td>
					<td>:</td>
					<td><?php echo $result['phone']; ?></td>
				</tr>
				<tr>
					<td>Email</td>
					<td>:</td>
					<td><?php echo $result['email']; ?></td>
				</tr>
				<tr>
					<td>Address</td>
					<td>:</td>
					<td><?php echo $result['address']; ?></td>
				</tr>
				<tr>
					<td>City</td>
					<td>:</td>
					<td><?php echo $result['city']; ?></td>
				</tr>
				<tr>
					<td>Zipcode</td>
					<td>:</td>
					<td><?php echo $result['zip']; ?></td>
				</tr>
				<tr>
					<td>Country</td>
					<td>:</td>
					<td><?php echo $result['country']; ?></td>
				</tr>
				<tr>
					<td></td>
					<td></td>
					<td><a href="editprofile.php">Update Details</a></td>
				</tr>
			</table>
                    <h3>Please Watch Our Other Products <a href="products.php">Here</a></h3>
                    <?php } } ?>
                    </div>
                </div>
               </div>
          


        </div>
   
       
        <!-- /.row -->
    
        <hr>

  <?php include_once 'inc/footer.php'; ?>
