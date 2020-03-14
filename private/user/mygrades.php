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
.my_grades_active{
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


<select class="form-control col-2 ml-2 pt-1 pb-2 d-inline bg-info text-white mt-3" id="semester" onchange="semester()">
  <option value="select_semester">Select Semester</option>
  <option value="sem1" <?php if(isset($_GET['_s'])){ if($_GET['_s'] == "sem1"){ echo "selected"; }}?>>1st Semester</option>
  <option value="sem2" <?php if(isset($_GET['_s'])){ if($_GET['_s'] == "sem2"){ echo "selected"; }}?>>2nd Semester</option>
</select>


<div class="table-responsive table_table mt-3 col-5 container-fluid">
<table border="1" class="table table-hover">
    <thead>
    <tr><th class="px-3 text-center bg-success text-white" colspan="4">My Grade</th></tr><!-- Preliminary Here -->

    <tr><th class="px-3">Prelim</th><th class="px-3">Midterm</th><th class="px-3">Prefinal</th><th class="px-3">Final</th></tr>

    </thead>

    <tbody>

<?php

  if(isset($_GET["_s"])){
    $semester = $_GET["_s"];
  }else{
    $semester = "sem1";
  }
  

  $prelim = "prelim$semester[3]";
  $midterm = "midterm$semester[3]";
  $prefinal = "prefinal$semester[3]";
  $final = "final$semester[3]";
  $prelim_qry = mysqli_query($connections, "SELECT * FROM $prelim WHERE student_no='$student_no' ");
  $midterm_qry = mysqli_query($connections, "SELECT * FROM $midterm WHERE student_no='$student_no' ");
  $prefinal_qry = mysqli_query($connections, "SELECT * FROM $prefinal WHERE student_no='$student_no' ");
  $final_qry = mysqli_query($connections, "SELECT * FROM $final WHERE student_no='$student_no' ");


while($row_prelim = mysqli_fetch_assoc($prelim_qry)){
  
  
 $row_midterm = mysqli_fetch_assoc($midterm_qry);
 $row_prefinal = mysqli_fetch_assoc($prefinal_qry);
 $row_final = mysqli_fetch_assoc($final_qry);
 

$prelim_output_1 = $row_prelim['prelim_output_1'];
$prelim_output_2 = $row_prelim['prelim_output_2'];
$prelim_performance_1 = $row_prelim['prelim_performance_1'];
$prelim_performance_2 = $row_prelim['prelim_performance_2'];
$prelim_written_test = $row_prelim['prelim_written_test'];

$prelim_output_total_score = $prelim_output_1 + $prelim_output_2;
$prelim_performance_total_score = $prelim_performance_1 + $prelim_performance_2;

$prelim_output_base = $prelim_output_total_score / 40 * 40 + 60;
$prelim_performance_base = $prelim_performance_total_score / 40 * 40 + 60;
$prelim_written_test_base =  $prelim_written_test / 30 * 40 + 60;

$prelim_output_weight = $prelim_output_base * 0.40;
$prelim_performance_weight = $prelim_performance_base * 0.40;
$prelim_written_test_weight = $prelim_written_test_base * 0.20;

$prelim_grade = $prelim_output_weight + $prelim_performance_weight + $prelim_written_test_weight;


$midterm_output_1 = $row_midterm["midterm_output_1"];
$midterm_output_2 = $row_midterm["midterm_output_2"];
$midterm_performance_1 = $row_midterm["midterm_performance_1"];
$midterm_performance_2 = $row_midterm["midterm_performance_2"];
$midterm_written_test = $row_midterm["midterm_written_test"];

$midterm_output_total_score = $midterm_output_1 + $midterm_output_2;
$midterm_output_base = $midterm_output_total_score / 40 * 40 + 60;
$midterm_output_weight = $midterm_output_base * 0.40;


$midterm_performance_total_score = $midterm_performance_1 + $midterm_performance_2;
$midterm_performance_base = $midterm_performance_total_score / 40 * 40 + 60;
$midterm_written_test_base = $midterm_written_test / 30 * 40 + 60;
$midterm_performance_weight = $midterm_performance_base * 0.40;
$midterm_written_test_weight = $midterm_written_test_base * 0.20;
$midterm_2nd_quarter = $midterm_output_weight + $midterm_performance_weight + $midterm_written_test_weight;

$midterm_output_weight = $midterm_output_base * 0.40;
$midterm_performance_weight = $midterm_performance_base * 0.40;
$midterm_written_test_weight = $midterm_written_test_base * 0.20;
$midterm_grade = $prelim_grade * 0.3 + $midterm_2nd_quarter * 0.7;



$prefinal_output_1 = $row_prefinal["prefinal_output_1"]; //ok
$prefinal_output_2 = $row_prefinal["prefinal_output_2"]; //ok
$prefinal_performance_1 = $row_prefinal["prefinal_performance_1"]; //ok
$prefinal_performance_2 = $row_prefinal["prefinal_performance_2"]; //ok
$prefinal_written_test = $row_prefinal["prefinal_written_test"]; //ok

$prefinal_output_total_score = $prefinal_output_1 + $prefinal_output_2; //ok
$prefinal_performance_total_score = $prefinal_performance_1 + $prefinal_performance_2; //ok

$prefinal_output_base = $prefinal_output_total_score / 40 * 40 + 60; //ok
$prefinal_performance_base = $prefinal_performance_total_score / 40 * 40 + 60; //ok
$prefinal_written_test_base = $prefinal_written_test / 30 * 40 + 60; //ok

$prefinal_output_weight = $prefinal_output_base * 0.40; //ok
$prefinal_performance_weight = $prefinal_performance_base * 0.40; //ok
$prefinal_written_test_weight = $prefinal_written_test_base * 0.20; //ok

$prefinal_3rd_quarter = $prefinal_output_weight + $prefinal_performance_weight + $prefinal_written_test_weight; //ok
$prefinal_grade = $midterm_grade * 0.3 + $prefinal_3rd_quarter * 0.7;



$final_output_1 = $row_final["final_output_1"];
$final_output_2 = $row_final["final_output_2"];
$final_performance_1 = $row_final["final_performance_1"];
$final_performance_2 = $row_final["final_performance_2"];
$final_written_test = $row_final["final_written_test"];


$final_output_total_score = $final_output_1 + $final_output_2;
$final_output_base = $final_output_total_score / 40 * 40 + 60;
$final_output_weight = $final_output_base * 0.40;
$final_performance_total_score = $final_performance_1 + $final_performance_2;
$final_performance_base = $final_performance_total_score / 40 * 40 + 60;
$final_performance_weight = $final_performance_base * 0.40;
$final_written_test_base = $final_written_test / 30 * 40 + 60;
$final_written_test_weight = $final_written_test_base * 0.20;
$final_4th_quarter = $final_output_weight + $final_performance_weight + $final_written_test_weight;
$final_grade = $prefinal_grade * 0.3 + $final_4th_quarter * 0.7;


  
?>

<tr>
<td><?php echo number_format((float)$prelim_grade,2,".",""); ?></td>
<td><?php echo number_format((float)$midterm_grade,2,".",""); ?></td>
<td><?php echo number_format((float)$prefinal_grade,2,".",""); ?></td>
<td><?php echo number_format((float)$final_grade,2,".",""); ?></td>
</tr>



<?php
// }
}
?>

</table>
</div>




<script>

function semester(){
 
  var semester = document.getElementById("semester");
  var selected_semester = semester.options[semester.selectedIndex].value;

  window.location.href = "?_s="+selected_semester;
  // alert("hay");
}

</script>
<!-- <a href="logout.php">Log Out</a> -->

<?php
include("../../bins/footer_non_fixed.php");
?>