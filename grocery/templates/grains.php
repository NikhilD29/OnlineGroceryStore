<?php
$path = $_SERVER['DOCUMENT_ROOT'];
$path .= "/grocery/";
require_once($path . 'connect.php');
// Initialize the session
session_start();
?>
<?php require($path . 'templates/header.php') ?>
	<div class="d-flex mt-4 mx-4">
        <h3>Welcome to Online Grocery Store,
        	<b><?php // check user login and output username
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
        ?>
        <h1 class="heading">Food Grains & Oil</h1>
        </b>
            <div class="row main-section">
            <?php
            $SelSql = "SELECT * FROM `products` WHERE category='grains'";
            $res = mysqli_query($connection, $SelSql);
            $num_of_rows = mysqli_num_rows($res);
            if ($num_of_rows > 0) {
                // output data of each row
                while($num_of_rows > 0) {
                    $num_of_rows--;
                    $r = mysqli_fetch_assoc($res);
                    require($path . 'templates/product.php') ;
                }
            } else {
                echo "<p>No Products Available</p>";
            }
        	?> 	
            </div>
        </h3>
    </div>

    <?php require($path . 'templates/footer.php') ?>