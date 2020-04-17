
<!-- <input type="text" id="a1" value="<?php /* echo $_GET["a1"]; */?>">
<script>
var a1 = document.getElementById("a1").value;
window.location.href = "studentperformance?redir=prelim&&a1="+a1;
</script> -->

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


$student_record = mysqli_query($connections, "SELECT * FROM $grading WHERE year='$year' AND course='$course' AND semester='$semester[3]' ");
$row_student = mysqli_fetch_assoc($student_record);

$student_name = $row_student["student_name"];
$_output_1 = $row_student[$_GET["redir"]."_output_1"];
$_output_2 = $row_student[$_GET["redir"]."_output_2"];
$_performance_1 = $row_student[$_GET["redir"]."_performance_1"];
$_performance_2 = $row_student[$_GET["redir"]."_performance_2"];
$_written_test = $row_student[$_GET["redir"]."_written_test"];

if(isset($_GET["po1"])) {

    if($_GET["redir"] == "prelim"){
        $grade = $row_student["prelim_output_1"];
    }

    if($_GET["redir"] == "midterm"){
        $grade = $row_student["midterm_output_1"];
    }

    if($_GET["redir"] == "prefinal"){
        $grade = $row_student["prefinal_output_1"];
    }

    if($_GET["redir"] == "final"){
        $grade = $row_student["final_output_1"];
    }

}elseif(isset($_GET["po2"])) {
    
    if($_GET["redir"] == "prelim"){
    $grade = $row_student["prelim_output_2"];
    }

    if($_GET["redir"] == "midterm"){
    $grade = $row_student["midterm_output_2"];
    }

    if($_GET["redir"] == "prefinal"){
    $grade = $row_student["prefinal_output_2"];
    }

    if($_GET["redir"] == "final"){
    $grade = $row_student["final_output_2"];
    }


}elseif(isset($_GET["pp1"])) {

    if($_GET["redir"] == "prelim"){
    $grade = $row_student["prelim_performance_1"];
    }

    if($_GET["redir"] == "midterm"){
    $grade = $row_student["midterm_performance_1"];
    }

    if($_GET["redir"] == "prefinal"){
    $grade = $row_student["prefinal_performance_1"];
    }

    if($_GET["redir"] == "final"){
    $grade = $row_student["final_performance_1"];
    }

}elseif(isset($_GET["pp2"])) {

    if($_GET["redir"] == "prelim"){
    $grade = $row_student["prelim_performance_2"];
    }

    if($_GET["redir"] == "midterm"){
    $grade = $row_student["midterm_performance_2"];
    }

    if($_GET["redir"] == "prefinal"){
    $grade = $row_student["prefinal_performance_2"];
    }

    if($_GET["redir"] == "final"){
    $grade = $row_student["final_performance_2"];
    }


}elseif(isset($_GET["pwt"])) {

    if($_GET["redir"] == "prelim"){
    $grade = $row_student["prelim_written_test"];
    }

    if($_GET["redir"] == "midterm"){
    $grade = $row_student["midterm_written_test"];
    }

    if($_GET["redir"] == "prefinal"){
    $grade = $row_student["prefinal_written_test"];
    }

    if($_GET["redir"] == "final"){
    $grade = $row_student["final_written_test"];
    }


}


