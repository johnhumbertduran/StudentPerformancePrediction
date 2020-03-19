<?php

session_start();

include("../bins/connections.php");
include("../../bins/header.php");

$session_user = $_SESSION["username"];
  
$query_info = mysqli_query($connections, "SELECT * FROM _user_tbl_ WHERE username='$session_user'");
$my_info = mysqli_fetch_assoc($query_info);
$account_type = $my_info["account_type"];
$student_no = $my_info["student_no"];
$firstname = $my_info["firstname"];

if(isset($_SESSION["username"])){


    
    if($account_type != 2){
    
        header('Location: ../../forbidden');
    
    }
  
  }else{
    
    header('Location: ../../');
  
  }

  // if(isset($_GET['ave'])){
  //   echo "yes";
  //   $get_average = $_GET['ave'];
  // }else{
  //   echo "not";
  // }


?>


<style>
.my_grades_active{
  border: 1.5px solid white;
  border-radius: 6px;
}
</style>


<center>
<h1 class="py-3 text-info px-1">Welcome <?php echo $firstname; ?>!</h1>
</center>


<?php

include('../bins/student_nav.php');

$predict = "<sup class='badge badge-warning'>Predict</sup>";


?>


<select class="form-control col-2 ml-2 pt-1 pb-2 d-inline bg-info text-white mt-3" id="semester" onchange="semester()">
  <option value="select_semester">Select Semester</option>
  <option value="sem1" <?php if(isset($_GET['_s'])){ if($_GET['_s'] == "sem1"){ echo "selected"; }}?>>1st Semester</option>
  <option value="sem2" <?php if(isset($_GET['_s'])){ if($_GET['_s'] == "sem2"){ echo "selected"; }}?>>2nd Semester</option>
</select>


<div class="table-responsive table_table mt-3 col-8 container-fluid">
<table border="1" class="table table-hover">
    <thead>
    <tr><th class="px-3 text-center bg-success text-white" colspan="5">My Grade</th></tr><!-- Preliminary Here -->

    <tr class="text-center"><th class="px-3">Prelim</th><th class="px-3">Midterm</th><th class="px-3" id="prefinal">Prefinal</th><th class="px-3" id="final">Final</th><th class="px-3">Prediction<sup class='badge badge-warning'>Prediction</sup></th></tr>

    </thead>

    <tbody>

<?php

  if(isset($_GET["_s"])){
    $semester = $_GET["_s"];
  }else{
    $semester = "sem1";
  }
  

  $prelim = "prelim$semester[3]";
  $midterm = "midterm$semester[3]";
  $prefinal = "prefinal$semester[3]";
  $final = "final$semester[3]";
  $prelim_qry = mysqli_query($connections, "SELECT * FROM $prelim WHERE student_no='$student_no' ");
  $midterm_qry = mysqli_query($connections, "SELECT * FROM $midterm WHERE student_no='$student_no' ");
  $prefinal_qry = mysqli_query($connections, "SELECT * FROM $prefinal WHERE student_no='$student_no' ");
  $final_qry = mysqli_query($connections, "SELECT * FROM $final WHERE student_no='$student_no' ");


while($row_prelim = mysqli_fetch_assoc($prelim_qry)){
  
  
 $row_midterm = mysqli_fetch_assoc($midterm_qry);
 $row_prefinal = mysqli_fetch_assoc($prefinal_qry);
 $row_final = mysqli_fetch_assoc($final_qry);
 

$prelim_output_1 = $row_prelim['prelim_output_1'];
$prelim_output_2 = $row_prelim['prelim_output_2'];
$prelim_performance_1 = $row_prelim['prelim_performance_1'];
$prelim_performance_2 = $row_prelim['prelim_performance_2'];
$prelim_written_test = $row_prelim['prelim_written_test'];

if($prelim_output_1 == 0 && $prelim_output_2 == 0 &&
   $prelim_performance_1 == 0 && $prelim_performance_1 == 0 &&
   $prelim_written_test == 0){
  
    $prelim_grade = 0;

}else{

$prelim_output_total_score = $prelim_output_1 + $prelim_output_2;
$prelim_performance_total_score = $prelim_performance_1 + $prelim_performance_2;

$prelim_output_base = $prelim_output_total_score / 40 * 40 + 60;
$prelim_performance_base = $prelim_performance_total_score / 40 * 40 + 60;
$prelim_written_test_base =  $prelim_written_test / 30 * 40 + 60;

$prelim_output_weight = $prelim_output_base * 0.40;
$prelim_performance_weight = $prelim_performance_base * 0.40;
$prelim_written_test_weight = $prelim_written_test_base * 0.20;

$prelim_grade = $prelim_output_weight + $prelim_performance_weight + $prelim_written_test_weight;

$prelim_grade = number_format((float)$prelim_grade,2,".","");

}

$midterm_output_1 = $row_midterm["midterm_output_1"];
$midterm_output_2 = $row_midterm["midterm_output_2"];
$midterm_performance_1 = $row_midterm["midterm_performance_1"];
$midterm_performance_2 = $row_midterm["midterm_performance_2"];
$midterm_written_test = $row_midterm["midterm_written_test"];

if($midterm_output_1 == 0 && $midterm_output_2 == 0 &&
   $midterm_performance_1 == 0 && $midterm_performance_1 == 0 &&
   $midterm_written_test == 0){
  
    $midterm_grade = 0;

}else{

$midterm_output_total_score = $midterm_output_1 + $midterm_output_2;
$midterm_output_base = $midterm_output_total_score / 40 * 40 + 60;
$midterm_output_weight = $midterm_output_base * 0.40;


$midterm_performance_total_score = $midterm_performance_1 + $midterm_performance_2;
$midterm_performance_base = $midterm_performance_total_score / 40 * 40 + 60;
$midterm_written_test_base = $midterm_written_test / 30 * 40 + 60;
$midterm_performance_weight = $midterm_performance_base * 0.40;
$midterm_written_test_weight = $midterm_written_test_base * 0.20;
$midterm_2nd_quarter = $midterm_output_weight + $midterm_performance_weight + $midterm_written_test_weight;

$midterm_output_weight = $midterm_output_base * 0.40;
$midterm_performance_weight = $midterm_performance_base * 0.40;
$midterm_written_test_weight = $midterm_written_test_base * 0.20;
$midterm_grade = $prelim_grade * 0.3 + $midterm_2nd_quarter * 0.7;

$midterm_grade = number_format((float)$midterm_grade,2,".","");

}


$prefinal_output_1 = $row_prefinal["prefinal_output_1"]; //ok
$prefinal_output_2 = $row_prefinal["prefinal_output_2"]; //ok
$prefinal_performance_1 = $row_prefinal["prefinal_performance_1"]; //ok
$prefinal_performance_2 = $row_prefinal["prefinal_performance_2"]; //ok
$prefinal_written_test = $row_prefinal["prefinal_written_test"]; //ok


if($prefinal_output_1 == 0 && $prefinal_output_2 == 0 &&
   $prefinal_performance_1 == 0 && $prefinal_performance_1 == 0 &&
   $prefinal_written_test == 0){
  
    $prefinal_grade = 0;

}else{

$prefinal_output_total_score = $prefinal_output_1 + $prefinal_output_2; //ok
$prefinal_performance_total_score = $prefinal_performance_1 + $prefinal_performance_2; //ok

$prefinal_output_base = $prefinal_output_total_score / 40 * 40 + 60; //ok
$prefinal_performance_base = $prefinal_performance_total_score / 40 * 40 + 60; //ok
$prefinal_written_test_base = $prefinal_written_test / 30 * 40 + 60; //ok

$prefinal_output_weight = $prefinal_output_base * 0.40; //ok
$prefinal_performance_weight = $prefinal_performance_base * 0.40; //ok
$prefinal_written_test_weight = $prefinal_written_test_base * 0.20; //ok

$prefinal_3rd_quarter = $prefinal_output_weight + $prefinal_performance_weight + $prefinal_written_test_weight; //ok
$prefinal_grade = $midterm_grade * 0.3 + $prefinal_3rd_quarter * 0.7;

$prefinal_grade = number_format((float)$prefinal_grade,2,".","");

}


$final_output_1 = $row_final["final_output_1"];
$final_output_2 = $row_final["final_output_2"];
$final_performance_1 = $row_final["final_performance_1"];
$final_performance_2 = $row_final["final_performance_2"];
$final_written_test = $row_final["final_written_test"];


if($final_output_1 == 0 && $final_output_2 == 0 &&
   $final_performance_1 == 0 && $final_performance_1 == 0 &&
   $final_written_test == 0){
  
    $final_grade = 0;

}else{

$final_output_total_score = $final_output_1 + $final_output_2;
$final_output_base = $final_output_total_score / 40 * 40 + 60;
$final_output_weight = $final_output_base * 0.40;
$final_performance_total_score = $final_performance_1 + $final_performance_2;
$final_performance_base = $final_performance_total_score / 40 * 40 + 60;
$final_performance_weight = $final_performance_base * 0.40;
$final_written_test_base = $final_written_test / 30 * 40 + 60;
$final_written_test_weight = $final_written_test_base * 0.20;
$final_4th_quarter = $final_output_weight + $final_performance_weight + $final_written_test_weight;
$final_grade = $prefinal_grade * 0.3 + $final_4th_quarter * 0.7;

$final_grade = number_format((float)$final_grade,2,".","");

}
  


$prefinal_prediction = 0;
$final_prediction = 0;
$average_prediction = 0;



?>

<tr class="text-center">
<td id="get_prelim"><?php echo $prelim_grade; ?></td>
<td id="get_midterm"><?php echo $midterm_grade; ?></td>
<td id="get_prefinal"><?php echo $prefinal_grade; ?></td>
<td id="get_final"><?php echo $final_grade; ?></td>
<td>
<select class="form-control pt-1 pb-2 bg-info text-white" id="average_predict" onchange="average()">
  <option value="select_semester">Select Value</option>
  <option value="75" <?php if(isset($_GET['ave'])){ if($_GET['ave'] == "75"){ echo 'selected'; }}?>>75</option>
  <option value="76" <?php if(isset($_GET['ave'])){ if($_GET['ave'] == "76"){ echo 'selected'; }}?>>76</option>
  <option value="77" <?php if(isset($_GET['ave'])){ if($_GET['ave'] == "77"){ echo 'selected'; }}?>>77</option>
  <option value="78" <?php if(isset($_GET['ave'])){ if($_GET['ave'] == "78"){ echo 'selected'; }}?>>78</option>
  <option value="79" <?php if(isset($_GET['ave'])){ if($_GET['ave'] == "79"){ echo 'selected'; }}?>>79</option>
  <option value="80" <?php if(isset($_GET['ave'])){ if($_GET['ave'] == "80"){ echo 'selected'; }}?>>80</option>
  <option value="81" <?php if(isset($_GET['ave'])){ if($_GET['ave'] == "81"){ echo 'selected'; }}?>>81</option>
  <option value="82" <?php if(isset($_GET['ave'])){ if($_GET['ave'] == "82"){ echo 'selected'; }}?>>82</option>
  <option value="83" <?php if(isset($_GET['ave'])){ if($_GET['ave'] == "83"){ echo 'selected'; }}?>>83</option>
  <option value="84" <?php if(isset($_GET['ave'])){ if($_GET['ave'] == "84"){ echo 'selected'; }}?>>84</option>
  <option value="85" <?php if(isset($_GET['ave'])){ if($_GET['ave'] == "85"){ echo 'selected'; }}?>>85</option>
  <option value="86" <?php if(isset($_GET['ave'])){ if($_GET['ave'] == "86"){ echo 'selected'; }}?>>86</option>
  <option value="87" <?php if(isset($_GET['ave'])){ if($_GET['ave'] == "87"){ echo 'selected'; }}?>>87</option>
  <option value="88" <?php if(isset($_GET['ave'])){ if($_GET['ave'] == "88"){ echo 'selected'; }}?>>88</option>
  <option value="89" <?php if(isset($_GET['ave'])){ if($_GET['ave'] == "89"){ echo 'selected'; }}?>>89</option>
  <option value="90" <?php if(isset($_GET['ave'])){ if($_GET['ave'] == "90"){ echo 'selected'; }}?>>90</option>
  <option value="91" <?php if(isset($_GET['ave'])){ if($_GET['ave'] == "91"){ echo 'selected'; }}?>>91</option>
  <option value="92" <?php if(isset($_GET['ave'])){ if($_GET['ave'] == "92"){ echo 'selected'; }}?>>92</option>
  <option value="93" <?php if(isset($_GET['ave'])){ if($_GET['ave'] == "93"){ echo 'selected'; }}?>>93</option>
  <option value="94" <?php if(isset($_GET['ave'])){ if($_GET['ave'] == "94"){ echo 'selected'; }}?>>94</option>
  <option value="95" <?php if(isset($_GET['ave'])){ if($_GET['ave'] == "95"){ echo 'selected'; }}?>>95</option>
  <option value="96" <?php if(isset($_GET['ave'])){ if($_GET['ave'] == "96"){ echo 'selected'; }}?>>96</option>
  <option value="97" <?php if(isset($_GET['ave'])){ if($_GET['ave'] == "97"){ echo 'selected'; }}?>>97</option>
  <option value="98" <?php if(isset($_GET['ave'])){ if($_GET['ave'] == "98"){ echo 'selected'; }}?>>98</option>
  <option value="99" <?php if(isset($_GET['ave'])){ if($_GET['ave'] == "99"){ echo 'selected'; }}?>>99</option>
  <option value="100" <?php if(isset($_GET['ave'])){ if($_GET['ave'] == "100"){ echo 'selected'; }}?>>100</option>


</select>
</td>
</tr>
<!-- <tr class="text-center">
<td></td>
<td></td>
<td id="prefinal_prediction"><?php echo $prefinal_prediction; ?></td>
<td id="final_prediction"><?php echo $final_prediction; ?></td>
<td id="average_prediction"><?php echo $average_prediction; ?></td>
</tr> -->



<?php
// }
}
?>

</table>
</div>

<input type="text" id="prefinal_grade" value="<?php echo $prefinal_grade; ?>">
<input type="text" id="final_grade" value="<?php echo $final_grade; ?>">

ma javascript eon daun ako para sa switch case sa dropdown sa prediction

<script>

function semester(){
 
  var semester = document.getElementById("semester");
  var selected_semester = semester.options[semester.selectedIndex].value;

  window.location.href = "?_s="+selected_semester;
  // alert("hay");
}

var prefinal = document.getElementById("prefinal");
var prefinal_grade = document.getElementById("prefinal_grade");

if(prefinal_grade.value == 0){
  prefinal.innerHTML += "<sup class='badge badge-warning'>Prediction</sup>";
}

var final = document.getElementById("final");
var final_grade = document.getElementById("final_grade");

if(final_grade.value == 0){
  // var final_str = final.innerHTML;
  // var b = "<sup class='badge badge-warning'>Prediction</sup>";
  // var pos = 5;
  // final.innerHTML = [b,final_str.slice(pos)].join(final_str);


  final.innerHTML += "<sup class='badge badge-warning'>Prediction</sup>";


  // alert(final_str);
  // [final_str.slice(0),"<sup class='badge badge-warning'><small>Predict</small></sup>",0].join('');
  // final.innerHTML += string.slice("Final", "<sup class='badge badge-warning'><small>Predict</small></sup>");
}

var prelim = document.getElementById("get_prelim");
var midterm = document.getElementById("get_midterm");
var prefinal = document.getElementById("get_prefinal");
var final = document.getElementById("get_final");

