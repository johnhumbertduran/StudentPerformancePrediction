<?php



$prelim_formative_assessment_1 = $prelim_formative_assessment_2 =
$prelim_formative_assessment_3 = $prelim_formative_assessment_4 =
$prelim_formative_assessment_5 = $prelim_formative_assessment_6 =
$prelim_formative_assessment_7 = $prelim_formative_assessment_8 =
$prelim_formative_assessment_9 = $prelim_formative_assessment_10 =
$prelim_formative_assessment_total_score = $prelim_formative_assessment_base =
$prelim_output_1 = $prelim_output_2 = $prelim_output_total_score =
$prelim_output_base = $prelim_output_weight = $prelim_performance_1 =
$prelim_performance_2 = $prelim_performance_total_score =
$prelim_performance_base = $prelim_performance_weight =
$prelim_written_test = $prelim_written_test_base =
$prelim_written_test_weight = $prelim_grade =
$prelim_grade_equivalent = "0";



?>


<?php



if(isset($_POST["grade"])){
    
  if(isset($_GET["redir"])){

    if(isset($_GET["a1"])){
      if(!empty($_POST["grade"])){
        $grade_name_input = $_POST["grade"];
      }

//         mysqli_query($connections, "INSERT INTO prelim (student_no,student_name,prelim_formative_assessment_1,
// prelim_formative_assessment_2,prelim_formative_assessment_3,prelim_formative_assessment_4,prelim_formative_assessment_5,
// prelim_formative_assessment_6,prelim_formative_assessment_7,prelim_formative_assessment_8,prelim_formative_assessment_9,
// prelim_formative_assessment_10,prelim_formative_assessment_total_score,prelim_formative_assessment_base,
// prelim_output_1,prelim_output_2,prelim_output_total_score,prelim_output_base,prelim_output_weight,
// prelim_performance_1,prelim_performance_2,prelim_performance_total_score,prelim_performance_base,
// prelim_performance_weight,prelim_written_test,prelim_written_test_base,prelim_written_test_weight,
// prelim_grade,prelim_grade_equivalent)
// VALUES ('$student_no','$fullname','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0',
// '0','0','0','0','0','0')");
echo $student_no;
    }


  }

}

?>

<div class="table-responsive">
<table border="1" class="table table-hover">
    <thead>
    <tr><th class="px-3" colspan="2"></th><th class="px-3 text-center bg-success text-white" colspan="27">Preliminary Period</th></tr><!-- Preliminary Here -->

    <tr><th class="px-3">Student&nbsp;ID</th><th class="px-3">Student&nbsp;Name</th><th class="px-5 text-center bg-success text-white" colspan="12">Formative Assessment</th><th class="px-5 text-center bg-success text-white" colspan="5">Outpout</th><th class="px-5 text-center bg-success text-white" colspan="5">Performance&nbsp;Project</th><th class="px-5 text-cente bg-success text-white" colspan="3">Written&nbsp;Test</th><th class="px-5 text-center bg-success text-white " colspan="2">Prelim&nbsp;Grade</th></tr><!-- Preliminary Here -->

    <tr><th class="px-3"></th><th class="px-3">Highest&nbsp;Possible&nbsp;Score</th><th class="bg-success text-white">10</th><th class="bg-success text-white">10</th><th class="bg-success text-white">10</th><th class="bg-success text-white">10</th><th class="bg-success text-white">10</th><th class="bg-success text-white">10</th><th class="bg-success text-white">10</th><th class="bg-success text-white">10</th><th class="bg-success text-white">10</th><th class="bg-success text-white">10</th><th class="bg-success text-white">100</th><th class="bg-success text-white">60</th><th class="bg-success text-white">20</th><th class="bg-success text-white">20</th><th class="bg-success text-white">40</th><th class="bg-success text-white">60</th><th class="bg-success text-white">0.40</th><th class="bg-success text-white">20</th><th class="bg-success text-white">20</th><th class="bg-success text-white">40</th><th class="bg-success text-white">60</th><th class="bg-success text-white">0.40</th><th class="bg-success text-white">30</th><th class="bg-success text-white">60</th><th class="bg-success text-white">0.20</th><th class="bg-success text-white"></th><th class="bg-success text-white"></th></tr><!-- Preliminary Here -->
    </thead>

    <tbody>

<?php

$student_qry = mysqli_query($connections, "SELECT * FROM _user_tbl_ WHERE account_type='2'");
// $row_prelim = mysqli_fetch_assoc($prelim_qry);

