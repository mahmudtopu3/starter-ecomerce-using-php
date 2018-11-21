<?php 
include_once 'lib/Session.php';
Session::init();
$login = Session::get("Custlogin");
if ($login == false) {
    header("Location:index.php");
}
?>
<?php include_once 'inc/header.php'; ?>

<?php 
	

	$cmrId = Session::get("cmrId");
	if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
        $updateCmr = $cmr->customerUpdate($_POST, $cmrId);
    }
 ?>
      

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
    	 <form action="" method="post">
			<table class="table">
				<?php 
					if (isset($updateCmr)) { ?>
					<tr>
						<td colspan="2">
							<h2>
								<?php echo $updateCmr; ?>
							</h2>
						</td>
					</tr>	
				<?php	}
				 ?>
				
				<tr>
					<td colspan="2"><h2>Update Profile Details</h2></td>
				</tr>
				<tr>
					<td width="20%">Name</td>
					<td><input type="text" name="name" value="<?php echo $result['name']; ?>"></td>
				</tr>
				<tr>
					<td>Phone</td>
					<td><input type="text" name="phone" value="<?php echo $result['phone']; ?>"></td>
				</tr>
				<tr>
					<td>Email</td>
					<td><input type="text" name="email" value="<?php echo $result['email']; ?>"></td>
				</tr>
				<tr>
					<td>Address</td>
					<td><input type="text" name="address" value="<?php echo $result['address']; ?>"></td>
				</tr>
				<tr>
					<td>City</td>
					<td><input type="text" name="city" value="<?php echo $result['city']; ?>"></td>
				</tr>
				<tr>
					<td>Zipcode</td>
					<td><input type="text" name="zip" value="<?php echo $result['zip']; ?>"></td>
				</tr>
				<tr>
					<td>Country</td>
					<td><input type="text" name="country" value="<?php echo $result['country']; ?>"></td>
				</tr>
				<tr>
					<td></td>
					<td><input type="submit" name="submit" value="Save" class="btn btn-success"></td>
				</tr>
			</table>
		  </form>
		<?php } } ?>
                    </div>
                </div>
               </div>
          


        </div>
   
       
        <!-- /.row -->
    
        <hr>

  <?php include_once 'inc/footer.php'; ?>
