<!DOCTYPE html>
<html>
<head>
<title>View Image</title>
<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<div id="content">


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
    $_SESSION['status']= "Invalid Extension";
      $_SESSION['status_code']="error";
    }
  else{
    // image file directory
    $target = "images/".basename($image);
    $sql = "UPDATE images set image='$image' where id=28";
    // execute query
    mysqli_query($db, $sql);

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

  
  <form method="POST" action="index.php" enctype="multipart/form-data">

  
    <div>
    <button type="return" name="return" value= "return">RETURN</button>
    </div>
  </form>
  

  
  
  </div>
</body>
</html>