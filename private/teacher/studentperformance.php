<?php
session_start();

include("../bins/connections.php");
include("../../bins/header.php");


if(isset($_SESSION["username"])){

    $session_user = $_SESSION["username"];
  
    $query_info = mysqli_query($connections, "SELECT * FROM _user_tbl_ WHERE username='$session_user'");
    $my_info = mysqli_fetch_assoc($query_info);
    $account_type = $my_info["account_type"];
    
    if($account_type != 3){
    
        header('Location: ../../forbidden');
    
    }
  
  }else{
    
    header('Location: ../../');
  
  }

  $year_qry = mysqli_query($connections, "SELECT DISTINCT year FROM _user_tbl_ WHERE account_type='2' ");

?>

<center>
<h1 class="py-3 text-info px-1">Student Performance Prediction</h1>
</center>


<style>
.student_performance_active{
  border: 1.5px solid white;
  border-radius: 6px;
}

.black{
    background-color: #000000ef;
    height: 100%;
}

</style>

<?php
include("../bins/teacher_nav.php");
?>
<br>
<!-- <h1>Balik sa midterm ag prefinal may kueang sa column</h1> -->


<br>
<div class="container-fluid d-inline py-5">

<select class="form-control col-3 ml-2 pt-1 pb-2 d-inline bg-info text-white" id="grade_period" onchange="grade_period()">
  <option value="select_grading">Select Grading Period</option>
  <option value="prelim" <?php if(isset($_GET['redir'])){ if($_GET['redir'] == "prelim"){ echo "selected"; }}?> ><a class="btn btn-info ml-2 my-3" href="?redir=prelim">Prelim</a></option>
  <option value="midterm" <?php if(isset($_GET['redir'])){ if($_GET['redir'] == "midterm"){ echo "selected"; }}?> ><a class="btn btn-info ml-2 my-3" href="?redir=midterm">Midterm</a></option>
  <option value="prefinal" <?php if(isset($_GET['redir'])){ if($_GET['redir'] == "prefinal"){ echo "selected"; }}?> ><a class="btn btn-info ml-2 my-3" href="?redir=prefinal">Prefinal</a></option>
  <option value="final" <?php if(isset($_GET['redir'])){ if($_GET['redir'] == "final"){ echo "selected"; }}?> ><a class="btn btn-info ml-2 my-3" href="?redir=final">Final</a></option>
</select>

<!-- <select class="form-control col-2 ml-2 pt-1 pb-2 d-inline text-white text-white <?php if(!isset($_GET['redir'])){ echo 'bg-secondary'; }else{ if($_GET['redir'] == 'select_grading'){ echo 'bg-secondary'; }else{ echo 'bg-info'; }}?>" <?php if(!isset($_GET['redir'])){ echo 'disabled'; }else{ if($_GET['redir'] == 'select_grading'){ echo 'disabled'; }}?> id="year" onchange="year()">
  <option value="select_year">Select Year</option>
  <option value="2018" <?php if(isset($_GET['_y'])){ if($_GET['_y'] == "2018"){ echo "selected"; }}?> >2018</option>
  <option value="2017" <?php if(isset($_GET['_y'])){ if($_GET['_y'] == "2017"){ echo "selected"; }}?> >2017</option>
  <option value="2016" <?php if(isset($_GET['_y'])){ if($_GET['_y'] == "2016"){ echo "selected"; }}?> >2016</option>
  <option value="2015" <?php if(isset($_GET['_y'])){ if($_GET['_y'] == "2015"){ echo "selected"; }}?> >2015</option>
  <option value="2014" <?php if(isset($_GET['_y'])){ if($_GET['_y'] == "2014"){ echo "selected"; }}?> >2014</option>
  <option value="2013" <?php if(isset($_GET['_y'])){ if($_GET['_y'] == "2013"){ echo "selected"; }}?> >2013</option>
  <option value="2012" <?php if(isset($_GET['_y'])){ if($_GET['_y'] == "2012"){ echo "selected"; }}?> >2012</option>
  <option value="2011" <?php if(isset($_GET['_y'])){ if($_GET['_y'] == "2011"){ echo "selected"; }}?> >2011</option>
</select> -->

<select class="form-control col-2 ml-2 pt-1 pb-2 d-inline text-white text-white <?php if(!isset($_GET['redir'])){ echo 'bg-secondary'; }else{ if($_GET['redir'] == 'select_grading'){ echo 'bg-secondary'; }else{ echo 'bg-info'; }}?>" <?php if(!isset($_GET['redir'])){ echo 'disabled'; }else{ if($_GET['redir'] == 'select_grading'){ echo 'disabled'; }}?> id="year" onchange="year()">
<option value="select_year">Select Year</option>

