<style>

</style>

<?php
// $prefinal_formative_assessment_1 = $prefinal_formative_assessment_2 =
// $prefinal_formative_assessment_3 = $prefinal_formative_assessment_4 =
// $prefinal_formative_assessment_5 = $prefinal_formative_assessment_6 =
// $prefinal_formative_assessment_7 = $prefinal_formative_assessment_8 =
// $prefinal_formative_assessment_9 = $prefinal_formative_assessment_10 =
// $prefinal_formative_assessment_total_score = $prefinal_formative_assessment_base =
$prefinal_output_1 = $prefinal_output_2 =
$prefinal_output_total_score = $prefinal_output_base =
$prefinal_output_weight = $prefinal_performance_1 =
$prefinal_performance_2 = $prefinal_performance_total_score =
$prefinal_performance_base = $prefinal_performance_weight =
$prefinal_written_test = $prefinal_written_test_base =
$prefinal_written_test_weight = $prefinal_3rd_quarter =
$prefinal_grade = $prefinal_grade_equivalent = "0";



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
    <th class="px-3 text-center bg-danger text-white" colspan="17">Prefinal Period</th></tr><!-- Prefinal Here -->

    <tr><th class="px-3">Student&nbsp;ID</th><th class="px-3">Student&nbsp;Name</th>
    <!-- <th class="px-5 text-center bg-danger text-white" colspan="12">Formative Assessment</th> --><th class="px-5 text-center bg-danger text-white" colspan="5">Outpout</th><th class="px-5 text-center bg-danger text-white" colspan="5">Performance</th><th class="px-5 text-center bg-danger text-white" colspan="3">Major&nbsp;Exam</th><th class="px-5 text-center bg-danger text-white">3rd&nbsp;Quarter</th><th class="px-5 text-center bg-danger text-white" colspan="2">Prefinal&nbsp;Grade</th><th class="px-5 text-center bg-danger text-white" colspan="2">Action</th></tr><!-- Prefinal Here -->

    <tr><th class="px-3"></th><th class="px-3">Highest&nbsp;Possible&nbsp;Score</th>
    <!-- <th class="bg-danger text-white">10</th><th class="bg-danger text-white">10</th><th class="bg-danger text-white">10</th><th class="bg-danger text-white">10</th><th class="bg-danger text-white">10</th><th class="bg-danger text-white">10</th><th class="bg-danger text-white">10</th><th class="bg-danger text-white">10</th><th class="bg-danger text-white">10</th><th class="bg-danger text-white">10</th><th class="bg-danger text-white">100</th><th class="bg-danger text-white">60</th> --><th class="bg-danger text-white">20</th><th class="bg-danger text-white">20</th><th class="bg-danger text-white">40</th><th class="bg-danger text-white">60</th><th class="bg-danger text-white">0.40</th><th class="bg-danger text-white">20</th><th class="bg-danger text-white">20</th><th class="bg-danger text-white">40</th><th class="bg-danger text-white">60</th><th class="bg-danger text-white">0.40</th><th class="bg-danger text-white">70</th><th class="bg-danger text-white">60</th><th class="bg-danger text-white">0.20</th><th class="bg-danger text-white"></th><th class="bg-danger text-white"></th><th class="bg-danger text-white"></th><th class="bg-danger text-white"></th></tr><!-- Prefinal Here -->
    </thead>

    <tbody>

<?php


if($grade_period == "prefinal"){
    if(isset($_GET["_y"])){
      if($year == $_GET["_y"]){
        if(isset($_GET["_c"])){
          if($course == $_GET["_c"]){
              if(isset($_GET["_s_e_"])){
                  if($semester == $_GET["_s_e_"]){

                  $grade_period = $grade_period . $semester[3];
                  $semester_no = $semester[3];
                  $midterm_no = "midterm$semester_no"; 
                  $prelim_no = "prelim$semester_no"; 


                  $grading_period = mysqli_query($connections, "SELECT * FROM $grade_period WHERE course='$course' AND year='$year' ");
                  $midterm_qry = mysqli_query($connections, "SELECT * FROM $midterm_no WHERE course='$course' AND year='$year' ");
                  $prelim_qry = mysqli_query($connections, "SELECT * FROM $prelim_no WHERE course='$course' AND year='$year' ");
                    
                  prefinal_query($grading_period,$midterm_qry,$prelim_qry);
              }
            }
          }
        }
      }
    }
  }
  



