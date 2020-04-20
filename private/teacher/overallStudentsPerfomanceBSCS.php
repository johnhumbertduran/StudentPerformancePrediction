<?php


$bscs_counter_5 = 0;
$bscs_counter_3 = 0;
$bscs_counter_2_75 = 0;
$bscs_counter_2_5 = 0;
$bscs_counter_2_25 = 0;
$bscs_counter_2 = 0;
$bscs_counter_1_75 = 0;
$bscs_counter_1_5 = 0;
$bscs_counter_1_25 = 0;
$bscs_counter_1 = 0;
$bscs_counter_passed = 0;
$bscs_counter_failed = 0;

$course = "BSCS";

$prelim_bscs_qry = mysqli_query($connections, "SELECT * FROM prelim1 WHERE course='$course' ");
$midterm_bscs_qry = mysqli_query($connections, "SELECT * FROM midterm1 WHERE course='$course' ");
$prefinal_bscs_qry = mysqli_query($connections, "SELECT * FROM prefinal1 WHERE course='$course' ");
$final_bscs_qry = mysqli_query($connections, "SELECT * FROM final1 WHERE course='$course' ");
$students_bscs_qry = mysqli_query($connections, "SELECT * FROM _user_tbl_ WHERE account_type='2' AND course='$course' ");

