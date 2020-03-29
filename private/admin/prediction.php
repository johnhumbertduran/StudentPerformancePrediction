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
<h1 class="py-3 text-info px-1">Student Prediction</h1>
</center>


<style>
.prediction{
  border: 1.5px solid white;
  border-radius: 6px;
}


#prefinal_grade_prediction{
  border:none;
  background-color: transparent;
}

#final_grade_prediction{
  border:none;
  background-color: transparent;
}
</style>

<?php
include("../bins/teacher_nav.php");
?>
<br>

<div class="container-fluid d-inline py-5">
<select class="form-control col-2 ml-2 pt-1 pb-2 d-inline text-white text-white bg-info" id="year" onchange="year()">
  <option value="select_year">Select Year</option>
  <option value="2018" <?php if(isset($_GET['_y'])){ if($_GET['_y'] == "2018"){ echo "selected"; }}?> >2018</option>
  <option value="2017" <?php if(isset($_GET['_y'])){ if($_GET['_y'] == "2017"){ echo "selected"; }}?> >2017</option>
  <option value="2016" <?php if(isset($_GET['_y'])){ if($_GET['_y'] == "2016"){ echo "selected"; }}?> >2016</option>
  <option value="2015" <?php if(isset($_GET['_y'])){ if($_GET['_y'] == "2015"){ echo "selected"; }}?> >2015</option>
  <option value="2014" <?php if(isset($_GET['_y'])){ if($_GET['_y'] == "2014"){ echo "selected"; }}?> >2014</option>
  <option value="2013" <?php if(isset($_GET['_y'])){ if($_GET['_y'] == "2013"){ echo "selected"; }}?> >2013</option>
  <option value="2012" <?php if(isset($_GET['_y'])){ if($_GET['_y'] == "2012"){ echo "selected"; }}?> >2012</option>
  <option value="2011" <?php if(isset($_GET['_y'])){ if($_GET['_y'] == "2011"){ echo "selected"; }}?> >2011</option>
</select>

<select class="form-control col-2 ml-2 pt-1 pb-2 d-inline <?php if(!isset($_GET['_y'])){ echo "bg-secondary"; }else{ if($_GET['_y'] == "select_year"){ echo "bg-secondary"; }else{ echo "bg-info"; }}?> text-white" <?php if(!isset($_GET['_y'])){ echo "disabled"; }else{ if($_GET['_y'] == "select_year"){ echo "disabled"; }}?> id="course" onchange="course()">
  <option value="select_course">Select Course</option>
  <option value="BSIT" <?php if(isset($_GET['_c'])){ if($_GET['_c'] == "BSIT"){ echo "selected"; }}?> >BSIT</option>
  <option value="BSCS" <?php if(isset($_GET['_c'])){ if($_GET['_c'] == "BSCS"){ echo "selected"; }}?> >BSCS</option>
</select>

<!-- <select class="form-control col-2 ml-2 pt-1 pb-2 d-inline <?php /* if(!isset($_GET['_c'])){ echo "bg-secondary"; }else{ if($_GET['_c'] == "select_course"){ echo "bg-secondary"; }else{ echo "bg-info"; }} */?> text-white" <?php /* if(!isset($_GET['_c'])){ echo "disabled"; }else{ if($_GET['_c'] == "select_course"){ echo "disabled"; }} */?> id="subject" onchange="subject()">
  <option value="select_subject">Select Subject</option>
  <option value="application_programming1" <?php /* if(isset($_GET['_s'])){ if($_GET['_s'] == "application_programming1"){ echo "selected"; }} */?> >Application Programming 1</option>
  <option value="application_programming2" <?php /* if(isset($_GET['_s'])){ if($_GET['_s'] == "application_programming2"){ echo "selected"; }} */?> >Application Programming 2</option>
</select> -->


