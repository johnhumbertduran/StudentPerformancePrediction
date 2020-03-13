<?php



// $final_formative_assessment_1 = $final_formative_assessment_2 =
// $final_formative_assessment_3 = $final_formative_assessment_4 =
// $final_formative_assessment_5 = $final_formative_assessment_6 =
// $final_formative_assessment_7 = $final_formative_assessment_8 =
// $final_formative_assessment_9 = $final_formative_assessment_10 =
// $final_formative_assessment_total_score = $final_formative_assessment_base =
$final_output_1 = $final_output_2 =
$final_output_total_score = $final_output_base =
$final_output_weight = $final_performance_1 =
$final_performance_2 = $final_performance_total_score =
$final_performance_base = $final_performance_weight =
$final_written_test = $final_written_test_base =
$final_written_test_weight = $final_4th_quarter =
$final_grade = $final_grade_equivalent = "0";
$final_grade_remarks ="";



if(isset($_GET["redir"])){

    if($_GET["redir"] == "select_grading"){
      $grade_period = "";
    }else{
      $grade_period = $_GET["redir"];
    }

    }else{
        $grade_period = "";
 }


 if(isset($_GET["_y"])){

    if($_GET["_y"] == "select_year"){
      $year = "";
    }else{
      $year = $_GET["_y"];
    }
  
    
  }else{
    $year = "";
  }
  
  

if(isset($_GET["_c"])){

    if($_GET["_c"] == "select_course"){
      $course = "";
    }else{
      $course = $_GET["_c"];
      // echo $course;
    }
  
    
  }else{
    $course = "";
  }
  
  if(isset($_GET["_s_e_"])){

    if($_GET["_s_e_"] == "select_semester"){
      $semester = "";
    }else{
      $semester = $_GET["_s_e_"];
      // echo $semester;
    }
  
    
  }else{
    $semester = "";
  }
  
  
  

?>

<br>
<div class="table-responsive mt-3">
<table border="1" class="table table-hover">
    <thead>
    <tr><th class="px-3" colspan="2"></th>
    <th class="px-3 text-center bg-warning text-white" colspan="17">Final Period</th></tr><!-- Final Here -->

    <tr><th class="px-3">Student&nbsp;ID</th><th class="px-3">Student&nbsp;Name</th>
    <!-- <th class="px-5 text-center bg-warning text-white" colspan="12">Formative Assessment</th> --><th class="px-5 text-center bg-warning text-white" colspan="5">Outpout</th><th class="px-5 text-center bg-warning text-white" colspan="5">Performance</th><th class="px-5 text-center bg-warning text-white" colspan="3">Written&nbsp;Test</th><th class="px-5 text-center bg-warning text-white">4th&nbsp;Quarter</th><th class="px-5 text-center bg-warning text-white" colspan="2">Final&nbsp;Grade</th><th class="px-5 text-center bg-warning text-white">Remarks</th></tr><!-- Final Here -->

    <tr><th class="px-3"></th><th class="px-3">Highest&nbsp;Possible&nbsp;Score</th>
    <!-- <th class="bg-warning text-white">10</th><th class="bg-warning text-white">10</th><th class="bg-warning text-white">10</th><th class="bg-warning text-white">10</th><th class="bg-warning text-white">10</th><th class="bg-warning text-white">10</th><th class="bg-warning text-white">10</th><th class="bg-warning text-white">10</th><th class="bg-warning text-white">10</th><th class="bg-warning text-white">10</th><th class="bg-warning text-white">100</th><th class="bg-warning text-white">60</th> --><th class="bg-warning text-white">20</th><th class="bg-warning text-white">20</th><th class="bg-warning text-white">40</th><th class="bg-warning text-white">60</th><th class="bg-warning text-white">0.40</th><th class="bg-warning text-white">20</th><th class="bg-warning text-white">20</th><th class="bg-warning text-white">40</th><th class="bg-warning text-white">60</th><th class="bg-warning text-white">0.40</th><th class="bg-warning text-white">30</th><th class="bg-warning text-white">60</th><th class="bg-warning text-white">0.20</th><th class="bg-warning text-white"></th><th class="bg-warning text-white"></th><th class="bg-warning text-white"></th><th class="bg-warning text-white"></th></tr><!-- Final Here -->
    </thead>

    <tbody>

<?php

if($grade_period == "final"){
    if(isset($_GET["_y"])){
      if($year == $_GET["_y"]){
        if(isset($_GET["_c"])){
          if($course == $_GET["_c"]){
              if(isset($_GET["_s_e_"])){
                  if($semester == $_GET["_s_e_"]){

                  $grade_period = $grade_period . $semester[3];
                  $semester_no = $semester[3];
                  $prefinal = "prefinal$semester_no"; 
                  $midterm = "midterm$semester_no"; 
                  $prelim = "prelim$semester_no"; 


                  $grading_period = mysqli_query($connections, "SELECT * FROM $grade_period WHERE course='$course' AND year='$year' ");
                  $prefinal_qry = mysqli_query($connections, "SELECT * FROM $prefinal WHERE course='$course' AND year='$year' ");
                  $midterm_qry = mysqli_query($connections, "SELECT * FROM $midterm WHERE course='$course' AND year='$year' ");
                  $prelim_qry = mysqli_query($connections, "SELECT * FROM $prelim WHERE course='$course' AND year='$year' ");
                    
                  midterm_query($grading_period,$prefinal_qry,$midterm_qry,$prelim_qry);
              }
            }
          }
        }
      }
    }
  }
  



