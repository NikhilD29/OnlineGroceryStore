<?php
$path = $_SERVER['DOCUMENT_ROOT'];
$path .= "/grocery/";

require_once($path . 'connect.php');

session_start();

if (!(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true && $_SESSION['role'] == 'admin')) {
	echo "Unauthorized Access";
	return;
}

$id = $_GET['id'];

$SelSql = "SELECT * FROM `products` WHERE id=$id";
$res = mysqli_query($connection, $SelSql);
$r = mysqli_fetch_assoc($res);


if(isset($_POST) & !empty($_POST)){
	$title = ($_POST['title']);
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
    }else {
    	$image = $r['image'];
    }

	$query = "UPDATE `products` SET title='$title', price='$price', brand='$brand', image='$image' WHERE id='$id'";
	
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
				<input type="text" class="form-control" name="title" value="<?php echo $r['title'];?>" required/>
            </div> 
            <div class="form-group">
                <label>New Price</label>
				<input type="text" class="form-control" name="price" value="<?php echo $r['price'];?>" required/>
            </div> 
            <div class="form-group">
                <label>Brand</label>
				<input type="text" class="form-control" name="brand" value="<?php echo $r['brand'];?>"/>
            </div> 
            <div class="form-group">
                <label>New Image</label>
				<input type="file" class="form-control" name="image" accept=".png,.gif,.jpg,.webp"/>
            </div> 
			<input type="submit" class="btn btn-primary" value="Update" />
		</form>
	</div>
	
<?php require_once($path . 'templates/footer.php') ?>