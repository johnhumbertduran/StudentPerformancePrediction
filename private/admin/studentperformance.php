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


<style>
.student_performance_active{
  border: 1.5px solid white;
  border-radius: 6px;
}
</style>

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

<a class="btn btn-info ml-2 my-3" href="?redir=prelim">Preliminary Period</a>
<a class="btn btn-info ml-2 my-3" href="?redir=midterm">Midterm Period</a>
<a class="btn btn-info ml-2 my-3" href="?redir=prefinal">Prefinal</a>
<a class="btn btn-info ml-2 my-3" href="?redir=final">Final</a>


<?php

if(isset($_GET['redir'])){
if($_GET['redir'] == "prelim"){
    include("prelim.php");
}

if($_GET['redir'] == "midterm"){
    include("midterm.php");
}

if($_GET['redir'] == "prefinal"){
    include("prefinal.php");
}

if($_GET['redir'] == "final"){
    include("final.php");
}

}

?>


<br>
<br>
<br>
<br>
<br>
<br>
<br>

<?php
include("../../bins/footer_non_fixed.php");
?>