while($bscs_row_prelim = mysqli_fetch_assoc($prelim_bscs_qry)){
  
  
  $bscs_row_midterm = mysqli_fetch_assoc($midterm_bscs_qry);
  $bscs_row_prefinal = mysqli_fetch_assoc($prefinal_bscs_qry);
  $bscs_row_final = mysqli_fetch_assoc($final_bscs_qry);
 
  $bscs_row_students = mysqli_fetch_assoc($students_bscs_qry);
  $bscs_student_no = $bscs_row_students["student_no"];
  $bscs_lastname = $bscs_row_students["lastname"];
  $bscs_firstname = $bscs_row_students["firstname"];
  $bscs_middlename = $bscs_row_students["middlename"];
  $bscs_student_name = $bscs_firstname . " " . $bscs_middlename[0] . ". " . $bscs_lastname;
  
 
 $bscs_prelim_output_1 = $bscs_row_prelim['prelim_output_1'];
 $bscs_prelim_output_2 = $bscs_row_prelim['prelim_output_2'];
 $bscs_prelim_performance_1 = $bscs_row_prelim['prelim_performance_1'];
 $bscs_prelim_performance_2 = $bscs_row_prelim['prelim_performance_2'];
 $bscs_prelim_written_test = $bscs_row_prelim['prelim_written_test'];
 
 
 
 if($bscs_prelim_output_1 == 0 && $bscs_prelim_output_2 == 0 &&
    $bscs_prelim_performance_1 == 0 && $bscs_prelim_performance_1 == 0 &&
    $bscs_prelim_written_test == 0){
   
     $bscs_prelim_grade = 0;
 
 }else{
 
 $bscs_prelim_output_total_score = $bscs_prelim_output_1 + $bscs_prelim_output_2;
 $bscs_prelim_performance_total_score = $bscs_prelim_performance_1 + $bscs_prelim_performance_2;
 
 $bscs_prelim_output_base = $bscs_prelim_output_total_score / 40 * 40 + 60;
 $bscs_prelim_performance_base = $bscs_prelim_performance_total_score / 40 * 40 + 60;
 $bscs_prelim_written_test_base =  $bscs_prelim_written_test / 70 * 40 + 60;
 
 $bscs_prelim_output_weight = $bscs_prelim_output_base * 0.40;
 $bscs_prelim_performance_weight = $bscs_prelim_performance_base * 0.40;
 $bscs_prelim_written_test_weight = $bscs_prelim_written_test_base * 0.20;
 
 $bscs_prelim_grade = $bscs_prelim_output_weight + $bscs_prelim_performance_weight + $bscs_prelim_written_test_weight;
 
 $bscs_prelim_grade = number_format((float)$bscs_prelim_grade,2,".","");
 
 }
 
 $bscs_midterm_output_1 = $bscs_row_midterm["midterm_output_1"];
 $bscs_midterm_output_2 = $bscs_row_midterm["midterm_output_2"];
 $bscs_midterm_performance_1 = $bscs_row_midterm["midterm_performance_1"];
 $bscs_midterm_performance_2 = $bscs_row_midterm["midterm_performance_2"];
 $bscs_midterm_written_test = $bscs_row_midterm["midterm_written_test"];
 
 if($bscs_midterm_output_1 == 0 && $bscs_midterm_output_2 == 0 &&
    $bscs_midterm_performance_1 == 0 && $bscs_midterm_performance_1 == 0 &&
    $bscs_midterm_written_test == 0){
   
     $bscs_midterm_grade = 0;
 
 }else{
 
 $bscs_midterm_output_total_score = $bscs_midterm_output_1 + $bscs_midterm_output_2;
 $bscs_midterm_output_base = $bscs_midterm_output_total_score / 40 * 40 + 60;
 $bscs_midterm_output_weight = $bscs_midterm_output_base * 0.40;
 
 
 $bscs_midterm_performance_total_score = $bscs_midterm_performance_1 + $bscs_midterm_performance_2;
 $bscs_midterm_performance_base = $bscs_midterm_performance_total_score / 40 * 40 + 60;
 $bscs_midterm_written_test_base = $bscs_midterm_written_test / 70 * 40 + 60;
 $bscs_midterm_performance_weight = $bscs_midterm_performance_base * 0.40;
 $bscs_midterm_written_test_weight = $bscs_midterm_written_test_base * 0.20;
 $bscs_midterm_2nd_quarter = $bscs_midterm_output_weight + $bscs_midterm_performance_weight + $bscs_midterm_written_test_weight;
 
 $bscs_midterm_output_weight = $bscs_midterm_output_base * 0.40;
 $bscs_midterm_performance_weight = $bscs_midterm_performance_base * 0.40;
 $bscs_midterm_written_test_weight = $bscs_midterm_written_test_base * 0.20;
 $bscs_midterm_grade = $bscs_prelim_grade * 0.3 + $bscs_midterm_2nd_quarter * 0.7;
 
 $bscs_midterm_grade = number_format((float)$bscs_midterm_grade,2,".","");
 
 }
 
 
 $bscs_prefinal_output_1 = $bscs_row_prefinal["prefinal_output_1"]; //ok
 $bscs_prefinal_output_2 = $bscs_row_prefinal["prefinal_output_2"]; //ok
 $bscs_prefinal_performance_1 = $bscs_row_prefinal["prefinal_performance_1"]; //ok
 $bscs_prefinal_performance_2 = $bscs_row_prefinal["prefinal_performance_2"]; //ok
 $bscs_prefinal_written_test = $bscs_row_prefinal["prefinal_written_test"]; //ok
 
 $bscs_prefinal_prediction = $bscs_row_prefinal["prefinal_prediction"];
 
 if($bscs_prefinal_output_1 <= 0 && $bscs_prefinal_output_2 <= 0 &&
    $bscs_prefinal_performance_1 <= 0 && $bscs_prefinal_performance_2 <= 0 &&
    $bscs_prefinal_written_test <= 0){
   
     $bscs_prefinal_grade = 0;
 
 }else{
 
 $bscs_prefinal_output_total_score = $bscs_prefinal_output_1 + $bscs_prefinal_output_2; //ok
 $bscs_prefinal_performance_total_score = $bscs_prefinal_performance_1 + $bscs_prefinal_performance_2; //ok
 
 $bscs_prefinal_output_base = $bscs_prefinal_output_total_score / 40 * 40 + 60; //ok
 $bscs_prefinal_performance_base = $bscs_prefinal_performance_total_score / 40 * 40 + 60; //ok
 $bscs_prefinal_written_test_base = $bscs_prefinal_written_test / 70 * 40 + 60; //ok
 
 $bscs_prefinal_output_weight = $bscs_prefinal_output_base * 0.40; //ok
 $bscs_prefinal_performance_weight = $bscs_prefinal_performance_base * 0.40; //ok
 $bscs_prefinal_written_test_weight = $bscs_prefinal_written_test_base * 0.20; //ok
 
 $bscs_prefinal_3rd_quarter = $bscs_prefinal_output_weight + $bscs_prefinal_performance_weight + $bscs_prefinal_written_test_weight; //ok
 $bscs_prefinal_grade = $bscs_midterm_grade * 0.3 + $bscs_prefinal_3rd_quarter * 0.7;
 
 $bscs_prefinal_grade = number_format((float)$bscs_prefinal_grade,2,".","");
 
 }
 
 
 $bscs_final_output_1 = $bscs_row_final["final_output_1"];
 $bscs_final_output_2 = $bscs_row_final["final_output_2"];
 $bscs_final_performance_1 = $bscs_row_final["final_performance_1"];
 $bscs_final_performance_2 = $bscs_row_final["final_performance_2"];
 $bscs_final_written_test = $bscs_row_final["final_written_test"];
 
 $bscs_final_prediction = $bscs_row_final["final_prediction"];
 
 
 if($bscs_final_output_1 <= 0 && $bscs_final_output_2 <= 0 &&
    $bscs_final_performance_1 <= 0 && $bscs_final_performance_2 <= 0 &&
    $bscs_final_written_test <= 0){
   
     $bscs_final_grade = 0;
 
 }else{
 
 $bscs_final_output_total_score = $bscs_final_output_1 + $bscs_final_output_2;
 $bscs_final_output_base = $bscs_final_output_total_score / 40 * 40 + 60;
 $bscs_final_output_weight = $bscs_final_output_base * 0.40;
 $bscs_final_performance_total_score = $bscs_final_performance_1 + $bscs_final_performance_2;
 $bscs_final_performance_base = $bscs_final_performance_total_score / 40 * 40 + 60;
 $bscs_final_performance_weight = $bscs_final_performance_base * 0.40;
 $bscs_final_written_test_base = $bscs_final_written_test / 70 * 40 + 60;
 $bscs_final_written_test_weight = $bscs_final_written_test_base * 0.20;
 $bscs_final_4th_quarter = $bscs_final_output_weight + $bscs_final_performance_weight + $bscs_final_written_test_weight;
 $bscs_final_grade = $bscs_prefinal_grade * 0.3 + $bscs_final_4th_quarter * 0.7;
 
 $bscs_final_grade = number_format((float)$bscs_final_grade,2,".","");
 
 }
   
 
 
 // $prefinal_prediction = 0;
 // $final_prediction = 0;
 $bscs_average_prediction = 0;
 $bscs_average = "";
//  $stack = array($average);


 if($bscs_final_grade>0){
    $bscs_average = $bscs_final_grade;

  }else{
    if($bscs_final_prediction>0){
      $bscs_average = $bscs_final_prediction;
    }
  }



 switch (true) {
     // case ($average <= 74.4):
     //     $equivalent = "5";
     //     break;
     case ($bscs_average >= 74.5 && $bscs_average <= 76.49):
         $bscs_equivalent = "3";
         $bscs_counter_3++;
         break;
     case ($bscs_average >= 76.5 && $bscs_average <= 79.49):
         $bscs_equivalent = "2.75";
         $bscs_counter_2_75++;
         break;
     case ($bscs_average >= 79.5 && $bscs_average <= 82.49):
         $bscs_equivalent = "2.5";
         $bscs_counter_2_5++;
         break;
     case ($bscs_average >= 82.5 && $bscs_average <= 85.49):
         $bscs_equivalent = "2.25";
         $bscs_counter_2_25++;
         break;
     case ($bscs_average >= 85.5 && $bscs_average <= 88.49):
         $bscs_equivalent = "2";
         $bscs_counter_2++;
         break;
     case ($bscs_average >= 88.5 && $bscs_average <= 91.49):
         $bscs_equivalent = "1.75";
         $bscs_counter_1_75++;
         break;
     case ($bscs_average >= 91.5 && $bscs_average <= 94.49):
         $bscs_equivalent = "1.5";
         $bscs_counter_1_5++;
         break;
     case ($bscs_average >= 94.5 && $bscs_average <= 97.49):
         $bscs_equivalent = "1.25";
         $bscs_counter_1_25++;
         break;
     case ($bscs_average >= 97.5 && $bscs_average <= 100):
         $bscs_equivalent = "1";
         $bscs_counter_1++;
         break;
 
     default:
         $bscs_equivalent = "---";
 }
 
 if($bscs_average > 0 && $bscs_average <= 74.4){
   $bscs_equivalent = "5";
   $bscs_counter_5++;

 }

 
if($bscs_equivalent > 0 && $bscs_equivalent <= 3){
  // $remarks = "Passed";
  $bscs_counter_passed++;
}elseif($equivalent == 5){
  // $remarks = "Failed";
  $bscs_counter_failed++;
}

// $bscs_total_passed = $bscs_counter_passed / ( $bscs_counter_passed + $bscs_counter_failed);
// $bscs_total_failed = $bscs_counter_failed / ( $bscs_counter_passed + $bscs_counter_failed);


 
//  if(($prelim_grade>0) && ($midterm_grade>0) && ($prefinal_prediction > 0) && ($final_prediction>0)){
//   echo "<h6>".$equivalent.",</h6>"; 

//   }elseif(($prelim_grade>0) && ($midterm_grade>0) && ($prefinal_grade > 0) && ($final_prediction>0)){
//    $average = ($prelim_grade + $midterm_grade + $prefinal_grade + $final_prediction) / 4;
//    echo "<h6>".$equivalent.",</h6>";

//   }else{
  // echo $equivalent.","; 
  // }



  
//   echo $bscs_firstname." ".$bscs_equivalent.",";
}

