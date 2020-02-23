<?php
session_start();

include("../bins/connections.php");
include("../../bins/header.php");


if(isset($_SESSION["username"])){

    $session_user = $_SESSION["username"];
  
    $query_info = mysqli_query($connections, "SELECT * FROM _user_tbl_ WHERE username='$session_user'");
    $my_info = mysqli_fetch_assoc($query_info);
    $account_type = $my_info["account_type"];
    
    if($account_type != 1){
    
        header('Location: ../../forbidden');
    
    }
  
  }else{
    
    header('Location: ../../');
  
  }


?>

<center>
<h1 class="py-3 text-info px-1">Student Performance</h1>
</center>



<?php
include("../bins/admin_nav.php");
?>
<br>

<div class="input-group col-sm-6">
<input class="form-control mr-sm-2" type="text" placeholder="Course Name...">
<input class="form-control mr-sm-2" type="text" placeholder="Semester...">
<div class="input-group-append">
<button class="btn btn-success">View Charts</button>
</div>
</div>


<table border="1">
    <thead><tr><td>Student ID</td><td>Student Name</td></tr></thead>
</table>
<?php
include("../../bins/footer.php");
?>