function average(){
  // var semester = document.getElementById("semester");
  var average = document.getElementById("average_predict");
  var selected_average = average.options[average.selectedIndex].value;

  // window.location.href="?ave="+selected_average;



if(prelim.innerHTML != 0 & midterm.innerHTML != 0 & prefinal.innerHTML == 0 & final.innerHTML  == 0){
  var new_prelim = parseFloat(prelim.innerHTML);
  var new_midterm = parseFloat(midterm.innerHTML);
  var prelim_midterm =  new_prelim+new_midterm;

  // alert(prelim_midterm.toFixed(2)/2);

  // var a = Math.floor((Math.random() * 74.4) + 0);

  // var a = Math.floor((Math.random() * 25) + 74.5);
  // var b = Math.floor((Math.random() * 25) + 74.5);
  // prefinal.innerHTML = a;
  // final.innerHTML = b;

  // var prefinal_final;
  // var new_prefinal;
  // var new_final;
  // var overall_average;

  var grade_array =[];

  // ___________75

  var _75_75 = 75 + 75;
  var _75_76 = 75 + 76;
  var _75_77 = 75 + 77;
  var _75_78 = 75 + 78;
  var _75_79 = 75 + 79;
  var _75_80 = 75 + 80;
  var _75_81 = 75 + 81;
  var _75_82 = 75 + 82;
  var _75_83 = 75 + 83;
  var _75_84 = 75 + 84;
  var _75_85 = 75 + 85;
  var _75_86 = 75 + 86;
  var _75_87 = 75 + 87;
  var _75_88 = 75 + 88;
  var _75_89 = 75 + 89;
  var _75_90 = 75 + 90;
  var _75_91 = 75 + 91;
  var _75_92 = 75 + 92;
  var _75_93 = 75 + 93;
  var _75_94 = 75 + 94;
  var _75_95 = 75 + 95;
  var _75_96 = 75 + 96;
  var _75_97 = 75 + 97;
  var _75_98 = 75 + 98;
  var _75_99 = 75 + 99;
  var _75_100 = 75 + 100;



  // ___________76

  var _76_75 = 76 + 75;
  var _76_76 = 76 + 76;
  var _76_77 = 76 + 77;
  var _76_78 = 76 + 78;
  var _76_79 = 76 + 79;
  var _76_80 = 76 + 80;
  var _76_81 = 76 + 81;
  var _76_82 = 76 + 82;
  var _76_83 = 76 + 83;
  var _76_84 = 76 + 84;
  var _76_85 = 76 + 85;
  var _76_86 = 76 + 86;
  var _76_87 = 76 + 87;
  var _76_88 = 76 + 88;
  var _76_89 = 76 + 89;
  var _76_90 = 76 + 90;
  var _76_91 = 76 + 91;
  var _76_92 = 76 + 92;
  var _76_93 = 76 + 93;
  var _76_94 = 76 + 94;
  var _76_95 = 76 + 95;
  var _76_96 = 76 + 96;
  var _76_97 = 76 + 97;
  var _76_98 = 76 + 98;
  var _76_99 = 76 + 99;
  var _76_100 = 76 + 100;



  // ___________77

  var _77_75 = 77 + 75;
  var _77_76 = 77 + 76;
  var _77_77 = 77 + 77;
  var _77_78 = 77 + 78;
  var _77_79 = 77 + 79;
  var _77_80 = 77 + 80;
  var _77_81 = 77 + 81;
  var _77_82 = 77 + 82;
  var _77_83 = 77 + 83;
  var _77_84 = 77 + 84;
  var _77_85 = 77 + 85;
  var _77_86 = 77 + 86;
  var _77_87 = 77 + 87;
  var _77_88 = 77 + 88;
  var _77_89 = 77 + 89;
  var _77_90 = 77 + 90;
  var _77_91 = 77 + 91;
  var _77_92 = 77 + 92;
  var _77_93 = 77 + 93;
  var _77_94 = 77 + 94;
  var _77_95 = 77 + 95;
  var _77_96 = 77 + 96;
  var _77_97 = 77 + 97;
  var _77_98 = 77 + 98;
  var _77_99 = 77 + 99;
  var _77_100 = 77 + 100;


  // ___________78

  var _78_75 = 78 + 75;
  var _78_76 = 78 + 76;
  var _78_77 = 78 + 77;
  var _78_78 = 78 + 78;
  var _78_79 = 78 + 79;
  var _78_80 = 78 + 80;
  var _78_81 = 78 + 81;
  var _78_82 = 78 + 82;
  var _78_83 = 78 + 83;
  var _78_84 = 78 + 84;
  var _78_85 = 78 + 85;
  var _78_86 = 78 + 86;
  var _78_87 = 78 + 87;
  var _78_88 = 78 + 88;
  var _78_89 = 78 + 89;
  var _78_90 = 78 + 90;
  var _78_91 = 78 + 91;
  var _78_92 = 78 + 92;
  var _78_93 = 78 + 93;
  var _78_94 = 78 + 94;
  var _78_95 = 78 + 95;
  var _78_96 = 78 + 96;
  var _78_97 = 78 + 97;
  var _78_98 = 78 + 98;
  var _78_99 = 78 + 99;
  var _78_100 = 78 + 100;


  // ___________79

  var _79_75 = 79 + 75;
  var _79_76 = 79 + 76;
  var _79_77 = 79 + 77;
  var _79_78 = 79 + 78;
  var _79_79 = 79 + 79;
  var _79_80 = 79 + 80;
  var _79_81 = 79 + 81;
  var _79_82 = 79 + 82;
  var _79_83 = 79 + 83;
  var _79_84 = 79 + 84;
  var _79_85 = 79 + 85;
  var _79_86 = 79 + 86;
  var _79_87 = 79 + 87;
  var _79_88 = 79 + 88;
  var _79_89 = 79 + 89;
  var _79_90 = 79 + 90;
  var _79_91 = 79 + 91;
  var _79_92 = 79 + 92;
  var _79_93 = 79 + 93;
  var _79_94 = 79 + 94;
  var _79_95 = 79 + 95;
  var _79_96 = 79 + 96;
  var _79_97 = 79 + 97;
  var _79_98 = 79 + 98;
  var _79_99 = 79 + 99;
  var _79_100 = 79 + 100;


  // ___________80

  var _80_75 = 80 + 75;
  var _80_76 = 80 + 76;
  var _80_77 = 80 + 77;
  var _80_78 = 80 + 78;
  var _80_79 = 80 + 79;
  var _80_80 = 80 + 80;
  var _80_81 = 80 + 81;
  var _80_82 = 80 + 82;
  var _80_83 = 80 + 83;
  var _80_84 = 80 + 84;
  var _80_85 = 80 + 85;
  var _80_86 = 80 + 86;
  var _80_87 = 80 + 87;
  var _80_88 = 80 + 88;
  var _80_89 = 80 + 89;
  var _80_90 = 80 + 90;
  var _80_91 = 80 + 91;
  var _80_92 = 80 + 92;
  var _80_93 = 80 + 93;
  var _80_94 = 80 + 94;
  var _80_95 = 80 + 95;
  var _80_96 = 80 + 96;
  var _80_97 = 80 + 97;
  var _80_98 = 80 + 98;
  var _80_99 = 80 + 99;
  var _80_100 = 80 + 100;


  // ___________81

  var _81_75 = 81 + 75;
  var _81_76 = 81 + 76;
  var _81_77 = 81 + 77;
  var _81_78 = 81 + 78;
  var _81_79 = 81 + 79;
  var _81_80 = 81 + 80;
  var _81_81 = 81 + 81;
  var _81_82 = 81 + 82;
  var _81_83 = 81 + 83;
  var _81_84 = 81 + 84;
  var _81_85 = 81 + 85;
  var _81_86 = 81 + 86;
  var _81_87 = 81 + 87;
  var _81_88 = 81 + 88;
  var _81_89 = 81 + 89;
  var _81_90 = 81 + 90;
  var _81_91 = 81 + 91;
  var _81_92 = 81 + 92;
  var _81_93 = 81 + 93;
  var _81_94 = 81 + 94;
  var _81_95 = 81 + 95;
  var _81_96 = 81 + 96;
  var _81_97 = 81 + 97;
  var _81_98 = 81 + 98;
  var _81_99 = 81 + 99;
  var _81_100 = 81 + 100;


  // ___________82

  var _82_75 = 82 + 75;
  var _82_76 = 82 + 76;
  var _82_77 = 82 + 77;
  var _82_78 = 82 + 78;
  var _82_79 = 82 + 79;
  var _82_80 = 82 + 80;
  var _82_81 = 82 + 81;
  var _82_82 = 82 + 82;
  var _82_83 = 82 + 83;
  var _82_84 = 82 + 84;
  var _82_85 = 82 + 85;
  var _82_86 = 82 + 86;
  var _82_87 = 82 + 87;
  var _82_88 = 82 + 88;
  var _82_89 = 82 + 89;
  var _82_90 = 82 + 90;
  var _82_91 = 82 + 91;
  var _82_92 = 82 + 92;
  var _82_93 = 82 + 93;
  var _82_94 = 82 + 94;
  var _82_95 = 82 + 95;
  var _82_96 = 82 + 96;
  var _82_97 = 82 + 97;
  var _82_98 = 82 + 98;
  var _82_99 = 82 + 99;
  var _82_100 = 82 + 100;


  // ___________83

  var _83_75 = 83 + 75;
  var _83_76 = 83 + 76;
  var _83_77 = 83 + 77;
  var _83_78 = 83 + 78;
  var _83_79 = 83 + 79;
  var _83_80 = 83 + 80;
  var _83_81 = 83 + 81;
  var _83_82 = 83 + 82;
  var _83_83 = 83 + 83;
  var _83_84 = 83 + 84;
  var _83_85 = 83 + 85;
  var _83_86 = 83 + 86;
  var _83_87 = 83 + 87;
  var _83_88 = 83 + 88;
  var _83_89 = 83 + 89;
  var _83_90 = 83 + 90;
  var _83_91 = 83 + 91;
  var _83_92 = 83 + 92;
  var _83_93 = 83 + 93;
  var _83_94 = 83 + 94;
  var _83_95 = 83 + 95;
  var _83_96 = 83 + 96;
  var _83_97 = 83 + 97;
  var _83_98 = 83 + 98;
  var _83_99 = 83 + 99;
  var _83_100 = 83 + 100;


  // ___________84

  var _84_75 = 84 + 75;
  var _84_76 = 84 + 76;
  var _84_77 = 84 + 77;
  var _84_78 = 84 + 78;
  var _84_79 = 84 + 79;
  var _84_80 = 84 + 80;
  var _84_81 = 84 + 81;
  var _84_82 = 84 + 82;
  var _84_83 = 84 + 83;
  var _84_84 = 84 + 84;
  var _84_85 = 84 + 85;
  var _84_86 = 84 + 86;
  var _84_87 = 84 + 87;
  var _84_88 = 84 + 88;
  var _84_89 = 84 + 89;
  var _84_90 = 84 + 90;
  var _84_91 = 84 + 91;
  var _84_92 = 84 + 92;
  var _84_93 = 84 + 93;
  var _84_94 = 84 + 94;
  var _84_95 = 84 + 95;
  var _84_96 = 84 + 96;
  var _84_97 = 84 + 97;
  var _84_98 = 84 + 98;
  var _84_99 = 84 + 99;
  var _84_100 = 84 + 100;


  // ___________85

  var _85_75 = 85 + 75;
  var _85_76 = 85 + 76;
  var _85_77 = 85 + 77;
  var _85_78 = 85 + 78;
  var _85_79 = 85 + 79;
  var _85_80 = 85 + 80;
  var _85_81 = 85 + 81;
  var _85_82 = 85 + 82;
  var _85_83 = 85 + 83;
  var _85_84 = 85 + 84;
  var _85_85 = 85 + 85;
  var _85_86 = 85 + 86;
  var _85_87 = 85 + 87;
  var _85_88 = 85 + 88;
  var _85_89 = 85 + 89;
  var _85_90 = 85 + 90;
  var _85_91 = 85 + 91;
  var _85_92 = 85 + 92;
  var _85_93 = 85 + 93;
  var _85_94 = 85 + 94;
  var _85_95 = 85 + 95;
  var _85_96 = 85 + 96;
  var _85_97 = 85 + 97;
  var _85_98 = 85 + 98;
  var _85_99 = 85 + 99;
  var _85_100 = 85 + 100;


  // ___________86

  var _86_75 = 86 + 75;
  var _86_76 = 86 + 76;
  var _86_77 = 86 + 77;
  var _86_78 = 86 + 78;
  var _86_79 = 86 + 79;
  var _86_80 = 86 + 80;
  var _86_81 = 86 + 81;
  var _86_82 = 86 + 82;
  var _86_83 = 86 + 83;
  var _86_84 = 86 + 84;
  var _86_85 = 86 + 85;
  var _86_86 = 86 + 86;
  var _86_87 = 86 + 87;
  var _86_88 = 86 + 88;
  var _86_89 = 86 + 89;
  var _86_90 = 86 + 90;
  var _86_91 = 86 + 91;
  var _86_92 = 86 + 92;
  var _86_93 = 86 + 93;
  var _86_94 = 86 + 94;
  var _86_95 = 86 + 95;
  var _86_96 = 86 + 96;
  var _86_97 = 86 + 97;
  var _86_98 = 86 + 98;
  var _86_99 = 86 + 99;
  var _86_100 = 86 + 100;


  // ___________87

  var _87_75 = 87 + 75;
  var _87_76 = 87 + 76;
  var _87_77 = 87 + 77;
  var _87_78 = 87 + 78;
  var _87_79 = 87 + 79;
  var _87_80 = 87 + 80;
  var _87_81 = 87 + 81;
  var _87_82 = 87 + 82;
  var _87_83 = 87 + 83;
  var _87_84 = 87 + 84;
  var _87_85 = 87 + 85;
  var _87_86 = 87 + 86;
  var _87_87 = 87 + 87;
  var _87_88 = 87 + 88;
  var _87_89 = 87 + 89;
  var _87_90 = 87 + 90;
  var _87_91 = 87 + 91;
  var _87_92 = 87 + 92;
  var _87_93 = 87 + 93;
  var _87_94 = 87 + 94;
  var _87_95 = 87 + 95;
  var _87_96 = 87 + 96;
  var _87_97 = 87 + 97;
  var _87_98 = 87 + 98;
  var _87_99 = 87 + 99;
  var _87_100 = 87 + 100;


  // ___________88

  var _88_75 = 88 + 75;
  var _88_76 = 88 + 76;
  var _88_77 = 88 + 77;
  var _88_78 = 88 + 78;
  var _88_79 = 88 + 79;
  var _88_80 = 88 + 80;
  var _88_81 = 88 + 81;
  var _88_82 = 88 + 82;
  var _88_83 = 88 + 83;
  var _88_84 = 88 + 84;
  var _88_85 = 88 + 85;
  var _88_86 = 88 + 86;
  var _88_87 = 88 + 87;
  var _88_88 = 88 + 88;
  var _88_89 = 88 + 89;
  var _88_90 = 88 + 90;
  var _88_91 = 88 + 91;
  var _88_92 = 88 + 92;
  var _88_93 = 88 + 93;
  var _88_94 = 88 + 94;
  var _88_95 = 88 + 95;
  var _88_96 = 88 + 96;
  var _88_97 = 88 + 97;
  var _88_98 = 88 + 98;
  var _88_99 = 88 + 99;
  var _88_100 = 88 + 100;


  // ___________89

  var _89_75 = 89 + 75;
  var _89_76 = 89 + 76;
  var _89_77 = 89 + 77;
  var _89_78 = 89 + 78;
  var _89_79 = 89 + 79;
  var _89_80 = 89 + 80;
  var _89_81 = 89 + 81;
  var _89_82 = 89 + 82;
  var _89_83 = 89 + 83;
  var _89_84 = 89 + 84;
  var _89_85 = 89 + 85;
  var _89_86 = 89 + 86;
  var _89_87 = 89 + 87;
  var _89_88 = 89 + 88;
  var _89_89 = 89 + 89;
  var _89_90 = 89 + 90;
  var _89_91 = 89 + 91;
  var _89_92 = 89 + 92;
  var _89_93 = 89 + 93;
  var _89_94 = 89 + 94;
  var _89_95 = 89 + 95;
  var _89_96 = 89 + 96;
  var _89_97 = 89 + 97;
  var _89_98 = 89 + 98;
  var _89_99 = 89 + 99;
  var _89_100 = 89 + 100;


  // ___________90

  var _90_75 = 90 + 75;
  var _90_76 = 90 + 76;
  var _90_77 = 90 + 77;
  var _90_78 = 90 + 78;
  var _90_79 = 90 + 79;
  var _90_80 = 90 + 80;
  var _90_81 = 90 + 81;
  var _90_82 = 90 + 82;
  var _90_83 = 90 + 83;
  var _90_84 = 90 + 84;
  var _90_85 = 90 + 85;
  var _90_86 = 90 + 86;
  var _90_87 = 90 + 87;
  var _90_88 = 90 + 88;
  var _90_89 = 90 + 89;
  var _90_90 = 90 + 90;
  var _90_91 = 90 + 91;
  var _90_92 = 90 + 92;
  var _90_93 = 90 + 93;
  var _90_94 = 90 + 94;
  var _90_95 = 90 + 95;
  var _90_96 = 90 + 96;
  var _90_97 = 90 + 97;
  var _90_98 = 90 + 98;
  var _90_99 = 90 + 99;
  var _90_100 = 90 + 100;


  // ___________91

  var _91_75 = 91 + 75;
  var _91_76 = 91 + 76;
  var _91_77 = 91 + 77;
  var _91_78 = 91 + 78;
  var _91_79 = 91 + 79;
  var _91_80 = 91 + 80;
  var _91_81 = 91 + 81;
  var _91_82 = 91 + 82;
  var _91_83 = 91 + 83;
  var _91_84 = 91 + 84;
  var _91_85 = 91 + 85;
  var _91_86 = 91 + 86;
  var _91_87 = 91 + 87;
  var _91_88 = 91 + 88;
  var _91_89 = 91 + 89;
  var _91_90 = 91 + 90;
  var _91_91 = 91 + 91;
  var _91_92 = 91 + 92;
  var _91_93 = 91 + 93;
  var _91_94 = 91 + 94;
  var _91_95 = 91 + 95;
  var _91_96 = 91 + 96;
  var _91_97 = 91 + 97;
  var _91_98 = 91 + 98;
  var _91_99 = 91 + 99;
  var _91_100 = 91 + 100;


  // ___________92

  var _92_75 = 92 + 75;
  var _92_76 = 92 + 76;
  var _92_77 = 92 + 77;
  var _92_78 = 92 + 78;
  var _92_79 = 92 + 79;
  var _92_80 = 92 + 80;
  var _92_81 = 92 + 81;
  var _92_82 = 92 + 82;
  var _92_83 = 92 + 83;
  var _92_84 = 92 + 84;
  var _92_85 = 92 + 85;
  var _92_86 = 92 + 86;
  var _92_87 = 92 + 87;
  var _92_88 = 92 + 88;
  var _92_89 = 92 + 89;
  var _92_90 = 92 + 90;
  var _92_91 = 92 + 91;
  var _92_92 = 92 + 92;
  var _92_93 = 92 + 93;
  var _92_94 = 92 + 94;
  var _92_95 = 92 + 95;
  var _92_96 = 92 + 96;
  var _92_97 = 92 + 97;
  var _92_98 = 92 + 98;
  var _92_99 = 92 + 99;
  var _92_100 = 92 + 100;


  // ___________93

  var _93_75 = 93 + 75;
  var _93_76 = 93 + 76;
  var _93_77 = 93 + 77;
  var _93_78 = 93 + 78;
  var _93_79 = 93 + 79;
  var _93_80 = 93 + 80;
  var _93_81 = 93 + 81;
  var _93_82 = 93 + 82;
  var _93_83 = 93 + 83;
  var _93_84 = 93 + 84;
  var _93_85 = 93 + 85;
  var _93_86 = 93 + 86;
  var _93_87 = 93 + 87;
  var _93_88 = 93 + 88;
  var _93_89 = 93 + 89;
  var _93_90 = 93 + 90;
  var _93_91 = 93 + 91;
  var _93_92 = 93 + 92;
  var _93_93 = 93 + 93;
  var _93_94 = 93 + 94;
  var _93_95 = 93 + 95;
  var _93_96 = 93 + 96;
  var _93_97 = 93 + 97;
  var _93_98 = 93 + 98;
  var _93_99 = 93 + 99;
  var _93_100 = 93 + 100;


  // ___________94

  var _94_75 = 94 + 75;
  var _94_76 = 94 + 76;
  var _94_77 = 94 + 77;
  var _94_78 = 94 + 78;
  var _94_79 = 94 + 79;
  var _94_80 = 94 + 80;
  var _94_81 = 94 + 81;
  var _94_82 = 94 + 82;
  var _94_83 = 94 + 83;
  var _94_84 = 94 + 84;
  var _94_85 = 94 + 85;
  var _94_86 = 94 + 86;
  var _94_87 = 94 + 87;
  var _94_88 = 94 + 88;
  var _94_89 = 94 + 89;
  var _94_90 = 94 + 90;
  var _94_91 = 94 + 91;
  var _94_92 = 94 + 92;
  var _94_93 = 94 + 93;
  var _94_94 = 94 + 94;
  var _94_95 = 94 + 95;
  var _94_96 = 94 + 96;
  var _94_97 = 94 + 97;
  var _94_98 = 94 + 98;
  var _94_99 = 94 + 99;
  var _94_100 = 94 + 100;


  // ___________95

  var _95_75 = 95 + 75;
  var _95_76 = 95 + 76;
  var _95_77 = 95 + 77;
  var _95_78 = 95 + 78;
  var _95_79 = 95 + 79;
  var _95_80 = 95 + 80;
  var _95_81 = 95 + 81;
  var _95_82 = 95 + 82;
  var _95_83 = 95 + 83;
  var _95_84 = 95 + 84;
  var _95_85 = 95 + 85;
  var _95_86 = 95 + 86;
  var _95_87 = 95 + 87;
  var _95_88 = 95 + 88;
  var _95_89 = 95 + 89;
  var _95_90 = 95 + 90;
  var _95_91 = 95 + 91;
  var _95_92 = 95 + 92;
  var _95_93 = 95 + 93;
  var _95_94 = 95 + 94;
  var _95_95 = 95 + 95;
  var _95_96 = 95 + 96;
  var _95_97 = 95 + 97;
  var _95_98 = 95 + 98;
  var _95_99 = 95 + 99;
  var _95_100 = 95 + 100;


  // ___________96

  var _96_75 = 96 + 75;
  var _96_76 = 96 + 76;
  var _96_77 = 96 + 77;
  var _96_78 = 96 + 78;
  var _96_79 = 96 + 79;
  var _96_80 = 96 + 80;
  var _96_81 = 96 + 81;
  var _96_82 = 96 + 82;
  var _96_83 = 96 + 83;
  var _96_84 = 96 + 84;
  var _96_85 = 96 + 85;
  var _96_86 = 96 + 86;
  var _96_87 = 96 + 87;
  var _96_88 = 96 + 88;
  var _96_89 = 96 + 89;
  var _96_90 = 96 + 90;
  var _96_91 = 96 + 91;
  var _96_92 = 96 + 92;
  var _96_93 = 96 + 93;
  var _96_94 = 96 + 94;
  var _96_95 = 96 + 95;
  var _96_96 = 96 + 96;
  var _96_97 = 96 + 97;
  var _96_98 = 96 + 98;
  var _96_99 = 96 + 99;
  var _96_100 = 96 + 100;


  // ___________97

  var _97_75 = 97 + 75;
  var _97_76 = 97 + 76;
  var _97_77 = 97 + 77;
  var _97_78 = 97 + 78;
  var _97_79 = 97 + 79;
  var _97_80 = 97 + 80;
  var _97_81 = 97 + 81;
  var _97_82 = 97 + 82;
  var _97_83 = 97 + 83;
  var _97_84 = 97 + 84;
  var _97_85 = 97 + 85;
  var _97_86 = 97 + 86;
  var _97_87 = 97 + 87;
  var _97_88 = 97 + 88;
  var _97_89 = 97 + 89;
  var _97_90 = 97 + 90;
  var _97_91 = 97 + 91;
  var _97_92 = 97 + 92;
  var _97_93 = 97 + 93;
  var _97_94 = 97 + 94;
  var _97_95 = 97 + 95;
  var _97_96 = 97 + 96;
  var _97_97 = 97 + 97;
  var _97_98 = 97 + 98;
  var _97_99 = 97 + 99;
  var _97_100 = 97 + 100;


  // ___________98

  var _98_75 = 98 + 75;
  var _98_76 = 98 + 76;
  var _98_77 = 98 + 77;
  var _98_78 = 98 + 78;
  var _98_79 = 98 + 79;
  var _98_80 = 98 + 80;
  var _98_81 = 98 + 81;
  var _98_82 = 98 + 82;
  var _98_83 = 98 + 83;
  var _98_84 = 98 + 84;
  var _98_85 = 98 + 85;
  var _98_86 = 98 + 86;
  var _98_87 = 98 + 87;
  var _98_88 = 98 + 88;
  var _98_89 = 98 + 89;
  var _98_90 = 98 + 90;
  var _98_91 = 98 + 91;
  var _98_92 = 98 + 92;
  var _98_93 = 98 + 93;
  var _98_94 = 98 + 94;
  var _98_95 = 98 + 95;
  var _98_96 = 98 + 96;
  var _98_97 = 98 + 97;
  var _98_98 = 98 + 98;
  var _98_99 = 98 + 99;
  var _98_100 = 98 + 100;


  // ___________99

  var _99_75 = 99 + 75;
  var _99_76 = 99 + 76;
  var _99_77 = 99 + 77;
  var _99_78 = 99 + 78;
  var _99_79 = 99 + 79;
  var _99_80 = 99 + 80;
  var _99_81 = 99 + 81;
  var _99_82 = 99 + 82;
  var _99_83 = 99 + 83;
  var _99_84 = 99 + 84;
  var _99_85 = 99 + 85;
  var _99_86 = 99 + 86;
  var _99_87 = 99 + 87;
  var _99_88 = 99 + 88;
  var _99_89 = 99 + 89;
  var _99_90 = 99 + 90;
  var _99_91 = 99 + 91;
  var _99_92 = 99 + 92;
  var _99_93 = 99 + 93;
  var _99_94 = 99 + 94;
  var _99_95 = 99 + 95;
  var _99_96 = 99 + 96;
  var _99_97 = 99 + 97;
  var _99_98 = 99 + 98;
  var _99_99 = 99 + 99;
  var _99_100 = 99 + 100;


  // ___________100

  var _100_75 = 100 + 75;
  var _100_76 = 100 + 76;
  var _100_77 = 100 + 77;
  var _100_78 = 100 + 78;
  var _100_79 = 100 + 79;
  var _100_80 = 100 + 80;
  var _100_81 = 100 + 81;
  var _100_82 = 100 + 82;
  var _100_83 = 100 + 83;
  var _100_84 = 100 + 84;
  var _100_85 = 100 + 85;
  var _100_86 = 100 + 86;
  var _100_87 = 100 + 87;
  var _100_88 = 100 + 88;
  var _100_89 = 100 + 89;
  var _100_90 = 100 + 90;
  var _100_91 = 100 + 91;
  var _100_92 = 100 + 92;
  var _100_93 = 100 + 93;
  var _100_94 = 100 + 94;
  var _100_95 = 100 + 95;
  var _100_96 = 100 + 96;
  var _100_97 = 100 + 97;
  var _100_98 = 100 + 98;
  var _100_99 = 100 + 99;
  var _100_100 = 100 + 100;


// _75

if(((prelim_midterm+_75_75)/4 >= selected_average) & (prelim_midterm+_75_75)/4 <= parseInt(selected_average) + 1){
  // alert(selected_average);
  grade_array.push(_75_75);
  alert(grade_array);
  // alert((prelim_midterm+_75_77)/4);
}

if(((prelim_midterm+_75_76)/4 >= selected_average) & (prelim_midterm+_75_76)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_75_76);
  alert(grade_array);
}

if(((prelim_midterm+_75_77)/4 >= selected_average) & (prelim_midterm+_75_77)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_75_77);
  alert(grade_array);
}

