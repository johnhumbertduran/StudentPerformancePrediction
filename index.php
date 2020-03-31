<?php

session_start();
$session_user = $session_pass = "";

include("bins/header.php");
include("private/bins/connections.php");
// include("bins/nav.php");
// include("piechart.php");


if(isset($_SESSION["username"])){

    $session_user = $_SESSION["username"];
    $check_account_type = mysqli_query($connections, "SELECT * FROM _user_tbl_ WHERE username='$session_user'");
    $get_account_type = mysqli_fetch_assoc($check_account_type);
    $account_type = $get_account_type["account_type"];
    
    if($account_type == 1){
    
        header('Location: private/admin');
    
    }elseif($account_type == 2){
    
        header('Location: private/user');

    }elseif($account_type == 3){
    
        header('Location: private/teacher');

    }

}



// Log in Here
if(isset($_POST["log_me_in"])){


  if(empty($_POST["wordpass"]) && empty($_POST["nameuser"]) ){

    // $logErr = "User Name and Password are empty!";
    echo"<script>alert('User Name and Password are empty');</script>";

    }else{

    if(empty($_POST["nameuser"])){
    
    // $logErr = "Usern Name is empty!";
    echo"<script>alert('User Name is empty');</script>";

    }else{

    // $you = $_POST["useN"];
    $session_user = $_POST["nameuser"];
    
    }

    if(empty($_POST["wordpass"])){

        // $logErr = "Password is empty!";
        echo"<script>alert('Password is empty');</script>";         
    
    }else{
    
        // $pass = $_POST["pas"];
        $session_pass = $_POST["wordpass"];
    

    }

    }





    if($session_user && $session_pass){

      $userCheck = mysqli_query($connections, "SELECT * FROM _user_tbl_ WHERE username='$session_user' ");
      $userRow = mysqli_num_rows($userCheck);
      
      if($userRow > 0){
      
          $fetch = mysqli_fetch_assoc($userCheck);
          $db_pass = $fetch["password"];
          
          $account_type = $fetch["account_type"];
      
      if($account_type == "1"){
      
          
          if($db_pass == $session_pass){
              
                  $_SESSION["username"] = $session_user;

                  header('Location: private/admin');

              
              }else{
              
                  $session_pass = ""; 
                  echo"<script>alert('Your Password is incorrect!');</script>";
              
              }

      
      }elseif ($account_type == "2") {

          if ($db_pass == $session_pass) {

              $_SESSION["username"] = $session_user;
              
              header('Location: private/user');

              }else{
              
                  $session_pass = "";
                  echo"<script>alert('Your Password is incorrect!');</script>";
              
              }   
      }elseif ($account_type == "3") {

          if ($db_pass == $session_pass) {

              $_SESSION["username"] = $session_user;
              
              header('Location: private/teacher');

              }else{
              
                  $session_pass = "";
                  echo"<script>alert('Your Password is incorrect!');</script>";
              
              }   
    }   
          
      }else{

          $session_user = "";
          echo"<script>alert('Sorry, the User Name you entered is not registered.');</script>";
      }
  }
}


?>

<!-- <div class="">
<?php
// include("piechart.php");
?>
</div> -->
<br>
<center>
<div class="card col-sm-3 col-lg-3">
  <div class="card-header bg-primary text-light">Log in</div>
  <div class="card-body">
  <div class="form-group">

  <form method="POST">
    <tr>
    <td colspan="3"><input class="form-control w-85" type="text" value="<?php echo $session_user; ?>" name="nameuser" id="" autocomplete="off" placeholder="User Name" required></td>
    </tr>
    </div>

    <div class="form-group">
    <tr>
    <td colspan="3"><input class="form-control w-85" type="password" value="<?php echo $session_pass; ?>" name="wordpass" id="" autocomplete="off" placeholder="Password" required></td>
    </tr>
    </div>
  </div>



  <div class="card-footer bg-primary">
  <input type="submit" class="btn btn-light float-right" name="log_me_in" value="Log me in">
  </form>
  </div>
</div>

</center>

<br>
<br>
<br>
<br>
<!-- <footer class="footer">
<div class="container"> -->
<?php
include("bins/footer_non_fixed.php");
?>
<!-- </div>
</footer> -->