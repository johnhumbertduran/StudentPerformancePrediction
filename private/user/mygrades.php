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
$course = $my_info["course"];
$year = $my_info["year"];

$lastname = $my_info['lastname'];
// $firstname = $my_info['firstname'];
$middlename = $my_info['middlename'];
$student_name = $firstname . " " . $middlename[0] . ". " . $lastname;


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

#prefinal_grade_prediction{
  display:none;
  border:none;
  background-color: transparent;
}

#final_grade_prediction{
  display:none;
  border:none;
  background-color: transparent;
}

.table-hover tbody tr:hover {
    /* background: #4ef0a2; */
    cursor:pointer;
}

/* .table-hover tbody tr:hover td {
    background: #4ef0a2;
    cursor:pointer;
} */
.table-hover tbody h6 { color: #007bff; }
.table-hover tbody .passed { color: #28a745; }
.table-hover tbody .failed { color: #dc3545; }

td:hover { background-color: #f75271; color: #fff; }
td:hover a { color: #fff; }
td:hover h6 { color: #fff; }
td:hover .remarks { color: #fff; }

</style>


<center>
<h1 class="py-3 text-info px-1">View Grades</h1>
<!-- <h1 class="py-3 text-info px-1">Welcome <?php echo $firstname; ?>!</h1> -->
</center>


<?php

include('../bins/student_nav.php');

$predict = "<sup class='badge badge-warning'>Predict</sup>";


?>


<select class="form-control col-2 ml-2 pt-1 pb-2 d-inline bg-info text-white mt-3" id="semester" onchange="semester()">
  <!-- <option value="select_semester">Select Semester</option> -->
  <option value="1" <?php if(isset($_GET['s_'])){ if($_GET['s_'] == "1"){ echo "selected"; }}?>>1st Semester</option>
  <option value="2" <?php if(isset($_GET['s_'])){ if($_GET['s_'] == "2"){ echo "selected"; }}?>>2nd Semester</option>
</select>
&nbsp;
<?php
 if(isset($_GET['s_'])){
?>
  <a href="pdf_files_user?s_=<?php echo $_GET["s_"]; ?>&_c=<?php echo $course; ?>&_y=<?php echo $year; ?>&_sn=<?php echo $student_no; ?>&_n=<?php echo $student_name; ?>" target="_blank" class="btn btn-warning col-1">Print</a>
<?php
}else{
?>
  <a href="pdf_files_user?s_=<?php echo "1"; ?>&_c=<?php echo $course; ?>&_y=<?php echo $year; ?>&_sn=<?php echo $student_no; ?>&_n=<?php echo $student_name; ?>" target="_blank" class="btn btn-warning col-1">Print</a>
<?php
}
?>

<div>
<h6 class="ml-3 d-inline"><b>Course Name</b>: <?php echo $course;  ?></h6>
<h6 class="ml-3 d-inline"><b>Year</b>: <?php echo $year; ?></h6>
<h6 class="ml-3 d-inline"><b>Semester</b>: <?php if(isset($_GET['s_'])){ if($_GET['s_'] == "1" ){ echo "First Semester"; }else{ echo "Second Semester"; } }else{ echo "First Semester"; } ?></h6>
</div>

<?php


if(isset($_GET["s_"])){
  $semester_no = $_GET["s_"];

  if($semester_no == "2"){
    $semester_no = "2";
  }else if($semester_no == "select_semester"){
    $semester_no = "1";
  }
}else{
  $semester_no = "1";
}

// if($semester_no = "select_semester"){
//   $semester_no = "1";
// }



// $final_prediction_qry = mysqli_query($connections, "SELECT * FROM $final_prediction_table_semester WHERE student_no='$student_no' ");
// $row_final_prediction = mysqli_fetch_assoc($final_prediction_qry);

$student_qry = mysqli_query($connections, "SELECT * FROM _user_tbl_ WHERE student_no='$student_no' ");
$row_student = mysqli_fetch_assoc($student_qry);
$lastname = $row_student['lastname'];
$firstname = $row_student['firstname'];
$middlename = $row_student['middlename'];
$student_name = $firstname . " " . $middlename[0] . ". " . $lastname;


  // ######################## Check Grades #################


$final_qry1 = mysqli_query($connections, "SELECT * FROM final1 WHERE student_no='$student_no' ");
$prefinal_qry1 = mysqli_query($connections, "SELECT * FROM prefinal1 WHERE student_no='$student_no' ");
$midterm_qry1 = mysqli_query($connections, "SELECT * FROM midterm1 WHERE student_no='$student_no' ");
$prelim_qry1 = mysqli_query($connections, "SELECT * FROM prelim1 WHERE student_no='$student_no' ");



  $row1_student = mysqli_fetch_assoc($final_qry1);
  $row1_prefinal = mysqli_fetch_assoc($prefinal_qry1);
  $row1_midterm = mysqli_fetch_assoc($midterm_qry1);
  $row1_prelim = mysqli_fetch_assoc($prelim_qry1);
  
  
  $final1_output_1 = $row1_student["final_output_1"];
  $final1_output_2 = $row1_student["final_output_2"];
  $final1_output_total_score = $row1_student["final_output_total_score"];
  $final1_output_base = $row1_student["final_output_base"];
  $final1_output_weight = $row1_student["final_output_weight"];
  $final1_performance_1 = $row1_student["final_performance_1"];
  $final1_performance_2 = $row1_student["final_performance_2"];
  $final1_performance_total_score = $row1_student["final_performance_total_score"];
  $final1_performance_base = $row1_student["final_performance_base"];
  $final1_performance_weight = $row1_student["final_performance_weight"];
  $final1_written_test = $row1_student["final_written_test"];
  $final1_written_test_base = $row1_student["final_written_test_base"];
  $final1_written_test_weight = $row1_student["final_written_test_weight"];
  $final1_grade = $row1_student["final_grade"];
  $final1_grade_equivalent = $row1_student["final_grade_equivalent"];
  
  
  
  
  $prelim1_output_1 = $row1_prelim['prelim_output_1'];
  $prelim1_output_2 = $row1_prelim['prelim_output_2'];
  $prelim1_performance_1 = $row1_prelim['prelim_performance_1'];
  $prelim1_performance_2 = $row1_prelim['prelim_performance_2'];
  $prelim1_written_test = $row1_prelim['prelim_written_test'];
  
  $prelim1_output_total_score = $prelim1_output_1 + $prelim1_output_2;
  $prelim1_performance_total_score = $prelim1_performance_1 + $prelim1_performance_2;
  
  $prelim1_output_base = $prelim1_output_total_score / 40 * 40 + 60;
  $prelim1_performance_base = $prelim1_performance_total_score / 40 * 40 + 60;
  $prelim1_written_test_base =  $prelim1_written_test / 70 * 40 + 60;
  
  $prelim1_output_weight = $prelim1_output_base * 0.40;
  $prelim1_performance_weight = $prelim1_performance_base * 0.40;
  $prelim1_written_test_weight = $prelim1_written_test_base * 0.20;
  
  $prelim1_grade = $prelim1_output_weight + $prelim1_performance_weight + $prelim1_written_test_weight;
  
  
  
  $midterm1_output_1 = $row1_midterm["midterm_output_1"];
  $midterm1_output_2 = $row1_midterm["midterm_output_2"];
  $midterm1_performance_1 = $row1_midterm["midterm_performance_1"];
  $midterm1_performance_2 = $row1_midterm["midterm_performance_2"];
  $midterm1_written_test = $row1_midterm["midterm_written_test"];
  
  $midterm1_output_total_score = $midterm1_output_1 + $midterm1_output_2;
  $midterm1_output_base = $midterm1_output_total_score / 40 * 40 + 60;
  
  
  $midterm1_performance_total_score = $midterm1_performance_1 + $midterm1_performance_2;
  $midterm1_performance_base = $midterm1_performance_total_score / 40 * 40 + 60;
  $midterm1_written_test_base = $midterm1_written_test / 70 * 40 + 60;
  
  $midterm1_output_weight = $midterm1_output_base * 0.40;
  $midterm1_performance_weight = $midterm1_performance_base * 0.40;
  $midterm1_written_test_weight = $midterm1_written_test_base * 0.20;
  $midterm1_2nd_quarter = $midterm1_output_weight + $midterm1_performance_weight + $midterm1_written_test_weight;
  
  
  $midterm1_grade = $prelim1_grade * 0.3 + $midterm1_2nd_quarter * 0.7;
  
  
  $prefinal1_output_1 = $row1_prefinal["prefinal_output_1"]; //ok
  $prefinal1_output_2 = $row1_prefinal["prefinal_output_2"]; //ok
  $prefinal1_performance_1 = $row1_prefinal["prefinal_performance_1"]; //ok
  $prefinal1_performance_2 = $row1_prefinal["prefinal_performance_2"]; //ok
  $prefinal1_written_test = $row1_prefinal["prefinal_written_test"]; //ok
  // $prefinal_grade_equivalent = $row_prefinal["prefinal_grade_equivalent"];
  
  $prefinal1_output_total_score = $prefinal1_output_1 + $prefinal1_output_2; //ok
  $prefinal1_performance_total_score = $prefinal1_performance_1 + $prefinal1_performance_2; //ok
  
  $prefinal1_output_base = $prefinal1_output_total_score / 40 * 40 + 60; //ok
  $prefinal1_performance_base = $prefinal1_performance_total_score / 40 * 40 + 60; //ok
  $prefinal1_written_test_base = $prefinal1_written_test / 70 * 40 + 60; //ok
  
  $prefinal1_output_weight = $prefinal1_output_base * 0.40; //ok
  $prefinal1_performance_weight = $prefinal1_performance_base * 0.40; //ok
  $prefinal1_written_test_weight = $prefinal1_written_test_base * 0.20; //ok
  
  $prefinal1_3rd_quarter = $prefinal1_output_weight + $prefinal1_performance_weight + $prefinal1_written_test_weight; //ok
  $prefinal1_grade = $midterm1_grade * 0.3 + $prefinal1_3rd_quarter * 0.7;
  
  
  $check_prelim1_grade = $prelim1_output_1 + $prelim1_output_2 + $prelim1_performance_1 + $prelim1_performance_2 + $prelim1_written_test;
  $check_midterm1_grade = $midterm1_output_1 + $midterm1_output_2 + $midterm1_performance_1 + $midterm1_performance_2 + $midterm1_written_test;
  $check_prefinal1_grade = $prefinal1_output_1 + $prefinal1_output_2 + $prefinal1_performance_1 + $prefinal1_performance_2 + $prefinal1_written_test;
  
  
      // ####################______Final Formulas______####################
      // $final_formative_assessment_total_score =
      // $final_formative_assessment_1 + $final_formative_assessment_2 +
      // $final_formative_assessment_3 + $final_formative_assessment_4 +
      // $final_formative_assessment_5 + $final_formative_assessment_6 +
      // $final_formative_assessment_7 + $final_formative_assessment_8 +
      // $final_formative_assessment_9 + $final_formative_assessment_10;
  
      // $final_formative_assessment_base = $final_formative_assessment_total_score / 100 * 40 + 60;
      $final1_output_total_score = $final1_output_1 + $final1_output_2;
      $final1_output_base = $final1_output_total_score / 40 * 40 + 60;
      $final1_output_weight = $final1_output_base * 0.40;
      $final1_performance_total_score = $final1_performance_1 + $final1_performance_2;
      $final1_performance_base = $final1_performance_total_score / 40 * 40 + 60;
      $final1_performance_weight = $final1_performance_base * 0.40;
      $final1_written_test_base = $final1_written_test / 70 * 40 + 60;
      $final1_written_test_weight = $final1_written_test_base * 0.20;
      $final1_4th_quarter = $final1_output_weight + $final1_performance_weight + $final1_written_test_weight;
      $final1_grade = $prefinal1_grade * 0.3 + $final1_4th_quarter * 0.7;
  
  
      // ################### End of Check Grades ################
  

      

if($semester_no == "2"){
  if($final1_grade > 74){
    
    ?>
<!-- <div class="black p-5 fixed-top"> -->
<input type="hidden" id="get_student_no" value="<?php echo $student_no; ?>">

<input type="hidden" id="get_semester" value="<?php if(isset($_GET["s_"])){ echo $_GET["s_"]; }else{ echo "1"; } ?>">

<div class="table-responsive table_table mt-3 col-10 container-fluid">
<table border="1" class="table table-hover">
    <thead>
    <tr><th class="px-3 text-center bg-info text-white" colspan="9">My Grade</th></tr><!-- Preliminary Here -->

    <tr class="text-center"><th class="px-3 bg-white">Student Name</th><th class="px-3 bg-success text-white">Prelim</th><th class="px-3 bg-primary text-white">Midterm</th><th class="px-3 bg-danger text-white" id="prefinal_student_predict">Prefinal</th><th class="px-3 bg-warning text-white" id="final_student_predict">Final</th><th class="px-3 bg-secondary text-white" id="average">Average</th><th class="px-3 bg-secondary text-white" id="average">Equivalent</th><th class="px-3 bg-secondary text-white" id="remarks">Remarks</th><th class="px-3 bg-dark text-white" id="prediction">Prediction<sup class='badge badge-warning'>Prediction</sup></th></tr>

    </thead>

    <tbody>

<?php

  

  $prelim = "prelim$semester_no";
  $midterm = "midterm$semester_no";
  $prefinal = "prefinal$semester_no";
  $final = "final$semester_no";
  $prelim_qry = mysqli_query($connections, "SELECT * FROM $prelim WHERE student_no='$student_no' ");
  $midterm_qry = mysqli_query($connections, "SELECT * FROM $midterm WHERE student_no='$student_no' ");
  $prefinal_qry = mysqli_query($connections, "SELECT * FROM $prefinal WHERE student_no='$student_no' ");
  $final_qry = mysqli_query($connections, "SELECT * FROM $final WHERE student_no='$student_no' ");

// $prefinal_prediction_qry = mysqli_query($connections, "SELECT * FROM $prefinal WHERE student_no='$student_no' ");


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
$prelim_written_test_base =  $prelim_written_test / 70 * 40 + 60;

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
$midterm_written_test_base = $midterm_written_test / 70 * 40 + 60;
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

$prefinal_prediction = $row_prefinal["prefinal_prediction"];


// old line of condition
// if($prefinal_output_1 == 0 && $prefinal_output_2 == 0 &&
//    $prefinal_performance_1 == 0 && $prefinal_performance_1 == 0 &&
//    $prefinal_written_test == 0){
  
//     if($prefinal_prediction>0){
//     $prefinal_prediction = $row_prefinal["prefinal_prediction"];
//     $confirm_prefinal_prediction = $prefinal_prediction;
//     }else{
//       $prefinal_grade = 0;
//       $prefinal_prediction = 0;
//     }


// new line of condition
if($prefinal_output_1 <= 0 && $prefinal_output_2 <= 0 &&
   $prefinal_performance_1 <= 0 && $prefinal_performance_2 <= 0 &&
   $prefinal_written_test <= 0){
  
    if($prefinal_prediction>0){
    $prefinal_prediction = $row_prefinal["prefinal_prediction"];
    $confirm_prefinal_prediction = $prefinal_prediction;
    $prefinal_grade = 0;
  }else{
      $prefinal_grade = 0;
      $prefinal_prediction = 0;
    }

}else{

$prefinal_output_total_score = $prefinal_output_1 + $prefinal_output_2; //ok
$prefinal_performance_total_score = $prefinal_performance_1 + $prefinal_performance_2; //ok

$prefinal_output_base = $prefinal_output_total_score / 40 * 40 + 60; //ok
$prefinal_performance_base = $prefinal_performance_total_score / 40 * 40 + 60; //ok
$prefinal_written_test_base = $prefinal_written_test / 70 * 40 + 60; //ok

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

$final_prediction = $row_final["final_prediction"];

    // old line of condition

// if($final_output_1 == 0 && $final_output_2 == 0 &&
//    $final_performance_1 == 0 && $final_performance_2 == 0 &&
//    $final_written_test == 0){
  
    // $final_grade = 0;

    // if($final_prediction>0){
    //   $final_prediction = $row_final["final_prediction"];
    //   $confirm_final_prediction = $final_prediction;
    //   }else{
    //     $final_grade = 0;
    //     $final_prediction = 0;
    //   }


    // new line of condition
if($final_output_1 <= 0 && $final_output_2 <= 0 &&
   $final_performance_1 <= 0 && $final_performance_2 <= 0 &&
   $final_written_test <= 0){
  
      if($final_prediction>0){
      $final_prediction = $row_final["final_prediction"];
      $confirm_final_prediction = $final_prediction;
      $final_grade = 0;
    }else{
      $final_grade = 0;
        $final_prediction = 0;
      }

}else{

$final_output_total_score = $final_output_1 + $final_output_2;
$final_output_base = $final_output_total_score / 40 * 40 + 60;
$final_output_weight = $final_output_base * 0.40;
$final_performance_total_score = $final_performance_1 + $final_performance_2;
$final_performance_base = $final_performance_total_score / 40 * 40 + 60;
$final_performance_weight = $final_performance_base * 0.40;
$final_written_test_base = $final_written_test / 70 * 40 + 60;
$final_written_test_weight = $final_written_test_base * 0.20;
$final_4th_quarter = $final_output_weight + $final_performance_weight + $final_written_test_weight;
$final_grade = $prefinal_grade * 0.3 + $final_4th_quarter * 0.7;

$final_grade = number_format((float)$final_grade,2,".","");

}
  



$average_prediction = 0;

$average = "";

$prelim_status = 0;
$prelim_status_missed = "";

$midterm_status = 0;
$midterm_status_missed = "";

$prefinal_status = 0;
$prefinal_status_missed = "";

$final_status = 0;
$final_status_missed = "";

if ($prelim_output_1 == 0){
  $prelim_status++;
  $prelim_status_missed .= "Prelim Output 1 </br>";
}

if ($prelim_output_2 == 0){
  $prelim_status++;
  $prelim_status_missed .= "Prelim Output 2 </br>";
}

if ($prelim_performance_1 == 0){
  $prelim_status++;
  $prelim_status_missed .= "Prelim Performance 1 </br>";
}

if ($prelim_performance_2 == 0){
  $prelim_status++;
  $prelim_status_missed .= "Prelim Performance 2 </br>";
}

if ($prelim_written_test == 0){
  $prelim_status++;
  $prelim_status_missed .= "Prelim Written Test </br>";
}



if ($midterm_output_1 == 0){
  $midterm_status+=1;
  $midterm_status_missed .= "Midterm Output 1 </br>";
}

if ($midterm_output_2 == 0){
  $midterm_status+=1;
  $midterm_status_missed .= "Midterm Output 2 </br>";
}

if ($midterm_performance_1 == 0){
  $midterm_status+=1;
  $midterm_status_missed .= "Midterm Performance 1 </br>";
}

if ($midterm_performance_2 == 0){
  $midterm_status+=1;
  $midterm_status_missed .= "Midterm Performance 2 </br>";
}

if ($midterm_written_test == 0){
  $midterm_status+=1;
  $midterm_status_missed .= "Midterm Written Test </br>";
}


if ($prefinal_output_1 == 0){
  $prefinal_status+=1;
  $prefinal_status_missed .= "Prefinal Output 1 </br>";
}

if ($prefinal_output_2 == 0){
  $prefinal_status+=1;
  $prefinal_status_missed .= "Prefinal Output 2 </br>";
}

if ($prefinal_performance_1 == 0){
  $prefinal_status+=1;
  $prefinal_status_missed .= "Prefinal Performance 1 </br>";
}

if ($prefinal_performance_2 == 0){
  $prefinal_status+=1;
  $prefinal_status_missed .= "Prefinal Performance 2 </br>";
}

if ($prefinal_written_test == 0){
  $prefinal_status+=1;
  $prefinal_status_missed .= "Prefinal Written Test </br>";
}


if ($final_output_1 == 0){
  $final_status+=1;
  $final_status_missed .= "final Output 1 </br>";
}

if ($final_output_2 == 0){
  $final_status+=1;
  $final_status_missed .= "final Output 2 </br>";
}

if ($final_performance_1 == 0){
  $final_status+=1;
  $final_status_missed .= "final Performance 1 </br>";
}

if ($final_performance_2 == 0){
  $final_status+=1;
  $final_status_missed .= "final Performance 2 </br>";
}

if ($final_written_test == 0){
  $final_status+=1;
  $final_status_missed .= "final Written Test </br>";
}

?>

<tr class="text-center">
<td><?php echo $student_name; ?></td>


<td id="get_prelim">
<?php
if($prelim_grade>0){
  if($prelim_status > 0){
    echo $prelim_grade." <sup class='grade_status bg-warning rounded-circle px-1' data-toggle='modal' data-target='#prelim$student_no'><b>$prelim_status</b><sup>";
  }else{
    echo $prelim_grade;
  }
}else{
  echo $prelim_grade;
}
?>
</td>


<td id="get_midterm">
<?php
if($midterm_grade>0){
  if($midterm_status > 0){
    echo $midterm_grade." <sup class='grade_status bg-warning rounded-circle px-1' data-toggle='modal' data-target='#midterm$student_no'><b>$midterm_status</b><sup>";
  }else{
    echo $midterm_grade;
  }
}else{
  echo $midterm_grade;
}
?>
</td>


<td><span id="get_prefinal">
<?php
if($prefinal_grade>0){
  if($prefinal_status > 0){
    echo $prefinal_grade." <sup class='grade_status bg-warning rounded-circle px-1' data-toggle='modal' data-target='#prefinal$student_no'><b>$prefinal_status</b><sup>";
  }else{
    echo $prefinal_grade;
  }
}else{
  if($prefinal_prediction>0){
    echo "<h6>".$prefinal_prediction."</h6>";
  }
}
?>
</span><input type="text" id="prefinal_grade_prediction" class="text-center col-5 container-fluid" disabled>
<?php
?>
</td>


<td><span id="get_final">
<?php
if($final_grade>0){
  if($final_status > 0){
    echo $final_grade." <sup class='grade_status bg-warning rounded-circle px-1' data-toggle='modal' data-target='#final$student_no'><b>$final_status</b><sup>";
  }else{
    echo $final_grade;
  }
}else{
  if($final_prediction>0){
    echo "<h6>".$final_prediction."</h6>";
  }
}
?>
</span><input type="text" id="final_grade_prediction" class="text-center col-5 container-fluid" disabled>
<?php
?>
</td>


<td>
<?php

if($final_grade>0){
  $average = $final_grade;

    echo $final_grade;
  // }
}else{
  if($final_prediction>0){
    $average = $final_prediction;
    echo "<h6>".$final_prediction."</h6>";
  }
}
?>
</td>
<td>
<?php

switch (true) {

    case ($average >= 74.5 && $average <= 76.49):
        $equivalent = "3";
        break;
    case ($average >= 76.5 && $average <= 79.49):
        $equivalent = "2.75";
        break;
    case ($average >= 79.5 && $average <= 82.49):
        $equivalent = "2.5";
        break;
    case ($average >= 82.5 && $average <= 85.49):
        $equivalent = "2.25";
        break;
    case ($average >= 85.5 && $average <= 88.49):
        $equivalent = "2";
        break;
    case ($average >= 88.5 && $average <= 91.49):
        $equivalent = "1.75";
        break;
    case ($average >= 91.5 && $average <= 94.49):
        $equivalent = "1.5";
        break;
    case ($average >= 94.5 && $average <= 97.49):
        $equivalent = "1.25";
        break;
    case ($average >= 97.5 && $average <= 100):
        $equivalent = "1";
        break;

    default:
        $equivalent = "---";
}

if($average > 0 && $average <= 74.4){
  $equivalent = "5";
}


 if(($prelim_grade>0) && ($midterm_grade>0) && ($prefinal_grade > 0) && ($final_grade>0)){
  echo $equivalent; 
 }else{
  if(($prelim_grade>0) && ($midterm_grade>0) && ($prefinal_prediction > 0) && ($final_prediction>0)){
    echo "<h6>".$equivalent."</h6>"; 
    }elseif(($prelim_grade>0) && ($midterm_grade>0) && ($prefinal_grade > 0) && ($final_prediction>0)){
     // $average = ($prelim_grade + $midterm_grade + $prefinal_grade + $final_prediction) / 4;
     echo "<h6>".$equivalent."</h6>";
    }
 }
 ?>
</td>

<td>
<?php
if($equivalent > 0 && $equivalent <= 3){
  $remarks = "Passed";
  echo "<h6 class='passed remarks'>".$remarks."</h6>";
}elseif($equivalent == 5){
  $remarks = "Failed";
  echo "<h6 class='failed remarks'>".$remarks."</h6>";
}else{
  $remarks = "---";
  echo $remarks;
}
 ?>
</td>


<td id="select_prediction">
<select class="form-control pt-1 pb-2 bg-dark text-white" id="average_predict" onchange="average()">
  <option value="select_grade_prediction">Select Value</option>
  <option value="75" id="75" <?php if(isset($_GET['ave'])){ if($_GET['ave'] == "75"){ echo 'selected'; }}?>>75</option>
  <option value="76" id="76" <?php if(isset($_GET['ave'])){ if($_GET['ave'] == "76"){ echo 'selected'; }}?>>76</option>
  <option value="77" id="77" <?php if(isset($_GET['ave'])){ if($_GET['ave'] == "77"){ echo 'selected'; }}?>>77</option>
  <option value="78" id="78" <?php if(isset($_GET['ave'])){ if($_GET['ave'] == "78"){ echo 'selected'; }}?>>78</option>
  <option value="79" id="79" <?php if(isset($_GET['ave'])){ if($_GET['ave'] == "79"){ echo 'selected'; }}?>>79</option>
  <option value="80" id="80" <?php if(isset($_GET['ave'])){ if($_GET['ave'] == "80"){ echo 'selected'; }}?>>80</option>
  <option value="81" id="81" <?php if(isset($_GET['ave'])){ if($_GET['ave'] == "81"){ echo 'selected'; }}?>>81</option>
  <option value="82" id="82" <?php if(isset($_GET['ave'])){ if($_GET['ave'] == "82"){ echo 'selected'; }}?>>82</option>
  <option value="83" id="83" <?php if(isset($_GET['ave'])){ if($_GET['ave'] == "83"){ echo 'selected'; }}?>>83</option>
  <option value="84" id="84" <?php if(isset($_GET['ave'])){ if($_GET['ave'] == "84"){ echo 'selected'; }}?>>84</option>
  <option value="85" id="85" <?php if(isset($_GET['ave'])){ if($_GET['ave'] == "85"){ echo 'selected'; }}?>>85</option>
  <option value="86" id="86" <?php if(isset($_GET['ave'])){ if($_GET['ave'] == "86"){ echo 'selected'; }}?>>86</option>
  <option value="87" id="87" <?php if(isset($_GET['ave'])){ if($_GET['ave'] == "87"){ echo 'selected'; }}?>>87</option>
  <option value="88" id="88" <?php if(isset($_GET['ave'])){ if($_GET['ave'] == "88"){ echo 'selected'; }}?>>88</option>
  <option value="89" id="89" <?php if(isset($_GET['ave'])){ if($_GET['ave'] == "89"){ echo 'selected'; }}?>>89</option>
  <option value="90" id="90" <?php if(isset($_GET['ave'])){ if($_GET['ave'] == "90"){ echo 'selected'; }}?>>90</option>
  <option value="91" id="91" <?php if(isset($_GET['ave'])){ if($_GET['ave'] == "91"){ echo 'selected'; }}?>>91</option>
  <option value="92" id="92" <?php if(isset($_GET['ave'])){ if($_GET['ave'] == "92"){ echo 'selected'; }}?>>92</option>
  <option value="93" id="93" <?php if(isset($_GET['ave'])){ if($_GET['ave'] == "93"){ echo 'selected'; }}?>>93</option>
  <option value="94" id="94" <?php if(isset($_GET['ave'])){ if($_GET['ave'] == "94"){ echo 'selected'; }}?>>94</option>
  <option value="95" id="95" <?php if(isset($_GET['ave'])){ if($_GET['ave'] == "95"){ echo 'selected'; }}?>>95</option>
  <option value="96" id="96" <?php if(isset($_GET['ave'])){ if($_GET['ave'] == "96"){ echo 'selected'; }}?>>96</option>
  <option value="97" id="97" <?php if(isset($_GET['ave'])){ if($_GET['ave'] == "97"){ echo 'selected'; }}?>>97</option>
  <option value="98" id="98" <?php if(isset($_GET['ave'])){ if($_GET['ave'] == "98"){ echo 'selected'; }}?>>98</option>
  <option value="99" id="99" <?php if(isset($_GET['ave'])){ if($_GET['ave'] == "99"){ echo 'selected'; }}?>>99</option>
  <option value="100" id="100" <?php if(isset($_GET['ave'])){ if($_GET['ave'] == "100"){ echo 'selected'; }}?>>100</option>


</select>
</td>
</tr>
<!-- <tr class="text-center"> -->
<!-- <td></td> -->
<!-- <td></td> -->
<td id="confirm_prefinal_prediction" class="bg-white d-none"><?php if($prefinal_prediction>0){echo $confirm_prefinal_prediction; }else{ echo $confirm_prefinal_prediction; } ?></td>
<td id="confirm_final_prediction" class="bg-white d-none"><?php if($final_prediction>0){echo $confirm_final_prediction; }else{ echo $confirm_final_prediction; } ?></td>
<!-- <td id="average_prediction"><?php echo $average_prediction; ?></td> -->
<!-- </tr> -->


<!-- The Prelim Modal -->
<div class="modal" id="<?php echo "prelim".$student_no; ?>">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header bg-success text-white">
        <h4 class="modal-title"><?php echo $student_name; ?></h4>
        <button type="button" class="close text-danger" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        <h3 class="text-danger">Defeciencies:</h3>
        <?php echo $prelim_status_missed; ?>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer bg-success">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>



<!-- The Midterm Modal -->
<div class="modal" id="<?php echo "midterm".$student_no; ?>">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header bg-primary text-white">
        <h4 class="modal-title"><?php echo $student_name; ?></h4>
        <button type="button" class="close text-danger" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        <h3 class="text-danger">Defeciencies:</h3>
        <?php echo $midterm_status_missed; ?>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer bg-primary">
        <button type="button" class="btn btn-warning text-white" data-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>


<!-- The Prefinal Modal -->
<div class="modal" id="<?php echo "prefinal".$student_no; ?>">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header bg-danger text-white">
        <h4 class="modal-title"><?php echo $student_name; ?></h4>
        <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        <h3 class="text-danger">Defeciencies:</h3>
        <?php echo $prefinal_status_missed; ?>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer bg-danger">
        <button type="button" class="btn btn-light" data-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>


<!-- The final Modal -->
<div class="modal" id="<?php echo "final".$student_no; ?>">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header bg-warning">
        <h4 class="modal-title text-white"><?php echo $student_name; ?></h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        <h3 class="text-danger">Defeciencies:</h3>
        <?php echo $final_status_missed; ?>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer bg-warning">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>


<?php
// }
}
?>

</table>
</div>

<input type="hidden" id="prefinal_grade" value="<?php echo $prefinal_grade; ?>">
<input type="hidden" id="final_grade" value="<?php echo $final_grade; ?>">


<?php


  }else{
    ?>
      <br>
      <br>
      <br>
      <h3 class="text-center text-danger">Pre-requisite</h3>
      <br>
      <br>
      <br>
      <br>
      <br>
<?php
  }
}else{

?>
<!-- <div class="black p-5 fixed-top"> -->
<input type="hidden" id="get_student_no" value="<?php echo $student_no; ?>">

<input type="hidden" id="get_semester" value="<?php if(isset($_GET["s_"])){ echo $_GET["s_"]; }else{ echo "1"; } ?>">

<div class="table-responsive table_table mt-3 col-10 container-fluid">
<table border="1" class="table table-hover">
    <thead>
    <tr><th class="px-3 text-center bg-info text-white" colspan="9">My Grade</th></tr><!-- Preliminary Here -->

    <tr class="text-center"><th class="px-3 bg-white">Student Name</th><th class="px-3 bg-success text-white">Prelim</th><th class="px-3 bg-primary text-white">Midterm</th><th class="px-3 bg-danger text-white" id="prefinal_student_predict">Prefinal</th><th class="px-3 bg-warning text-white" id="final_student_predict">Final</th><th class="px-3 bg-secondary text-white" id="average">Average</th><th class="px-3 bg-secondary text-white" id="average">Equivalent</th><th class="px-3 bg-secondary text-white" id="remarks">Remarks</th><th class="px-3 bg-dark text-white" id="prediction">Prediction<sup class='badge badge-warning'>Prediction</sup></th></tr>

    </thead>

    <tbody>

<?php

  

  $prelim = "prelim$semester_no";
  $midterm = "midterm$semester_no";
  $prefinal = "prefinal$semester_no";
  $final = "final$semester_no";
  $prelim_qry = mysqli_query($connections, "SELECT * FROM $prelim WHERE student_no='$student_no' ");
  $midterm_qry = mysqli_query($connections, "SELECT * FROM $midterm WHERE student_no='$student_no' ");
  $prefinal_qry = mysqli_query($connections, "SELECT * FROM $prefinal WHERE student_no='$student_no' ");
  $final_qry = mysqli_query($connections, "SELECT * FROM $final WHERE student_no='$student_no' ");

// $prefinal_prediction_qry = mysqli_query($connections, "SELECT * FROM $prefinal WHERE student_no='$student_no' ");


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
$prelim_written_test_base =  $prelim_written_test / 70 * 40 + 60;

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
$midterm_written_test_base = $midterm_written_test / 70 * 40 + 60;
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

$prefinal_prediction = $row_prefinal["prefinal_prediction"];


// old line of condition
// if($prefinal_output_1 == 0 && $prefinal_output_2 == 0 &&
//    $prefinal_performance_1 == 0 && $prefinal_performance_1 == 0 &&
//    $prefinal_written_test == 0){
  
//     if($prefinal_prediction>0){
//     $prefinal_prediction = $row_prefinal["prefinal_prediction"];
//     $confirm_prefinal_prediction = $prefinal_prediction;
//     }else{
//       $prefinal_grade = 0;
//       $prefinal_prediction = 0;
//     }


// new line of condition
if($prefinal_output_1 <= 0 && $prefinal_output_2 <= 0 &&
   $prefinal_performance_1 <= 0 && $prefinal_performance_2 <= 0 &&
   $prefinal_written_test <= 0){
  
    if($prefinal_prediction>0){
    $prefinal_prediction = $row_prefinal["prefinal_prediction"];
    $confirm_prefinal_prediction = $prefinal_prediction;
    $prefinal_grade = 0;
  }else{
      $prefinal_grade = 0;
      $prefinal_prediction = 0;
    }

}else{

$prefinal_output_total_score = $prefinal_output_1 + $prefinal_output_2; //ok
$prefinal_performance_total_score = $prefinal_performance_1 + $prefinal_performance_2; //ok

$prefinal_output_base = $prefinal_output_total_score / 40 * 40 + 60; //ok
$prefinal_performance_base = $prefinal_performance_total_score / 40 * 40 + 60; //ok
$prefinal_written_test_base = $prefinal_written_test / 70 * 40 + 60; //ok

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

$final_prediction = $row_final["final_prediction"];

    // old line of condition

// if($final_output_1 == 0 && $final_output_2 == 0 &&
//    $final_performance_1 == 0 && $final_performance_2 == 0 &&
//    $final_written_test == 0){
  
    // $final_grade = 0;

    // if($final_prediction>0){
    //   $final_prediction = $row_final["final_prediction"];
    //   $confirm_final_prediction = $final_prediction;
    //   }else{
    //     $final_grade = 0;
    //     $final_prediction = 0;
    //   }


    // new line of condition
if($final_output_1 <= 0 && $final_output_2 <= 0 &&
   $final_performance_1 <= 0 && $final_performance_2 <= 0 &&
   $final_written_test <= 0){
  
      if($final_prediction>0){
      $final_prediction = $row_final["final_prediction"];
      $confirm_final_prediction = $final_prediction;
      $final_grade = 0;
    }else{
      $final_grade = 0;
        $final_prediction = 0;
      }

}else{

$final_output_total_score = $final_output_1 + $final_output_2;
$final_output_base = $final_output_total_score / 40 * 40 + 60;
$final_output_weight = $final_output_base * 0.40;
$final_performance_total_score = $final_performance_1 + $final_performance_2;
$final_performance_base = $final_performance_total_score / 40 * 40 + 60;
$final_performance_weight = $final_performance_base * 0.40;
$final_written_test_base = $final_written_test / 70 * 40 + 60;
$final_written_test_weight = $final_written_test_base * 0.20;
$final_4th_quarter = $final_output_weight + $final_performance_weight + $final_written_test_weight;
$final_grade = $prefinal_grade * 0.3 + $final_4th_quarter * 0.7;

$final_grade = number_format((float)$final_grade,2,".","");

}
  



$average_prediction = 0;

$average = "";

$prelim_status = 0;
$prelim_status_missed = "";

$midterm_status = 0;
$midterm_status_missed = "";

$prefinal_status = 0;
$prefinal_status_missed = "";

$final_status = 0;
$final_status_missed = "";

if ($prelim_output_1 == 0){
  $prelim_status++;
  $prelim_status_missed .= "Prelim Output 1 </br>";
}

if ($prelim_output_2 == 0){
  $prelim_status++;
  $prelim_status_missed .= "Prelim Output 2 </br>";
}

if ($prelim_performance_1 == 0){
  $prelim_status++;
  $prelim_status_missed .= "Prelim Performance 1 </br>";
}

if ($prelim_performance_2 == 0){
  $prelim_status++;
  $prelim_status_missed .= "Prelim Performance 2 </br>";
}

if ($prelim_written_test == 0){
  $prelim_status++;
  $prelim_status_missed .= "Prelim Written Test </br>";
}



if ($midterm_output_1 == 0){
  $midterm_status+=1;
  $midterm_status_missed .= "Midterm Output 1 </br>";
}

if ($midterm_output_2 == 0){
  $midterm_status+=1;
  $midterm_status_missed .= "Midterm Output 2 </br>";
}

if ($midterm_performance_1 == 0){
  $midterm_status+=1;
  $midterm_status_missed .= "Midterm Performance 1 </br>";
}

if ($midterm_performance_2 == 0){
  $midterm_status+=1;
  $midterm_status_missed .= "Midterm Performance 2 </br>";
}

if ($midterm_written_test == 0){
  $midterm_status+=1;
  $midterm_status_missed .= "Midterm Written Test </br>";
}


if ($prefinal_output_1 == 0){
  $prefinal_status+=1;
  $prefinal_status_missed .= "Prefinal Output 1 </br>";
}

if ($prefinal_output_2 == 0){
  $prefinal_status+=1;
  $prefinal_status_missed .= "Prefinal Output 2 </br>";
}

if ($prefinal_performance_1 == 0){
  $prefinal_status+=1;
  $prefinal_status_missed .= "Prefinal Performance 1 </br>";
}

if ($prefinal_performance_2 == 0){
  $prefinal_status+=1;
  $prefinal_status_missed .= "Prefinal Performance 2 </br>";
}

if ($prefinal_written_test == 0){
  $prefinal_status+=1;
  $prefinal_status_missed .= "Prefinal Written Test </br>";
}


if ($final_output_1 == 0){
  $final_status+=1;
  $final_status_missed .= "final Output 1 </br>";
}

if ($final_output_2 == 0){
  $final_status+=1;
  $final_status_missed .= "final Output 2 </br>";
}

if ($final_performance_1 == 0){
  $final_status+=1;
  $final_status_missed .= "final Performance 1 </br>";
}

if ($final_performance_2 == 0){
  $final_status+=1;
  $final_status_missed .= "final Performance 2 </br>";
}

if ($final_written_test == 0){
  $final_status+=1;
  $final_status_missed .= "final Written Test </br>";
}

?>

<tr class="text-center">
<td><?php echo $student_name; ?></td>


<td id="get_prelim">
<?php
if($prelim_grade>0){
  if($prelim_status > 0){
    echo $prelim_grade." <sup class='grade_status bg-warning rounded-circle px-1' data-toggle='modal' data-target='#prelim$student_no'><b>$prelim_status</b><sup>";
  }else{
    echo $prelim_grade;
  }
}else{
  echo $prelim_grade;
}
?>
</td>


<td id="get_midterm">
<?php
if($midterm_grade>0){
  if($midterm_status > 0){
    echo $midterm_grade." <sup class='grade_status bg-warning rounded-circle px-1' data-toggle='modal' data-target='#midterm$student_no'><b>$midterm_status</b><sup>";
  }else{
    echo $midterm_grade;
  }
}else{
  echo $midterm_grade;
}
?>
</td>


<td><span id="get_prefinal">
<?php
if($prefinal_grade>0){
  if($prefinal_status > 0){
    echo $prefinal_grade." <sup class='grade_status bg-warning rounded-circle px-1' data-toggle='modal' data-target='#prefinal$student_no'><b>$prefinal_status</b><sup>";
  }else{
    echo $prefinal_grade;
  }
}else{
  if($prefinal_prediction>0){
    echo "<h6>".$prefinal_prediction."</h6>";
  }
}
?>
</span><input type="text" id="prefinal_grade_prediction" class="text-center col-5 container-fluid" disabled>
<?php
?>
</td>


<td><span id="get_final">
<?php
if($final_grade>0){
  if($final_status > 0){
    echo $final_grade." <sup class='grade_status bg-warning rounded-circle px-1' data-toggle='modal' data-target='#final$student_no'><b>$final_status</b><sup>";
  }else{
    echo $final_grade;
  }
}else{
  if($final_prediction>0){
    echo "<h6>".$final_prediction."</h6>";
  }
}
?>
</span><input type="text" id="final_grade_prediction" class="text-center col-5 container-fluid" disabled>
<?php
?>
</td>


<td>
<?php

if($final_grade>0){
  $average = $final_grade;

    echo $final_grade;
  // }
}else{
  if($final_prediction>0){
    $average = $final_prediction;
    echo "<h6>".$final_prediction."</h6>";
  }
}
?>
</td>
<td>
<?php

switch (true) {

    case ($average >= 74.5 && $average <= 76.49):
        $equivalent = "3";
        break;
    case ($average >= 76.5 && $average <= 79.49):
        $equivalent = "2.75";
        break;
    case ($average >= 79.5 && $average <= 82.49):
        $equivalent = "2.5";
        break;
    case ($average >= 82.5 && $average <= 85.49):
        $equivalent = "2.25";
        break;
    case ($average >= 85.5 && $average <= 88.49):
        $equivalent = "2";
        break;
    case ($average >= 88.5 && $average <= 91.49):
        $equivalent = "1.75";
        break;
    case ($average >= 91.5 && $average <= 94.49):
        $equivalent = "1.5";
        break;
    case ($average >= 94.5 && $average <= 97.49):
        $equivalent = "1.25";
        break;
    case ($average >= 97.5 && $average <= 100):
        $equivalent = "1";
        break;

    default:
        $equivalent = "---";
}

if($average > 0 && $average <= 74.4){
  $equivalent = "5";
}


 if(($prelim_grade>0) && ($midterm_grade>0) && ($prefinal_grade > 0) && ($final_grade>0)){
  echo $equivalent; 
 }else{
  if(($prelim_grade>0) && ($midterm_grade>0) && ($prefinal_prediction > 0) && ($final_prediction>0)){
    echo "<h6>".$equivalent."</h6>"; 
    }elseif(($prelim_grade>0) && ($midterm_grade>0) && ($prefinal_grade > 0) && ($final_prediction>0)){
     // $average = ($prelim_grade + $midterm_grade + $prefinal_grade + $final_prediction) / 4;
     echo "<h6>".$equivalent."</h6>";
    }
 }
 ?>
</td>

<td>
<?php
if($equivalent > 0 && $equivalent <= 3){
  $remarks = "Passed";
  echo "<h6 class='passed remarks'>".$remarks."</h6>";
}elseif($equivalent == 5){
  $remarks = "Failed";
  echo "<h6 class='failed remarks'>".$remarks."</h6>";
}else{
  $remarks = "---";
  echo $remarks;
}
 ?>
</td>


<td id="select_prediction">
<select class="form-control pt-1 pb-2 bg-dark text-white" id="average_predict" onchange="average()">
  <option value="select_grade_prediction">Select Value</option>
  <option value="75" id="75" <?php if(isset($_GET['ave'])){ if($_GET['ave'] == "75"){ echo 'selected'; }}?>>75</option>
  <option value="76" id="76" <?php if(isset($_GET['ave'])){ if($_GET['ave'] == "76"){ echo 'selected'; }}?>>76</option>
  <option value="77" id="77" <?php if(isset($_GET['ave'])){ if($_GET['ave'] == "77"){ echo 'selected'; }}?>>77</option>
  <option value="78" id="78" <?php if(isset($_GET['ave'])){ if($_GET['ave'] == "78"){ echo 'selected'; }}?>>78</option>
  <option value="79" id="79" <?php if(isset($_GET['ave'])){ if($_GET['ave'] == "79"){ echo 'selected'; }}?>>79</option>
  <option value="80" id="80" <?php if(isset($_GET['ave'])){ if($_GET['ave'] == "80"){ echo 'selected'; }}?>>80</option>
  <option value="81" id="81" <?php if(isset($_GET['ave'])){ if($_GET['ave'] == "81"){ echo 'selected'; }}?>>81</option>
  <option value="82" id="82" <?php if(isset($_GET['ave'])){ if($_GET['ave'] == "82"){ echo 'selected'; }}?>>82</option>
  <option value="83" id="83" <?php if(isset($_GET['ave'])){ if($_GET['ave'] == "83"){ echo 'selected'; }}?>>83</option>
  <option value="84" id="84" <?php if(isset($_GET['ave'])){ if($_GET['ave'] == "84"){ echo 'selected'; }}?>>84</option>
  <option value="85" id="85" <?php if(isset($_GET['ave'])){ if($_GET['ave'] == "85"){ echo 'selected'; }}?>>85</option>
  <option value="86" id="86" <?php if(isset($_GET['ave'])){ if($_GET['ave'] == "86"){ echo 'selected'; }}?>>86</option>
  <option value="87" id="87" <?php if(isset($_GET['ave'])){ if($_GET['ave'] == "87"){ echo 'selected'; }}?>>87</option>
  <option value="88" id="88" <?php if(isset($_GET['ave'])){ if($_GET['ave'] == "88"){ echo 'selected'; }}?>>88</option>
  <option value="89" id="89" <?php if(isset($_GET['ave'])){ if($_GET['ave'] == "89"){ echo 'selected'; }}?>>89</option>
  <option value="90" id="90" <?php if(isset($_GET['ave'])){ if($_GET['ave'] == "90"){ echo 'selected'; }}?>>90</option>
  <option value="91" id="91" <?php if(isset($_GET['ave'])){ if($_GET['ave'] == "91"){ echo 'selected'; }}?>>91</option>
  <option value="92" id="92" <?php if(isset($_GET['ave'])){ if($_GET['ave'] == "92"){ echo 'selected'; }}?>>92</option>
  <option value="93" id="93" <?php if(isset($_GET['ave'])){ if($_GET['ave'] == "93"){ echo 'selected'; }}?>>93</option>
  <option value="94" id="94" <?php if(isset($_GET['ave'])){ if($_GET['ave'] == "94"){ echo 'selected'; }}?>>94</option>
  <option value="95" id="95" <?php if(isset($_GET['ave'])){ if($_GET['ave'] == "95"){ echo 'selected'; }}?>>95</option>
  <option value="96" id="96" <?php if(isset($_GET['ave'])){ if($_GET['ave'] == "96"){ echo 'selected'; }}?>>96</option>
  <option value="97" id="97" <?php if(isset($_GET['ave'])){ if($_GET['ave'] == "97"){ echo 'selected'; }}?>>97</option>
  <option value="98" id="98" <?php if(isset($_GET['ave'])){ if($_GET['ave'] == "98"){ echo 'selected'; }}?>>98</option>
  <option value="99" id="99" <?php if(isset($_GET['ave'])){ if($_GET['ave'] == "99"){ echo 'selected'; }}?>>99</option>
  <option value="100" id="100" <?php if(isset($_GET['ave'])){ if($_GET['ave'] == "100"){ echo 'selected'; }}?>>100</option>


</select>
</td>
</tr>
<!-- <tr class="text-center"> -->
<!-- <td></td> -->
<!-- <td></td> -->
<td id="confirm_prefinal_prediction" class="bg-white d-none"><?php if($prefinal_prediction>0){echo $confirm_prefinal_prediction; }else{ echo $confirm_prefinal_prediction; } ?></td>
<td id="confirm_final_prediction" class="bg-white d-none"><?php if($final_prediction>0){echo $confirm_final_prediction; }else{ echo $confirm_final_prediction; } ?></td>
<!-- <td id="average_prediction"><?php echo $average_prediction; ?></td> -->
<!-- </tr> -->



<?php
// }
}
?>

</table>
</div>

<input type="hidden" id="prefinal_grade" value="<?php echo $prefinal_grade; ?>">
<input type="hidden" id="final_grade" value="<?php echo $final_grade; ?>">



<!-- The Prelim Modal -->
<div class="modal" id="<?php echo "prelim".$student_no; ?>">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header bg-success text-white">
        <h4 class="modal-title"><?php echo $student_name; ?></h4>
        <button type="button" class="close text-danger" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        <h3 class="text-danger">Defeciencies:</h3>
        <?php echo $prelim_status_missed; ?>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer bg-success">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>



<!-- The Midterm Modal -->
<div class="modal" id="<?php echo "midterm".$student_no; ?>">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header bg-primary text-white">
        <h4 class="modal-title"><?php echo $student_name; ?></h4>
        <button type="button" class="close text-danger" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        <h3 class="text-danger">Defeciencies:</h3>
        <?php echo $midterm_status_missed; ?>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer bg-primary">
        <button type="button" class="btn btn-warning text-white" data-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>


<!-- The Prefinal Modal -->
<div class="modal" id="<?php echo "prefinal".$student_no; ?>">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header bg-danger text-white">
        <h4 class="modal-title"><?php echo $student_name; ?></h4>
        <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        <h3 class="text-danger">Defeciencies:</h3>
        <?php echo $prefinal_status_missed; ?>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer bg-danger">
        <button type="button" class="btn btn-light" data-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>


<!-- The final Modal -->
<div class="modal" id="<?php echo "final".$student_no; ?>">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header bg-warning">
        <h4 class="modal-title text-white"><?php echo $student_name; ?></h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        <h3 class="text-danger">Defeciencies:</h3>
        <?php echo $final_status_missed; ?>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer bg-warning">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>


<?php
}
?>
<!-- ma remove it grade prediction kung di kaabot it 75 -->

<!-- <input type="text" id="final_grade_prediction">
<input type="text" id="prefinal_grade_prediction"> -->


<br>
<br>

<center>
<?php
include("grading_system.php");
?>
</center>

<script>

  var select_average = document.getElementById("average_predict");
  // alert(select_average[1].value);
  var select_prelim = parseFloat(document.getElementById("get_prelim").innerHTML);
  var select_midterm = parseFloat(document.getElementById("get_midterm").innerHTML);
  var select_prefinal = parseFloat(document.getElementById("get_prefinal").innerHTML);
  var select_prelim_and_midterm = select_prelim + select_midterm;

  
  var get_prelim_value = document.getElementById("get_prelim");
  var get_midterm_value = document.getElementById("get_midterm");
  var get_prefinal_value = document.getElementById("get_prefinal");
  var get_final_value = document.getElementById("get_final");

  var confirm_prefinal_prediction = document.getElementById("confirm_prefinal_prediction").innerHTML;
  var confirm_final_prediction = document.getElementById("confirm_final_prediction").innerHTML;

  var average_prediction = (parseFloat(get_prelim_value.innerHTML) + parseFloat(get_midterm_value.innerHTML) + parseFloat(confirm_prefinal_prediction) + parseFloat(confirm_final_prediction))/4;

  function semester(){
 
 var semester = document.getElementById("semester");
 var selected_semester = semester.options[semester.selectedIndex].value;

 window.location.href = "?s_="+selected_semester;
 // alert("hay");
}

  var close_button = document.getElementById("close_btn");
  window.onkeyup = function (event) {
  if (event.keyCode == 27) {
    // document.getElementById(boxid).style.visibility="hidden";
    window.location.href = "prediction";
  }
 }
// alert(average_prediction);
  // alert(select_prelim_and_midterm);
  // alert(
  //   "1="+select_average[1].value+
  //   "\n2="+select_average[2].value+
  //   "\n3="+select_average[3].value+
  //   "\n4="+select_average[4].value+
  //   "\n5="+select_average[5].value+
  //   "\n6="+select_average[6].value+
  //   "\n7="+select_average[7].value+
  //   "\n8="+select_average[8].value+
  //   "\n9="+select_average[9].value+
  //   "\n10="+select_average[10].value
  // );
  // alert(select_prelim_and_midterm);
// if(get_prelim_value.innerHTML != 0 & get_midterm_value.innerHTML != 0 & (get_prefinal_value.innerHTML == 0 | confirm_prefinal_prediction > 0) & (get_final_value.innerHTML  == 0 | confirm_prefinal_prediction > 0)){

  for(i=1;i<=74;i++){
  for(x=1;x<=74;x++){
    console.log(i+"+"+x);
    if((((select_prelim_and_midterm + i + x) / 4) >= 75)  & ((select_prelim_and_midterm + i + x) / 4) < 76 ){
    // alert("75");
    
    _75 = document.getElementById("75");
    _75.style.display = "none";
    // _75 = select_average.options.value = "75";
    // select_average.options.value("75").remove();
    
    }
    if((((select_prelim_and_midterm + i + x) / 4) >= 76)  & ((select_prelim_and_midterm + i + x) / 4) < 77 ){
    // alert("76");
    
    _76 = document.getElementById("76");
    _76.style.display = "none";
    }
    if((((select_prelim_and_midterm + i + x) / 4) >= 77)  & ((select_prelim_and_midterm + i + x) / 4) < 78 ){
    // alert("77");
    _77 = document.getElementById("77");
    
    _77.style.display = "none";
    }
    if((((select_prelim_and_midterm + i + x) / 4) >= 78)  & ((select_prelim_and_midterm + i + x) / 4) < 79 ){
    // alert("78");
    _78 = document.getElementById("78");
    
    _78.style.display = "none";
    }
    if((((select_prelim_and_midterm + i + x) / 4) >= 79) & ((select_prelim_and_midterm + i + x) / 4) < 80 ){
    // alert("79");
    _79 = document.getElementById("79");
    // console.log((((select_prelim_and_midterm + i + x) / 4)));
    _79.style.display = "none";
    }
    if((((select_prelim_and_midterm + i + x) / 4) >= 80)  & ((select_prelim_and_midterm + i + x) / 4) < 81 ){
    // alert("80");
    _80 = document.getElementById("80");
    _80.style.display = "none";
    }
    if((((select_prelim_and_midterm + i + x) / 4) >= 81)  & ((select_prelim_and_midterm + i + x) / 4) < 82 ){
    // alert("81");
    _81 = document.getElementById("81");
    _81.style.display = "none";
    }
    if((((select_prelim_and_midterm + i + x) / 4) >= 82)  & ((select_prelim_and_midterm + i + x) / 4) < 83 ){
    // alert("82");
    _82 = document.getElementById("82");
    
    _82.style.display = "none";
    }
    if((((select_prelim_and_midterm + i + x) / 4) >= 83) & ((select_prelim_and_midterm + i + x) / 4) < 84 ){
    // alert("83");
    _83 = document.getElementById("83");
    console.log((((select_prelim_and_midterm + i + x) / 4)));
    _83.style.display = "none";
    }
    if((((select_prelim_and_midterm + i + x) / 4) >= 84)  & ((select_prelim_and_midterm + i + x) / 4) < 85 ){
    // alert("84");
    _84 = document.getElementById("84");
    _84.style.display = "none";
    }
    if((((select_prelim_and_midterm + i + x) / 4) >= 85)  & ((select_prelim_and_midterm + i + x) / 4) < 86 ){
    // alert("85");
    _85 = document.getElementById("85");
    _85.style.display = "none";
    }
    if((((select_prelim_and_midterm + i + x) / 4) >= 86) & ((select_prelim_and_midterm + i + x) / 4) < 87 ){
    // alert("86");
    _86 = document.getElementById("86");
    _86.style.display = "none";
    }
    if((((select_prelim_and_midterm + i + x) / 4) >= 87)  & ((select_prelim_and_midterm + i + x) / 4) < 88 ){
    // alert("87");
    _87 = document.getElementById("87");
    _87.style.display = "none";
    }
    if((((select_prelim_and_midterm + i + x) / 4) >= 88)  & ((select_prelim_and_midterm + i + x) / 4) < 89 ){
    // alert("88");
    _88 = document.getElementById("88");
    _88.style.display = "none";
    }
    if((((select_prelim_and_midterm + i + x) / 4) >= 89)  & ((select_prelim_and_midterm + i + x) / 4) < 90 ){
    // alert("89");
    _89 = document.getElementById("89");
    _89.style.display = "none";
    }
    if((((select_prelim_and_midterm + i + x) / 4) >= 90)  & ((select_prelim_and_midterm + i + x) / 4) < 91 ){
    // alert("90");
    _90 = document.getElementById("90");
    _90.style.display = "none";
    }
    if((((select_prelim_and_midterm + i + x) / 4) >= 91)  & ((select_prelim_and_midterm + i + x) / 4) < 92 ){
    // alert("91");
    _91 = document.getElementById("91");
    _91.style.display = "none";
    
    }
    if((((select_prelim_and_midterm + i + x) / 4) >= 92)  & ((select_prelim_and_midterm + i + x) / 4) < 93 ){
    // alert("92");
    _92 = document.getElementById("92");
    _92.style.display = "none";
    }
    if((((select_prelim_and_midterm + i + x) / 4) >= 93)  & ((select_prelim_and_midterm + i + x) / 4) < 94 ){
    // alert("93");
    _93 = document.getElementById("93");
    _93.style.display = "none";
    }
    if((((select_prelim_and_midterm + i + x) / 4) >= 94)  & ((select_prelim_and_midterm + i + x) / 4) < 95 ){
    // alert("94");
    _94 = document.getElementById("94");
    _94.style.display = "none";
    }
    if((((select_prelim_and_midterm + i + x) / 4) >= 95) & ((select_prelim_and_midterm + i + x) / 4) < 96 ){
    // alert("95");
    _95 = document.getElementById("95");
    _95.style.display = "none";
    }
    if((((select_prelim_and_midterm + i + x) / 4) >= 96)  & ((select_prelim_and_midterm + i + x) / 4) < 97 ){
    // alert("96");
    _96 = document.getElementById("96");
    _96.style.display = "none";
    }
    if((((select_prelim_and_midterm + i + x) / 4) >= 97)  & ((select_prelim_and_midterm + i + x) / 4) < 98 ){
    // alert("97");
    _97 = document.getElementById("97");
    _97.style.display = "none";
    }
    if((((select_prelim_and_midterm + i + x) / 4) >= 98) & ((select_prelim_and_midterm + i + x) / 4) < 99 ){
    // alert("98");
    _98 = document.getElementById("98");
    _98.style.display = "none";
    }
    if((((select_prelim_and_midterm + i + x) / 4) >= 99)  & ((select_prelim_and_midterm + i + x) / 4) < 100 ){
    // alert("99");
    _99 = document.getElementById("99");
    _99.style.display = "none";
    }
    if((((select_prelim_and_midterm + i + x) / 4) >= 100)){
    // alert("100");
    _100 = document.getElementById("100");
    _100.style.display = "none";
    }

  }
  }


  for(y=100;y<=200;y++){
  for(z=100;z<=200;z++){
    // console.log(y+"+"+z);
    if((((select_prelim_and_midterm + y + z) / 4) >= 75)  & ((select_prelim_and_midterm + y + z) / 4) < 76 ){
    // alert("75");
    _75 = document.getElementById("75");
    _75.style.display = "none";
    // _75 = select_average.options.value = "75";
    // select_average.options.value("75").remove();
    }
    if((((select_prelim_and_midterm + y + z) / 4) >= 76)  & ((select_prelim_and_midterm + y + z) / 4) < 77 ){
    // alert("76");
    
    _76 = document.getElementById("76");
    _76.style.display = "none";
    }
    if((((select_prelim_and_midterm + y + z) / 4) >= 77)  & ((select_prelim_and_midterm + y + z) / 4) < 78 ){
    // alert("77");
    _77 = document.getElementById("77");
    
    _77.style.display = "none";
    }
    if((((select_prelim_and_midterm + y + z) / 4) >= 78)  & ((select_prelim_and_midterm + y + z) / 4) < 79 ){
    // alert("78");
    _78 = document.getElementById("78");
    
    _78.style.display = "none";
    }
    if((((select_prelim_and_midterm + y + z) / 4) >= 79) & ((select_prelim_and_midterm + y + z) / 4) < 80 ){
    // alert("79");
    _79 = document.getElementById("79");
    console.log((((select_prelim_and_midterm + y + z) / 4)));
    _79.style.display = "none";
    }
    if((((select_prelim_and_midterm + y + z) / 4) >= 80)  & ((select_prelim_and_midterm + y + z) / 4) < 81 ){
    // alert("80");
    _80 = document.getElementById("80");
    _80.style.display = "none";
    }
    if((((select_prelim_and_midterm + y + z) / 4) >= 81)  & ((select_prelim_and_midterm + y + z) / 4) < 82 ){
    // alert("81");
    _81 = document.getElementById("81");
    _81.style.display = "none";
    }
    if((((select_prelim_and_midterm + y + z) / 4) >= 82)  & ((select_prelim_and_midterm + y + z) / 4) < 83 ){
    // alert("82");
    _82 = document.getElementById("82");
    _82.style.display = "none";
    
    }
    if((((select_prelim_and_midterm + y + z) / 4) >= 83)  & ((select_prelim_and_midterm + y + z) / 4) < 84 ){
    // alert("83");
    _83 = document.getElementById("83");
    _83.style.display = "none";
    }
    if((((select_prelim_and_midterm + y + z) / 4) >= 84)  & ((select_prelim_and_midterm + y + z) / 4) < 85 ){
    // alert("84");
    _84 = document.getElementById("84");
    _84.style.display = "none";
    }
    if((((select_prelim_and_midterm + y + z) / 4) >= 85)  & ((select_prelim_and_midterm + y + z) / 4) < 86 ){
    // alert("85");
    _85 = document.getElementById("85");
    _85.style.display = "none";
    }
    if((((select_prelim_and_midterm + y + z) / 4) >= 86) & ((select_prelim_and_midterm + y + z) / 4) < 87 ){
    // alert("86");
    _86 = document.getElementById("86");
    _86.style.display = "none";
    }
    if((((select_prelim_and_midterm + y + z) / 4) >= 87)  & ((select_prelim_and_midterm + y + z) / 4) < 88 ){
    // alert("87");
    _87 = document.getElementById("87");
    _87.style.display = "none";
    }
    if((((select_prelim_and_midterm + y + z) / 4) >= 88)  & ((select_prelim_and_midterm + y + z) / 4) < 89 ){
    // alert("88");
    _88 = document.getElementById("88");
    _88.style.display = "none";
    }
    if((((select_prelim_and_midterm + y + z) / 4) >= 89)  & ((select_prelim_and_midterm + y + z) / 4) < 90 ){
    // alert("89");
    _89 = document.getElementById("89");
    _89.style.display = "none";
    }
    if((((select_prelim_and_midterm + y + z) / 4) >= 90)  & ((select_prelim_and_midterm + y + z) / 4) < 91 ){
    // alert("90");
    _90 = document.getElementById("90");
    _90.style.display = "none";
    }
    if((((select_prelim_and_midterm + y + z) / 4) >= 91)  & ((select_prelim_and_midterm + y + z) / 4) < 92 ){
    // alert("91");
    _91 = document.getElementById("91");
    _91.style.display = "none";
    
    }
    if((((select_prelim_and_midterm + y + z) / 4) >= 92)  & ((select_prelim_and_midterm + y + z) / 4) < 93 ){
    // alert("92");
    _92 = document.getElementById("92");
    _92.style.display = "none";
    }
    if((((select_prelim_and_midterm + y + z) / 4) >= 93)  & ((select_prelim_and_midterm + y + z) / 4) < 94 ){
    // alert("93");
    _93 = document.getElementById("93");
    _93.style.display = "none";
    }
    if((((select_prelim_and_midterm + y + z) / 4) >= 94)  & ((select_prelim_and_midterm + y + z) / 4) < 95 ){
    // alert("94");
    _94 = document.getElementById("94");
    _94.style.display = "none";
    }
    if((((select_prelim_and_midterm + y + z) / 4) >= 95) & ((select_prelim_and_midterm + y + z) / 4) < 96 ){
    // alert("95");
    _95 = document.getElementById("95");
    _95.style.display = "none";
    }
    if((((select_prelim_and_midterm + y + z) / 4) >= 96)  & ((select_prelim_and_midterm + y + z) / 4) < 97 ){
    // alert("96");
    _96 = document.getElementById("96");
    _96.style.display = "none";
    }
    if((((select_prelim_and_midterm + y + z) / 4) >= 97)  & ((select_prelim_and_midterm + y + z) / 4) < 98 ){
    // alert("97");
    _97 = document.getElementById("97");
    _97.style.display = "none";
    }
    if((((select_prelim_and_midterm + y + z) / 4) >= 98) & ((select_prelim_and_midterm + y + z) / 4) < 99 ){
    // alert("98");
    _98 = document.getElementById("98");
    _98.style.display = "none";
    }
    if((((select_prelim_and_midterm + y + z) / 4) >= 99)  & ((select_prelim_and_midterm + y + z) / 4) < 100 ){
    // alert("99");
    _99 = document.getElementById("99");
    _99.style.display = "none";
    }
    if((((select_prelim_and_midterm + y + z) / 4) >= 100)){
    // alert("100");
    _100 = document.getElementById("100");
    _100.style.display = "none";
    }

  }
  }

// }













// if(get_prelim_value.innerHTML != 0 & get_midterm_value.innerHTML != 0 & get_prefinal_value.innerHTML != 0 & (get_final_value.innerHTML  == 0 | confirm_final_prediction > 0)){

  for(a=1;a<=74;a++){
    console.log(a);
    if((((select_prelim_and_midterm + select_prefinal + a) / 4) >= 75)  & ((select_prelim_and_midterm + select_prefinal + a) / 4) < 76 ){
    // alert("75");
    
    _75 = document.getElementById("75");
    _75.style.display = "none";
    // _75 = select_average.options.value = "75";
    // select_average.options.value("75").remove();
    
    }
    if((((select_prelim_and_midterm + select_prefinal + a) / 4) >= 76)  & ((select_prelim_and_midterm + select_prefinal + a) / 4) < 77 ){
    // alert("76");
    
    _76 = document.getElementById("76");
    _76.style.display = "none";
    }
    if((((select_prelim_and_midterm + select_prefinal + a) / 4) >= 77)  & ((select_prelim_and_midterm + select_prefinal + a) / 4) < 78 ){
    // alert("77");
    _77 = document.getElementById("77");
    
    _77.style.display = "none";
    }
    if((((select_prelim_and_midterm + select_prefinal + a) / 4) >= 78)  & ((select_prelim_and_midterm + select_prefinal + a) / 4) < 79 ){
    // alert("78");
    _78 = document.getElementById("78");
    
    _78.style.display = "none";
    }
    if((((select_prelim_and_midterm + select_prefinal + a) / 4) >= 79) & ((select_prelim_and_midterm + select_prefinal + a) / 4) < 80 ){
    // alert("79");
    _79 = document.getElementById("79");
    console.log((((select_prelim_and_midterm + select_prefinal + a) / 4)));
    _79.style.display = "none";
    }
    if((((select_prelim_and_midterm + select_prefinal + a) / 4) >= 80)  & ((select_prelim_and_midterm + select_prefinal + a) / 4) < 81 ){
    // alert("80");
    _80 = document.getElementById("80");
    _80.style.display = "none";
    }
    if((((select_prelim_and_midterm + select_prefinal + a) / 4) >= 81)  & ((select_prelim_and_midterm + select_prefinal + a) / 4) < 82 ){
    // alert("81");
    _81 = document.getElementById("81");
    _81.style.display = "none";
    }
    if((((select_prelim_and_midterm + select_prefinal + a) / 4) >= 82)  & ((select_prelim_and_midterm + select_prefinal + a) / 4) < 83 ){
    // alert("82");
    _82 = document.getElementById("82");
    
    _82.style.display = "none";
    }
    if((((select_prelim_and_midterm + select_prefinal + a) / 4) >= 83) & ((select_prelim_and_midterm + select_prefinal + a) / 4) < 84 ){
    // alert("83");
    _83 = document.getElementById("83");
    console.log((((select_prelim_and_midterm + select_prefinal + a) / 4)));
    _83.style.display = "none";
    }
    if((((select_prelim_and_midterm + select_prefinal + a) / 4) >= 84)  & ((select_prelim_and_midterm + select_prefinal + a) / 4) < 85 ){
    // alert("84");
    _84 = document.getElementById("84");
    _84.style.display = "none";
    }
    if((((select_prelim_and_midterm + select_prefinal + a) / 4) >= 85)  & ((select_prelim_and_midterm + select_prefinal + a) / 4) < 86 ){
    // alert("85");
    _85 = document.getElementById("85");
    _85.style.display = "none";
    }
    if((((select_prelim_and_midterm + select_prefinal + a) / 4) >= 86) & ((select_prelim_and_midterm + select_prefinal + a) / 4) < 87 ){
    // alert("86");
    _86 = document.getElementById("86");
    console.log((((select_prelim_and_midterm + select_prefinal + a) / 4)));
    _86.style.display = "none"
    }
    if((((select_prelim_and_midterm + select_prefinal + a) / 4) >= 87)  & ((select_prelim_and_midterm + select_prefinal + a) / 4) < 88 ){
    // alert("87");
    _87 = document.getElementById("87");
    _87.style.display = "none"
    }
    if((((select_prelim_and_midterm + select_prefinal + a) / 4) >= 88)  & ((select_prelim_and_midterm + select_prefinal + a) / 4) < 89 ){
    // alert("88");
    _88 = document.getElementById("88");
    _88.style.display = "none"
    }
    if((((select_prelim_and_midterm + select_prefinal + a) / 4) >= 89)  & ((select_prelim_and_midterm + select_prefinal + a) / 4) < 90 ){
    // alert("89");
    _89 = document.getElementById("89");
    _89.style.display = "none"
    }
    if((((select_prelim_and_midterm + select_prefinal + a) / 4) >= 90)  & ((select_prelim_and_midterm + select_prefinal + a) / 4) < 91 ){
    // alert("90");
    _90 = document.getElementById("90");
    _90.style.display = "none"
    }
    if((((select_prelim_and_midterm + select_prefinal + a) / 4) >= 91)  & ((select_prelim_and_midterm + select_prefinal + a) / 4) < 92 ){
    // alert("91");
    _91 = document.getElementById("91");
    _91.style.display = "none"
    
    }
    if((((select_prelim_and_midterm + select_prefinal + a) / 4) >= 92)  & ((select_prelim_and_midterm + select_prefinal + a) / 4) < 93 ){
    // alert("92");
    _92 = document.getElementById("92");
    _92.style.display = "none"
    }
    if((((select_prelim_and_midterm + select_prefinal + a) / 4) >= 93)  & ((select_prelim_and_midterm + select_prefinal + a) / 4) < 94 ){
    // alert("93");
    _93 = document.getElementById("93");
    _93.style.display = "none"
    }
    if((((select_prelim_and_midterm + select_prefinal + a) / 4) >= 94)  & ((select_prelim_and_midterm + select_prefinal + a) / 4) < 95 ){
    // alert("94");
    _94 = document.getElementById("94");
    _94.style.display = "none"
    }
    if((((select_prelim_and_midterm + select_prefinal + a) / 4) >= 95) & ((select_prelim_and_midterm + select_prefinal + a) / 4) < 96 ){
    // alert("95");
    _95 = document.getElementById("95");
    _95.style.display = "none"
    }
    if((((select_prelim_and_midterm + select_prefinal + a) / 4) >= 96)  & ((select_prelim_and_midterm + select_prefinal + a) / 4) < 97 ){
    // alert("96");
    _96 = document.getElementById("96");
    _96.style.display = "none"
    }
    if((((select_prelim_and_midterm + select_prefinal + a) / 4) >= 97)  & ((select_prelim_and_midterm + select_prefinal + a) / 4) < 98 ){
    // alert("97");
    _97 = document.getElementById("97");
    _97.style.display = "none"
    }
    if((((select_prelim_and_midterm + select_prefinal + a) / 4) >= 98) & ((select_prelim_and_midterm + select_prefinal + a) / 4) < 99 ){
    // alert("98");
    _98 = document.getElementById("98");
    _98.style.display = "none"
    }
    if((((select_prelim_and_midterm + select_prefinal + a) / 4) >= 99)  & ((select_prelim_and_midterm + select_prefinal + a) / 4) < 100 ){
    // alert("99");
    _99 = document.getElementById("99");
    _99.style.display = "none"
    }
    if((((select_prelim_and_midterm + select_prefinal + a) / 4) >= 100)){
    // alert("100");
    _100 = document.getElementById("100");
    _100.style.display = "none"
    }
  }


  for(b=100;b<=150;b++){
    console.log(+b);
    if((((select_prelim_and_midterm + select_prefinal + b) / 4) >= 75)  & ((select_prelim_and_midterm + select_prefinal + b) / 4) < 76 ){
    // alert("75");
    
    _75 = document.getElementById("75");
    _75.style.display = "none";
    // _75 = select_average.options.value = "75";
    // select_average.options.value("75").remove();
    
    }
    if((((select_prelim_and_midterm + select_prefinal + b) / 4) >= 76)  & ((select_prelim_and_midterm + select_prefinal + b) / 4) < 77 ){
    // alert("76");
    
    _76 = document.getElementById("76");
    _76.style.display = "none";
    }
    if((((select_prelim_and_midterm + select_prefinal + b) / 4) >= 77)  & ((select_prelim_and_midterm + select_prefinal + b) / 4) < 78 ){
    // alert("77");
    _77 = document.getElementById("77");
    
    _77.style.display = "none";
    }
    if((((select_prelim_and_midterm + select_prefinal + b) / 4) >= 78)  & ((select_prelim_and_midterm + select_prefinal + b) / 4) < 79 ){
    // alert("78");
    _78 = document.getElementById("78");
    
    _78.style.display = "none";
    }
    if((((select_prelim_and_midterm + select_prefinal + b) / 4) >= 79) & ((select_prelim_and_midterm + select_prefinal + b) / 4) < 80 ){
    // alert("79");
    _79 = document.getElementById("79");
    console.log((((select_prelim_and_midterm + select_prefinal + b) / 4)));
    _79.style.display = "none";
    }
    if((((select_prelim_and_midterm + select_prefinal + b) / 4) >= 80)  & ((select_prelim_and_midterm + select_prefinal + b) / 4) < 81 ){
    // alert("80");
    _80 = document.getElementById("80");
    _80.style.display = "none";
    }
    if((((select_prelim_and_midterm + select_prefinal + b) / 4) >= 81)  & ((select_prelim_and_midterm + select_prefinal + b) / 4) < 82 ){
    // alert("81");
    _81 = document.getElementById("81");
    _81.style.display = "none";
    }
    if((((select_prelim_and_midterm + select_prefinal + b) / 4) >= 82)  & ((select_prelim_and_midterm + select_prefinal + b) / 4) < 83 ){
    // alert("82");
    _82 = document.getElementById("82");
    _82.style.display = "none";
    
    }
    if((((select_prelim_and_midterm + select_prefinal + b) / 4) >= 83)  & ((select_prelim_and_midterm + select_prefinal + b) / 4) < 84 ){
    // alert("83");
    _83 = document.getElementById("83");
    _83.style.display = "none";
    }
    if((((select_prelim_and_midterm + select_prefinal + b) / 4) >= 84)  & ((select_prelim_and_midterm + select_prefinal + b) / 4) < 85 ){
    // alert("84");
    _84 = document.getElementById("84");
    _84.style.display = "none";
    }
    if((((select_prelim_and_midterm + select_prefinal + b) / 4) >= 85)  & ((select_prelim_and_midterm + select_prefinal + b) / 4) < 86 ){
    // alert("85");
    _85 = document.getElementById("85");
    _85.style.display = "none";
    }
    if((((select_prelim_and_midterm + select_prefinal + b) / 4) >= 86) & ((select_prelim_and_midterm + select_prefinal + b) / 4) < 87 ){
    // alert("86");
    _86 = document.getElementById("86");
    console.log((((select_prelim_and_midterm + select_prefinal + b) / 4)));
    _86.style.display = "none";
    }
    if((((select_prelim_and_midterm + select_prefinal + b) / 4) >= 87)  & ((select_prelim_and_midterm + select_prefinal + b) / 4) < 88 ){
    // alert("87");
    _87 = document.getElementById("87");
    _87.style.display = "none";
    }
    if((((select_prelim_and_midterm + select_prefinal + b) / 4) >= 88)  & ((select_prelim_and_midterm + select_prefinal + b) / 4) < 89 ){
    // alert("88");
    _88 = document.getElementById("88");
    _88.style.display = "none";
    }
    if((((select_prelim_and_midterm + select_prefinal + b) / 4) >= 89)  & ((select_prelim_and_midterm + select_prefinal + b) / 4) < 90 ){
    // alert("89");
    _89 = document.getElementById("89");
    _89.style.display = "none";
    }
    if((((select_prelim_and_midterm + select_prefinal + b) / 4) >= 90)  & ((select_prelim_and_midterm + select_prefinal + b) / 4) < 91 ){
    // alert("90");
    _90 = document.getElementById("90");
    _90.style.display = "none";
    }
    if((((select_prelim_and_midterm + select_prefinal + b) / 4) >= 91)  & ((select_prelim_and_midterm + select_prefinal + b) / 4) < 92 ){
    // alert("91");
    _91 = document.getElementById("91");
    _91.style.display = "none";
    
    }
    if((((select_prelim_and_midterm + select_prefinal + b) / 4) >= 92)  & ((select_prelim_and_midterm + select_prefinal + b) / 4) < 93 ){
    // alert("92");
    _92 = document.getElementById("92");
    _92.style.display = "none";
    }
    if((((select_prelim_and_midterm + select_prefinal + b) / 4) >= 93)  & ((select_prelim_and_midterm + select_prefinal + b) / 4) < 94 ){
    // alert("93");
    _93 = document.getElementById("93");
    _93.style.display = "none";
    }
    if((((select_prelim_and_midterm + select_prefinal + b) / 4) >= 94)  & ((select_prelim_and_midterm + select_prefinal + b) / 4) < 95 ){
    // alert("94");
    _94 = document.getElementById("94");
    _94.style.display = "none";
    }
    if((((select_prelim_and_midterm + select_prefinal + b) / 4) >= 95) & ((select_prelim_and_midterm + select_prefinal + b) / 4) < 96 ){
    // alert("95");
    _95 = document.getElementById("95");
    _95.style.display = "none";
    }
    if((((select_prelim_and_midterm + select_prefinal + b) / 4) >= 96)  & ((select_prelim_and_midterm + select_prefinal + b) / 4) < 97 ){
    // alert("96");
    _96 = document.getElementById("96");
    _96.style.display = "none";
    }
    if((((select_prelim_and_midterm + select_prefinal + b) / 4) >= 97)  & ((select_prelim_and_midterm + select_prefinal + b) / 4) < 98 ){
    // alert("97");
    _97 = document.getElementById("97");
    _97.style.display = "none";
    }
    if((((select_prelim_and_midterm + select_prefinal + b) / 4) >= 98) & ((select_prelim_and_midterm + select_prefinal + b) / 4) < 99 ){
    // alert("98");
    _98 = document.getElementById("98");
    _98.style.display = "none";
    }
    if((((select_prelim_and_midterm + select_prefinal + b) / 4) >= 99)  & ((select_prelim_and_midterm + select_prefinal + b) / 4) < 100 ){
    // alert("99");
    _99 = document.getElementById("99");
    _99.style.display = "none";
    }
    if((((select_prelim_and_midterm + select_prefinal + b) / 4) >= 100)){
    // alert("100");
    _100 = document.getElementById("100");
    _100.style.display = "none";
    }

  }



var prefinal = document.getElementById("prefinal_student_predict");
var prefinal_grade = document.getElementById("prefinal_grade");

var prefinal_grade_prediction = document.getElementById("prefinal_grade_prediction");
var get_prefinal = document.getElementById("get_prefinal");

var final_grade_prediction = document.getElementById("final_grade_prediction");
var get_final = document.getElementById("get_final");
var final = document.getElementById("final_student_predict");
var final_grade = document.getElementById("final_grade");
var prediction = document.getElementById("prediction");
var select_prediction = document.getElementById("select_prediction");

var confirm_prefinal_prediction = document.getElementById("confirm_prefinal_prediction").innerHTML;
var confirm_final_prediction = document.getElementById("confirm_final_prediction").innerHTML;
var confirmation_prefinal = 0;
var confirmation_final = 0;

if(final_grade.value>0){
  // alert(final_grade.value);
  prediction.style.display="none";
  select_prediction.style.display="none";
}

if(confirm_prefinal_prediction > 0){
confirmation_prefinal = 1;
prefinal.classList.remove("bg-danger");
prefinal.classList.add("bg-dark");
prefinal.innerHTML += " <sup class='badge badge-warning'>Prediction</sup>";
}
if(confirm_final_prediction > 0 ){
confirmation_final = 1;
final.classList.remove("bg-warning");
final.classList.add("bg-dark");
final.innerHTML += " <sup class='badge badge-warning'>Prediction</sup>";
}

if(get_prelim_value.innerHTML != 0 & get_midterm_value.innerHTML != 0 & get_prefinal_value.innerHTML == 0 & get_final_value.innerHTML == 0 & confirmation_prefinal == 0 & confirmation_final == 0){

  if(prefinal_grade.value == 0 & final_grade.value == 0 & confirmation_prefinal == 0 & confirmation_final == 0){
    prefinal_grade_prediction.style.display = "block";
    get_prefinal.style.display = "none";
  }else{
    prefinal_grade_prediction.style.display = "none";
    get_prefinal.style.display = "block";
  }



    if(final_grade.value == 0){


      final_grade_prediction.style.display = "block";
      get_final.style.display = "none";
 
     }else{
      final_grade_prediction.style.display = "none";
      get_final.style.display = "block";
    }
}else if(get_prelim_value.innerHTML != 0 & get_midterm_value.innerHTML != 0 & get_prefinal_value.innerHTML != 0 & get_final_value.innerHTML == 0 & confirmation_prefinal == 0 & confirmation_final == 0){

    if(final_grade.value == 0 & confirmation_prefinal == 0 & confirmation_final == 0){
    
      final_grade_prediction.style.display = "block";
      get_final.style.display = "none";
      final.innerHTML += "<sup class='badge badge-warning'>Prediction</sup>";
    
    }else{
      final_grade_prediction.style.display = "none";
      get_final.style.display = "block";
    }


}else if(get_prelim_value.innerHTML != 0 & get_midterm_value.innerHTML != 0 & get_prefinal_value.innerHTML != 0 & get_final_value.innerHTML != 0 & confirmation_prefinal != 0 & confirmation_final != 0){


  var new_select_average = document.getElementById("average_predict").selectedIndex.value;

  // new_select_average = "74";
  // alert(new_select_average);


}else{
  get_prefinal.style.display = "block";
  get_final.style.display = "block";
  // prefinal_grade_prediction.style.display = "none";
  // final_grade_prediction.style.display = "none";
  // prediction.style.display = "none";
  // select_prediction.style.display = "none";
}


function average(){
  var average = document.getElementById("average_predict");
  var selected_average = average.options[average.selectedIndex].value;




  var new_prelim = parseFloat(get_prelim_value.innerHTML);
  var new_midterm = parseFloat(get_midterm_value.innerHTML);
  var new_prefinal = parseFloat(get_prefinal_value.innerHTML);
  var prelim_midterm =  new_prelim+new_midterm;


  // var prefinal_final;
  var new_prefinal;
  var new_final;
  // var overall_average;

  var grade_array =[];

  // ___________75

  var _75_75 = 75 + 75;
  var _75_76 = 75 + 76;
  var _75_77 = 75 + 77;
  var _75_78 = 75 + 78;
  var _75_79 = 75 + 79;
  var _75_80 = 75 + 80;
  var _75_81 = 75 + 81;
  var _75_82 = 75 + 82;
  var _75_83 = 75 + 83;
  var _75_84 = 75 + 84;
  var _75_85 = 75 + 85;
  var _75_86 = 75 + 86;
  var _75_87 = 75 + 87;
  var _75_88 = 75 + 88;
  var _75_89 = 75 + 89;
  var _75_90 = 75 + 90;
  var _75_91 = 75 + 91;
  var _75_92 = 75 + 92;
  var _75_93 = 75 + 93;
  var _75_94 = 75 + 94;
  var _75_95 = 75 + 95;
  var _75_96 = 75 + 96;
  var _75_97 = 75 + 97;
  var _75_98 = 75 + 98;
  var _75_99 = 75 + 99;
  var _75_100 = 75 + 100;



  // ___________76

  var _76_75 = 76 + 75;
  var _76_76 = 76 + 76;
  var _76_77 = 76 + 77;
  var _76_78 = 76 + 78;
  var _76_79 = 76 + 79;
  var _76_80 = 76 + 80;
  var _76_81 = 76 + 81;
  var _76_82 = 76 + 82;
  var _76_83 = 76 + 83;
  var _76_84 = 76 + 84;
  var _76_85 = 76 + 85;
  var _76_86 = 76 + 86;
  var _76_87 = 76 + 87;
  var _76_88 = 76 + 88;
  var _76_89 = 76 + 89;
  var _76_90 = 76 + 90;
  var _76_91 = 76 + 91;
  var _76_92 = 76 + 92;
  var _76_93 = 76 + 93;
  var _76_94 = 76 + 94;
  var _76_95 = 76 + 95;
  var _76_96 = 76 + 96;
  var _76_97 = 76 + 97;
  var _76_98 = 76 + 98;
  var _76_99 = 76 + 99;
  var _76_100 = 76 + 100;



  // ___________77

  var _77_75 = 77 + 75;
  var _77_76 = 77 + 76;
  var _77_77 = 77 + 77;
  var _77_78 = 77 + 78;
  var _77_79 = 77 + 79;
  var _77_80 = 77 + 80;
  var _77_81 = 77 + 81;
  var _77_82 = 77 + 82;
  var _77_83 = 77 + 83;
  var _77_84 = 77 + 84;
  var _77_85 = 77 + 85;
  var _77_86 = 77 + 86;
  var _77_87 = 77 + 87;
  var _77_88 = 77 + 88;
  var _77_89 = 77 + 89;
  var _77_90 = 77 + 90;
  var _77_91 = 77 + 91;
  var _77_92 = 77 + 92;
  var _77_93 = 77 + 93;
  var _77_94 = 77 + 94;
  var _77_95 = 77 + 95;
  var _77_96 = 77 + 96;
  var _77_97 = 77 + 97;
  var _77_98 = 77 + 98;
  var _77_99 = 77 + 99;
  var _77_100 = 77 + 100;


  // ___________78

  var _78_75 = 78 + 75;
  var _78_76 = 78 + 76;
  var _78_77 = 78 + 77;
  var _78_78 = 78 + 78;
  var _78_79 = 78 + 79;
  var _78_80 = 78 + 80;
  var _78_81 = 78 + 81;
  var _78_82 = 78 + 82;
  var _78_83 = 78 + 83;
  var _78_84 = 78 + 84;
  var _78_85 = 78 + 85;
  var _78_86 = 78 + 86;
  var _78_87 = 78 + 87;
  var _78_88 = 78 + 88;
  var _78_89 = 78 + 89;
  var _78_90 = 78 + 90;
  var _78_91 = 78 + 91;
  var _78_92 = 78 + 92;
  var _78_93 = 78 + 93;
  var _78_94 = 78 + 94;
  var _78_95 = 78 + 95;
  var _78_96 = 78 + 96;
  var _78_97 = 78 + 97;
  var _78_98 = 78 + 98;
  var _78_99 = 78 + 99;
  var _78_100 = 78 + 100;


  // ___________79

  var _79_75 = 79 + 75;
  var _79_76 = 79 + 76;
  var _79_77 = 79 + 77;
  var _79_78 = 79 + 78;
  var _79_79 = 79 + 79;
  var _79_80 = 79 + 80;
  var _79_81 = 79 + 81;
  var _79_82 = 79 + 82;
  var _79_83 = 79 + 83;
  var _79_84 = 79 + 84;
  var _79_85 = 79 + 85;
  var _79_86 = 79 + 86;
  var _79_87 = 79 + 87;
  var _79_88 = 79 + 88;
  var _79_89 = 79 + 89;
  var _79_90 = 79 + 90;
  var _79_91 = 79 + 91;
  var _79_92 = 79 + 92;
  var _79_93 = 79 + 93;
  var _79_94 = 79 + 94;
  var _79_95 = 79 + 95;
  var _79_96 = 79 + 96;
  var _79_97 = 79 + 97;
  var _79_98 = 79 + 98;
  var _79_99 = 79 + 99;
  var _79_100 = 79 + 100;


  // ___________80

  var _80_75 = 80 + 75;
  var _80_76 = 80 + 76;
  var _80_77 = 80 + 77;
  var _80_78 = 80 + 78;
  var _80_79 = 80 + 79;
  var _80_80 = 80 + 80;
  var _80_81 = 80 + 81;
  var _80_82 = 80 + 82;
  var _80_83 = 80 + 83;
  var _80_84 = 80 + 84;
  var _80_85 = 80 + 85;
  var _80_86 = 80 + 86;
  var _80_87 = 80 + 87;
  var _80_88 = 80 + 88;
  var _80_89 = 80 + 89;
  var _80_90 = 80 + 90;
  var _80_91 = 80 + 91;
  var _80_92 = 80 + 92;
  var _80_93 = 80 + 93;
  var _80_94 = 80 + 94;
  var _80_95 = 80 + 95;
  var _80_96 = 80 + 96;
  var _80_97 = 80 + 97;
  var _80_98 = 80 + 98;
  var _80_99 = 80 + 99;
  var _80_100 = 80 + 100;


  // ___________81

  var _81_75 = 81 + 75;
  var _81_76 = 81 + 76;
  var _81_77 = 81 + 77;
  var _81_78 = 81 + 78;
  var _81_79 = 81 + 79;
  var _81_80 = 81 + 80;
  var _81_81 = 81 + 81;
  var _81_82 = 81 + 82;
  var _81_83 = 81 + 83;
  var _81_84 = 81 + 84;
  var _81_85 = 81 + 85;
  var _81_86 = 81 + 86;
  var _81_87 = 81 + 87;
  var _81_88 = 81 + 88;
  var _81_89 = 81 + 89;
  var _81_90 = 81 + 90;
  var _81_91 = 81 + 91;
  var _81_92 = 81 + 92;
  var _81_93 = 81 + 93;
  var _81_94 = 81 + 94;
  var _81_95 = 81 + 95;
  var _81_96 = 81 + 96;
  var _81_97 = 81 + 97;
  var _81_98 = 81 + 98;
  var _81_99 = 81 + 99;
  var _81_100 = 81 + 100;


  // ___________82

  var _82_75 = 82 + 75;
  var _82_76 = 82 + 76;
  var _82_77 = 82 + 77;
  var _82_78 = 82 + 78;
  var _82_79 = 82 + 79;
  var _82_80 = 82 + 80;
  var _82_81 = 82 + 81;
  var _82_82 = 82 + 82;
  var _82_83 = 82 + 83;
  var _82_84 = 82 + 84;
  var _82_85 = 82 + 85;
  var _82_86 = 82 + 86;
  var _82_87 = 82 + 87;
  var _82_88 = 82 + 88;
  var _82_89 = 82 + 89;
  var _82_90 = 82 + 90;
  var _82_91 = 82 + 91;
  var _82_92 = 82 + 92;
  var _82_93 = 82 + 93;
  var _82_94 = 82 + 94;
  var _82_95 = 82 + 95;
  var _82_96 = 82 + 96;
  var _82_97 = 82 + 97;
  var _82_98 = 82 + 98;
  var _82_99 = 82 + 99;
  var _82_100 = 82 + 100;


  // ___________83

  var _83_75 = 83 + 75;
  var _83_76 = 83 + 76;
  var _83_77 = 83 + 77;
  var _83_78 = 83 + 78;
  var _83_79 = 83 + 79;
  var _83_80 = 83 + 80;
  var _83_81 = 83 + 81;
  var _83_82 = 83 + 82;
  var _83_83 = 83 + 83;
  var _83_84 = 83 + 84;
  var _83_85 = 83 + 85;
  var _83_86 = 83 + 86;
  var _83_87 = 83 + 87;
  var _83_88 = 83 + 88;
  var _83_89 = 83 + 89;
  var _83_90 = 83 + 90;
  var _83_91 = 83 + 91;
  var _83_92 = 83 + 92;
  var _83_93 = 83 + 93;
  var _83_94 = 83 + 94;
  var _83_95 = 83 + 95;
  var _83_96 = 83 + 96;
  var _83_97 = 83 + 97;
  var _83_98 = 83 + 98;
  var _83_99 = 83 + 99;
  var _83_100 = 83 + 100;


  // ___________84

  var _84_75 = 84 + 75;
  var _84_76 = 84 + 76;
  var _84_77 = 84 + 77;
  var _84_78 = 84 + 78;
  var _84_79 = 84 + 79;
  var _84_80 = 84 + 80;
  var _84_81 = 84 + 81;
  var _84_82 = 84 + 82;
  var _84_83 = 84 + 83;
  var _84_84 = 84 + 84;
  var _84_85 = 84 + 85;
  var _84_86 = 84 + 86;
  var _84_87 = 84 + 87;
  var _84_88 = 84 + 88;
  var _84_89 = 84 + 89;
  var _84_90 = 84 + 90;
  var _84_91 = 84 + 91;
  var _84_92 = 84 + 92;
  var _84_93 = 84 + 93;
  var _84_94 = 84 + 94;
  var _84_95 = 84 + 95;
  var _84_96 = 84 + 96;
  var _84_97 = 84 + 97;
  var _84_98 = 84 + 98;
  var _84_99 = 84 + 99;
  var _84_100 = 84 + 100;


  // ___________85

  var _85_75 = 85 + 75;
  var _85_76 = 85 + 76;
  var _85_77 = 85 + 77;
  var _85_78 = 85 + 78;
  var _85_79 = 85 + 79;
  var _85_80 = 85 + 80;
  var _85_81 = 85 + 81;
  var _85_82 = 85 + 82;
  var _85_83 = 85 + 83;
  var _85_84 = 85 + 84;
  var _85_85 = 85 + 85;
  var _85_86 = 85 + 86;
  var _85_87 = 85 + 87;
  var _85_88 = 85 + 88;
  var _85_89 = 85 + 89;
  var _85_90 = 85 + 90;
  var _85_91 = 85 + 91;
  var _85_92 = 85 + 92;
  var _85_93 = 85 + 93;
  var _85_94 = 85 + 94;
  var _85_95 = 85 + 95;
  var _85_96 = 85 + 96;
  var _85_97 = 85 + 97;
  var _85_98 = 85 + 98;
  var _85_99 = 85 + 99;
  var _85_100 = 85 + 100;


  // ___________86

  var _86_75 = 86 + 75;
  var _86_76 = 86 + 76;
  var _86_77 = 86 + 77;
  var _86_78 = 86 + 78;
  var _86_79 = 86 + 79;
  var _86_80 = 86 + 80;
  var _86_81 = 86 + 81;
  var _86_82 = 86 + 82;
  var _86_83 = 86 + 83;
  var _86_84 = 86 + 84;
  var _86_85 = 86 + 85;
  var _86_86 = 86 + 86;
  var _86_87 = 86 + 87;
  var _86_88 = 86 + 88;
  var _86_89 = 86 + 89;
  var _86_90 = 86 + 90;
  var _86_91 = 86 + 91;
  var _86_92 = 86 + 92;
  var _86_93 = 86 + 93;
  var _86_94 = 86 + 94;
  var _86_95 = 86 + 95;
  var _86_96 = 86 + 96;
  var _86_97 = 86 + 97;
  var _86_98 = 86 + 98;
  var _86_99 = 86 + 99;
  var _86_100 = 86 + 100;


  // ___________87

  var _87_75 = 87 + 75;
  var _87_76 = 87 + 76;
  var _87_77 = 87 + 77;
  var _87_78 = 87 + 78;
  var _87_79 = 87 + 79;
  var _87_80 = 87 + 80;
  var _87_81 = 87 + 81;
  var _87_82 = 87 + 82;
  var _87_83 = 87 + 83;
  var _87_84 = 87 + 84;
  var _87_85 = 87 + 85;
  var _87_86 = 87 + 86;
  var _87_87 = 87 + 87;
  var _87_88 = 87 + 88;
  var _87_89 = 87 + 89;
  var _87_90 = 87 + 90;
  var _87_91 = 87 + 91;
  var _87_92 = 87 + 92;
  var _87_93 = 87 + 93;
  var _87_94 = 87 + 94;
  var _87_95 = 87 + 95;
  var _87_96 = 87 + 96;
  var _87_97 = 87 + 97;
  var _87_98 = 87 + 98;
  var _87_99 = 87 + 99;
  var _87_100 = 87 + 100;


  // ___________88

  var _88_75 = 88 + 75;
  var _88_76 = 88 + 76;
  var _88_77 = 88 + 77;
  var _88_78 = 88 + 78;
  var _88_79 = 88 + 79;
  var _88_80 = 88 + 80;
  var _88_81 = 88 + 81;
  var _88_82 = 88 + 82;
  var _88_83 = 88 + 83;
  var _88_84 = 88 + 84;
  var _88_85 = 88 + 85;
  var _88_86 = 88 + 86;
  var _88_87 = 88 + 87;
  var _88_88 = 88 + 88;
  var _88_89 = 88 + 89;
  var _88_90 = 88 + 90;
  var _88_91 = 88 + 91;
  var _88_92 = 88 + 92;
  var _88_93 = 88 + 93;
  var _88_94 = 88 + 94;
  var _88_95 = 88 + 95;
  var _88_96 = 88 + 96;
  var _88_97 = 88 + 97;
  var _88_98 = 88 + 98;
  var _88_99 = 88 + 99;
  var _88_100 = 88 + 100;


  // ___________89

  var _89_75 = 89 + 75;
  var _89_76 = 89 + 76;
  var _89_77 = 89 + 77;
  var _89_78 = 89 + 78;
  var _89_79 = 89 + 79;
  var _89_80 = 89 + 80;
  var _89_81 = 89 + 81;
  var _89_82 = 89 + 82;
  var _89_83 = 89 + 83;
  var _89_84 = 89 + 84;
  var _89_85 = 89 + 85;
  var _89_86 = 89 + 86;
  var _89_87 = 89 + 87;
  var _89_88 = 89 + 88;
  var _89_89 = 89 + 89;
  var _89_90 = 89 + 90;
  var _89_91 = 89 + 91;
  var _89_92 = 89 + 92;
  var _89_93 = 89 + 93;
  var _89_94 = 89 + 94;
  var _89_95 = 89 + 95;
  var _89_96 = 89 + 96;
  var _89_97 = 89 + 97;
  var _89_98 = 89 + 98;
  var _89_99 = 89 + 99;
  var _89_100 = 89 + 100;


  // ___________90

  var _90_75 = 90 + 75;
  var _90_76 = 90 + 76;
  var _90_77 = 90 + 77;
  var _90_78 = 90 + 78;
  var _90_79 = 90 + 79;
  var _90_80 = 90 + 80;
  var _90_81 = 90 + 81;
  var _90_82 = 90 + 82;
  var _90_83 = 90 + 83;
  var _90_84 = 90 + 84;
  var _90_85 = 90 + 85;
  var _90_86 = 90 + 86;
  var _90_87 = 90 + 87;
  var _90_88 = 90 + 88;
  var _90_89 = 90 + 89;
  var _90_90 = 90 + 90;
  var _90_91 = 90 + 91;
  var _90_92 = 90 + 92;
  var _90_93 = 90 + 93;
  var _90_94 = 90 + 94;
  var _90_95 = 90 + 95;
  var _90_96 = 90 + 96;
  var _90_97 = 90 + 97;
  var _90_98 = 90 + 98;
  var _90_99 = 90 + 99;
  var _90_100 = 90 + 100;


  // ___________91

  var _91_75 = 91 + 75;
  var _91_76 = 91 + 76;
  var _91_77 = 91 + 77;
  var _91_78 = 91 + 78;
  var _91_79 = 91 + 79;
  var _91_80 = 91 + 80;
  var _91_81 = 91 + 81;
  var _91_82 = 91 + 82;
  var _91_83 = 91 + 83;
  var _91_84 = 91 + 84;
  var _91_85 = 91 + 85;
  var _91_86 = 91 + 86;
  var _91_87 = 91 + 87;
  var _91_88 = 91 + 88;
  var _91_89 = 91 + 89;
  var _91_90 = 91 + 90;
  var _91_91 = 91 + 91;
  var _91_92 = 91 + 92;
  var _91_93 = 91 + 93;
  var _91_94 = 91 + 94;
  var _91_95 = 91 + 95;
  var _91_96 = 91 + 96;
  var _91_97 = 91 + 97;
  var _91_98 = 91 + 98;
  var _91_99 = 91 + 99;
  var _91_100 = 91 + 100;


  // ___________92

  var _92_75 = 92 + 75;
  var _92_76 = 92 + 76;
  var _92_77 = 92 + 77;
  var _92_78 = 92 + 78;
  var _92_79 = 92 + 79;
  var _92_80 = 92 + 80;
  var _92_81 = 92 + 81;
  var _92_82 = 92 + 82;
  var _92_83 = 92 + 83;
  var _92_84 = 92 + 84;
  var _92_85 = 92 + 85;
  var _92_86 = 92 + 86;
  var _92_87 = 92 + 87;
  var _92_88 = 92 + 88;
  var _92_89 = 92 + 89;
  var _92_90 = 92 + 90;
  var _92_91 = 92 + 91;
  var _92_92 = 92 + 92;
  var _92_93 = 92 + 93;
  var _92_94 = 92 + 94;
  var _92_95 = 92 + 95;
  var _92_96 = 92 + 96;
  var _92_97 = 92 + 97;
  var _92_98 = 92 + 98;
  var _92_99 = 92 + 99;
  var _92_100 = 92 + 100;


  // ___________93

  var _93_75 = 93 + 75;
  var _93_76 = 93 + 76;
  var _93_77 = 93 + 77;
  var _93_78 = 93 + 78;
  var _93_79 = 93 + 79;
  var _93_80 = 93 + 80;
  var _93_81 = 93 + 81;
  var _93_82 = 93 + 82;
  var _93_83 = 93 + 83;
  var _93_84 = 93 + 84;
  var _93_85 = 93 + 85;
  var _93_86 = 93 + 86;
  var _93_87 = 93 + 87;
  var _93_88 = 93 + 88;
  var _93_89 = 93 + 89;
  var _93_90 = 93 + 90;
  var _93_91 = 93 + 91;
  var _93_92 = 93 + 92;
  var _93_93 = 93 + 93;
  var _93_94 = 93 + 94;
  var _93_95 = 93 + 95;
  var _93_96 = 93 + 96;
  var _93_97 = 93 + 97;
  var _93_98 = 93 + 98;
  var _93_99 = 93 + 99;
  var _93_100 = 93 + 100;


  // ___________94

  var _94_75 = 94 + 75;
  var _94_76 = 94 + 76;
  var _94_77 = 94 + 77;
  var _94_78 = 94 + 78;
  var _94_79 = 94 + 79;
  var _94_80 = 94 + 80;
  var _94_81 = 94 + 81;
  var _94_82 = 94 + 82;
  var _94_83 = 94 + 83;
  var _94_84 = 94 + 84;
  var _94_85 = 94 + 85;
  var _94_86 = 94 + 86;
  var _94_87 = 94 + 87;
  var _94_88 = 94 + 88;
  var _94_89 = 94 + 89;
  var _94_90 = 94 + 90;
  var _94_91 = 94 + 91;
  var _94_92 = 94 + 92;
  var _94_93 = 94 + 93;
  var _94_94 = 94 + 94;
  var _94_95 = 94 + 95;
  var _94_96 = 94 + 96;
  var _94_97 = 94 + 97;
  var _94_98 = 94 + 98;
  var _94_99 = 94 + 99;
  var _94_100 = 94 + 100;


  // ___________95

  var _95_75 = 95 + 75;
  var _95_76 = 95 + 76;
  var _95_77 = 95 + 77;
  var _95_78 = 95 + 78;
  var _95_79 = 95 + 79;
  var _95_80 = 95 + 80;
  var _95_81 = 95 + 81;
  var _95_82 = 95 + 82;
  var _95_83 = 95 + 83;
  var _95_84 = 95 + 84;
  var _95_85 = 95 + 85;
  var _95_86 = 95 + 86;
  var _95_87 = 95 + 87;
  var _95_88 = 95 + 88;
  var _95_89 = 95 + 89;
  var _95_90 = 95 + 90;
  var _95_91 = 95 + 91;
  var _95_92 = 95 + 92;
  var _95_93 = 95 + 93;
  var _95_94 = 95 + 94;
  var _95_95 = 95 + 95;
  var _95_96 = 95 + 96;
  var _95_97 = 95 + 97;
  var _95_98 = 95 + 98;
  var _95_99 = 95 + 99;
  var _95_100 = 95 + 100;


  // ___________96

  var _96_75 = 96 + 75;
  var _96_76 = 96 + 76;
  var _96_77 = 96 + 77;
  var _96_78 = 96 + 78;
  var _96_79 = 96 + 79;
  var _96_80 = 96 + 80;
  var _96_81 = 96 + 81;
  var _96_82 = 96 + 82;
  var _96_83 = 96 + 83;
  var _96_84 = 96 + 84;
  var _96_85 = 96 + 85;
  var _96_86 = 96 + 86;
  var _96_87 = 96 + 87;
  var _96_88 = 96 + 88;
  var _96_89 = 96 + 89;
  var _96_90 = 96 + 90;
  var _96_91 = 96 + 91;
  var _96_92 = 96 + 92;
  var _96_93 = 96 + 93;
  var _96_94 = 96 + 94;
  var _96_95 = 96 + 95;
  var _96_96 = 96 + 96;
  var _96_97 = 96 + 97;
  var _96_98 = 96 + 98;
  var _96_99 = 96 + 99;
  var _96_100 = 96 + 100;


  // ___________97

  var _97_75 = 97 + 75;
  var _97_76 = 97 + 76;
  var _97_77 = 97 + 77;
  var _97_78 = 97 + 78;
  var _97_79 = 97 + 79;
  var _97_80 = 97 + 80;
  var _97_81 = 97 + 81;
  var _97_82 = 97 + 82;
  var _97_83 = 97 + 83;
  var _97_84 = 97 + 84;
  var _97_85 = 97 + 85;
  var _97_86 = 97 + 86;
  var _97_87 = 97 + 87;
  var _97_88 = 97 + 88;
  var _97_89 = 97 + 89;
  var _97_90 = 97 + 90;
  var _97_91 = 97 + 91;
  var _97_92 = 97 + 92;
  var _97_93 = 97 + 93;
  var _97_94 = 97 + 94;
  var _97_95 = 97 + 95;
  var _97_96 = 97 + 96;
  var _97_97 = 97 + 97;
  var _97_98 = 97 + 98;
  var _97_99 = 97 + 99;
  var _97_100 = 97 + 100;


  // ___________98

  var _98_75 = 98 + 75;
  var _98_76 = 98 + 76;
  var _98_77 = 98 + 77;
  var _98_78 = 98 + 78;
  var _98_79 = 98 + 79;
  var _98_80 = 98 + 80;
  var _98_81 = 98 + 81;
  var _98_82 = 98 + 82;
  var _98_83 = 98 + 83;
  var _98_84 = 98 + 84;
  var _98_85 = 98 + 85;
  var _98_86 = 98 + 86;
  var _98_87 = 98 + 87;
  var _98_88 = 98 + 88;
  var _98_89 = 98 + 89;
  var _98_90 = 98 + 90;
  var _98_91 = 98 + 91;
  var _98_92 = 98 + 92;
  var _98_93 = 98 + 93;
  var _98_94 = 98 + 94;
  var _98_95 = 98 + 95;
  var _98_96 = 98 + 96;
  var _98_97 = 98 + 97;
  var _98_98 = 98 + 98;
  var _98_99 = 98 + 99;
  var _98_100 = 98 + 100;


  // ___________99

  var _99_75 = 99 + 75;
  var _99_76 = 99 + 76;
  var _99_77 = 99 + 77;
  var _99_78 = 99 + 78;
  var _99_79 = 99 + 79;
  var _99_80 = 99 + 80;
  var _99_81 = 99 + 81;
  var _99_82 = 99 + 82;
  var _99_83 = 99 + 83;
  var _99_84 = 99 + 84;
  var _99_85 = 99 + 85;
  var _99_86 = 99 + 86;
  var _99_87 = 99 + 87;
  var _99_88 = 99 + 88;
  var _99_89 = 99 + 89;
  var _99_90 = 99 + 90;
  var _99_91 = 99 + 91;
  var _99_92 = 99 + 92;
  var _99_93 = 99 + 93;
  var _99_94 = 99 + 94;
  var _99_95 = 99 + 95;
  var _99_96 = 99 + 96;
  var _99_97 = 99 + 97;
  var _99_98 = 99 + 98;
  var _99_99 = 99 + 99;
  var _99_100 = 99 + 100;


  // ___________100

  var _100_75 = 100 + 75;
  var _100_76 = 100 + 76;
  var _100_77 = 100 + 77;
  var _100_78 = 100 + 78;
  var _100_79 = 100 + 79;
  var _100_80 = 100 + 80;
  var _100_81 = 100 + 81;
  var _100_82 = 100 + 82;
  var _100_83 = 100 + 83;
  var _100_84 = 100 + 84;
  var _100_85 = 100 + 85;
  var _100_86 = 100 + 86;
  var _100_87 = 100 + 87;
  var _100_88 = 100 + 88;
  var _100_89 = 100 + 89;
  var _100_90 = 100 + 90;
  var _100_91 = 100 + 91;
  var _100_92 = 100 + 92;
  var _100_93 = 100 + 93;
  var _100_94 = 100 + 94;
  var _100_95 = 100 + 95;
  var _100_96 = 100 + 96;
  var _100_97 = 100 + 97;
  var _100_98 = 100 + 98;
  var _100_99 = 100 + 99;
  var _100_100 = 100 + 100;

if(get_prelim_value.innerHTML != 0 & get_midterm_value.innerHTML != 0 & (get_prefinal_value.innerHTML == 0 | confirmation_prefinal > 0) & (get_final_value.innerHTML  == 0 | confirmation_final > 0)){


// _75

if(((prelim_midterm+_75_75)/4 >= selected_average) & (prelim_midterm+_75_75)/4 <= parseInt(selected_average) + 1){
  // alert(selected_average);
  grade_array.push("_75_75");
  new_prefinal = 75;
  new_final = 75;
  // alert(_75_75.valueOf());
  // alert((prelim_midterm+_75_77)/4);
}

if(((prelim_midterm+_75_76)/4 >= selected_average) & (prelim_midterm+_75_76)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_75_76");
  new_prefinal = 75;
  new_final = 76;
}

if(((prelim_midterm+_75_77)/4 >= selected_average) & (prelim_midterm+_75_77)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_75_77");
  new_prefinal = 75;
  new_final = 77;
}

if(((prelim_midterm+_75_78)/4 >= selected_average) & (prelim_midterm+_75_78)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_75_78");
  new_prefinal = 75;
  new_final = 78;
}

if(((prelim_midterm+_75_79)/4 >= selected_average) & (prelim_midterm+_75_79)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_75_79");
  new_prefinal = 75;
  new_final = 79; 
}

if(((prelim_midterm+_75_80)/4 >= selected_average) & (prelim_midterm+_75_80)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_75_80");
  new_prefinal = 75;
  new_final = 80;
}

if(((prelim_midterm+_75_81)/4 >= selected_average) & (prelim_midterm+_75_81)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_75_81");
  new_prefinal = 75;
  new_final = 81;
}

if(((prelim_midterm+_75_82)/4 >= selected_average) & (prelim_midterm+_75_82)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_75_82");
  new_prefinal = 75;
  new_final = 82;
}

if(((prelim_midterm+_75_83)/4 >= selected_average) & (prelim_midterm+_75_83)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_75_83");
  new_prefinal = 75;
  new_final = 83;
}

if(((prelim_midterm+_75_84)/4 >= selected_average) & (prelim_midterm+_75_84)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_75_84");
  new_prefinal = 75;
  new_final = 84;
}

if(((prelim_midterm+_75_85)/4 >= selected_average) & (prelim_midterm+_75_85)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_75_85");
  new_prefinal = 75;
  new_final = 85;
}

if(((prelim_midterm+_75_86)/4 >= selected_average) & (prelim_midterm+_75_86)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_75_86");
  new_prefinal = 75;
  new_final = 86;
}

if(((prelim_midterm+_75_87)/4 >= selected_average) & (prelim_midterm+_75_87)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_75_87");
  new_prefinal = 75;
  new_final = 87;
}

if(((prelim_midterm+_75_88)/4 >= selected_average) & (prelim_midterm+_75_88)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_75_88");
  new_prefinal = 75;
  new_final = 88;
}

if(((prelim_midterm+_75_89)/4 >= selected_average) & (prelim_midterm+_75_89)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_75_89");
  new_prefinal = 75;
  new_final = 89;
}

if(((prelim_midterm+_75_90)/4 >= selected_average) & (prelim_midterm+_75_90)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_75_90");
  new_prefinal = 75;
  new_final = 90;
}

if(((prelim_midterm+_75_91)/4 >= selected_average) & (prelim_midterm+_75_91)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_75_91");
  new_prefinal = 75;
  new_final = 91;
}

if(((prelim_midterm+_75_92)/4 >= selected_average) & (prelim_midterm+_75_92)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_75_92");
  new_prefinal = 75;
  new_final = 92;
}

if(((prelim_midterm+_75_93)/4 >= selected_average) & (prelim_midterm+_75_93)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_75_93");
  new_prefinal = 75;
  new_final = 93;
}

if(((prelim_midterm+_75_94)/4 >= selected_average) & (prelim_midterm+_75_94)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_75_94");
  new_prefinal = 75;
  new_final = 94; 
}

if(((prelim_midterm+_75_95)/4 >= selected_average) & (prelim_midterm+_75_95)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_75_95");
  new_prefinal = 75;
  new_final = 95;
}

if(((prelim_midterm+_75_96)/4 >= selected_average) & (prelim_midterm+_75_96)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_75_96");
  new_prefinal = 75;
  new_final = 96;
}

if(((prelim_midterm+_75_97)/4 >= selected_average) & (prelim_midterm+_75_97)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_75_97");
  new_prefinal = 75;
  new_final = 97;
}

if(((prelim_midterm+_75_98)/4 >= selected_average) & (prelim_midterm+_75_98)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_75_98");
  new_prefinal = 75;
  new_final = 98;
}

if(((prelim_midterm+_75_99)/4 >= selected_average) & (prelim_midterm+_75_99)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_75_99");
  new_prefinal = 75;
  new_final = 99;
}

if(((prelim_midterm+_75_100)/4 >= selected_average) & (prelim_midterm+_75_100)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_75_100");
  new_prefinal = 75;
  new_final = 100;
}


// _76

if(((prelim_midterm+_76_75)/4 >= selected_average) & (prelim_midterm+_76_75)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_76_75");
  new_prefinal = 76;
  new_final = 75;
}

if(((prelim_midterm+_76_76)/4 >= selected_average) & (prelim_midterm+_76_76)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_76_76");
  new_prefinal = 76;
  new_final = 76;
}

if(((prelim_midterm+_76_77)/4 >= selected_average) & (prelim_midterm+_76_77)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_76_77");
  new_prefinal = 76;
  new_final = 77;
}

if(((prelim_midterm+_76_78)/4 >= selected_average) & (prelim_midterm+_76_78)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_76_78");
  new_prefinal = 76;
  new_final = 78;
}

if(((prelim_midterm+_76_79)/4 >= selected_average) & (prelim_midterm+_76_79)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_76_79");
  new_prefinal = 76;
  new_final = 79;
}

if(((prelim_midterm+_76_80)/4 >= selected_average) & (prelim_midterm+_76_80)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_76_80");
  new_prefinal = 76;
  new_final = 80;
}

if(((prelim_midterm+_76_81)/4 >= selected_average) & (prelim_midterm+_76_81)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_76_81");
  new_prefinal = 76;
  new_final = 81;
}

if(((prelim_midterm+_76_82)/4 >= selected_average) & (prelim_midterm+_76_82)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_76_82");
  new_prefinal = 76;
  new_final = 82;
}

if(((prelim_midterm+_76_83)/4 >= selected_average) & (prelim_midterm+_76_83)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_76_83");
  new_prefinal = 76;
  new_final = 83;
}

if(((prelim_midterm+_76_84)/4 >= selected_average) & (prelim_midterm+_76_84)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_76_84");
  new_prefinal = 76;
  new_final = 84;
}

if(((prelim_midterm+_76_85)/4 >= selected_average) & (prelim_midterm+_76_85)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_76_85");
  new_prefinal = 76;
  new_final = 85;
}

if(((prelim_midterm+_76_86)/4 >= selected_average) & (prelim_midterm+_76_86)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_76_86");
  new_prefinal = 76;
  new_final = 86;
}

if(((prelim_midterm+_76_87)/4 >= selected_average) & (prelim_midterm+_76_87)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_76_87");
  new_prefinal = 76;
  new_final = 87;
}

if(((prelim_midterm+_76_88)/4 >= selected_average) & (prelim_midterm+_76_88)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_76_88");
  new_prefinal = 76;
  new_final = 88;
}

if(((prelim_midterm+_76_89)/4 >= selected_average) & (prelim_midterm+_76_89)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_76_89");
  new_prefinal = 76;
  new_final = 89;
}

if(((prelim_midterm+_76_90)/4 >= selected_average) & (prelim_midterm+_76_90)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_76_90");
  new_prefinal = 76;
  new_final = 90;
}

if(((prelim_midterm+_76_91)/4 >= selected_average) & (prelim_midterm+_76_91)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_76_91");
  new_prefinal = 76;
  new_final = 91;
}

if(((prelim_midterm+_76_92)/4 >= selected_average) & (prelim_midterm+_76_92)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_76_92");
  new_prefinal = 76;
  new_final = 92;
}

if(((prelim_midterm+_76_93)/4 >= selected_average) & (prelim_midterm+_76_93)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_76_93");
  new_prefinal = 76;
  new_final = 93;
}

if(((prelim_midterm+_76_94)/4 >= selected_average) & (prelim_midterm+_76_94)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_76_94");
  new_prefinal = 76;
  new_final = 94;
}

if(((prelim_midterm+_76_95)/4 >= selected_average) & (prelim_midterm+_76_95)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_76_95");
  new_prefinal = 76;
  new_final = 95;
}

if(((prelim_midterm+_76_96)/4 >= selected_average) & (prelim_midterm+_76_96)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_76_96");
  new_prefinal = 76;
  new_final = 96;
}

if(((prelim_midterm+_76_97)/4 >= selected_average) & (prelim_midterm+_76_97)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_76_97");
  new_prefinal = 76;
  new_final = 97;
}

if(((prelim_midterm+_76_98)/4 >= selected_average) & (prelim_midterm+_76_98)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_76_98");
  new_prefinal = 76;
  new_final = 98;
}

if(((prelim_midterm+_76_99)/4 >= selected_average) & (prelim_midterm+_76_99)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_76_99");
  new_prefinal = 76;
  new_final = 99;
}

if(((prelim_midterm+_76_100)/4 >= selected_average) & (prelim_midterm+_76_100)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_76_100");
  new_prefinal = 76;
  new_final = 100;
}



// _77

if(((prelim_midterm+_77_75)/4 >= selected_average) & (prelim_midterm+_77_75)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_77_75");
  new_prefinal = 77;
  new_final = 75;
}

if(((prelim_midterm+_77_76)/4 >= selected_average) & (prelim_midterm+_77_76)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_77_76");
  new_prefinal = 77;
  new_final = 76;
}

if(((prelim_midterm+_77_77)/4 >= selected_average) & (prelim_midterm+_77_77)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_77_77");
  new_prefinal = 77;
  new_final = 77;
}

if(((prelim_midterm+_77_78)/4 >= selected_average) & (prelim_midterm+_77_78)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_77_78");
  new_prefinal = 77;
  new_final = 78;
}

if(((prelim_midterm+_77_79)/4 >= selected_average) & (prelim_midterm+_77_79)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_77_79");
  new_prefinal = 77;
  new_final = 79;
}

if(((prelim_midterm+_77_80)/4 >= selected_average) & (prelim_midterm+_77_80)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_77_80");
  new_prefinal = 77;
  new_final = 80;
}

if(((prelim_midterm+_77_81)/4 >= selected_average) & (prelim_midterm+_77_81)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_77_81");
  new_prefinal = 77;
  new_final = 81;
}

if(((prelim_midterm+_77_82)/4 >= selected_average) & (prelim_midterm+_77_82)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_77_82");
  new_prefinal = 77;
  new_final = 82;
}

if(((prelim_midterm+_77_83)/4 >= selected_average) & (prelim_midterm+_77_83)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_77_83");
  new_prefinal = 77;
  new_final = 83;
}

if(((prelim_midterm+_77_84)/4 >= selected_average) & (prelim_midterm+_77_84)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_77_84");
  new_prefinal = 77;
  new_final = 84;
}

if(((prelim_midterm+_77_85)/4 >= selected_average) & (prelim_midterm+_77_85)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_77_85");
  new_prefinal = 77;
  new_final = 85;
}

if(((prelim_midterm+_77_86)/4 >= selected_average) & (prelim_midterm+_77_86)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_77_86");
  new_prefinal = 77;
  new_final = 86;
}

if(((prelim_midterm+_77_87)/4 >= selected_average) & (prelim_midterm+_77_87)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_77_87");
  new_prefinal = 77;
  new_final = 87;
}

if(((prelim_midterm+_77_88)/4 >= selected_average) & (prelim_midterm+_77_88)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_77_88");
  new_prefinal = 77;
  new_final = 88;
}

if(((prelim_midterm+_77_89)/4 >= selected_average) & (prelim_midterm+_77_89)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_77_89");
  new_prefinal = 77;
  new_final = 89;
}

if(((prelim_midterm+_77_90)/4 >= selected_average) & (prelim_midterm+_77_90)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_77_90");
  new_prefinal = 77;
  new_final = 90;
}

if(((prelim_midterm+_77_91)/4 >= selected_average) & (prelim_midterm+_77_91)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_77_91");
  new_prefinal = 77;
  new_final = 91;
}

if(((prelim_midterm+_77_92)/4 >= selected_average) & (prelim_midterm+_77_92)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_77_92");
  new_prefinal = 77;
  new_final = 92;
}

if(((prelim_midterm+_77_93)/4 >= selected_average) & (prelim_midterm+_77_93)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_77_93");
  new_prefinal = 77;
  new_final = 93;
}

if(((prelim_midterm+_77_94)/4 >= selected_average) & (prelim_midterm+_77_94)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_77_94");
  new_prefinal = 77;
  new_final = 94;
}

if(((prelim_midterm+_77_95)/4 >= selected_average) & (prelim_midterm+_77_95)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_77_95");
  new_prefinal = 77;
  new_final = 95;
}

if(((prelim_midterm+_77_96)/4 >= selected_average) & (prelim_midterm+_77_96)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_77_96");
  new_prefinal = 77;
  new_final = 96;
}

if(((prelim_midterm+_77_97)/4 >= selected_average) & (prelim_midterm+_77_97)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_77_97");
  new_prefinal = 77;
  new_final = 97;
}

if(((prelim_midterm+_77_98)/4 >= selected_average) & (prelim_midterm+_77_98)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_77_98");
  new_prefinal = 77;
  new_final = 98;
}

if(((prelim_midterm+_77_99)/4 >= selected_average) & (prelim_midterm+_77_99)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_77_99");
  new_prefinal = 77;
  new_final = 99;
}

if(((prelim_midterm+_77_100)/4 >= selected_average) & (prelim_midterm+_77_100)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_77_100");
  new_prefinal = 77;
  new_final = 100;
}


// 78

if(((prelim_midterm+_78_75)/4 >= selected_average) & (prelim_midterm+_78_75)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_78_75");
  new_prefinal = 78;
  new_final = 75;
}

if(((prelim_midterm+_78_76)/4 >= selected_average) & (prelim_midterm+_78_76)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_78_76");
  new_prefinal = 78;
  new_final = 76;
}

if(((prelim_midterm+_78_77)/4 >= selected_average) & (prelim_midterm+_78_77)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_78_77");
  new_prefinal = 78;
  new_final = 77;
}

if(((prelim_midterm+_78_78)/4 >= selected_average) & (prelim_midterm+_78_78)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_78_78");
  new_prefinal = 78;
  new_final = 78;
}

if(((prelim_midterm+_78_79)/4 >= selected_average) & (prelim_midterm+_78_79)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_78_79");
  new_prefinal = 78;
  new_final = 79;
}

if(((prelim_midterm+_78_80)/4 >= selected_average) & (prelim_midterm+_78_80)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_78_80");
  new_prefinal = 78;
  new_final = 80;
}

if(((prelim_midterm+_78_81)/4 >= selected_average) & (prelim_midterm+_78_81)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_78_81");
  new_prefinal = 78;
  new_final = 81;
}

if(((prelim_midterm+_78_82)/4 >= selected_average) & (prelim_midterm+_78_82)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_78_82");
  new_prefinal = 78;
  new_final = 82;
}

if(((prelim_midterm+_78_83)/4 >= selected_average) & (prelim_midterm+_78_83)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_78_83");
  new_prefinal = 78;
  new_final = 83;
}

if(((prelim_midterm+_78_84)/4 >= selected_average) & (prelim_midterm+_78_84)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_78_84");
  new_prefinal = 78;
  new_final = 84;
}

if(((prelim_midterm+_78_85)/4 >= selected_average) & (prelim_midterm+_78_85)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_78_85");
  new_prefinal = 78;
  new_final = 85;
}

if(((prelim_midterm+_78_86)/4 >= selected_average) & (prelim_midterm+_78_86)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_78_86");
  new_prefinal = 78;
  new_final = 86;
}

if(((prelim_midterm+_78_87)/4 >= selected_average) & (prelim_midterm+_78_87)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_78_87");
  new_prefinal = 78;
  new_final = 87;
}

if(((prelim_midterm+_78_88)/4 >= selected_average) & (prelim_midterm+_78_88)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_78_88");
  new_prefinal = 78;
  new_final = 88;
}

if(((prelim_midterm+_78_89)/4 >= selected_average) & (prelim_midterm+_78_89)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_78_89");
  new_prefinal = 78;
  new_final = 89;
}

if(((prelim_midterm+_78_90)/4 >= selected_average) & (prelim_midterm+_78_90)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_78_90");
  new_prefinal = 78;
  new_final = 90;
}

if(((prelim_midterm+_78_91)/4 >= selected_average) & (prelim_midterm+_78_91)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_78_91");
  new_prefinal = 78;
  new_final = 91;
}

if(((prelim_midterm+_78_92)/4 >= selected_average) & (prelim_midterm+_78_92)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_78_92");
  new_prefinal = 78;
  new_final = 92;
}

if(((prelim_midterm+_78_93)/4 >= selected_average) & (prelim_midterm+_78_93)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_78_93");
  new_prefinal = 78;
  new_final = 93;
}

if(((prelim_midterm+_78_94)/4 >= selected_average) & (prelim_midterm+_78_94)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_78_94");
  new_prefinal = 78;
  new_final = 94;
}

if(((prelim_midterm+_78_95)/4 >= selected_average) & (prelim_midterm+_78_95)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_78_95");
  new_prefinal = 78;
  new_final = 95;
}

if(((prelim_midterm+_78_96)/4 >= selected_average) & (prelim_midterm+_78_96)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_78_96");
  new_prefinal = 78;
  new_final = 96;
}

if(((prelim_midterm+_78_97)/4 >= selected_average) & (prelim_midterm+_78_97)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_78_97");
  new_prefinal = 78;
  new_final = 97;
}

if(((prelim_midterm+_78_98)/4 >= selected_average) & (prelim_midterm+_78_98)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_78_98");
  new_prefinal = 78;
  new_final = 98;
}

if(((prelim_midterm+_78_99)/4 >= selected_average) & (prelim_midterm+_78_99)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_78_99");
  new_prefinal = 78;
  new_final = 99;
}

if(((prelim_midterm+_78_100)/4 >= selected_average) & (prelim_midterm+_78_100)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_78_100");
  new_prefinal = 78;
  new_final = 100;
}


// 79

if(((prelim_midterm+_79_75)/4 >= selected_average) & (prelim_midterm+_79_75)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_79_75");
  new_prefinal = 79;
  new_final = 75;
}

if(((prelim_midterm+_79_76)/4 >= selected_average) & (prelim_midterm+_79_76)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_79_76");
  new_prefinal = 79;
  new_final = 76;
}

if(((prelim_midterm+_79_77)/4 >= selected_average) & (prelim_midterm+_79_77)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_79_77");
  new_prefinal = 79;
  new_final = 77;
}

if(((prelim_midterm+_79_78)/4 >= selected_average) & (prelim_midterm+_79_78)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_79_78");
  new_prefinal = 79;
  new_final = 78;
}

if(((prelim_midterm+_79_79)/4 >= selected_average) & (prelim_midterm+_79_79)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_79_79");
  new_prefinal = 79;
  new_final = 79;
}

if(((prelim_midterm+_79_80)/4 >= selected_average) & (prelim_midterm+_79_80)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_79_80");
  new_prefinal = 79;
  new_final = 80;
}

if(((prelim_midterm+_79_81)/4 >= selected_average) & (prelim_midterm+_79_81)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_79_81");
  new_prefinal = 79;
  new_final = 81;
}

if(((prelim_midterm+_79_82)/4 >= selected_average) & (prelim_midterm+_79_82)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_79_82");
  new_prefinal = 79;
  new_final = 82;
}

if(((prelim_midterm+_79_83)/4 >= selected_average) & (prelim_midterm+_79_83)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_79_83");
  new_prefinal = 79;
  new_final = 83;
}

if(((prelim_midterm+_79_84)/4 >= selected_average) & (prelim_midterm+_79_84)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_79_84");
  new_prefinal = 79;
  new_final = 84;
}

if(((prelim_midterm+_79_85)/4 >= selected_average) & (prelim_midterm+_79_85)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_79_85");
  new_prefinal = 79;
  new_final = 85;
}

if(((prelim_midterm+_79_86)/4 >= selected_average) & (prelim_midterm+_79_86)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_79_86");
  new_prefinal = 79;
  new_final = 86;
}

if(((prelim_midterm+_79_87)/4 >= selected_average) & (prelim_midterm+_79_87)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_79_87");
  new_prefinal = 79;
  new_final = 87;
}

if(((prelim_midterm+_79_88)/4 >= selected_average) & (prelim_midterm+_79_88)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_79_88");
  new_prefinal = 79;
  new_final = 88;
}

if(((prelim_midterm+_79_89)/4 >= selected_average) & (prelim_midterm+_79_89)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_79_89");
  new_prefinal = 79;
  new_final = 89;
}

if(((prelim_midterm+_79_90)/4 >= selected_average) & (prelim_midterm+_79_90)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_79_90");
  new_prefinal = 79;
  new_final = 90;
}

if(((prelim_midterm+_79_91)/4 >= selected_average) & (prelim_midterm+_79_91)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_79_91");
  new_prefinal = 79;
  new_final = 91;
}

if(((prelim_midterm+_79_92)/4 >= selected_average) & (prelim_midterm+_79_92)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_79_92");
  new_prefinal = 79;
  new_final = 92;
}

if(((prelim_midterm+_79_93)/4 >= selected_average) & (prelim_midterm+_79_93)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_79_93");
  new_prefinal = 79;
  new_final = 93;
}

if(((prelim_midterm+_79_94)/4 >= selected_average) & (prelim_midterm+_79_94)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_79_94");
  new_prefinal = 79;
  new_final = 94;
}

if(((prelim_midterm+_79_95)/4 >= selected_average) & (prelim_midterm+_79_95)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_79_95");
  new_prefinal = 79;
  new_final = 95;
}

if(((prelim_midterm+_79_96)/4 >= selected_average) & (prelim_midterm+_79_96)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_79_96");
  new_prefinal = 79;
  new_final = 96;
}

if(((prelim_midterm+_79_97)/4 >= selected_average) & (prelim_midterm+_79_97)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_79_97");
  new_prefinal = 79;
  new_final = 97;
}

if(((prelim_midterm+_79_98)/4 >= selected_average) & (prelim_midterm+_79_98)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_79_98");
  new_prefinal = 79;
  new_final = 98;
}

if(((prelim_midterm+_79_99)/4 >= selected_average) & (prelim_midterm+_79_99)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_79_99");
  new_prefinal = 79;
  new_final = 99;
}

if(((prelim_midterm+_79_100)/4 >= selected_average) & (prelim_midterm+_79_100)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_79_100");
  new_prefinal = 79;
  new_final = 100;
}


// 80

if(((prelim_midterm+_80_75)/4 >= selected_average) & (prelim_midterm+_80_75)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_80_75");
  new_prefinal = 80;
  new_final = 75;
}

if(((prelim_midterm+_80_76)/4 >= selected_average) & (prelim_midterm+_80_76)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_80_76");
  new_prefinal = 80;
  new_final = 76;
}

if(((prelim_midterm+_80_77)/4 >= selected_average) & (prelim_midterm+_80_77)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_80_77");
  new_prefinal = 80;
  new_final = 77;
}

if(((prelim_midterm+_80_78)/4 >= selected_average) & (prelim_midterm+_80_78)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_80_78");
  new_prefinal = 80;
  new_final = 78;
}

if(((prelim_midterm+_80_79)/4 >= selected_average) & (prelim_midterm+_80_79)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_80_79");
  new_prefinal = 80;
  new_final = 79;
}

if(((prelim_midterm+_80_80)/4 >= selected_average) & (prelim_midterm+_80_80)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_80_80");
  new_prefinal = 80;
  new_final = 80;
}

if(((prelim_midterm+_80_81)/4 >= selected_average) & (prelim_midterm+_80_81)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_80_81");
  new_prefinal = 80;
  new_final = 81;
}

if(((prelim_midterm+_80_82)/4 >= selected_average) & (prelim_midterm+_80_82)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_80_82");
  new_prefinal = 80;
  new_final = 82;
}

if(((prelim_midterm+_80_83)/4 >= selected_average) & (prelim_midterm+_80_83)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_80_83");
  new_prefinal = 80;
  new_final = 83;
}

if(((prelim_midterm+_80_84)/4 >= selected_average) & (prelim_midterm+_80_84)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_80_84");
  new_prefinal = 80;
  new_final = 84;
}

if(((prelim_midterm+_80_85)/4 >= selected_average) & (prelim_midterm+_80_85)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_80_85");
  new_prefinal = 80;
  new_final = 85;
}

if(((prelim_midterm+_80_86)/4 >= selected_average) & (prelim_midterm+_80_86)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_80_86");
  new_prefinal = 80;
  new_final = 86;
}

if(((prelim_midterm+_80_87)/4 >= selected_average) & (prelim_midterm+_80_87)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_80_87");
  new_prefinal = 80;
  new_final = 87;
}

if(((prelim_midterm+_80_88)/4 >= selected_average) & (prelim_midterm+_80_88)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_80_88");
  new_prefinal = 80;
  new_final = 88;
}

if(((prelim_midterm+_80_89)/4 >= selected_average) & (prelim_midterm+_80_89)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_80_89");
  new_prefinal = 80;
  new_final = 89;
}

if(((prelim_midterm+_80_90)/4 >= selected_average) & (prelim_midterm+_80_90)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_80_90");
  new_prefinal = 80;
  new_final = 90;
}

if(((prelim_midterm+_80_91)/4 >= selected_average) & (prelim_midterm+_80_91)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_80_91");
  new_prefinal = 80;
  new_final = 91;
}

if(((prelim_midterm+_80_92)/4 >= selected_average) & (prelim_midterm+_80_92)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_80_92");
  new_prefinal = 80;
  new_final = 92;
}

if(((prelim_midterm+_80_93)/4 >= selected_average) & (prelim_midterm+_80_93)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_80_93");
  new_prefinal = 80;
  new_final = 93;
}

if(((prelim_midterm+_80_94)/4 >= selected_average) & (prelim_midterm+_80_94)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_80_94");
  new_prefinal = 80;
  new_final = 94;
}

if(((prelim_midterm+_80_95)/4 >= selected_average) & (prelim_midterm+_80_95)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_80_95");
  new_prefinal = 80;
  new_final = 95;
}

if(((prelim_midterm+_80_96)/4 >= selected_average) & (prelim_midterm+_80_96)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_80_96");
  new_prefinal = 80;
  new_final = 96;
}

if(((prelim_midterm+_80_97)/4 >= selected_average) & (prelim_midterm+_80_97)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_80_97");
  new_prefinal = 80;
  new_final = 97;
}

if(((prelim_midterm+_80_98)/4 >= selected_average) & (prelim_midterm+_80_98)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_80_98");
  new_prefinal = 80;
  new_final = 98;
}

if(((prelim_midterm+_80_99)/4 >= selected_average) & (prelim_midterm+_80_99)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_80_99");
  new_prefinal = 80;
  new_final = 99;
}

if(((prelim_midterm+_80_100)/4 >= selected_average) & (prelim_midterm+_80_100)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_80_100");
  new_prefinal = 80;
  new_final = 100;
}


// 81

if(((prelim_midterm+_81_75)/4 >= selected_average) & (prelim_midterm+_81_75)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_81_75");
  new_prefinal = 81;
  new_final = 75;
}

if(((prelim_midterm+_81_76)/4 >= selected_average) & (prelim_midterm+_81_76)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_81_76");
  new_prefinal = 81;
  new_final = 76;
}

if(((prelim_midterm+_81_77)/4 >= selected_average) & (prelim_midterm+_81_77)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_81_77");
  new_prefinal = 81;
  new_final = 77;
}

if(((prelim_midterm+_81_78)/4 >= selected_average) & (prelim_midterm+_81_78)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_81_78");
  new_prefinal = 81;
  new_final = 78;
}

if(((prelim_midterm+_81_79)/4 >= selected_average) & (prelim_midterm+_81_79)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_81_79");
  new_prefinal = 81;
  new_final = 79;
}

if(((prelim_midterm+_81_80)/4 >= selected_average) & (prelim_midterm+_81_80)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_81_80");
  new_prefinal = 81;
  new_final = 80;
}

if(((prelim_midterm+_81_81)/4 >= selected_average) & (prelim_midterm+_81_81)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_81_81");
  new_prefinal = 81;
  new_final = 81;
}

if(((prelim_midterm+_81_82)/4 >= selected_average) & (prelim_midterm+_81_82)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_81_82");
  new_prefinal = 81;
  new_final = 82;
}

if(((prelim_midterm+_81_83)/4 >= selected_average) & (prelim_midterm+_81_83)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_81_83");
  new_prefinal = 81;
  new_final = 83;
}

if(((prelim_midterm+_81_84)/4 >= selected_average) & (prelim_midterm+_81_84)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_81_84");
  new_prefinal = 81;
  new_final = 84;
}

if(((prelim_midterm+_81_85)/4 >= selected_average) & (prelim_midterm+_81_85)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_81_85");
  new_prefinal = 81;
  new_final = 85;
}

if(((prelim_midterm+_81_86)/4 >= selected_average) & (prelim_midterm+_81_86)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_81_86");
  new_prefinal = 81;
  new_final = 86;
}

if(((prelim_midterm+_81_87)/4 >= selected_average) & (prelim_midterm+_81_87)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_81_87");
  new_prefinal = 81;
  new_final = 87;
}

if(((prelim_midterm+_81_88)/4 >= selected_average) & (prelim_midterm+_81_88)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_81_88");
  new_prefinal = 81;
  new_final = 88;
}

if(((prelim_midterm+_81_89)/4 >= selected_average) & (prelim_midterm+_81_89)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_81_89");
  new_prefinal = 81;
  new_final = 89;
}

if(((prelim_midterm+_81_90)/4 >= selected_average) & (prelim_midterm+_81_90)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_81_90");
  new_prefinal = 81;
  new_final = 90;
}

if(((prelim_midterm+_81_91)/4 >= selected_average) & (prelim_midterm+_81_91)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_81_91");
  new_prefinal = 81;
  new_final = 91;
}

if(((prelim_midterm+_81_92)/4 >= selected_average) & (prelim_midterm+_81_92)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_81_92");
  new_prefinal = 81;
  new_final = 92
}

if(((prelim_midterm+_81_93)/4 >= selected_average) & (prelim_midterm+_81_93)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_81_93");
  new_prefinal = 81;
  new_final = 93;
}

if(((prelim_midterm+_81_94)/4 >= selected_average) & (prelim_midterm+_81_94)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_81_94");
  new_prefinal = 81;
  new_final = 94;
}

if(((prelim_midterm+_81_95)/4 >= selected_average) & (prelim_midterm+_81_95)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_81_95");
  new_prefinal = 81;
  new_final = 95;
}

if(((prelim_midterm+_81_96)/4 >= selected_average) & (prelim_midterm+_81_96)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_81_96");
  new_prefinal = 81;
  new_final = 96;
}

if(((prelim_midterm+_81_97)/4 >= selected_average) & (prelim_midterm+_81_97)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_81_97");
  new_prefinal = 81;
  new_final = 97;
}

if(((prelim_midterm+_81_98)/4 >= selected_average) & (prelim_midterm+_81_98)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_81_98");
  new_prefinal = 81;
  new_final = 98;
}

if(((prelim_midterm+_81_99)/4 >= selected_average) & (prelim_midterm+_81_99)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_81_99");
  new_prefinal = 81;
  new_final = 99;
}

if(((prelim_midterm+_81_100)/4 >= selected_average) & (prelim_midterm+_81_100)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_81_100");
  new_prefinal = 81;
  new_final = 100;
}


// 82

if(((prelim_midterm+_82_75)/4 >= selected_average) & (prelim_midterm+_82_75)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_82_75");
  new_prefinal = 82;
  new_final = 75;
}

if(((prelim_midterm+_82_76)/4 >= selected_average) & (prelim_midterm+_82_76)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_82_76");
  new_prefinal = 82;
  new_final = 76;
}

if(((prelim_midterm+_82_77)/4 >= selected_average) & (prelim_midterm+_82_77)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_82_77");
  new_prefinal = 82;
  new_final = 77;
}

if(((prelim_midterm+_82_78)/4 >= selected_average) & (prelim_midterm+_82_78)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_82_78");
  new_prefinal = 82;
  new_final = 78;
}

if(((prelim_midterm+_82_79)/4 >= selected_average) & (prelim_midterm+_82_79)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_82_79");
  new_prefinal = 82;
  new_final = 79;
}

if(((prelim_midterm+_82_80)/4 >= selected_average) & (prelim_midterm+_82_80)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_82_80");
  new_prefinal = 82;
  new_final = 80;
}

if(((prelim_midterm+_82_81)/4 >= selected_average) & (prelim_midterm+_82_81)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_82_81");
  new_prefinal = 82;
  new_final = 81;
}

if(((prelim_midterm+_82_82)/4 >= selected_average) & (prelim_midterm+_82_82)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_82_82");
  new_prefinal = 82;
  new_final = 82;
}

if(((prelim_midterm+_82_83)/4 >= selected_average) & (prelim_midterm+_82_83)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_82_83");
  new_prefinal = 82;
  new_final = 83;
}

if(((prelim_midterm+_82_84)/4 >= selected_average) & (prelim_midterm+_82_84)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_82_84");
  new_prefinal = 82;
  new_final = 84;
}

if(((prelim_midterm+_82_85)/4 >= selected_average) & (prelim_midterm+_82_85)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_82_85");
  new_prefinal = 82;
  new_final = 85;
}

if(((prelim_midterm+_82_86)/4 >= selected_average) & (prelim_midterm+_82_86)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_82_86");
  new_prefinal = 82;
  new_final = 86;
}

if(((prelim_midterm+_82_87)/4 >= selected_average) & (prelim_midterm+_82_87)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_82_87");
  new_prefinal = 82;
  new_final = 87;
}

if(((prelim_midterm+_82_88)/4 >= selected_average) & (prelim_midterm+_82_88)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_82_88");
  new_prefinal = 82;
  new_final = 88;
}

if(((prelim_midterm+_82_89)/4 >= selected_average) & (prelim_midterm+_82_89)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_82_89");
  new_prefinal = 82;
  new_final = 89;
}

if(((prelim_midterm+_82_90)/4 >= selected_average) & (prelim_midterm+_82_90)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_82_90");
  new_prefinal = 82;
  new_final = 90;
}

if(((prelim_midterm+_82_91)/4 >= selected_average) & (prelim_midterm+_82_91)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_82_91");
  new_prefinal = 82;
  new_final = 91;
}

if(((prelim_midterm+_82_92)/4 >= selected_average) & (prelim_midterm+_82_92)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_82_92");
  new_prefinal = 82;
  new_final = 92;
}

if(((prelim_midterm+_82_93)/4 >= selected_average) & (prelim_midterm+_82_93)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_82_93");
  new_prefinal = 82;
  new_final = 93;
}

if(((prelim_midterm+_82_94)/4 >= selected_average) & (prelim_midterm+_82_94)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_82_94");
  new_prefinal = 82;
  new_final = 94;
}

if(((prelim_midterm+_82_95)/4 >= selected_average) & (prelim_midterm+_82_95)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_82_95");
  new_prefinal = 82;
  new_final = 95;
}

if(((prelim_midterm+_82_96)/4 >= selected_average) & (prelim_midterm+_82_96)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_82_96");
  new_prefinal = 82;
  new_final = 96;
}

if(((prelim_midterm+_82_97)/4 >= selected_average) & (prelim_midterm+_82_97)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_82_97");
  new_prefinal = 82;
  new_final = 97;
}

if(((prelim_midterm+_82_98)/4 >= selected_average) & (prelim_midterm+_82_98)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_82_98");
  new_prefinal = 82;
  new_final = 98;
}

if(((prelim_midterm+_82_99)/4 >= selected_average) & (prelim_midterm+_82_99)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_82_99");
  new_prefinal = 82;
  new_final = 99;
}

if(((prelim_midterm+_82_100)/4 >= selected_average) & (prelim_midterm+_82_100)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_82_100");
  new_prefinal = 82;
  new_final = 100;
}


// 83

if(((prelim_midterm+_83_75)/4 >= selected_average) & (prelim_midterm+_83_75)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_83_75");
  new_prefinal = 83;
  new_final = 75;
}

if(((prelim_midterm+_83_76)/4 >= selected_average) & (prelim_midterm+_83_76)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_83_76");
  new_prefinal = 83;
  new_final = 76;
}

if(((prelim_midterm+_83_77)/4 >= selected_average) & (prelim_midterm+_83_77)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_83_77");
  new_prefinal = 83;
  new_final = 77;
}

if(((prelim_midterm+_83_78)/4 >= selected_average) & (prelim_midterm+_83_78)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_83_78");
  new_prefinal = 83;
  new_final = 78;
}

if(((prelim_midterm+_83_79)/4 >= selected_average) & (prelim_midterm+_83_79)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_83_79");
  new_prefinal = 83;
  new_final = 79;
}

if(((prelim_midterm+_83_80)/4 >= selected_average) & (prelim_midterm+_83_80)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_83_80");
  new_prefinal = 83;
  new_final = 80;
}

if(((prelim_midterm+_83_81)/4 >= selected_average) & (prelim_midterm+_83_81)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_83_81");
  new_prefinal = 83;
  new_final = 81;
}

if(((prelim_midterm+_83_82)/4 >= selected_average) & (prelim_midterm+_83_82)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_83_82");
  new_prefinal = 83;
  new_final = 82;
}

if(((prelim_midterm+_83_83)/4 >= selected_average) & (prelim_midterm+_83_83)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_83_83");
  new_prefinal = 83;
  new_final = 83;
}

if(((prelim_midterm+_83_84)/4 >= selected_average) & (prelim_midterm+_83_84)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_83_84");
  new_prefinal = 83;
  new_final = 84;
}

if(((prelim_midterm+_83_85)/4 >= selected_average) & (prelim_midterm+_83_85)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_83_85");
  new_prefinal = 83;
  new_final = 85;
}

if(((prelim_midterm+_83_86)/4 >= selected_average) & (prelim_midterm+_83_86)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_83_86");
  new_prefinal = 83;
  new_final = 86;
}

if(((prelim_midterm+_83_87)/4 >= selected_average) & (prelim_midterm+_83_87)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_83_87");
  new_prefinal = 83;
  new_final = 87;
}

if(((prelim_midterm+_83_88)/4 >= selected_average) & (prelim_midterm+_83_88)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_83_88");
  new_prefinal = 83;
  new_final = 88;
}

if(((prelim_midterm+_83_89)/4 >= selected_average) & (prelim_midterm+_83_89)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_83_89");
  new_prefinal = 83;
  new_final = 89;
}

if(((prelim_midterm+_83_90)/4 >= selected_average) & (prelim_midterm+_83_90)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_83_90");
  new_prefinal = 83;
  new_final = 90;
}

if(((prelim_midterm+_83_91)/4 >= selected_average) & (prelim_midterm+_83_91)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_83_91");
  new_prefinal = 83;
  new_final = 91;
}

if(((prelim_midterm+_83_92)/4 >= selected_average) & (prelim_midterm+_83_92)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_83_92");
  new_prefinal = 83;
  new_final = 92;
}

if(((prelim_midterm+_83_93)/4 >= selected_average) & (prelim_midterm+_83_93)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_83_93");
  new_prefinal = 83;
  new_final = 93;
}

if(((prelim_midterm+_83_94)/4 >= selected_average) & (prelim_midterm+_83_94)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_83_94");
  new_prefinal = 83;
  new_final = 94;
}

if(((prelim_midterm+_83_95)/4 >= selected_average) & (prelim_midterm+_83_95)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_83_95");
  new_prefinal = 83;
  new_final = 95;
}

if(((prelim_midterm+_83_96)/4 >= selected_average) & (prelim_midterm+_83_96)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_83_96");
  new_prefinal = 83;
  new_final = 96;
}

if(((prelim_midterm+_83_97)/4 >= selected_average) & (prelim_midterm+_83_97)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_83_97");
  new_prefinal = 83;
  new_final = 97;
}

if(((prelim_midterm+_83_98)/4 >= selected_average) & (prelim_midterm+_83_98)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_83_98");
  new_prefinal = 83;
  new_final = 98;
}

if(((prelim_midterm+_83_99)/4 >= selected_average) & (prelim_midterm+_83_99)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_83_99");
  new_prefinal = 83;
  new_final = 99;
}

if(((prelim_midterm+_83_100)/4 >= selected_average) & (prelim_midterm+_83_100)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_83_100");
  new_prefinal = 83;
  new_final = 100;
}


// 84

if(((prelim_midterm+_84_75)/4 >= selected_average) & (prelim_midterm+_84_75)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_84_75");
  new_prefinal = 84;
  new_final = 75;
}

if(((prelim_midterm+_84_76)/4 >= selected_average) & (prelim_midterm+_84_76)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_84_76");
  new_prefinal = 84;
  new_final = 76;
}

if(((prelim_midterm+_84_77)/4 >= selected_average) & (prelim_midterm+_84_77)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_84_77");
  new_prefinal = 84;
  new_final = 77;
}

if(((prelim_midterm+_84_78)/4 >= selected_average) & (prelim_midterm+_84_78)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_84_78");
  new_prefinal = 84;
  new_final = 78;
}

if(((prelim_midterm+_84_79)/4 >= selected_average) & (prelim_midterm+_84_79)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_84_79");
  new_prefinal = 84;
  new_final = 79;
}

if(((prelim_midterm+_84_80)/4 >= selected_average) & (prelim_midterm+_84_80)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_84_80");
  new_prefinal = 84;
  new_final = 80;
}

if(((prelim_midterm+_84_81)/4 >= selected_average) & (prelim_midterm+_84_81)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_84_81");
  new_prefinal = 84;
  new_final = 81;
}

if(((prelim_midterm+_84_82)/4 >= selected_average) & (prelim_midterm+_84_82)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_84_82");
  new_prefinal = 84;
  new_final = 82;
}

if(((prelim_midterm+_84_83)/4 >= selected_average) & (prelim_midterm+_84_83)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_84_83");
  new_prefinal = 84;
  new_final = 83;
}

if(((prelim_midterm+_84_84)/4 >= selected_average) & (prelim_midterm+_84_84)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_84_84");
  new_prefinal = 84;
  new_final = 84;
}

if(((prelim_midterm+_84_85)/4 >= selected_average) & (prelim_midterm+_84_85)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_84_85");
  new_prefinal = 84;
  new_final = 85;
}

if(((prelim_midterm+_84_86)/4 >= selected_average) & (prelim_midterm+_84_86)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_84_86");
  new_prefinal = 84;
  new_final = 86;
}

if(((prelim_midterm+_84_87)/4 >= selected_average) & (prelim_midterm+_84_87)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_84_87");
  new_prefinal = 84;
  new_final = 87;
}

if(((prelim_midterm+_84_88)/4 >= selected_average) & (prelim_midterm+_84_88)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_84_88");
  new_prefinal = 84;
  new_final = 88;
}

if(((prelim_midterm+_84_89)/4 >= selected_average) & (prelim_midterm+_84_89)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_84_89");
  new_prefinal = 84;
  new_final = 89;
}

if(((prelim_midterm+_84_90)/4 >= selected_average) & (prelim_midterm+_84_90)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_84_90");
  new_prefinal = 84;
  new_final = 90;
}

if(((prelim_midterm+_84_91)/4 >= selected_average) & (prelim_midterm+_84_91)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_84_91");
  new_prefinal = 84;
  new_final = 91;
}

if(((prelim_midterm+_84_92)/4 >= selected_average) & (prelim_midterm+_84_92)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_84_92");
  new_prefinal = 84;
  new_final = 92;
}

if(((prelim_midterm+_84_93)/4 >= selected_average) & (prelim_midterm+_84_93)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_84_93");
  new_prefinal = 84;
  new_final = 93;
}

if(((prelim_midterm+_84_94)/4 >= selected_average) & (prelim_midterm+_84_94)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_84_94");
  new_prefinal = 84;
  new_final = 94;
}

if(((prelim_midterm+_84_95)/4 >= selected_average) & (prelim_midterm+_84_95)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_84_95");
  new_prefinal = 84;
  new_final = 95;
}

if(((prelim_midterm+_84_96)/4 >= selected_average) & (prelim_midterm+_84_96)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_84_96");
  new_prefinal = 84;
  new_final = 96;
}

if(((prelim_midterm+_84_97)/4 >= selected_average) & (prelim_midterm+_84_97)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_84_97");
  new_prefinal = 84;
  new_final = 97;
}

if(((prelim_midterm+_84_98)/4 >= selected_average) & (prelim_midterm+_84_98)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_84_98");
  new_prefinal = 84;
  new_final = 98;
}

if(((prelim_midterm+_84_99)/4 >= selected_average) & (prelim_midterm+_84_99)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_84_99");
  new_prefinal = 84;
  new_final = 99;
}

if(((prelim_midterm+_84_100)/4 >= selected_average) & (prelim_midterm+_84_100)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_84_100");
  new_prefinal = 84;
  new_final = 100;
}


// 85

if(((prelim_midterm+_85_75)/4 >= selected_average) & (prelim_midterm+_85_75)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_85_75");
  new_prefinal = 85;
  new_final = 75;
}

if(((prelim_midterm+_85_76)/4 >= selected_average) & (prelim_midterm+_85_76)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_85_76");
  new_prefinal = 85;
  new_final = 76;
}

if(((prelim_midterm+_85_77)/4 >= selected_average) & (prelim_midterm+_85_77)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_85_77");
  new_prefinal = 85;
  new_final = 77;
}

if(((prelim_midterm+_85_78)/4 >= selected_average) & (prelim_midterm+_85_78)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_85_78");
  new_prefinal = 85;
  new_final = 78;
}

if(((prelim_midterm+_85_79)/4 >= selected_average) & (prelim_midterm+_85_79)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_85_79");
  new_prefinal = 85;
  new_final = 79;
}

if(((prelim_midterm+_85_80)/4 >= selected_average) & (prelim_midterm+_85_80)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_85_80");
  new_prefinal = 85;
  new_final = 80;
}

if(((prelim_midterm+_85_81)/4 >= selected_average) & (prelim_midterm+_85_81)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_85_81");
  new_prefinal = 85;
  new_final = 81;
}

if(((prelim_midterm+_85_82)/4 >= selected_average) & (prelim_midterm+_85_82)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_85_82");
  new_prefinal = 85;
  new_final = 82;
}

if(((prelim_midterm+_85_83)/4 >= selected_average) & (prelim_midterm+_85_83)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_85_83");
  new_prefinal = 85;
  new_final = 83;
}

if(((prelim_midterm+_85_84)/4 >= selected_average) & (prelim_midterm+_85_84)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_85_84");
  new_prefinal = 85;
  new_final = 84;
}

if(((prelim_midterm+_85_85)/4 >= selected_average) & (prelim_midterm+_85_85)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_85_85");
  new_prefinal = 85;
  new_final = 85;
}

if(((prelim_midterm+_85_86)/4 >= selected_average) & (prelim_midterm+_85_86)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_85_86");
  new_prefinal = 85;
  new_final = 86;
}

if(((prelim_midterm+_85_87)/4 >= selected_average) & (prelim_midterm+_85_87)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_85_87");
  new_prefinal = 85;
  new_final = 87;
}

if(((prelim_midterm+_85_88)/4 >= selected_average) & (prelim_midterm+_85_88)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_85_88");
  new_prefinal = 85;
  new_final = 88;
}

if(((prelim_midterm+_85_89)/4 >= selected_average) & (prelim_midterm+_85_89)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_85_89");
  new_prefinal = 85;
  new_final = 89;
}

if(((prelim_midterm+_85_90)/4 >= selected_average) & (prelim_midterm+_85_90)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_85_90");
  new_prefinal = 85;
  new_final = 90;
}

if(((prelim_midterm+_85_91)/4 >= selected_average) & (prelim_midterm+_85_91)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_85_91");
  new_prefinal = 85;
  new_final = 91;
}

if(((prelim_midterm+_85_92)/4 >= selected_average) & (prelim_midterm+_85_92)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_85_92");
  new_prefinal = 85;
  new_final = 92;
}

if(((prelim_midterm+_85_93)/4 >= selected_average) & (prelim_midterm+_85_93)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_85_93");
  new_prefinal = 85;
  new_final = 93;
}

if(((prelim_midterm+_85_94)/4 >= selected_average) & (prelim_midterm+_85_94)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_85_94");
  new_prefinal = 85;
  new_final = 94;
}

if(((prelim_midterm+_85_95)/4 >= selected_average) & (prelim_midterm+_85_95)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_85_95");
  new_prefinal = 85;
  new_final = 95;
}

if(((prelim_midterm+_85_96)/4 >= selected_average) & (prelim_midterm+_85_96)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_85_96");
  new_prefinal = 85;
  new_final = 96;
}

if(((prelim_midterm+_85_97)/4 >= selected_average) & (prelim_midterm+_85_97)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_85_97");
  new_prefinal = 85;
  new_final = 97;
}

if(((prelim_midterm+_85_98)/4 >= selected_average) & (prelim_midterm+_85_98)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_85_98");
  new_prefinal = 85;
  new_final = 98;
}

if(((prelim_midterm+_85_99)/4 >= selected_average) & (prelim_midterm+_85_99)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_85_99");
  new_prefinal = 85;
  new_final = 99;
}

if(((prelim_midterm+_85_100)/4 >= selected_average) & (prelim_midterm+_85_100)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_85_100");
  new_prefinal = 85;
  new_final = 100;
}


// 86

if(((prelim_midterm+_86_75)/4 >= selected_average) & (prelim_midterm+_86_75)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_86_75");
  new_prefinal = 86;
  new_final = 75;
}

if(((prelim_midterm+_86_76)/4 >= selected_average) & (prelim_midterm+_86_76)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_86_76");
  new_prefinal = 86;
  new_final = 76;
}

if(((prelim_midterm+_86_77)/4 >= selected_average) & (prelim_midterm+_86_77)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_86_77");
  new_prefinal = 86;
  new_final = 77;
}

if(((prelim_midterm+_86_78)/4 >= selected_average) & (prelim_midterm+_86_78)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_86_78");
  new_prefinal = 86;
  new_final = 78;
}

if(((prelim_midterm+_86_79)/4 >= selected_average) & (prelim_midterm+_86_79)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_86_79");
  new_prefinal = 86;
  new_final = 79;
}

if(((prelim_midterm+_86_80)/4 >= selected_average) & (prelim_midterm+_86_80)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_86_80");
  new_prefinal = 86;
  new_final = 80;
}

if(((prelim_midterm+_86_81)/4 >= selected_average) & (prelim_midterm+_86_81)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_86_81");
  new_prefinal = 86;
  new_final = 81;
}

if(((prelim_midterm+_86_82)/4 >= selected_average) & (prelim_midterm+_86_82)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_86_82");
  new_prefinal = 86;
  new_final = 82;
}

if(((prelim_midterm+_86_83)/4 >= selected_average) & (prelim_midterm+_86_83)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_86_83");
  new_prefinal = 86;
  new_final = 83;
}

if(((prelim_midterm+_86_84)/4 >= selected_average) & (prelim_midterm+_86_84)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_86_84");
  new_prefinal = 86;
  new_final = 84;
}

if(((prelim_midterm+_86_85)/4 >= selected_average) & (prelim_midterm+_86_85)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_86_85");
  new_prefinal = 86;
  new_final = 85;
}

if(((prelim_midterm+_86_86)/4 >= selected_average) & (prelim_midterm+_86_86)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_86_86");
  new_prefinal = 86;
  new_final = 86;
}

if(((prelim_midterm+_86_87)/4 >= selected_average) & (prelim_midterm+_86_87)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_86_87");
  new_prefinal = 86;
  new_final = 87;
}

if(((prelim_midterm+_86_88)/4 >= selected_average) & (prelim_midterm+_86_88)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_86_88");
  new_prefinal = 86;
  new_final = 88;
}

if(((prelim_midterm+_86_89)/4 >= selected_average) & (prelim_midterm+_86_89)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_86_89");
  new_prefinal = 86;
  new_final = 89;
}

if(((prelim_midterm+_86_90)/4 >= selected_average) & (prelim_midterm+_86_90)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_86_90");
  new_prefinal = 86;
  new_final = 90;
}

if(((prelim_midterm+_86_91)/4 >= selected_average) & (prelim_midterm+_86_91)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_86_91");
  new_prefinal = 86;
  new_final = 91;
}

if(((prelim_midterm+_86_92)/4 >= selected_average) & (prelim_midterm+_86_92)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_86_92");
  new_prefinal = 86;
  new_final = 92;
}

if(((prelim_midterm+_86_93)/4 >= selected_average) & (prelim_midterm+_86_93)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_86_93");
  new_prefinal = 86;
  new_final = 93;
}

if(((prelim_midterm+_86_94)/4 >= selected_average) & (prelim_midterm+_86_94)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_86_94");
  new_prefinal = 86;
  new_final = 94;
}

if(((prelim_midterm+_86_95)/4 >= selected_average) & (prelim_midterm+_86_95)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_86_95");
  new_prefinal = 86;
  new_final = 95;
}

if(((prelim_midterm+_86_96)/4 >= selected_average) & (prelim_midterm+_86_96)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_86_96");
  new_prefinal = 86;
  new_final = 96;
}

if(((prelim_midterm+_86_97)/4 >= selected_average) & (prelim_midterm+_86_97)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_86_97");
  new_prefinal = 86;
  new_final = 97;
}

if(((prelim_midterm+_86_98)/4 >= selected_average) & (prelim_midterm+_86_98)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_86_98");
  new_prefinal = 86;
  new_final = 98;
}

if(((prelim_midterm+_86_99)/4 >= selected_average) & (prelim_midterm+_86_99)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_86_99");
  new_prefinal = 86;
  new_final = 99;
}

if(((prelim_midterm+_86_100)/4 >= selected_average) & (prelim_midterm+_86_100)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_86_100");
  new_prefinal = 86;
  new_final = 100;
}


// 87

if(((prelim_midterm+_87_75)/4 >= selected_average) & (prelim_midterm+_87_75)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_87_75");
  new_prefinal = 87;
  new_final = 75;
}

if(((prelim_midterm+_87_76)/4 >= selected_average) & (prelim_midterm+_87_76)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_87_76");
  new_prefinal = 87;
  new_final = 76;
}

if(((prelim_midterm+_87_77)/4 >= selected_average) & (prelim_midterm+_87_77)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_87_77");
  new_prefinal = 87;
  new_final = 77;
}

if(((prelim_midterm+_87_78)/4 >= selected_average) & (prelim_midterm+_87_78)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_87_78");
  new_prefinal = 87;
  new_final = 78;
}

if(((prelim_midterm+_87_79)/4 >= selected_average) & (prelim_midterm+_87_79)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_87_79");
  new_prefinal = 87;
  new_final = 79;
}

if(((prelim_midterm+_87_80)/4 >= selected_average) & (prelim_midterm+_87_80)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_87_80");
  new_prefinal = 87;
  new_final = 80;
}

if(((prelim_midterm+_87_81)/4 >= selected_average) & (prelim_midterm+_87_81)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_87_81");
  new_prefinal = 87;
  new_final = 81;
}

if(((prelim_midterm+_87_82)/4 >= selected_average) & (prelim_midterm+_87_82)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_87_82");
  new_prefinal = 87;
  new_final = 82;
}

if(((prelim_midterm+_87_83)/4 >= selected_average) & (prelim_midterm+_87_83)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_87_83");
  new_prefinal = 87;
  new_final = 83;
}

if(((prelim_midterm+_87_84)/4 >= selected_average) & (prelim_midterm+_87_84)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_87_84");
  new_prefinal = 87;
  new_final = 84;
}

if(((prelim_midterm+_87_85)/4 >= selected_average) & (prelim_midterm+_87_85)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_87_85");
  new_prefinal = 87;
  new_final = 85;
}

if(((prelim_midterm+_87_86)/4 >= selected_average) & (prelim_midterm+_87_86)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_87_86");
  new_prefinal = 87;
  new_final = 86;
}

if(((prelim_midterm+_87_87)/4 >= selected_average) & (prelim_midterm+_87_87)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_87_87");
  new_prefinal = 87;
  new_final = 87;
}

if(((prelim_midterm+_87_88)/4 >= selected_average) & (prelim_midterm+_87_88)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_87_88");
  new_prefinal = 87;
  new_final = 88;
}

if(((prelim_midterm+_87_89)/4 >= selected_average) & (prelim_midterm+_87_89)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_87_89");
  new_prefinal = 87;
  new_final = 89;
}

if(((prelim_midterm+_87_90)/4 >= selected_average) & (prelim_midterm+_87_90)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_87_90");
  new_prefinal = 87;
  new_final = 90;
}

if(((prelim_midterm+_87_91)/4 >= selected_average) & (prelim_midterm+_87_91)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_87_91");
  new_prefinal = 87;
  new_final = 91;
}

if(((prelim_midterm+_87_92)/4 >= selected_average) & (prelim_midterm+_87_92)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_87_92");
  new_prefinal = 87;
  new_final = 92;
}

if(((prelim_midterm+_87_93)/4 >= selected_average) & (prelim_midterm+_87_93)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_87_93");
  new_prefinal = 87;
  new_final = 93;
}

if(((prelim_midterm+_87_94)/4 >= selected_average) & (prelim_midterm+_87_94)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_87_94");
  new_prefinal = 87;
  new_final = 94;
}

if(((prelim_midterm+_87_95)/4 >= selected_average) & (prelim_midterm+_87_95)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_87_95");
  new_prefinal = 87;
  new_final = 95;
}

if(((prelim_midterm+_87_96)/4 >= selected_average) & (prelim_midterm+_87_96)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_87_96");
  new_prefinal = 87;
  new_final = 96;
}

if(((prelim_midterm+_87_97)/4 >= selected_average) & (prelim_midterm+_87_97)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_87_97");
  new_prefinal = 87;
  new_final = 97;
}

if(((prelim_midterm+_87_98)/4 >= selected_average) & (prelim_midterm+_87_98)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_87_98");
  new_prefinal = 87;
  new_final = 98;
}

if(((prelim_midterm+_87_99)/4 >= selected_average) & (prelim_midterm+_87_99)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_87_99");
  new_prefinal = 87;
  new_final = 99;
}

if(((prelim_midterm+_87_100)/4 >= selected_average) & (prelim_midterm+_87_100)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_87_100");
  new_prefinal = 87;
  new_final = 100;
}


// 88

if(((prelim_midterm+_88_75)/4 >= selected_average) & (prelim_midterm+_88_75)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_88_75");
  new_prefinal = 88;
  new_final = 75;
}

if(((prelim_midterm+_88_76)/4 >= selected_average) & (prelim_midterm+_88_76)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_88_76");
  new_prefinal = 88;
  new_final = 76;
}

if(((prelim_midterm+_88_77)/4 >= selected_average) & (prelim_midterm+_88_77)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_88_77");
  new_prefinal = 88;
  new_final = 77;
}

if(((prelim_midterm+_88_78)/4 >= selected_average) & (prelim_midterm+_88_78)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_88_78");
  new_prefinal = 88;
  new_final = 78;
}

if(((prelim_midterm+_88_79)/4 >= selected_average) & (prelim_midterm+_88_79)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_88_79");
  new_prefinal = 88;
  new_final = 79;
}

if(((prelim_midterm+_88_80)/4 >= selected_average) & (prelim_midterm+_88_80)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_88_80");
  new_prefinal = 88;
  new_final = 80;
}

if(((prelim_midterm+_88_81)/4 >= selected_average) & (prelim_midterm+_88_81)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_88_81");
  new_prefinal = 88;
  new_final = 81;
}

if(((prelim_midterm+_88_82)/4 >= selected_average) & (prelim_midterm+_88_82)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_88_82");
  new_prefinal = 88;
  new_final = 82;
}

if(((prelim_midterm+_88_83)/4 >= selected_average) & (prelim_midterm+_88_83)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_88_83");
  new_prefinal = 88;
  new_final = 83;
}

if(((prelim_midterm+_88_84)/4 >= selected_average) & (prelim_midterm+_88_84)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_88_84");
  new_prefinal = 88;
  new_final = 84;
}

if(((prelim_midterm+_88_85)/4 >= selected_average) & (prelim_midterm+_88_85)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_88_85");
  new_prefinal = 88;
  new_final = 85;
}

if(((prelim_midterm+_88_86)/4 >= selected_average) & (prelim_midterm+_88_86)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_88_86");
  new_prefinal = 88;
  new_final = 86;
}

if(((prelim_midterm+_88_87)/4 >= selected_average) & (prelim_midterm+_88_87)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_88_87");
  new_prefinal = 88;
  new_final = 87;
}

if(((prelim_midterm+_88_88)/4 >= selected_average) & (prelim_midterm+_88_88)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_88_88");
  new_prefinal = 88;
  new_final = 88;
}

if(((prelim_midterm+_88_89)/4 >= selected_average) & (prelim_midterm+_88_89)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_88_89");
  new_prefinal = 88;
  new_final = 89;
}

if(((prelim_midterm+_88_90)/4 >= selected_average) & (prelim_midterm+_88_90)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_88_90");
  new_prefinal = 88;
  new_final = 90;
}

if(((prelim_midterm+_88_91)/4 >= selected_average) & (prelim_midterm+_88_91)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_88_91");
  new_prefinal = 88;
  new_final = 91;
}

if(((prelim_midterm+_88_92)/4 >= selected_average) & (prelim_midterm+_88_92)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_88_92");
  new_prefinal = 88;
  new_final = 92;
}

if(((prelim_midterm+_88_93)/4 >= selected_average) & (prelim_midterm+_88_93)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_88_93");
  new_prefinal = 88;
  new_final = 93;
}

if(((prelim_midterm+_88_94)/4 >= selected_average) & (prelim_midterm+_88_94)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_88_94");
  new_prefinal = 88;
  new_final = 94;
}

if(((prelim_midterm+_88_95)/4 >= selected_average) & (prelim_midterm+_88_95)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_88_95");
  new_prefinal = 88;
  new_final = 95;
}

if(((prelim_midterm+_88_96)/4 >= selected_average) & (prelim_midterm+_88_96)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_88_96");
  new_prefinal = 88;
  new_final = 96;
}

if(((prelim_midterm+_88_97)/4 >= selected_average) & (prelim_midterm+_88_97)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_88_97");
  new_prefinal = 88;
  new_final = 97;
}

if(((prelim_midterm+_88_98)/4 >= selected_average) & (prelim_midterm+_88_98)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_88_98");
  new_prefinal = 88;
  new_final = 98;
}

if(((prelim_midterm+_88_99)/4 >= selected_average) & (prelim_midterm+_88_99)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_88_99");
  new_prefinal = 88;
  new_final = 99;
}

if(((prelim_midterm+_88_100)/4 >= selected_average) & (prelim_midterm+_88_100)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_88_100");
  new_prefinal = 88;
  new_final = 100;
}


// 89

if(((prelim_midterm+_89_75)/4 >= selected_average) & (prelim_midterm+_89_75)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_89_75");
  new_prefinal = 89;
  new_final = 75;
}

if(((prelim_midterm+_89_76)/4 >= selected_average) & (prelim_midterm+_89_76)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_89_76");
  new_prefinal = 89;
  new_final = 76;
}

if(((prelim_midterm+_89_77)/4 >= selected_average) & (prelim_midterm+_89_77)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_89_77");
  new_prefinal = 89;
  new_final = 77;
}

if(((prelim_midterm+_89_78)/4 >= selected_average) & (prelim_midterm+_89_78)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_89_78");
  new_prefinal = 89;
  new_final = 78;
}

if(((prelim_midterm+_89_79)/4 >= selected_average) & (prelim_midterm+_89_79)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_89_79");
  new_prefinal = 89;
  new_final = 79;
}

if(((prelim_midterm+_89_80)/4 >= selected_average) & (prelim_midterm+_89_80)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_89_80");
  new_prefinal = 89;
  new_final = 80;
}

if(((prelim_midterm+_89_81)/4 >= selected_average) & (prelim_midterm+_89_81)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_89_81");
  new_prefinal = 89;
  new_final = 81;
}

if(((prelim_midterm+_89_82)/4 >= selected_average) & (prelim_midterm+_89_82)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_89_82");
  new_prefinal = 89;
  new_final = 82;
}

if(((prelim_midterm+_89_83)/4 >= selected_average) & (prelim_midterm+_89_83)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_89_83");
  new_prefinal = 89;
  new_final = 83;
}

if(((prelim_midterm+_89_84)/4 >= selected_average) & (prelim_midterm+_89_84)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_89_84");
  new_prefinal = 89;
  new_final = 84;
}

if(((prelim_midterm+_89_85)/4 >= selected_average) & (prelim_midterm+_89_85)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_89_85");
  new_prefinal = 89;
  new_final = 85;
}

if(((prelim_midterm+_89_86)/4 >= selected_average) & (prelim_midterm+_89_86)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_89_86");
  new_prefinal = 89;
  new_final = 86;
}

if(((prelim_midterm+_89_87)/4 >= selected_average) & (prelim_midterm+_89_87)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_89_87");
  new_prefinal = 89;
  new_final = 87;
}

if(((prelim_midterm+_89_88)/4 >= selected_average) & (prelim_midterm+_89_88)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_89_88");
  new_prefinal = 89;
  new_final = 88;
}

if(((prelim_midterm+_89_89)/4 >= selected_average) & (prelim_midterm+_89_89)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_89_89");
  new_prefinal = 89;
  new_final = 89;
}

if(((prelim_midterm+_89_90)/4 >= selected_average) & (prelim_midterm+_89_90)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_89_90");
  new_prefinal = 89;
  new_final = 90;
}

if(((prelim_midterm+_89_91)/4 >= selected_average) & (prelim_midterm+_89_91)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_89_91");
  new_prefinal = 89;
  new_final = 91;
}

if(((prelim_midterm+_89_92)/4 >= selected_average) & (prelim_midterm+_89_92)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_89_92");
  new_prefinal = 89;
  new_final = 92;
}

if(((prelim_midterm+_89_93)/4 >= selected_average) & (prelim_midterm+_89_93)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_89_93");
  new_prefinal = 89;
  new_final = 93;
}

if(((prelim_midterm+_89_94)/4 >= selected_average) & (prelim_midterm+_89_94)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_89_94");
  new_prefinal = 89;
  new_final = 94;
}

if(((prelim_midterm+_89_95)/4 >= selected_average) & (prelim_midterm+_89_95)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_89_95");
  new_prefinal = 89;
  new_final = 95;
}

if(((prelim_midterm+_89_96)/4 >= selected_average) & (prelim_midterm+_89_96)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_89_96");
  new_prefinal = 89;
  new_final = 96;
}

if(((prelim_midterm+_89_97)/4 >= selected_average) & (prelim_midterm+_89_97)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_89_97");
  new_prefinal = 89;
  new_final = 97;
}

if(((prelim_midterm+_89_98)/4 >= selected_average) & (prelim_midterm+_89_98)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_89_98");
  new_prefinal = 89;
  new_final = 98;
}

if(((prelim_midterm+_89_99)/4 >= selected_average) & (prelim_midterm+_89_99)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_89_99");
  new_prefinal = 89;
  new_final = 99;
}

if(((prelim_midterm+_89_100)/4 >= selected_average) & (prelim_midterm+_89_100)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_89_100");
  new_prefinal = 89;
  new_final = 100;
}


// 90

if(((prelim_midterm+_90_75)/4 >= selected_average) & (prelim_midterm+_90_75)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_90_75");
  new_prefinal = 90;
  new_final = 75;
}

if(((prelim_midterm+_90_76)/4 >= selected_average) & (prelim_midterm+_90_76)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_90_76");
  new_prefinal = 90;
  new_final = 76;
}

if(((prelim_midterm+_90_77)/4 >= selected_average) & (prelim_midterm+_90_77)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_90_77");
  new_prefinal = 90;
  new_final = 77;
}

if(((prelim_midterm+_90_78)/4 >= selected_average) & (prelim_midterm+_90_78)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_90_78");
  new_prefinal = 90;
  new_final = 78;
}

if(((prelim_midterm+_90_79)/4 >= selected_average) & (prelim_midterm+_90_79)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_90_79");
  new_prefinal = 90;
  new_final = 79;
}

if(((prelim_midterm+_90_80)/4 >= selected_average) & (prelim_midterm+_90_80)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_90_80");
  new_prefinal = 90;
  new_final = 80;
}

if(((prelim_midterm+_90_81)/4 >= selected_average) & (prelim_midterm+_90_81)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_90_81");
  new_prefinal = 90;
  new_final = 81;
}

if(((prelim_midterm+_90_82)/4 >= selected_average) & (prelim_midterm+_90_82)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_90_82");
  new_prefinal = 90;
  new_final = 82;
}

if(((prelim_midterm+_90_83)/4 >= selected_average) & (prelim_midterm+_90_83)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_90_83");
  new_prefinal = 90;
  new_final = 83;
}

if(((prelim_midterm+_90_84)/4 >= selected_average) & (prelim_midterm+_90_84)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_90_84");
  new_prefinal = 90;
  new_final = 84;
}

if(((prelim_midterm+_90_85)/4 >= selected_average) & (prelim_midterm+_90_85)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_90_85");
  new_prefinal = 90;
  new_final = 85;
}

if(((prelim_midterm+_90_86)/4 >= selected_average) & (prelim_midterm+_90_86)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_90_86");
  new_prefinal = 90;
  new_final = 86;
}

if(((prelim_midterm+_90_87)/4 >= selected_average) & (prelim_midterm+_90_87)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_90_87");
  new_prefinal = 90;
  new_final = 87;
}

if(((prelim_midterm+_90_88)/4 >= selected_average) & (prelim_midterm+_90_88)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_90_88");
  new_prefinal = 90;
  new_final = 88;
}

if(((prelim_midterm+_90_89)/4 >= selected_average) & (prelim_midterm+_90_89)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_90_89");
  new_prefinal = 90;
  new_final = 89;
}

if(((prelim_midterm+_90_90)/4 >= selected_average) & (prelim_midterm+_90_90)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_90_90");
  new_prefinal = 90;
  new_final = 90;
}

if(((prelim_midterm+_90_91)/4 >= selected_average) & (prelim_midterm+_90_91)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_90_91");
  new_prefinal = 90;
  new_final = 91;
}

if(((prelim_midterm+_90_92)/4 >= selected_average) & (prelim_midterm+_90_92)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_90_92");
  new_prefinal = 90;
  new_final = 92;
}

if(((prelim_midterm+_90_93)/4 >= selected_average) & (prelim_midterm+_90_93)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_90_93");
  new_prefinal = 90;
  new_final = 93;
}

if(((prelim_midterm+_90_94)/4 >= selected_average) & (prelim_midterm+_90_94)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_90_94");
  new_prefinal = 90;
  new_final = 94;
}

if(((prelim_midterm+_90_95)/4 >= selected_average) & (prelim_midterm+_90_95)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_90_95");
  new_prefinal = 90;
  new_final = 95;
}

if(((prelim_midterm+_90_96)/4 >= selected_average) & (prelim_midterm+_90_96)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_90_96");
  new_prefinal = 90;
  new_final = 96;
}

if(((prelim_midterm+_90_97)/4 >= selected_average) & (prelim_midterm+_90_97)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_90_97");
  new_prefinal = 90;
  new_final = 97;
}

if(((prelim_midterm+_90_98)/4 >= selected_average) & (prelim_midterm+_90_98)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_90_98");
  new_prefinal = 90;
  new_final = 98;
}

if(((prelim_midterm+_90_99)/4 >= selected_average) & (prelim_midterm+_90_99)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_90_99");
  new_prefinal = 90;
  new_final = 99;
}

if(((prelim_midterm+_90_100)/4 >= selected_average) & (prelim_midterm+_90_100)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_90_100");
  new_prefinal = 90;
  new_final = 100;
}


// 91

if(((prelim_midterm+_91_75)/4 >= selected_average) & (prelim_midterm+_91_75)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_91_75");
  new_prefinal = 91;
  new_final = 75;
}

if(((prelim_midterm+_91_76)/4 >= selected_average) & (prelim_midterm+_91_76)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_91_76");
  new_prefinal = 91;
  new_final = 76;
}

if(((prelim_midterm+_91_77)/4 >= selected_average) & (prelim_midterm+_91_77)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_91_77");
  new_prefinal = 91;
  new_final = 77;
}

if(((prelim_midterm+_91_78)/4 >= selected_average) & (prelim_midterm+_91_78)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_91_78");
  new_prefinal = 91;
  new_final = 78;
}

if(((prelim_midterm+_91_79)/4 >= selected_average) & (prelim_midterm+_91_79)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_91_79");
  new_prefinal = 91;
  new_final = 79;
}

if(((prelim_midterm+_91_80)/4 >= selected_average) & (prelim_midterm+_91_80)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_91_80");
  new_prefinal = 91;
  new_final = 80;
}

if(((prelim_midterm+_91_81)/4 >= selected_average) & (prelim_midterm+_91_81)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_91_81");
  new_prefinal = 91;
  new_final = 81;
}

if(((prelim_midterm+_91_82)/4 >= selected_average) & (prelim_midterm+_91_82)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_91_82");
  new_prefinal = 91;
  new_final = 82;
}

if(((prelim_midterm+_91_83)/4 >= selected_average) & (prelim_midterm+_91_83)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_91_83");
  new_prefinal = 91;
  new_final = 83;
}

if(((prelim_midterm+_91_84)/4 >= selected_average) & (prelim_midterm+_91_84)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_91_84");
  new_prefinal = 91;
  new_final = 84;
}

if(((prelim_midterm+_91_85)/4 >= selected_average) & (prelim_midterm+_91_85)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_91_85");
  new_prefinal = 91;
  new_final = 85;
}

if(((prelim_midterm+_91_86)/4 >= selected_average) & (prelim_midterm+_91_86)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_91_86");
  new_prefinal = 91;
  new_final = 86;
}

if(((prelim_midterm+_91_87)/4 >= selected_average) & (prelim_midterm+_91_87)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_91_87");
  new_prefinal = 91;
  new_final = 87;
}

if(((prelim_midterm+_91_88)/4 >= selected_average) & (prelim_midterm+_91_88)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_91_88");
  new_prefinal = 91;
  new_final = 88;
}

if(((prelim_midterm+_91_89)/4 >= selected_average) & (prelim_midterm+_91_89)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_91_89");
  new_prefinal = 91;
  new_final = 89;
}

if(((prelim_midterm+_91_90)/4 >= selected_average) & (prelim_midterm+_91_90)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_91_90");
  new_prefinal = 91;
  new_final = 90;
}

if(((prelim_midterm+_91_91)/4 >= selected_average) & (prelim_midterm+_91_91)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_91_91");
  new_prefinal = 91;
  new_final = 91;
}

if(((prelim_midterm+_91_92)/4 >= selected_average) & (prelim_midterm+_91_92)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_91_92");
  new_prefinal = 91;
  new_final = 92;
}

if(((prelim_midterm+_91_93)/4 >= selected_average) & (prelim_midterm+_91_93)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_91_93");
  new_prefinal = 91;
  new_final = 93;
}

if(((prelim_midterm+_91_94)/4 >= selected_average) & (prelim_midterm+_91_94)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_91_94");
  new_prefinal = 91;
  new_final = 94;
}

if(((prelim_midterm+_91_95)/4 >= selected_average) & (prelim_midterm+_91_95)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_91_95");
  new_prefinal = 91;
  new_final = 95;
}

if(((prelim_midterm+_91_96)/4 >= selected_average) & (prelim_midterm+_91_96)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_91_96");
  new_prefinal = 91;
  new_final = 96;
}

if(((prelim_midterm+_91_97)/4 >= selected_average) & (prelim_midterm+_91_97)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_91_97");
  new_prefinal = 91;
  new_final = 97;
}

if(((prelim_midterm+_91_98)/4 >= selected_average) & (prelim_midterm+_91_98)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_91_98");
  new_prefinal = 91;
  new_final = 98;
}

if(((prelim_midterm+_91_99)/4 >= selected_average) & (prelim_midterm+_91_99)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_91_99");
  new_prefinal = 91;
  new_final = 99;
}

if(((prelim_midterm+_91_100)/4 >= selected_average) & (prelim_midterm+_91_100)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_91_100");
  new_prefinal = 91;
  new_final = 100;
}


// 92

if(((prelim_midterm+_92_75)/4 >= selected_average) & (prelim_midterm+_92_75)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_92_75");
  new_prefinal = 92;
  new_final = 75;
}

if(((prelim_midterm+_92_76)/4 >= selected_average) & (prelim_midterm+_92_76)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_92_76");
  new_prefinal = 92;
  new_final = 76;
}

if(((prelim_midterm+_92_77)/4 >= selected_average) & (prelim_midterm+_92_77)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_92_77");
  new_prefinal = 92;
  new_final = 77;
}

if(((prelim_midterm+_92_78)/4 >= selected_average) & (prelim_midterm+_92_78)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_92_78");
  new_prefinal = 92;
  new_final = 78;
}

if(((prelim_midterm+_92_79)/4 >= selected_average) & (prelim_midterm+_92_79)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_92_79");
  new_prefinal = 92;
  new_final = 79;
}

if(((prelim_midterm+_92_80)/4 >= selected_average) & (prelim_midterm+_92_80)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_92_80");
  new_prefinal = 92;
  new_final = 80;
}

if(((prelim_midterm+_92_81)/4 >= selected_average) & (prelim_midterm+_92_81)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_92_81");
  new_prefinal = 92;
  new_final = 81;
}

if(((prelim_midterm+_92_82)/4 >= selected_average) & (prelim_midterm+_92_82)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_92_82");
  new_prefinal = 92;
  new_final = 82;
}

if(((prelim_midterm+_92_83)/4 >= selected_average) & (prelim_midterm+_92_83)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_92_83");
  new_prefinal = 92;
  new_final = 83;
}

if(((prelim_midterm+_92_84)/4 >= selected_average) & (prelim_midterm+_92_84)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_92_84");
  new_prefinal = 92;
  new_final = 84;
}

if(((prelim_midterm+_92_85)/4 >= selected_average) & (prelim_midterm+_92_85)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_92_85");
  new_prefinal = 92;
  new_final = 85;
}

if(((prelim_midterm+_92_86)/4 >= selected_average) & (prelim_midterm+_92_86)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_92_86");
  new_prefinal = 92;
  new_final = 86;
}

if(((prelim_midterm+_92_87)/4 >= selected_average) & (prelim_midterm+_92_87)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_92_87");
  new_prefinal = 92;
  new_final = 87;
}

if(((prelim_midterm+_92_88)/4 >= selected_average) & (prelim_midterm+_92_88)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_92_88");
  new_prefinal = 92;
  new_final = 88;
}

if(((prelim_midterm+_92_89)/4 >= selected_average) & (prelim_midterm+_92_89)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_92_89");
  new_prefinal = 92;
  new_final = 89;
}

if(((prelim_midterm+_92_90)/4 >= selected_average) & (prelim_midterm+_92_90)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_92_90");
  new_prefinal = 92;
  new_final = 90;
}

if(((prelim_midterm+_92_91)/4 >= selected_average) & (prelim_midterm+_92_91)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_92_91");
  new_prefinal = 92;
  new_final = 91;
}

if(((prelim_midterm+_92_92)/4 >= selected_average) & (prelim_midterm+_92_92)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_92_92");
  new_prefinal = 92;
  new_final = 92;
}

if(((prelim_midterm+_92_93)/4 >= selected_average) & (prelim_midterm+_92_93)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_92_93");
  new_prefinal = 92;
  new_final = 93;
}

if(((prelim_midterm+_92_94)/4 >= selected_average) & (prelim_midterm+_92_94)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_92_94");
  new_prefinal = 92;
  new_final = 94;
}

if(((prelim_midterm+_92_95)/4 >= selected_average) & (prelim_midterm+_92_95)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_92_95");
  new_prefinal = 92;
  new_final = 95;
}

if(((prelim_midterm+_92_96)/4 >= selected_average) & (prelim_midterm+_92_96)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_92_96");
  new_prefinal = 92;
  new_final = 96;
}

if(((prelim_midterm+_92_97)/4 >= selected_average) & (prelim_midterm+_92_97)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_92_97");
  new_prefinal = 92;
  new_final = 97;
}

if(((prelim_midterm+_92_98)/4 >= selected_average) & (prelim_midterm+_92_98)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_92_98");
  new_prefinal = 92;
  new_final = 98;
}

if(((prelim_midterm+_92_99)/4 >= selected_average) & (prelim_midterm+_92_99)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_92_99");
  new_prefinal = 92;
  new_final = 99;
}

if(((prelim_midterm+_92_100)/4 >= selected_average) & (prelim_midterm+_92_100)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_92_100");
  new_prefinal = 92;
  new_final = 100;
}


// 93

if(((prelim_midterm+_93_75)/4 >= selected_average) & (prelim_midterm+_93_75)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_93_75");
  new_prefinal = 93;
  new_final = 75;
}

if(((prelim_midterm+_93_76)/4 >= selected_average) & (prelim_midterm+_93_76)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_93_76");
  new_prefinal = 93;
  new_final = 76;
}

if(((prelim_midterm+_93_77)/4 >= selected_average) & (prelim_midterm+_93_77)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_93_77");
  new_prefinal = 93;
  new_final = 77;
}

if(((prelim_midterm+_93_78)/4 >= selected_average) & (prelim_midterm+_93_78)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_93_78");
  new_prefinal = 93;
  new_final = 78;
}

if(((prelim_midterm+_93_79)/4 >= selected_average) & (prelim_midterm+_93_79)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_93_79");
  new_prefinal = 93;
  new_final = 79;
}

if(((prelim_midterm+_93_80)/4 >= selected_average) & (prelim_midterm+_93_80)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_93_80");
  new_prefinal = 93;
  new_final = 80;
}

if(((prelim_midterm+_93_81)/4 >= selected_average) & (prelim_midterm+_93_81)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_93_81");
  new_prefinal = 93;
  new_final = 81;
}

if(((prelim_midterm+_93_82)/4 >= selected_average) & (prelim_midterm+_93_82)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_93_82");
  new_prefinal = 93;
  new_final = 82;
}

if(((prelim_midterm+_93_83)/4 >= selected_average) & (prelim_midterm+_93_83)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_93_83");
  new_prefinal = 93;
  new_final = 83;
}

if(((prelim_midterm+_93_84)/4 >= selected_average) & (prelim_midterm+_93_84)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_93_84");
  new_prefinal = 93;
  new_final = 84;
}

if(((prelim_midterm+_93_85)/4 >= selected_average) & (prelim_midterm+_93_85)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_93_85");
  new_prefinal = 93;
  new_final = 85;
}

if(((prelim_midterm+_93_86)/4 >= selected_average) & (prelim_midterm+_93_86)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_93_86");
  new_prefinal = 93;
  new_final = 86;
}

if(((prelim_midterm+_93_87)/4 >= selected_average) & (prelim_midterm+_93_87)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_93_87");
  new_prefinal = 93;
  new_final = 87;
}

if(((prelim_midterm+_93_88)/4 >= selected_average) & (prelim_midterm+_93_88)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_93_88");
  new_prefinal = 93;
  new_final = 88;
}

if(((prelim_midterm+_93_89)/4 >= selected_average) & (prelim_midterm+_93_89)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_93_89");
  new_prefinal = 93;
  new_final = 89;
}

if(((prelim_midterm+_93_90)/4 >= selected_average) & (prelim_midterm+_93_90)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_93_90");
  new_prefinal = 93;
  new_final = 90;
}

if(((prelim_midterm+_93_91)/4 >= selected_average) & (prelim_midterm+_93_91)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_93_91");
  new_prefinal = 93;
  new_final = 91;
}

if(((prelim_midterm+_93_92)/4 >= selected_average) & (prelim_midterm+_93_92)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_93_92");
  new_prefinal = 93;
  new_final = 92;
}

if(((prelim_midterm+_93_93)/4 >= selected_average) & (prelim_midterm+_93_93)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_93_93");
  new_prefinal = 93;
  new_final = 93;
}

if(((prelim_midterm+_93_94)/4 >= selected_average) & (prelim_midterm+_93_94)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_93_94");
  new_prefinal = 93;
  new_final = 94;
}

if(((prelim_midterm+_93_95)/4 >= selected_average) & (prelim_midterm+_93_95)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_93_95");
  new_prefinal = 93;
  new_final = 95;
}

if(((prelim_midterm+_93_96)/4 >= selected_average) & (prelim_midterm+_93_96)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_93_96");
  new_prefinal = 93;
  new_final = 96;
}

if(((prelim_midterm+_93_97)/4 >= selected_average) & (prelim_midterm+_93_97)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_93_97");
  new_prefinal = 93;
  new_final = 97;
}

if(((prelim_midterm+_93_98)/4 >= selected_average) & (prelim_midterm+_93_98)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_93_98");
  new_prefinal = 93;
  new_final = 98;
}

if(((prelim_midterm+_93_99)/4 >= selected_average) & (prelim_midterm+_93_99)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_93_99");
  new_prefinal = 93;
  new_final = 99;
}

if(((prelim_midterm+_93_100)/4 >= selected_average) & (prelim_midterm+_93_100)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_93_100");
  new_prefinal = 93;
  new_final = 100;
}


// 94

if(((prelim_midterm+_94_75)/4 >= selected_average) & (prelim_midterm+_94_75)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_94_75");
  new_prefinal = 94;
  new_final = 75;
}

if(((prelim_midterm+_94_76)/4 >= selected_average) & (prelim_midterm+_94_76)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_94_76");
  new_prefinal = 94;
  new_final = 76;
}

if(((prelim_midterm+_94_77)/4 >= selected_average) & (prelim_midterm+_94_77)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_94_77");
  new_prefinal = 94;
  new_final = 77;
}

if(((prelim_midterm+_94_78)/4 >= selected_average) & (prelim_midterm+_94_78)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_94_78");
  new_prefinal = 94;
  new_final = 78;
}

if(((prelim_midterm+_94_79)/4 >= selected_average) & (prelim_midterm+_94_79)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_94_79");
  new_prefinal = 94;
  new_final = 79;
}

if(((prelim_midterm+_94_80)/4 >= selected_average) & (prelim_midterm+_94_80)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_94_80");
  new_prefinal = 94;
  new_final = 80;
}

if(((prelim_midterm+_94_81)/4 >= selected_average) & (prelim_midterm+_94_81)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_94_81");
  new_prefinal = 94;
  new_final = 81;
}

if(((prelim_midterm+_94_82)/4 >= selected_average) & (prelim_midterm+_94_82)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_94_82");
  new_prefinal = 94;
  new_final = 82;
}

if(((prelim_midterm+_94_83)/4 >= selected_average) & (prelim_midterm+_94_83)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_94_83");
  new_prefinal = 94;
  new_final = 83;
}

if(((prelim_midterm+_94_84)/4 >= selected_average) & (prelim_midterm+_94_84)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_94_84");
  new_prefinal = 94;
  new_final = 84;
}

if(((prelim_midterm+_94_85)/4 >= selected_average) & (prelim_midterm+_94_85)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_94_85");
  new_prefinal = 94;
  new_final = 85;
}

if(((prelim_midterm+_94_86)/4 >= selected_average) & (prelim_midterm+_94_86)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_94_86");
  new_prefinal = 94;
  new_final = 86;
}

if(((prelim_midterm+_94_87)/4 >= selected_average) & (prelim_midterm+_94_87)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_94_87");
  new_prefinal = 94;
  new_final = 87;
}

if(((prelim_midterm+_94_88)/4 >= selected_average) & (prelim_midterm+_94_88)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_94_88");
  new_prefinal = 94;
  new_final = 88;
}

if(((prelim_midterm+_94_89)/4 >= selected_average) & (prelim_midterm+_94_89)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_94_89");
  new_prefinal = 94;
  new_final = 89;
}

if(((prelim_midterm+_94_90)/4 >= selected_average) & (prelim_midterm+_94_90)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_94_90");
  new_prefinal = 94;
  new_final = 90;
}

if(((prelim_midterm+_94_91)/4 >= selected_average) & (prelim_midterm+_94_91)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_94_91");
  new_prefinal = 94;
  new_final = 91;
}

if(((prelim_midterm+_94_92)/4 >= selected_average) & (prelim_midterm+_94_92)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_94_92");
  new_prefinal = 94;
  new_final = 92;
}

if(((prelim_midterm+_94_93)/4 >= selected_average) & (prelim_midterm+_94_93)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_94_93");
  new_prefinal = 94;
  new_final = 93;
}

if(((prelim_midterm+_94_94)/4 >= selected_average) & (prelim_midterm+_94_94)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_94_94");
  new_prefinal = 94;
  new_final = 94;
}

if(((prelim_midterm+_94_95)/4 >= selected_average) & (prelim_midterm+_94_95)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_94_95");
  new_prefinal = 94;
  new_final = 95
}

if(((prelim_midterm+_94_96)/4 >= selected_average) & (prelim_midterm+_94_96)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_94_96");
  new_prefinal = 94;
  new_final = 96;
}

if(((prelim_midterm+_94_97)/4 >= selected_average) & (prelim_midterm+_94_97)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_94_97");
  new_prefinal = 94;
  new_final = 97;
}

if(((prelim_midterm+_94_98)/4 >= selected_average) & (prelim_midterm+_94_98)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_94_98");
  new_prefinal = 94;
  new_final = 98;
}

if(((prelim_midterm+_94_99)/4 >= selected_average) & (prelim_midterm+_94_99)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_94_99");
  new_prefinal = 94;
  new_final = 99;
}

if(((prelim_midterm+_94_100)/4 >= selected_average) & (prelim_midterm+_94_100)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_94_100");
  new_prefinal = 94;
  new_final = 100;
}


// 95

if(((prelim_midterm+_95_75)/4 >= selected_average) & (prelim_midterm+_95_75)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_95_75");
  new_prefinal = 95;
  new_final = 75;
}

if(((prelim_midterm+_95_76)/4 >= selected_average) & (prelim_midterm+_95_76)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_95_76");
  new_prefinal = 95;
  new_final = 76;
}

if(((prelim_midterm+_95_77)/4 >= selected_average) & (prelim_midterm+_95_77)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_95_77");
  new_prefinal = 95;
  new_final = 77;
}

if(((prelim_midterm+_95_78)/4 >= selected_average) & (prelim_midterm+_95_78)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_95_78");
  new_prefinal = 95;
  new_final = 78;
}

if(((prelim_midterm+_95_79)/4 >= selected_average) & (prelim_midterm+_95_79)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_95_79");
  new_prefinal = 95;
  new_final = 79;
}

if(((prelim_midterm+_95_80)/4 >= selected_average) & (prelim_midterm+_95_80)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_95_80");
  new_prefinal = 95;
  new_final = 80;
}

if(((prelim_midterm+_95_81)/4 >= selected_average) & (prelim_midterm+_95_81)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_95_81");
  new_prefinal = 95;
  new_final = 81;
}

if(((prelim_midterm+_95_82)/4 >= selected_average) & (prelim_midterm+_95_82)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_95_82");
  new_prefinal = 95;
  new_final = 82;
}

if(((prelim_midterm+_95_83)/4 >= selected_average) & (prelim_midterm+_95_83)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_95_83");
  new_prefinal = 95;
  new_final = 83;
}

if(((prelim_midterm+_95_84)/4 >= selected_average) & (prelim_midterm+_95_84)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_95_84");
  new_prefinal = 95;
  new_final = 84;
}

if(((prelim_midterm+_95_85)/4 >= selected_average) & (prelim_midterm+_95_85)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_95_85");
  new_prefinal = 95;
  new_final = 85;
}

if(((prelim_midterm+_95_86)/4 >= selected_average) & (prelim_midterm+_95_86)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_95_86");
  new_prefinal = 95;
  new_final = 86;
}

if(((prelim_midterm+_95_87)/4 >= selected_average) & (prelim_midterm+_95_87)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_95_87");
  new_prefinal = 95;
  new_final = 87;
}

if(((prelim_midterm+_95_88)/4 >= selected_average) & (prelim_midterm+_95_88)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_95_88");
  new_prefinal = 95;
  new_final = 88;
}

if(((prelim_midterm+_95_89)/4 >= selected_average) & (prelim_midterm+_95_89)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_95_89");
  new_prefinal = 95;
  new_final = 89;
}

if(((prelim_midterm+_95_90)/4 >= selected_average) & (prelim_midterm+_95_90)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_95_90");
  new_prefinal = 95;
  new_final = 90;
}

if(((prelim_midterm+_95_91)/4 >= selected_average) & (prelim_midterm+_95_91)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_95_91");
  new_prefinal = 95;
  new_final = 91;
}

if(((prelim_midterm+_95_92)/4 >= selected_average) & (prelim_midterm+_95_92)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_95_92");
  new_prefinal = 95;
  new_final = 92;
}

if(((prelim_midterm+_95_93)/4 >= selected_average) & (prelim_midterm+_95_93)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_95_93");
  new_prefinal = 95;
  new_final = 93;
}

if(((prelim_midterm+_95_94)/4 >= selected_average) & (prelim_midterm+_95_94)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_95_94");
  new_prefinal = 95;
  new_final = 94;
}

if(((prelim_midterm+_95_95)/4 >= selected_average) & (prelim_midterm+_95_95)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_95_95");
  new_prefinal = 95;
  new_final = 95;
}

if(((prelim_midterm+_95_96)/4 >= selected_average) & (prelim_midterm+_95_96)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_95_96");
  new_prefinal = 95;
  new_final = 96;
}

if(((prelim_midterm+_95_97)/4 >= selected_average) & (prelim_midterm+_95_97)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_95_97");
  new_prefinal = 95;
  new_final = 97;
}

if(((prelim_midterm+_95_98)/4 >= selected_average) & (prelim_midterm+_95_98)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_95_98");
  new_prefinal = 95;
  new_final = 98;
}

if(((prelim_midterm+_95_99)/4 >= selected_average) & (prelim_midterm+_95_99)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_95_99");
  new_prefinal = 95;
  new_final = 99;
}

if(((prelim_midterm+_95_100)/4 >= selected_average) & (prelim_midterm+_95_100)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_95_100");
  new_prefinal = 95;
  new_final = 100;
}


// 96

if(((prelim_midterm+_96_75)/4 >= selected_average) & (prelim_midterm+_96_75)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_96_75");
    new_prefinal = 96;
  new_final = 75;
}

if(((prelim_midterm+_96_76)/4 >= selected_average) & (prelim_midterm+_96_76)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_96_76");
  new_prefinal = 96;
  new_final = 76;
}

if(((prelim_midterm+_96_77)/4 >= selected_average) & (prelim_midterm+_96_77)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_96_77");
  new_prefinal = 96;
  new_final = 77;
}

if(((prelim_midterm+_96_78)/4 >= selected_average) & (prelim_midterm+_96_78)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_96_78");
  new_prefinal = 96;
  new_final = 78;
}

if(((prelim_midterm+_96_79)/4 >= selected_average) & (prelim_midterm+_96_79)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_96_79");
  new_prefinal = 96;
  new_final = 79;
}

if(((prelim_midterm+_96_80)/4 >= selected_average) & (prelim_midterm+_96_80)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_96_80");
  new_prefinal = 96;
  new_final = 80;
}

if(((prelim_midterm+_96_81)/4 >= selected_average) & (prelim_midterm+_96_81)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_96_81");
  new_prefinal = 96;
  new_final = 81;
}

if(((prelim_midterm+_96_82)/4 >= selected_average) & (prelim_midterm+_96_82)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_96_82");
  new_prefinal = 96;
  new_final = 82;
}

if(((prelim_midterm+_96_83)/4 >= selected_average) & (prelim_midterm+_96_83)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_96_83");
  new_prefinal = 96;
  new_final = 83;
}

if(((prelim_midterm+_96_84)/4 >= selected_average) & (prelim_midterm+_96_84)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_96_84");
  new_prefinal = 96;
  new_final = 84;
}

if(((prelim_midterm+_96_85)/4 >= selected_average) & (prelim_midterm+_96_85)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_96_85");
  new_prefinal = 96;
  new_final = 85;
}

if(((prelim_midterm+_96_86)/4 >= selected_average) & (prelim_midterm+_96_86)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_96_86");
  new_prefinal = 96;
  new_final = 86;
}

if(((prelim_midterm+_96_87)/4 >= selected_average) & (prelim_midterm+_96_87)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_96_87");
  new_prefinal = 96;
  new_final = 87;
}

if(((prelim_midterm+_96_88)/4 >= selected_average) & (prelim_midterm+_96_88)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_96_88");
  new_prefinal = 96;
  new_final = 88;
}

if(((prelim_midterm+_96_89)/4 >= selected_average) & (prelim_midterm+_96_89)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_96_89");
  new_prefinal = 96;
  new_final = 89;
}

if(((prelim_midterm+_96_90)/4 >= selected_average) & (prelim_midterm+_96_90)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_96_90");
  new_prefinal = 96;
  new_final = 90;
}

if(((prelim_midterm+_96_91)/4 >= selected_average) & (prelim_midterm+_96_91)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_96_91");
  new_prefinal = 96;
  new_final = 91;
}

if(((prelim_midterm+_96_92)/4 >= selected_average) & (prelim_midterm+_96_92)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_96_92");
  new_prefinal = 96;
  new_final = 92;
}

if(((prelim_midterm+_96_93)/4 >= selected_average) & (prelim_midterm+_96_93)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_96_93");
  new_prefinal = 96;
  new_final = 93;
}

if(((prelim_midterm+_96_94)/4 >= selected_average) & (prelim_midterm+_96_94)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_96_94");
  new_prefinal = 96;
  new_final = 94;
}

if(((prelim_midterm+_96_95)/4 >= selected_average) & (prelim_midterm+_96_95)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_96_95");
  new_prefinal = 96;
  new_final = 95;
}

if(((prelim_midterm+_96_96)/4 >= selected_average) & (prelim_midterm+_96_96)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_96_96");
  new_prefinal = 96;
  new_final = 96;
}

if(((prelim_midterm+_96_97)/4 >= selected_average) & (prelim_midterm+_96_97)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_96_97");
  new_prefinal = 96;
  new_final = 97;
}

if(((prelim_midterm+_96_98)/4 >= selected_average) & (prelim_midterm+_96_98)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_96_98");
  new_prefinal = 96;
  new_final = 98;
}

if(((prelim_midterm+_96_99)/4 >= selected_average) & (prelim_midterm+_96_99)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_96_99");
  new_prefinal = 96;
  new_final = 99;
}

if(((prelim_midterm+_96_100)/4 >= selected_average) & (prelim_midterm+_96_100)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_96_100");
  new_prefinal = 96;
  new_final = 100;
}


// 97

if(((prelim_midterm+_97_75)/4 >= selected_average) & (prelim_midterm+_97_75)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_97_75");
  new_prefinal = 97;
  new_final = 75;
}

if(((prelim_midterm+_97_76)/4 >= selected_average) & (prelim_midterm+_97_76)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_97_76");
  new_prefinal = 97;
  new_final = 76;
}

if(((prelim_midterm+_97_77)/4 >= selected_average) & (prelim_midterm+_97_77)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_97_77");
  new_prefinal = 97;
  new_final = 77;
}

if(((prelim_midterm+_97_78)/4 >= selected_average) & (prelim_midterm+_97_78)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_97_78");
  new_prefinal = 97;
  new_final = 78;
}

if(((prelim_midterm+_97_79)/4 >= selected_average) & (prelim_midterm+_97_79)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_97_79");
  new_prefinal = 97;
  new_final = 79;
}

if(((prelim_midterm+_97_80)/4 >= selected_average) & (prelim_midterm+_97_80)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_97_80");
  new_prefinal = 97;
  new_final = 80;
}

if(((prelim_midterm+_97_81)/4 >= selected_average) & (prelim_midterm+_97_81)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_97_81");
  new_prefinal = 97;
  new_final = 81;
}

if(((prelim_midterm+_97_82)/4 >= selected_average) & (prelim_midterm+_97_82)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_97_82");
  new_prefinal = 97;
  new_final = 82;
}

if(((prelim_midterm+_97_83)/4 >= selected_average) & (prelim_midterm+_97_83)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_97_83");
  new_prefinal = 97;
  new_final = 83;
}

if(((prelim_midterm+_97_84)/4 >= selected_average) & (prelim_midterm+_97_84)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_97_84");
  new_prefinal = 97;
  new_final = 84;
}

if(((prelim_midterm+_97_85)/4 >= selected_average) & (prelim_midterm+_97_85)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_97_85");
  new_prefinal = 97;
  new_final = 85;
}

if(((prelim_midterm+_97_86)/4 >= selected_average) & (prelim_midterm+_97_86)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_97_86");
  new_prefinal = 97;
  new_final = 86;
}

if(((prelim_midterm+_97_87)/4 >= selected_average) & (prelim_midterm+_97_87)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_97_87");
  new_prefinal = 97;
  new_final = 87;
}

if(((prelim_midterm+_97_88)/4 >= selected_average) & (prelim_midterm+_97_88)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_97_88");
  new_prefinal = 97;
  new_final = 88;
}

if(((prelim_midterm+_97_89)/4 >= selected_average) & (prelim_midterm+_97_89)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_97_89");
  new_prefinal = 97;
  new_final = 89;
}

if(((prelim_midterm+_97_90)/4 >= selected_average) & (prelim_midterm+_97_90)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_97_90");
  new_prefinal = 97;
  new_final = 90;
}

if(((prelim_midterm+_97_91)/4 >= selected_average) & (prelim_midterm+_97_91)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_97_91");
  new_prefinal = 97;
  new_final = 91;
}

if(((prelim_midterm+_97_92)/4 >= selected_average) & (prelim_midterm+_97_92)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_97_92");
  new_prefinal = 97;
  new_final = 92;
}

if(((prelim_midterm+_97_93)/4 >= selected_average) & (prelim_midterm+_97_93)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_97_93");
  new_prefinal = 97;
  new_final = 93;
}

if(((prelim_midterm+_97_94)/4 >= selected_average) & (prelim_midterm+_97_94)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_97_94");
  new_prefinal = 97;
  new_final = 94;
}

if(((prelim_midterm+_97_95)/4 >= selected_average) & (prelim_midterm+_97_95)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_97_95");
  new_prefinal = 97;
  new_final = 95;
}

if(((prelim_midterm+_97_96)/4 >= selected_average) & (prelim_midterm+_97_96)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_97_96");
  new_prefinal = 97;
  new_final = 96;
}

if(((prelim_midterm+_97_97)/4 >= selected_average) & (prelim_midterm+_97_97)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_97_97");
  new_prefinal = 97;
  new_final = 97;
}

if(((prelim_midterm+_97_98)/4 >= selected_average) & (prelim_midterm+_97_98)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_97_98");
  new_prefinal = 97;
  new_final = 98;
}

if(((prelim_midterm+_97_99)/4 >= selected_average) & (prelim_midterm+_97_99)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_97_99");
  new_prefinal = 97;
  new_final = 99;
}

if(((prelim_midterm+_97_100)/4 >= selected_average) & (prelim_midterm+_97_100)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_97_100");
  new_prefinal = 97;
  new_final = 100;
}


// 98

if(((prelim_midterm+_98_75)/4 >= selected_average) & (prelim_midterm+_98_75)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_98_75");
  new_prefinal = 98;
  new_final = 75;
}

if(((prelim_midterm+_98_76)/4 >= selected_average) & (prelim_midterm+_98_76)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_98_76");
  new_prefinal = 98;
  new_final = 76;
}

if(((prelim_midterm+_98_77)/4 >= selected_average) & (prelim_midterm+_98_77)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_98_77");
  new_prefinal = 98;
  new_final = 77;
}

if(((prelim_midterm+_98_78)/4 >= selected_average) & (prelim_midterm+_98_78)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_98_78");
  new_prefinal = 98;
  new_final = 78;
}

if(((prelim_midterm+_98_79)/4 >= selected_average) & (prelim_midterm+_98_79)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_98_79");
  new_prefinal = 98;
  new_final = 79;
}

if(((prelim_midterm+_98_80)/4 >= selected_average) & (prelim_midterm+_98_80)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_98_80");
  new_prefinal = 98;
  new_final = 80;
}

if(((prelim_midterm+_98_81)/4 >= selected_average) & (prelim_midterm+_98_81)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_98_81");
  new_prefinal = 98;
  new_final = 81;
}

if(((prelim_midterm+_98_82)/4 >= selected_average) & (prelim_midterm+_98_82)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_98_82");
  new_prefinal = 98;
  new_final = 82;
}

if(((prelim_midterm+_98_83)/4 >= selected_average) & (prelim_midterm+_98_83)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_98_83");
  new_prefinal = 98;
  new_final = 83;
}

if(((prelim_midterm+_98_84)/4 >= selected_average) & (prelim_midterm+_98_84)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_98_84");
  new_prefinal = 98;
  new_final = 84;
}

if(((prelim_midterm+_98_85)/4 >= selected_average) & (prelim_midterm+_98_85)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_98_85");
  new_prefinal = 98;
  new_final = 85;
}

if(((prelim_midterm+_98_86)/4 >= selected_average) & (prelim_midterm+_98_86)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_98_86");
  new_prefinal = 98;
  new_final = 86;
}

if(((prelim_midterm+_98_87)/4 >= selected_average) & (prelim_midterm+_98_87)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_98_87");
  new_prefinal = 98;
  new_final = 87;
}

if(((prelim_midterm+_98_88)/4 >= selected_average) & (prelim_midterm+_98_88)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_98_88");
  new_prefinal = 98;
  new_final = 88;
}

if(((prelim_midterm+_98_89)/4 >= selected_average) & (prelim_midterm+_98_89)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_98_89");
  new_prefinal = 98;
  new_final = 89;
}

if(((prelim_midterm+_98_90)/4 >= selected_average) & (prelim_midterm+_98_90)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_98_90");
  new_prefinal = 98;
  new_final = 90;
}

if(((prelim_midterm+_98_91)/4 >= selected_average) & (prelim_midterm+_98_91)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_98_91");
  new_prefinal = 98;
  new_final = 91;
}

if(((prelim_midterm+_98_92)/4 >= selected_average) & (prelim_midterm+_98_92)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_98_92");
  new_prefinal = 98;
  new_final = 92;
}

if(((prelim_midterm+_98_93)/4 >= selected_average) & (prelim_midterm+_98_93)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_98_93");
  new_prefinal = 98;
  new_final = 93;
}

if(((prelim_midterm+_98_94)/4 >= selected_average) & (prelim_midterm+_98_94)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_98_94");
  new_prefinal = 98;
  new_final = 94;
}

if(((prelim_midterm+_98_95)/4 >= selected_average) & (prelim_midterm+_98_95)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_98_95");
    new_prefinal = 98;
  new_final = 95;
}

if(((prelim_midterm+_98_96)/4 >= selected_average) & (prelim_midterm+_98_96)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_98_96");
  new_prefinal = 98;
  new_final = 96;
}

if(((prelim_midterm+_98_97)/4 >= selected_average) & (prelim_midterm+_98_97)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_98_97");
  new_prefinal = 98;
  new_final = 97;
}

if(((prelim_midterm+_98_98)/4 >= selected_average) & (prelim_midterm+_98_98)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_98_98");
  new_prefinal = 98;
  new_final = 98;
}

if(((prelim_midterm+_98_99)/4 >= selected_average) & (prelim_midterm+_98_99)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_98_99");
  new_prefinal = 98;
  new_final = 99;
}

if(((prelim_midterm+_98_100)/4 >= selected_average) & (prelim_midterm+_98_100)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_98_100");
  new_prefinal = 98;
  new_final = 100;
}


// 99

if(((prelim_midterm+_99_75)/4 >= selected_average) & (prelim_midterm+_99_75)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_99_75");
  new_prefinal = 99;
  new_final = 75;
}

if(((prelim_midterm+_99_76)/4 >= selected_average) & (prelim_midterm+_99_76)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_99_76");
  new_prefinal = 99;
  new_final = 76;
}

if(((prelim_midterm+_99_77)/4 >= selected_average) & (prelim_midterm+_99_77)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_99_77");
  new_prefinal = 99;
  new_final = 77;
}

if(((prelim_midterm+_99_78)/4 >= selected_average) & (prelim_midterm+_99_78)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_99_78");
  new_prefinal = 99;
  new_final = 78;
}

if(((prelim_midterm+_99_79)/4 >= selected_average) & (prelim_midterm+_99_79)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_99_79");
  new_prefinal = 99;
  new_final = 79;
}

if(((prelim_midterm+_99_80)/4 >= selected_average) & (prelim_midterm+_99_80)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_99_80");
  new_prefinal = 99;
  new_final = 80;
}

if(((prelim_midterm+_99_81)/4 >= selected_average) & (prelim_midterm+_99_81)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_99_81");
  new_prefinal = 99;
  new_final = 81;
}

if(((prelim_midterm+_99_82)/4 >= selected_average) & (prelim_midterm+_99_82)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_99_82");
  new_prefinal = 99;
  new_final = 82;
}

if(((prelim_midterm+_99_83)/4 >= selected_average) & (prelim_midterm+_99_83)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_99_83");
  new_prefinal = 99;
  new_final = 83;
}

if(((prelim_midterm+_99_84)/4 >= selected_average) & (prelim_midterm+_99_84)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_99_84");
  new_prefinal = 99;
  new_final = 84;
}

if(((prelim_midterm+_99_85)/4 >= selected_average) & (prelim_midterm+_99_85)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_99_85");
  new_prefinal = 99;
  new_final = 85;
}

if(((prelim_midterm+_99_86)/4 >= selected_average) & (prelim_midterm+_99_86)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_99_86");
  new_prefinal = 99;
  new_final = 86;
}

if(((prelim_midterm+_99_87)/4 >= selected_average) & (prelim_midterm+_99_87)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_99_87");
  new_prefinal = 99;
  new_final = 87;
}

if(((prelim_midterm+_99_88)/4 >= selected_average) & (prelim_midterm+_99_88)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_99_88");
  new_prefinal = 99;
  new_final = 88;
}

if(((prelim_midterm+_99_89)/4 >= selected_average) & (prelim_midterm+_99_89)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_99_89");
  new_prefinal = 99;
  new_final = 89;
}

if(((prelim_midterm+_99_90)/4 >= selected_average) & (prelim_midterm+_99_90)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_99_90");
  new_prefinal = 99;
  new_final = 90;
}

if(((prelim_midterm+_99_91)/4 >= selected_average) & (prelim_midterm+_99_91)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_99_91");
  new_prefinal = 99;
  new_final = 91;
}

if(((prelim_midterm+_99_92)/4 >= selected_average) & (prelim_midterm+_99_92)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_99_92");
  new_prefinal = 99;
  new_final = 92;
}

if(((prelim_midterm+_99_93)/4 >= selected_average) & (prelim_midterm+_99_93)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_99_93");
  new_prefinal = 99;
  new_final = 93;
}

if(((prelim_midterm+_99_94)/4 >= selected_average) & (prelim_midterm+_99_94)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_99_94");
  new_prefinal = 99;
  new_final = 94;
}

if(((prelim_midterm+_99_95)/4 >= selected_average) & (prelim_midterm+_99_95)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_99_95");
  new_prefinal = 99;
  new_final = 95;
}

if(((prelim_midterm+_99_96)/4 >= selected_average) & (prelim_midterm+_99_96)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_99_96");
  new_prefinal = 99;
  new_final = 96;
}

if(((prelim_midterm+_99_97)/4 >= selected_average) & (prelim_midterm+_99_97)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_99_97");
  new_prefinal = 99;
  new_final = 97;
}

if(((prelim_midterm+_99_98)/4 >= selected_average) & (prelim_midterm+_99_98)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_99_98");
  new_prefinal = 99;
  new_final = 98;
}

if(((prelim_midterm+_99_99)/4 >= selected_average) & (prelim_midterm+_99_99)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_99_99");
  new_prefinal = 99;
  new_final = 99;
}

if(((prelim_midterm+_99_100)/4 >= selected_average) & (prelim_midterm+_99_100)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_99_100");
  new_prefinal = 99;
  new_final = 100;
}


// 100

if(((prelim_midterm+_100_75)/4 >= selected_average) & (prelim_midterm+_100_75)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_100_75");
  new_prefinal = 100;
  new_final = 75;
}

if(((prelim_midterm+_100_76)/4 >= selected_average) & (prelim_midterm+_100_76)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_100_76");
  new_prefinal = 100;
  new_final = 76;
}

if(((prelim_midterm+_100_77)/4 >= selected_average) & (prelim_midterm+_100_77)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_100_77");
  new_prefinal = 100;
  new_final = 77;
}

if(((prelim_midterm+_100_78)/4 >= selected_average) & (prelim_midterm+_100_78)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_100_78");
  new_prefinal = 100;
  new_final = 78;
}

if(((prelim_midterm+_100_79)/4 >= selected_average) & (prelim_midterm+_100_79)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_100_79");
  new_prefinal = 100;
  new_final = 79;
}

if(((prelim_midterm+_100_80)/4 >= selected_average) & (prelim_midterm+_100_80)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_100_80");
  new_prefinal = 100;
  new_final = 80;
}

if(((prelim_midterm+_100_81)/4 >= selected_average) & (prelim_midterm+_100_81)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_100_81");
  new_prefinal = 100;
  new_final = 81;
}

if(((prelim_midterm+_100_82)/4 >= selected_average) & (prelim_midterm+_100_82)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_100_82");
  new_prefinal = 100;
  new_final = 82;
}

if(((prelim_midterm+_100_83)/4 >= selected_average) & (prelim_midterm+_100_83)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_100_83");
  new_prefinal = 100;
  new_final = 83;
}

if(((prelim_midterm+_100_84)/4 >= selected_average) & (prelim_midterm+_100_84)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_100_84");
  new_prefinal = 100;
  new_final = 84;
}

if(((prelim_midterm+_100_85)/4 >= selected_average) & (prelim_midterm+_100_85)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_100_85");
  new_prefinal = 100;
  new_final = 85;
}

if(((prelim_midterm+_100_86)/4 >= selected_average) & (prelim_midterm+_100_86)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_100_86");
  new_prefinal = 100;
  new_final = 86;
}

if(((prelim_midterm+_100_87)/4 >= selected_average) & (prelim_midterm+_100_87)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_100_87");
  new_prefinal = 100;
  new_final = 87;
}

if(((prelim_midterm+_100_88)/4 >= selected_average) & (prelim_midterm+_100_88)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_100_88");
  new_prefinal = 100;
  new_final = 88;
}

if(((prelim_midterm+_100_89)/4 >= selected_average) & (prelim_midterm+_100_89)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_100_89");
  new_prefinal = 100;
  new_final = 89;
}

if(((prelim_midterm+_100_90)/4 >= selected_average) & (prelim_midterm+_100_90)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_100_90");
  new_prefinal = 100;
  new_final = 90;
}

if(((prelim_midterm+_100_91)/4 >= selected_average) & (prelim_midterm+_100_91)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_100_91");
  new_prefinal = 100;
  new_final = 91;
}

if(((prelim_midterm+_100_92)/4 >= selected_average) & (prelim_midterm+_100_92)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_100_92");
  new_prefinal = 100;
  new_final = 92;
}

if(((prelim_midterm+_100_93)/4 >= selected_average) & (prelim_midterm+_100_93)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_100_93");
  new_prefinal = 100;
  new_final = 93;
}

if(((prelim_midterm+_100_94)/4 >= selected_average) & (prelim_midterm+_100_94)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_100_94");
  new_prefinal = 100;
  new_final = 94;
}

if(((prelim_midterm+_100_95)/4 >= selected_average) & (prelim_midterm+_100_95)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_100_95");
  new_prefinal = 100;
  new_final = 95;
}

if(((prelim_midterm+_100_96)/4 >= selected_average) & (prelim_midterm+_100_96)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_100_96");
  new_prefinal = 100;
  new_final = 96;
}

if(((prelim_midterm+_100_97)/4 >= selected_average) & (prelim_midterm+_100_97)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_100_97");
  new_prefinal = 100;
  new_final = 97;
}

if(((prelim_midterm+_100_98)/4 >= selected_average) & (prelim_midterm+_100_98)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_100_98");
  new_prefinal = 100;
  new_final = 98;
}

if(((prelim_midterm+_100_99)/4 >= selected_average) & (prelim_midterm+_100_99)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_100_99");
  new_prefinal = 100;
  new_final = 99;
}

if(((prelim_midterm+_100_100)/4 >= selected_average) & (prelim_midterm+_100_100)/4 <= parseInt(selected_average) + 1){
  grade_array.push("_100_100");
  new_prefinal = 100;
  new_final = 100;
}

// grade_array.count();
// for(i=0;i<=grade_array.length;i++){
// alert(i+"."+grade_array[i]);
// }

// alert Umpisa iya

// alert(grade_array.length);
get_random_array = Math.floor(Math.random() * grade_array.length);
random_array = get_random_array;
predict_grade_array = grade_array[random_array];
// alert(predict_grade_array);

// alert(predict_grade_array.length);

if(predict_grade_array.length == 6){
var predict_prefinal = predict_grade_array.slice(1,3);
var predict_final = predict_grade_array.slice(4,6);
}

if(predict_grade_array.length == 7){
  if(predict_grade_array[1] == 1){
    // alert("100 sa una it daya!");
    var predict_prefinal = predict_grade_array.slice(1,4);
    var predict_final = predict_grade_array.slice(5,7);
  }else{
    // alert("100 sa ulihi it daya!");
    var predict_prefinal = predict_grade_array.slice(1,3);
    var predict_final = predict_grade_array.slice(4,7);
  }
}

// alert("prefinal= "+predict_prefinal);
// alert("final= "+predict_final);

// if(random_array == get_random_array){
//   predict_prefinal = new_prefinal;
//   predict_final = new_final;
//   alert("newPrefinal="+new_prefinal+"newFinal="+new_final);
// }


var get_prefinal_prediction = document.getElementById("prefinal_grade_prediction");
var get_final_prediction = document.getElementById("final_grade_prediction");

// location.relaod();
get_prefinal_prediction.innerHTML = predict_prefinal;
get_final_prediction.innerHTML = predict_final;




var student_no= document.getElementById("get_student_no").value;
 var semester_value= document.getElementById("get_semester").value;

var xhr = new XMLHttpRequest();
  xhr.open('POST','save_prediction.php?prefinal='+predict_prefinal+'&final='+predict_final+'&id='+student_no+'&s_='+semester_value, true);
  xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
  xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
  xhr.onreadystatechange = function () {
    if(xhr.readyState == 4 && xhr.status == 200) {
      var result = xhr.responseText;
      console.log(result);
    console.log('prefinal:'+predict_prefinal+'final:'+predict_final);
    window.location.reload();
  }
  }
  xhr.send();

// document.getElementById("get_prefinal").innerHTML = predict_prefinal;
// document.getElementById("get_final").innerHTML = predict_final;
  // alert("predictPrefinal="+predict_prefinal+"predictFinal="+predict_final);

// if(random_array == 1){
//   new_prefinal = 75;
//   new_final = 75;
//   alert("newPrefinal="+new_prefinal+"newFinal="+new_final);
// }else if(random_array == 2){
//   new_prefinal = 75;
//   new_final = 76;
//   alert("newPrefinal="+new_prefinal+"newFinal="+new_final);
// }else if(random_array == 3){
//   new_prefinal = 75;
//   new_final = 77;
//   alert("newPrefinal="+new_prefinal+"newFinal="+new_final);
// }




  // for(a=75;a<=100;a++){
  //   for(b=75;b<=100;b++){
  //   // console.log(a+"="+b+"="+(a+b));
  //    prefinal.innerHTML = a;
  //   final.innerHTML = b;
  //   new_prefinal = parseFloat(prefinal.innerHTML);
  //   new_final = parseFloat(final.innerHTML);
  //   prefinal_final = new_prefinal + new_final;

  //   overall_average = (prelim_midterm + prefinal_final)/4;
  //   // if(selected_average == overall_average ){
  //     console.log(new_prefinal+"+"+new_final)
  //     // console.log("prefinal="+new_prefinal+"final="+new_final+"overall="+overall_average)
  //   // }
  //   // alert()

  // //   var new_prefinal = parseFloat(prefinal.innerHTML);
  // // var new_final = parseFloat(final.innerHTML);
  //   // console.log("a="+new_prefinal+"b="+new_final+"a&b="+(new_prefinal+new_final));
  //   }
  // }

  // var new_prefinal = parseFloat(prefinal.innerHTML);
  // var new_final = parseFloat(final.innerHTML);
  // // console.log(new_prefinal+"="+new_final+"="+(new_prefinal+new_final))

  // var prefinal_final = new_prefinal + new_final;
// alert(prefinal.innerHTML + "=" + final.innerHTML)
    // console.log("a="+new_prefinal+"b="+new_final+"a&b="+(new_prefinal+new_final));




//  var average = (prelim_midterm+prefinal_final)/4;
// alert("Average=" + average + "Prefinal=" + new_prefinal + "Final=" + new_prefinal);
      

        // window.location.href="?ave="+selected_average+"&_p="+new_prefinal+"&_f="+new_final;
        // alert("Average=" + average + "Prefinal=" + new_prefinal + "Final=" + new_prefinal);


  }else if(get_prelim_value.innerHTML != 0 & get_midterm_value.innerHTML != 0 & get_prefinal_value.innerHTML != 0 & (get_final_value.innerHTML  == 0 | confirmation_final > 0)){


// _75
if(((prelim_midterm+new_prefinal+75)/4 >= selected_average) & (prelim_midterm+new_prefinal+75)/4 <= parseInt(selected_average) + 1){
  // alert(selected_average);
  grade_array.push("75");
  new_final = 75;
}

if(((prelim_midterm+new_prefinal+76)/4 >= selected_average) & (prelim_midterm+new_prefinal+76)/4 <= parseInt(selected_average) + 1){
  grade_array.push("76");
  new_final = 76;
}

if(((prelim_midterm+new_prefinal+77)/4 >= selected_average) & (prelim_midterm+new_prefinal+77)/4 <= parseInt(selected_average) + 1){
  grade_array.push("77");
  new_final = 77;
}

if(((prelim_midterm+new_prefinal+78)/4 >= selected_average) & (prelim_midterm+new_prefinal+78)/4 <= parseInt(selected_average) + 1){
  grade_array.push("78");
  new_final = 78;
}

if(((prelim_midterm+new_prefinal+79)/4 >= selected_average) & (prelim_midterm+new_prefinal+79)/4 <= parseInt(selected_average) + 1){
  grade_array.push("79");
  new_final = 79; 
}

if(((prelim_midterm+new_prefinal+80)/4 >= selected_average) & (prelim_midterm+new_prefinal+80)/4 <= parseInt(selected_average) + 1){
  grade_array.push("80");
  new_final = 80;
}

if(((prelim_midterm+new_prefinal+81)/4 >= selected_average) & (prelim_midterm+new_prefinal+81)/4 <= parseInt(selected_average) + 1){
  grade_array.push("81");
  new_final = 81;
}

if(((prelim_midterm+new_prefinal+82)/4 >= selected_average) & (prelim_midterm+new_prefinal+82)/4 <= parseInt(selected_average) + 1){
  grade_array.push("82");
  new_final = 82;
}

if(((prelim_midterm+new_prefinal+83)/4 >= selected_average) & (prelim_midterm+new_prefinal+83)/4 <= parseInt(selected_average) + 1){
  grade_array.push("83");
  new_final = 83;
}

if(((prelim_midterm+new_prefinal+84)/4 >= selected_average) & (prelim_midterm+new_prefinal+84)/4 <= parseInt(selected_average) + 1){
  grade_array.push("84");
  new_final = 84;
}

if(((prelim_midterm+new_prefinal+85)/4 >= selected_average) & (prelim_midterm+new_prefinal+85)/4 <= parseInt(selected_average) + 1){
  grade_array.push("85");
  new_final = 85;
}

if(((prelim_midterm+new_prefinal+86)/4 >= selected_average) & (prelim_midterm+new_prefinal+86)/4 <= parseInt(selected_average) + 1){
  grade_array.push("86");
  new_final = 86;
}

if(((prelim_midterm+new_prefinal+87)/4 >= selected_average) & (prelim_midterm+new_prefinal+87)/4 <= parseInt(selected_average) + 1){
  grade_array.push("87");
  new_final = 87;
}

if(((prelim_midterm+new_prefinal+88)/4 >= selected_average) & (prelim_midterm+new_prefinal+88)/4 <= parseInt(selected_average) + 1){
  grade_array.push("88");
  new_final = 88;
}

if(((prelim_midterm+new_prefinal+89)/4 >= selected_average) & (prelim_midterm+new_prefinal+89)/4 <= parseInt(selected_average) + 1){
  grade_array.push("89");
  new_final = 89;
}

if(((prelim_midterm+new_prefinal+90)/4 >= selected_average) & (prelim_midterm+new_prefinal+90)/4 <= parseInt(selected_average) + 1){
  grade_array.push("90");
  new_final = 90;
}

if(((prelim_midterm+new_prefinal+91)/4 >= selected_average) & (prelim_midterm+new_prefinal+91)/4 <= parseInt(selected_average) + 1){
  grade_array.push("91");
  new_final = 91;
}

if(((prelim_midterm+new_prefinal+92)/4 >= selected_average) & (prelim_midterm+new_prefinal+92)/4 <= parseInt(selected_average) + 1){
  grade_array.push("92");
  new_final = 92;
}

if(((prelim_midterm+new_prefinal+93)/4 >= selected_average) & (prelim_midterm+new_prefinal+93)/4 <= parseInt(selected_average) + 1){
  grade_array.push("93");
  new_final = 93;
}

if(((prelim_midterm+new_prefinal+94)/4 >= selected_average) & (prelim_midterm+new_prefinal+94)/4 <= parseInt(selected_average) + 1){
  grade_array.push("94");
  new_final = 94; 
}

if(((prelim_midterm+new_prefinal+95)/4 >= selected_average) & (prelim_midterm+new_prefinal+95)/4 <= parseInt(selected_average) + 1){
  grade_array.push("95");
  new_final = 95;
}

if(((prelim_midterm+new_prefinal+96)/4 >= selected_average) & (prelim_midterm+new_prefinal+96)/4 <= parseInt(selected_average) + 1){
  grade_array.push("96");
  new_final = 96;
}

if(((prelim_midterm+new_prefinal+97)/4 >= selected_average) & (prelim_midterm+new_prefinal+97)/4 <= parseInt(selected_average) + 1){
  grade_array.push("97");
  new_final = 97;
}

if(((prelim_midterm+new_prefinal+98)/4 >= selected_average) & (prelim_midterm+new_prefinal+98)/4 <= parseInt(selected_average) + 1){
  grade_array.push("98");
  new_final = 98;
}

if(((prelim_midterm+new_prefinal+99)/4 >= selected_average) & (prelim_midterm+new_prefinal+99)/4 <= parseInt(selected_average) + 1){
  grade_array.push("99");
  new_final = 99;
}

if(((prelim_midterm+new_prefinal+100)/4 >= selected_average) & (prelim_midterm+new_prefinal+100)/4 <= parseInt(selected_average) + 1){
  grade_array.push("100");
  new_final = 100;
}


get_random_array = Math.floor(Math.random() * grade_array.length);
random_array = get_random_array;
predict_grade_array = grade_array[random_array];


var get_final_prediction = document.getElementById("final_grade_prediction");

// location.relaod();
// get_prefinal_prediction.value = predict_prefinal;
get_final_prediction.innerHTML = predict_grade_array;


var student_no= document.getElementById("get_student_no").value;
 var semester_value= document.getElementById("get_semester").value;
var xhr = new XMLHttpRequest();
  xhr.open('POST','save_prediction.php?final='+predict_grade_array+'&id='+student_no+'&s_='+semester_value, true);
  xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
  xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
  xhr.onreadystatechange = function () {
    if(xhr.readyState == 4 && xhr.status == 200) {
      var result = xhr.responseText;
      console.log(result);
      window.location.reload();
  }
  }
  xhr.send();

  }


}

</script>


<?php
include("../../bins/footer_non_fixed.php");
?>