if(((prelim_midterm+_75_78)/4 >= selected_average) & (prelim_midterm+_75_78)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_75_78);
  alert(grade_array);
}

if(((prelim_midterm+_75_79)/4 >= selected_average) & (prelim_midterm+_75_79)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_75_79);
  alert(grade_array);
}

if(((prelim_midterm+_75_80)/4 >= selected_average) & (prelim_midterm+_75_80)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_75_80);
  alert(grade_array);
}

if(((prelim_midterm+_75_81)/4 >= selected_average) & (prelim_midterm+_75_81)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_75_81);
  alert(grade_array);
}

if(((prelim_midterm+_75_82)/4 >= selected_average) & (prelim_midterm+_75_82)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_75_82);
  alert(grade_array);
}

if(((prelim_midterm+_75_83)/4 >= selected_average) & (prelim_midterm+_75_83)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_75_83);
  alert(grade_array);
}

if(((prelim_midterm+_75_84)/4 >= selected_average) & (prelim_midterm+_75_84)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_75_84);
  alert(grade_array);
}

if(((prelim_midterm+_75_85)/4 >= selected_average) & (prelim_midterm+_75_85)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_75_85);
  alert(grade_array);
}

if(((prelim_midterm+_75_86)/4 >= selected_average) & (prelim_midterm+_75_86)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_75_86);
  alert(grade_array);
}

if(((prelim_midterm+_75_87)/4 >= selected_average) & (prelim_midterm+_75_87)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_75_87);
  alert(grade_array);
}

if(((prelim_midterm+_75_88)/4 >= selected_average) & (prelim_midterm+_75_88)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_75_88);
  alert(grade_array);
}

if(((prelim_midterm+_75_89)/4 >= selected_average) & (prelim_midterm+_75_89)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_75_89);
  alert(grade_array);
}

if(((prelim_midterm+_75_90)/4 >= selected_average) & (prelim_midterm+_75_90)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_75_90);
  alert(grade_array);
}

if(((prelim_midterm+_75_91)/4 >= selected_average) & (prelim_midterm+_75_91)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_75_91);
  alert(grade_array);
}

if(((prelim_midterm+_75_92)/4 >= selected_average) & (prelim_midterm+_75_92)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_75_92);
  alert(grade_array);
}

if(((prelim_midterm+_75_93)/4 >= selected_average) & (prelim_midterm+_75_93)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_75_93);
  alert(grade_array);
}

if(((prelim_midterm+_75_94)/4 >= selected_average) & (prelim_midterm+_75_94)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_75_94);
  alert(grade_array);
}

if(((prelim_midterm+_75_95)/4 >= selected_average) & (prelim_midterm+_75_95)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_75_95);
  alert(grade_array);
}

if(((prelim_midterm+_75_96)/4 >= selected_average) & (prelim_midterm+_75_96)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_75_96);
  alert(grade_array);
}

if(((prelim_midterm+_75_97)/4 >= selected_average) & (prelim_midterm+_75_97)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_75_97);
  alert(grade_array);
}

if(((prelim_midterm+_75_98)/4 >= selected_average) & (prelim_midterm+_75_98)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_75_98);
  alert(grade_array);
}

if(((prelim_midterm+_75_99)/4 >= selected_average) & (prelim_midterm+_75_99)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_75_99);
  alert(grade_array);
}

if(((prelim_midterm+_75_100)/4 >= selected_average) & (prelim_midterm+_75_100)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_75_100);
  alert(grade_array);
}


// _76

if(((prelim_midterm+_76_75)/4 >= selected_average) & (prelim_midterm+_76_75)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_76_75);
  alert(grade_array);
}

if(((prelim_midterm+_76_76)/4 >= selected_average) & (prelim_midterm+_76_76)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_76_76);
  alert(grade_array);
}

if(((prelim_midterm+_76_77)/4 >= selected_average) & (prelim_midterm+_76_77)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_76_77);
  alert(grade_array);
}

if(((prelim_midterm+_76_78)/4 >= selected_average) & (prelim_midterm+_76_78)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_76_78);
  alert(grade_array);
}

if(((prelim_midterm+_76_79)/4 >= selected_average) & (prelim_midterm+_76_79)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_76_79);
  alert(grade_array);
}

if(((prelim_midterm+_76_80)/4 >= selected_average) & (prelim_midterm+_76_80)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_76_80);
  alert(grade_array);
}

if(((prelim_midterm+_76_81)/4 >= selected_average) & (prelim_midterm+_76_81)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_76_81);
  alert(grade_array);
}

if(((prelim_midterm+_76_82)/4 >= selected_average) & (prelim_midterm+_76_82)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_76_82);
  alert(grade_array);
}

if(((prelim_midterm+_76_83)/4 >= selected_average) & (prelim_midterm+_76_83)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_76_83);
  alert(grade_array);
}

if(((prelim_midterm+_76_84)/4 >= selected_average) & (prelim_midterm+_76_84)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_76_84);
  alert(grade_array);
}

if(((prelim_midterm+_76_85)/4 >= selected_average) & (prelim_midterm+_76_85)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_76_85);
  alert(grade_array);
}

if(((prelim_midterm+_76_86)/4 >= selected_average) & (prelim_midterm+_76_86)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_76_86);
  alert(grade_array);
}

if(((prelim_midterm+_76_87)/4 >= selected_average) & (prelim_midterm+_76_87)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_76_87);
  alert(grade_array);
}

if(((prelim_midterm+_76_88)/4 >= selected_average) & (prelim_midterm+_76_88)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_76_88);
  alert(grade_array);
}

if(((prelim_midterm+_76_89)/4 >= selected_average) & (prelim_midterm+_76_89)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_76_89);
  alert(grade_array);
}

if(((prelim_midterm+_76_90)/4 >= selected_average) & (prelim_midterm+_76_90)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_76_90);
  alert(grade_array);
}

if(((prelim_midterm+_76_91)/4 >= selected_average) & (prelim_midterm+_76_91)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_76_91);
  alert(grade_array);
}

if(((prelim_midterm+_76_92)/4 >= selected_average) & (prelim_midterm+_76_92)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_76_92);
  alert(grade_array);
}

if(((prelim_midterm+_76_93)/4 >= selected_average) & (prelim_midterm+_76_93)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_76_93);
  alert(grade_array);
}

if(((prelim_midterm+_76_94)/4 >= selected_average) & (prelim_midterm+_76_94)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_76_94);
  alert(grade_array);
}

if(((prelim_midterm+_76_95)/4 >= selected_average) & (prelim_midterm+_76_95)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_76_95);
  alert(grade_array);
}

if(((prelim_midterm+_76_96)/4 >= selected_average) & (prelim_midterm+_76_96)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_76_96);
  alert(grade_array);
}

if(((prelim_midterm+_76_97)/4 >= selected_average) & (prelim_midterm+_76_97)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_76_97);
  alert(grade_array);
}

if(((prelim_midterm+_76_98)/4 >= selected_average) & (prelim_midterm+_76_98)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_76_98);
  alert(grade_array);
}

if(((prelim_midterm+_76_99)/4 >= selected_average) & (prelim_midterm+_76_99)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_76_99);
  alert(grade_array);
}

if(((prelim_midterm+_76_100)/4 >= selected_average) & (prelim_midterm+_76_100)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_76_100);
  alert(grade_array);
}



// _77

if(((prelim_midterm+_77_75)/4 >= selected_average) & (prelim_midterm+_77_75)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_77_75);
  alert(grade_array);
}

if(((prelim_midterm+_77_76)/4 >= selected_average) & (prelim_midterm+_77_76)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_77_76);
  alert(grade_array);
}

if(((prelim_midterm+_77_77)/4 >= selected_average) & (prelim_midterm+_77_77)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_77_77);
  alert(grade_array);
}

if(((prelim_midterm+_77_78)/4 >= selected_average) & (prelim_midterm+_77_78)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_77_78);
  alert(grade_array);
}

if(((prelim_midterm+_77_79)/4 >= selected_average) & (prelim_midterm+_77_79)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_77_79);
  alert(grade_array);
}

if(((prelim_midterm+_77_80)/4 >= selected_average) & (prelim_midterm+_77_80)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_77_80);
  alert(grade_array);
}

if(((prelim_midterm+_77_81)/4 >= selected_average) & (prelim_midterm+_77_81)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_77_81);
  alert(grade_array);
}

if(((prelim_midterm+_77_82)/4 >= selected_average) & (prelim_midterm+_77_82)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_77_82);
  alert(grade_array);
}

if(((prelim_midterm+_77_83)/4 >= selected_average) & (prelim_midterm+_77_83)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_77_83);
  alert(grade_array);
}

if(((prelim_midterm+_77_84)/4 >= selected_average) & (prelim_midterm+_77_84)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_77_84);
  alert(grade_array);
}

if(((prelim_midterm+_77_85)/4 >= selected_average) & (prelim_midterm+_77_85)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_77_85);
  alert(grade_array);
}

if(((prelim_midterm+_77_86)/4 >= selected_average) & (prelim_midterm+_77_86)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_77_86);
  alert(grade_array);
}

if(((prelim_midterm+_77_87)/4 >= selected_average) & (prelim_midterm+_77_87)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_77_87);
  alert(grade_array);
}

if(((prelim_midterm+_77_88)/4 >= selected_average) & (prelim_midterm+_77_88)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_77_88);
  alert(grade_array);
}

if(((prelim_midterm+_77_89)/4 >= selected_average) & (prelim_midterm+_77_89)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_77_89);
  alert(grade_array);
}

if(((prelim_midterm+_77_90)/4 >= selected_average) & (prelim_midterm+_77_90)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_77_90);
  alert(grade_array);
}

if(((prelim_midterm+_77_91)/4 >= selected_average) & (prelim_midterm+_77_91)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_77_91);
  alert(grade_array);
}

if(((prelim_midterm+_77_92)/4 >= selected_average) & (prelim_midterm+_77_92)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_77_92);
  alert(grade_array);
}

if(((prelim_midterm+_77_93)/4 >= selected_average) & (prelim_midterm+_77_93)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_77_93);
  alert(grade_array);
}

if(((prelim_midterm+_77_94)/4 >= selected_average) & (prelim_midterm+_77_94)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_77_94);
  alert(grade_array);
}

if(((prelim_midterm+_77_95)/4 >= selected_average) & (prelim_midterm+_77_95)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_77_95);
  alert(grade_array);
}

if(((prelim_midterm+_77_96)/4 >= selected_average) & (prelim_midterm+_77_96)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_77_96);
  alert(grade_array);
}

if(((prelim_midterm+_77_97)/4 >= selected_average) & (prelim_midterm+_77_97)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_77_97);
  alert(grade_array);
}