switch (true) {

      case (!empty($_GET["po1"])):
        if($_GET["redir"] == "prelim"){
            $grade_name = "prelim_output_1";
            $grade_number = "Prelim output 1";
        }

        if($_GET["redir"] == "midterm"){
            $grade_name = "midterm_output_1";
            $grade_number = "Midterm output 1";
        }

        if($_GET["redir"] == "prefinal"){
            $grade_name = "prefinal_output_1";
            $grade_number = "Prefinal output 1";
        }

        if($_GET["redir"] == "final"){
            $grade_name = "final_output_1";
            $grade_number = "Final output 1";
        }

          break;
      case (!empty($_GET["po2"])):
        if($_GET["redir"] == "prelim"){
          $grade_name = "prelim_output_2";
          $grade_number = "Prelim output 2";
          break;
        }
        
        if($_GET["redir"] == "midterm"){
          $grade_name = "midterm_output_2";
          $grade_number = "Midterm output 2";
          break;
        }
        
        if($_GET["redir"] == "prefinal"){
          $grade_name = "prefinal_output_2";
          $grade_number = "Prefinal output 2";
          break;
        }
        
        if($_GET["redir"] == "final"){
          $grade_name = "final_output_2";
          $grade_number = "Final output 2";
          break;
        }

      case (!empty($_GET["pp1"])):
        if($_GET["redir"] == "prelim"){
          $grade_name = "prelim_performance_1";
          $grade_number = "Prelim Performance 1";
          break;
        }
        
        if($_GET["redir"] == "midterm"){
          $grade_name = "midterm_performance_1";
          $grade_number = "Midterm Performance 1";
          break;
        }
        
        if($_GET["redir"] == "prefinal"){
          $grade_name = "prefinal_performance_1";
          $grade_number = "Prefinal Performance 1";
          break;
        }
        
        if($_GET["redir"] == "final"){
          $grade_name = "final_performance_1";
          $grade_number = "Final Performance 1";
          break;
        }

      case (!empty($_GET["pp2"])):
        if($_GET["redir"] == "prelim"){
          $grade_name = "prelim_performance_2";
          $grade_number = "Prelim Performance 2";
          break;
        }
        
        if($_GET["redir"] == "midterm"){
          $grade_name = "midterm_performance_2";
          $grade_number = "Midterm Performance 2";
          break;
        }
        
        if($_GET["redir"] == "prefinal"){
          $grade_name = "prefinal_performance_2";
          $grade_number = "Prefinal Performance 2";
          break;
        }
        
        if($_GET["redir"] == "final"){
          $grade_name = "final_performance_2";
          $grade_number = "final Performance 2";
          break;
        }
        
      case (!empty($_GET["pwt"])):
        if($_GET["redir"] == "prelim"){
          $grade_name = "prelim_written_test";
          $grade_number = "Prelim Written Test";
          break;
        }
        
        if($_GET["redir"] == "midterm"){
          $grade_name = "midterm_written_test";
          $grade_number = "Midterm Written Test";
          break;
        }
        
        if($_GET["redir"] == "prefinal"){
          $grade_name = "prefinal_written_test";
          $grade_number = "Prefinal Written Test";
          break;
        }
        
        if($_GET["redir"] == "final"){
          $grade_name = "final_written_test";
          $grade_number = "Final Written Test";
          break;
        }


      default:
          $grade_name = "5";
  }

  if(isset($_POST["output_1"])){
    if(!empty($_POST[$_GET["redir"]."_output_1"])){
      $output_1_grade_post = $_POST[$_GET["redir"]."_output_1"];
      $output_1_grade = $_GET["redir"]."_output_1";
      
        // echo "<script>alert('hay');</script>";
      mysqli_query($connections, "UPDATE $grading SET $output_1_grade='$output_1_grade_post'
      WHERE student_no=$student_no");
    }
        echo "<script>window.location.href='studentperformance?redir=$grading_period&_y=$year&_c=$course&_s_e_=$semester'</script>";

  }

  if(isset($_POST["output_2"])){
    if(!empty($_POST[$_GET["redir"]."_output_2"])){
      $output_2_grade_post = $_POST[$_GET["redir"]."_output_2"];
      $output_2_grade = $_GET["redir"]."_output_2";
      
        // echo "<script>alert('hay');</script>";
      mysqli_query($connections, "UPDATE $grading SET $output_2_grade='$output_2_grade_post'
      WHERE student_no=$student_no");
    }
        echo "<script>window.location.href='studentperformance?redir=$grading_period&_y=$year&_c=$course&_s_e_=$semester'</script>";

  }

  

  if(isset($_POST["performance_1"])){
    if(!empty($_POST[$_GET["redir"]."_performance_1"])){
      $performance_1_grade_post = $_POST[$_GET["redir"]."_performance_1"];
      $performance_1_grade = $_GET["redir"]."_performance_1";
      
        // echo "<script>alert('hay');</script>";
      mysqli_query($connections, "UPDATE $grading SET $performance_1_grade='$performance_1_grade_post'
      WHERE student_no=$student_no");
    }
        echo "<script>window.location.href='studentperformance?redir=$grading_period&_y=$year&_c=$course&_s_e_=$semester'</script>";

  }


  if(isset($_POST["performance_2"])){
    if(!empty($_POST[$_GET["redir"]."_performance_2"])){
      $performance_2_grade_post = $_POST[$_GET["redir"]."_performance_2"];
      $performance_2_grade = $_GET["redir"]."_performance_2";
      
        // echo "<script>alert('hay');</script>";
      mysqli_query($connections, "UPDATE $grading SET $performance_2_grade='$performance_2_grade_post'
      WHERE student_no=$student_no");
    }
        echo "<script>window.location.href='studentperformance?redir=$grading_period&_y=$year&_c=$course&_s_e_=$semester'</script>";

  }

  

  if(isset($_POST["written_test"])){
    if(!empty($_POST[$_GET["redir"]."_written_test"])){
      $written_test_grade_post = $_POST[$_GET["redir"]."_written_test"];
      $written_test_grade = $_GET["redir"]."_written_test";
      
        // echo "<script>alert('hay');</script>";
      mysqli_query($connections, "UPDATE $grading SET $written_test_grade='$written_test_grade_post'
      WHERE student_no=$student_no");
    }
        echo "<script>window.location.href='studentperformance?redir=$grading_period&_y=$year&_c=$course&_s_e_=$semester'</script>";

  }




?>


<!-- <center> -->
<div class="bg-dark pt-3" style="height:550px;">

<div class="card col-sm-5 mx-auto p-3">
<button type="button" class="close ml-auto bg-info rounded-circle px-1" id="black1">&times;</button>

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

while($row_student_record = mysqli_fetch_assoc($get_student_record)){

  $new_student_name = $row_student_record["student_name"];
  $new_student_no = $row_student_record["student_no"];
  $selected_column = $row_student_record[$column_data];
  // echo $new_student_name;

  if(isset($_POST["input_grade"])){


    if(!empty($_POST[$new_student_no])){
      // $output_1_grade_post = $_POST[$_GET["redir"]."_output_1"];
      // $output_1_grade = $_GET["redir"]."_output_1";
      $new__output_1_data = $_POST[$new_student_no];
      
        // echo "<script>alert('hay');</script>";
      mysqli_query($connections, "UPDATE $grading SET $column_data='$new__output_1_data'
      WHERE student_no=$new_student_no");
    // echo "<script>alert('hay');</script>";
    }

    
    echo "<script>window.location.href='studentperformance?redir=$grading_period&_y=$year&_c=$course&_s_e_=$semester'</script>";
      

}

?>

  <tr>
  <td class="w-75">
  <label for="<?php echo $new_student_no; ?>" class="float-right"><?php echo $new_student_name; ?> : &nbsp;</label>
  </td>
  <td class="w-25">
  <input type="text" name="<?php echo $new_student_no; ?>" value="<?php echo $selected_column; ?>" class="w-50 text-center" id="<?php echo $new_student_no; ?>">
  </td>
  <td>
  <!-- <input type="submit" class="btn btn-warning float-right" value="Submit Grade" name="output_1"> -->
  </td>
  </tr>

<?php
}
?>

  <!-- <tr>
  <td class="w-50">
  <label for="<?php echo $_GET["redir"]; ?>_output_2" class="float-right"><?php echo ucfirst($_GET["redir"]); ?> Output 2: &nbsp;</label>
  </td>
  <td class="w-25">
  <input type="text" name="<?php echo $_GET["redir"]; ?>_output_2" value="<?php echo $_output_2; ?>" class="w-50 text-center" id="<?php echo $_GET["redir"]; ?>_output_2">
  </td>
  <td>
  <input type="submit" class="btn btn-warning float-right" value="Submit Grade" name="output_2">
  </td>
  </tr>


  <tr>
  <td class="w-75">
  <label for="<?php echo $_GET["redir"]; ?>_performance_1" class="float-right"><?php echo ucfirst($_GET["redir"]); ?> Performance 1: &nbsp;</label>
  </td>
  <td class="w-25">
  <input type="text" name="<?php echo $_GET["redir"]; ?>_performance_1" value="<?php echo $_performance_1; ?>" class="w-50 text-center" id="<?php echo $_GET["redir"]; ?>_performance_1">
  </td>
  <td>
  <input type="submit" class="btn btn-warning float-right" value="Submit Grade" name="performance_1">
  </td>
  </tr>


  <tr>
  <td class="w-75">
  <label for="<?php echo $_GET["redir"]; ?>_performance_2" class="float-right"><?php echo ucfirst($_GET["redir"]); ?> Performance 2: &nbsp;</label>
  </td>
  <td class="w-25">
  <input type="text" name="<?php echo $_GET["redir"]; ?>_performance_2" value="<?php echo $_performance_2; ?>" class="w-50 text-center" id="<?php echo $_GET["redir"]; ?>_performance_2">
  </td>
  <td>
  <input type="submit" class="btn btn-warning float-right" value="Submit Grade" name="performance_2">
  </td>
  </tr>


  <tr>
  <td class="w-50">
  <label for="<?php echo $_GET["redir"]; ?>_written_test" class="float-right"><?php echo ucfirst($_GET["redir"]); ?> Major Test: &nbsp;</label>
  </td>
  <td class="w-25">
  <input type="text" name="<?php echo $_GET["redir"]; ?>_written_test" value="<?php echo $_written_test; ?>" class="w-50 text-center" id="<?php echo $_GET["redir"]; ?>_written_test">
  </td>
  <td>
  <input type="submit" class="btn btn-warning float-right" value="Submit Grade" name="written_test">
  </td>
  </tr> -->
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