while($row_student = mysqli_fetch_assoc($student_qry)){

  $student_no = $row_student["student_no"];
  $lastname = $row_student["lastname"];
  $firstname = $row_student["firstname"];
  $middlename = $row_student["middlename"];
  
  $fullname = $firstname . " " . $middlename[0] . ". " . $lastname;
  $prelim_qry = mysqli_query($connections, "SELECT * FROM prelim WHERE student_no=$student_no");

  $row_prelim = mysqli_fetch_assoc($prelim_qry);
  $prelim_formative_assessment_1 = $row_prelim["prelim_formative_assessment_1"];

  // ####################______Prelim Formulas______####################
  $prelim_formative_assessment_total_score =
  $prelim_formative_assessment_1 + $prelim_formative_assessment_2 +
  $prelim_formative_assessment_3 + $prelim_formative_assessment_4 +
  $prelim_formative_assessment_5 + $prelim_formative_assessment_6 +
  $prelim_formative_assessment_7 + $prelim_formative_assessment_8 +
  $prelim_formative_assessment_9 + $prelim_formative_assessment_10;

  $prelim_formative_assessment_base = $prelim_formative_assessment_total_score / 100 * 40 + 60;
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
<td><a href="?redir=prelim&a1=<?php echo $student_no; ?>" id="a1"><?php echo $prelim_formative_assessment_1; ?></a></td> 
<td><a href="#"><?php echo $prelim_formative_assessment_2; ?></a></td> 
<td><a href="#"><?php echo $prelim_formative_assessment_3; ?></a></td> 
<td><a href="#"><?php echo $prelim_formative_assessment_4; ?></a></td> 
<td><a href="#"><?php echo $prelim_formative_assessment_5; ?></a></td> 
<td><a href="#"><?php echo $prelim_formative_assessment_6; ?></a></td> 
<td><a href="#"><?php echo $prelim_formative_assessment_7; ?></a></td> 
<td><a href="#"><?php echo $prelim_formative_assessment_8; ?></a></td> 
<td><a href="#"><?php echo $prelim_formative_assessment_9; ?></a></td> 
<td><a href="#"><?php echo $prelim_formative_assessment_10; ?></a></td> 
<td><a href="#"><?php echo $prelim_formative_assessment_total_score; ?></a></td> 
<td><a href="#"><?php echo $prelim_formative_assessment_base; ?></a></td> 
<td><a href="#"><?php echo $prelim_output_1; ?></a></td> 
<td><a href="#"><?php echo $prelim_output_2; ?></a></td> 
<td><a href="#"><?php echo $prelim_output_total_score; ?></a></td> 
<td><a href="#"><?php echo $prelim_output_base; ?></a></td> 
<td><a href="#"><?php echo $prelim_output_weight; ?></a></td> 
<td><a href="#"><?php echo $prelim_performance_1; ?></a></td> 
<td><a href="#"><?php echo $prelim_performance_2; ?></a></td> 
<td><a href="#"><?php echo $prelim_performance_total_score; ?></a></td> 
<td><a href="#"><?php echo $prelim_performance_base; ?></a></td> 
<td><a href="#"><?php echo $prelim_performance_weight; ?></a></td> 
<td><a href="#"><?php echo $prelim_written_test; ?></a></td> 
<td><a href="#"><?php echo $prelim_written_test_base; ?></a></td> 
<td><a href="#"><?php echo $prelim_written_test_weight; ?></a></td> 
<td><a href="#"><?php echo $prelim_grade; ?></a></td> 
<td><a href="#"><?php echo $prelim_grade_equivalent; ?></a></td>
</tr>




<?php
}
?>





</table>
</div>



<?php
function modal($grade_name,$student_no,$grade_name_input){
?>

  <!-- The Modal -->
  <div class="modal" id="myModal">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title"><?php echo $grade_name . "" . $student_no; ?></h4>
          <button type="button" class="close" data-dismiss="modal" id="black1">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
        <form method="POST">
          <center><input type="text" name="grade" value="<?php echo $grade_name_input; ?>" class="col-2 border_bottom"></center>
        </div>
        
        <!-- Modal footer -->
        <div class="modal-footer">
          <input type="submit" name="grade" class="btn btn-success" value="Submit Grade">
          </form>
        </div>
        
      </div>
    </div>
  </div>
  

<?php
}
?>

<?php

if(isset($_GET['a1'])){
  
  // if($_GET['a1'] == $student_no){
?>

<style>
.modal-backdrop{
    opacity:0.5 !important;
}

.border_bottom{
  border:none;
  border-bottom: 2px solid black;
}
</style>

<script>
var a1 =document.getElementById("a1");

a1.setAttribute("data-toggle","modal");
a1.setAttribute("data-target","#myModal");
a1.setAttribute("href","#");

// alert(a1);
</script>
<?php
$grade_name = "Input 1st quiz";
$grade_name_input = $prelim_formative_assessment_1;
$student_no = $_GET["a1"];
modal($grade_name,$student_no,$grade_name_input);
?>



<?php
// }
}
?>


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