if(((prelim_midterm+_77_98)/4 >= selected_average) & (prelim_midterm+_77_98)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_77_98);
  alert(grade_array);
}

if(((prelim_midterm+_77_99)/4 >= selected_average) & (prelim_midterm+_77_99)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_77_99);
  alert(grade_array);
}

if(((prelim_midterm+_77_100)/4 >= selected_average) & (prelim_midterm+_77_100)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_77_100);
  alert(grade_array);
}


// 78

if(((prelim_midterm+_78_75)/4 >= selected_average) & (prelim_midterm+_78_75)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_78_75);
  alert(grade_array);
}

if(((prelim_midterm+_78_76)/4 >= selected_average) & (prelim_midterm+_78_76)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_78_76);
  alert(grade_array);
}

if(((prelim_midterm+_78_77)/4 >= selected_average) & (prelim_midterm+_78_77)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_78_77);
  alert(grade_array);
}

if(((prelim_midterm+_78_78)/4 >= selected_average) & (prelim_midterm+_78_78)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_78_78);
  alert(grade_array);
}

if(((prelim_midterm+_78_79)/4 >= selected_average) & (prelim_midterm+_78_79)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_78_79);
  alert(grade_array);
}

if(((prelim_midterm+_78_80)/4 >= selected_average) & (prelim_midterm+_78_80)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_78_80);
  alert(grade_array);
}

if(((prelim_midterm+_78_81)/4 >= selected_average) & (prelim_midterm+_78_81)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_78_81);
  alert(grade_array);
}

if(((prelim_midterm+_78_82)/4 >= selected_average) & (prelim_midterm+_78_82)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_78_82);
  alert(grade_array);
}

if(((prelim_midterm+_78_83)/4 >= selected_average) & (prelim_midterm+_78_83)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_78_83);
  alert(grade_array);
}

if(((prelim_midterm+_78_84)/4 >= selected_average) & (prelim_midterm+_78_84)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_78_84);
  alert(grade_array);
}

if(((prelim_midterm+_78_85)/4 >= selected_average) & (prelim_midterm+_78_85)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_78_85);
  alert(grade_array);
}

if(((prelim_midterm+_78_86)/4 >= selected_average) & (prelim_midterm+_78_86)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_78_86);
  alert(grade_array);
}

if(((prelim_midterm+_78_87)/4 >= selected_average) & (prelim_midterm+_78_87)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_78_87);
  alert(grade_array);
}

if(((prelim_midterm+_78_88)/4 >= selected_average) & (prelim_midterm+_78_88)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_78_88);
  alert(grade_array);
}

if(((prelim_midterm+_78_89)/4 >= selected_average) & (prelim_midterm+_78_89)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_78_89);
  alert(grade_array);
}

if(((prelim_midterm+_78_90)/4 >= selected_average) & (prelim_midterm+_78_90)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_78_90);
  alert(grade_array);
}

if(((prelim_midterm+_78_91)/4 >= selected_average) & (prelim_midterm+_78_91)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_78_91);
  alert(grade_array);
}

if(((prelim_midterm+_78_92)/4 >= selected_average) & (prelim_midterm+_78_92)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_78_92);
  alert(grade_array);
}

if(((prelim_midterm+_78_93)/4 >= selected_average) & (prelim_midterm+_78_93)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_78_93);
  alert(grade_array);
}

if(((prelim_midterm+_78_94)/4 >= selected_average) & (prelim_midterm+_78_94)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_78_94);
  alert(grade_array);
}

if(((prelim_midterm+_78_95)/4 >= selected_average) & (prelim_midterm+_78_95)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_78_95);
  alert(grade_array);
}

if(((prelim_midterm+_78_96)/4 >= selected_average) & (prelim_midterm+_78_96)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_78_96);
  alert(grade_array);
}

if(((prelim_midterm+_78_97)/4 >= selected_average) & (prelim_midterm+_78_97)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_78_97);
  alert(grade_array);
}

if(((prelim_midterm+_78_98)/4 >= selected_average) & (prelim_midterm+_78_98)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_78_98);
  alert(grade_array);
}

if(((prelim_midterm+_78_99)/4 >= selected_average) & (prelim_midterm+_78_99)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_78_99);
  alert(grade_array);
}

if(((prelim_midterm+_78_100)/4 >= selected_average) & (prelim_midterm+_78_100)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_78_100);
  alert(grade_array);
}


// 79

if(((prelim_midterm+_79_75)/4 >= selected_average) & (prelim_midterm+_79_75)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_79_75);
  alert(grade_array);
}

if(((prelim_midterm+_79_76)/4 >= selected_average) & (prelim_midterm+_79_76)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_79_76);
  alert(grade_array);
}

if(((prelim_midterm+_79_77)/4 >= selected_average) & (prelim_midterm+_79_77)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_79_77);
  alert(grade_array);
}

if(((prelim_midterm+_79_78)/4 >= selected_average) & (prelim_midterm+_79_78)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_79_78);
  alert(grade_array);
}

if(((prelim_midterm+_79_79)/4 >= selected_average) & (prelim_midterm+_79_79)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_79_79);
  alert(grade_array);
}

if(((prelim_midterm+_79_80)/4 >= selected_average) & (prelim_midterm+_79_80)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_79_80);
  alert(grade_array);
}

if(((prelim_midterm+_79_81)/4 >= selected_average) & (prelim_midterm+_79_81)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_79_81);
  alert(grade_array);
}

if(((prelim_midterm+_79_82)/4 >= selected_average) & (prelim_midterm+_79_82)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_79_82);
  alert(grade_array);
}

if(((prelim_midterm+_79_83)/4 >= selected_average) & (prelim_midterm+_79_83)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_79_83);
  alert(grade_array);
}

if(((prelim_midterm+_79_84)/4 >= selected_average) & (prelim_midterm+_79_84)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_79_84);
  alert(grade_array);
}

if(((prelim_midterm+_79_85)/4 >= selected_average) & (prelim_midterm+_79_85)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_79_85);
  alert(grade_array);
}

if(((prelim_midterm+_79_86)/4 >= selected_average) & (prelim_midterm+_79_86)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_79_86);
  alert(grade_array);
}

if(((prelim_midterm+_79_87)/4 >= selected_average) & (prelim_midterm+_79_87)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_79_87);
  alert(grade_array);
}

if(((prelim_midterm+_79_88)/4 >= selected_average) & (prelim_midterm+_79_88)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_79_88);
  alert(grade_array);
}

if(((prelim_midterm+_79_89)/4 >= selected_average) & (prelim_midterm+_79_89)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_79_89);
  alert(grade_array);
}

if(((prelim_midterm+_79_90)/4 >= selected_average) & (prelim_midterm+_79_90)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_79_90);
  alert(grade_array);
}

if(((prelim_midterm+_79_91)/4 >= selected_average) & (prelim_midterm+_79_91)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_79_91);
  alert(grade_array);
}

if(((prelim_midterm+_79_92)/4 >= selected_average) & (prelim_midterm+_79_92)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_79_92);
  alert(grade_array);
}

if(((prelim_midterm+_79_93)/4 >= selected_average) & (prelim_midterm+_79_93)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_79_93);
  alert(grade_array);
}

if(((prelim_midterm+_79_94)/4 >= selected_average) & (prelim_midterm+_79_94)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_79_94);
  alert(grade_array);
}

if(((prelim_midterm+_79_95)/4 >= selected_average) & (prelim_midterm+_79_95)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_79_95);
  alert(grade_array);
}

if(((prelim_midterm+_79_96)/4 >= selected_average) & (prelim_midterm+_79_96)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_79_96);
  alert(grade_array);
}

if(((prelim_midterm+_79_97)/4 >= selected_average) & (prelim_midterm+_79_97)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_79_97);
  alert(grade_array);
}

if(((prelim_midterm+_79_98)/4 >= selected_average) & (prelim_midterm+_79_98)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_79_98);
  alert(grade_array);
}

if(((prelim_midterm+_79_99)/4 >= selected_average) & (prelim_midterm+_79_99)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_79_99);
  alert(grade_array);
}

if(((prelim_midterm+_79_100)/4 >= selected_average) & (prelim_midterm+_79_100)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_79_100);
  alert(grade_array);
}


// 80

if(((prelim_midterm+_80_75)/4 >= selected_average) & (prelim_midterm+_80_75)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_80_75);
  alert(grade_array);
}

if(((prelim_midterm+_80_76)/4 >= selected_average) & (prelim_midterm+_80_76)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_80_76);
  alert(grade_array);
}

if(((prelim_midterm+_80_77)/4 >= selected_average) & (prelim_midterm+_80_77)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_80_77);
  alert(grade_array);
}

if(((prelim_midterm+_80_78)/4 >= selected_average) & (prelim_midterm+_80_78)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_80_78);
  alert(grade_array);
}

if(((prelim_midterm+_80_79)/4 >= selected_average) & (prelim_midterm+_80_79)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_80_79);
  alert(grade_array);
}

if(((prelim_midterm+_80_80)/4 >= selected_average) & (prelim_midterm+_80_80)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_80_80);
  alert(grade_array);
}

if(((prelim_midterm+_80_81)/4 >= selected_average) & (prelim_midterm+_80_81)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_80_81);
  alert(grade_array);
}

if(((prelim_midterm+_80_82)/4 >= selected_average) & (prelim_midterm+_80_82)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_80_82);
  alert(grade_array);
}

if(((prelim_midterm+_80_83)/4 >= selected_average) & (prelim_midterm+_80_83)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_80_83);
  alert(grade_array);
}

if(((prelim_midterm+_80_84)/4 >= selected_average) & (prelim_midterm+_80_84)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_80_84);
  alert(grade_array);
}

if(((prelim_midterm+_80_85)/4 >= selected_average) & (prelim_midterm+_80_85)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_80_85);
  alert(grade_array);
}

if(((prelim_midterm+_80_86)/4 >= selected_average) & (prelim_midterm+_80_86)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_80_86);
  alert(grade_array);
}

if(((prelim_midterm+_80_87)/4 >= selected_average) & (prelim_midterm+_80_87)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_80_87);
  alert(grade_array);
}

if(((prelim_midterm+_80_88)/4 >= selected_average) & (prelim_midterm+_80_88)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_80_88);
  alert(grade_array);
}

if(((prelim_midterm+_80_89)/4 >= selected_average) & (prelim_midterm+_80_89)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_80_89);
  alert(grade_array);
}

if(((prelim_midterm+_80_90)/4 >= selected_average) & (prelim_midterm+_80_90)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_80_90);
  alert(grade_array);
}

if(((prelim_midterm+_80_91)/4 >= selected_average) & (prelim_midterm+_80_91)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_80_91);
  alert(grade_array);
}

if(((prelim_midterm+_80_92)/4 >= selected_average) & (prelim_midterm+_80_92)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_80_92);
  alert(grade_array);
}

if(((prelim_midterm+_80_93)/4 >= selected_average) & (prelim_midterm+_80_93)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_80_93);
  alert(grade_array);
}

if(((prelim_midterm+_80_94)/4 >= selected_average) & (prelim_midterm+_80_94)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_80_94);
  alert(grade_array);
}

if(((prelim_midterm+_80_95)/4 >= selected_average) & (prelim_midterm+_80_95)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_80_95);
  alert(grade_array);
}

if(((prelim_midterm+_80_96)/4 >= selected_average) & (prelim_midterm+_80_96)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_80_96);
  alert(grade_array);
}

if(((prelim_midterm+_80_97)/4 >= selected_average) & (prelim_midterm+_80_97)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_80_97);
  alert(grade_array);
}

if(((prelim_midterm+_80_98)/4 >= selected_average) & (prelim_midterm+_80_98)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_80_98);
  alert(grade_array);
}

if(((prelim_midterm+_80_99)/4 >= selected_average) & (prelim_midterm+_80_99)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_80_99);
  alert(grade_array);
}

if(((prelim_midterm+_80_100)/4 >= selected_average) & (prelim_midterm+_80_100)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_80_100);
  alert(grade_array);
}


// 81

if(((prelim_midterm+_81_75)/4 >= selected_average) & (prelim_midterm+_81_75)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_81_75);
  alert(grade_array);
}

if(((prelim_midterm+_81_76)/4 >= selected_average) & (prelim_midterm+_81_76)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_81_76);
  alert(grade_array);
}

if(((prelim_midterm+_81_77)/4 >= selected_average) & (prelim_midterm+_81_77)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_81_77);
  alert(grade_array);
}

if(((prelim_midterm+_81_78)/4 >= selected_average) & (prelim_midterm+_81_78)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_81_78);
  alert(grade_array);
}

if(((prelim_midterm+_81_79)/4 >= selected_average) & (prelim_midterm+_81_79)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_81_79);
  alert(grade_array);
}

if(((prelim_midterm+_81_80)/4 >= selected_average) & (prelim_midterm+_81_80)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_81_80);
  alert(grade_array);
}

if(((prelim_midterm+_81_81)/4 >= selected_average) & (prelim_midterm+_81_81)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_81_81);
  alert(grade_array);
}

if(((prelim_midterm+_81_82)/4 >= selected_average) & (prelim_midterm+_81_82)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_81_82);
  alert(grade_array);
}

if(((prelim_midterm+_81_83)/4 >= selected_average) & (prelim_midterm+_81_83)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_81_83);
  alert(grade_array);
}

if(((prelim_midterm+_81_84)/4 >= selected_average) & (prelim_midterm+_81_84)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_81_84);
  alert(grade_array);
}

if(((prelim_midterm+_81_85)/4 >= selected_average) & (prelim_midterm+_81_85)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_81_85);
  alert(grade_array);
}

if(((prelim_midterm+_81_86)/4 >= selected_average) & (prelim_midterm+_81_86)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_81_86);
  alert(grade_array);
}

if(((prelim_midterm+_81_87)/4 >= selected_average) & (prelim_midterm+_81_87)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_81_87);
  alert(grade_array);
}

if(((prelim_midterm+_81_88)/4 >= selected_average) & (prelim_midterm+_81_88)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_81_88);
  alert(grade_array);
}

if(((prelim_midterm+_81_89)/4 >= selected_average) & (prelim_midterm+_81_89)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_81_89);
  alert(grade_array);
}

if(((prelim_midterm+_81_90)/4 >= selected_average) & (prelim_midterm+_81_90)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_81_90);
  alert(grade_array);
}

if(((prelim_midterm+_81_91)/4 >= selected_average) & (prelim_midterm+_81_91)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_81_91);
  alert(grade_array);
}

if(((prelim_midterm+_81_92)/4 >= selected_average) & (prelim_midterm+_81_92)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_81_92);
  alert(grade_array);
}

if(((prelim_midterm+_81_93)/4 >= selected_average) & (prelim_midterm+_81_93)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_81_93);
  alert(grade_array);
}

if(((prelim_midterm+_81_94)/4 >= selected_average) & (prelim_midterm+_81_94)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_81_94);
  alert(grade_array);
}

if(((prelim_midterm+_81_95)/4 >= selected_average) & (prelim_midterm+_81_95)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_81_95);
  alert(grade_array);
}

if(((prelim_midterm+_81_96)/4 >= selected_average) & (prelim_midterm+_81_96)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_81_96);
  alert(grade_array);
}

if(((prelim_midterm+_81_97)/4 >= selected_average) & (prelim_midterm+_81_97)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_81_97);
  alert(grade_array);
}

if(((prelim_midterm+_81_98)/4 >= selected_average) & (prelim_midterm+_81_98)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_81_98);
  alert(grade_array);
}

if(((prelim_midterm+_81_99)/4 >= selected_average) & (prelim_midterm+_81_99)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_81_99);
  alert(grade_array);
}

if(((prelim_midterm+_81_100)/4 >= selected_average) & (prelim_midterm+_81_100)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_81_100);
  alert(grade_array);
}


// 82

if(((prelim_midterm+_82_75)/4 >= selected_average) & (prelim_midterm+_82_75)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_82_75);
  alert(grade_array);
}

if(((prelim_midterm+_82_76)/4 >= selected_average) & (prelim_midterm+_82_76)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_82_76);
  alert(grade_array);
}

if(((prelim_midterm+_82_77)/4 >= selected_average) & (prelim_midterm+_82_77)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_82_77);
  alert(grade_array);
}

if(((prelim_midterm+_82_78)/4 >= selected_average) & (prelim_midterm+_82_78)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_82_78);
  alert(grade_array);
}

if(((prelim_midterm+_82_79)/4 >= selected_average) & (prelim_midterm+_82_79)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_82_79);
  alert(grade_array);
}

if(((prelim_midterm+_82_80)/4 >= selected_average) & (prelim_midterm+_82_80)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_82_80);
  alert(grade_array);
}

if(((prelim_midterm+_82_81)/4 >= selected_average) & (prelim_midterm+_82_81)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_82_81);
  alert(grade_array);
}

if(((prelim_midterm+_82_82)/4 >= selected_average) & (prelim_midterm+_82_82)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_82_82);
  alert(grade_array);
}

if(((prelim_midterm+_82_83)/4 >= selected_average) & (prelim_midterm+_82_83)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_82_83);
  alert(grade_array);
}

if(((prelim_midterm+_82_84)/4 >= selected_average) & (prelim_midterm+_82_84)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_82_84);
  alert(grade_array);
}

if(((prelim_midterm+_82_85)/4 >= selected_average) & (prelim_midterm+_82_85)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_82_85);
  alert(grade_array);
}

if(((prelim_midterm+_82_86)/4 >= selected_average) & (prelim_midterm+_82_86)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_82_86);
  alert(grade_array);
}

if(((prelim_midterm+_82_87)/4 >= selected_average) & (prelim_midterm+_82_87)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_82_87);
  alert(grade_array);
}

if(((prelim_midterm+_82_88)/4 >= selected_average) & (prelim_midterm+_82_88)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_82_88);
  alert(grade_array);
}

if(((prelim_midterm+_82_89)/4 >= selected_average) & (prelim_midterm+_82_89)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_82_89);
  alert(grade_array);
}

if(((prelim_midterm+_82_90)/4 >= selected_average) & (prelim_midterm+_82_90)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_82_90);
  alert(grade_array);
}

