
<!-- <input type="text" id="a1" value="<?php /* echo $_GET["a1"]; */?>">
<script>
var a1 = document.getElementById("a1").value;
window.location.href = "studentperformance?redir=prelim&&a1="+a1;
</script> -->

<?php

// if(isset($_GET["a1"])){
//     $student_no = $_GET["a1"];
// }elseif(isset($_GET["a2"])) {
//     $student_no = $_GET["a2"];
// }elseif(isset($_GET["a3"])) {
//     $student_no = $_GET["a3"];
// }elseif(isset($_GET["a4"])) {
//     $student_no = $_GET["a4"];
// }elseif(isset($_GET["a5"])) {
//     $student_no = $_GET["a5"];
// }elseif(isset($_GET["a6"])) {
//     $student_no = $_GET["a6"];
// }elseif(isset($_GET["a7"])) {
//     $student_no = $_GET["a7"];
// }elseif(isset($_GET["a8"])) {
//     $student_no = $_GET["a8"];
// }elseif(isset($_GET["a9"])) {
//     $student_no = $_GET["a9"];
// }elseif(isset($_GET["a10"])) {
//     $student_no = $_GET["a10"];
// }elseif(isset($_GET["pfats"])) {
//     $student_no = $_GET["pfats"];
// }elseif(isset($_GET["pfab"])) {
//     $student_no = $_GET["pfab"];

function get_url_data(){
    $grading_period = $_GET["redir"];
    $grading = $_GET["redir"].$_GET["_s_e_"][3];
    $year = $_GET["_y"];
    $course = $_GET["_c"];
    $semester = $_GET["_s_e_"];
}

