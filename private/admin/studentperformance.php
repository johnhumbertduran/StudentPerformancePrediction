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

<br>
<div class="table-responsive">
<table border="1" class="table table-hover">
    <thead>
    <tr><th class="px-3"></th><th class="px-3 text-center bg-success" colspan="27">Preliminary Period</th><th class="px-3 text-center" colspan="29">Midterm</th><th class="px-3 text-center" colspan="28">Prefinal Period</th><th class="px-3 text-center" colspan="29">Final Period</th></tr>
    <tr><th class="px-3">Student&nbsp;ID</th><th class="px-3">Student&nbsp;Name</th><th class="px-5 text-center bg-success" colspan="12">Formative Assessment</th><th class="px-5 text-center bg-success" colspan="5">Outpout</th><th class="px-5 text-center bg-success" colspan="5">Performance&nbsp;Project</th><th class="px-5 text-cente bg-success" colspan="3">Written&nbsp;Test</th><th class="px-5 text-center bg-success " colspan="2">Prelim&nbsp;Grade</th><th class="px-5 text-center" colspan="12">Formative Assessment</th><th class="px-5 text-center" colspan="5">Outpout</th><th class="px-5 text-center" colspan="5">Performance</th><th class="px-5 text-center" colspan="3">Written&nbsp;Test</th><th class="px-5 text-center">2nd&nbsp;Quarter</th><th class="px-5 text-center" colspan="2">Midterm&nbsp;Grade</th><th class="px-5 text-center">Remarks</th><th class="px-5 text-center" colspan="12">Formative Assessment</th><th class="px-5 text-center" colspan="5">Outpout</th><th class="px-5 text-center" colspan="5">Performance</th><th class="px-5 text-center" colspan="3">Written&nbsp;Test</th><th class="px-5 text-center">3rd&nbsp;Quarter</th><th class="px-5 text-center" colspan="2">Prefinal&nbsp;Grade</th><th class="px-5 text-center" colspan="12">Formative Assessment</th><th class="px-5 text-center" colspan="5">Outpout</th><th class="px-5 text-center" colspan="5">Performance</th><th class="px-5 text-center" colspan="3">Written&nbsp;Test</th><th class="px-5 text-center">4th&nbsp;Quarter</th><th class="px-5 text-center" colspan="2">Final&nbsp;Grade</th><th class="px-5 text-center">Remarks</th></tr>
    <tr><th class="px-3"></th><th class="px-3">Highest&nbsp;Possible&nbsp;Score</th><th class="bg-success">10</th><th class="bg-success">10</th><th class="bg-success">10</th><th class="bg-success">10</th><th class="bg-success">10</th><th class="bg-success">10</th><th class="bg-success">10</th><th class="bg-success">10</th><th class="bg-success">10</th><th class="bg-success">10</th><th class="bg-success">100</th><th class="bg-success">60</th><th class="bg-success">20</th><th class="bg-success">20</th><th class="bg-success">40</th><th class="bg-success">60</th><th class="bg-success">0.40</th><th class="bg-success">20</th><th class="bg-success">20</th><t class="bg-success"h>40</th><th class="bg-success">60</th><th class="bg-success">0.40</th><th class="bg-success">30</th><th class="bg-success">60</th><th class="bg-success">0.20</th><th></th><th></th><th>10</th><th>10</th><th>10</th><th>10</th><th>10</th><th>10</th><th>10</th><th>10</th><th>10</th><th>10</th><th>100</th><th>60</th><th>20</th><th>20</th><th>40</th><th>60</th><th>0.40</th><th>20</th><th>20</th><th>40</th><th>60</th><th>0.40</th><th>30</th><th>60</th><th>0.20</th><th></th><th></th><th></th><th></th><th>10</th><th>10</th><th>10</th><th>10</th><th>10</th><th>10</th><th>10</th><th>10</th><th>10</th><th>10</th><th>100</th><th>60</th><th>20</th><th>20</th><th>40</th><th>60</th><th>0.40</th><th>20</th><th>20</th><th>40</th><th>60</th><th>0.40</th><th>30</th><th>60</th><th>0.20</th><th></th><th></th><th></th><th>10</th><th>10</th><th>10</th><th>10</th><th>10</th><th>10</th><th>10</th><th>10</th><th>10</th><th>10</th><th>100</th><th>60</th><th>20</th><th>20</th><th>40</th><th>60</th><th>0.40</th><th>20</th><th>20</th><th>40</th><th>60</th><th>0.40</th><th>30</th><th>60</th><th>0.20</th><th></th><th></th><th></th><th></th></tr>
    </thead>
</table>
</div>
<?php
include("../../bins/footer_non_fixed.php");
?>