if(((prelim_midterm+_82_91)/4 >= selected_average) & (prelim_midterm+_82_91)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_82_91);
  alert(grade_array);
}

if(((prelim_midterm+_82_92)/4 >= selected_average) & (prelim_midterm+_82_92)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_82_92);
  alert(grade_array);
}

if(((prelim_midterm+_82_93)/4 >= selected_average) & (prelim_midterm+_82_93)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_82_93);
  alert(grade_array);
}

if(((prelim_midterm+_82_94)/4 >= selected_average) & (prelim_midterm+_82_94)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_82_94);
  alert(grade_array);
}

if(((prelim_midterm+_82_95)/4 >= selected_average) & (prelim_midterm+_82_95)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_82_95);
  alert(grade_array);
}

if(((prelim_midterm+_82_96)/4 >= selected_average) & (prelim_midterm+_82_96)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_82_96);
  alert(grade_array);
}

if(((prelim_midterm+_82_97)/4 >= selected_average) & (prelim_midterm+_82_97)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_82_97);
  alert(grade_array);
}

if(((prelim_midterm+_82_98)/4 >= selected_average) & (prelim_midterm+_82_98)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_82_98);
  alert(grade_array);
}

if(((prelim_midterm+_82_99)/4 >= selected_average) & (prelim_midterm+_82_99)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_82_99);
  alert(grade_array);
}

if(((prelim_midterm+_82_100)/4 >= selected_average) & (prelim_midterm+_82_100)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_82_100);
  alert(grade_array);
}


// 83

if(((prelim_midterm+_83_75)/4 >= selected_average) & (prelim_midterm+_83_75)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_83_75);
  alert(grade_array);
}

if(((prelim_midterm+_83_76)/4 >= selected_average) & (prelim_midterm+_83_76)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_83_76);
  alert(grade_array);
}

if(((prelim_midterm+_83_77)/4 >= selected_average) & (prelim_midterm+_83_77)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_83_77);
  alert(grade_array);
}

if(((prelim_midterm+_83_78)/4 >= selected_average) & (prelim_midterm+_83_78)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_83_78);
  alert(grade_array);
}

if(((prelim_midterm+_83_79)/4 >= selected_average) & (prelim_midterm+_83_79)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_83_79);
  alert(grade_array);
}

if(((prelim_midterm+_83_80)/4 >= selected_average) & (prelim_midterm+_83_80)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_83_80);
  alert(grade_array);
}

if(((prelim_midterm+_83_81)/4 >= selected_average) & (prelim_midterm+_83_81)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_83_81);
  alert(grade_array);
}

if(((prelim_midterm+_83_82)/4 >= selected_average) & (prelim_midterm+_83_82)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_83_82);
  alert(grade_array);
}

if(((prelim_midterm+_83_83)/4 >= selected_average) & (prelim_midterm+_83_83)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_83_83);
  alert(grade_array);
}

if(((prelim_midterm+_83_84)/4 >= selected_average) & (prelim_midterm+_83_84)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_83_84);
  alert(grade_array);
}

if(((prelim_midterm+_83_85)/4 >= selected_average) & (prelim_midterm+_83_85)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_83_85);
  alert(grade_array);
}

if(((prelim_midterm+_83_86)/4 >= selected_average) & (prelim_midterm+_83_86)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_83_86);
  alert(grade_array);
}

if(((prelim_midterm+_83_87)/4 >= selected_average) & (prelim_midterm+_83_87)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_83_87);
  alert(grade_array);
}

if(((prelim_midterm+_83_88)/4 >= selected_average) & (prelim_midterm+_83_88)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_83_88);
  alert(grade_array);
}

if(((prelim_midterm+_83_89)/4 >= selected_average) & (prelim_midterm+_83_89)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_83_89);
  alert(grade_array);
}

if(((prelim_midterm+_83_90)/4 >= selected_average) & (prelim_midterm+_83_90)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_83_90);
  alert(grade_array);
}

if(((prelim_midterm+_83_91)/4 >= selected_average) & (prelim_midterm+_83_91)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_83_91);
  alert(grade_array);
}

if(((prelim_midterm+_83_92)/4 >= selected_average) & (prelim_midterm+_83_92)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_83_92);
  alert(grade_array);
}

if(((prelim_midterm+_83_93)/4 >= selected_average) & (prelim_midterm+_83_93)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_83_93);
  alert(grade_array);
}

if(((prelim_midterm+_83_94)/4 >= selected_average) & (prelim_midterm+_83_94)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_83_94);
  alert(grade_array);
}

if(((prelim_midterm+_83_95)/4 >= selected_average) & (prelim_midterm+_83_95)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_83_95);
  alert(grade_array);
}

if(((prelim_midterm+_83_96)/4 >= selected_average) & (prelim_midterm+_83_96)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_83_96);
  alert(grade_array);
}

if(((prelim_midterm+_83_97)/4 >= selected_average) & (prelim_midterm+_83_97)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_83_97);
  alert(grade_array);
}

if(((prelim_midterm+_83_98)/4 >= selected_average) & (prelim_midterm+_83_98)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_83_98);
  alert(grade_array);
}

if(((prelim_midterm+_83_99)/4 >= selected_average) & (prelim_midterm+_83_99)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_83_99);
  alert(grade_array);
}

if(((prelim_midterm+_83_100)/4 >= selected_average) & (prelim_midterm+_83_100)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_83_100);
  alert(grade_array);
}


// 84

if(((prelim_midterm+_84_75)/4 >= selected_average) & (prelim_midterm+_84_75)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_84_75);
  alert(grade_array);
}

if(((prelim_midterm+_84_76)/4 >= selected_average) & (prelim_midterm+_84_76)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_84_76);
  alert(grade_array);
}

if(((prelim_midterm+_84_77)/4 >= selected_average) & (prelim_midterm+_84_77)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_84_77);
  alert(grade_array);
}

if(((prelim_midterm+_84_78)/4 >= selected_average) & (prelim_midterm+_84_78)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_84_78);
  alert(grade_array);
}

if(((prelim_midterm+_84_79)/4 >= selected_average) & (prelim_midterm+_84_79)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_84_79);
  alert(grade_array);
}

if(((prelim_midterm+_84_80)/4 >= selected_average) & (prelim_midterm+_84_80)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_84_80);
  alert(grade_array);
}

if(((prelim_midterm+_84_81)/4 >= selected_average) & (prelim_midterm+_84_81)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_84_81);
  alert(grade_array);
}

if(((prelim_midterm+_84_82)/4 >= selected_average) & (prelim_midterm+_84_82)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_84_82);
  alert(grade_array);
}

if(((prelim_midterm+_84_83)/4 >= selected_average) & (prelim_midterm+_84_83)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_84_83);
  alert(grade_array);
}

if(((prelim_midterm+_84_84)/4 >= selected_average) & (prelim_midterm+_84_84)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_84_84);
  alert(grade_array);
}

if(((prelim_midterm+_84_85)/4 >= selected_average) & (prelim_midterm+_84_85)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_84_85);
  alert(grade_array);
}

if(((prelim_midterm+_84_86)/4 >= selected_average) & (prelim_midterm+_84_86)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_84_86);
  alert(grade_array);
}

if(((prelim_midterm+_84_87)/4 >= selected_average) & (prelim_midterm+_84_87)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_84_87);
  alert(grade_array);
}

if(((prelim_midterm+_84_88)/4 >= selected_average) & (prelim_midterm+_84_88)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_84_88);
  alert(grade_array);
}

if(((prelim_midterm+_84_89)/4 >= selected_average) & (prelim_midterm+_84_89)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_84_89);
  alert(grade_array);
}

if(((prelim_midterm+_84_90)/4 >= selected_average) & (prelim_midterm+_84_90)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_84_90);
  alert(grade_array);
}

if(((prelim_midterm+_84_91)/4 >= selected_average) & (prelim_midterm+_84_91)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_84_91);
  alert(grade_array);
}

if(((prelim_midterm+_84_92)/4 >= selected_average) & (prelim_midterm+_84_92)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_84_92);
  alert(grade_array);
}

if(((prelim_midterm+_84_93)/4 >= selected_average) & (prelim_midterm+_84_93)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_84_93);
  alert(grade_array);
}

if(((prelim_midterm+_84_94)/4 >= selected_average) & (prelim_midterm+_84_94)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_84_94);
  alert(grade_array);
}

if(((prelim_midterm+_84_95)/4 >= selected_average) & (prelim_midterm+_84_95)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_84_95);
  alert(grade_array);
}

if(((prelim_midterm+_84_96)/4 >= selected_average) & (prelim_midterm+_84_96)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_84_96);
  alert(grade_array);
}

if(((prelim_midterm+_84_97)/4 >= selected_average) & (prelim_midterm+_84_97)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_84_97);
  alert(grade_array);
}

if(((prelim_midterm+_84_98)/4 >= selected_average) & (prelim_midterm+_84_98)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_84_98);
  alert(grade_array);
}

if(((prelim_midterm+_84_99)/4 >= selected_average) & (prelim_midterm+_84_99)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_84_99);
  alert(grade_array);
}

if(((prelim_midterm+_84_100)/4 >= selected_average) & (prelim_midterm+_84_100)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_84_100);
  alert(grade_array);
}


// 85

if(((prelim_midterm+_85_75)/4 >= selected_average) & (prelim_midterm+_85_75)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_85_75);
  alert(grade_array);
}

if(((prelim_midterm+_85_76)/4 >= selected_average) & (prelim_midterm+_85_76)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_85_76);
  alert(grade_array);
}

if(((prelim_midterm+_85_77)/4 >= selected_average) & (prelim_midterm+_85_77)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_85_77);
  alert(grade_array);
}

if(((prelim_midterm+_85_78)/4 >= selected_average) & (prelim_midterm+_85_78)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_85_78);
  alert(grade_array);
}

if(((prelim_midterm+_85_79)/4 >= selected_average) & (prelim_midterm+_85_79)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_85_79);
  alert(grade_array);
}

if(((prelim_midterm+_85_80)/4 >= selected_average) & (prelim_midterm+_85_80)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_85_80);
  alert(grade_array);
}

if(((prelim_midterm+_85_81)/4 >= selected_average) & (prelim_midterm+_85_81)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_85_81);
  alert(grade_array);
}

if(((prelim_midterm+_85_82)/4 >= selected_average) & (prelim_midterm+_85_82)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_85_82);
  alert(grade_array);
}

if(((prelim_midterm+_85_83)/4 >= selected_average) & (prelim_midterm+_85_83)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_85_83);
  alert(grade_array);
}

if(((prelim_midterm+_85_84)/4 >= selected_average) & (prelim_midterm+_85_84)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_85_84);
  alert(grade_array);
}

if(((prelim_midterm+_85_85)/4 >= selected_average) & (prelim_midterm+_85_85)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_85_85);
  alert(grade_array);
}

if(((prelim_midterm+_85_86)/4 >= selected_average) & (prelim_midterm+_85_86)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_85_86);
  alert(grade_array);
}

if(((prelim_midterm+_85_87)/4 >= selected_average) & (prelim_midterm+_85_87)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_85_87);
  alert(grade_array);
}

if(((prelim_midterm+_85_88)/4 >= selected_average) & (prelim_midterm+_85_88)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_85_88);
  alert(grade_array);
}

if(((prelim_midterm+_85_89)/4 >= selected_average) & (prelim_midterm+_85_89)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_85_89);
  alert(grade_array);
}

if(((prelim_midterm+_85_90)/4 >= selected_average) & (prelim_midterm+_85_90)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_85_90);
  alert(grade_array);
}

if(((prelim_midterm+_85_91)/4 >= selected_average) & (prelim_midterm+_85_91)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_85_91);
  alert(grade_array);
}

if(((prelim_midterm+_85_92)/4 >= selected_average) & (prelim_midterm+_85_92)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_85_92);
  alert(grade_array);
}

if(((prelim_midterm+_85_93)/4 >= selected_average) & (prelim_midterm+_85_93)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_85_93);
  alert(grade_array);
}

if(((prelim_midterm+_85_94)/4 >= selected_average) & (prelim_midterm+_85_94)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_85_94);
  alert(grade_array);
}

if(((prelim_midterm+_85_95)/4 >= selected_average) & (prelim_midterm+_85_95)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_85_95);
  alert(grade_array);
}

if(((prelim_midterm+_85_96)/4 >= selected_average) & (prelim_midterm+_85_96)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_85_96);
  alert(grade_array);
}

if(((prelim_midterm+_85_97)/4 >= selected_average) & (prelim_midterm+_85_97)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_85_97);
  alert(grade_array);
}

if(((prelim_midterm+_85_98)/4 >= selected_average) & (prelim_midterm+_85_98)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_85_98);
  alert(grade_array);
}

if(((prelim_midterm+_85_99)/4 >= selected_average) & (prelim_midterm+_85_99)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_85_99);
  alert(grade_array);
}

if(((prelim_midterm+_85_100)/4 >= selected_average) & (prelim_midterm+_85_100)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_85_100);
  alert(grade_array);
}


// 86

if(((prelim_midterm+_86_75)/4 >= selected_average) & (prelim_midterm+_86_75)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_86_75);
  alert(grade_array);
}

if(((prelim_midterm+_86_76)/4 >= selected_average) & (prelim_midterm+_86_76)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_86_76);
  alert(grade_array);
}

if(((prelim_midterm+_86_77)/4 >= selected_average) & (prelim_midterm+_86_77)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_86_77);
  alert(grade_array);
}

if(((prelim_midterm+_86_78)/4 >= selected_average) & (prelim_midterm+_86_78)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_86_78);
  alert(grade_array);
}

if(((prelim_midterm+_86_79)/4 >= selected_average) & (prelim_midterm+_86_79)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_86_79);
  alert(grade_array);
}

if(((prelim_midterm+_86_80)/4 >= selected_average) & (prelim_midterm+_86_80)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_86_80);
  alert(grade_array);
}

if(((prelim_midterm+_86_81)/4 >= selected_average) & (prelim_midterm+_86_81)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_86_81);
  alert(grade_array);
}

if(((prelim_midterm+_86_82)/4 >= selected_average) & (prelim_midterm+_86_82)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_86_82);
  alert(grade_array);
}

if(((prelim_midterm+_86_83)/4 >= selected_average) & (prelim_midterm+_86_83)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_86_83);
  alert(grade_array);
}

if(((prelim_midterm+_86_84)/4 >= selected_average) & (prelim_midterm+_86_84)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_86_84);
  alert(grade_array);
}

if(((prelim_midterm+_86_85)/4 >= selected_average) & (prelim_midterm+_86_85)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_86_85);
  alert(grade_array);
}

if(((prelim_midterm+_86_86)/4 >= selected_average) & (prelim_midterm+_86_86)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_86_86);
  alert(grade_array);
}

if(((prelim_midterm+_86_87)/4 >= selected_average) & (prelim_midterm+_86_87)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_86_87);
  alert(grade_array);
}

if(((prelim_midterm+_86_88)/4 >= selected_average) & (prelim_midterm+_86_88)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_86_88);
  alert(grade_array);
}

if(((prelim_midterm+_86_89)/4 >= selected_average) & (prelim_midterm+_86_89)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_86_89);
  alert(grade_array);
}

if(((prelim_midterm+_86_90)/4 >= selected_average) & (prelim_midterm+_86_90)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_86_90);
  alert(grade_array);
}

if(((prelim_midterm+_86_91)/4 >= selected_average) & (prelim_midterm+_86_91)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_86_91);
  alert(grade_array);
}

if(((prelim_midterm+_86_92)/4 >= selected_average) & (prelim_midterm+_86_92)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_86_92);
  alert(grade_array);
}

if(((prelim_midterm+_86_93)/4 >= selected_average) & (prelim_midterm+_86_93)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_86_93);
  alert(grade_array);
}

if(((prelim_midterm+_86_94)/4 >= selected_average) & (prelim_midterm+_86_94)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_86_94);
  alert(grade_array);
}

if(((prelim_midterm+_86_95)/4 >= selected_average) & (prelim_midterm+_86_95)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_86_95);
  alert(grade_array);
}

if(((prelim_midterm+_86_96)/4 >= selected_average) & (prelim_midterm+_86_96)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_86_96);
  alert(grade_array);
}

if(((prelim_midterm+_86_97)/4 >= selected_average) & (prelim_midterm+_86_97)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_86_97);
  alert(grade_array);
}

if(((prelim_midterm+_86_98)/4 >= selected_average) & (prelim_midterm+_86_98)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_86_98);
  alert(grade_array);
}

if(((prelim_midterm+_86_99)/4 >= selected_average) & (prelim_midterm+_86_99)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_86_99);
  alert(grade_array);
}

if(((prelim_midterm+_86_100)/4 >= selected_average) & (prelim_midterm+_86_100)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_86_100);
  alert(grade_array);
}


// 87

if(((prelim_midterm+_87_75)/4 >= selected_average) & (prelim_midterm+_87_75)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_87_75);
  alert(grade_array);
}

if(((prelim_midterm+_87_76)/4 >= selected_average) & (prelim_midterm+_87_76)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_87_76);
  alert(grade_array);
}

if(((prelim_midterm+_87_77)/4 >= selected_average) & (prelim_midterm+_87_77)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_87_77);
  alert(grade_array);
}

if(((prelim_midterm+_87_78)/4 >= selected_average) & (prelim_midterm+_87_78)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_87_78);
  alert(grade_array);
}

if(((prelim_midterm+_87_79)/4 >= selected_average) & (prelim_midterm+_87_79)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_87_79);
  alert(grade_array);
}

if(((prelim_midterm+_87_80)/4 >= selected_average) & (prelim_midterm+_87_80)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_87_80);
  alert(grade_array);
}

if(((prelim_midterm+_87_81)/4 >= selected_average) & (prelim_midterm+_87_81)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_87_81);
  alert(grade_array);
}

if(((prelim_midterm+_87_82)/4 >= selected_average) & (prelim_midterm+_87_82)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_87_82);
  alert(grade_array);
}

if(((prelim_midterm+_87_83)/4 >= selected_average) & (prelim_midterm+_87_83)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_87_83);
  alert(grade_array);
}

if(((prelim_midterm+_87_84)/4 >= selected_average) & (prelim_midterm+_87_84)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_87_84);
  alert(grade_array);
}