<?php
while($row_year = mysqli_fetch_assoc($year_qry)){
    $year = $row_year["year"]; 
    ?>   
    <option value='<?php echo $year; ?>' <?php if(isset($_GET['_y'])){ if($_GET['_y'] == $year){ echo "selected"; }}?>>
    <?php
    echo $year;
}
?>
</option>
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

&nbsp;
<?php
if(isset($_GET["redir"])){
  if($_GET["redir"] == "prelim"){
?>
<a href="pdf_files_prelim?redir=<?php echo $_GET["redir"]; ?>&_y=<?php echo $_GET["_y"]; ?>&_c=<?php echo $_GET["_c"]; ?>&_s_e_=<?php echo $_GET["_s_e_"]; ?>" target="_blank" class="btn btn-warning col-1">Print</a>
<?php
}else if($_GET["redir"] == "midterm"){
?>
<a href="pdf_files_midterm?redir=<?php echo $_GET["redir"]; ?>&_y=<?php echo $_GET["_y"]; ?>&_c=<?php echo $_GET["_c"]; ?>&_s_e_=<?php echo $_GET["_s_e_"]; ?>" target="_blank" class="btn btn-warning col-1">Print</a>
<?php
}else if($_GET["redir"] == "prefinal"){
?>
<a href="pdf_files_prefinal?redir=<?php echo $_GET["redir"]; ?>&_y=<?php echo $_GET["_y"]; ?>&_c=<?php echo $_GET["_c"]; ?>&_s_e_=<?php echo $_GET["_s_e_"]; ?>" target="_blank" class="btn btn-warning col-1">Print</a>
<?php
}else if($_GET["redir"] == "final"){
?>
<a href="pdf_files_final?redir=<?php echo $_GET["redir"]; ?>&_y=<?php echo $_GET["_y"]; ?>&_c=<?php echo $_GET["_c"]; ?>&_s_e_=<?php echo $_GET["_s_e_"]; ?>" target="_blank" class="btn btn-warning col-1">Print</a>
<?php
}
}
?>
</div>


<br>
<br>

<div>
<h6 class="ml-3 d-inline"><b>Course Name</b>: <?php if(isset($_GET['_s_e_'])){ if($_GET['_s_e_'] == "sem1"){ echo "IT 2 - Application Programming 1"; }else{ echo "IT 5 - Application Programming 2"; } } ?></h6>
<h6 class="ml-3 d-inline"><b>Year</b>: <?php if(isset($_GET['_y'])){ echo $_GET['_y']; } ?></h6>
<h6 class="ml-3 d-inline"><b>Semester</b>: <?php if(isset($_GET['_s_e_'])){ if($_GET['_s_e_'] == "sem1" ){ echo "First Semester"; }else{ echo "Second Semester"; } } ?></h6>
</div>

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

<center>
<?php
include("grading_system.php");
?>
</center>

<br>

<script>
function grade_period(){
  var grading = document.getElementById("grade_period");
  var selected_grading = grading.options[grading.selectedIndex].value;

  window.location.href = "?redir="+selected_grading;
  // alert("hay");
}

function year(){
  var grading = document.getElementById("grade_period");
  var selected_grading = grading.options[grading.selectedIndex].value;

  var year = document.getElementById("year");
  var selected_year = year.options[year.selectedIndex].value;

  window.location.href = "?redir="+selected_grading+"&_y="+selected_year;
  // alert("hay");
}

function course(){
  var grading = document.getElementById("grade_period");
  var selected_grading = grading.options[grading.selectedIndex].value;
  
  var year = document.getElementById("year");
  var selected_year = year.options[year.selectedIndex].value;

  var course = document.getElementById("course");
  var selected_course = course.options[course.selectedIndex].value;
  
  // var selected_semester = f.options[f.selectedIndex].value;

  window.location.href = "?redir="+selected_grading+"&_y="+selected_year+"&_c="+selected_course;
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
  var grading = document.getElementById("grade_period");
  var selected_grading = grading.options[grading.selectedIndex].value;
  
  var year = document.getElementById("year");
  var selected_year = year.options[year.selectedIndex].value;

  var course = document.getElementById("course");
  var selected_course = course.options[course.selectedIndex].value;

  // var subject = document.getElementById("subject");
  // var selected_subject = subject.options[subject.selectedIndex].value;

  var semester = document.getElementById("semester");
  var selected_semester = semester.options[semester.selectedIndex].value;

  window.location.href = "?redir="+selected_grading+"&_y="+selected_year+"&_c="+selected_course+/* "&_s="+selected_subject+ */"&_s_e_="+selected_semester;
  // alert("hay");
}
</script>

<?php
include("../../bins/footer_non_fixed.php");
?>