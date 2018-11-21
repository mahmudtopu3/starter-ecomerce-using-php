
<!--lOGIN-->
<div class="modal fade" id="login" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Login Form</h4>
        </div>
        <div class="modal-body">
          
            <form action="" method="post">
              <div class="form-group">
                <label for="email">Email address:</label>
                <input type="email" class="form-control" id="email"  name="email">
              </div>
              <div class="form-group">
                <label for="pwd">Password:</label>
                <input type="password" class="form-control" id="pwd" name="pass">
              </div>
              
              <button name="login" type="submit" class="btn btn-success">Submit</button>
            </form> 
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
   
	 
	 <!-- //LOGIN -->
	 
<!--SIGNUP-->
<div class="modal fade" id="dd" role="dialog">
    <div class="modal-dialog modal-lg">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Modal Header</h4>
        </div>
        <div class="modal-body" id="d">
        <form action="" method="post">
          <div class="col-md-6">
             <div class="form-group">
                <label for="email">Email address:</label>
                <input type="email" class="form-control" id="email"  name="email">
              </div>
              <div class="form-group">
                <label for="pwd">Password:</label>
                <input type="password" class="form-control" id="pwd" name="pass">
              </div>
              <div class="form-group">
                <label for="email">Name:</label>
                <input type="text" class="form-control" id="email"  name="name">
              </div>
              <div class="form-group">
                <label for="email">City:</label>
                <input type="text" class="form-control" id="email"  name="city">
              </div>
          </div>
          <div class="col-md-6">
          
          
              <div class="form-group">
                <label for="email">Zip Code:</label>
                <input type="text" class="form-control" id="email"  name="zip">
              </div>
              <div class="form-group">
                <label for="email">Address:</label>
                <input type="text" class="form-control" id="email"  name="address">
              </div>
              <div class="form-group">
                <label for="email">Country:</label>
                <input type="text" class="form-control" id="email"  name="country">
              </div>
              <div class="form-group">
                <label for="email">Phone:</label>
                <input type="text" class="form-control" id="email"  name="phone">
              </div>
              <button name="signup" type="submit" class="btn btn-success">Submit</button>
          </div>
              
              
              
            </form> 
        </div>
        <div class="row"></div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
  
	 <!-- //SIGNUP -->
     <!--Product Modals--->
     <div id="dataModal" class="modal fade">  
            <div class="modal-dialog modal-lg">  
                <div class="modal-content">  
                        <div class="modal-header">  
                            <button type="button" class="close" data-dismiss="modal">&times;</button>  
                            <h4 class="modal-title">Product Details</h4>  
                        </div>  
                        <div class="modal-body" id="product_detail">  
                        </div>  
                        <div class="modal-footer">  
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>  
                        </div>  
                </div>  
            </div>  
        </div> 
        

        
           <!--Product Modals--->


	 <!-- Footer -->
        <footer>
            <div class="row text-center">
                <div class="col-lg-12">
                    <p>Copyright  &copy; My Shop, 2018</p>
                </div>
            </div>
        </footer>

    </div>
    <!-- /.container -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>
    <script>  
      $(document).ready(function(){  
            $('.view_data').click(function(){  
                var product_id = $(this).attr("id");  
                $.ajax({  
                      url:"select.php",  
                      method:"post",  
                      data:{send_id:product_id},  
                      success:function(data){  
                          $('#product_detail').html(data);  
                          $('#dataModal').modal("show");  
                      }  
                });  
            });  
      });  
 </script>

</body>

</html>