if(((prelim_midterm+_87_85)/4 >= selected_average) & (prelim_midterm+_87_85)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_87_85);
  alert(grade_array);
}

if(((prelim_midterm+_87_86)/4 >= selected_average) & (prelim_midterm+_87_86)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_87_86);
  alert(grade_array);
}

if(((prelim_midterm+_87_87)/4 >= selected_average) & (prelim_midterm+_87_87)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_87_87);
  alert(grade_array);
}

if(((prelim_midterm+_87_88)/4 >= selected_average) & (prelim_midterm+_87_88)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_87_88);
  alert(grade_array);
}

if(((prelim_midterm+_87_89)/4 >= selected_average) & (prelim_midterm+_87_89)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_87_89);
  alert(grade_array);
}

if(((prelim_midterm+_87_90)/4 >= selected_average) & (prelim_midterm+_87_90)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_87_90);
  alert(grade_array);
}

if(((prelim_midterm+_87_91)/4 >= selected_average) & (prelim_midterm+_87_91)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_87_91);
  alert(grade_array);
}

if(((prelim_midterm+_87_92)/4 >= selected_average) & (prelim_midterm+_87_92)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_87_92);
  alert(grade_array);
}

if(((prelim_midterm+_87_93)/4 >= selected_average) & (prelim_midterm+_87_93)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_87_93);
  alert(grade_array);
}

if(((prelim_midterm+_87_94)/4 >= selected_average) & (prelim_midterm+_87_94)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_87_94);
  alert(grade_array);
}

if(((prelim_midterm+_87_95)/4 >= selected_average) & (prelim_midterm+_87_95)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_87_95);
  alert(grade_array);
}

if(((prelim_midterm+_87_96)/4 >= selected_average) & (prelim_midterm+_87_96)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_87_96);
  alert(grade_array);
}

if(((prelim_midterm+_87_97)/4 >= selected_average) & (prelim_midterm+_87_97)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_87_97);
  alert(grade_array);
}

if(((prelim_midterm+_87_98)/4 >= selected_average) & (prelim_midterm+_87_98)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_87_98);
  alert(grade_array);
}

if(((prelim_midterm+_87_99)/4 >= selected_average) & (prelim_midterm+_87_99)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_87_99);
  alert(grade_array);
}

if(((prelim_midterm+_87_100)/4 >= selected_average) & (prelim_midterm+_87_100)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_87_100);
  alert(grade_array);
}


// 88

if(((prelim_midterm+_88_75)/4 >= selected_average) & (prelim_midterm+_88_75)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_88_75);
  alert(grade_array);
}

if(((prelim_midterm+_88_76)/4 >= selected_average) & (prelim_midterm+_88_76)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_88_76);
  alert(grade_array);
}

if(((prelim_midterm+_88_77)/4 >= selected_average) & (prelim_midterm+_88_77)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_88_77);
  alert(grade_array);
}

if(((prelim_midterm+_88_78)/4 >= selected_average) & (prelim_midterm+_88_78)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_88_78);
  alert(grade_array);
}

if(((prelim_midterm+_88_79)/4 >= selected_average) & (prelim_midterm+_88_79)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_88_79);
  alert(grade_array);
}

if(((prelim_midterm+_88_80)/4 >= selected_average) & (prelim_midterm+_88_80)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_88_80);
  alert(grade_array);
}

if(((prelim_midterm+_88_81)/4 >= selected_average) & (prelim_midterm+_88_81)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_88_81);
  alert(grade_array);
}

if(((prelim_midterm+_88_82)/4 >= selected_average) & (prelim_midterm+_88_82)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_88_82);
  alert(grade_array);
}

if(((prelim_midterm+_88_83)/4 >= selected_average) & (prelim_midterm+_88_83)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_88_83);
  alert(grade_array);
}

if(((prelim_midterm+_88_84)/4 >= selected_average) & (prelim_midterm+_88_84)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_88_84);
  alert(grade_array);
}

if(((prelim_midterm+_88_85)/4 >= selected_average) & (prelim_midterm+_88_85)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_88_85);
  alert(grade_array);
}

if(((prelim_midterm+_88_86)/4 >= selected_average) & (prelim_midterm+_88_86)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_88_86);
  alert(grade_array);
}

if(((prelim_midterm+_88_87)/4 >= selected_average) & (prelim_midterm+_88_87)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_88_87);
  alert(grade_array);
}

if(((prelim_midterm+_88_88)/4 >= selected_average) & (prelim_midterm+_88_88)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_88_88);
  alert(grade_array);
}

if(((prelim_midterm+_88_89)/4 >= selected_average) & (prelim_midterm+_88_89)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_88_89);
  alert(grade_array);
}

if(((prelim_midterm+_88_90)/4 >= selected_average) & (prelim_midterm+_88_90)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_88_90);
  alert(grade_array);
}

if(((prelim_midterm+_88_91)/4 >= selected_average) & (prelim_midterm+_88_91)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_88_91);
  alert(grade_array);
}

if(((prelim_midterm+_88_92)/4 >= selected_average) & (prelim_midterm+_88_92)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_88_92);
  alert(grade_array);
}

if(((prelim_midterm+_88_93)/4 >= selected_average) & (prelim_midterm+_88_93)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_88_93);
  alert(grade_array);
}

if(((prelim_midterm+_88_94)/4 >= selected_average) & (prelim_midterm+_88_94)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_88_94);
  alert(grade_array);
}

if(((prelim_midterm+_88_95)/4 >= selected_average) & (prelim_midterm+_88_95)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_88_95);
  alert(grade_array);
}

if(((prelim_midterm+_88_96)/4 >= selected_average) & (prelim_midterm+_88_96)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_88_96);
  alert(grade_array);
}

if(((prelim_midterm+_88_97)/4 >= selected_average) & (prelim_midterm+_88_97)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_88_97);
  alert(grade_array);
}

if(((prelim_midterm+_88_98)/4 >= selected_average) & (prelim_midterm+_88_98)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_88_98);
  alert(grade_array);
}

if(((prelim_midterm+_88_99)/4 >= selected_average) & (prelim_midterm+_88_99)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_88_99);
  alert(grade_array);
}

if(((prelim_midterm+_88_100)/4 >= selected_average) & (prelim_midterm+_88_100)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_88_100);
  alert(grade_array);
}


// 89

if(((prelim_midterm+_89_75)/4 >= selected_average) & (prelim_midterm+_89_75)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_89_75);
  alert(grade_array);
}

if(((prelim_midterm+_89_76)/4 >= selected_average) & (prelim_midterm+_89_76)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_89_76);
  alert(grade_array);
}

if(((prelim_midterm+_89_77)/4 >= selected_average) & (prelim_midterm+_89_77)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_89_77);
  alert(grade_array);
}

if(((prelim_midterm+_89_78)/4 >= selected_average) & (prelim_midterm+_89_78)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_89_78);
  alert(grade_array);
}

if(((prelim_midterm+_89_79)/4 >= selected_average) & (prelim_midterm+_89_79)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_89_79);
  alert(grade_array);
}

if(((prelim_midterm+_89_80)/4 >= selected_average) & (prelim_midterm+_89_80)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_89_80);
  alert(grade_array);
}

if(((prelim_midterm+_89_81)/4 >= selected_average) & (prelim_midterm+_89_81)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_89_81);
  alert(grade_array);
}

if(((prelim_midterm+_89_82)/4 >= selected_average) & (prelim_midterm+_89_82)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_89_82);
  alert(grade_array);
}

if(((prelim_midterm+_89_83)/4 >= selected_average) & (prelim_midterm+_89_83)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_89_83);
  alert(grade_array);
}

if(((prelim_midterm+_89_84)/4 >= selected_average) & (prelim_midterm+_89_84)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_89_84);
  alert(grade_array);
}

if(((prelim_midterm+_89_85)/4 >= selected_average) & (prelim_midterm+_89_85)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_89_85);
  alert(grade_array);
}

if(((prelim_midterm+_89_86)/4 >= selected_average) & (prelim_midterm+_89_86)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_89_86);
  alert(grade_array);
}

if(((prelim_midterm+_89_87)/4 >= selected_average) & (prelim_midterm+_89_87)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_89_87);
  alert(grade_array);
}

if(((prelim_midterm+_89_88)/4 >= selected_average) & (prelim_midterm+_89_88)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_89_88);
  alert(grade_array);
}

if(((prelim_midterm+_89_89)/4 >= selected_average) & (prelim_midterm+_89_89)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_89_89);
  alert(grade_array);
}

if(((prelim_midterm+_89_90)/4 >= selected_average) & (prelim_midterm+_89_90)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_89_90);
  alert(grade_array);
}

if(((prelim_midterm+_89_90)/4 >= selected_average) & (prelim_midterm+_89_90)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_89_90);
  alert(grade_array);
}

if(((prelim_midterm+_89_91)/4 >= selected_average) & (prelim_midterm+_89_91)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_89_91);
  alert(grade_array);
}

if(((prelim_midterm+_89_92)/4 >= selected_average) & (prelim_midterm+_89_92)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_89_92);
  alert(grade_array);
}

if(((prelim_midterm+_89_93)/4 >= selected_average) & (prelim_midterm+_89_93)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_89_93);
  alert(grade_array);
}

if(((prelim_midterm+_89_94)/4 >= selected_average) & (prelim_midterm+_89_94)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_89_94);
  alert(grade_array);
}

if(((prelim_midterm+_89_95)/4 >= selected_average) & (prelim_midterm+_89_95)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_89_95);
  alert(grade_array);
}

if(((prelim_midterm+_89_96)/4 >= selected_average) & (prelim_midterm+_89_96)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_89_96);
  alert(grade_array);
}

if(((prelim_midterm+_89_97)/4 >= selected_average) & (prelim_midterm+_89_97)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_89_97);
  alert(grade_array);
}

if(((prelim_midterm+_89_98)/4 >= selected_average) & (prelim_midterm+_89_98)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_89_98);
  alert(grade_array);
}

if(((prelim_midterm+_89_99)/4 >= selected_average) & (prelim_midterm+_89_99)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_89_99);
  alert(grade_array);
}

if(((prelim_midterm+_89_100)/4 >= selected_average) & (prelim_midterm+_89_100)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_89_100);
  alert(grade_array);
}


// 90

if(((prelim_midterm+_90_75)/4 >= selected_average) & (prelim_midterm+_90_75)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_90_75);
  alert(grade_array);
}

if(((prelim_midterm+_90_76)/4 >= selected_average) & (prelim_midterm+_90_76)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_90_76);
  alert(grade_array);
}

if(((prelim_midterm+_90_77)/4 >= selected_average) & (prelim_midterm+_90_77)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_90_77);
  alert(grade_array);
}

if(((prelim_midterm+_90_78)/4 >= selected_average) & (prelim_midterm+_90_78)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_90_78);
  alert(grade_array);
}

if(((prelim_midterm+_90_79)/4 >= selected_average) & (prelim_midterm+_90_79)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_90_79);
  alert(grade_array);
}

if(((prelim_midterm+_90_80)/4 >= selected_average) & (prelim_midterm+_90_80)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_90_80);
  alert(grade_array);
}

if(((prelim_midterm+_90_81)/4 >= selected_average) & (prelim_midterm+_90_81)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_90_81);
  alert(grade_array);
}

if(((prelim_midterm+_90_82)/4 >= selected_average) & (prelim_midterm+_90_82)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_90_82);
  alert(grade_array);
}

if(((prelim_midterm+_90_83)/4 >= selected_average) & (prelim_midterm+_90_83)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_90_83);
  alert(grade_array);
}

if(((prelim_midterm+_90_84)/4 >= selected_average) & (prelim_midterm+_90_84)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_90_84);
  alert(grade_array);
}

if(((prelim_midterm+_90_85)/4 >= selected_average) & (prelim_midterm+_90_85)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_90_85);
  alert(grade_array);
}

if(((prelim_midterm+_90_86)/4 >= selected_average) & (prelim_midterm+_90_86)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_90_86);
  alert(grade_array);
}

if(((prelim_midterm+_90_87)/4 >= selected_average) & (prelim_midterm+_90_87)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_90_87);
  alert(grade_array);
}

if(((prelim_midterm+_90_88)/4 >= selected_average) & (prelim_midterm+_90_88)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_90_88);
  alert(grade_array);
}

if(((prelim_midterm+_90_89)/4 >= selected_average) & (prelim_midterm+_90_89)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_90_89);
  alert(grade_array);
}

if(((prelim_midterm+_90_90)/4 >= selected_average) & (prelim_midterm+_90_90)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_90_90);
  alert(grade_array);
}

if(((prelim_midterm+_90_91)/4 >= selected_average) & (prelim_midterm+_90_91)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_90_91);
  alert(grade_array);
}

if(((prelim_midterm+_90_92)/4 >= selected_average) & (prelim_midterm+_90_92)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_90_92);
  alert(grade_array);
}

if(((prelim_midterm+_90_93)/4 >= selected_average) & (prelim_midterm+_90_93)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_90_93);
  alert(grade_array);
}

if(((prelim_midterm+_90_94)/4 >= selected_average) & (prelim_midterm+_90_94)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_90_94);
  alert(grade_array);
}

if(((prelim_midterm+_90_95)/4 >= selected_average) & (prelim_midterm+_90_95)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_90_95);
  alert(grade_array);
}

if(((prelim_midterm+_90_96)/4 >= selected_average) & (prelim_midterm+_90_96)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_90_96);
  alert(grade_array);
}

if(((prelim_midterm+_90_97)/4 >= selected_average) & (prelim_midterm+_90_97)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_90_97);
  alert(grade_array);
}

if(((prelim_midterm+_90_98)/4 >= selected_average) & (prelim_midterm+_90_98)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_90_98);
  alert(grade_array);
}

if(((prelim_midterm+_90_99)/4 >= selected_average) & (prelim_midterm+_90_99)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_90_99);
  alert(grade_array);
}

if(((prelim_midterm+_90_100)/4 >= selected_average) & (prelim_midterm+_90_100)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_90_100);
  alert(grade_array);
}


// 91

if(((prelim_midterm+_91_75)/4 >= selected_average) & (prelim_midterm+_91_75)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_91_75);
  alert(grade_array);
}

if(((prelim_midterm+_91_76)/4 >= selected_average) & (prelim_midterm+_91_76)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_91_76);
  alert(grade_array);
}

if(((prelim_midterm+_91_77)/4 >= selected_average) & (prelim_midterm+_91_77)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_91_77);
  alert(grade_array);
}

if(((prelim_midterm+_91_78)/4 >= selected_average) & (prelim_midterm+_91_78)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_91_78);
  alert(grade_array);
}

if(((prelim_midterm+_91_79)/4 >= selected_average) & (prelim_midterm+_91_79)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_91_79);
  alert(grade_array);
}

if(((prelim_midterm+_91_80)/4 >= selected_average) & (prelim_midterm+_91_80)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_91_80);
  alert(grade_array);
}

if(((prelim_midterm+_91_81)/4 >= selected_average) & (prelim_midterm+_91_81)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_91_81);
  alert(grade_array);
}

if(((prelim_midterm+_91_82)/4 >= selected_average) & (prelim_midterm+_91_82)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_91_82);
  alert(grade_array);
}

if(((prelim_midterm+_91_83)/4 >= selected_average) & (prelim_midterm+_91_83)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_91_83);
  alert(grade_array);
}

if(((prelim_midterm+_91_84)/4 >= selected_average) & (prelim_midterm+_91_84)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_91_84);
  alert(grade_array);
}

if(((prelim_midterm+_91_85)/4 >= selected_average) & (prelim_midterm+_91_85)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_91_85);
  alert(grade_array);
}

if(((prelim_midterm+_91_86)/4 >= selected_average) & (prelim_midterm+_91_86)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_91_86);
  alert(grade_array);
}

if(((prelim_midterm+_91_87)/4 >= selected_average) & (prelim_midterm+_91_87)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_91_87);
  alert(grade_array);
}

if(((prelim_midterm+_91_88)/4 >= selected_average) & (prelim_midterm+_91_88)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_91_88);
  alert(grade_array);
}

if(((prelim_midterm+_91_89)/4 >= selected_average) & (prelim_midterm+_91_89)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_91_89);
  alert(grade_array);
}

if(((prelim_midterm+_91_90)/4 >= selected_average) & (prelim_midterm+_91_90)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_91_90);
  alert(grade_array);
}

if(((prelim_midterm+_91_91)/4 >= selected_average) & (prelim_midterm+_91_91)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_91_91);
  alert(grade_array);
}

if(((prelim_midterm+_91_92)/4 >= selected_average) & (prelim_midterm+_91_92)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_91_92);
  alert(grade_array);
}

if(((prelim_midterm+_91_93)/4 >= selected_average) & (prelim_midterm+_91_93)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_91_93);
  alert(grade_array);
}

if(((prelim_midterm+_91_94)/4 >= selected_average) & (prelim_midterm+_91_94)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_91_94);
  alert(grade_array);
}

if(((prelim_midterm+_91_95)/4 >= selected_average) & (prelim_midterm+_91_95)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_91_95);
  alert(grade_array);
}

if(((prelim_midterm+_91_96)/4 >= selected_average) & (prelim_midterm+_91_96)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_91_96);
  alert(grade_array);
}

if(((prelim_midterm+_91_97)/4 >= selected_average) & (prelim_midterm+_91_97)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_91_97);
  alert(grade_array);
}

if(((prelim_midterm+_91_98)/4 >= selected_average) & (prelim_midterm+_91_98)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_91_98);
  alert(grade_array);
}

if(((prelim_midterm+_91_99)/4 >= selected_average) & (prelim_midterm+_91_99)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_91_99);
  alert(grade_array);
}

if(((prelim_midterm+_91_100)/4 >= selected_average) & (prelim_midterm+_91_100)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_91_100);
  alert(grade_array);
}


// 92

if(((prelim_midterm+_92_75)/4 >= selected_average) & (prelim_midterm+_92_75)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_92_75);
  alert(grade_array);
}

if(((prelim_midterm+_92_76)/4 >= selected_average) & (prelim_midterm+_92_76)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_92_76);
  alert(grade_array);
}

if(((prelim_midterm+_92_77)/4 >= selected_average) & (prelim_midterm+_92_77)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_92_77);
  alert(grade_array);
}

