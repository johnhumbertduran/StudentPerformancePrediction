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

$predict = "<sup class='badge badge-warning'>Predict</sup>";


?>


<select class="form-control col-2 ml-2 pt-1 pb-2 d-inline bg-info text-white mt-3" id="semester" onchange="semester()">
  <option value="select_semester">Select Semester</option>
  <option value="sem1" <?php if(isset($_GET['_s'])){ if($_GET['_s'] == "sem1"){ echo "selected"; }}?>>1st Semester</option>
  <option value="sem2" <?php if(isset($_GET['_s'])){ if($_GET['_s'] == "sem2"){ echo "selected"; }}?>>2nd Semester</option>
</select>


<div class="table-responsive table_table mt-3 col-6 container-fluid">
<table border="1" class="table table-hover">
    <thead>
    <tr><th class="px-3 text-center bg-success text-white" colspan="5">My Grade</th></tr><!-- Preliminary Here -->

    <tr class="text-center"><th class="px-3">Prelim</th><th class="px-3">Midterm</th><th class="px-3" id="prefinal">Prefinal</th><th class="px-3" id="final">Final</th><th class="px-3">Prediction</th></tr>

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

if($prelim_output_1 == 0 && $prelim_output_2 == 0 &&
   $prelim_performance_1 == 0 && $prelim_performance_1 == 0 &&
   $prelim_written_test == 0){
  
    $prelim_grade = 0;

}else{

$prelim_output_total_score = $prelim_output_1 + $prelim_output_2;
$prelim_performance_total_score = $prelim_performance_1 + $prelim_performance_2;

$prelim_output_base = $prelim_output_total_score / 40 * 40 + 60;
$prelim_performance_base = $prelim_performance_total_score / 40 * 40 + 60;
$prelim_written_test_base =  $prelim_written_test / 30 * 40 + 60;

$prelim_output_weight = $prelim_output_base * 0.40;
$prelim_performance_weight = $prelim_performance_base * 0.40;
$prelim_written_test_weight = $prelim_written_test_base * 0.20;

$prelim_grade = $prelim_output_weight + $prelim_performance_weight + $prelim_written_test_weight;

$prelim_grade = number_format((float)$prelim_grade,2,".","");

}

$midterm_output_1 = $row_midterm["midterm_output_1"];
$midterm_output_2 = $row_midterm["midterm_output_2"];
$midterm_performance_1 = $row_midterm["midterm_performance_1"];
$midterm_performance_2 = $row_midterm["midterm_performance_2"];
$midterm_written_test = $row_midterm["midterm_written_test"];

if($midterm_output_1 == 0 && $midterm_output_2 == 0 &&
   $midterm_performance_1 == 0 && $midterm_performance_1 == 0 &&
   $midterm_written_test == 0){
  
    $midterm_grade = 0;

}else{

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

$midterm_grade = number_format((float)$midterm_grade,2,".","");

}


$prefinal_output_1 = $row_prefinal["prefinal_output_1"]; //ok
$prefinal_output_2 = $row_prefinal["prefinal_output_2"]; //ok
$prefinal_performance_1 = $row_prefinal["prefinal_performance_1"]; //ok
$prefinal_performance_2 = $row_prefinal["prefinal_performance_2"]; //ok
$prefinal_written_test = $row_prefinal["prefinal_written_test"]; //ok


if($prefinal_output_1 == 0 && $prefinal_output_2 == 0 &&
   $prefinal_performance_1 == 0 && $prefinal_performance_1 == 0 &&
   $prefinal_written_test == 0){
  
    $prefinal_grade = 0;

}else{

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

$prefinal_grade = number_format((float)$prefinal_grade,2,".","");

}


$final_output_1 = $row_final["final_output_1"];
$final_output_2 = $row_final["final_output_2"];
$final_performance_1 = $row_final["final_performance_1"];
$final_performance_2 = $row_final["final_performance_2"];
$final_written_test = $row_final["final_written_test"];


if($final_output_1 == 0 && $final_output_2 == 0 &&
   $final_performance_1 == 0 && $final_performance_1 == 0 &&
   $final_written_test == 0){
  
    $final_grade = 0;

}else{

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

$final_grade = number_format((float)$final_grade,2,".","");

}
  


$prefinal_prediction = 0;
$final_prediction = 0;
$average_prediction = 0;



?>

<tr class="text-center">
<td><?php echo $prelim_grade; ?></td>
<td><?php echo $midterm_grade; ?></td>
<td><?php echo $prefinal_grade; ?></td>
<td><?php echo $final_grade; ?></td>
<td>Average</td>
</tr>
<td></td>
<td></td>
<td id="prefinal_prediction"><?php echo $prefinal_prediction; ?></td>
<td id="final_prediction"><?php echo $final_prediction; ?></td>
<td id="average_prediction"><?php echo $average_prediction; ?></td>
<tr>
</tr>



<?php
// }
}
?>

</table>
</div>

<input type="text" id="prefinal_grade" value="<?php echo $prefinal_grade; ?>">
<input type="text" id="final_grade" value="<?php echo $final_grade; ?>">

ma javascript eon daun ako para sa switch case sa dropdown sa prediction

<script>

function semester(){
 
  var semester = document.getElementById("semester");
  var selected_semester = semester.options[semester.selectedIndex].value;

  window.location.href = "?_s="+selected_semester;
  // alert("hay");
}

var prefinal = document.getElementById("prefinal");
var prefinal_grade = document.getElementById("prefinal_grade");

if(prefinal_grade.value == 0){
  prefinal.innerHTML += "<sup class='badge badge-warning'>Predict</sup>";
}

var final = document.getElementById("final");
var final_grade = document.getElementById("final_grade");

if(final_grade.value == 0){
  final.innerHTML += "<sup class='badge badge-warning'>Predict</sup>";
}

</script>
<!-- <a href="logout.php">Log Out</a> -->

<?php
include("../../bins/footer_non_fixed.php");
?>