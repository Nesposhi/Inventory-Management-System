<?php
  include 'connect.php';
    $id = $_GET['updateid'];
    $sql = "SELECT * FROM `crud` WHERE id=$id";
    $result = mysqli_query($con, $sql);
    $row = mysqli_fetch_assoc($result);

    $name = $row['name'];
    $email = $row['email']; 
    $mobile = $row['mobile'];
    $password = $row['password'];


  if(isset($_POST['submit'])){
    $name=$_POST['name'];
    $email=$_POST['email'];
    $mobile=$_POST['mobile'];
    $password=$_POST['password'];

    $sql="UPDATE  crud SET  name='$name', email='$email', mobile='$mobile', password='$password' WHERE id='$id'";
    $result=mysqli_query($con,$sql);
    if($result){
      header('location:display.php');
    }

    else{
            die(mysqli_error($con));
        }
  } 

?>


<!doctype html>
<html lang="ar" dir="rtl">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.rtl.min.css" integrity="sha384-Xbg45MqvDIk1e563NLpGEulpX6AvL404DP+/iCgW9eFa2BqztiwTexswJo2jLMue" crossorigin="anonymous">

    <title>crud</title>
  </head>
  <body>
    <form method="post">
 
  <div class="mb-3">
    <label >name</label>
    <input type="text" class="form-control" placeholder="Enter your name" name="name"  autocomplete="off" value="<?php echo $name; ?>" required>
  </div>
  <div class="mb-3">
    <label >email</label>
    <input type="email" class="form-control" placeholder="Enter your email" name="email" value="<?php echo $email; ?>" required>
  </div>
  <div class="mb-3">
    <label>mobile</label>
    <input type="text" class="form-control" placeholder="Enter your mobile" name="mobile" value="<?php echo $mobile; ?>" required>
  </div>
  <div class="mb-3">
    <label >Password</label>
    <input type="text" class="form-control" placeholder="Enter your password" name="password" value="<?php echo $password; ?>" required>
  </div>

  <button type="submit" name="submit" class="btn btn-primary">Submit</button>
</form>
  
  </body>
</html>