if(((prelim_midterm+_92_78)/4 >= selected_average) & (prelim_midterm+_92_78)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_92_78);
  alert(grade_array);
}

if(((prelim_midterm+_92_79)/4 >= selected_average) & (prelim_midterm+_92_79)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_92_79);
  alert(grade_array);
}

if(((prelim_midterm+_92_80)/4 >= selected_average) & (prelim_midterm+_92_80)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_92_80);
  alert(grade_array);
}

if(((prelim_midterm+_92_81)/4 >= selected_average) & (prelim_midterm+_92_81)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_92_81);
  alert(grade_array);
}

if(((prelim_midterm+_92_82)/4 >= selected_average) & (prelim_midterm+_92_82)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_92_82);
  alert(grade_array);
}

if(((prelim_midterm+_92_83)/4 >= selected_average) & (prelim_midterm+_92_83)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_92_83);
  alert(grade_array);
}

if(((prelim_midterm+_92_84)/4 >= selected_average) & (prelim_midterm+_92_84)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_92_84);
  alert(grade_array);
}

if(((prelim_midterm+_92_85)/4 >= selected_average) & (prelim_midterm+_92_85)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_92_85);
  alert(grade_array);
}

if(((prelim_midterm+_92_86)/4 >= selected_average) & (prelim_midterm+_92_86)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_92_86);
  alert(grade_array);
}

if(((prelim_midterm+_92_87)/4 >= selected_average) & (prelim_midterm+_92_87)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_92_87);
  alert(grade_array);
}

if(((prelim_midterm+_92_88)/4 >= selected_average) & (prelim_midterm+_92_88)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_92_88);
  alert(grade_array);
}

if(((prelim_midterm+_92_89)/4 >= selected_average) & (prelim_midterm+_92_89)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_92_89);
  alert(grade_array);
}

if(((prelim_midterm+_92_90)/4 >= selected_average) & (prelim_midterm+_92_90)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_92_90);
  alert(grade_array);
}

if(((prelim_midterm+_92_91)/4 >= selected_average) & (prelim_midterm+_92_91)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_92_91);
  alert(grade_array);
}

if(((prelim_midterm+_92_92)/4 >= selected_average) & (prelim_midterm+_92_92)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_92_92);
  alert(grade_array);
}

if(((prelim_midterm+_92_93)/4 >= selected_average) & (prelim_midterm+_92_93)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_92_93);
  alert(grade_array);
}

if(((prelim_midterm+_92_94)/4 >= selected_average) & (prelim_midterm+_92_94)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_92_94);
  alert(grade_array);
}

if(((prelim_midterm+_92_95)/4 >= selected_average) & (prelim_midterm+_92_95)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_92_95);
  alert(grade_array);
}

if(((prelim_midterm+_92_96)/4 >= selected_average) & (prelim_midterm+_92_96)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_92_96);
  alert(grade_array);
}

if(((prelim_midterm+_92_97)/4 >= selected_average) & (prelim_midterm+_92_97)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_92_97);
  alert(grade_array);
}

if(((prelim_midterm+_92_98)/4 >= selected_average) & (prelim_midterm+_92_98)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_92_98);
  alert(grade_array);
}

if(((prelim_midterm+_92_99)/4 >= selected_average) & (prelim_midterm+_92_99)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_92_99);
  alert(grade_array);
}

if(((prelim_midterm+_92_100)/4 >= selected_average) & (prelim_midterm+_92_100)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_92_100);
  alert(grade_array);
}


// 93

if(((prelim_midterm+_93_75)/4 >= selected_average) & (prelim_midterm+_93_75)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_93_75);
  alert(grade_array);
}

if(((prelim_midterm+_93_76)/4 >= selected_average) & (prelim_midterm+_93_76)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_93_76);
  alert(grade_array);
}

if(((prelim_midterm+_93_77)/4 >= selected_average) & (prelim_midterm+_93_77)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_93_77);
  alert(grade_array);
}

if(((prelim_midterm+_93_78)/4 >= selected_average) & (prelim_midterm+_93_78)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_93_78);
  alert(grade_array);
}

if(((prelim_midterm+_93_79)/4 >= selected_average) & (prelim_midterm+_93_79)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_93_79);
  alert(grade_array);
}

if(((prelim_midterm+_93_80)/4 >= selected_average) & (prelim_midterm+_93_80)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_93_80);
  alert(grade_array);
}

if(((prelim_midterm+_93_81)/4 >= selected_average) & (prelim_midterm+_93_81)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_93_81);
  alert(grade_array);
}

if(((prelim_midterm+_93_82)/4 >= selected_average) & (prelim_midterm+_93_82)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_93_82);
  alert(grade_array);
}

if(((prelim_midterm+_93_83)/4 >= selected_average) & (prelim_midterm+_93_83)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_93_83);
  alert(grade_array);
}

if(((prelim_midterm+_93_84)/4 >= selected_average) & (prelim_midterm+_93_84)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_93_84);
  alert(grade_array);
}

if(((prelim_midterm+_93_85)/4 >= selected_average) & (prelim_midterm+_93_85)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_93_85);
  alert(grade_array);
}

if(((prelim_midterm+_93_86)/4 >= selected_average) & (prelim_midterm+_93_86)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_93_86);
  alert(grade_array);
}

if(((prelim_midterm+_93_87)/4 >= selected_average) & (prelim_midterm+_93_87)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_93_87);
  alert(grade_array);
}

if(((prelim_midterm+_93_88)/4 >= selected_average) & (prelim_midterm+_93_88)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_93_88);
  alert(grade_array);
}

if(((prelim_midterm+_93_89)/4 >= selected_average) & (prelim_midterm+_93_89)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_93_89);
  alert(grade_array);
}

if(((prelim_midterm+_93_90)/4 >= selected_average) & (prelim_midterm+_93_90)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_93_90);
  alert(grade_array);
}

if(((prelim_midterm+_93_91)/4 >= selected_average) & (prelim_midterm+_93_91)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_93_91);
  alert(grade_array);
}

if(((prelim_midterm+_93_92)/4 >= selected_average) & (prelim_midterm+_93_92)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_93_92);
  alert(grade_array);
}

if(((prelim_midterm+_93_93)/4 >= selected_average) & (prelim_midterm+_93_93)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_93_93);
  alert(grade_array);
}

if(((prelim_midterm+_93_94)/4 >= selected_average) & (prelim_midterm+_93_94)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_93_94);
  alert(grade_array);
}

if(((prelim_midterm+_93_95)/4 >= selected_average) & (prelim_midterm+_93_95)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_93_95);
  alert(grade_array);
}

if(((prelim_midterm+_93_96)/4 >= selected_average) & (prelim_midterm+_93_96)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_93_96);
  alert(grade_array);
}

if(((prelim_midterm+_93_97)/4 >= selected_average) & (prelim_midterm+_93_97)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_93_97);
  alert(grade_array);
}

if(((prelim_midterm+_93_98)/4 >= selected_average) & (prelim_midterm+_93_98)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_93_98);
  alert(grade_array);
}

if(((prelim_midterm+_93_99)/4 >= selected_average) & (prelim_midterm+_93_99)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_93_99);
  alert(grade_array);
}

if(((prelim_midterm+_93_100)/4 >= selected_average) & (prelim_midterm+_93_100)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_93_100);
  alert(grade_array);
}


// 94

if(((prelim_midterm+_94_75)/4 >= selected_average) & (prelim_midterm+_94_75)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_94_75);
  alert(grade_array);
}

if(((prelim_midterm+_94_76)/4 >= selected_average) & (prelim_midterm+_94_76)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_94_76);
  alert(grade_array);
}

if(((prelim_midterm+_94_77)/4 >= selected_average) & (prelim_midterm+_94_77)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_94_77);
  alert(grade_array);
}

if(((prelim_midterm+_94_78)/4 >= selected_average) & (prelim_midterm+_94_78)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_94_78);
  alert(grade_array);
}

if(((prelim_midterm+_94_79)/4 >= selected_average) & (prelim_midterm+_94_79)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_94_79);
  alert(grade_array);
}

if(((prelim_midterm+_94_80)/4 >= selected_average) & (prelim_midterm+_94_80)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_94_80);
  alert(grade_array);
}

if(((prelim_midterm+_94_81)/4 >= selected_average) & (prelim_midterm+_94_81)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_94_81);
  alert(grade_array);
}

if(((prelim_midterm+_94_82)/4 >= selected_average) & (prelim_midterm+_94_82)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_94_82);
  alert(grade_array);
}

if(((prelim_midterm+_94_83)/4 >= selected_average) & (prelim_midterm+_94_83)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_94_83);
  alert(grade_array);
}

if(((prelim_midterm+_94_84)/4 >= selected_average) & (prelim_midterm+_94_84)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_94_84);
  alert(grade_array);
}

if(((prelim_midterm+_94_85)/4 >= selected_average) & (prelim_midterm+_94_85)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_94_85);
  alert(grade_array);
}

if(((prelim_midterm+_94_86)/4 >= selected_average) & (prelim_midterm+_94_86)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_94_86);
  alert(grade_array);
}

if(((prelim_midterm+_94_87)/4 >= selected_average) & (prelim_midterm+_94_87)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_94_87);
  alert(grade_array);
}

if(((prelim_midterm+_94_88)/4 >= selected_average) & (prelim_midterm+_94_88)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_94_88);
  alert(grade_array);
}

if(((prelim_midterm+_94_89)/4 >= selected_average) & (prelim_midterm+_94_89)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_94_89);
  alert(grade_array);
}

if(((prelim_midterm+_94_90)/4 >= selected_average) & (prelim_midterm+_94_90)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_94_90);
  alert(grade_array);
}

if(((prelim_midterm+_94_91)/4 >= selected_average) & (prelim_midterm+_94_91)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_94_91);
  alert(grade_array);
}

if(((prelim_midterm+_94_92)/4 >= selected_average) & (prelim_midterm+_94_92)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_94_92);
  alert(grade_array);
}

if(((prelim_midterm+_94_93)/4 >= selected_average) & (prelim_midterm+_94_93)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_94_93);
  alert(grade_array);
}

if(((prelim_midterm+_94_94)/4 >= selected_average) & (prelim_midterm+_94_94)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_94_94);
  alert(grade_array);
}

if(((prelim_midterm+_94_95)/4 >= selected_average) & (prelim_midterm+_94_95)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_94_95);
  alert(grade_array);
}

if(((prelim_midterm+_94_96)/4 >= selected_average) & (prelim_midterm+_94_96)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_94_96);
  alert(grade_array);
}

if(((prelim_midterm+_94_97)/4 >= selected_average) & (prelim_midterm+_94_97)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_94_97);
  alert(grade_array);
}

if(((prelim_midterm+_94_98)/4 >= selected_average) & (prelim_midterm+_94_98)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_94_98);
  alert(grade_array);
}

if(((prelim_midterm+_94_99)/4 >= selected_average) & (prelim_midterm+_94_99)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_94_99);
  alert(grade_array);
}

if(((prelim_midterm+_94_100)/4 >= selected_average) & (prelim_midterm+_94_100)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_94_100);
  alert(grade_array);
}


// 95

if(((prelim_midterm+_95_75)/4 >= selected_average) & (prelim_midterm+_95_75)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_95_75);
  alert(grade_array);
}

if(((prelim_midterm+_95_76)/4 >= selected_average) & (prelim_midterm+_95_76)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_95_76);
  alert(grade_array);
}

if(((prelim_midterm+_95_77)/4 >= selected_average) & (prelim_midterm+_95_77)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_95_77);
  alert(grade_array);
}

if(((prelim_midterm+_95_78)/4 >= selected_average) & (prelim_midterm+_95_78)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_95_78);
  alert(grade_array);
}

if(((prelim_midterm+_95_79)/4 >= selected_average) & (prelim_midterm+_95_79)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_95_79);
  alert(grade_array);
}

if(((prelim_midterm+_95_80)/4 >= selected_average) & (prelim_midterm+_95_80)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_95_80);
  alert(grade_array);
}

if(((prelim_midterm+_95_81)/4 >= selected_average) & (prelim_midterm+_95_81)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_95_81);
  alert(grade_array);
}

if(((prelim_midterm+_95_82)/4 >= selected_average) & (prelim_midterm+_95_82)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_95_82);
  alert(grade_array);
}

if(((prelim_midterm+_95_83)/4 >= selected_average) & (prelim_midterm+_95_83)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_95_83);
  alert(grade_array);
}

if(((prelim_midterm+_95_84)/4 >= selected_average) & (prelim_midterm+_95_84)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_95_84);
  alert(grade_array);
}

if(((prelim_midterm+_95_85)/4 >= selected_average) & (prelim_midterm+_95_85)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_95_85);
  alert(grade_array);
}

if(((prelim_midterm+_95_86)/4 >= selected_average) & (prelim_midterm+_95_86)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_95_86);
  alert(grade_array);
}

if(((prelim_midterm+_95_87)/4 >= selected_average) & (prelim_midterm+_95_87)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_95_87);
  alert(grade_array);
}

if(((prelim_midterm+_95_88)/4 >= selected_average) & (prelim_midterm+_95_88)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_95_88);
  alert(grade_array);
}

if(((prelim_midterm+_95_89)/4 >= selected_average) & (prelim_midterm+_95_89)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_95_89);
  alert(grade_array);
}

if(((prelim_midterm+_95_90)/4 >= selected_average) & (prelim_midterm+_95_90)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_95_90);
  alert(grade_array);
}

if(((prelim_midterm+_95_91)/4 >= selected_average) & (prelim_midterm+_95_91)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_95_91);
  alert(grade_array);
}

if(((prelim_midterm+_95_92)/4 >= selected_average) & (prelim_midterm+_95_92)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_95_92);
  alert(grade_array);
}

if(((prelim_midterm+_95_93)/4 >= selected_average) & (prelim_midterm+_95_93)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_95_93);
  alert(grade_array);
}

if(((prelim_midterm+_95_94)/4 >= selected_average) & (prelim_midterm+_95_94)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_95_94);
  alert(grade_array);
}

if(((prelim_midterm+_95_95)/4 >= selected_average) & (prelim_midterm+_95_95)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_95_95);
  alert(grade_array);
}

if(((prelim_midterm+_95_96)/4 >= selected_average) & (prelim_midterm+_95_96)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_95_96);
  alert(grade_array);
}

if(((prelim_midterm+_95_97)/4 >= selected_average) & (prelim_midterm+_95_97)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_95_97);
  alert(grade_array);
}

if(((prelim_midterm+_95_98)/4 >= selected_average) & (prelim_midterm+_95_98)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_95_98);
  alert(grade_array);
}

if(((prelim_midterm+_95_99)/4 >= selected_average) & (prelim_midterm+_95_99)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_95_99);
  alert(grade_array);
}

if(((prelim_midterm+_95_100)/4 >= selected_average) & (prelim_midterm+_95_100)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_95_100);
  alert(grade_array);
}


// 96

if(((prelim_midterm+_96_75)/4 >= selected_average) & (prelim_midterm+_96_75)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_96_75);
  alert(grade_array);
}

if(((prelim_midterm+_96_76)/4 >= selected_average) & (prelim_midterm+_96_76)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_96_76);
  alert(grade_array);
}

if(((prelim_midterm+_96_77)/4 >= selected_average) & (prelim_midterm+_96_77)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_96_77);
  alert(grade_array);
}

if(((prelim_midterm+_96_78)/4 >= selected_average) & (prelim_midterm+_96_78)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_96_78);
  alert(grade_array);
}

if(((prelim_midterm+_96_79)/4 >= selected_average) & (prelim_midterm+_96_79)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_96_79);
  alert(grade_array);
}

if(((prelim_midterm+_96_80)/4 >= selected_average) & (prelim_midterm+_96_80)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_96_80);
  alert(grade_array);
}

if(((prelim_midterm+_96_81)/4 >= selected_average) & (prelim_midterm+_96_81)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_96_81);
  alert(grade_array);
}

if(((prelim_midterm+_96_82)/4 >= selected_average) & (prelim_midterm+_96_82)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_96_82);
  alert(grade_array);
}

if(((prelim_midterm+_96_83)/4 >= selected_average) & (prelim_midterm+_96_83)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_96_83);
  alert(grade_array);
}

if(((prelim_midterm+_96_84)/4 >= selected_average) & (prelim_midterm+_96_84)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_96_84);
  alert(grade_array);
}

if(((prelim_midterm+_96_85)/4 >= selected_average) & (prelim_midterm+_96_85)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_96_85);
  alert(grade_array);
}

if(((prelim_midterm+_96_86)/4 >= selected_average) & (prelim_midterm+_96_86)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_96_86);
  alert(grade_array);
}

if(((prelim_midterm+_96_87)/4 >= selected_average) & (prelim_midterm+_96_87)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_96_87);
  alert(grade_array);
}

if(((prelim_midterm+_96_88)/4 >= selected_average) & (prelim_midterm+_96_88)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_96_88);
  alert(grade_array);
}

if(((prelim_midterm+_96_89)/4 >= selected_average) & (prelim_midterm+_96_89)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_96_89);
  alert(grade_array);
}

if(((prelim_midterm+_96_90)/4 >= selected_average) & (prelim_midterm+_96_90)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_96_90);
  alert(grade_array);
}

if(((prelim_midterm+_96_91)/4 >= selected_average) & (prelim_midterm+_96_91)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_96_91);
  alert(grade_array);
}

if(((prelim_midterm+_96_92)/4 >= selected_average) & (prelim_midterm+_96_92)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_96_92);
  alert(grade_array);
}

if(((prelim_midterm+_96_93)/4 >= selected_average) & (prelim_midterm+_96_93)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_96_93);
  alert(grade_array);
}

if(((prelim_midterm+_96_94)/4 >= selected_average) & (prelim_midterm+_96_94)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_96_94);
  alert(grade_array);
}

if(((prelim_midterm+_96_95)/4 >= selected_average) & (prelim_midterm+_96_95)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_96_95);
  alert(grade_array);
}

if(((prelim_midterm+_96_96)/4 >= selected_average) & (prelim_midterm+_96_96)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_96_96);
  alert(grade_array);
}

