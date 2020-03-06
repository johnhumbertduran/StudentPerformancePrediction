<?php



// $prelim_formative_assessment_1 = $prelim_formative_assessment_2 =
// $prelim_formative_assessment_3 = $prelim_formative_assessment_4 =
// $prelim_formative_assessment_5 = $prelim_formative_assessment_6 =
// $prelim_formative_assessment_7 = $prelim_formative_assessment_8 =
// $prelim_formative_assessment_9 = $prelim_formative_assessment_10 =
// $prelim_formative_assessment_total_score = $prelim_formative_assessment_base =
$prelim_output_1 = $prelim_output_2 = $prelim_output_total_score =
$prelim_output_base = $prelim_output_weight = $prelim_performance_1 =
$prelim_performance_2 = $prelim_performance_total_score =
$prelim_performance_base = $prelim_performance_weight =
$prelim_written_test = $prelim_written_test_base =
$prelim_written_test_weight = $prelim_grade =
$prelim_grade_equivalent = "0";



if(isset($_GET["redir"])){

  if($_GET["redir"] == "select_grading"){
    $grade_period = "";
  }else{
    $grade_period = $_GET["redir"];
  }

  // switch (true) {
  //     // case ($_GET["redir"] == "select_grading"):
  //     //     $grade_period = "";
  //     //     break;
  //     case ($_GET["redir"] == "prelim"):
  //         $grade_period = "prelim";
  //         break;
  //     case ($_GET["redir"] == "midterm"):
  //         $grade_period = "midterm";
  //         break;
  //     case ($_GET["redir"] == "prefinal"):
  //         $grade_period = "prefinal";
  //         break;
  //     case ($_GET["redir"] == "final"):
  //         $grade_period = "final";
  //         break;

  //     default:
  //         $grade_period = "5";
  // }

  

}else{
  $grade_period = "prelim";
}


if(isset($_GET["_y"])){

  if($_GET["_y"] == "select_year"){
    $year = "";
  }else{
    $year = $_GET["_y"];
  }

  
}else{
  $year = "2020";
}


if(isset($_GET["_c"])){

  if($_GET["_c"] == "select_course"){
    $course = "";
  }else{
    $course = $_GET["_c"];
  }

  
}else{
  $course = "BSCS";
}


if(isset($_GET["_s"])){

  if($_GET["_s"] == "select_subject"){
    $subject = "";
  }else{
    $subject = $_GET["_s"];
  }

  
}else{
  $subject = "BSCS";
}

// Select Semester here Kara nag tapos
if(isset($_GET["_s"])){

  if($_GET["_s"] == "select_subject"){
    $subject = "";
  }else{
    $subject = $_GET["_s"];
  }

  
}else{
  $subject = "BSCS";
}



?>



<div class="table-responsive table_table mt-3">
<table border="1" class="table table-hover">
    <thead>
    <tr><th class="px-3" colspan="2"></th><th class="px-3 text-center bg-success text-white" colspan="17">Preliminary Period</th></tr><!-- Preliminary Here -->

    <tr><th class="px-3">Student&nbsp;ID</th><th class="px-3">Student&nbsp;Name</th><!-- <th class="px-5 text-center bg-success text-white" colspan="12">Formative Assessment</th> --><th class="px-5 text-center bg-success text-white" colspan="5">Outpout</th><th class="px-5 text-center bg-success text-white" colspan="5">Performance&nbsp;Project</th><th class="px-5 text-cente bg-success text-white" colspan="3">Written&nbsp;Test</th><th class="px-5 text-center bg-success text-white " colspan="2">Prelim&nbsp;Grade</th></tr><!-- Preliminary Here -->

    <tr><th class="px-3"></th><th class="px-3">Highest&nbsp;Possible&nbsp;Score</th><!-- <th class="bg-success text-white">10</th><th class="bg-success text-white">10</th><th class="bg-success text-white">10</th><th class="bg-success text-white">10</th><th class="bg-success text-white">10</th><th class="bg-success text-white">10</th><th class="bg-success text-white">10</th><th class="bg-success text-white">10</th><th class="bg-success text-white">10</th><th class="bg-success text-white">10</th><th class="bg-success text-white">100</th><th class="bg-success text-white">60</th> --><th class="bg-success text-white">20</th><th class="bg-success text-white">20</th><th class="bg-success text-white">40</th><th class="bg-success text-white">60</th><th class="bg-success text-white">0.40</th><th class="bg-success text-white">20</th><th class="bg-success text-white">20</th><th class="bg-success text-white">40</th><th class="bg-success text-white">60</th><th class="bg-success text-white">0.40</th><th class="bg-success text-white">30</th><th class="bg-success text-white">60</th><th class="bg-success text-white">0.20</th><th class="bg-success text-white"></th><th class="bg-success text-white"></th></tr><!-- Preliminary Here -->
    </thead>

    <tbody>

