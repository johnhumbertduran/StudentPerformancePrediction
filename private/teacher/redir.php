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
$get_student_record1 = mysqli_query($connections, "SELECT * FROM final1 WHERE year='$year' AND course='$course' AND semester='1'  ");

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

  $check_pre_requisite = 0;

  if(($final_output_1_1 > 0) & ($final_output_2_1 > 0) & ($final_performance_1_1 > 0) & ($final_performance_2_1 > 0) & ($final_written_test_1 > 0)){
    $check_pre_requisite = 1;
  }

  if(isset($_POST["input_grade"])){


    if(!empty($_POST[$new_student_no])){
      
      $new__output_1_data = $_POST[$new_student_no];
      
      mysqli_query($connections, "UPDATE $grading SET $column_data='$new__output_1_data'
      WHERE student_no=$new_student_no");

      if($grading_period == "prefinal"){
        mysqli_query($connections, "UPDATE $grading SET prefinal_prediction='' ");
      }
      if($grading_period == "final"){
        mysqli_query($connections, "UPDATE $grading SET final_prediction='' ");
      }
    }

    
    echo "<script>window.location.href='studentperformance?redir=$grading_period&_y=$year&_c=$course&_s_e_=$semester';</script>";
      

}

?>

  <tr>
  <td class="w-75">
  <label for="<?php echo $new_student_no; ?>" class="float-right"><?php echo $new_student_name; ?> : &nbsp;</label>
  </td>
  <td>
  <input type="text" name="<?php echo $new_student_no; ?>" value="<?php echo $selected_column; ?>" class="text-center student_no" id="<?php echo $new_student_no; ?>" maxlength="2" size="1" onkeypress='return isNumberKey(event)' <?php if($semester == "sem2"){ if($check_pre_requisite != 1){ echo "disabled"; }} ?>>
  </td>
  <td>
<?php
  if($semester == "sem2"){
    if($check_pre_requisite != 1){
      echo "<small style='color:red;'>Pre&#8209;requisite</small>";
      }
    }
?>
  
  </td>
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