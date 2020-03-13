<?php

session_start();

include("../bins/connections.php");
include("../../bins/header.php");

if(isset($_SESSION["username"])){

    $session_user = $_SESSION["username"];
  
    $query_info = mysqli_query($connections, "SELECT * FROM _user_tbl_ WHERE username='$session_user'");
    $my_info = mysqli_fetch_assoc($query_info);
    $account_type = $my_info["account_type"];
    
    if($account_type != 2){
    
        header('Location: ../../forbidden');
    
    }
  
  }else{
    
    header('Location: ../../');
  
  }

?>



<center>
<h1 class="py-3 text-info px-1">My Account</h1>
</center>

<?php
include('../bins/student_nav.php');
?>
<!-- <a href="logout.php">Log Out</a> -->