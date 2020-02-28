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



  $prelim_formative_assessment_1 = $prelim_formative_assessment_2 =
  $prelim_formative_assessment_3 = $prelim_formative_assessment_4 =
  $prelim_formative_assessment_5 = $prelim_formative_assessment_6 =
  $prelim_formative_assessment_7 = $prelim_formative_assessment_8 =
  $prelim_formative_assessment_9 = $prelim_formative_assessment_10 =
  $prelim_formative_assessment_total_score = $prelim_formative_assessment_base =
  $prelim_output_1 = $prelim_output_2 = $prelim_output_total_score =
  $prelim_output_base = $prelim_output_weight = $prelim_performance_1 =
  $prelim_performance_2 = $prelim_performance_total_score =
  $prelim_performance_base = $prelim_performance_weight =
  $prelim_written_test = $prelim_written_test_base =
  $prelim_written_test_weight = $prelim_grade =
  $prelim_grade_equivalent = "0";


  $midterm_formative_assessment_1 = $midterm_formative_assessment_2 =
  $midterm_formative_assessment_3 = $midterm_formative_assessment_4 =
  $midterm_formative_assessment_5 = $midterm_formative_assessment_6 =
  $midterm_formative_assessment_7 = $midterm_formative_assessment_8 =
  $midterm_formative_assessment_9 = $midterm_formative_assessment_10 =
  $midterm_formative_assessment_total_score = $midterm_formative_assessment_base =
  $midterm_output_1 = $midterm_output_2 =
  $midterm_output_total_score = $midterm_output_base =
  $midterm_output_weight = $midterm_performance_1 =
  $midterm_performance_2 = $midterm_performance_total_score =
  $midterm_performance_base = $midterm_performance_weight =
  $midterm_written_test = $midterm_written_test_base =
  $midterm_written_test_weight = $midterm_2nd_quarter =
  $midterm_grade = $midterm_grade_equivalent = "0";
  $midterm_remarks = "";


  $prefinal_formative_assessment_1 = $prefinal_formative_assessment_2 =
  $prefinal_formative_assessment_3 = $prefinal_formative_assessment_4 =
  $prefinal_formative_assessment_5 = $prefinal_formative_assessment_6 =
  $prefinal_formative_assessment_7 = $prefinal_formative_assessment_8 =
  $prefinal_formative_assessment_9 = $prefinal_formative_assessment_10 =
  $prefinal_formative_assessment_total_score = $prefinal_formative_assessment_base =
  $prefinal_output_1 = $prefinal_output_2 =
  $prefinal_output_total_score = $prefinal_output_base =
  $prefinal_output_weight = $prefinal_performance_1 =
  $prefinal_performance_2 = $prefinal_performance_total_score =
  $prefinal_performance_base = $prefinal_performance_weight =
  $prefinal_written_test = $prefinal_written_test_base =
  $prefinal_written_test_weight = $prefinal_3rd_quarter =
  $prefinal_grade = $prefinal_grade_equivalent = "0";


  $final_formative_assessment_1 = $final_formative_assessment_2 =
  $final_formative_assessment_3 = $final_formative_assessment_4 =
  $final_formative_assessment_5 = $final_formative_assessment_6 =
  $final_formative_assessment_7 = $final_formative_assessment_8 =
  $final_formative_assessment_9 = $final_formative_assessment_10 =
  $final_formative_assessment_total_score = $final_formative_assessment_base =
  $final_output_1 = $final_output_2 =
  $final_output_total_score = $final_output_base =
  $final_weight = $final_performance_1 =
  $final_performance_2 = $final_performance_total_score =
  $final_performance_base = $final_performance_weight =
  $final_written_test = $final_written_test_base =
  $final_written_test_weight = $final_4th_quarter =
  $final_grade = $final_grade_equivalent = "0";
  $final_grade_remarks ="";
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
    <tr><th class="px-3" colspan="2"></th><th class="px-3 text-center bg-success text-white" colspan="27">Preliminary Period</th><!-- Preliminary Here -->
    <th class="px-3 text-center bg-primary text-white" colspan="29">Midterm</th><!-- Midterm Here -->
    <th class="px-3 text-center bg-danger text-white" colspan="28">Prefinal Period</th><!-- Prefinal Here -->
    <th class="px-3 text-center bg-warning text-white" colspan="29">Final Period</th></tr><!-- Final Here -->

    <tr><th class="px-3">Student&nbsp;ID</th><th class="px-3">Student&nbsp;Name</th><th class="px-5 text-center bg-success text-white" colspan="12">Formative Assessment</th><th class="px-5 text-center bg-success text-white" colspan="5">Outpout</th><th class="px-5 text-center bg-success text-white" colspan="5">Performance&nbsp;Project</th><th class="px-5 text-cente bg-success text-white" colspan="3">Written&nbsp;Test</th><th class="px-5 text-center bg-success text-white " colspan="2">Prelim&nbsp;Grade</th><!-- Preliminary Here -->
    <th class="px-5 text-center bg-primary text-white" colspan="12">Formative Assessment</th><th class="px-5 text-center bg-primary text-white" colspan="5">Outpout</th><th class="px-5 text-center bg-primary text-white" colspan="5">Performance</th><th class="px-5 text-center bg-primary text-white" colspan="3">Written&nbsp;Test</th><th class="px-5 text-center bg-primary text-white">2nd&nbsp;Quarter</th><th class="px-5 text-center bg-primary text-white" colspan="2">Midterm&nbsp;Grade</th><th class="px-5 text-center bg-primary text-white">Remarks</th><!-- Midterm Here -->
    <th class="px-5 text-center bg-danger text-white" colspan="12">Formative Assessment</th><th class="px-5 text-center bg-danger text-white" colspan="5">Outpout</th><th class="px-5 text-center bg-danger text-white" colspan="5">Performance</th><th class="px-5 text-center bg-danger text-white" colspan="3">Written&nbsp;Test</th><th class="px-5 text-center bg-danger text-white">3rd&nbsp;Quarter</th><th class="px-5 text-center bg-danger text-white" colspan="2">Prefinal&nbsp;Grade</th><!-- Prefinal Here -->
    <th class="px-5 text-center bg-warning text-white" colspan="12">Formative Assessment</th><th class="px-5 text-center bg-warning text-white" colspan="5">Outpout</th><th class="px-5 text-center bg-warning text-white" colspan="5">Performance</th><th class="px-5 text-center bg-warning text-white" colspan="3">Written&nbsp;Test</th><th class="px-5 text-center bg-warning text-white">4th&nbsp;Quarter</th><th class="px-5 text-center bg-warning text-white" colspan="2">Final&nbsp;Grade</th><th class="px-5 text-center bg-warning text-white">Remarks</th></tr><!-- Final Here -->

    <tr><th class="px-3"></th><th class="px-3">Highest&nbsp;Possible&nbsp;Score</th><th class="bg-success text-white">10</th><th class="bg-success text-white">10</th><th class="bg-success text-white">10</th><th class="bg-success text-white">10</th><th class="bg-success text-white">10</th><th class="bg-success text-white">10</th><th class="bg-success text-white">10</th><th class="bg-success text-white">10</th><th class="bg-success text-white">10</th><th class="bg-success text-white">10</th><th class="bg-success text-white">100</th><th class="bg-success text-white">60</th><th class="bg-success text-white">20</th><th class="bg-success text-white">20</th><th class="bg-success text-white">40</th><th class="bg-success text-white">60</th><th class="bg-success text-white">0.40</th><th class="bg-success text-white">20</th><th class="bg-success text-white">20</th><th class="bg-success text-white">40</th><th class="bg-success text-white">60</th><th class="bg-success text-white">0.40</th><th class="bg-success text-white">30</th><th class="bg-success text-white">60</th><th class="bg-success text-white">0.20</th><th class="bg-success text-white"></th><th class="bg-success text-white"></th><!-- Preliminary Here -->
    <th class="bg-primary text-white">10</th><th class="bg-primary text-white">10</th><th class="bg-primary text-white">10</th><th class="bg-primary text-white">10</th><th class="bg-primary text-white">10</th><th class="bg-primary text-white">10</th><th class="bg-primary text-white">10</th><th class="bg-primary text-white">10</th><th class="bg-primary text-white">10</th><th class="bg-primary text-white">10</th><th class="bg-primary text-white">100</th><th class="bg-primary text-white">60</th><th class="bg-primary text-white">20</th><th class="bg-primary text-white">20</th><th class="bg-primary text-white">40</th><th class="bg-primary text-white">60</th><th class="bg-primary text-white">0.40</th><th class="bg-primary text-white">20</th><th class="bg-primary text-white">20</th><th class="bg-primary text-white">40</th><th class="bg-primary text-white">60</th><th class="bg-primary text-white">0.40</th><th class="bg-primary text-white">30</th><th class="bg-primary text-white">60</th><th class="bg-primary text-white">0.20</th><th class="bg-primary text-white"></th><th class="bg-primary text-white"></th><th class="bg-primary text-white"></th><th class="bg-primary text-white"></th><!-- Midterm Here -->
    <th class="bg-danger text-white">10</th><th class="bg-danger text-white">10</th><th class="bg-danger text-white">10</th><th class="bg-danger text-white">10</th><th class="bg-danger text-white">10</th><th class="bg-danger text-white">10</th><th class="bg-danger text-white">10</th><th class="bg-danger text-white">10</th><th class="bg-danger text-white">10</th><th class="bg-danger text-white">10</th><th class="bg-danger text-white">100</th><th class="bg-danger text-white">60</th><th class="bg-danger text-white">20</th><th class="bg-danger text-white">20</th><th class="bg-danger text-white">40</th><th class="bg-danger text-white">60</th><th class="bg-danger text-white">0.40</th><th class="bg-danger text-white">20</th><th class="bg-danger text-white">20</th><th class="bg-danger text-white">40</th><th class="bg-danger text-white">60</th><th class="bg-danger text-white">0.40</th><th class="bg-danger text-white">30</th><th class="bg-danger text-white">60</th><th class="bg-danger text-white">0.20</th><th class="bg-danger text-white"></th><th class="bg-danger text-white"></th><th class="bg-danger text-white"></th><!-- Prefinal Here -->
    <th class="bg-warning text-white">10</th><th class="bg-warning text-white">10</th><th class="bg-warning text-white">10</th><th class="bg-warning text-white">10</th><th class="bg-warning text-white">10</th><th class="bg-warning text-white">10</th><th class="bg-warning text-white">10</th><th class="bg-warning text-white">10</th><th class="bg-warning text-white">10</th><th class="bg-warning text-white">10</th><th class="bg-warning text-white">100</th><th class="bg-warning text-white">60</th><th class="bg-warning text-white">20</th><th class="bg-warning text-white">20</th><th class="bg-warning text-white">40</th><th class="bg-warning text-white">60</th><th class="bg-warning text-white">0.40</th><th class="bg-warning text-white">20</th><th class="bg-warning text-white">20</th><th class="bg-warning text-white">40</th><th class="bg-warning text-white">60</th><th class="bg-warning text-white">0.40</th><th class="bg-warning text-white">30</th><th class="bg-warning text-white">60</th><th class="bg-warning text-white">0.20</th><th class="bg-warning text-white"></th><th class="bg-warning text-white"></th><th class="bg-warning text-white"></th><th class="bg-warning text-white"></th></tr><!-- Final Here -->
    </thead>

    <tbody>

