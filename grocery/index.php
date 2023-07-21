<?php
require_once ('connect.php');

session_start();

?>
<?php require('templates/header.php') ?>
	<div class="d-flex mt-4 mx-4">
        <h3>Welcome to Online Grocery Store,
        	<b><?php 
			if ($user_logged) {
				$user_id = ($_SESSION['id']);
				$select_sql = "SELECT name FROM `users` WHERE id='$user_id'";
				$result = mysqli_query($connection, $select_sql);
				if ($result->num_rows > 0) {
					$row = mysqli_fetch_assoc($result);
					echo $row["name"];
					if (!$row["name"]) {
						 echo "Guest";
					}
				}
			} else {
			    echo "Guest";
			}
        	?></b> 	
        </h3>
				<!--Menu-->
	<div class="menu">
	<head>
    <title>Menu</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Pathway+Gothic+One" />
    <link href="css/cssmenu.css" rel="stylesheet" />
    <style>
        body {
            margin:0;
            background:#FFFFFF;
        }
        #menuDemo { text-align:center; padding:5px 8px; }
    </style>
</head>
<body>
<div id="menuDemo">

<div id="cssmenu">
    <ul>
        <li>
            <span>Shop by Category </span>
            <ul class="dropdown">
                <li><a href="templates/Vegetable.php">Vegetables</a></li>
                <li><a href="templates/fruits.php">Fruits</a></li>
                <li><a href="templates/beauty.php">Beauty & Hygiene</a></li>
                <li><a href="templates/grains.php">Food Grains & Oil</a></li>
                <li><a href="templates/cleaning.php">Cleaning & Household</a></li>
            </ul>
        </li>
        <li><a href="templates/offer.php">Offers</a></li>
                </li>
            </ul>
        </li>
  
</div>
	</div>
</div>
</body>
</html>
</div>
	<div class="row-g">
        <div class="col-1">
            <h2>Eat Fresh! <br>Stay Healthy!</h2>
           <a href="#middle" class="btn2">Explore</a>
        </div>
            <img src="img/products/Groc.png">
        </div>
		
    <div class="d-flex my-2">
	<?php 
      	if(isset($smsg)){ ?><div class="alert alert-success" role="alert"> <?php echo $smsg; ?> </div><?php } ?>
    <?php if(isset($fmsg)){ ?><div class="alert alert-danger" role="alert"> <?php echo $fmsg; ?> </div><?php } ?>
    </div>

				<!--Featured Groceries-->

	<h1 id="middle" class="heading">Featured Groceries</h1>
	<div class="row main-section">
      <?php 
		$SelSql = "SELECT * FROM `products` WHERE id in (27,40,33,38,42,44,47,31)";
		$res = mysqli_query($connection, $SelSql);
		$num_of_rows = mysqli_num_rows($res);
		if ($num_of_rows > 0) {
	    	
		    while($num_of_rows > 0) {
		    	$num_of_rows--;
		    	$r = mysqli_fetch_assoc($res);
		        include('templates/product.php');
		    }
		} else {
		    echo "<p>No Products Available</p>";
		}
	?>
		</div>

				<!--Offer Section-->

	<h1 class="heading">Today's Special Offer</h1>
    <div class="d-flex my-2">
	<?php 
      	if(isset($smsg)){ ?><div class="alert alert-success" role="alert"> <?php echo $smsg; ?> </div><?php } ?>
    <?php if(isset($fmsg)){ ?><div class="alert alert-danger" role="alert"> <?php echo $fmsg; ?> </div><?php } ?>
    </div>

	<div class="rowg">
      <?php 
		$SelSql = "SELECT * FROM `products` WHERE id = 36";
		$res = mysqli_query($connection, $SelSql);
		$num_of_rows = mysqli_num_rows($res);
		if ($num_of_rows > 0) {
	    	
		    while($num_of_rows > 0) {
		    	$num_of_rows--;
		    	$r = mysqli_fetch_assoc($res);
		        include('templates/product.php');
		    }
		} else {
		    echo "<p>No Products Available</p>";
		}
	?>
	</div>

<?php require('templates/footer.php') ?>