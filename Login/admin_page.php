<?php
session_start();
if (!isset($_SESSION['email'])){
   header("location: admin_page.php");
   exit();
}
$errors = [
    'register' => $_SESSION['register_error'] ?? ''
]; 

$activeForm = $_SESSION['active_form'] ?? 'register';

session_unset();

function showError($error){
    return !empty($error) ? "<p class='error-message'>$error</p>" : '';
}

function isActiveForm($formName, $activeForm){
    return $formName === $activeForm ? 'active' : '';
}



$conn = mysqli_connect("localhost", "root", "", "server");

$sql = "SELECT * fROM users";

$result = mysqli_query($conn, $sql);



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="styles.css">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet">
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
    </script>
</head>
<body class="dashboardContainer">
   
    <aside>
        <div class="top">
            <div class="logo">
                <h1 class="nav_logo">DH.</h1>
                <h2>Dedza <span class="danger"> Hospital</span></h2>
            </div>
            <div class="close" id="close-btn">
               <span class="material-symbols-outlined">close</span>
            </div>
        </div>
        <div class="sidebar">
            <a href=""  onclick="event.preventDefault(); showContent('Dashboard')">
             <span class="material-symbols-outlined">grid_view</span>
            <h3>Dashboard</h3>
            </a>
            <a href=""  onclick="event.preventDefault(); showContent('AddUser')" >
               <span class="material-symbols-outlined">person_add</span>
            <h3>Add Users</h3>
            </a>
            <a href=""  onclick="event.preventDefault(); showContent('ListUsers')">
            <span class="material-symbols-outlined">groups</span>
            <h3>List Users</h3>
            </a>
            <a href="" onclick="event.preventDefault(); showContent('AddProduct')">
            <span class="material-symbols-outlined">add</span>
            <h3>Add Products</h3>
            </a>
            <a href="" onclick="event.preventDefault(); showContent('ListProducts')">
            <span class="material-symbols-outlined">inventory</span>
            <h3> Show Products</h3>
            </a>
            <a href="">
            <span onclick="window.location.href='logout.php'" class="material-symbols-outlined">mode_off_on</span>
            <h3 onclick="window.location.href='logout.php'">Log-out</h3>
            </a>
          
        
            </div>
        </aside>
    <!--main 
    view js 
    composition api-->
    <main>
        <div class="content" id="Dashboard">
            <div class="grid-container">
                <div class="card-1">
                      <div id="piechart_3d" style="width: 200px; height: 100px;"></div>
                 <!--End of sales--> 
                </div>
                <div class="card-2">
                       <div id="piechart_3d" style="width: 200px; height: 100px;"></div>
                </div>
                <div class="card-3">
                         <div id="piechart_3d" style="width: 200px; height: 100px;"></div>
                </div>
                <div class="card-4">
                         <div id="piechart_3d" style="width: 200px; height: 100px;"></div>
                </div>
                <div class="card-5">
                    <h2>Dashboard Card 5</h2>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
                </div>
            </div>
        </div>

        <div class="content" id="AddUser">

            <div class="form-box" id="register-form">
                <form action="login_register.php" method="post" class=""newuser>
                    <h2 class="login_h2">New User</h2>
                    <input type="text" name="name" placeholder="Name" required>
                    <input type="email" name="email" placeholder="Email" required>
                    <input type="password" name="password" placeholder="Password" required>
                    <select name="role" required>
                        <option value="">--Select Role</option>
                        <option value="user">User</option>
                        <option value="admin">Admin</option>
                    </select>
                    <button class="login_button" type="submit" name="register">Add user</button>
                </form>
            </div>
        </div>

        <div class="content" id="listUsers">
            <div class="update active" id="listnames">
                <div class="grid-container1">
                    <?php
                       $sql = "SELECT *FROM users";

                       $result = mysqli_query($conn, $sql);
                       while($row = mysqli_fetch_assoc($result)){
                          ?>
                          <div class="wrapper">
                            <div class="item1-1">Image</div>
                            <div class="item1-2">
                                <p><?php echo $row['id'] ?></p>
                                <p><?php echo $row['name'] ?></p>
                                <p><?php echo $row['email'] ?></p>
                                <p><?php echo $row['mobile'] ?></p>
                            </div>
                            <div class="item1-3">
                                <div>
                                    <button class="edit-btn" onclick="window.location.href='admin_page.php?updateid=<?php echo $row['id']; ?>#updatelist';viewContent('updatelist');">update</button>
                                     <button class="delete-btn"><a href="delete.php?deleteid=<?php echo $row['id'] ?>">delete</a></button>
                                </div>
                            </div>
                          </div>
                          <?php
                       }
                        ?>
                  
                </div>
            </div>
            <div class="update " id="updatelist">
                <div class="addContainer">
                    <?php
                       $id = $_GET['updateid'] ?? null;
                       if ($id !== null){
                        $sql = "SELECT * FROM users WHERE id='$id'";
                        $result = mysqli_query($conn, $sql);
                        if($row = mysqli_fetch_assoc($result)){
                            $name = $row['name'];
                            $email = $row['email'];
                            $mobile = $row['mobile'];
                            $password= $row['password'];
                        }else{
                            $name = $email = $mobile =$password = '';
                        }
                       }else{
                        $name = $email = $mobile = $password = '';
                       }

                       if(isset($_POST['update'])){
                        $name = $_POST['name'];
                        $email = $_POST['email'];
                        $mobile = $_POST['mobile'];
                        $password = $_POST['password'];

                        $sql="UPDATE users SET name='$name', email='$email', mobile='$mobile', password= '$password' WHERE id= '$id'";
                        $result = mysqli_query($conn,$sql);
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
                        <input type="text" name="name" placeholder="Enter full Name" required value="<?php echo htmlspecialchars($name ?? ''); ?>">
                        <input type="text" name="email" placeholder="Enter email" required value="<?php echo htmlspecialchars($email ?? ''); ?>">
                        <input type="text" name="mobile" placeholder="Enter Mobile number" required value="<?php echo htmlspecialchars($mobile ?? ''); ?>">
                        <input type="text" name="password" placeholder="Enter Password" required value="<?php echo htmlspecialchars($password ?? ''); ?>">
                        <button type="submit" name="update">Save</button>
                    </form>
                </div>
            </div>
        
        </div>

        <div class="content" id="newProduct">
           <?php
              if(isset($_POST['submit'])){
                $category=$_POST['category'];
                $quantity=$_POST['quantity'];
                $name=$_POST['name'];

                $sql="INSERT INTO products (category, name, Quantity) VALUES('$category', '$name', '$quantity')";
                $result=mysqli_query($conn,$sql);

                if($result){
                    header('location:index');
                }
                else{
                    die(mysqli_error($conn));
                }
              }
                 ?>
             <div class="AddContainer">
                 <h3>New product</h3>
                  <form action="" method="post" class="newinventory">
                       <input type="text" name="category" placeholder="Enter category" required>
                       <input type="text" name="quantity" placeholder="Enter inventory quantity" required>
                       <input type="text" name="name" placeholder="Enter inventory name" required>
                       <button type="submit" name="submit" class="btn">Save</button>
                  </form>
              </div>

        </div>

    <div class="content" id="listProducts">
           <div class="renew active" id="listproduct">
             <div class="grid-container1">
               <?php
                 $sql = "SELECT * FROM products";

                 $result = mysqli_query($conn, $sql);
                 while($row = mysqli_fetch_assoc($result)){
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

            
    </div>
    </main>

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


    
    document.addEventListener('DOMContentLoaded', function() {

    });
   </script>
</body>
</html>