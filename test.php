<?php 
  session_start(); 

  if (!isset($_SESSION['username'])) {
    $_SESSION['msg'] = "You must log in first";
    header('location: login.php');
  }
  if (isset($_GET['logout'])) {
    session_destroy();
    unset($_SESSION['username']);
    header("location: login.php");
  }
  ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
	<title>Document</title>
	
	<meta charset="utf-8">
    <title>Smart Input</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">
  
  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,700,700i|Poppins:300,400,500,700" rel="stylesheet">

  <!-- Bootstrap CSS File -->
  <link href="lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- Libraries CSS Files -->
  <link href="lib/font-awesome/css/font-awesome.min.css" rel="stylesheet">
  <link href="lib/animate/animate.min.css" rel="stylesheet">
    <style>
        
        body {
    background: #f7f7f7;
    color: #404040;
    font-family: 'HelveticaNeue', 'Helvetica Neue', Helvetica, Arial, sans-serif;
    font-size: 13px;
    font-weight: normal;
    line-height: 20px;
    }


    .container, #main ,.form-group{
        
        margin-left: 100px;
        margin-right: 100px;
        height: 300px;
    }

    #main { margin-top: 50px }

    input {
        font-family: 'HelveticaNeue', 'Helvetica Neue', Helvetica, Arial, sans-serif;
        font-size: 13px;
        color: #555860;
        border: 1px solid #555860;
        margin : 5px;
    }

    h3{
        text-align: center;
        padding: 25px;
    }
    </style>
  

</head>
<body>

<!--==========================
  Header
  ============================-->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="#">Smart Search</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
  
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav ml-auto">
        <li class="nav-item"><a class="nav-link" href="index1.php">Search</a></li>
        <li class="nav-item active"><a class="nav-link" href="test.php">Add Documents</a></li>    
        <li class="nav-item">
        <?php if (isset($_SESSION['success'])) : ?>
      <div class="error success" >
        <h3>
          <?php 
            echo $_SESSION['success']; 
            unset($_SESSION['success']);
          ?>
        </h3>
      </div>
    <?php endif ?>

    <!-- logged in user information -->
    <?php  if (isset($_SESSION['username'])) : ?>
      <p> <a href="index.php?logout='1'" style="color: white;">logout</a> </p>
    <?php endif ?></li>
      
    
      </ul>
      
    </div>
  </nav>

<form method="post" action="test.php" enctype="multipart/form-data">
    <p>File :</p>
    <input type="file" name="Filename"> 
    
    
    <br/>
    <input TYPE="submit" value="submit" name="upload" value="Submit"/>
</form>


<?php
  $action = Isset($_REQUEST['upload'])?$_REQUEST['upload']:"";
  if($action == 'submit')
  {
  $fileExistsFlag=0;
	$fileName = $_FILES['Filename']['name']?? '';
  echo $fileName;
  $server_name="localhost";
  $host_name="myuser1";
  $password="elephant";
  $db="fileupload";
  $link = mysqli_connect($server_name,$host_name,$password,$db);

	$query = "SELECT filename FROM fileupload WHERE filename='$fileName'";	
	$result = $link->query($query) or die("Error : ".mysqli_error($link));
	while($row = mysqli_fetch_array($result)) {
		if($row['filename'] == $fileName) {
			$fileExistsFlag = 1;
		}		
	}
	/*
	* 	If file is not present in the destination folder
	*/
	if($fileExistsFlag == 0) { 
		$target = "files/";		
		$fileTarget = $target.$fileName;	
   $tempFileName = $_FILES["Filename"]["tmp_name"] ?? '';
	
		if($result) { 
			//echo "Your file <html><b><i>".$fileName."</i></b></html> has been successfully uploaded";		
			$query = "INSERT INTO fileupload(filepath,filename) VALUES ('$fileTarget','$tempFileName')";
      
			$links= mysqli_query($link,$query);
      echo $link;
      if($link)
      {
        echo 'danish';
       // die("Error : ".mysqli_error($link));			
      }
      else
      {
        echo "tadn";
      }
		}
		// else {			
		// 	echo "Sorry !!! There was an error in uploading your file";			
		// }
	
	}
	/*
	* 	If file is already present in the destination folder
	*/
	else {
	//	echo "File <html><b><i>".$fileName."</i></b></html> already exists in your folder. Please rename the file and try again.";
		mysqli_close($link);
	}

  }
  else
  {
     echo "change";
  }	
?>


</body>
</html>

