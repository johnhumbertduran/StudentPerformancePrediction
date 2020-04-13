<style>
.text-primary{
  cursor:pointer;
}
</style>
<?php

// $midterm_formative_assessment_1 = $midterm_formative_assessment_2 =
// $midterm_formative_assessment_3 = $midterm_formative_assessment_4 =
// $midterm_formative_assessment_5 = $midterm_formative_assessment_6 =
// $midterm_formative_assessment_7 = $midterm_formative_assessment_8 =
// $midterm_formative_assessment_9 = $midterm_formative_assessment_10 =
// $midterm_formative_assessment_total_score = $midterm_formative_assessment_base =
$midterm_output_1 = $midterm_output_2 =
$midterm_output_total_score = $midterm_output_base =
$midterm_output_weight = $midterm_performance_1 =
$midterm_performance_2 = $midterm_performance_total_score =
$midterm_performance_base = $midterm_performance_weight =
$midterm_written_test = $midterm_written_test_base =
$midterm_written_test_weight = $midterm_2nd_quarter =
$midterm_grade = $midterm_grade_equivalent = "0";
$midterm_remarks = "";



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
    <tr><th class="px-3" colspan="2"></th><th class="px-3 text-center bg-primary text-white" colspan="17">Midterm</th></tr><!-- Midterm Here -->

    <tr><th class="px-3">Student&nbsp;ID</th><th class="px-3">Student&nbsp;Name</th>
    <!-- <th class="px-5 text-center bg-primary text-white" colspan="12">Formative Assessment</th> --><th class="px-5 text-center bg-primary text-white" colspan="5">Output</th><th class="px-5 text-center bg-primary text-white" colspan="5">Performance</th><th class="px-5 text-center bg-primary text-white" colspan="3">Major&nbsp;Exam</th><th class="px-2 text-center bg-primary text-white">2nd&nbsp;Quarter</th><th class="px-2 text-center bg-primary text-white">Midterm&nbsp;Grade</th><th class="px-2 text-center bg-primary text-white">Equivalent</th><th class="px-2 text-center bg-primary text-white">Remarks</th></tr><!-- Midterm Here -->

    <tr><th class="px-3"></th><th class="px-3">Highest&nbsp;Possible&nbsp;Score</th>
    <!-- <th class="bg-primary text-white">10</th><th class="bg-primary text-white">10</th><th class="bg-primary text-white">10</th><th class="bg-primary text-white">10</th><th class="bg-primary text-white">10</th><th class="bg-primary text-white">10</th><th class="bg-primary text-white">10</th><th class="bg-primary text-white">10</th><th class="bg-primary text-white">10</th><th class="bg-primary text-white">10</th><th class="bg-primary text-white">100</th><th class="bg-primary text-white">60</th> --><th class="bg-primary text-white">20</th><th class="bg-primary text-white">20</th><th class="bg-primary text-white">40</th><th class="bg-primary text-white">60</th><th class="bg-primary text-white">0.40</th><th class="bg-primary text-white">20</th><th class="bg-primary text-white">20</th><th class="bg-primary text-white">40</th><th class="bg-primary text-white">60</th><th class="bg-primary text-white">0.40</th><th class="bg-primary text-white">30</th><th class="bg-primary text-white">60</th><th class="bg-primary text-white">0.20</th><th class="bg-primary text-white"></th><th class="bg-primary text-white"></th><th class="bg-primary text-white"></th><th class="bg-primary text-white"></th></tr><!-- Midterm Here -->
    </thead>

    <tbody>

<?php

if($grade_period == "midterm"){
    if(isset($_GET["_y"])){
      if($year == $_GET["_y"]){
        if(isset($_GET["_c"])){
          if($course == $_GET["_c"]){
            // if(isset($_GET["_s"])){
            //   if($subject == $_GET["_s"]){
                if(isset($_GET["_s_e_"])){
                  if($semester == $_GET["_s_e_"]){
      // $student_qry = mysqli_query($connections, "SELECT * FROM _user_tbl_ WHERE year=$year AND account_type='2' ");
      // echo $_GET["_y"];
    // echo"<script>alert('hay');</script>";
                    $grade_period = $grade_period . $semester[3];
                    // $semester_no = $semester[3];
                    $prelim = "prelim$semester[3]"; 

                    // echo $prelim;
                    // $get_student_no = mysqli_query($connections, "SELECT * FROM $grade_period");
                    // $fetch_student_no = mysqli_fetch_assoc($get_student_no);
                    // $student_no = $fetch_student_no["student_no"];
                    // $fullname = $fetch_student_no["student_name"];

                    // $student_qry = mysqli_query($connections, "SELECT * FROM _user_tbl_ WHERE course='$course' AND year='$year' AND account_type='2'");
                    $grading_period = mysqli_query($connections, "SELECT * FROM $grade_period WHERE course='$course' AND year='$year' ");
                    $prelim_qry = mysqli_query($connections, "SELECT * FROM $prelim WHERE course='$course' AND year='$year' ");
                    // $row_prelim = mysqli_fetch_assoc($prelim_qry);



                    prelim_query($grading_period,$prelim_qry);
                  }
                }
            //   }
            // }
          }
        }
      }
    }
  }
  

