<?php


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


?>



<br>
<div class="table-responsive">
<table border="1" class="table table-hover">
    <thead>
    <tr><th class="px-3" colspan="2"></th>
    <th class="px-3 text-center bg-danger text-white" colspan="28">Prefinal Period</th></tr><!-- Prefinal Here -->

    <tr><th class="px-3">Student&nbsp;ID</th><th class="px-3">Student&nbsp;Name</th>
    <th class="px-5 text-center bg-danger text-white" colspan="12">Formative Assessment</th><th class="px-5 text-center bg-danger text-white" colspan="5">Outpout</th><th class="px-5 text-center bg-danger text-white" colspan="5">Performance</th><th class="px-5 text-center bg-danger text-white" colspan="3">Written&nbsp;Test</th><th class="px-5 text-center bg-danger text-white">3rd&nbsp;Quarter</th><th class="px-5 text-center bg-danger text-white" colspan="2">Prefinal&nbsp;Grade</th></tr><!-- Prefinal Here -->

    <tr><th class="px-3"></th><th class="px-3">Highest&nbsp;Possible&nbsp;Score</th>
    <th class="bg-danger text-white">10</th><th class="bg-danger text-white">10</th><th class="bg-danger text-white">10</th><th class="bg-danger text-white">10</th><th class="bg-danger text-white">10</th><th class="bg-danger text-white">10</th><th class="bg-danger text-white">10</th><th class="bg-danger text-white">10</th><th class="bg-danger text-white">10</th><th class="bg-danger text-white">10</th><th class="bg-danger text-white">100</th><th class="bg-danger text-white">60</th><th class="bg-danger text-white">20</th><th class="bg-danger text-white">20</th><th class="bg-danger text-white">40</th><th class="bg-danger text-white">60</th><th class="bg-danger text-white">0.40</th><th class="bg-danger text-white">20</th><th class="bg-danger text-white">20</th><th class="bg-danger text-white">40</th><th class="bg-danger text-white">60</th><th class="bg-danger text-white">0.40</th><th class="bg-danger text-white">30</th><th class="bg-danger text-white">60</th><th class="bg-danger text-white">0.20</th><th class="bg-danger text-white"></th><th class="bg-danger text-white"></th><th class="bg-danger text-white"></th></tr><!-- Prefinal Here -->
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

$midterm_qry = mysqli_query($connections, "SELECT * FROM midterm");
$row_midterm = mysqli_fetch_assoc($midterm_qry);
$midterm_grade = $row_midterm["midterm_grade"];


    // ####################______Prefinal Formulas______####################
    $prefinal_formative_assessment_total_score =
    $prefinal_formative_assessment_1 + $prefinal_formative_assessment_2 +
    $prefinal_formative_assessment_3 + $prefinal_formative_assessment_4 +
    $prefinal_formative_assessment_5 + $prefinal_formative_assessment_6 +
    $prefinal_formative_assessment_7 + $prefinal_formative_assessment_8 +
    $prefinal_formative_assessment_9 + $prefinal_formative_assessment_10;
  
    $prefinal_formative_assessment_base = $prefinal_formative_assessment_total_score / 100 * 40 + 60;
    $prefinal_output_total_score = $prefinal_output_1 + $prefinal_output_2;
    $prefinal_output_base = $prefinal_output_total_score / 40 * 40 + 60;
    $prefinal_output_weight = $prefinal_output_base * 0.40;
    $prefinal_performance_total_score = $prefinal_performance_1 + $prefinal_performance_2;
    $prefinal_performance_base = $prefinal_performance_total_score / 40 * 40 + 60;
    $prefinal_performance_weight = $prefinal_performance_base * 0.40;
    $prefinal_written_test_base = $prefinal_written_test / 30 * 40 + 60;
    $prefinal_written_test_weight = $prefinal_written_test_base * 0.20;
    $prefinal_3rd_quarter = $prefinal_output_weight + $prefinal_performance_weight + $prefinal_written_test_weight;
    $prefinal_grade = $midterm_grade * 0.3 + $prefinal_3rd_quarter * 0.7;
  
    switch (true) {
      //   case ($prefinal_grade <= 74.4):
      //       $prefinal_grade_equivalent = "5";
      //       break;
        case ($prefinal_grade >= 74.5 && $prefinal_grade <= 76.4):
            $prefinal_grade_equivalent = "3";
            break;
        case ($prefinal_grade >= 76.5 && $prefinal_grade <= 79.4):
            $prefinal_grade_equivalent = "2.75";
            break;
        case ($prefinal_grade >= 79.5 && $prefinal_grade <= 82.4):
            $prefinal_grade_equivalent = "2.5";
            break;
        case ($prefinal_grade >= 82.5 && $prefinal_grade <= 85.4):
            $prefinal_grade_equivalent = "2.25";
            break;
        case ($prefinal_grade >= 85.5 && $prefinal_grade <= 88.4):
            $prefinal_grade_equivalent = "2";
            break;
        case ($prefinal_grade >= 88.5 && $prefinal_grade <= 91.4):
            $prefinal_grade_equivalent = "1.75";
            break;
        case ($prefinal_grade >= 91.5 && $prefinal_grade <= 94.4):
            $prefinal_grade_equivalent = "1.5";
            break;
        case ($prefinal_grade >= 94.5 && $prefinal_grade <= 97.4):
            $prefinal_grade_equivalent = "1.25";
            break;
        case ($prefinal_grade >= 97.5 && $prefinal_grade <= 100):
            $prefinal_grade_equivalent = "1";
            break;
  
        default:
            $prefinal_grade_equivalent = "5";
    }
  


?>

<tr>
<td><?php echo $student_no; ?></td>
<td><?php echo $fullname; ?></td>

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
</tr>

<?php
}
?>
</table>
</div>