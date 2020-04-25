<?php

session_start();

include("../bins/connections.php");
include("../../bins/header.php");

$session_user = $_SESSION["username"];
  
$query_info = mysqli_query($connections, "SELECT * FROM _user_tbl_ WHERE username='$session_user'");
$my_info = mysqli_fetch_assoc($query_info);
$account_type = $my_info["account_type"];
$student_no = $my_info["student_no"];
$firstname = $my_info["firstname"];

if(isset($_SESSION["username"])){


    
    if($account_type != 2){
    
        header('Location: ../../forbidden');
    
    }
  
  }else{
    
    header('Location: ../../');
  
  }



?>


<style>
.home_active{
  border: 1.5px solid white;
  border-radius: 6px;
}
</style>


<center>
<h1 class="py-3 text-info px-1">Welcome <?php echo $firstname; ?>!</h1>
</center>

<?php
include('../bins/student_nav.php');
?>
<!-- <a href="logout.php">Log Out</a> -->

<?php
include("../../bins/footer.php");
?>