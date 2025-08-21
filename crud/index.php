<?php

include 'connect.php';


if(isset($_POST['save'])){
    $name=$_POST['name'];
    $email=$_POST['email'];
    $mobile=$_POST['mobile'];
    $password=$_POST['password'];

    $sql="INSERT INTO users (name, email, mobile, password) VALUES('$name', '$email', '$mobile', '$password')";
    $result=mysqli_query($conn,$sql);
    if($result){
      header('Location: index.php');
      exit();
    }

    else{
            die(mysqli_error($conn));
        }
  }


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Grid</title>
    <link rel="stylesheet" href="style.css">

     <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {

        var data = google.visualization.arrayToDataTable([
          ['Task', 'Hours per Day'],
          ['Work',     11],
          ['Eat',      2],
          ['Commute',  2],
          ['Watch TV', 2],
          ['Sleep',    7]
        ]);

        var options = {
          title: 'My Daily Activities'
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));

        chart.draw(data, options);
      }
   
</head>
<body>
    <nav>navbar</nav>
    <aside>
        <ul>
            <li onclick="showContent('dashboard')"> dashboard</li>
            <li onclick="showContent('addlist')">New user</li>
            <li onclick="showContent('listnames')"> list names</li>
            <li onclick="showContent('newproduct')">new product</li>
            <li onclick="showContent('listproduct')">list product</li>
        </ul>
    </aside>
    <main>
        <div class="content active" id="dashboard">
            <div class="grid-container">
                 <div class="item-1">
                    <div id="piechart" style="width: 400px; height: 250px;" chart></div>
                </div>
                 <div class="item-2">
                    <div id="piechart" style="width:  400px; height: 250px;" chart></div>
                 </div>
                 <div class="item-3">
                    <div id="piechart" style="width:  400px; height: 250px;" chart></div>
                 </div>
                 <div class="item-4">linear graph</div>
                 <div class="item-5">Bar Grapgh</div>
          </div>
        </div>
        
        <div class="content" id="addlist">
              <div class="AddContainer">
                <h3>New User</h3>

                <form action="" method="post" class="newuser">
                    <input type="text" name="name" placeholder="Enter  full Name" required>
                    <input type="email" name="email" placeholder="Enter  Email" required>
                    <input type="text" name="mobile" placeholder="Enter  Mobile number" required>
                    <input type="text" name="password" placeholder="Enter  password" required>
                    <button type="submit" name="save" >Save</button>
                
                </form>
              </div>
            
        </div>
        <div class="content" id="listnames">
        
            
            <div class="update active" id="listnames">
                          
            <div class="grid-container1">

             <?php
               $sql = "SELECT * FROM users";

                $result = mysqli_query($conn, $sql);
                while( $row = mysqli_fetch_assoc($result)){
                    ?>
                <div class="wrapper">
                     <div class="item1-1">image</div>
                     <div class="item1-2">
                             <p><?php echo $row['id'] ?></p>
                             <p><?php echo $row['name'] ?></p>
                             <p><?php echo $row['email'] ?></p>
                            <p><?php echo $row['mobile'] ?></p>
                          
                     </div>
                     <div class="item1-3">
                        <div>
                    
                            <button class="edit-btn" onclick="window.location.href='index.php?updateid=<?php echo $row['id']; ?>#updatelist';viewContent('updatelist');">Update</button>
                            <button class="delete-btn"><a href="delete.php?deleteid=<?php echo $row['id'] ?>">delete</a></button>
                        </div>
                     </div>
          
                </div>     
                   <?php
               }
               ?>
             
                
               </div>
            </div>

            <div class="update" id="updatelist">
                 <div class="AddContainer">

                 <?php
                     $id = $_GET['updateid'] ?? null;
                     if ($id !== null) {
                     $sql = "SELECT * FROM users WHERE id='$id'";
                    $result = mysqli_query($conn, $sql);
                   if ($row = mysqli_fetch_assoc($result)) {
                    $name = $row['name'];
                    $email = $row['email'];
                     $mobile = $row['mobile'];
                    $password = $row['password'];
                    } else {
                     $name = $email = $mobile = $password = '';
                        }
                   } else {
                     $name = $email = $mobile = $password = '';
                   }
                 

                  if(isset($_POST['update'])){
                    $name=$_POST['name'];
                    $email=$_POST['email'];
                       $mobile=$_POST['mobile'];
                    $password=$_POST['password'];
                      $sql="UPDATE  users SET  name='$name', email='$email', mobile='$mobile', password='$password' WHERE id='$id'";
                        $result=mysqli_query($conn,$sql);
                        if($result){
                       header('location:index.php');
                             }

                        else{
                        die(mysqli_error($conn));
                           }
                      } 

                                 ?>
                      <h3>Update User</h3>
                  <form action="" method="post" class="newuser">
                    <input type="text" name="name" placeholder="Enter  full Name" required value="<?php echo htmlspecialchars($name ?? ''); ?>">
                    <input type="email" name="email" placeholder="Enter  Email" required value="<?php echo htmlspecialchars($email ?? ''); ?>">
                    <input type="text" name="mobile" placeholder="Enter  Mobile number" required value="<?php echo htmlspecialchars($mobile ?? ''); ?>">
                    <input type="text" name="password" placeholder="Enter  password" required value="<?php echo htmlspecialchars($password ?? ''); ?>">
                    <button type="submit" name="update" >Save</button>
                
                    </form>
                 </div>
            </div>
            </div>
            

        </div>
                    

        <div class="content" id="newproduct">
            <?php

           if(isset($_POST['submit'])){
              $category=$_POST['category'];
              $quantity=$_POST['quantity'];
              $name=$_POST['name'];
          

             $sql="INSERT INTO products (category, name, Quantity) VALUES('$category', '$name' , '$quantity')";
             $result=mysqli_query($conn,$sql);
            if($result){
                 header('location:index.php');
              }

           else{
                  die(mysqli_error($conn));
                }
             }


             ?>
             <div class="AddContainer">
                <h3>New product</h3>
                <form action="" method="post" class="newinventory">
                    <input type="text" name="category" placeholder="Enter  category" required>
                    <input type="text" name="quantity" placeholder="Enter inventory quantity" required>
                    <input type="text" name="name" placeholder="Enter inventory name " required>
                    <button type="submit" name="submit" class="hero-btn red-btn">Save</button>
                
                </form>
            </div>
        </div>
        <div class="content" id="listproduct">
            <div class="renew active" id="listproduct">
                      <div class="grid-container1">
            <?php
               $sql = "SELECT * FROM products";

             $result = mysqli_query($conn, $sql);
               while( $row = mysqli_fetch_assoc($result)){
                    ?>
               <div class="wrapper">
                     <div class="item1-1">image</div>
                     <div class="item1-2">
                             <p><?php echo $row['category'] ?></p>
                             <p><?php echo $row['name'] ?></p>
                            <p><?php echo $row['Quantity'] ?></p>
                          
                     </div>
                     <div class="item1-3">
                        <div>
                            <button class="edit-btn" onclick="window.location.href='index.php?listid=<?php echo $row['id']; ?>#listupdate';displayContent('listupdate');">Update</button>
                            <button class="delete-btn"><a href="delete.php?deleteid=<?php echo $row['id'] ?>">delete</a></button>
                        </div>
                     </div>
          
                  </div>     
                   <?php
                  }
                   ?>    
        
                </div>
             </div>
            <div class="renew" id="listupdate">
               <?php
                 $id = $_GET['listid'] ?? null;
                     if ($id !== null) {
                     $sql = "SELECT * FROM products WHERE id='$id'";
                    $result = mysqli_query($conn, $sql);
                   if ($row = mysqli_fetch_assoc($result)) {
                    $category = $row['category'];
                    $quantity = $row['Quantity'];
                     $name = $row['name'];
                    
                    } else {
                     $category = $quantity = $name = '';
                        }
                   } else {
                       $category = $quantity = $name = '';
                   }

          if(isset($_POST['update'])){
            $category=$_POST['category'];
            $quantity=$_POST['quantity'];
            $name=$_POST['name'];

            $sql="UPDATE products SET category='$category', name='$name', Quantity='$quantity' WHERE id='$id'";
            $result=mysqli_query($conn,$sql);
            if($result){
              header('location:index.php');
              exit();
            } else {
              die(mysqli_error($conn));
            }
          }


             ?>
            <div class="AddContainer">
                <h3>Update product</h3>
                <form action="" method="post" class="newinventory">
                    <input type="text" name="category" placeholder="Enter  category" required value="<?php echo htmlspecialchars($category ?? ''); ?>">
                    <input type="text" name="quantity" placeholder="Enter inventory quantity" required value="<?php echo htmlspecialchars($quantity ?? ''); ?>">
                    <input type="text" name="name" placeholder="Enter inventory name " required value="<?php echo htmlspecialchars($name ?? ''); ?>">
                    <button type="submit" name="update" class="hero-btn red-btn">Update</button>
                </form>
            </div>

            
        </div>
        
 
    </main>
    <footer>Footer</footer>
   <script>
    function showContent(id){
        const contents = document.getElementsByClassName('content');
        for(let i=0; i <contents.length;i++){
            contents[i].classList.remove('active');
        }
        document.getElementById(id).classList.add('active');
    }

    function viewContent(id){
        const contents = document.getElementsByClassName('update');
        for(let i=0; i <contents.length;i++){
            contents[i].classList.remove('active');
        }
        document.getElementById(id).classList.add('active');
    }
    function displayContent(id){
        const contents = document.getElementsByClassName('renew');
        for(let i=0; i <contents.length;i++){
            contents[i].classList.remove('active');
        }
        document.getElementById(id).classList.add('active');
    }


    // Ensure script runs after DOM is loaded
    document.addEventListener('DOMContentLoaded', function() {
        // No additional code needed unless you want to set initial state
    });
   </script>
</body>
</html>
