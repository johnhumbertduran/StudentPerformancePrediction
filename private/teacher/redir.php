<?php

function get_url_data(){
    $grading_period = $_GET["redir"];
    $grading = $_GET["redir"].$_GET["_s_e_"][3];
    $year = $_GET["_y"];
    $course = $_GET["_c"];
    $semester = $_GET["_s_e_"];
}


    $grading_period = $_GET["redir"];
    $grading = $_GET["redir"].$_GET["_s_e_"][3];
    $year = $_GET["_y"];
    $course = $_GET["_c"];
    $semester = $_GET["_s_e_"];
    $semester_no = $semester[3];
    $finalG = "final$semester_no";
    $prefinal = "prefinal$semester_no"; 
    $midterm = "midterm$semester_no"; 
    $prelim = "prelim$semester_no";
    // $student_no = $_GET["in_"];
    $input_data = $_GET["in_"];
    $column_data = "";

    if($input_data == "output1"){
      $column_data = $grading_period."_output_1";
      $card_title = "Output 1";
    }elseif($input_data == "output2"){
      $column_data = $grading_period."_output_2";
      $card_title = "Output 2";
    }elseif($input_data == "performance1"){
      $column_data = $grading_period."_performance_1";
      $card_title = "Performance 1";
    }elseif($input_data == "performance2"){
      $column_data = $grading_period."_performance_2";
      $card_title = "Performance 2";
    }elseif($input_data == "written_test"){
      $column_data = $grading_period."_written_test";
      $card_title = "Major Exam";
    }


?>


<!-- <center> -->
<div class="bg-dark pt-3" style="height:550px;">

<div class="card col-sm-5 mx-auto p-3">
<button type="button" class="close ml-auto bg-info rounded-circle px-1" id="black1">&times;</button>
<br>
<input type="hidden" id="column_data" value="<?php echo $column_data; ?>">
<input type="hidden" id="_grading_period" value="<?php echo $grading_period;?>">
<input type="hidden" id="_year" value="<?php echo $year;?>">
<input type="hidden" id="_course" value="<?php echo $course;?>">
<input type="hidden" id="_semester" value="<?php echo $semester;?>">
<!-- <h6>E sort lang du array ag find last array then check if it is greater than 20 or 70.</h6> -->
 <h3 class="position-fixed "><?php echo $card_title; ?></h3>
 <p></p>
  <div class="card-header bg-info">
  <font color="white"> Input Grade </font>
  </div>

  <div class="card-body overflow-auto" style="height:300px;">
  <form method="POST">
  <table>

<?php
$get_student_record = mysqli_query($connections, "SELECT * FROM $grading WHERE year='$year' AND course='$course' AND semester='$semester[3]'  ");
$get_student_record1 = mysqli_query($connections, "SELECT * FROM final1 WHERE year='$year' AND course='$course'  ");

$final_qry = mysqli_query($connections, "SELECT * FROM $finalG WHERE course='$course' AND year='$year' ");
$prefinal_qry = mysqli_query($connections, "SELECT * FROM $prefinal WHERE course='$course' AND year='$year' ");
$midterm_qry = mysqli_query($connections, "SELECT * FROM $midterm WHERE course='$course' AND year='$year' ");
$prelim_qry = mysqli_query($connections, "SELECT * FROM $prelim WHERE course='$course' AND year='$year' ");


$final_qry1 = mysqli_query($connections, "SELECT * FROM final1 WHERE course='$course' AND year='$year' ");
$prefinal_qry1 = mysqli_query($connections, "SELECT * FROM prefinal1 WHERE course='$course' AND year='$year' ");
$midterm_qry1 = mysqli_query($connections, "SELECT * FROM midterm1 WHERE course='$course' AND year='$year' ");
$prelim_qry1 = mysqli_query($connections, "SELECT * FROM prelim1 WHERE course='$course' AND year='$year' ");


