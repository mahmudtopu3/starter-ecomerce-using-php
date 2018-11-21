
<?php
	include_once 'lib/Session.php';
    Session::init();

    include 'lib/Database.php';
    include 'helpers/Format.php';

    spl_autoload_register(function($class){
    	include_once 'classes/'.$class.".php";
    });

    $db = new Database();
    $fm = new Format();
    $pd = new Product();
   
    $cat = new Category();
    $ct = new Cart();
    $cmr = new Customer();

	header("Cache-Control: no-cache, must-revalidate");
    header("Pragma: no-cache"); 
    header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); 
    header("Cache-Control: max-age=2592000");
 ?>
  
  <?php
	

	if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['signup'])) {
        $customerReg = $cmr->customerRegistration($_POST, $_FILES);
    }
 
    if (isset($customerReg)) {
        echo $customerReg;
    }
 
 ?>
 <?php
	$login = Session::get("Custlogin");
	if ($login == true) {
		//header("Location:index.php");
	}

	if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['login'])) {
        $custLogin = $cmr->customerLogin($_POST);
    }
 ?>
   <!--Logout Functionality-->
   <?php 
        if (isset($_GET['cmrId'])) {
            $delData = $ct->delCustomerCart();
            Session::destroy();
        }
                ?>
 <!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>My Shop</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/heroic-features.css" rel="stylesheet">
    <link href="css/custom.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php"> <i class="glyphicon glyphicon-th-large"></i> My Shop </a> 
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li>
                        <a href="about.php">About</a>
                    </li>
                    <li>
                        <a href="products.php">Products</a>
                    </li>
                    
                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">Brands
                        <span class="caret"></span></a>
                        <ul class="dropdown-menu scrollable-menu">
						<?php
                        	$getBr = $pd->getAllBrand();
                        		if ($getBr) {
                           			 while ($result = $getBr->fetch_assoc()) {
                   			 ?>
             

            
						  <li><a href="productsbybrand.php?brandId=<?php echo $result['brandId']; ?>"><?php echo $result['brandName']; ?></a></li>
						  <?php }	} ?>
                         
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">Categories
                        <span class="caret"></span></a>
                        <ul class="dropdown-menu scrollable-menu">
                            <?php
                        	$getCt = $pd->getAllCat();
                        		if ($getCt) {
                           			 while ($result = $getCt->fetch_assoc()) {
                   			 ?>
             

            
						  <li><a href="productsbycat.php?catId=<?php echo $result['catId']; ?>"><?php echo $result['catName']; ?></a></li>
						  <?php }	} ?>
                        </ul>
					</li>
					<li>
                        <a href="contact.php">Contact</a>
                    </li>
                </ul>
                <form class="navbar-form navbar-left" action="search.php" method="get">
                    <div class="form-group">
                      <input type="text" class="form-control" placeholder="Search" name="q">
                    </div>
                    <button type="submit" class="btn btn-danger">Submit</button>
				  </form>
                  
                        <?php
                        if ($login == false) {
		                   
                  ?>
    
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="#" data-toggle="modal" data-target="#dd"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
                    <li><a href="#" data-toggle="modal" data-target="#login"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
                  </ul>
                      <?php } else { ?>
                    <ul class="nav navbar-nav navbar-left">
                    <?php 
                        $getPro = $ct->getCartProduct();
                        if ($getPro) {
                            $i = 1;
                            $sum = 0;
                           
                            while ($result = $getPro->fetch_assoc()) {
                                $sum=$sum+$i;
                    ?>
                    <?php } } ?>
                    <li><a href="cart.php" ><span class="glyphicon glyphicon-shopping-cart"></span> Cart <?php if(isset($sum)){echo $sum;}?></a></li>
                
                  </ul>

                   <ul class="nav navbar-nav navbar-right">
                            <?php
                        $id = Session::get("cmrId");
                        $getdata = $cmr->getCustomerData($id);
                        if ($getdata) {
                            while ($result = $getdata->fetch_assoc()) {
                             ?>

                     <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#"><?php echo $result['name']; ?>
                        <span class="caret"></span></a>
                        <ul class="dropdown-menu ">
                           
						  <li><a href="profile.php">Profile</a></li>
						  <li><a href="order.php">My Orders</a></li>
                       
						  <li><a href="?cmrId=<?php echo Session::get('cmrId'); ?>">Logout</a></li>
						 
                        </ul>
					</li>


                       <?php } } ?>
                
                  </ul>
                 <?php }?>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>