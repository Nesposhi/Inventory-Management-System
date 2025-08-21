<?php
session_start();
session_unset();
unset($_SESSION['email']);
session_destroy();
session_write_close();
header("Location: sign_up.php");
exit();

?>