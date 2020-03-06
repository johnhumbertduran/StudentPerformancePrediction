<?php


// $midterm_formative_assessment_1 = $midterm_formative_assessment_2 =
// $midterm_formative_assessment_3 = $midterm_formative_assessment_4 =
// $midterm_formative_assessment_5 = $midterm_formative_assessment_6 =
// $midterm_formative_assessment_7 = $midterm_formative_assessment_8 =
// $midterm_formative_assessment_9 = $midterm_formative_assessment_10 =
// $midterm_formative_assessment_total_score = $midterm_formative_assessment_base =
$midterm_output_1 = $midterm_output_2 =
$midterm_output_total_score = $midterm_output_base =
$midterm_output_weight = $midterm_performance_1 =
$midterm_performance_2 = $midterm_performance_total_score =
$midterm_performance_base = $midterm_performance_weight =
$midterm_written_test = $midterm_written_test_base =
$midterm_written_test_weight = $midterm_2nd_quarter =
$midterm_grade = $midterm_grade_equivalent = "0";
$midterm_remarks = "";



?>



<br>
<div class="table-responsive">
<table border="1" class="table table-hover">
    <thead>
    <tr><th class="px-3" colspan="2"></th><th class="px-3 text-center bg-primary text-white" colspan="17">Midterm</th></tr><!-- Midterm Here -->

    <tr><th class="px-3">Student&nbsp;ID</th><th class="px-3">Student&nbsp;Name</th>
    <!-- <th class="px-5 text-center bg-primary text-white" colspan="12">Formative Assessment</th> --><th class="px-5 text-center bg-primary text-white" colspan="5">Outpout</th><th class="px-5 text-center bg-primary text-white" colspan="5">Performance</th><th class="px-5 text-center bg-primary text-white" colspan="3">Written&nbsp;Test</th><th class="px-5 text-center bg-primary text-white">2nd&nbsp;Quarter</th><th class="px-5 text-center bg-primary text-white" colspan="2">Midterm&nbsp;Grade</th><th class="px-5 text-center bg-primary text-white">Remarks</th></tr><!-- Midterm Here -->

    <tr><th class="px-3"></th><th class="px-3">Highest&nbsp;Possible&nbsp;Score</th>
    <!-- <th class="bg-primary text-white">10</th><th class="bg-primary text-white">10</th><th class="bg-primary text-white">10</th><th class="bg-primary text-white">10</th><th class="bg-primary text-white">10</th><th class="bg-primary text-white">10</th><th class="bg-primary text-white">10</th><th class="bg-primary text-white">10</th><th class="bg-primary text-white">10</th><th class="bg-primary text-white">10</th><th class="bg-primary text-white">100</th><th class="bg-primary text-white">60</th> --><th class="bg-primary text-white">20</th><th class="bg-primary text-white">20</th><th class="bg-primary text-white">40</th><th class="bg-primary text-white">60</th><th class="bg-primary text-white">0.40</th><th class="bg-primary text-white">20</th><th class="bg-primary text-white">20</th><th class="bg-primary text-white">40</th><th class="bg-primary text-white">60</th><th class="bg-primary text-white">0.40</th><th class="bg-primary text-white">30</th><th class="bg-primary text-white">60</th><th class="bg-primary text-white">0.20</th><th class="bg-primary text-white"></th><th class="bg-primary text-white"></th><th class="bg-primary text-white"></th><th class="bg-primary text-white"></th></tr><!-- Midterm Here -->
    </thead>

    <tbody>

<?php

$student_qry = mysqli_query($connections, "SELECT * FROM _user_tbl_ WHERE account_type='2'");


while($row_student = mysqli_fetch_assoc($student_qry)){

  $student_no = $row_student["student_no"];
  $lastname = $row_student["lastname"];
  $firstname = $row_student["firstname"];
  $middlename = $row_student["middlename"];
  
  $fullname = $firstname . " " . $middlename[0] . ". " . $lastname;

$prelim_qry = mysqli_query($connections, "SELECT * FROM prelim");
$row_prelim = mysqli_fetch_assoc($prelim_qry);
$prelim_grade = $row_prelim["prelim_grade"];


    // ####################______Midterm Formulas______####################
    // $midterm_formative_assessment_total_score =
    // $midterm_formative_assessment_1 + $midterm_formative_assessment_2 +
    // $midterm_formative_assessment_3 + $midterm_formative_assessment_4 +
    // $midterm_formative_assessment_5 + $midterm_formative_assessment_6 +
    // $midterm_formative_assessment_7 + $midterm_formative_assessment_8 +
    // $midterm_formative_assessment_9 + $midterm_formative_assessment_10;

    // $midterm_formative_assessment_base = $midterm_formative_assessment_total_score / 100 * 40 + 60;
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


    switch (true) {
      case ($midterm_grade >= 74.5 && $midterm_grade <= 76.4):
          $midterm_grade_equivalent = "3";
          break;
      case ($midterm_grade >= 76.5 && $midterm_grade <= 79.4):
          $midterm_grade_equivalent = "2.75";
          break;
      case ($midterm_grade >= 79.5 && $midterm_grade <= 82.4):
          $midterm_grade_equivalent = "2.5";
          break;
      case ($midterm_grade >= 82.5 && $midterm_grade <= 85.4):
          $midterm_grade_equivalent = "2.25";
          break;
      case ($midterm_grade >= 85.5 && $midterm_grade <= 88.4):
          $midterm_grade_equivalent = "2";
          break;
      case ($midterm_grade >= 88.5 && $midterm_grade <= 91.4):
          $midterm_grade_equivalent = "1.75";
          break;
      case ($midterm_grade >= 91.5 && $midterm_grade <= 94.4):
          $midterm_grade_equivalent = "1.5";
          break;
      case ($midterm_grade >= 94.5 && $midterm_grade <= 97.4):
          $midterm_grade_equivalent = "1.25";
          break;
      case ($midterm_grade >= 97.5 && $midterm_grade <= 100):
          $midterm_grade_equivalent = "1";
          break;

      default:
          $midterm_grade_equivalent = "5";
  }

  if($midterm_grade_equivalent >= 74.5){
    $midterm_remarks = "Passed";
  }else{
    $midterm_remarks = "Failed";
  }




  ?>

  <tr>
  <td><?php echo $student_no; ?></td>
  <td><?php echo $fullname; ?></td>
  <!-- <td><a href="#"><?php echo $midterm_formative_assessment_1; ?></a></td> 
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
  <td><a href="#"><?php echo $midterm_formative_assessment_base; ?></a></td>  -->
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
  
  </tr>

<?php
}
?>
</table>
</div>
