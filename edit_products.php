<?php
	session_start();
	include 'connection.php';
	$link = connect();
	$sql = "SELECT * FROM products";
	$result= mysqli_query($link,$sql);
			if(mysqli_num_rows($result) > 0){
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>1ST LOOK</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/prettyPhoto.css" rel="stylesheet">
    <link href="css/price-range.css" rel="stylesheet">
    <link href="css/animate.css" rel="stylesheet">
	<link href="css/main.css" rel="stylesheet">
	<link href="css/responsive.css" rel="stylesheet">
    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->       
    <link rel="shortcut icon" href="images/ico/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="images/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="images/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="images/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="images/ico/apple-touch-icon-57-precomposed.png">
</head><!--/head-->

<script>
 function UpdateTable()
{
 document.getElementById("update").style.display="none";

 var Pid_new=document.getElementById("new_Pid").value;	
 var Pname_new=document.getElementById("new_Pname").value;
 //Pid_new=document.write(Pid_new);
 var Pprice_new=document.getElementById("new_Pprice").value;
 var quantity_new=document.getElementById("new_quantity").value;
document.cookie = "Pid_n = " + Pid_new;
document.cookie = "Pname_n = " + Pname_new;
document.cookie = "Pprice_n = " + Pprice_new;
document.cookie = "quantity_n = " + quantity_new;


alert(quantity_new);
}
    </script>
    <body>
        <form id="my_form" method="POST">
    <header id="header"><!--header-->
		<div class="header-middle"><!--header-top-->
			<div class="container">
				<div class="row" >
					<div class="col-sm-8">
						<div class="shop-menu pull-left">
							<ul class="nav navbar-nav">
							    <li><?php echo "Welcome: ", $_SESSION['firstname'] ?></li>
								<li><a href="admin.php">Home</a></li>
								<li><a href="admin_users.php?admin_users">Manage Users</a></li>
                                <li><a href="admin_products.php?admin_products" class="active">Manage Products</a></li>
								<li><a href="admin_orders.php?admin_orders">Manage Orders</a></li>
								<li><a href="logout.php"><i class="fa fa-lock"></i>Logout</a>
								</li>
							</ul>
						</div>
					</div>
				</div>
					
			</div>
		</div><!--/header-top-->
	
	</header><!--/header-->
	
	<h2 class="title text-center"><br>Manage Products</h2>
	
                <table class="table table-condensed">
					<thead>
						<tr class="cart_menu">
                        <th>Product ID</th>
                         <th>Name</th> 
                         <th>Price</th>
                         <th>Quantity</th>
                         <th>Category</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                    </thead>
              
<?php

			  while($row=mysqli_fetch_assoc($result)){
			   $Pid = $row['Pid'];
			   $_SESSION['Pid']=$Pid;
			   $Pname = $row['Pname'];
			   $Pprice = $row['Pprice'];
			   $quantity = $row['quantity'];
			   $category = $row['category'];
			   
	/////////////////////////// Edit Abidha/////////////////////////
	if(isset($_POST['update_quantity_abidha'])){
	  
	            $new_Pid = $_COOKIE['Pid_n'];
		        $new_Pname =  $_COOKIE['Pname_n'];
		    	$new_Pprice = $_COOKIE['Pprice_n'];
                $new_quantity = $_COOKIE['quantity_n'];

		        $sql_new = "SELECT Pid, Pname, Pprice, quantity, image, category FROM products WHERE Pid='$new_Pid'";
		      	
		      	$result3= mysqli_query($link,$sql_new);  
		      	 if(mysqli_num_rows($result3)){
		    	$update_quantity_new = "UPDATE products SET Pname='$new_Pname', Pprice='$new_Pprice', quantity='$new_quantity' WHERE Pid='$new_Pid'";
	            $run_update = mysqli_query($link,$update_quantity_new); 

	           
	     }
	     ///////////////////////////Edit End ABIDHA/////////////////////////
		}
		//////////////End Edit////////
		
		///////////////////////////DELETE/////////////////////////
		if(isset($_GET['delete'])){
		    
	                $x=((int)$_GET['delete']);
	                $sql3 = "SELECT  Pid, Pname, Pprice, quantity, image, category FROM products WHERE Pid='$x'";
	                $result3= mysqli_query($link,$sql3);  
	     
	               $sql5 = " DELETE FROM products WHERE Pid='$x'";
	               $result5= mysqli_query($link,$sql5);
	     }
	      
		//////////////End DELETE////////

?>

              <tr>
                <td><input type="text" name ="new_Pid" id= "new_Pid" value="<?php echo $Pid?>" readonly ></input></td>
                <td><input type="text" name ="new_Pname" id= "new_Pname" value="<?php echo $Pname?>"></input></td>
                <td><input type="text" name ="new_Pprice" id= "new_Pprice" value="<?php echo $Pprice?>"></input></td>
                <td><input type="text" name ="new_quantity" id= "new_quantity" value="<?php echo $quantity?>"></input></td>
                <td><?php echo $category?></td>
                <td><input type="submit" name="update_quantity_abidha" formaction="/~kimd35/1st_look/edit_products.php" value="Update" id="update" onclick="UpdateTable();"/></td>
                <div id="msg"></div>
                <td><a class="cart_quantity_delete" href="admin_products.php?delete= <?php echo $row['Pid']; ?>">Delete</a></td>
              </tr>
              
           <?php
			  
			  }
           ?>
     
        </table>
        
    <footer id="footer"><!--Footer-->
		<div class="footer-top">
			<div class="container">
				<div class="row">
					
					<div class="col-sm-2"><!--Container 1-->
						<div class="companyinfo">
							<h2><span>1ST</span>LOOK</h2>
							<p>Best Korean Outfit</p>
						</div>
					</div><!--End Container 1-->

					
					<div class="col-sm-2"><!--Container 2-->
						<div class="#">
							
						</div>
					</div><!--End Container 2-->
					
					
						<div class="col-sm-2"><!--Container 3-->
						<div class="companyinfo">
							<h2><span>Contact Us</span></h2>
							<p>Email: 1stlook@gmail.com</p>
							<p>Phone: 201-666-5544</p>
						</div>
					</div><!--End Container 3-->
					
						<div class="col-sm-2"><!--Container 4-->
						<div class="#">
							
						</div>
					</div><!--End Container 4-->
					
					<div class="col-sm-3"><!--Container 5-->
						<div class="address">
							<img src="images/home/map.png" alt="" />
							<p>1 Normal Ave, Montclair, NJ</p>
						</div>
					</div><!--End Container 5-->
				</div>
			</div>
		</div>
	</footer><!--/Footer-->

    <script src="js/jquery.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/jquery.scrollUp.min.js"></script>
	<script src="js/price-range.js"></script>
    <script src="js/jquery.prettyPhoto.js"></script>
    <script src="js/main.js"></script>
        </form>
    </body>
</html>

<?php

		} else{
				echo "Can't find another products. Try later.";
				}
		$link->close();   
		
?>