while($row_student_record = mysqli_fetch_assoc($get_student_record)){

  $new_student_name = $row_student_record["student_name"];
  $new_student_no = $row_student_record["student_no"];
  $selected_column = $row_student_record[$column_data];
  // echo $new_student_name;

  $row_student_record1 = mysqli_fetch_assoc($get_student_record1);
  $new_student_name1 = $row_student_record1["student_name"];
  $new_student_no1 = $row_student_record1["student_no"];
  $final_output_1_1 = $row_student_record1["final_output_1"];
  $final_output_2_1 = $row_student_record1["final_output_2"];
  $final_performance_1_1 = $row_student_record1["final_performance_1"];
  $final_performance_2_1 = $row_student_record1["final_performance_2"];
  $final_written_test_1 = $row_student_record1["final_written_test"];

  // $check_pre_requisite = 0;



  // ######################## Check Grades #################

$row_student = mysqli_fetch_assoc($final_qry);
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
$prelim_written_test_base =  $prelim_written_test / 70 * 40 + 60;

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
$midterm_written_test_base = $midterm_written_test / 70 * 40 + 60;

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
$prefinal_written_test_base = $prefinal_written_test / 70 * 40 + 60; //ok

$prefinal_output_weight = $prefinal_output_base * 0.40; //ok
$prefinal_performance_weight = $prefinal_performance_base * 0.40; //ok
$prefinal_written_test_weight = $prefinal_written_test_base * 0.20; //ok

$prefinal_3rd_quarter = $prefinal_output_weight + $prefinal_performance_weight + $prefinal_written_test_weight; //ok
$prefinal_grade = $midterm_grade * 0.3 + $prefinal_3rd_quarter * 0.7;


$check_prelim_grade = $prelim_output_1 + $prelim_output_2 + $prelim_performance_1 + $prelim_performance_2 + $prelim_written_test;
$check_midterm_grade = $midterm_output_1 + $midterm_output_2 + $midterm_performance_1 + $midterm_performance_2 + $midterm_written_test;
$check_prefinal_grade = $prefinal_output_1 + $prefinal_output_2 + $prefinal_performance_1 + $prefinal_performance_2 + $prefinal_written_test;


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
    $final_written_test_base = $final_written_test / 70 * 40 + 60;
    $final_written_test_weight = $final_written_test_base * 0.20;
    $final_4th_quarter = $final_output_weight + $final_performance_weight + $final_written_test_weight;
    $final_grade = $prefinal_grade * 0.3 + $final_4th_quarter * 0.7;










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





  // if(($final_output_1_1 > 0) & ($final_output_2_1 > 0) & ($final_performance_1_1 > 0) & ($final_performance_2_1 > 0) & ($final_written_test_1 > 0)){
  //   $check_pre_requisite = 1;
  // }

  $rewrite_student_no = "1";
      
  if($grading_period == "midterm"){
    if(!($check_prelim_grade >0)){
      $new_student_no = $rewrite_student_no;
    }
  }
  if($grading_period == "prefinal"){
    if(!($check_midterm_grade > 0)){
      $new_student_no = $rewrite_student_no;
    }
  }
  if($grading_period == "final"){
    if(!($check_prefinal_grade > 0)){
      $new_student_no = $rewrite_student_no;
    }
  }
      // echo $new_student_no;

  if(isset($_POST["input_grade"])){


    if(!empty($_POST[$new_student_no])){
      
      $new__output_1_data = $_POST[$new_student_no];

      // echo $new_student_no;

      mysqli_query($connections, "UPDATE $grading SET $column_data='$new__output_1_data'
      WHERE student_no=$new_student_no");

      if($grading_period == "prefinal"){
        mysqli_query($connections, "UPDATE $grading SET prefinal_prediction='' WHERE student_no=$new_student_no ");
      }
      if($grading_period == "final"){
        mysqli_query($connections, "UPDATE $grading SET final_prediction='' WHERE student_no=$new_student_no ");
      }
    }

    
    echo "<script>window.location.href='studentperformance?redir=$grading_period&_y=$year&_c=$course&_s_e_=$semester';</script>";
      

}

?>

  <tr>
  <td class="w-50">
  <label for="<?php echo $new_student_no; ?>" class="float-right"><?php echo $new_student_name; ?> : &nbsp;</label>
  </td>
  <td>
  <input type="text" name="<?php echo $new_student_no; ?>" value="<?php echo $selected_column; ?>" class="text-center student_no" id="<?php echo $new_student_no; ?>" maxlength="2" size="1" onkeypress='return isNumberKey(event)' <?php if($semester == "sem2"){ if($final1_grade < 74){ echo "disabled"; }else{ if($grading_period == "midterm"){ if(!($check_prelim_grade > 0)){ echo "disabled"; }} if($grading_period == "prefinal"){ if(!($check_midterm_grade > 0)){ echo "disabled"; }} if($grading_period == "final"){ if(!($check_prefinal_grade > 0)){ echo "disabled"; }} } }else{ if($grading_period == "midterm"){ if(!($check_prelim_grade > 0)){ echo "disabled"; }} if($grading_period == "prefinal"){ if(!($check_midterm_grade > 0)){ echo "disabled"; }} if($grading_period == "final"){ if(!($check_prefinal_grade > 0)){ echo "disabled"; }}} ?>>
  </td>
  <td>
  <span class="mr-2">
  <?php
    if($card_title == "Major Exam"){
        echo "/70";
    }else{
      echo "/20";
    }
  ?>
  </span>
  </td>
  <td>
<?php
  if($semester == "sem2"){
    if($final1_grade < 74){
      // echo "<small style='color:red;'>Pre&#8209;requisite</small>";
      echo "<small style='color:red;'>Take the pre-requisite subject: IT 2 - Application Programming 1</small>";
    }else{
      if($grading_period == "midterm"){
        if(!($check_prelim_grade >0)){
          echo "<small style='color:red;'>Failed prelim grade</small>";
        }
      }
        if($grading_period == "prefinal"){
          if(!($check_midterm_grade > 0)){
            echo "<small style='color:red;'>Failed midterm grade</small>";
          }
        }
        if($grading_period == "final"){
          if(!($check_prefinal_grade > 0)){
            echo "<small style='color:red;'>Failed prefinal grade</small>";
          }
        }
    }
  }else{
  if($grading_period == "midterm"){
    if(!($check_prelim_grade >0)){
      echo "<small style='color:red;'>Failed prelim grade</small>";
    }
  }
    if($grading_period == "prefinal"){
      if(!($check_midterm_grade > 0)){
        echo "<small style='color:red;'>Failed midterm grade</small>";
      }
    }
    if($grading_period == "final"){
      if(!($check_prefinal_grade > 0)){
        echo "<small style='color:red;'>Failed prefinal grade</small>";
      }
    }
  }
?>
  
  </td>
  </tr>
  <tr>
  <td colspan="4"><hr></td>
  </tr>

<?php
}
?>

  </table>
  
  </div>
  
  <div class="card-footer bg-info">
  
  <input type="submit" class="btn btn-warning float-right" value="Submit Grade" name="input_grade">
  </form>
  </div>
</div>
</div>
<!-- </center> -->

<style>

#grade{
    border:none;
    border-bottom:1px solid gray;
}
</style>


