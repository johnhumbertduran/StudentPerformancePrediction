
<?php
// include("../../bins/header.php");
// include("../bins/connections.php");
// // include("bins/nav.php");
// // include("piechart.php");
?>

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


?>


<center>
<h1 class="py-3 text-info px-1">Register</h1>
</center>


<style>
.register_active{
  border: 1.5px solid white;
  border-radius: 6px;
}
</style>

<?php
include("../bins/admin_nav.php");
?>

<center>


<br>
<div class="container w-50">


<div class="card">
  <div class="card-header bg-primary text-light"><h3>Register Student</h3></div>
  <div class="card-body">
  <form method="POST">
    <table border="0" width="100%">
<?php

$lastname = $firstname = $middlename = $username = $course =
$year =  $password = $confirm_password = "";
// $lastname = $firstname = $middlename = $username = "";
// $course = "BSIT";
// $year = "2012";
// $password = $confirm_password = "password123";

$student_no = "20200000";




$check_student_no = mysqli_query($connections, "SELECT student_no FROM _user_tbl_ ORDER BY student_no DESC LIMIT 1 ");
while($get_student_no = mysqli_fetch_assoc($check_student_no)){

    $db_student_number = $get_student_no["student_no"];
    $student_no = $db_student_number;


if($db_student_number >= $student_no){

    $student_no += 1;
    
}

if (isset($_POST['submit'])) {

  if(empty($_POST["student_no"])){

  }else{
      $student_no = $_POST["student_no"];
  }
  
  if (!empty($_POST['lastname'])) {
    $lastname = $_POST['lastname'];
  }
  
  if (!empty($_POST['firstname'])) {
    $firstname = $_POST['firstname'];
  }
  
  if (!empty($_POST['middlename'])) {
    $middlename = $_POST['middlename'];
  }
  
  if (!empty($_POST['course'])) {
    $course = $_POST['course'];
  }
  
  if (!empty($_POST['year'])) {
    $year = $_POST['year'];
  }
  
  if (!empty($_POST['uname'])) {
    $username = $_POST['uname'];
    // $session_user = $username;
  }
  
  if (!empty($_POST['initial_password'])) {
    $password = $_POST['initial_password'];
  }
  
  if (!empty($_POST['confirm_password'])) {
    $confirm_password = $_POST['confirm_password'];
  }

  if($student_no && $lastname && $firstname && $middlename && $course && $year && $username && $password && $confirm_password){

    if(!preg_match("/^[a-zA-Z.ñÑ\- ]*$/", $lastname)){
      $err = "Last Name";
      $result = "should not have numbers or symbols.";
      include("../bins/lastname_warning.php");
      include("../bins/lastname_warningColor.php"); 
      // echo '<script>alert("Letters only!")</script>';
    }else{
      if(!preg_match("/^[a-zA-Z.ñÑ\- ]*$/", $firstname)){
        $err = "First Name";
        $result = "should not have numbers or symbols.";
        include("../bins/firstname_warning.php");
        include("../bins/firstname_warningColor.php");  
        // echo '<script>alert("No numbers allowed!")</script>';
      }else{
        if(!preg_match("/^[a-zA-Z.ñÑ\- ]*$/", $middlename)){
          $err = "Middle Name";
          $result = "should not have numbers or symbols.";
          include("../bins/middlename_warning.php");
          include("../bins/middlename_warningColor.php"); 
          // echo '<script>alert("No numbers allowed!")</script>';
        }else{
          if(!preg_match("/^[a-zA-Z. ]*$/", $course)){
            $err = "Course";
            $result = "should not have numbers or symbols.";
            include("../bins/course_warning.php");
            include("../bins/course_warningColor.php"); 
            // echo '<script>alert("No numbers allowed!")</script>';
          }else{
            if(!preg_match("/^[0-9]*$/", $year)){
              $err = "Year Graduated";
              $result = "should have numbers only.";
              include("../bins/year_warning.php");
              include("../bins/year_warningColor.php");
            }else{
              if((strlen($year) < 4) | strlen($year) > 4){
                $err = "Year Graduated";
                $result = "should have 4 numbers";
                include("../bins/year_warning.php");
                include("../bins/year_warningColor.php");
              }else{
                if(strlen($username) <= 7){
                  $err = "Username";
                  $result = "should have atleast 8 characters";
                  include("../bins/username_warning.php");
                  include("../bins/username_warningColor.php");
                }else{
                  if(strlen($password) <= 7){
                    $err = "Password";
                    $result = "should have atleast 8 characters";
                    include("../bins/password_warning.php");
                    include("../bins/password_warningColor.php");
                  }else{
                    if(strlen($confirm_password) <= 7){
                      $err = "Confirm Password";
                      $result = "should have atleast 8 characters";
                      include("../bins/confirm_password_warning.php");
                      include("../bins/confirm_password_warningColor.php");
                    }else{
                      if($confirm_password != $password){
                        $err = "Confirm Password";
                        $result = "should match the password";
                        include("../bins/confirm_password_warning.php");
                        include("../bins/confirm_password_warningColor.php");
                      }else{
                        // $_SESSION["username"] = $session_user;

                        mysqli_query($connections, "INSERT INTO _user_tbl_ (student_no,lastname,firstname,middlename,
                        course,year,username,password,account_type)
                        VALUES ('$student_no','$lastname','$firstname','$middlename','$course',
                        '$year','$username','$password','2')");

$fullname = $firstname . " " . $middlename[0] . ". " . $lastname;

mysqli_query($connections, "INSERT INTO prelim1 (student_no,student_name,
prelim_output_1,prelim_output_2,prelim_output_total_score,prelim_output_base,prelim_output_weight,
prelim_performance_1,prelim_performance_2,prelim_performance_total_score,prelim_performance_base,
prelim_performance_weight,prelim_written_test,prelim_written_test_base,prelim_written_test_weight,
prelim_grade,prelim_grade_equivalent,semester)
VALUES ('$student_no','$fullname','0','0','0','0','0','0','0','0','0',
'0','0','0','0','0','0','1')");

mysqli_query($connections, "INSERT INTO prelim2 (student_no,student_name,
prelim_output_1,prelim_output_2,prelim_output_total_score,prelim_output_base,prelim_output_weight,
prelim_performance_1,prelim_performance_2,prelim_performance_total_score,prelim_performance_base,
prelim_performance_weight,prelim_written_test,prelim_written_test_base,prelim_written_test_weight,
prelim_grade,prelim_grade_equivalent,semester)
VALUES ('$student_no','$fullname','0','0','0','0','0','0','0','0','0',
'0','0','0','0','0','0','2')");


mysqli_query($connections, "INSERT INTO midterm1 (student_no,student_name,
midterm_output_1,midterm_output_2,midterm_output_total_score,midterm_output_base,midterm_output_weight,
midterm_performance_1,midterm_performance_2,midterm_performance_total_score,midterm_performance_base,
midterm_performance_weight,midterm_written_test,midterm_written_test_base,midterm_written_test_weight,
midterm_2nd_quarter,midterm_grade,midterm_grade_equivalent,midterm_remarks,semester)
VALUES ('$student_no','$fullname','0','0','0','0','0','0','0','0','0','0','0',
'0','0','0','0','0','0','1')");


mysqli_query($connections, "INSERT INTO midterm2 (student_no,student_name,
midterm_output_1,midterm_output_2,midterm_output_total_score,midterm_output_base,midterm_output_weight,
midterm_performance_1,midterm_performance_2,midterm_performance_total_score,midterm_performance_base,
midterm_performance_weight,midterm_written_test,midterm_written_test_base,midterm_written_test_weight,
midterm_2nd_quarter,midterm_grade,midterm_grade_equivalent,midterm_remarks,semester)
VALUES ('$student_no','$fullname','0','0','0','0','0','0','0','0','0','0','0',
'0','0','0','0','0','0','2')");


mysqli_query($connections, "INSERT INTO prefinal1 (student_no,student_name,
prefinal_output_1,prefinal_output_2,prefinal_output_total_score,prefinal_output_base,prefinal_output_weight,
prefinal_performance_1,prefinal_performance_2,prefinal_performance_total_score,prefinal_performance_base,
prefinal_performance_weight,prefinal_written_test,prefinal_written_test_base,prefinal_written_test_weight,
prefinal_3rd_quarter,prefinal_grade,prefinal_grade_equivalent,semester)
VALUES ('$student_no','$fullname','0','0','0','0','0','0','0','0','0','0','0',
'0','0','0','0','0','1')");


mysqli_query($connections, "INSERT INTO prefinal2 (student_no,student_name,
prefinal_output_1,prefinal_output_2,prefinal_output_total_score,prefinal_output_base,prefinal_output_weight,
prefinal_performance_1,prefinal_performance_2,prefinal_performance_total_score,prefinal_performance_base,
prefinal_performance_weight,prefinal_written_test,prefinal_written_test_base,prefinal_written_test_weight,
prefinal_3rd_quarter,prefinal_grade,prefinal_grade_equivalent,semester)
VALUES ('$student_no','$fullname','0','0','0','0','0','0','0','0','0','0','0',
'0','0','0','0','0','2')");




mysqli_query($connections, "INSERT INTO final1 (student_no,student_name,
final_output_1,final_output_2,final_output_total_score,final_output_base,final_output_weight,
final_performance_1,final_performance_2,final_performance_total_score,final_performance_base,
final_performance_weight,final_written_test,final_written_test_base,final_written_test_weight,
final_4th_quarter,final_grade,final_grade_equivalent,final_grade_remarks,semester)
VALUES ('$student_no','$fullname','0','0','0','0','0','0','0','0','0','0','0',
'0','0','0','0','0','0','1')");


mysqli_query($connections, "INSERT INTO final2 (student_no,student_name,
final_output_1,final_output_2,final_output_total_score,final_output_base,final_output_weight,
final_performance_1,final_performance_2,final_performance_total_score,final_performance_base,
final_performance_weight,final_written_test,final_written_test_base,final_written_test_weight,
final_4th_quarter,final_grade,final_grade_equivalent,final_grade_remarks,semester)
VALUES ('$student_no','$fullname','0','0','0','0','0','0','0','0','0','0','0',
'0','0','0','0','0','0','2')");



                        header('Location: ?');
                      }
                    }
                  }
                }
              }
            }
          }
        }
      }
    }
    
  }

}
}