function midterm_query($grading_period,$prefinal_qry,$midterm_qry,$prelim_qry){
while($row_student = mysqli_fetch_assoc($grading_period)){

    
   
$row_prefinal = mysqli_fetch_assoc($prefinal_qry);
$row_midterm = mysqli_fetch_assoc($midterm_qry);
$row_prelim = mysqli_fetch_assoc($prelim_qry);

$student_no = $row_student["student_no"];
$fullname = $row_student["student_name"];
$final_output_1 = $row_student["final_output_1"];
$final_output_2 = $row_student["final_output_2"];
$final_output_total_score = $row_student["final_output_total_score"];
$final_output_base = $row_student["final_output_base"];
$final_output_weight = $row_student["final_output_weight"];
$final_performance_1 = $row_student["final_performance_1"];
$final_performance_2 = $row_student["final_performance_2"];
$final_performance_total_score = $row_student["final_performance_total_score"];
$final_performance_base = $row_student["final_performance_base"];
$final_performance_weight = $row_student["final_performance_weight"];
$final_written_test = $row_student["final_written_test"];
$final_written_test_base = $row_student["final_written_test_base"];
$final_written_test_weight = $row_student["final_written_test_weight"];
$final_grade = $row_student["final_grade"];
$final_grade_equivalent = $row_student["final_grade_equivalent"];




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


$midterm_performance_total_score = $midterm_performance_1 + $midterm_performance_2;
$midterm_performance_base = $midterm_performance_total_score / 40 * 40 + 60;
$midterm_written_test_base = $midterm_written_test / 30 * 40 + 60;

$midterm_output_weight = $midterm_output_base * 0.40;
$midterm_performance_weight = $midterm_performance_base * 0.40;
$midterm_written_test_weight = $midterm_written_test_base * 0.20;
$midterm_2nd_quarter = $midterm_output_weight + $midterm_performance_weight + $midterm_written_test_weight;


$midterm_grade = $prelim_grade * 0.3 + $midterm_2nd_quarter * 0.7;


$prefinal_output_1 = $row_prefinal["prefinal_output_1"]; //ok
$prefinal_output_2 = $row_prefinal["prefinal_output_2"]; //ok
$prefinal_performance_1 = $row_prefinal["prefinal_performance_1"]; //ok
$prefinal_performance_2 = $row_prefinal["prefinal_performance_2"]; //ok
$prefinal_written_test = $row_prefinal["prefinal_written_test"]; //ok
// $prefinal_grade_equivalent = $row_prefinal["prefinal_grade_equivalent"];

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




    // ####################______Final Formulas______####################
    // $final_formative_assessment_total_score =
    // $final_formative_assessment_1 + $final_formative_assessment_2 +
    // $final_formative_assessment_3 + $final_formative_assessment_4 +
    // $final_formative_assessment_5 + $final_formative_assessment_6 +
    // $final_formative_assessment_7 + $final_formative_assessment_8 +
    // $final_formative_assessment_9 + $final_formative_assessment_10;

    // $final_formative_assessment_base = $final_formative_assessment_total_score / 100 * 40 + 60;
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

  if($final_grade >= 74.5){
    $final_grade_remarks = "Passed";
  }else{
    $final_grade_remarks = "Failed";
  }

  
  $year = $_GET["_y"];
  $course = $_GET["_c"];
  $semester = $_GET["_s_e_"];

?>

<tr>
<td><?php echo $student_no; ?></td>
<td><?php echo $fullname; ?></td>

<!-- <td><a href="#"><?php /* echo $final_formative_assessment_1; */ ?></a></td> 
<td><a href="#"><?php /* echo $final_formative_assessment_2; */ ?></a></td> 
<td><a href="#"><?php /* echo $final_formative_assessment_3; */ ?></a></td> 
<td><a href="#"><?php /* echo $final_formative_assessment_4; */ ?></a></td> 
<td><a href="#"><?php /* echo $final_formative_assessment_5; */ ?></a></td> 
<td><a href="#"><?php /* echo $final_formative_assessment_6; */ ?></a></td> 
<td><a href="#"><?php /* echo $final_formative_assessment_7; */ ?></a></td> 
<td><a href="#"><?php /* echo $final_formative_assessment_8; */ ?></a></td> 
<td><a href="#"><?php /* echo $final_formative_assessment_9; */ ?></a></td> 
<td><a href="#"><?php /* echo $final_formative_assessment_10; */ ?></a></td> 
<td><a href="#"><?php /* echo $final_formative_assessment_total_score; */ ?></a></td> 
<td><a href="#"><?php /* echo $final_formative_assessment_base; */ ?></a></td>  -->
<td><a href="?redir=final&_y=<?php echo $year; ?>&_c=<?php echo $course; ?>&_s_e_=<?php echo $semester; ?>&po1=<?php echo $student_no; ?>"><?php echo $final_output_1; ?></a></td> 
<td><a href="?redir=final&_y=<?php echo $year; ?>&_c=<?php echo $course; ?>&_s_e_=<?php echo $semester; ?>&po2=<?php echo $student_no; ?>"><?php echo $final_output_2; ?></a></td> 
<td><a class="text-danger"><?php echo $final_output_total_score; ?></a></td> 
<td><a class="text-danger"><?php echo $final_output_base; ?></a></td> 
<td><a class="text-danger"><?php echo $final_output_weight; ?></a></td> 
<td><a href="?redir=final&_y=<?php echo $year; ?>&_c=<?php echo $course; ?>&_s_e_=<?php echo $semester; ?>&pp1=<?php echo $student_no; ?>"><?php echo $final_performance_1; ?></a></td> 
<td><a href="?redir=final&_y=<?php echo $year; ?>&_c=<?php echo $course; ?>&_s_e_=<?php echo $semester; ?>&pp2=<?php echo $student_no; ?>"><?php echo $final_performance_2; ?></a></td> 
<td><a class="text-danger"><?php echo $final_performance_total_score; ?></a></td> 
<td><a class="text-danger"><?php echo $final_performance_base; ?></a></td> 
<td><a class="text-danger"><?php echo $final_performance_weight; ?></a></td> 
<td><a href="?redir=final&_y=<?php echo $year; ?>&_c=<?php echo $course; ?>&_s_e_=<?php echo $semester; ?>&pwt=<?php echo $student_no; ?>"><?php echo $final_written_test; ?></a></td> 
<td><a class="text-danger"><?php echo number_format((float)$final_written_test_base,2,".",""); ?></a></td> 
<td><a class="text-danger"><?php echo number_format((float)$final_written_test_weight,2,".",""); ?></a></td> 
<td><a class="text-danger"><?php echo number_format((float)$final_4th_quarter,2,".",""); ?></a></td> 
<td><a class="<?php if($final_grade >= 74.5){ echo 'text-success';}else{echo 'text-danger';} ?>"><?php echo number_format((float)$final_grade,2,".",""); ?></a></td> 
<td><a class="<?php if($final_grade >= 74.5){ echo 'text-success';}else{echo 'text-danger';} ?>"><?php echo $final_grade_equivalent; ?></a></td> 
<td><a class="<?php if($final_grade_remarks == 'Passed'){ echo 'text-success';}else{echo 'text-danger';} ?>"><?php echo $final_grade_remarks; ?></a></td> 
</tr>

<?php
}
}
?>
</table>
</div>