// $student_qry = mysqli_query($connections, "SELECT * FROM _user_tbl_ WHERE account_type='2'");

function prelim_query($grading_period,$prelim_qry){
while($row_student = mysqli_fetch_assoc($grading_period)){

  $student_no = $row_student["student_no"];
//   $lastname = $row_student["lastname"];
//   $firstname = $row_student["firstname"];
//   $middlename = $row_student["middlename"];
  $fullname = $row_student["student_name"];
  $row_prelim = mysqli_fetch_assoc($prelim_qry);
  $midterm_output_1 = $row_student["midterm_output_1"];
  $midterm_output_2 = $row_student["midterm_output_2"];
  $midterm_output_total_score = $row_student["midterm_output_total_score"];
  $midterm_output_base = $row_student["midterm_output_base"];
  $midterm_output_weight = $row_student["midterm_output_weight"];
  $midterm_performance_1 = $row_student["midterm_performance_1"];
  $midterm_performance_2 = $row_student["midterm_performance_2"];
  $midterm_performance_total_score = $row_student["midterm_performance_total_score"];
  $midterm_performance_base = $row_student["midterm_performance_base"];
  $midterm_performance_weight = $row_student["midterm_performance_weight"];
  $midterm_written_test = $row_student["midterm_written_test"];
  $midterm_written_test_base = $row_student["midterm_written_test_base"];
  $midterm_written_test_weight = $row_student["midterm_written_test_weight"];
  $midterm_2nd_quarter = $row_student["midterm_2nd_quarter"];
  $midterm_grade = $row_student["midterm_grade"];
  $midterm_grade_equivalent = $row_student["midterm_grade_equivalent"];
  $midterm_remarks = $row_student["midterm_remarks"];
  

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
// echo $prelim_grade;
// $prelim_grade = $row_prelim["prelim_grade"];


    // ####################______Midterm Formulas______####################
    // $midterm_formative_assessment_total_score =
    // $midterm_formative_assessment_1 + $midterm_formative_assessment_2 +
    // $midterm_formative_assessment_3 + $midterm_formative_assessment_4 +
    // $midterm_formative_assessment_5 + $midterm_formative_assessment_6 +
    // $midterm_formative_assessment_7 + $midterm_formative_assessment_8 +
    // $midterm_formative_assessment_9 + $midterm_formative_assessment_10;

    // $midterm_formative_assessment_base = $midterm_formative_assessment_total_score / 100 * 40 + 60;
    $midterm_output_total_score = $midterm_output_1 + $midterm_output_2;
    $midterm_output_base = $midterm_output_total_score / 40 * 40 + 60;
    $midterm_output_weight = $midterm_output_base * 0.40;
    $midterm_performance_total_score = $midterm_performance_1 + $midterm_performance_2;
    $midterm_performance_base = $midterm_performance_total_score / 40 * 40 + 60;
    $midterm_performance_weight = $midterm_performance_base * 0.40;
    $midterm_written_test_base = $midterm_written_test / 70 * 40 + 60;
    $midterm_written_test_weight = $midterm_written_test_base * 0.20;
    $midterm_2nd_quarter = $midterm_output_weight + $midterm_performance_weight + $midterm_written_test_weight;
    $midterm_grade = $prelim_grade * 0.3 + $midterm_2nd_quarter * 0.7;


    switch (true) {
      case ($midterm_grade >= 74.5 && $midterm_grade <= 76.4):
          $midterm_grade_equivalent = "3";
          break;
      case ($midterm_grade >= 76.5 && $midterm_grade <= 79.4):
          $midterm_grade_equivalent = "2.75";
          break;
      case ($midterm_grade >= 79.5 && $midterm_grade <= 82.4):
          $midterm_grade_equivalent = "2.5";
          break;
      case ($midterm_grade >= 82.5 && $midterm_grade <= 85.4):
          $midterm_grade_equivalent = "2.25";
          break;
      case ($midterm_grade >= 85.5 && $midterm_grade <= 88.4):
          $midterm_grade_equivalent = "2";
          break;
      case ($midterm_grade >= 88.5 && $midterm_grade <= 91.4):
          $midterm_grade_equivalent = "1.75";
          break;
      case ($midterm_grade >= 91.5 && $midterm_grade <= 94.4):
          $midterm_grade_equivalent = "1.5";
          break;
      case ($midterm_grade >= 94.5 && $midterm_grade <= 97.4):
          $midterm_grade_equivalent = "1.25";
          break;
      case ($midterm_grade >= 97.5 && $midterm_grade <= 100):
          $midterm_grade_equivalent = "1";
          break;

      default:
          $midterm_grade_equivalent = "5";
  }

  if($midterm_grade >= 74.5){
    $midterm_remarks = "Passed";
  }else{
    $midterm_remarks = "Failed";
  }


  $year = $_GET["_y"];
  $course = $_GET["_c"];
  $semester = $_GET["_s_e_"];


  ?>

  <tr>
  <td><?php echo $student_no; ?></td>
  <td><?php echo $fullname; ?></td>
  <!-- <td><a href="#"><?php /* echo $midterm_formative_assessment_1; */ ?></a></td> 
  <td><a href="#"><?php /* echo $midterm_formative_assessment_2; */ ?></a></td> 
  <td><a href="#"><?php /* echo $midterm_formative_assessment_3; */ ?></a></td> 
  <td><a href="#"><?php /* echo $midterm_formative_assessment_4; */ ?></a></td> 
  <td><a href="#"><?php /* echo $midterm_formative_assessment_5; */ ?></a></td> 
  <td><a href="#"><?php /* echo $midterm_formative_assessment_6; */ ?></a></td> 
  <td><a href="#"><?php /* echo $midterm_formative_assessment_7; */ ?></a></td> 
  <td><a href="#"><?php /* echo $midterm_formative_assessment_8; */ ?></a></td> 
  <td><a href="#"><?php /* echo $midterm_formative_assessment_9; */ ?></a></td> 
  <td><a href="#"><?php /* echo $midterm_formative_assessment_10; */ ?></a></td> 
  <td><a href="#"><?php /* echo $midterm_formative_assessment_total_score; */ ?></a></td> 
  <td><a href="#"><?php /* echo $midterm_formative_assessment_base; */ ?></a></td>  -->
  <td><a class="text-primary"><?php echo $midterm_output_1; ?></a></td> 
  <td><a class="text-primary"><?php echo $midterm_output_2; ?></a></td> 
  <td><a class="text-primary"><?php echo $midterm_output_total_score; ?></a></td> 
  <td><a class="text-primary"><?php echo $midterm_output_base; ?></a></td> 
  <td><a class="text-primary"><?php echo $midterm_output_weight; ?></a></td> 
  <td><a class="text-primary"><?php echo $midterm_performance_1; ?></a></td> 
  <td><a class="text-primary"><?php echo $midterm_performance_2; ?></a></td> 
  <td><a class="text-primary"><?php echo $midterm_performance_total_score; ?></a></td> 
  <td><a class="text-primary"><?php echo $midterm_performance_base; ?></a></td> 
  <td><a class="text-primary"><?php echo $midterm_performance_weight; ?></a></td> 
  <td><a class="text-primary"><?php echo $midterm_written_test; ?></a></td> 
  <td><a class="text-primary"><?php echo number_format((float)$midterm_written_test_base,2,".",""); ?></a></td> 
  <td><a class="text-primary"><?php echo number_format((float)$midterm_written_test_weight,2,".",""); ?></a></td> 
  <td><center><a class="text-primary"><?php echo number_format((float)$midterm_2nd_quarter,2,".",""); ?></a></center></td> 
  <td><center><a class="<?php if($midterm_grade >= 74.5){ echo 'text-success';}else{echo 'text-danger';} ?>"><?php echo number_format((float)$midterm_grade,2,".",""); ?></a></center></td> 
  <td><center><a class="<?php if($midterm_grade >= 74.5){ echo 'text-success';}else{echo 'text-danger';} ?>"><?php echo $midterm_grade_equivalent; ?></a></center></td> 
  <td><center><a class="<?php if($midterm_remarks == "Failed"){ echo "text-danger";}else{echo "text-success";} ?>"><?php echo $midterm_remarks; ?></a></center></td> 
  
  </tr>

<?php
}
}
?>
</table>
</div>