// /* }else */if(isset($_GET["po1"])) {
//     $grading_period = $_GET["redir"];
//     $grading = $_GET["redir"].$_GET["_s_e_"][3];
//     $year = $_GET["_y"];
//     $course = $_GET["_c"];
//     $semester = $_GET["_s_e_"];
//     $student_no = $_GET["po1"];
// }elseif(isset($_GET["po2"])) {
//     $grading_period = $_GET["redir"];
//     $grading = $_GET["redir"].$_GET["_s_e_"][3];
//     $year = $_GET["_y"];
//     $course = $_GET["_c"];
//     $semester = $_GET["_s_e_"];
//     $student_no = $_GET["po2"];
// }elseif(isset($_GET["pots"])) {
//     $grading_period = $_GET["redir"];
//     $grading = $_GET["redir"].$_GET["_s_e_"][3];
//     $year = $_GET["_y"];
//     $course = $_GET["_c"];
//     $semester = $_GET["_s_e_"];
//     $student_no = $_GET["pots"];
// }elseif(isset($_GET["pob"])) {
//     $grading_period = $_GET["redir"];
//     $grading = $_GET["redir"].$_GET["_s_e_"][3];
//     $year = $_GET["_y"];
//     $course = $_GET["_c"];
//     $semester = $_GET["_s_e_"];
//     $student_no = $_GET["pob"];
// }elseif(isset($_GET["pow"])) {
//     $grading_period = $_GET["redir"];
//     $grading = $_GET["redir"].$_GET["_s_e_"][3];
//     $year = $_GET["_y"];
//     $course = $_GET["_c"];
//     $semester = $_GET["_s_e_"];
//     $student_no = $_GET["pow"];
// }elseif(isset($_GET["pp1"])) {
//     $grading_period = $_GET["redir"];
//     $grading = $_GET["redir"].$_GET["_s_e_"][3];
//     $year = $_GET["_y"];
//     $course = $_GET["_c"];
//     $semester = $_GET["_s_e_"];
//     $student_no = $_GET["pp1"];
// }elseif(isset($_GET["pp2"])) {
//     $grading_period = $_GET["redir"];
//     $grading = $_GET["redir"].$_GET["_s_e_"][3];
//     $year = $_GET["_y"];
//     $course = $_GET["_c"];
//     $semester = $_GET["_s_e_"];
//     $student_no = $_GET["pp2"];
// }elseif(isset($_GET["ppts"])) {
//     $grading_period = $_GET["redir"];
//     $grading = $_GET["redir"].$_GET["_s_e_"][3];
//     $year = $_GET["_y"];
//     $course = $_GET["_c"];
//     $semester = $_GET["_s_e_"];
//     $student_no = $_GET["ppts"];
// }elseif(isset($_GET["ppb"])) {
//     $grading_period = $_GET["redir"];
//     $grading = $_GET["redir"].$_GET["_s_e_"][3];
//     $year = $_GET["_y"];
//     $course = $_GET["_c"];
//     $semester = $_GET["_s_e_"];
//     $student_no = $_GET["ppb"];
// }elseif(isset($_GET["ppw"])) {
//     $grading_period = $_GET["redir"];
//     $grading = $_GET["redir"].$_GET["_s_e_"][3];
//     $year = $_GET["_y"];
//     $course = $_GET["_c"];
//     $semester = $_GET["_s_e_"];
//     $student_no = $_GET["ppw"];
// }elseif(isset($_GET["pwt"])) {
//     $grading_period = $_GET["redir"];
//     $grading = $_GET["redir"].$_GET["_s_e_"][3];
//     $year = $_GET["_y"];
//     $course = $_GET["_c"];
//     $semester = $_GET["_s_e_"];
//     $student_no = $_GET["pwt"];
// }elseif(isset($_GET["pwtb"])) {
//     $grading_period = $_GET["redir"];
//     $grading = $_GET["redir"].$_GET["_s_e_"][3];
//     $year = $_GET["_y"];
//     $course = $_GET["_c"];
//     $semester = $_GET["_s_e_"];
//     $student_no = $_GET["pwtb"];
// }elseif(isset($_GET["pwtw"])) {
//     $grading_period = $_GET["redir"];
//     $grading = $_GET["redir"].$_GET["_s_e_"][3];
//     $year = $_GET["_y"];
//     $course = $_GET["_c"];
//     $semester = $_GET["_s_e_"];
//     $student_no = $_GET["pwtw"];
// }elseif(isset($_GET["pg"])) {
//     $grading_period = $_GET["redir"];
//     $grading = $_GET["redir"].$_GET["_s_e_"][3];
//     $year = $_GET["_y"];
//     $course = $_GET["_c"];
//     $semester = $_GET["_s_e_"];
//     $student_no = $_GET["pg"];
// }elseif(isset($_GET["pge"])) {
    $grading_period = $_GET["redir"];
    $grading = $_GET["redir"].$_GET["_s_e_"][3];
    $year = $_GET["_y"];
    $course = $_GET["_c"];
    $semester = $_GET["_s_e_"];
    $student_no = $_GET["in_"];
// }

$student_record = mysqli_query($connections, "SELECT * FROM $grading WHERE student_no=$student_no");
$row_student = mysqli_fetch_assoc($student_record);

$student_name = $row_student["student_name"];
$_output_1 = $row_student[$_GET["redir"]."_output_1"];
$_output_2 = $row_student[$_GET["redir"]."_output_2"];
$_performance_1 = $row_student[$_GET["redir"]."_performance_1"];
$_performance_2 = $row_student[$_GET["redir"]."_performance_2"];
$_written_test = $row_student[$_GET["redir"]."_written_test"];

