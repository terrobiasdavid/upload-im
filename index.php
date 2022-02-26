<?php
  // Create database connection
  $db = mysqli_connect("localhost", "root", "", "image_upload");


  // If upload button is clicked ...
  if (isset($_POST['upload'])) {
  	// Get image name
  	$image = $_FILES['image']['name'];
  	// Get text


	$imageName = $_FILES["image"]["name"];
  	$validImageExtension = ['jpg', 'jpeg', 'png'];	
	$imageExtension = explode('.', $imageName);
	$imageExtension = strtolower(end($imageExtension));
	
	if(!in_array($imageExtension, $validImageExtension)){
		$_SESSION['status']= "Invalid Request";
   		$_SESSION['status_code']="error";
		}
	else{
  	// image file directory
  	$target = "images/".basename($image);
  	$sql = "UPDATE images set image='$image' where id=28";

  	$sqq="INSERT into images (image) values ('$image')";
  	// execute query
  	mysqli_query($db, $sqq);

  	if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
  		

    session_start();
   	 $_SESSION['status']= "Image has been uploaded successfully";
 	 $_SESSION['status_code']="success";

  	}else{
  		$_SESSION['status']= "Failed to upload image";
   		$_SESSION['status_code']="error";
  		
  	}
  	}
	}
?>

<!DOCTYPE html>
<html>
<head>
<title>Image Upload</title>
<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<div id="content">


  
  <form method="POST" action="index.php" enctype="multipart/form-data">
  	<input type="hidden" name="size" value="1000000">
  	<div>
  	  <input type="file" name="image">`
  	</div>
  
      
  	
  	<div>
  		<button type="submit" name="upload">UPLOAD</button>
	
  	</div>
  </form>

     <form method="POST" action="viewimage.php" enctype="multipart/form-data">
    	<button type="image" name="image" value= "image">VIEW</button>
</form>
  

  <?php
  $result = mysqli_query($db, "SELECT * FROM images");
  
  if (isset($_POST['image'])) {
 while ($row = mysqli_fetch_array($result)) {
      echo "<div id='img_div'>";
      	echo "<img src='images/".$row['image']."' >";
      	echo "<p>".$row['image_text']."</p>";
      echo "</div>";
    }
  }
    
  ?>
	
</div>
</body>
</html>

<script src="js/sweetalert.min.js"></script>

<?php 
    
    if(isset($_SESSION['status']))
    {
        ?>
            <script>
            	swal({
            		title: "<?php echo $_SESSION['status']; ?>",
            		//text: "You clicked the button!",
            		icon: "<?php echo $_SESSION['status_code']; ?>",
            		button: "Aww yiss!",
            	});

            </script>
        <?php 
        unset($_SESSION['status']);
    }

?>