<div class="fixed-top">

<?php
 if(isset($_GET["po1"])){
  include("redir.php");
}elseif(isset($_GET["po2"])){
  include("redir.php");
}elseif(isset($_GET["pots"])){
  include("redir.php");
}elseif(isset($_GET["pob"])){
  include("redir.php");
}elseif(isset($_GET["pow"])){
  include("redir.php");
}elseif(isset($_GET["pp1"])){
  include("redir.php");
}elseif(isset($_GET["pp2"])){
  include("redir.php");
}elseif(isset($_GET["ppts"])){
  include("redir.php");
}elseif(isset($_GET["ppb"])){
  include("redir.php");
}elseif(isset($_GET["ppw"])){
  include("redir.php");
}elseif(isset($_GET["pwt"])){
  include("redir.php");
}elseif(isset($_GET["pwtb"])){
  include("redir.php");
}elseif(isset($_GET["pwtw"])){
  include("redir.php");
}elseif(isset($_GET["pg"])){
  include("redir.php");
}elseif(isset($_GET["pge"])){
  include("redir.php");
}
?>
</div>

<input type="text" value="<?php echo $_GET["redir"]; ?>" id="grade_period">
<input type="text" value="<?php echo $_GET["_y"]; ?>" id="year">
<input type="text" value="<?php echo $_GET["_c"]; ?>" id="course">
<input type="text" value="<?php echo $_GET["_s_e_"]; ?>" id="semester">

<script>

  var grading = document.getElementById("grade_period").value;
  var year = document.getElementById("year");
  var selected_year = year.value;
  var course = document.getElementById("course");
  var selected_course = course.value;
  var semester = document.getElementById("semester");
  var selected_semester = semester.value;

    function relocate(){
      window.location.href = "studentperformance?redir="+grading+"&_y="+selected_year+"&_c="+selected_course+"&_s_e_="+selected_semester;
      // alert("hay");
    }


    get_black = document.getElementById("black1");
    
    get_black.addEventListener("click", relocate);

</script>