// if(isset($_GET["a1"])){
//     $grade = $row_student["prelim_formative_assessment_1"];
// }elseif(isset($_GET["a2"])) {
//     $grade = $row_student["prelim_formative_assessment_2"];
// }elseif(isset($_GET["a3"])) {
//     $grade = $row_student["prelim_formative_assessment_3"];
// }elseif(isset($_GET["a4"])) {
//     $grade = $row_student["prelim_formative_assessment_4"];
// }elseif(isset($_GET["a5"])) {
//     $grade = $row_student["prelim_formative_assessment_5"];
// }elseif(isset($_GET["a6"])) {
//     $grade = $row_student["prelim_formative_assessment_6"];
// }elseif(isset($_GET["a7"])) {
//     $grade = $row_student["prelim_formative_assessment_7"];
// }elseif(isset($_GET["a8"])) {
//     $grade = $row_student["prelim_formative_assessment_8"];
// }elseif(isset($_GET["a9"])) {
//     $grade = $row_student["prelim_formative_assessment_9"];
// }elseif(isset($_GET["a10"])) {
//     $grade = $row_student["prelim_formative_assessment_10"];
// }elseif(isset($_GET["pfats"])) {
//     $grade = $row_student["prelim_formative_assessment_total_score"];
// }elseif(isset($_GET["pfab"])) {
//     $grade = $row_student["prelim_formative_assessment_base"];
/* }else */if(isset($_GET["po1"])) {

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

// }elseif(isset($_GET["pots"])) {
//     $grade = $row_student["prelim_output_total_score"];
// }elseif(isset($_GET["pob"])) {
//     $grade = $row_student["prelim_output_base"];
// }elseif(isset($_GET["pow"])) {
//     $grade = $row_student["prelim_output_weight"];
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

// }elseif(isset($_GET["ppts"])) {
//     $grade = $row_student["prelim_performance_total_score"];
// }elseif(isset($_GET["ppb"])) {
//     $grade = $row_student["prelim_performance_base"];
// }elseif(isset($_GET["ppw"])) {
    // $grade = $row_student["prelim_performance_weight"];
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

// }elseif(isset($_GET["pwtb"])) {
//     $grade = $row_student["prelim_written_test_base"];
// }elseif(isset($_GET["pwtw"])) {
//     $grade = $row_student["prelim_written_test_weight"];
// }elseif(isset($_GET["pg"])) {
//     $grade = $row_student["prelim_grade"];
// }elseif(isset($_GET["pge"])) {
//     $grade = $row_student["prelim_grade_equivalent"];
}


