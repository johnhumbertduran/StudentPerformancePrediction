<?php
include("../../bins/header.php");
// include("bins/nav.php");
// include("piechart.php");
?>

<center>


<br>
<div class="container w-50">

<h2><font color="red">Username Error Message</font></h2>

<div class="card">
  <div class="card-header bg-primary text-light"><h3>Register User</h3></div>
  <div class="card-body">
  <form method="POST">
    <table border="0" width="100%">
<?php

$lastname = $firstname = $middlename = $course = $year = $username = $password = $confirm_password = "";

if (isset($_POST['submit'])) {
  
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
  }
  
  if (!empty($_POST['initial_password'])) {
    $password = $_POST['initial_password'];
  }
  
  if (!empty($_POST['confirm_password'])) {
    $confirm_password = $_POST['confirm_password'];
  }

  if($lastname && $firstname && $middlename && $course && $year && $username && $password && $confirm_password){

    if(!preg_match("/^[a-zA-Z. ]*$/", $lastname)){
      $err = "Last Name";
      $result = "should not have numbers or symbols.";
      include("../bins/lastname_warning.php");
      include("../bins/lastname_warningColor.php"); 
      // echo '<script>alert("Letters only!")</script>';
    }else{
      if(!preg_match("/^[a-zA-Z. ]*$/", $firstname)){
        $err = "First Name";
        $result = "should not have numbers or symbols.";
        include("../bins/firstname_warning.php");
        include("../bins/firstname_warningColor.php");  
        // echo '<script>alert("No numbers allowed!")</script>';
      }else{
        if(!preg_match("/^[a-zA-Z. ]*$/", $middlename)){
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

    <div class="form-group">
    <tr>
    <td class="label"><b><label for="lastname">Last Name:</label></b></td>
    <td colspan="3"><input class="form-control txt_input" type="text" value="<?php echo $lastname; ?>" name="lastname" class="warningColor" id="lastname" placeholder="Last Name" autocomplete="off" required></td>
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