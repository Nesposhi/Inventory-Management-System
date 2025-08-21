<?php
session_start();

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
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body >
    <div class="logincontainer">
       
        <div class="form-box <?= isActiveForm('register', $activeForm); ?>" id="register-form">
            <form action="login_register.php" method="post">
                <h2 class="login_h2">Register</h2>
                 <?= showError($errors['register']); ?>
                <input type="text" name="name" placeholder="Name" required>
                <input type="email" name="email" placeholder="Email" required>
                <input type="password" name="password" placeholder="Password" required>
                <select name="role" required>
                    <option value="">--Select Role</option>
                    <option value="user">User</option>
                    <option value="admin">Admin</option>
                </select>
                
                <button class="login_button" type="submit" name="register">Register</button>
               
            </form>
        </div>
    </div>
 <script src="script.js"></script> 
</body>
</html>