<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
<?php
if(isset($_POST['submit']))
{
require_once("db.php");
$id=time();
$name=$_POST['username'];
$email=$_POST['email'];
$password=$_POST['password'];
$type=$_POST['selectbasic'];
$created_at= date('d-m-Y');
$updated_at= date('d-m-Y');


$sql="insert into users(id,name,email,password,type,created_at,updated_at)values('$id','$name','$email','$password','$type','$created_at','$updated_at')";
$run=$conn->query($sql);
if($run)
{
    echo "";
}
else
{
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}
}

?>
<form action="signup.php" method="post" >
<div class="form-group">
 
    <input type="name" name="username" placeholder="name">
  </div>

  <div class="form-group">
    
    <input type="email"  name="email" placeholder="email" >
  </div>
  <div class="form-group">
  
    <input type="password" name="password" placeholder="password" >
  </div>
  <div class="form-group">
    <label for="exampleFormControlSelect1">type select</label>
    <select name="selectbasic">
      <option value="c" name="c">corporate</option>
      <option value="s" name="s">startup</option>
 </select>
  </div>

  <input type="submit"  name="submit" value="Submit" >

</form>



<a class="nav-link " href="login.php" tabindex="-1" aria-disabled="true">Login</a>

  
</body>
</html>