<?php

if($year == ""){

}else if ($grade_period == ""){

}else{
  $student_qry = mysqli_query($connections, "SELECT * FROM _user_tbl_ WHERE account_type='2' AND year=$year");


// $row_prelim = mysqli_fetch_assoc($prelim_qry);

while($row_student = mysqli_fetch_assoc($student_qry)){

  $student_no = $row_student["student_no"];
  $lastname = $row_student["lastname"];
  $firstname = $row_student["firstname"];
  $middlename = $row_student["middlename"];
  
  $fullname = $firstname . " " . $middlename[0] . ". " . $lastname;
  $prelim_qry = mysqli_query($connections, "SELECT * FROM prelim WHERE student_no=$student_no");

  $row_prelim = mysqli_fetch_assoc($prelim_qry);
  // $prelim_formative_assessment_1 = $row_prelim["prelim_formative_assessment_1"];
  // $prelim_formative_assessment_2 = $row_prelim["prelim_formative_assessment_2"];
  // $prelim_formative_assessment_3 = $row_prelim["prelim_formative_assessment_3"];
  // $prelim_formative_assessment_4 = $row_prelim["prelim_formative_assessment_4"];
  // $prelim_formative_assessment_5 = $row_prelim["prelim_formative_assessment_5"];
  // $prelim_formative_assessment_6 = $row_prelim["prelim_formative_assessment_6"];
  // $prelim_formative_assessment_7 = $row_prelim["prelim_formative_assessment_7"];
  // $prelim_formative_assessment_8 = $row_prelim["prelim_formative_assessment_8"];
  // $prelim_formative_assessment_9 = $row_prelim["prelim_formative_assessment_9"];
  // $prelim_formative_assessment_10 = $row_prelim["prelim_formative_assessment_10"];
  $prelim_formative_assessment_total_score = $row_prelim["prelim_formative_assessment_total_score"];
  $prelim_formative_assessment_base = $row_prelim["prelim_formative_assessment_base"];
  $prelim_output_1 = $row_prelim["prelim_output_1"];
  $prelim_output_2 = $row_prelim["prelim_output_2"];
  $prelim_output_total_score = $row_prelim["prelim_output_total_score"];
  $prelim_output_base = $row_prelim["prelim_output_base"];
  $prelim_output_weight = $row_prelim["prelim_output_weight"];
  $prelim_performance_1 = $row_prelim["prelim_performance_1"];
  $prelim_performance_2 = $row_prelim["prelim_performance_2"];
  $prelim_performance_total_score = $row_prelim["prelim_performance_total_score"];
  $prelim_performance_base = $row_prelim["prelim_performance_base"];
  $prelim_performance_weight = $row_prelim["prelim_performance_weight"];
  $prelim_written_test = $row_prelim["prelim_written_test"];
  $prelim_written_test_base = $row_prelim["prelim_written_test_base"];
  $prelim_written_test_weight = $row_prelim["prelim_written_test_weight"];
  $prelim_grade = $row_prelim["prelim_grade"];
  $prelim_grade_equivalent = $row_prelim["prelim_grade_equivalent"];

  // ####################______Prelim Formulas______####################
  // $prelim_formative_assessment_total_score =
  // $prelim_formative_assessment_1 + $prelim_formative_assessment_2 +
  // $prelim_formative_assessment_3 + $prelim_formative_assessment_4 +
  // $prelim_formative_assessment_5 + $prelim_formative_assessment_6 +
  // $prelim_formative_assessment_7 + $prelim_formative_assessment_8 +
  // $prelim_formative_assessment_9 + $prelim_formative_assessment_10;

  // $prelim_formative_assessment_base = $prelim_formative_assessment_total_score / 100 * 40 + 60;
  $prelim_output_total_score = $prelim_output_1 + $prelim_output_2;
  $prelim_output_base = $prelim_output_total_score / 40 * 40 + 60;
  $prelim_output_weight = $prelim_output_base * 0.40;
  $prelim_performance_total_score = $prelim_performance_1 + $prelim_performance_2;
  $prelim_performance_base = $prelim_performance_total_score / 40 * 40 + 60;
  $prelim_performance_weight = $prelim_performance_base * 0.40;
  $prelim_written_test_base = $prelim_written_test / 30 * 40 + 60;
  $prelim_written_test_weight = $prelim_written_test_base * 0.20;
  $prelim_grade = $prelim_output_weight + $prelim_performance_weight + $prelim_written_test_weight;

  switch (true) {
    //   case ($prelim_grade <= 74.4):
    //       $prelim_grade_equivalent = "5";
    //       break;
      case ($prelim_grade >= 74.5 && $prelim_grade <= 76.4):
          $prelim_grade_equivalent = "3";
          break;
      case ($prelim_grade >= 76.5 && $prelim_grade <= 79.4):
          $prelim_grade_equivalent = "2.75";
          break;
      case ($prelim_grade >= 79.5 && $prelim_grade <= 82.4):
          $prelim_grade_equivalent = "2.5";
          break;
      case ($prelim_grade >= 82.5 && $prelim_grade <= 85.4):
          $prelim_grade_equivalent = "2.25";
          break;
      case ($prelim_grade >= 85.5 && $prelim_grade <= 88.4):
          $prelim_grade_equivalent = "2";
          break;
      case ($prelim_grade >= 88.5 && $prelim_grade <= 91.4):
          $prelim_grade_equivalent = "1.75";
          break;
      case ($prelim_grade >= 91.5 && $prelim_grade <= 94.4):
          $prelim_grade_equivalent = "1.5";
          break;
      case ($prelim_grade >= 94.5 && $prelim_grade <= 97.4):
          $prelim_grade_equivalent = "1.25";
          break;
      case ($prelim_grade >= 97.5 && $prelim_grade <= 100):
          $prelim_grade_equivalent = "1";
          break;

      default:
          $prelim_grade_equivalent = "5";
  }


  $permitted_chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
  $qws = md5(rand(0,3));
//   $rd = substr(str_shuffle($permitted_chars), 0, 5);

  $a1 = substr(str_shuffle($permitted_chars), 0, 5);


  
?>

<tr>
<td><?php echo $student_no; ?></td>
<td><?php echo $fullname; ?></td>
<!-- <td><a href="?redir=prelim&a1=<?php echo $student_no; ?>"><?php echo $prelim_formative_assessment_1; ?></a></td> 
<td><a href="?redir=prelim&a2=<?php echo $student_no; ?>"><?php echo $prelim_formative_assessment_2; ?></a></td> 
<td><a href="?redir=prelim&a3=<?php echo $student_no; ?>"><?php echo $prelim_formative_assessment_3; ?></a></td> 
<td><a href="?redir=prelim&a4=<?php echo $student_no; ?>"><?php echo $prelim_formative_assessment_4; ?></a></td> 
<td><a href="?redir=prelim&a5=<?php echo $student_no; ?>"><?php echo $prelim_formative_assessment_5; ?></a></td> 
<td><a href="?redir=prelim&a6=<?php echo $student_no; ?>"><?php echo $prelim_formative_assessment_6; ?></a></td> 
<td><a href="?redir=prelim&a7=<?php echo $student_no; ?>"><?php echo $prelim_formative_assessment_7; ?></a></td> 
<td><a href="?redir=prelim&a8=<?php echo $student_no; ?>"><?php echo $prelim_formative_assessment_8; ?></a></td> 
<td><a href="?redir=prelim&a9=<?php echo $student_no; ?>"><?php echo $prelim_formative_assessment_9; ?></a></td> 
<td><a href="?redir=prelim&a10=<?php echo $student_no; ?>"><?php echo $prelim_formative_assessment_10; ?></a></td> 
<td><a href="?redir=prelim&pfats=<?php echo $student_no; ?>"><?php echo $prelim_formative_assessment_total_score; ?></a></td> 
<td><a href="?redir=prelim&pfab=<?php echo $student_no; ?>"><?php echo $prelim_formative_assessment_base; ?></a></td>  -->
<td><a href="?redir=prelim&po1=<?php echo $student_no; ?>"><?php echo $prelim_output_1; ?></a></td> 
<td><a href="?redir=prelim&po2=<?php echo $student_no; ?>"><?php echo $prelim_output_2; ?></a></td> 
<td><a href="?redir=prelim&pots=<?php echo $student_no; ?>"><?php echo $prelim_output_total_score; ?></a></td> 
<td><a href="?redir=prelim&pob=<?php echo $student_no; ?>"><?php echo $prelim_output_base; ?></a></td> 
<td><a href="?redir=prelim&pow=<?php echo $student_no; ?>"><?php echo $prelim_output_weight; ?></a></td> 
<td><a href="?redir=prelim&pp1=<?php echo $student_no; ?>"><?php echo $prelim_performance_1; ?></a></td> 
<td><a href="?redir=prelim&pp2=<?php echo $student_no; ?>"><?php echo $prelim_performance_2; ?></a></td> 
<td><a href="?redir=prelim&ppts=<?php echo $student_no; ?>"><?php echo $prelim_performance_total_score; ?></a></td> 
<td><a href="?redir=prelim&ppb=<?php echo $student_no; ?>"><?php echo $prelim_performance_base; ?></a></td> 
<td><a href="?redir=prelim&ppw=<?php echo $student_no; ?>"><?php echo $prelim_performance_weight; ?></a></td> 
<td><a href="?redir=prelim&pwt=<?php echo $student_no; ?>"><?php echo $prelim_written_test; ?></a></td> 
<td><a href="?redir=prelim&pwtb=<?php echo $student_no; ?>"><?php echo number_format((float)$prelim_written_test_base,2,".",""); ?></a></td> 
<td><a href="?redir=prelim&pwtw=<?php echo $student_no; ?>"><?php echo number_format((float)$prelim_written_test_weight,2,".",""); ?></a></td> 
<td><a href="?redir=prelim&pg=<?php echo $student_no; ?>"><?php echo number_format((float)$prelim_grade,2,".",""); ?></a></td> 
<td><a href="?redir=prelim&pge=<?php echo $student_no; ?>"><?php echo $prelim_grade_equivalent; ?></a></td>
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

<script>

// var black_cover = document.getElementById("myModal");


// function reload_page(){
//     location.reload();
// }

// black_cover.addEventListener("click", reload_page);

// check if mabuoe du class ni body then reload the page using location.reload();



    function relocate(){
      window.location.href = "studentperformance?redir=prelim";
      // alert("hay");
    }

    get_black = document.getElementById("black1");
    
    get_black.addEventListener("click", relocate);

</script>