function prefinal_query($grading_period,$midterm_qry,$prelim_qry){
while($row_student = mysqli_fetch_assoc($grading_period)){

    
  $row_midterm = mysqli_fetch_assoc($midterm_qry);
  $row_prelim = mysqli_fetch_assoc($prelim_qry);
  $student_no = $row_student["student_no"];
  $fullname = $row_student["student_name"];
  $prefinal_output_1 = $row_student["prefinal_output_1"];
  $prefinal_output_2 = $row_student["prefinal_output_2"];
  $prefinal_output_total_score = $row_student["prefinal_output_total_score"];
  $prefinal_output_base = $row_student["prefinal_output_base"];
  $prefinal_output_weight = $row_student["prefinal_output_weight"];
  $prefinal_performance_1 = $row_student["prefinal_performance_1"];
  $prefinal_performance_2 = $row_student["prefinal_performance_2"];
  $prefinal_performance_total_score = $row_student["prefinal_performance_total_score"];
  $prefinal_performance_base = $row_student["prefinal_performance_base"];
  $prefinal_performance_weight = $row_student["prefinal_performance_weight"];
  $prefinal_written_test = $row_student["prefinal_written_test"];
  $prefinal_written_test_base = $row_student["prefinal_written_test_base"];
  $prefinal_written_test_weight = $row_student["prefinal_written_test_weight"];
  $prefinal_grade = $row_student["prefinal_grade"];
  $prefinal_grade_equivalent = $row_student["prefinal_grade_equivalent"];
  
  $midterm_output_1 = $row_midterm["midterm_output_1"];
  $midterm_output_2 = $row_midterm["midterm_output_2"];
  $midterm_performance_1 = $row_midterm["midterm_performance_1"];
  $midterm_performance_2 = $row_midterm["midterm_performance_2"];
  $midterm_written_test = $row_midterm["midterm_written_test"];

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

  
  
  $midterm_grade = $prelim_grade * 0.3 + $midterm_2nd_quarter * 0.7;

  $check_prelim_grade = $prelim_output_1 + $prelim_output_2 + $prelim_performance_1 + $prelim_performance_2 + $prelim_written_test;
  $check_midterm_grade = $midterm_output_1 + $midterm_output_2 + $midterm_performance_1 + $midterm_performance_2 + $midterm_written_test;
// echo $midterm_grade;
// $midterm_qry = mysqli_query($connections, "SELECT * FROM midterm");
// $row_midterm = mysqli_fetch_assoc($midterm_qry);
// $midterm_grade = $row_midterm["midterm_grade"];


    // ####################______Prefinal Formulas______####################
    // $prefinal_formative_assessment_total_score =
    // $prefinal_formative_assessment_1 + $prefinal_formative_assessment_2 +
    // $prefinal_formative_assessment_3 + $prefinal_formative_assessment_4 +
    // $prefinal_formative_assessment_5 + $prefinal_formative_assessment_6 +
    // $prefinal_formative_assessment_7 + $prefinal_formative_assessment_8 +
    // $prefinal_formative_assessment_9 + $prefinal_formative_assessment_10;
  
    // $prefinal_formative_assessment_base = $prefinal_formative_assessment_total_score / 100 * 40 + 60;
    $prefinal_output_total_score = $prefinal_output_1 + $prefinal_output_2;
    $prefinal_output_base = $prefinal_output_total_score / 40 * 40 + 60;
    $prefinal_output_weight = $prefinal_output_base * 0.40;
    $prefinal_performance_total_score = $prefinal_performance_1 + $prefinal_performance_2;
    $prefinal_performance_base = $prefinal_performance_total_score / 40 * 40 + 60;
    $prefinal_performance_weight = $prefinal_performance_base * 0.40;
    $prefinal_written_test_base = $prefinal_written_test / 70 * 40 + 60;
    $prefinal_written_test_weight = $prefinal_written_test_base * 0.20;
    $prefinal_3rd_quarter = $prefinal_output_weight + $prefinal_performance_weight + $prefinal_written_test_weight;
    $prefinal_grade = $midterm_grade * 0.3 + $prefinal_3rd_quarter * 0.7;
  
    switch (true) {
      //   case ($prefinal_grade <= 74.4):
      //       $prefinal_grade_equivalent = "5";
      //       break;
        case ($prefinal_grade >= 74.5 && $prefinal_grade <= 76.49):
            $prefinal_grade_equivalent = "3";
            break;
        case ($prefinal_grade >= 76.5 && $prefinal_grade <= 79.49):
            $prefinal_grade_equivalent = "2.75";
            break;
        case ($prefinal_grade >= 79.5 && $prefinal_grade <= 82.49):
            $prefinal_grade_equivalent = "2.5";
            break;
        case ($prefinal_grade >= 82.5 && $prefinal_grade <= 85.49):
            $prefinal_grade_equivalent = "2.25";
            break;
        case ($prefinal_grade >= 85.5 && $prefinal_grade <= 88.49):
            $prefinal_grade_equivalent = "2";
            break;
        case ($prefinal_grade >= 88.5 && $prefinal_grade <= 91.49):
            $prefinal_grade_equivalent = "1.75";
            break;
        case ($prefinal_grade >= 91.5 && $prefinal_grade <= 94.49):
            $prefinal_grade_equivalent = "1.5";
            break;
        case ($prefinal_grade >= 94.5 && $prefinal_grade <= 97.49):
            $prefinal_grade_equivalent = "1.25";
            break;
        case ($prefinal_grade >= 97.5 && $prefinal_grade <= 100):
            $prefinal_grade_equivalent = "1";
            break;
  
        default:
            $prefinal_grade_equivalent = "5";
    }
  

    $year = $_GET["_y"];
    $course = $_GET["_c"];
    $semester = $_GET["_s_e_"];

?>

<tr>
<td><?php echo $student_no; ?></td>
<td><?php echo $fullname; ?></td>

<!-- <td><a href="#"><?php /* echo $prefinal_formative_assessment_1; */ ?></a></td> 
<td><a href="#"><?php /* echo $prefinal_formative_assessment_2; */ ?></a></td> 
<td><a href="#"><?php /* echo $prefinal_formative_assessment_3; */ ?></a></td> 
<td><a href="#"><?php /* echo $prefinal_formative_assessment_4; */ ?></a></td> 
<td><a href="#"><?php /* echo $prefinal_formative_assessment_5; */ ?></a></td> 
<td><a href="#"><?php /* echo $prefinal_formative_assessment_6; */ ?></a></td> 
<td><a href="#"><?php /* echo $prefinal_formative_assessment_7; */ ?></a></td> 
<td><a href="#"><?php /* echo $prefinal_formative_assessment_8; */ ?></a></td> 
<td><a href="#"><?php /* echo $prefinal_formative_assessment_9; */ ?></a></td> 
<td><a href="#"><?php /* echo $prefinal_formative_assessment_10; */ ?></a></td> 
<td><a href="#"><?php /* echo $prefinal_formative_assessment_total_score; */ ?></a></td> 
<td><a href="#"><?php /* echo $prefinal_formative_assessment_base; */ ?></a></td>  -->
<td><a class="text-primary"><?php echo $prefinal_output_1; ?></a></td> 
<td><a class="text-primary"><?php echo $prefinal_output_2; ?></a></td> 
<td><a class="text-danger"><?php echo $prefinal_output_total_score; ?></a></td> 
<td><a class="text-danger"><?php echo $prefinal_output_base; ?></a></td> 

<!-- <td><a class="text-danger"><?php echo $prefinal_output_weight; ?></a></td>  -->

<?php
// echo $prelim_output_weight;
if($prefinal_output_weight < 30){
  echo
  "<td class='bg-danger text-white'><center>
  <h6>".$prefinal_output_weight."</h6>
  </center></td>"; 
}else{
?>
<td><center><a class="text-danger">
<?php
  echo $prefinal_output_weight;
}
?>
</a></center></td>




<td><a class="text-primary"><?php echo $prefinal_performance_1; ?></a></td> 
<td><a class="text-primary"><?php echo $prefinal_performance_2; ?></a></td> 
<td><a class="text-danger"><?php echo $prefinal_performance_total_score; ?></a></td> 
<td><a class="text-danger"><?php echo $prefinal_performance_base; ?></a></td> 

<!-- <td><a class="text-danger"><?php echo $prefinal_performance_weight; ?></a></td>  -->

<?php
// echo $prelim_output_weight;
if($prefinal_performance_weight < 30){
  echo
  "<td class='bg-danger text-white'><center>
  <h6>".$prefinal_performance_weight."</h6>
  </center></td>"; 
}else{
?>
<td><center><a class="text-danger">
<?php
  echo $prefinal_performance_weight;
}
?>
</a></center></td>





<td><a class="text-primary"><?php echo $prefinal_written_test; ?></a></td> 
<td><a class="text-danger"><?php echo number_format((float)$prefinal_written_test_base,2,".",""); ?></a></td> 

<!-- <td><a class="text-danger"><?php echo number_format((float)$prefinal_written_test_weight,2,".",""); ?></a></td>  -->

<?php
// echo $prelim_output_weight;
if($prefinal_written_test_weight < 15){
  echo
  "<td class='bg-danger text-white'><center>
  <h6>".number_format((float)$prefinal_written_test_weight,2,".","")."</h6>
  </center></td>"; 
}else{
?>
<td><center><a class="text-danger">
<?php
  echo number_format((float)$prefinal_written_test_weight,2,".","");
}
?>
</a></center></td>





<td><a class="text-danger"><?php echo number_format((float)$prefinal_3rd_quarter,2,".",""); ?></a></td> 
<td><a class="<?php if($prefinal_grade >= 74.5){ echo 'text-success';}else{echo 'text-danger';} ?>"><?php echo number_format((float)$prefinal_grade,2,".",""); ?></a></td> 
<td><a class="<?php if($prefinal_grade >= 74.5){ echo 'text-success';}else{echo 'text-danger';} ?>"><?php echo $prefinal_grade_equivalent; ?></a></td> 
<td><center><a <?php if(($check_prelim_grade>0) & ($check_midterm_grade>0)){ echo 'href=?redir=prefinal&_y='.$year.'&_c='.$course.'&_s_e_='.$semester.'&in_='.$student_no; }else{ echo 'data-toggle="tooltip" data-placement="top" title="Check other grading period before inputting grade"';} ?> class="btn <?php if(($check_prelim_grade>0) & ($check_midterm_grade>0)){echo 'btn-primary'; }else{ echo 'btn-secondary text-white'; } ?>">Input Grade</a></center></td>
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


if(isset($_GET["in_"])){
  include("redir.php");
}

?>
</div>

<input type="hidden" value="<?php echo $_GET["redir"]; ?>" id="grade_period">
<input type="hidden" value="<?php echo $_GET["_y"]; ?>" id="year">
<input type="hidden" value="<?php echo $_GET["_c"]; ?>" id="course">
<input type="hidden" value="<?php echo $_GET["_s_e_"]; ?>" id="semester">

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