<?php

$student_qry = mysqli_query($connections, "SELECT * FROM _user_tbl_ WHERE account_type='2'");


while($row_student = mysqli_fetch_assoc($student_qry)){

  $product_no = $row_student["product_no"];
  $lastname = $row_student["lastname"];
  $firstname = $row_student["firstname"];
  $middlename = $row_student["middlename"];
  
  $fullname = $firstname . " " . $middlename[0] . ". " . $lastname;


  // ####################______Prelim Formulas______####################
  $prelim_formative_assessment_total_score =
  $prelim_formative_assessment_1 + $prelim_formative_assessment_2 +
  $prelim_formative_assessment_3 + $prelim_formative_assessment_4 +
  $prelim_formative_assessment_5 + $prelim_formative_assessment_6 +
  $prelim_formative_assessment_7 + $prelim_formative_assessment_8 +
  $prelim_formative_assessment_9 + $prelim_formative_assessment_10;

  $prelim_formative_assessment_base = $prelim_formative_assessment_total_score / 100 * 40 + 60;
  $prelim_output_total_score = $prelim_output_1 + $prelim_output_2;
  $prelim_output_base = $prelim_output_total_score / 40 * 40 + 60;
  $prelim_output_weight = $prelim_output_base * 0.40;
  $prelim_performance_total_score = $prelim_performance_1 + $prelim_performance_2;
  $prelim_performance_base = $prelim_performance_total_score / 40 * 40 + 60;
  $prelim_performance_weight = $prelim_performance_base * 0.40;
  $prelim_written_test_base = $prelim_written_test / 30 * 40 + 60;
  $prelim_written_test_weight = $prelim_written_test_base * 0.20;
  $prelim_grade = $prelim_output_weight + $prelim_performance_weight + $prelim_written_test_weight;

  switch ($prelim_grade) {
      case "":
          $prelim_grade_equivalent = "";
          break;
      case "":
          $prelim_grade_equivalent = "";
          break;
      case "":
          $prelim_grade_equivalent = "";
          break;
      case "":
          $prelim_grade_equivalent = "";
          break;
      case "":
          $prelim_grade_equivalent = "";
          break;
      case "":
          $prelim_grade_equivalent = "";
          break;
      case "":
          $prelim_grade_equivalent = "";
          break;
      case "":
          $prelim_grade_equivalent = "";
          break;
      case "":
          $prelim_grade_equivalent = "";
          break;
      case "":
          $prelim_grade_equivalent = "";
          break;
      case "":
          $prelim_grade_equivalent = "";
          break;
      case "":
          $prelim_grade_equivalent = "";
          break;
      case "":
          $prelim_grade_equivalent = "";
          break;
      case "":
          $prelim_grade_equivalent = "";
          break;
      case "":
          $prelim_grade_equivalent = "";
          break;
      case "":
          $prelim_grade_equivalent = "";
          break;
      case "":
          $prelim_grade_equivalent = "";
          break;
      case "":
          $prelim_grade_equivalent = "";
          break;
      case "":
          $prelim_grade_equivalent = "";
          break;
      case "":
          $prelim_grade_equivalent = "";
          break;
      case "":
          $prelim_grade_equivalent = "";
          break;
      case "":
          $prelim_grade_equivalent = "";
          break;
      case "":
          $prelim_grade_equivalent = "";
          break;
      case "":
          $prelim_grade_equivalent = "";
          break;
      case "":
          $prelim_grade_equivalent = "";
          break;
      case "":
          $prelim_grade_equivalent = "";
          break;
      case "":
          $prelim_grade_equivalent = "";
          break;
      case "":
          $prelim_grade_equivalent = "";
          break;
      case "":
          $prelim_grade_equivalent = "";
          break;
      case "":
          $prelim_grade_equivalent = "";
          break;
      case "":
          $prelim_grade_equivalent = "";
          break;
      case "":
          $prelim_grade_equivalent = "";
          break;
      case "":
          $prelim_grade_equivalent = "";
          break;
      case "":
          $prelim_grade_equivalent = "";
          break;
      case "":
          $prelim_grade_equivalent = "";
          break;
      case "":
          $prelim_grade_equivalent = "";
          break;
      case "":
          $prelim_grade_equivalent = "";
          break;
      case "":
          $prelim_grade_equivalent = "";
          break;
      case "":
          $prelim_grade_equivalent = "";
          break;
      case "":
          $prelim_grade_equivalent = "";
          break;
      case "":
          $prelim_grade_equivalent = "";
          break;
      case "":
          $prelim_grade_equivalent = "";
          break;
      case "":
          $prelim_grade_equivalent = "";
          break;
      case "":
          $prelim_grade_equivalent = "";
          break;
      case "":
          $prelim_grade_equivalent = "";
          break;
      case "":
          $prelim_grade_equivalent = "";
          break;
      case "":
          $prelim_grade_equivalent = "";
          break;
      case "":
          $prelim_grade_equivalent = "";
          break;
      default:
          $prelim_grade_equivalent = "";
  }


    // ####################______Midterm Formulas______####################
    $midterm_formative_assessment_total_score =
    $midterm_formative_assessment_1 + $midterm_formative_assessment_2 +
    $midterm_formative_assessment_3 + $midterm_formative_assessment_4 +
    $midterm_formative_assessment_5 + $midterm_formative_assessment_6 +
    $midterm_formative_assessment_7 + $midterm_formative_assessment_8 +
    $midterm_formative_assessment_9 + $midterm_formative_assessment_10;

    $midterm_formative_assessment_base = $midterm_formative_assessment_total_score / 100 * 40 + 60;
    $midterm_output_total_score = $midterm_output_1 + $midterm_output_2;
    $midterm_output_base = $midterm_output_total_score / 40 * 40 + 60;
    $midterm_output_weight = $midterm_output_base * 0.40;
    $midterm_performance_total_score = $midterm_performance_1 + $midterm_performance_2;
    $midterm_performance_base = $midterm_performance_total_score / 40 * 40 + 60;
    $midterm_performance_weight = $midterm_performance_base * 0.40;
    $midterm_written_test_base = $midterm_written_test / 30 * 40 + 60;
    $midterm_written_test_weight = $midterm_written_test_base * 0.20;
    $midterm_2nd_quarter = $midterm_output_weight + $midterm_performance_weight + $midterm_written_test_weight;
    $midterm_grade = $prelim_grade * 0.3 + $midterm_2nd_quarter * 0.7;


    switch ($midterm_grade) {
      case "":
          $midterm_grade_equivalent = "";
          break;
      case "":
          $midterm_grade_equivalent = "";
          break;
      case "":
          $midterm_grade_equivalent = "";
          break;
      case "":
          $midterm_grade_equivalent = "";
          break;
      case "":
          $midterm_grade_equivalent = "";
          break;
      case "":
          $midterm_grade_equivalent = "";
          break;
      case "":
          $midterm_grade_equivalent = "";
          break;
      case "":
          $midterm_grade_equivalent = "";
          break;
      case "":
          $midterm_grade_equivalent = "";
          break;
      case "":
          $midterm_grade_equivalent = "";
          break;
      case "":
          $midterm_grade_equivalent = "";
          break;
      case "":
          $midterm_grade_equivalent = "";
          break;
      case "":
          $midterm_grade_equivalent = "";
          break;
      case "":
          $midterm_grade_equivalent = "";
          break;
      case "":
          $midterm_grade_equivalent = "";
          break;
      case "":
          $midterm_grade_equivalent = "";
          break;
      case "":
          $midterm_grade_equivalent = "";
          break;
      case "":
          $midterm_grade_equivalent = "";
          break;
      case "":
          $midterm_grade_equivalent = "";
          break;
      case "":
          $midterm_grade_equivalent = "";
          break;
      case "":
          $midterm_grade_equivalent = "";
          break;
      case "":
          $midterm_grade_equivalent = "";
          break;
      case "":
          $midterm_grade_equivalent = "";
          break;
      case "":
          $midterm_grade_equivalent = "";
          break;
      case "":
          $midterm_grade_equivalent = "";
          break;
      case "":
          $midterm_grade_equivalent = "";
          break;
      case "":
          $midterm_grade_equivalent = "";
          break;
      case "":
          $midterm_grade_equivalent = "";
          break;
      case "":
          $midterm_grade_equivalent = "";
          break;
      case "":
          $midterm_grade_equivalent = "";
          break;
      case "":
          $midterm_grade_equivalent = "";
          break;
      case "":
          $midterm_grade_equivalent = "";
          break;
      case "":
          $midterm_grade_equivalent = "";
          break;
      case "":
          $midterm_grade_equivalent = "";
          break;
      case "":
          $midterm_grade_equivalent = "";
          break;
      case "":
          $midterm_grade_equivalent = "";
          break;
      case "":
          $midterm_grade_equivalent = "";
          break;
      case "":
          $midterm_grade_equivalent = "";
          break;
      case "":
          $midterm_grade_equivalent = "";
          break;
      case "":
          $midterm_grade_equivalent = "";
          break;
      case "":
          $midterm_grade_equivalent = "";
          break;
      case "":
          $midterm_grade_equivalent = "";
          break;
      case "":
          $midterm_grade_equivalent = "";
          break;
      case "":
          $midterm_grade_equivalent = "";
          break;
      case "":
          $midterm_grade_equivalent = "";
          break;
      case "":
          $midterm_grade_equivalent = "";
          break;
      case "":
          $midterm_grade_equivalent = "";
          break;
      case "":
          $midterm_grade_equivalent = "";
          break;
      default:
          $midterm_grade_equivalent = "";
  }

  if($midterm_grade_equivalent >= 75){
    $midterm_remarks = "Passed";
  }else{
    $midterm_remarks = "Failed";
  }


?>

<tr>
<td><?php echo $product_no; ?></td>
<td><?php echo $fullname; ?></td>
<td><a href="#"><?php echo $prelim_formative_assessment_1; ?></a></td> 
<td><a href="#"><?php echo $prelim_formative_assessment_2; ?></a></td> 
<td><a href="#"><?php echo $prelim_formative_assessment_3; ?></a></td> 
<td><a href="#"><?php echo $prelim_formative_assessment_4; ?></a></td> 
<td><a href="#"><?php echo $prelim_formative_assessment_5; ?></a></td> 
<td><a href="#"><?php echo $prelim_formative_assessment_6; ?></a></td> 
<td><a href="#"><?php echo $prelim_formative_assessment_7; ?></a></td> 
<td><a href="#"><?php echo $prelim_formative_assessment_8; ?></a></td> 
<td><a href="#"><?php echo $prelim_formative_assessment_9; ?></a></td> 
<td><a href="#"><?php echo $prelim_formative_assessment_10; ?></a></td> 
<td><a href="#"><?php echo $prelim_formative_assessment_total_score; ?></a></td> 
<td><a href="#"><?php echo $prelim_formative_assessment_base; ?></a></td> 
<td><a href="#"><?php echo $prelim_output_1; ?></a></td> 
<td><a href="#"><?php echo $prelim_output_2; ?></a></td> 
<td><a href="#"><?php echo $prelim_output_total_score; ?></a></td> 
<td><a href="#"><?php echo $prelim_output_base; ?></a></td> 
<td><a href="#"><?php echo $prelim_output_weight; ?></a></td> 
<td><a href="#"><?php echo $prelim_performance_1; ?></a></td> 
<td><a href="#"><?php echo $prelim_performance_2; ?></a></td> 
<td><a href="#"><?php echo $prelim_performance_total_score; ?></a></td> 
<td><a href="#"><?php echo $prelim_performance_base; ?></a></td> 
<td><a href="#"><?php echo $prelim_performance_weight; ?></a></td> 
<td><a href="#"><?php echo $prelim_written_test; ?></a></td> 
<td><a href="#"><?php echo $prelim_written_test_base; ?></a></td> 
<td><a href="#"><?php echo $prelim_written_test_weight; ?></a></td> 
<td><a href="#"><?php echo $prelim_grade; ?></a></td> 
<td><a href="#"><?php echo $prelim_grade_equivalent; ?></a></td> 

<td><a href="#"><?php echo $midterm_formative_assessment_1; ?></a></td> 
<td><a href="#"><?php echo $midterm_formative_assessment_2; ?></a></td> 
<td><a href="#"><?php echo $midterm_formative_assessment_3; ?></a></td> 
<td><a href="#"><?php echo $midterm_formative_assessment_4; ?></a></td> 
<td><a href="#"><?php echo $midterm_formative_assessment_5; ?></a></td> 
<td><a href="#"><?php echo $midterm_formative_assessment_6; ?></a></td> 
<td><a href="#"><?php echo $midterm_formative_assessment_7; ?></a></td> 
<td><a href="#"><?php echo $midterm_formative_assessment_8; ?></a></td> 
<td><a href="#"><?php echo $midterm_formative_assessment_9; ?></a></td> 
<td><a href="#"><?php echo $midterm_formative_assessment_10; ?></a></td> 
<td><a href="#"><?php echo $midterm_formative_assessment_total_score; ?></a></td> 
<td><a href="#"><?php echo $midterm_formative_assessment_base; ?></a></td> 
<td><a href="#"><?php echo $midterm_output_1; ?></a></td> 
<td><a href="#"><?php echo $midterm_output_2; ?></a></td> 
<td><a href="#"><?php echo $midterm_output_total_score; ?></a></td> 
<td><a href="#"><?php echo $midterm_output_base; ?></a></td> 
<td><a href="#"><?php echo $midterm_output_weight; ?></a></td> 
<td><a href="#"><?php echo $midterm_performance_1; ?></a></td> 
<td><a href="#"><?php echo $midterm_performance_2; ?></a></td> 
<td><a href="#"><?php echo $midterm_performance_total_score; ?></a></td> 
<td><a href="#"><?php echo $midterm_performance_base; ?></a></td> 
<td><a href="#"><?php echo $midterm_performance_weight; ?></a></td> 
<td><a href="#"><?php echo $midterm_written_test; ?></a></td> 
<td><a href="#"><?php echo $midterm_written_test_base; ?></a></td> 
<td><a href="#"><?php echo $midterm_written_test_weight; ?></a></td> 
<td><a href="#"><?php echo $midterm_2nd_quarter; ?></a></td> 
<td><a href="#"><?php echo $midterm_grade; ?></a></td> 
<td><a href="#"><?php echo $midterm_grade_equivalent; ?></a></td> 
<td><a href="#"><?php echo $midterm_remarks; ?></a></td> 

<td><a href="#"><?php echo $prefinal_formative_assessment_1; ?></a></td> 
<td><a href="#"><?php echo $prefinal_formative_assessment_2; ?></a></td> 
<td><a href="#"><?php echo $prefinal_formative_assessment_3; ?></a></td> 
<td><a href="#"><?php echo $prefinal_formative_assessment_4; ?></a></td> 
<td><a href="#"><?php echo $prefinal_formative_assessment_5; ?></a></td> 
<td><a href="#"><?php echo $prefinal_formative_assessment_6; ?></a></td> 
<td><a href="#"><?php echo $prefinal_formative_assessment_7; ?></a></td> 
<td><a href="#"><?php echo $prefinal_formative_assessment_8; ?></a></td> 
<td><a href="#"><?php echo $prefinal_formative_assessment_9; ?></a></td> 
<td><a href="#"><?php echo $prefinal_formative_assessment_10; ?></a></td> 
<td><a href="#"><?php echo $prefinal_formative_assessment_total_score; ?></a></td> 
<td><a href="#"><?php echo $prefinal_formative_assessment_base; ?></a></td> 
<td><a href="#"><?php echo $prefinal_output_1; ?></a></td> 
<td><a href="#"><?php echo $prefinal_output_2; ?></a></td> 
<td><a href="#"><?php echo $prefinal_output_total_score; ?></a></td> 
<td><a href="#"><?php echo $prefinal_output_base; ?></a></td> 
<td><a href="#"><?php echo $prefinal_output_weight; ?></a></td> 
<td><a href="#"><?php echo $prefinal_performance_1; ?></a></td> 
<td><a href="#"><?php echo $prefinal_performance_2; ?></a></td> 
<td><a href="#"><?php echo $prefinal_performance_total_score; ?></a></td> 
<td><a href="#"><?php echo $prefinal_performance_base; ?></a></td> 
<td><a href="#"><?php echo $prefinal_performance_weight; ?></a></td> 
<td><a href="#"><?php echo $prefinal_written_test; ?></a></td> 
<td><a href="#"><?php echo $prefinal_written_test_base; ?></a></td> 
<td><a href="#"><?php echo $prefinal_written_test_weight; ?></a></td> 
<td><a href="#"><?php echo $prefinal_3rd_quarter; ?></a></td> 
<td><a href="#"><?php echo $prefinal_grade; ?></a></td> 
<td><a href="#"><?php echo $prefinal_grade_equivalent; ?></a></td> 

<td><a href="#"><?php echo $final_formative_assessment_1; ?></a></td> 
<td><a href="#"><?php echo $final_formative_assessment_2; ?></a></td> 
<td><a href="#"><?php echo $final_formative_assessment_3; ?></a></td> 
<td><a href="#"><?php echo $final_formative_assessment_4; ?></a></td> 
<td><a href="#"><?php echo $final_formative_assessment_5; ?></a></td> 
<td><a href="#"><?php echo $final_formative_assessment_6; ?></a></td> 
<td><a href="#"><?php echo $final_formative_assessment_7; ?></a></td> 
<td><a href="#"><?php echo $final_formative_assessment_8; ?></a></td> 
<td><a href="#"><?php echo $final_formative_assessment_9; ?></a></td> 
<td><a href="#"><?php echo $final_formative_assessment_10; ?></a></td> 
<td><a href="#"><?php echo $final_formative_assessment_total_score; ?></a></td> 
<td><a href="#"><?php echo $final_formative_assessment_base; ?></a></td> 
<td><a href="#"><?php echo $final_output_1; ?></a></td> 
<td><a href="#"><?php echo $final_output_2; ?></a></td> 
<td><a href="#"><?php echo $final_output_total_score; ?></a></td> 
<td><a href="#"><?php echo $final_output_base; ?></a></td> 
<td><a href="#"><?php echo $final_weight; ?></a></td> 
<td><a href="#"><?php echo $final_performance_1; ?></a></td> 
<td><a href="#"><?php echo $final_performance_2; ?></a></td> 
<td><a href="#"><?php echo $final_performance_total_score; ?></a></td> 
<td><a href="#"><?php echo $final_performance_base; ?></a></td> 
<td><a href="#"><?php echo $final_performance_weight; ?></a></td> 
<td><a href="#"><?php echo $final_written_test; ?></a></td> 
<td><a href="#"><?php echo $final_written_test_base; ?></a></td> 
<td><a href="#"><?php echo $final_written_test_weight; ?></a></td> 
<td><a href="#"><?php echo $final_4th_quarter; ?></a></td> 
<td><a href="#"><?php echo $final_grade; ?></a></td> 
<td><a href="#"><?php echo $final_grade_equivalent; ?></a></td> 
<td><a href="#"><?php echo $final_grade_remarks; ?></a></td> 
</tr>

<?php
}
?>
</table>
</div>
<?php
include("../../bins/footer_non_fixed.php");
?>