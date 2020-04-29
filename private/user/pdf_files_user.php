<?php
require "fpdf.php";
include("../bins/connections.php");

class myPDF extends FPDF{
    function header(){
        // $this->Image('logo.png',10,6);
        $this->SetFont('Arial','B',14);
        $this->Cell(276,5,'Student Performance Prediction System',0,0,'C');
        $this->Ln();
        $this->SetFont('Times','',12);
        $this->Cell(276,10,'Student Records','0','0','C');
        $this->Ln(20);
    }
    function footer(){
      $this->SetY(-15);
      $this->SetFont('Arial','',8);
      $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
    }
    function headerTable(){
        $this->SetFont('Times','B',10);
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

        // Select Semester here Kara nag tapos
        if(isset($_GET["s_"])){
        
          if($_GET["s_"] == "select_semester"){
            $semester = "";
          }else{
            $semester = $_GET["s_"];
            // echo $semester;
          }
      

        }else{
          $semester = "";
        }

        if(isset($_GET["_sn"])){

            $student_no = $_GET["_sn"];

        }else{
          $student_no = "";
        }

        if(isset($_GET["_n"])){

            $student_name = $_GET["_n"];

        }else{
          $student_name = "";
        }

        if($semester == "1"){
          $get_course_name = "IT 2 - Application Programming 1";
          $get_semester = "First Semester";
        }else{
          $get_course_name = "IT 5 - Application Programming 2";
          $get_semester = "Second Semester";
        }

        $this->Cell(80,10,'Course Name: '.$get_course_name,0,0,'L');
        $this->Cell(25,10,'Year: '.$year,0,0,'L');
        $this->Cell(70,10,'Semester: '.$get_semester,0,0,'L');
        $this->Ln();
        // $this->Cell(276,10,$student_name,0,0,'L');
        $this->Ln();
        // $this->SetFont('Times','B',9);
        // $this->Cell(25,10,'Student ID',1,0,'C');
        // $this->Cell(55,10,'Student Name',1,0,'C');
        // $this->Cell(50,10,'Output',1,0,'C');
        // $this->Cell(50,10,'Performance',1,0,'C');
        // $this->Cell(40,10,'Major Exam',1,0,'C');
        // $this->Cell(31,10,'Prelim Grade',1,0,'C');
        // $this->Cell(25,10,'Equivalent',1,0,'C');
        // $this->Ln();
        $this->SetFont('Times','B',9);
        $this->Cell(60,10,'Student Name',1,0,'C');
        $this->Cell(30,10,'Prelim',1,0,'C');
        $this->Cell(30,10,'Midterm',1,0,'C');
        $this->Cell(30,10,'Prefinal',1,0,'C');
        $this->Cell(30,10,'Final',1,0,'C');
        $this->Cell(30,10,'Average',1,0,'C');
        $this->Cell(30,10,'Equivalent',1,0,'C');
        $this->Cell(30,10,'Remarks',1,0,'C');
        // $this->Cell(10,10,'20',1,0,'C');
        // $this->Cell(10,10,'40',1,0,'C');
        // $this->Cell(10,10,'60',1,0,'C');
        // $this->Cell(10,10,'0.40',1,0,'C');
        // $this->Cell(13.33,10,'70',1,0,'C');
        // $this->Cell(13.33,10,'60',1,0,'C');
        // $this->Cell(13.33,10,'0.20',1,0,'C');
        // $this->Cell(31,10,'',1,0,'C');
        // $this->Cell(25,10,'',1,0,'C');
        $this->Ln();
    }
    function viewTable($connections){
        $this->SetFont('Times','B',9);
        
        $prelim_output_1 = $prelim_output_2 = $prelim_output_total_score =
        $prelim_output_base = $prelim_output_weight = $prelim_performance_1 =
        $prelim_performance_2 = $prelim_performance_total_score =
        $prelim_performance_base = $prelim_performance_weight =
        $prelim_written_test = $prelim_written_test_base =
        $prelim_written_test_weight = $prelim_grade =
        $prelim_grade_equivalent = "0";
        if(isset($_GET["s_"])){
          $semester_no = $_GET["s_"];
        
          if($semester_no == "2"){
            $semester_no = "2";
          }else if($semester_no == "select_semester"){
            $semester_no = "1";
          }
        }else{
          $semester_no = "1";
        }
        
        if(isset($_GET["_sn"])){

          $student_no = $_GET["_sn"];

        }else{
          $student_no = "";
        }
        // if($semester_no = "select_semester"){
        //   $semester_no = "1";
        // }
        
        
        
        // $final_prediction_qry = mysqli_query($connections, "SELECT * FROM $final_prediction_table_semester WHERE student_no='$student_no' ");
        // $row_final_prediction = mysqli_fetch_assoc($final_prediction_qry);
        
        $student_qry = mysqli_query($connections, "SELECT * FROM _user_tbl_ WHERE student_no='$student_no' ");
        $row_student = mysqli_fetch_assoc($student_qry);
        $lastname = $row_student['lastname'];
        $firstname = $row_student['firstname'];
        $middlename = $row_student['middlename'];
        $student_name = $firstname . " " . $middlename[0] . ". " . $lastname;
        
        
          // ######################## Check Grades #################
        
        
        $final_qry1 = mysqli_query($connections, "SELECT * FROM final1 WHERE student_no='$student_no' ");
        $prefinal_qry1 = mysqli_query($connections, "SELECT * FROM prefinal1 WHERE student_no='$student_no' ");
        $midterm_qry1 = mysqli_query($connections, "SELECT * FROM midterm1 WHERE student_no='$student_no' ");
        $prelim_qry1 = mysqli_query($connections, "SELECT * FROM prelim1 WHERE student_no='$student_no' ");
        
        
        
          $row1_student = mysqli_fetch_assoc($final_qry1);
          $row1_prefinal = mysqli_fetch_assoc($prefinal_qry1);
          $row1_midterm = mysqli_fetch_assoc($midterm_qry1);
          $row1_prelim = mysqli_fetch_assoc($prelim_qry1);
          
          
          $final1_output_1 = $row1_student["final_output_1"];
          $final1_output_2 = $row1_student["final_output_2"];
          $final1_output_total_score = $row1_student["final_output_total_score"];
          $final1_output_base = $row1_student["final_output_base"];
          $final1_output_weight = $row1_student["final_output_weight"];
          $final1_performance_1 = $row1_student["final_performance_1"];
          $final1_performance_2 = $row1_student["final_performance_2"];
          $final1_performance_total_score = $row1_student["final_performance_total_score"];
          $final1_performance_base = $row1_student["final_performance_base"];
          $final1_performance_weight = $row1_student["final_performance_weight"];
          $final1_written_test = $row1_student["final_written_test"];
          $final1_written_test_base = $row1_student["final_written_test_base"];
          $final1_written_test_weight = $row1_student["final_written_test_weight"];
          $final1_grade = $row1_student["final_grade"];
          $final1_grade_equivalent = $row1_student["final_grade_equivalent"];
          
          
          
          
          $prelim1_output_1 = $row1_prelim['prelim_output_1'];
          $prelim1_output_2 = $row1_prelim['prelim_output_2'];
          $prelim1_performance_1 = $row1_prelim['prelim_performance_1'];
          $prelim1_performance_2 = $row1_prelim['prelim_performance_2'];
          $prelim1_written_test = $row1_prelim['prelim_written_test'];
          
          $prelim1_output_total_score = $prelim1_output_1 + $prelim1_output_2;
          $prelim1_performance_total_score = $prelim1_performance_1 + $prelim1_performance_2;
          
          $prelim1_output_base = $prelim1_output_total_score / 40 * 40 + 60;
          $prelim1_performance_base = $prelim1_performance_total_score / 40 * 40 + 60;
          $prelim1_written_test_base =  $prelim1_written_test / 70 * 40 + 60;
          
          $prelim1_output_weight = $prelim1_output_base * 0.40;
          $prelim1_performance_weight = $prelim1_performance_base * 0.40;
          $prelim1_written_test_weight = $prelim1_written_test_base * 0.20;
          
          $prelim1_grade = $prelim1_output_weight + $prelim1_performance_weight + $prelim1_written_test_weight;
          
          
          
          $midterm1_output_1 = $row1_midterm["midterm_output_1"];
          $midterm1_output_2 = $row1_midterm["midterm_output_2"];
          $midterm1_performance_1 = $row1_midterm["midterm_performance_1"];
          $midterm1_performance_2 = $row1_midterm["midterm_performance_2"];
          $midterm1_written_test = $row1_midterm["midterm_written_test"];
          
          $midterm1_output_total_score = $midterm1_output_1 + $midterm1_output_2;
          $midterm1_output_base = $midterm1_output_total_score / 40 * 40 + 60;
          
          
          $midterm1_performance_total_score = $midterm1_performance_1 + $midterm1_performance_2;
          $midterm1_performance_base = $midterm1_performance_total_score / 40 * 40 + 60;
          $midterm1_written_test_base = $midterm1_written_test / 70 * 40 + 60;
          
          $midterm1_output_weight = $midterm1_output_base * 0.40;
          $midterm1_performance_weight = $midterm1_performance_base * 0.40;
          $midterm1_written_test_weight = $midterm1_written_test_base * 0.20;
          $midterm1_2nd_quarter = $midterm1_output_weight + $midterm1_performance_weight + $midterm1_written_test_weight;
          
          
          $midterm1_grade = $prelim1_grade * 0.3 + $midterm1_2nd_quarter * 0.7;
          
          
          $prefinal1_output_1 = $row1_prefinal["prefinal_output_1"]; //ok
          $prefinal1_output_2 = $row1_prefinal["prefinal_output_2"]; //ok
          $prefinal1_performance_1 = $row1_prefinal["prefinal_performance_1"]; //ok
          $prefinal1_performance_2 = $row1_prefinal["prefinal_performance_2"]; //ok
          $prefinal1_written_test = $row1_prefinal["prefinal_written_test"]; //ok
          // $prefinal_grade_equivalent = $row_prefinal["prefinal_grade_equivalent"];
          
          $prefinal1_output_total_score = $prefinal1_output_1 + $prefinal1_output_2; //ok
          $prefinal1_performance_total_score = $prefinal1_performance_1 + $prefinal1_performance_2; //ok
          
          $prefinal1_output_base = $prefinal1_output_total_score / 40 * 40 + 60; //ok
          $prefinal1_performance_base = $prefinal1_performance_total_score / 40 * 40 + 60; //ok
          $prefinal1_written_test_base = $prefinal1_written_test / 70 * 40 + 60; //ok
          
          $prefinal1_output_weight = $prefinal1_output_base * 0.40; //ok
          $prefinal1_performance_weight = $prefinal1_performance_base * 0.40; //ok
          $prefinal1_written_test_weight = $prefinal1_written_test_base * 0.20; //ok
          
          $prefinal1_3rd_quarter = $prefinal1_output_weight + $prefinal1_performance_weight + $prefinal1_written_test_weight; //ok
          $prefinal1_grade = $midterm1_grade * 0.3 + $prefinal1_3rd_quarter * 0.7;
          
          
          $check_prelim1_grade = $prelim1_output_1 + $prelim1_output_2 + $prelim1_performance_1 + $prelim1_performance_2 + $prelim1_written_test;
          $check_midterm1_grade = $midterm1_output_1 + $midterm1_output_2 + $midterm1_performance_1 + $midterm1_performance_2 + $midterm1_written_test;
          $check_prefinal1_grade = $prefinal1_output_1 + $prefinal1_output_2 + $prefinal1_performance_1 + $prefinal1_performance_2 + $prefinal1_written_test;
          
          
              // ####################______Final Formulas______####################
              // $final_formative_assessment_total_score =
              // $final_formative_assessment_1 + $final_formative_assessment_2 +
              // $final_formative_assessment_3 + $final_formative_assessment_4 +
              // $final_formative_assessment_5 + $final_formative_assessment_6 +
              // $final_formative_assessment_7 + $final_formative_assessment_8 +
              // $final_formative_assessment_9 + $final_formative_assessment_10;
          
              // $final_formative_assessment_base = $final_formative_assessment_total_score / 100 * 40 + 60;
              $final1_output_total_score = $final1_output_1 + $final1_output_2;
              $final1_output_base = $final1_output_total_score / 40 * 40 + 60;
              $final1_output_weight = $final1_output_base * 0.40;
              $final1_performance_total_score = $final1_performance_1 + $final1_performance_2;
              $final1_performance_base = $final1_performance_total_score / 40 * 40 + 60;
              $final1_performance_weight = $final1_performance_base * 0.40;
              $final1_written_test_base = $final1_written_test / 70 * 40 + 60;
              $final1_written_test_weight = $final1_written_test_base * 0.20;
              $final1_4th_quarter = $final1_output_weight + $final1_performance_weight + $final1_written_test_weight;
              $final1_grade = $prefinal1_grade * 0.3 + $final1_4th_quarter * 0.7;
          
  
              $prelim = "prelim$semester_no";
              $midterm = "midterm$semester_no";
              $prefinal = "prefinal$semester_no";
              $final = "final$semester_no";
              $prelim_qry = mysqli_query($connections, "SELECT * FROM $prelim WHERE student_no='$student_no' ");
              $midterm_qry = mysqli_query($connections, "SELECT * FROM $midterm WHERE student_no='$student_no' ");
              $prefinal_qry = mysqli_query($connections, "SELECT * FROM $prefinal WHERE student_no='$student_no' ");
              $final_qry = mysqli_query($connections, "SELECT * FROM $final WHERE student_no='$student_no' ");
            
            // $prefinal_prediction_qry = mysqli_query($connections, "SELECT * FROM $prefinal WHERE student_no='$student_no' ");
            
            
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
            $prelim_written_test_base =  $prelim_written_test / 70 * 40 + 60;
            
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
            $midterm_written_test_base = $midterm_written_test / 70 * 40 + 60;
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
            
            $prefinal_prediction = $row_prefinal["prefinal_prediction"];
            
            
            // old line of condition
            // if($prefinal_output_1 == 0 && $prefinal_output_2 == 0 &&
            //    $prefinal_performance_1 == 0 && $prefinal_performance_1 == 0 &&
            //    $prefinal_written_test == 0){
              
            //     if($prefinal_prediction>0){
            //     $prefinal_prediction = $row_prefinal["prefinal_prediction"];
            //     $confirm_prefinal_prediction = $prefinal_prediction;
            //     }else{
            //       $prefinal_grade = 0;
            //       $prefinal_prediction = 0;
            //     }
            
            
            // new line of condition
            if($prefinal_output_1 <= 0 && $prefinal_output_2 <= 0 &&
               $prefinal_performance_1 <= 0 && $prefinal_performance_2 <= 0 &&
               $prefinal_written_test <= 0){
              
                if($prefinal_prediction>0){
                $prefinal_prediction = $row_prefinal["prefinal_prediction"];
                $confirm_prefinal_prediction = $prefinal_prediction;
                $prefinal_grade = 0;
              }else{
                  $prefinal_grade = 0;
                  $prefinal_prediction = 0;
                }
            
            }else{
            
            $prefinal_output_total_score = $prefinal_output_1 + $prefinal_output_2; //ok
            $prefinal_performance_total_score = $prefinal_performance_1 + $prefinal_performance_2; //ok
            
            $prefinal_output_base = $prefinal_output_total_score / 40 * 40 + 60; //ok
            $prefinal_performance_base = $prefinal_performance_total_score / 40 * 40 + 60; //ok
            $prefinal_written_test_base = $prefinal_written_test / 70 * 40 + 60; //ok
            
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
            
            $final_prediction = $row_final["final_prediction"];
            
                // old line of condition
            
            // if($final_output_1 == 0 && $final_output_2 == 0 &&
            //    $final_performance_1 == 0 && $final_performance_2 == 0 &&
            //    $final_written_test == 0){
              
                // $final_grade = 0;
            
                // if($final_prediction>0){
                //   $final_prediction = $row_final["final_prediction"];
                //   $confirm_final_prediction = $final_prediction;
                //   }else{
                //     $final_grade = 0;
                //     $final_prediction = 0;
                //   }
            
            
                // new line of condition
            if($final_output_1 <= 0 && $final_output_2 <= 0 &&
               $final_performance_1 <= 0 && $final_performance_2 <= 0 &&
               $final_written_test <= 0){
              
                  if($final_prediction>0){
                  $final_prediction = $row_final["final_prediction"];
                  $confirm_final_prediction = $final_prediction;
                  $final_grade = 0;
                }else{
                  $final_grade = 0;
                    $final_prediction = 0;
                  }
            
            }else{
            
            $final_output_total_score = $final_output_1 + $final_output_2;
            $final_output_base = $final_output_total_score / 40 * 40 + 60;
            $final_output_weight = $final_output_base * 0.40;
            $final_performance_total_score = $final_performance_1 + $final_performance_2;
            $final_performance_base = $final_performance_total_score / 40 * 40 + 60;
            $final_performance_weight = $final_performance_base * 0.40;
            $final_written_test_base = $final_written_test / 70 * 40 + 60;
            $final_written_test_weight = $final_written_test_base * 0.20;
            $final_4th_quarter = $final_output_weight + $final_performance_weight + $final_written_test_weight;
            $final_grade = $prefinal_grade * 0.3 + $final_4th_quarter * 0.7;
            
            $final_grade = number_format((float)$final_grade,2,".","");
            
            }
              
            
            
            
            $average_prediction = 0;
            
            $average = "";
            
            $prelim_status = 0;
            $prelim_status_missed = "";
            
            $midterm_status = 0;
            $midterm_status_missed = "";
            
            $prefinal_status = 0;
            $prefinal_status_missed = "";
            
            $final_status = 0;
            $final_status_missed = "";
            
            if ($prelim_output_1 == 0){
              $prelim_status++;
              $prelim_status_missed .= "Prelim Output 1 </br>";
            }
            
            if ($prelim_output_2 == 0){
              $prelim_status++;
              $prelim_status_missed .= "Prelim Output 2 </br>";
            }
            
            if ($prelim_performance_1 == 0){
              $prelim_status++;
              $prelim_status_missed .= "Prelim Performance 1 </br>";
            }
            
            if ($prelim_performance_2 == 0){
              $prelim_status++;
              $prelim_status_missed .= "Prelim Performance 2 </br>";
            }
            
            if ($prelim_written_test == 0){
              $prelim_status++;
              $prelim_status_missed .= "Prelim Written Test </br>";
            }
            
            
            
            if ($midterm_output_1 == 0){
              $midterm_status+=1;
              $midterm_status_missed .= "Midterm Output 1 </br>";
            }
            
            if ($midterm_output_2 == 0){
              $midterm_status+=1;
              $midterm_status_missed .= "Midterm Output 2 </br>";
            }
            
            if ($midterm_performance_1 == 0){
              $midterm_status+=1;
              $midterm_status_missed .= "Midterm Performance 1 </br>";
            }
            
            if ($midterm_performance_2 == 0){
              $midterm_status+=1;
              $midterm_status_missed .= "Midterm Performance 2 </br>";
            }
            
            if ($midterm_written_test == 0){
              $midterm_status+=1;
              $midterm_status_missed .= "Midterm Written Test </br>";
            }
            
            
            if ($prefinal_output_1 == 0){
              $prefinal_status+=1;
              $prefinal_status_missed .= "Prefinal Output 1 </br>";
            }
            
            if ($prefinal_output_2 == 0){
              $prefinal_status+=1;
              $prefinal_status_missed .= "Prefinal Output 2 </br>";
            }
            
            if ($prefinal_performance_1 == 0){
              $prefinal_status+=1;
              $prefinal_status_missed .= "Prefinal Performance 1 </br>";
            }
            
            if ($prefinal_performance_2 == 0){
              $prefinal_status+=1;
              $prefinal_status_missed .= "Prefinal Performance 2 </br>";
            }
            
            if ($prefinal_written_test == 0){
              $prefinal_status+=1;
              $prefinal_status_missed .= "Prefinal Written Test </br>";
            }
            
            
            if ($final_output_1 == 0){
              $final_status+=1;
              $final_status_missed .= "final Output 1 </br>";
            }
            
            if ($final_output_2 == 0){
              $final_status+=1;
              $final_status_missed .= "final Output 2 </br>";
            }
            
            if ($final_performance_1 == 0){
              $final_status+=1;
              $final_status_missed .= "final Performance 1 </br>";
            }
            
            if ($final_performance_2 == 0){
              $final_status+=1;
              $final_status_missed .= "final Performance 2 </br>";
            }
            
            if ($final_written_test == 0){
              $final_status+=1;
              $final_status_missed .= "final Written Test </br>";
            }

          $this->Cell(60,10,$student_name,1,0,'C');
          $this->Cell(30,10,$prelim_grade,1,0,'C');
          $this->Cell(30,10,$midterm_grade,1,0,'C');
          if($prefinal_grade>0){
            if($prefinal_status > 0){
              // echo $prefinal_grade." <sup class='grade_status bg-warning rounded-circle px-1' data-toggle='modal' data-target='#prefinal$student_no'><b>$prefinal_status</b><sup>";
              $this->Cell(30,10,$prefinal_grade,1,0,'C');
            }else{
              // echo $prefinal_grade;
              $this->Cell(30,10,$prefinal_grade,1,0,'C');
            }
          }else{
            if($prefinal_prediction>0){
              // echo "<h6>".$prefinal_prediction."</h6>";
              $this->SetTextColor(255,0,0);
              $this->Cell(30,10,$prefinal_prediction,1,0,'C');
              $this->SetTextColor(0,0,0);
            }
          }


          if($final_grade>0){
            if($final_status > 0){
              // echo $final_grade." <sup class='grade_status bg-warning rounded-circle px-1' data-toggle='modal' data-target='#final$student_no'><b>$final_status</b><sup>";
              $this->Cell(30,10,$final_grade,1,0,'C');
            }else{
              // echo $final_grade;
              $this->Cell(30,10,$final_grade,1,0,'C');
            }
          }else{
            if($final_prediction>0){
              // echo "<h6>".$final_prediction."</h6>";
              $this->SetTextColor(255,0,0);
              $this->Cell(30,10,$final_prediction,1,0,'C');
              $this->SetTextColor(0,0,0);
            }
          }
          

          if($final_grade>0){
            $average = $final_grade;
          
              // echo $final_grade;
              $this->Cell(30,10,$average,1,0,'C');
            // }
          }else{
            if($final_prediction>0){
              $average = $final_prediction;
              // echo "<h6>".$final_prediction."</h6>";
              $this->SetTextColor(255,0,0);
              $this->Cell(30,10,$average,1,0,'C');
              $this->SetTextColor(0,0,0);
            }
          }
          
          switch (true) {

            case ($average >= 74.5 && $average <= 76.49):
                $equivalent = "3";
                break;
            case ($average >= 76.5 && $average <= 79.49):
                $equivalent = "2.75";
                break;
            case ($average >= 79.5 && $average <= 82.49):
                $equivalent = "2.5";
                break;
            case ($average >= 82.5 && $average <= 85.49):
                $equivalent = "2.25";
                break;
            case ($average >= 85.5 && $average <= 88.49):
                $equivalent = "2";
                break;
            case ($average >= 88.5 && $average <= 91.49):
                $equivalent = "1.75";
                break;
            case ($average >= 91.5 && $average <= 94.49):
                $equivalent = "1.5";
                break;
            case ($average >= 94.5 && $average <= 97.49):
                $equivalent = "1.25";
                break;
            case ($average >= 97.5 && $average <= 100):
                $equivalent = "1";
                break;
        
            default:
                $equivalent = "---";
        }
        
        if($average > 0 && $average <= 74.4){
          $equivalent = "5";
        }
        
        
         if(($prelim_grade>0) && ($midterm_grade>0) && ($prefinal_grade > 0) && ($final_grade>0)){
          // echo $equivalent; 
          $this->Cell(30,10,$equivalent,1,0,'C');
         }else{
          if(($prelim_grade>0) && ($midterm_grade>0) && ($prefinal_prediction > 0) && ($final_prediction>0)){
            // echo "<h6>".$equivalent."</h6>"; 
            $this->SetTextColor(255,0,0);
            $this->Cell(30,10,$equivalent,1,0,'C');
            $this->SetTextColor(0,0,0);
            }elseif(($prelim_grade>0) && ($midterm_grade>0) && ($prefinal_grade > 0) && ($final_prediction>0)){
            //  echo "<h6>".$equivalent."</h6>";
            $this->SetTextColor(255,0,0);
             $this->Cell(30,10,$equivalent,1,0,'C');
             $this->SetTextColor(0,0,0);
            }
         }
          

           if($equivalent > 0 && $equivalent <= 3){
            $remarks = "Passed";
            // echo "<h6 class='passed remarks'>".$remarks."</h6>";
            $this->Cell(30,10,$remarks,1,0,'C');
          }elseif($equivalent == 5){
            $remarks = "Failed";
            // echo "<h6 class='failed remarks'>".$remarks."</h6>";
            $this->Cell(30,10,$remarks,1,0,'C');
          }else{
            $remarks = "---";
            // echo $remarks;
            $this->Cell(30,10,$remarks,1,0,'C');
          }
          
          }       
          // }    
          $this->Ln();
          $this->Ln();
          $this->SetFont('Times','B',12);
          $this->Cell(80,5,'Note:',0,0,'L');
          $this->Ln();
          $this->SetFont('Times','',9);
          $this->Cell(80,5,'Highlighted grades are predicted grades.',0,0,'L');
          $this->Ln();
          $this->Ln();
          $this->Cell(80,5,'',0,0,'L');
          $this->Cell(80,5,'_______________________',0,0,'L');
          $this->Cell(80,5,'_______________________',0,0,'L');
          $this->Ln();
          $this->Cell(75,5,'',0,0,'C');
          $this->Cell(50,5,'Date Submitted',0,0,'C');
          $this->Cell(109,5,'Signature over Printed Name',0,0,'C');
          $this->Ln();
    }
}

$pdf = new myPDF();
$pdf->AliasNbPages();
$pdf->AddPage('L','A4',0);
$pdf->headerTable();
$pdf->viewTable($connections);
$pdf->Output();

?>