if(((prelim_midterm+_96_97)/4 >= selected_average) & (prelim_midterm+_96_97)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_96_97);
  alert(grade_array);
}

if(((prelim_midterm+_96_98)/4 >= selected_average) & (prelim_midterm+_96_98)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_96_98);
  alert(grade_array);
}

if(((prelim_midterm+_96_99)/4 >= selected_average) & (prelim_midterm+_96_99)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_96_99);
  alert(grade_array);
}

if(((prelim_midterm+_96_100)/4 >= selected_average) & (prelim_midterm+_96_100)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_96_100);
  alert(grade_array);
}


// 97

if(((prelim_midterm+_97_75)/4 >= selected_average) & (prelim_midterm+_97_75)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_97_75);
  alert(grade_array);
}

if(((prelim_midterm+_97_76)/4 >= selected_average) & (prelim_midterm+_97_76)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_97_76);
  alert(grade_array);
}

if(((prelim_midterm+_97_77)/4 >= selected_average) & (prelim_midterm+_97_77)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_97_77);
  alert(grade_array);
}

if(((prelim_midterm+_97_78)/4 >= selected_average) & (prelim_midterm+_97_78)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_97_78);
  alert(grade_array);
}

if(((prelim_midterm+_97_79)/4 >= selected_average) & (prelim_midterm+_97_79)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_97_79);
  alert(grade_array);
}

if(((prelim_midterm+_97_80)/4 >= selected_average) & (prelim_midterm+_97_80)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_97_80);
  alert(grade_array);
}

if(((prelim_midterm+_97_81)/4 >= selected_average) & (prelim_midterm+_97_81)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_97_81);
  alert(grade_array);
}

if(((prelim_midterm+_97_82)/4 >= selected_average) & (prelim_midterm+_97_82)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_97_82);
  alert(grade_array);
}

if(((prelim_midterm+_97_83)/4 >= selected_average) & (prelim_midterm+_97_83)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_97_83);
  alert(grade_array);
}

if(((prelim_midterm+_97_84)/4 >= selected_average) & (prelim_midterm+_97_84)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_97_84);
  alert(grade_array);
}

if(((prelim_midterm+_97_85)/4 >= selected_average) & (prelim_midterm+_97_85)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_97_85);
  alert(grade_array);
}

if(((prelim_midterm+_97_86)/4 >= selected_average) & (prelim_midterm+_97_86)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_97_86);
  alert(grade_array);
}

if(((prelim_midterm+_97_87)/4 >= selected_average) & (prelim_midterm+_97_87)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_97_87);
  alert(grade_array);
}

if(((prelim_midterm+_97_88)/4 >= selected_average) & (prelim_midterm+_97_88)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_97_88);
  alert(grade_array);
}

if(((prelim_midterm+_97_89)/4 >= selected_average) & (prelim_midterm+_97_89)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_97_89);
  alert(grade_array);
}

if(((prelim_midterm+_97_90)/4 >= selected_average) & (prelim_midterm+_97_90)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_97_90);
  alert(grade_array);
}

if(((prelim_midterm+_97_91)/4 >= selected_average) & (prelim_midterm+_97_91)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_97_91);
  alert(grade_array);
}

if(((prelim_midterm+_97_92)/4 >= selected_average) & (prelim_midterm+_97_92)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_97_92);
  alert(grade_array);
}

if(((prelim_midterm+_97_93)/4 >= selected_average) & (prelim_midterm+_97_93)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_97_93);
  alert(grade_array);
}

if(((prelim_midterm+_97_94)/4 >= selected_average) & (prelim_midterm+_97_94)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_97_94);
  alert(grade_array);
}

if(((prelim_midterm+_97_95)/4 >= selected_average) & (prelim_midterm+_97_95)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_97_95);
  alert(grade_array);
}

if(((prelim_midterm+_97_96)/4 >= selected_average) & (prelim_midterm+_97_96)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_97_96);
  alert(grade_array);
}

if(((prelim_midterm+_97_97)/4 >= selected_average) & (prelim_midterm+_97_97)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_97_97);
  alert(grade_array);
}

if(((prelim_midterm+_97_98)/4 >= selected_average) & (prelim_midterm+_97_98)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_97_98);
  alert(grade_array);
}

if(((prelim_midterm+_97_99)/4 >= selected_average) & (prelim_midterm+_97_99)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_97_99);
  alert(grade_array);
}

if(((prelim_midterm+_97_100)/4 >= selected_average) & (prelim_midterm+_97_100)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_97_100);
  alert(grade_array);
}


// 98

if(((prelim_midterm+_98_75)/4 >= selected_average) & (prelim_midterm+_98_75)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_98_75);
  alert(grade_array);
}

if(((prelim_midterm+_98_76)/4 >= selected_average) & (prelim_midterm+_98_76)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_98_76);
  alert(grade_array);
}

if(((prelim_midterm+_98_77)/4 >= selected_average) & (prelim_midterm+_98_77)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_98_77);
  alert(grade_array);
}

if(((prelim_midterm+_98_78)/4 >= selected_average) & (prelim_midterm+_98_78)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_98_78);
  alert(grade_array);
}

if(((prelim_midterm+_98_79)/4 >= selected_average) & (prelim_midterm+_98_79)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_98_79);
  alert(grade_array);
}

if(((prelim_midterm+_98_80)/4 >= selected_average) & (prelim_midterm+_98_80)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_98_80);
  alert(grade_array);
}

if(((prelim_midterm+_98_81)/4 >= selected_average) & (prelim_midterm+_98_81)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_98_81);
  alert(grade_array);
}

if(((prelim_midterm+_98_82)/4 >= selected_average) & (prelim_midterm+_98_82)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_98_82);
  alert(grade_array);
}

if(((prelim_midterm+_98_83)/4 >= selected_average) & (prelim_midterm+_98_83)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_98_83);
  alert(grade_array);
}

if(((prelim_midterm+_98_84)/4 >= selected_average) & (prelim_midterm+_98_84)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_98_84);
  alert(grade_array);
}

if(((prelim_midterm+_98_85)/4 >= selected_average) & (prelim_midterm+_98_85)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_98_85);
  alert(grade_array);
}

if(((prelim_midterm+_98_86)/4 >= selected_average) & (prelim_midterm+_98_86)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_98_86);
  alert(grade_array);
}

if(((prelim_midterm+_98_87)/4 >= selected_average) & (prelim_midterm+_98_87)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_98_87);
  alert(grade_array);
}

if(((prelim_midterm+_98_88)/4 >= selected_average) & (prelim_midterm+_98_88)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_98_88);
  alert(grade_array);
}

if(((prelim_midterm+_98_89)/4 >= selected_average) & (prelim_midterm+_98_89)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_98_89);
  alert(grade_array);
}

if(((prelim_midterm+_98_90)/4 >= selected_average) & (prelim_midterm+_98_90)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_98_90);
  alert(grade_array);
}

if(((prelim_midterm+_98_91)/4 >= selected_average) & (prelim_midterm+_98_91)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_98_91);
  alert(grade_array);
}

if(((prelim_midterm+_98_92)/4 >= selected_average) & (prelim_midterm+_98_92)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_98_92);
  alert(grade_array);
}

if(((prelim_midterm+_98_93)/4 >= selected_average) & (prelim_midterm+_98_93)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_98_93);
  alert(grade_array);
}

if(((prelim_midterm+_98_94)/4 >= selected_average) & (prelim_midterm+_98_94)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_98_94);
  alert(grade_array);
}

if(((prelim_midterm+_98_95)/4 >= selected_average) & (prelim_midterm+_98_95)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_98_95);
  alert(grade_array);
}

if(((prelim_midterm+_98_96)/4 >= selected_average) & (prelim_midterm+_98_96)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_98_96);
  alert(grade_array);
}

if(((prelim_midterm+_98_97)/4 >= selected_average) & (prelim_midterm+_98_97)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_98_97);
  alert(grade_array);
}

if(((prelim_midterm+_98_98)/4 >= selected_average) & (prelim_midterm+_98_98)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_98_98);
  alert(grade_array);
}

if(((prelim_midterm+_98_99)/4 >= selected_average) & (prelim_midterm+_98_99)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_98_99);
  alert(grade_array);
}

if(((prelim_midterm+_98_100)/4 >= selected_average) & (prelim_midterm+_98_100)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_98_100);
  alert(grade_array);
}


// 99

if(((prelim_midterm+_99_75)/4 >= selected_average) & (prelim_midterm+_99_75)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_99_75);
  alert(grade_array);
}

if(((prelim_midterm+_99_76)/4 >= selected_average) & (prelim_midterm+_99_76)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_99_76);
  alert(grade_array);
}

if(((prelim_midterm+_99_77)/4 >= selected_average) & (prelim_midterm+_99_77)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_99_77);
  alert(grade_array);
}

if(((prelim_midterm+_99_78)/4 >= selected_average) & (prelim_midterm+_99_78)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_99_78);
  alert(grade_array);
}

if(((prelim_midterm+_99_79)/4 >= selected_average) & (prelim_midterm+_99_79)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_99_79);
  alert(grade_array);
}

if(((prelim_midterm+_99_80)/4 >= selected_average) & (prelim_midterm+_99_80)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_99_80);
  alert(grade_array);
}

if(((prelim_midterm+_99_81)/4 >= selected_average) & (prelim_midterm+_99_81)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_99_81);
  alert(grade_array);
}

if(((prelim_midterm+_99_82)/4 >= selected_average) & (prelim_midterm+_99_82)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_99_82);
  alert(grade_array);
}

if(((prelim_midterm+_99_83)/4 >= selected_average) & (prelim_midterm+_99_83)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_99_83);
  alert(grade_array);
}

if(((prelim_midterm+_99_84)/4 >= selected_average) & (prelim_midterm+_99_84)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_99_84);
  alert(grade_array);
}

if(((prelim_midterm+_99_85)/4 >= selected_average) & (prelim_midterm+_99_85)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_99_85);
  alert(grade_array);
}

if(((prelim_midterm+_99_86)/4 >= selected_average) & (prelim_midterm+_99_86)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_99_86);
  alert(grade_array);
}

if(((prelim_midterm+_99_87)/4 >= selected_average) & (prelim_midterm+_99_87)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_99_87);
  alert(grade_array);
}

if(((prelim_midterm+_99_88)/4 >= selected_average) & (prelim_midterm+_99_88)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_99_88);
  alert(grade_array);
}

if(((prelim_midterm+_99_89)/4 >= selected_average) & (prelim_midterm+_99_89)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_99_89);
  alert(grade_array);
}

if(((prelim_midterm+_99_90)/4 >= selected_average) & (prelim_midterm+_99_90)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_99_90);
  alert(grade_array);
}

if(((prelim_midterm+_99_91)/4 >= selected_average) & (prelim_midterm+_99_91)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_99_91);
  alert(grade_array);
}

if(((prelim_midterm+_99_92)/4 >= selected_average) & (prelim_midterm+_99_92)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_99_92);
  alert(grade_array);
}

if(((prelim_midterm+_99_93)/4 >= selected_average) & (prelim_midterm+_99_93)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_99_93);
  alert(grade_array);
}

if(((prelim_midterm+_99_94)/4 >= selected_average) & (prelim_midterm+_99_94)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_99_94);
  alert(grade_array);
}

if(((prelim_midterm+_99_95)/4 >= selected_average) & (prelim_midterm+_99_95)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_99_95);
  alert(grade_array);
}

if(((prelim_midterm+_99_96)/4 >= selected_average) & (prelim_midterm+_99_96)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_99_96);
  alert(grade_array);
}

if(((prelim_midterm+_99_97)/4 >= selected_average) & (prelim_midterm+_99_97)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_99_97);
  alert(grade_array);
}

if(((prelim_midterm+_99_98)/4 >= selected_average) & (prelim_midterm+_99_98)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_99_98);
  alert(grade_array);
}

if(((prelim_midterm+_99_99)/4 >= selected_average) & (prelim_midterm+_99_99)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_99_99);
  alert(grade_array);
}

if(((prelim_midterm+_99_100)/4 >= selected_average) & (prelim_midterm+_99_100)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_98_85);
  alert(grade_array);
}


// 100

if(((prelim_midterm+_100_75)/4 >= selected_average) & (prelim_midterm+_100_75)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_100_75);
  alert(grade_array);
}

if(((prelim_midterm+_100_76)/4 >= selected_average) & (prelim_midterm+_100_76)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_100_76);
  alert(grade_array);
}

if(((prelim_midterm+_100_77)/4 >= selected_average) & (prelim_midterm+_100_77)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_100_77);
  alert(grade_array);
}

if(((prelim_midterm+_100_78)/4 >= selected_average) & (prelim_midterm+_100_78)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_100_78);
  alert(grade_array);
}

if(((prelim_midterm+_100_79)/4 >= selected_average) & (prelim_midterm+_100_79)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_100_79);
  alert(grade_array);
}

if(((prelim_midterm+_100_80)/4 >= selected_average) & (prelim_midterm+_100_80)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_100_80);
  alert(grade_array);
}

if(((prelim_midterm+_100_81)/4 >= selected_average) & (prelim_midterm+_100_81)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_100_81);
  alert(grade_array);
}

if(((prelim_midterm+_100_82)/4 >= selected_average) & (prelim_midterm+_100_82)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_100_82);
  alert(grade_array);
}

if(((prelim_midterm+_100_83)/4 >= selected_average) & (prelim_midterm+_100_83)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_100_83);
  alert(grade_array);
}

if(((prelim_midterm+_100_84)/4 >= selected_average) & (prelim_midterm+_100_84)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_100_84);
  alert(grade_array);
}

if(((prelim_midterm+_100_85)/4 >= selected_average) & (prelim_midterm+_100_85)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_100_85);
  alert(grade_array);
}

if(((prelim_midterm+_100_86)/4 >= selected_average) & (prelim_midterm+_100_86)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_100_86);
  alert(grade_array);
}

if(((prelim_midterm+_100_87)/4 >= selected_average) & (prelim_midterm+_100_87)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_100_87);
  alert(grade_array);
}

if(((prelim_midterm+_100_88)/4 >= selected_average) & (prelim_midterm+_100_88)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_100_88);
  alert(grade_array);
}

if(((prelim_midterm+_100_89)/4 >= selected_average) & (prelim_midterm+_100_89)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_100_89);
  alert(grade_array);
}

if(((prelim_midterm+_100_90)/4 >= selected_average) & (prelim_midterm+_100_90)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_100_90);
  alert(grade_array);
}

if(((prelim_midterm+_100_91)/4 >= selected_average) & (prelim_midterm+_100_91)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_100_91);
  alert(grade_array);
}

if(((prelim_midterm+_100_92)/4 >= selected_average) & (prelim_midterm+_100_92)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_100_92);
  alert(grade_array);
}

if(((prelim_midterm+_100_93)/4 >= selected_average) & (prelim_midterm+_100_93)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_100_93);
  alert(grade_array);
}

if(((prelim_midterm+_100_94)/4 >= selected_average) & (prelim_midterm+_100_94)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_100_94);
  alert(grade_array);
}

if(((prelim_midterm+_100_95)/4 >= selected_average) & (prelim_midterm+_100_95)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_100_95);
  alert(grade_array);
}

if(((prelim_midterm+_100_96)/4 >= selected_average) & (prelim_midterm+_100_96)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_100_96);
  alert(grade_array);
}

if(((prelim_midterm+_100_97)/4 >= selected_average) & (prelim_midterm+_100_97)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_100_97);
  alert(grade_array);
}

if(((prelim_midterm+_100_98)/4 >= selected_average) & (prelim_midterm+_100_98)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_100_98);
  alert(grade_array);
}

if(((prelim_midterm+_100_99)/4 >= selected_average) & (prelim_midterm+_100_99)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_100_99);
  alert(grade_array);
}

if(((prelim_midterm+_100_100)/4 >= selected_average) & (prelim_midterm+_100_100)/4 <= parseInt(selected_average) + 1){
  grade_array.push(_100_100);
  alert(grade_array);
}


  // for(a=75;a<=100;a++){
  //   for(b=75;b<=100;b++){
  //   // console.log(a+"="+b+"="+(a+b));
  //    prefinal.innerHTML = a;
  //   final.innerHTML = b;
  //   new_prefinal = parseFloat(prefinal.innerHTML);
  //   new_final = parseFloat(final.innerHTML);
  //   prefinal_final = new_prefinal + new_final;

  //   overall_average = (prelim_midterm + prefinal_final)/4;
  //   // if(selected_average == overall_average ){
  //     console.log(new_prefinal+"+"+new_final)
  //     // console.log("prefinal="+new_prefinal+"final="+new_final+"overall="+overall_average)
  //   // }
  //   // alert()

  // //   var new_prefinal = parseFloat(prefinal.innerHTML);
  // // var new_final = parseFloat(final.innerHTML);
  //   // console.log("a="+new_prefinal+"b="+new_final+"a&b="+(new_prefinal+new_final));
  //   }
  // }

  // var new_prefinal = parseFloat(prefinal.innerHTML);
  // var new_final = parseFloat(final.innerHTML);
  // // console.log(new_prefinal+"="+new_final+"="+(new_prefinal+new_final))

  // var prefinal_final = new_prefinal + new_final;
// alert(prefinal.innerHTML + "=" + final.innerHTML)
    // console.log("a="+new_prefinal+"b="+new_final+"a&b="+(new_prefinal+new_final));




//  var average = (prelim_midterm+prefinal_final)/4;
// alert("Average=" + average + "Prefinal=" + new_prefinal + "Final=" + new_prefinal);
      

        // window.location.href="?ave="+selected_average+"&_p="+new_prefinal+"&_f="+new_final;
        // alert("Average=" + average + "Prefinal=" + new_prefinal + "Final=" + new_prefinal);


  }
}

// if(prelim.innerHTML != 0 & midterm.innerHTML != 0 & prefinal.innerHTML != 0 & final.innerHTML  == 0){
//   alert("sabe may sero");
// }

// alert(prelim.innerHTML+"|"+midterm.innerHTML+"|"+prefinal.innerHTML+"|"+final.innerHTML);

</script>
<!-- <a href="logout.php">Log Out</a> -->

<?php
include("../../bins/footer_non_fixed.php");
?>