<script>
  function isNumberKey(evt){

    // alert(this.innerHTML);
    var charCode = (evt.which) ? evt.which : event.keyCode
    if(charCode > 31 && (charCode < 40 || charCode > 41) && ( charCode < 48 || charCode > 57) && charCode != 43  && charCode != 45 )
        return false;
    return true;

  }


  function max_value(){
    var column_data = document.getElementById("column_data");
    var _grading_period = document.getElementById("_grading_period").value;
    
      if(column_data.value == _grading_period+"_written_test"){
        if(this.value > 70){
          alert("Input is greater than 70");
          this.value = "";
        }
      }else{
        if(this.value > 20){
          alert("Input is greater than 20");
          this.value = "";
        }
      }
    
  }

  var student_box = document.getElementsByClassName("student_no");
  for(q=0; q < student_box.length; q++){
    student_box.item(q).addEventListener("keyup", max_value);
  }


  window.onkeyup = function (event) {
    var _grading_period = document.getElementById("_grading_period").value;
    var _year = document.getElementById("_year").value;
    var _course = document.getElementById("_course").value;
    var _semester = document.getElementById("_semester").value;

  if (event.keyCode == 27) {
    // alert(_year);
    // document.getElementById(boxid).style.visibility="hidden";
    // window.location.href = "prediction";
    // alert("hay");
    window.location.href='studentperformance?redir='+_grading_period+'&_y='+_year+'&_c='+_course+'&_s_e_='+_semester;
    // alert('studentperformance?redir='+_grading_period+'&_y='+_year+'&_c='+_course+'&_s_e_='+_semester+');

  }
 }


</script>