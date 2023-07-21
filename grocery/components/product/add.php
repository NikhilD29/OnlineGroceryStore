<?php
$path = $_SERVER['DOCUMENT_ROOT'];
$path .= "/grocery/";

require_once($path . 'connect.php');

session_start();

if (!(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true && $_SESSION['role'] == 'admin')) {
	echo "Unauthorized Access";
	return;
}

if(isset($_POST) & !empty($_POST)){
	$title = ($_POST['title']);
	$category = ($_POST['category']);
	$price = ($_POST['price']);
	$brand = ($_POST['brand']);
    $image = $_FILES['image']['name']; 
    $dir="../img/products/";
    $temp_name=$_FILES['image']['tmp_name'];
    if($image!="")
    {
        if(file_exists($dir.$image))
        {
            $image= time().'_'.$image;
        }
        $fdir= $dir.$image;
        move_uploaded_file($temp_name, $fdir);
    }

	$query = "INSERT INTO `products` (title, category, price, brand, image) VALUES ('$title', '$category', '$price', '$brand', '$image')";
	$res = mysqli_query($connection, $query);
	if($res){
		header('location: view.php');
	}else{
		$fmsg = "Failed to Insert data.";
		print_r($res->error_list);
	}
}
?>

<?php require_once($path . 'templates/header.php') ?>

	<div class="container">
	<?php if(isset($fmsg)){ ?><div class="alert alert-danger" role="alert"> <?php echo $fmsg; ?> </div><?php } ?>
		<h2 class="my-4">Add New Product</h2>
		<form method="post" enctype="multipart/form-data">
			<div class="form-group">
                <label>Title</label>
				<input type="text" id="id" class="form-control" name="title" value="" required/>
            </div>
			<div class="form-group">
			<label for="category">Select a category:</label>
				<select name="category" id="category" class="form-control" required>
				<option value="vegetables">Vegetable</option>
				<option value="fruits">Fruits</option>
				<option value="beauty">Beauty</option>
				<option value="cleaning">Cleaning</option>
				<option value="grains">Grains</option>
				<option value="offer">Offer</option>
				</select> 
            </div>
                <!--<label>Category</label>
				<input type="text" id="id" class="form-control" name="category" value="" required/>
-->
            <div class="form-group">
                <label>Price</label>
				<input type="number" class="form-control" name="price" value="" required/>
            </div> 
            <div class="form-group">
                <label>Brand</label>
				<input type="text" class="form-control" name="brand" value=""/>
            </div> 
            <div class="form-group">
                <label>Image</label>
				<input type="file" class="form-control" name="image" accept=".png,.gif,.jpg,.webp" required/>
            </div> 
			<input type="submit" class="btn btn-primary" value="Add Product" />
		</form>
	</div>
	
<?php require_once($path . 'templates/footer.php') ?>