<select class="form-control col-2 ml-2 pt-1 pb-2 d-inline <?php if(!isset($_GET['_c'])){ echo "bg-secondary"; }else{ if($_GET['_c'] == "select_semester"){ echo "bg-secondary"; }else{ echo "bg-info"; }}?> text-white" <?php if(!isset($_GET['_c'])){ echo "disabled"; }else{ if($_GET['_c'] == "select_semester"){ echo "disabled"; }}?> id="semester" onchange="semester()">
  <option value="select_semester">Select Semester</option>
  <option value="sem1" <?php if(isset($_GET['_s_e_'])){ if($_GET['_s_e_'] == "sem1"){ echo "selected"; }}?>>1st Semester</option>
  <option value="sem2" <?php if(isset($_GET['_s_e_'])){ if($_GET['_s_e_'] == "sem2"){ echo "selected"; }}?>>2nd Semester</option>
</select>

</div>


<!-- ######################################################################################### -->
<!-- ################################### Table Starts Here ################################### -->
<!-- ######################################################################################### -->

<div class="table-responsive table_table mt-3 container">
<table border="1" class="table table-hover">
    <thead>
    <tr><th class="px-3 text-center bg-info text-white" colspan="7">Student Grade</th></tr><!-- Preliminary Here -->

    <tr class="text-center"><th class="px-3">Student ID</th><th class="px-3">Student Name</th><th class="px-3 bg-success text-white">Prelim</th><th class="px-3 bg-primary text-white">Midterm</th><th class="px-3 bg-danger text-white" id="prefinal">Prefinal</th><th class="px-3 bg-warning text-white" id="final">Final</th><th class="px-3 bg-dark text-white" id="prediction1">Prediction</th></tr>

    </thead>

    <tbody>

<?php

  if(isset($_GET["_y"])){
    $year = $_GET["_y"];
  }else{
    $year = "";
  }

  

  if(isset($_GET["_c"])){
    $course = $_GET["_c"];
  }else{
    $course = "BSIT";
  }


  if(isset($_GET["_s_e_"])){
    $semester = $_GET["_s_e_"];
  }else{
    $semester = "sem1";
  }

  if(isset($_GET["_y"]) && !isset($_GET["_c"]) && !isset($_GET["_s_e_"])){
    $ready = "100";
  }elseif(isset($_GET["_y"]) && isset($_GET["_c"]) && !isset($_GET["_s_e_"])){
    $ready = "110";
  }elseif(isset($_GET["_y"]) && isset($_GET["_c"]) && isset($_GET["_s_e_"])){
    $ready = "111";
  }else{
    $ready = "";
  }

  // echo $ready;

  

  $prelim = "prelim$semester[3]";
  $midterm = "midterm$semester[3]";
  $prefinal = "prefinal$semester[3]";
  $final = "final$semester[3]";

  if($ready == "100"){
    $prelim_qry = mysqli_query($connections, "SELECT * FROM $prelim WHERE year='$year' ");
    $midterm_qry = mysqli_query($connections, "SELECT * FROM $midterm WHERE year='$year' ");
    $prefinal_qry = mysqli_query($connections, "SELECT * FROM $prefinal WHERE year='$year' ");
    $final_qry = mysqli_query($connections, "SELECT * FROM $final WHERE year='$year' ");
    $students_qry = mysqli_query($connections, "SELECT * FROM _user_tbl_ WHERE account_type='2' AND year='$year' ");
    // echo "<script>alert('there is a year');</script>";
}elseif($ready == "110"){
    $prelim_qry = mysqli_query($connections, "SELECT * FROM $prelim WHERE year='$year' AND course='$course' ");
    $midterm_qry = mysqli_query($connections, "SELECT * FROM $midterm WHERE year='$year' AND course='$course' ");
    $prefinal_qry = mysqli_query($connections, "SELECT * FROM $prefinal WHERE year='$year' AND course='$course' ");
    $final_qry = mysqli_query($connections, "SELECT * FROM $final WHERE year='$year' AND course='$course' ");
    $students_qry = mysqli_query($connections, "SELECT * FROM _user_tbl_ WHERE account_type='2' AND year='$year' AND course='$course' ");
    // echo "<script>alert('$course');</script>";
  }elseif($ready == "111"){
    $prelim_qry = mysqli_query($connections, "SELECT * FROM $prelim WHERE year='$year' AND course='$course' ");
    $midterm_qry = mysqli_query($connections, "SELECT * FROM $midterm WHERE year='$year' AND course='$course' ");
    $prefinal_qry = mysqli_query($connections, "SELECT * FROM $prefinal WHERE year='$year' AND course='$course' ");
    $final_qry = mysqli_query($connections, "SELECT * FROM $final WHERE year='$year' AND course='$course' ");
    $students_qry = mysqli_query($connections, "SELECT * FROM _user_tbl_ WHERE account_type='2' AND year='$year' AND course='$course' ");
  }else{
    $prelim_qry = mysqli_query($connections, "SELECT * FROM $prelim ");
    $midterm_qry = mysqli_query($connections, "SELECT * FROM $midterm ");
    $prefinal_qry = mysqli_query($connections, "SELECT * FROM $prefinal ");
    $final_qry = mysqli_query($connections, "SELECT * FROM $final ");
    $students_qry = mysqli_query($connections, "SELECT * FROM _user_tbl_ WHERE account_type='2' ");
    // echo "<script>alert('there is no year');</script>";
  }

  


