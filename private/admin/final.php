<?php



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

<br>
<div class="table-responsive">
<table border="1" class="table table-hover">
    <thead>
    <tr><th class="px-3" colspan="2"></th>
    <th class="px-3 text-center bg-warning text-white" colspan="29">Final Period</th></tr><!-- Final Here -->

    <tr><th class="px-3">Student&nbsp;ID</th><th class="px-3">Student&nbsp;Name</th>
    <th class="px-5 text-center bg-warning text-white" colspan="12">Formative Assessment</th><th class="px-5 text-center bg-warning text-white" colspan="5">Outpout</th><th class="px-5 text-center bg-warning text-white" colspan="5">Performance</th><th class="px-5 text-center bg-warning text-white" colspan="3">Written&nbsp;Test</th><th class="px-5 text-center bg-warning text-white">4th&nbsp;Quarter</th><th class="px-5 text-center bg-warning text-white" colspan="2">Final&nbsp;Grade</th><th class="px-5 text-center bg-warning text-white">Remarks</th></tr><!-- Final Here -->

    <tr><th class="px-3"></th><th class="px-3">Highest&nbsp;Possible&nbsp;Score</th>
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


    // ####################______Final Formulas______####################
    $final_formative_assessment_total_score =
    $final_formative_assessment_1 + $final_formative_assessment_2 +
    $final_formative_assessment_3 + $final_formative_assessment_4 +
    $final_formative_assessment_5 + $final_formative_assessment_6 +
    $final_formative_assessment_7 + $final_formative_assessment_8 +
    $final_formative_assessment_9 + $final_formative_assessment_10;

    $final_formative_assessment_base = $final_formative_assessment_total_score / 100 * 40 + 60;
    $final_output_total_score = $final_output_1 + $final_output_2;
    $final_output_base = $final_output_total_score / 40 * 40 + 60;
    $final_output_weight = $final_output_base * 0.40;
    $final_performance_total_score = $final_performance_1 + $final_performance_2;
    $final_performance_base = $final_performance_total_score / 40 * 40 + 60;
    $final_performance_weight = $final_performance_base * 0.40;
    $final_written_test_base = $final_written_test / 30 * 40 + 60;
    $final_written_test_weight = $final_written_test_base * 0.20;
    $final_4th_quarter = $final_output_weight + $final_performance_weight + $final_written_test_weight;
    $final_grade = $prefinal_3rd_quarter * 0.3 + $final_4th_quarter * 0.7;


    switch (true) {
      case ($final_grade >= 74.5 && $final_grade <= 76.4):
          $final_grade_equivalent = "3";
          break;
      case ($final_grade >= 76.5 && $final_grade <= 79.4):
          $final_grade_equivalent = "2.75";
          break;
      case ($final_grade >= 79.5 && $final_grade <= 82.4):
          $final_grade_equivalent = "2.5";
          break;
      case ($final_grade >= 82.5 && $final_grade <= 85.4):
          $final_grade_equivalent = "2.25";
          break;
      case ($final_grade >= 85.5 && $final_grade <= 88.4):
          $final_grade_equivalent = "2";
          break;
      case ($final_grade >= 88.5 && $final_grade <= 91.4):
          $final_grade_equivalent = "1.75";
          break;
      case ($final_grade >= 91.5 && $final_grade <= 94.4):
          $midterm_grade_equivalent = "1.5";
          break;
      case ($final_grade >= 94.5 && $final_grade <= 97.4):
          $final_grade_equivalent = "1.25";
          break;
      case ($final_grade >= 97.5 && $final_grade <= 100):
          $final_grade_equivalent = "1";
          break;

      default:
          $final_grade_equivalent = "5";
  }

  if($final_grade_equivalent >= 74.5){
    $final_grade_remarks = "Passed";
  }else{
    $final_grade_remarks = "Failed";
  }


?>

<tr>
<td><?php echo $product_no; ?></td>
<td><?php echo $fullname; ?></td>

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