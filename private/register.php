<?php
include("../bins/header.php");
// include("bins/nav.php");
// include("piechart.php");
?>

<center>

<br>
<div class="container w-50">

<div class="card">
  <div class="card-header bg-primary text-light"><h3>Register User</h3></div>
  <div class="card-body">
  <form method="POST">
    <table border="0" width="100%">
<?php

$lastname = $firstname = $middlename = $course = $year = $username = $password = $confirm_password = "";

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
    <td colspan="3"><input class="form-control txt_input" type="text" value="<?php echo $course; ?>" name="course" class="err" id="course" placeholder="First Name" autocomplete="off" required></td>
    </tr>
    </div>

    <div class="form-group">
    <tr>
    <td class="label"><b><label for="year">Year:</label></b></td>
    <td colspan="3"><input class="form-control txt_input" type="text" value="<?php echo $year; ?>" name="year" class="err" id="year" placeholder="Middle Name" autocomplete="off" required></td>
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

<?php
include("../bins/footer_non_fixed.php");
?>