// $text="12aap33";

// echo countDigits($equivalent);
// print_r($stack);

// echo "hay".$counter_5;
 
$dataPoints_BSCS = array(
	array(/* "x"=> 10,  */"y"=> $bscs_counter_1, "label"=> "1"),
	array(/* "x"=> 20,  */"y"=> $bscs_counter_1_25, "label"=> "1.25"),
	array(/* "x"=> 30,  */"y"=> $bscs_counter_1_5, "label"=> "1.5"),
	array(/* "x"=> 40,  */"y"=> $bscs_counter_1_75, "label"=> "1.75"),
	array(/* "x"=> 50,  */"y"=> $bscs_counter_2, "label"=> "2"),
	array(/* "x"=> 60,  */"y"=> $bscs_counter_2_25, "label"=> "2.25"),
	array(/* "x"=> 70,  */"y"=> $bscs_counter_2_5, "label"=> "2.5"),
	array(/* "x"=> 80,  */"y"=> $bscs_counter_2_75, "label"=> "2.75"),
	array(/* "x"=> 90,  */"y"=> $bscs_counter_3, "label"=> "3"),
	array(/* "x"=> 100,  */"y"=> $bscs_counter_5, "label"=> "5"),
);

	
?>

<br>

<div id="barChartContainer_BSCS" style="height: 370px; width: 95%;"></div>
 