while($row_prelim = mysqli_fetch_assoc($prelim_qry)){
  
  
 $row_midterm = mysqli_fetch_assoc($midterm_qry);
 $row_prefinal = mysqli_fetch_assoc($prefinal_qry);
 $row_final = mysqli_fetch_assoc($final_qry);

 $row_students = mysqli_fetch_assoc($students_qry);
 $student_no = $row_students["student_no"];
 $lastname = $row_students["lastname"];
 $firstname = $row_students["firstname"];
 $middlename = $row_students["middlename"];
 $student_name = $firstname . " " . $middlename[0] . ". " . $lastname;
 

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
<td><?php echo $student_no; ?></td>
<td><?php echo $student_name; ?></td>
<td><?php echo $prelim_grade; ?></td>
<td><?php echo $midterm_grade; ?></td>
<td><span><?php echo $prefinal_grade; ?></span></td>
<td><span><?php echo $final_grade; ?></span></td>
<td>
<a href="?id=<?php echo $student_no; ?>">Predict</a>
</td>
</tr>


<?php
// }
}
?>

</table>
</div>



<!-- ######################################################################################### -->
<!-- ################################### Table Ends Here ################################### -->
<!-- ######################################################################################### -->


<?php
if(isset($_GET["id"])){
  include("student_prediction.php");
}
?>

<br>
<br>
<br>
<br>
<br>
<br>
<br>

<script>

function year(){

  var year = document.getElementById("year");
  var selected_year = year.options[year.selectedIndex].value;

  window.location.href = "?_y="+selected_year;
  // alert("hay");
}

function course(){
  
  var year = document.getElementById("year");
  var selected_year = year.options[year.selectedIndex].value;

  var course = document.getElementById("course");
  var selected_course = course.options[course.selectedIndex].value;
  
  // var selected_semester = f.options[f.selectedIndex].value;

  window.location.href = "?_y="+selected_year+"&_c="+selected_course;
  // alert("hay");
}

// function subject(){
//   var grading = document.getElementById("grade_period");
//   var selected_grading = grading.options[grading.selectedIndex].value;

//   var year = document.getElementById("year");
//   var selected_year = year.options[year.selectedIndex].value;

//   var course = document.getElementById("course");
//   var selected_course = course.options[course.selectedIndex].value;

//   var subject = document.getElementById("subject");
//   var selected_subject = subject.options[subject.selectedIndex].value;
  
//   // var selected_semester = f.options[f.selectedIndex].value;

//   window.location.href = "?redir="+selected_grading+"&_y="+selected_year+"&_c="+selected_course+"&_s="+selected_subject;
//   // alert("hay");
// }

function semester(){
  
  var year = document.getElementById("year");
  var selected_year = year.options[year.selectedIndex].value;

  var course = document.getElementById("course");
  var selected_course = course.options[course.selectedIndex].value;

  // var subject = document.getElementById("subject");
  // var selected_subject = subject.options[subject.selectedIndex].value;

  var semester = document.getElementById("semester");
  var selected_semester = semester.options[semester.selectedIndex].value;

  window.location.href = "?_y="+selected_year+"&_c="+selected_course+/* "&_s="+selected_subject+ */"&_s_e_="+selected_semester;
  // alert("hay");
}

</script>

<?php
include("../../bins/footer_non_fixed.php");
?>