switch (true) {
    //   case ($prelim_grade <= 74.4):
    //       $grade_name = "5";
    //       break;
    //   case (!empty($_GET["a1"])):
    //       $grade_name = "prelim_formative_assessment_1";
    //       $grade_number = "Quiz 1";
    //       break;
    //   case (!empty($_GET["a2"])):
    //       $grade_name = "prelim_formative_assessment_2";
    //       $grade_number = "Quiz 2";
    //       break;
    //   case (!empty($_GET["a3"])):
    //       $grade_name = "prelim_formative_assessment_3";
    //       $grade_number = "Quiz 3";
    //       break;
    //   case (!empty($_GET["a4"])):
    //       $grade_name = "prelim_formative_assessment_4";
    //       $grade_number = "Quiz 4";
    //       break;
    //   case (!empty($_GET["a5"])):
    //       $grade_name = "prelim_formative_assessment_5";
    //       $grade_number = "Quiz 5";
    //       break;
    //   case (!empty($_GET["a6"])):
    //       $grade_name = "prelim_formative_assessment_6";
    //       $grade_number = "Quiz 6";
    //       break;
    //   case (!empty($_GET["a7"])):
    //       $grade_name = "prelim_formative_assessment_7";
    //       $grade_number = "Quiz 7";
    //       break;
    //   case (!empty($_GET["a8"])):
    //       $grade_name = "prelim_formative_assessment_8";
    //       $grade_number = "Quiz 8";
    //       break;
    //   case (!empty($_GET["a9"])):
    //       $grade_name = "prelim_formative_assessment_9";
    //       $grade_number = "Quiz 9";
    //       break;
    //   case (!empty($_GET["a10"])):
    //       $grade_name = "prelim_formative_assessment_10";
    //       $grade_number = "Quiz 10";
    //       break;
    //   case (!empty($_GET["pfats"])):
    //       $grade_name = "";
    //       $grade_number = "";
    //       break;
    //   case (!empty($_GET["pfab"])):
    //       $grade_name = "";
    //       $grade_number = "";
    //       break;
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

    //   case (!empty($_GET["pots"])):
    //       $grade_name = "";
    //       $grade_number = "";
    //       break;
    //   case (!empty($_GET["pob"])):
    //       $grade_name = "";
    //       $grade_number = "";
    //       break;
    //   case (!empty($_GET["pow"])):
    //       $grade_name = "";
    //       $grade_number = "";
    //       break;
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
        
    //   case (!empty($_GET["ppts"])):
    //       $grade_name = "";
    //       $grade_number = "";
    //       break;
    //   case (!empty($_GET["ppb"])):
    //       $grade_name = "";
    //       $grade_number = "";
    //       break;
    //   case (!empty($_GET["ppw"])):
    //       $grade_name = "";
    //       $grade_number = "";
    //       break;
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

    //   case (!empty($_GET["pwtb"])):
    //       $grade_name = "";
    //       $grade_number = "";
    //       break;
    //   case (!empty($_GET["pwtw"])):
    //       $grade_name = "";
    //       $grade_number = "";
    //       break;
    //   case (!empty($_GET["pg"])):
    //       $grade_name = "";
    //       $grade_number = "";
    //       break;
    //   case (!empty($_GET["pge"])):
    //       $grade_name = "";
    //       $grade_number = "";
    //       break;

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


  if(isset($_POST["input_grade"])){
      // if(!empty($_POST["grade_input"])){
      //   //   echo "<script>alert('ahy');</script>";
      //   $grade = $_POST["grade_input"];

      //   mysqli_query($connections, "UPDATE $grading SET $grade_name='$grade'
      //   WHERE student_no=$student_no");
        
      //   echo "<script>window.location.href='studentperformance?redir=$grading_period&_y=$year&_c=$course&_s_e_=$semester'</script>";
      
      // }

      if(!empty($_POST[$_GET["redir"]."_output_1"])){
        $output_1_grade_post = $_POST[$_GET["redir"]."_output_1"];
        $output_1_grade = $_GET["redir"]."_output_1";
        
          // echo "<script>alert('hay');</script>";
        mysqli_query($connections, "UPDATE $grading SET $output_1_grade='$output_1_grade_post'
        WHERE student_no=$student_no");
      }

      if(!empty($_POST[$_GET["redir"]."_output_2"])){
        $output_2_grade_post = $_POST[$_GET["redir"]."_output_2"];
        $output_2_grade = $_GET["redir"]."_output_2";
        
          // echo "<script>alert('hay');</script>";
        mysqli_query($connections, "UPDATE $grading SET $output_2_grade='$output_2_grade_post'
        WHERE student_no=$student_no");
      }

        if(!empty($_POST[$_GET["redir"]."_performance_1"])){
          $performance_1_grade_post = $_POST[$_GET["redir"]."_performance_1"];
          $performance_1_grade = $_GET["redir"]."_performance_1";
          
            // echo "<script>alert('hay');</script>";
          mysqli_query($connections, "UPDATE $grading SET $performance_1_grade='$performance_1_grade_post'
          WHERE student_no=$student_no");
        }

          if(!empty($_POST[$_GET["redir"]."_performance_2"])){
            $performance_2_grade_post = $_POST[$_GET["redir"]."_performance_2"];
            $performance_2_grade = $_GET["redir"]."_performance_2";
            
              // echo "<script>alert('hay');</script>";
            mysqli_query($connections, "UPDATE $grading SET $performance_2_grade='$performance_2_grade_post'
            WHERE student_no=$student_no");
          }

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

 <h3 class="position-fixed "><?php echo $student_name; ?></h3>
 <p></p>
  <div class="card-header bg-info">
  <font color="white"> Input Grade </font>
  </div>

  <div class="card-body">
  <form method="POST">
  <table>

  <tr>
  <td class="w-50">
  <label for="<?php echo $_GET["redir"]; ?>_output_1" class="float-right"><?php echo ucfirst($_GET["redir"]); ?> Output 1: &nbsp;</label>
  </td>
  <td class="w-25">
  <input type="text" name="<?php echo $_GET["redir"]; ?>_output_1" value="<?php echo $_output_1; ?>" class="w-50 text-center" id="<?php echo $_GET["redir"]; ?>_output_1">
  </td>
  <td>
  <input type="submit" class="btn btn-warning float-right" value="Submit Grade" name="output_1">
  </td>
  </tr>


  <tr>
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
  </tr>
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