<div class="fixed-top">
<?php
// if(isset($_GET["a1"])){
//   include("redir.php");
// }elseif(isset($_GET["a2"])){
//   include("redir.php");
// }elseif(isset($_GET["a3"])){
//   include("redir.php");
// }elseif(isset($_GET["a4"])){
//   include("redir.php");
// }elseif(isset($_GET["a5"])){
//   include("redir.php");
// }elseif(isset($_GET["a6"])){
//   include("redir.php");
// }elseif(isset($_GET["a7"])){
//   include("redir.php");
// }elseif(isset($_GET["a8"])){
//   include("redir.php");
// }elseif(isset($_GET["a9"])){
//   include("redir.php");
// }elseif(isset($_GET["a10"])){
//   include("redir.php");
// }elseif(isset($_GET["pfats"])){
//   include("redir.php");
// }elseif(isset($_GET["pfab"])){
//   include("redir.php");
/* }else */if(isset($_GET["po1"])){
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

<input type="hidden" value="<?php echo $_GET["redir"]; ?>" id="grade_period">
<input type="hidden" value="<?php echo $_GET["_y"]; ?>" id="year">
<input type="hidden" value="<?php echo $_GET["_c"]; ?>" id="course">
<input type="hidden" value="<?php echo $_GET["_s_e_"]; ?>" id="semester">

<script>

// var black_cover = document.getElementById("myModal");


// function reload_page(){
//     location.reload();
// }

// black_cover.addEventListener("click", reload_page);

// check if mabuoe du class ni body then reload the page using location.reload();

    // grading = document.getElementById("grade_period").value;
    // year = document.getElementById("year").value;
    // course = document.getElementById("course").value;
    // semester = document.getElementById("semester").value;

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
