<!DOCTYPE html>
<html>
<head>
<title>View Image</title>
<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<div id="content">


  <?php
   $db = mysqli_connect("localhost", "root", "", "image_upload");
  $result = mysqli_query($db, "SELECT * FROM images");
  
  if (isset($_POST['image'])) {
 while ($row = mysqli_fetch_array($result)) {
      echo "<div id='img_div'>";
      	echo "<img src='images/".$row['image']."' >";
      echo "</div>";
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