?>
    <!-- <tr><th colspan="4"><center> <h1>Registration Form</h1> </center></th></tr> -->

    <tr><td colspan="4"><hr></td></tr>
<p>dash sa input butangan dahil sa validation</p>
    <div class="form-group">
    <tr>
    <td class="label"><b><label for="student_no">Student ID:</label></b></td>
    <td colspan="3"><input class="form-control txt_input" type="text" value="<?php echo $student_no; ?>" name="student_no" class="warningColor" id="student_no" autocomplete="off" disabled></td>
    </tr>
    </div>

    <div class="form-group">
    <tr>
    <td class="label"><b><label for="lastname">Last Name:</label></b></td>
    <td colspan="3"><input class="form-control txt_input" type="text" value="<?php echo $lastname; ?>" name="lastname" class="warningColor" id="lastname" placeholder="Last Name" autocomplete="off" autofocus required></td>
    </tr>
    </div>

    <div class="form-group">
    <tr>
    <td class="label"><b><label for="firstname">First Name:</label></b></td>
    <td colspan="3"><input class="form-control txt_input" type="text" value="<?php echo $firstname; ?>" name="firstname" class="err" id="firstname" placeholder="First Name" autocomplete="off" required></td>
    </tr>
    </div>

    <div class="form-group">
    <tr>
    <td class="label"><b><label for="middlename">Middle Name:</label></b></td>
    <td colspan="3"><input class="form-control txt_input" type="text" value="<?php echo $middlename; ?>" name="middlename" class="err" id="middlename" placeholder="Middle Name" autocomplete="off" required></td>
    </tr>
    </div>

    <div class="form-group">
    <tr>
    <td class="label"><b><label for="course">Course:</label></b></td>
    <td colspan="3"><input class="form-control txt_input" type="text" value="<?php echo $course; ?>" name="course" class="err" id="course" placeholder="Course" autocomplete="off" required></td>
    </tr>
    </div>

    <div class="form-group">
    <tr>
    <td class="label"><b><label for="year">Year Graduated:</label></b></td>
    <td colspan="3"><input class="form-control txt_input" type="text" value="<?php echo $year; ?>" name="year" class="err" id="year" placeholder="Year" autocomplete="off" maxlength="4" onkeypress='return isNumberKey(event)' required></td>
    </tr>
    </div>


    <div class="form-group">
    <tr>
    <td class="label"><b><label for="username">User Name:</label></b></td>
    <td colspan="3"><input class="form-control txt_input" type="text" value="<?php echo $username; ?>" name="uname" id="username" autocomplete="off" placeholder="Username" required></td>
    </tr>
    </div>

    <div class="form-group">
    <tr>
    <td class="label"><b><label for="initial_password">Password:</label></b></td>
    <td colspan="3"><input class="form-control txt_input" type="password" value="<?php echo $password; ?>" name="initial_password" id="initial_password" autocomplete="off" placeholder="Password" required></td>
    </tr>
    </div>

    <div class="form-group">
    <tr>
    <td class="label"><b><label for="confirm_password">Confirm Password:</label></b></td>
    <td colspan="3"><input class="form-control txt_input" type="password" value="<?php echo $confirm_password; ?>" name="confirm_password" id="confirm_password" autocomplete="off" placeholder="Confirm Password" required></td>
    </tr>
    </div>

    <tr><td colspan="4"><hr></td></tr>
    
    <tr>
        <td colspan="4"><input style="float:right;" class="btn btn-success" type="submit" name="submit" value="Submit"></td>
    </tr>

</table>
</form>
  </div>
  <div class="card-footer bg-primary text-light">
  <input type="button" class="btn btn-light invisible" value="Register">
  </div>
</div>

</div>

</center>


<script>
        	function isNumberKey(evt){
	
                var charCode = (evt.which) ? evt.which : event.keyCode
    
                if(charCode > 31 && (charCode < 40 || charCode > 41) && ( charCode < 48 || charCode > 57) && charCode != 43  && charCode != 45 )
    
                    return false;
        
                return true;

            }
</script>

<?php
include("../../bins/footer_non_fixed.php");
?>