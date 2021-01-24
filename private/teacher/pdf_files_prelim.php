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

        if($semester == "sem1"){
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
        $this->Cell(276,10,'Preliminary Period',1,0,'C');
        $this->Ln();
        $this->SetFont('Times','B',9);
        $this->Cell(25,10,'Student ID',1,0,'C');
        $this->Cell(55,10,'Student Name',1,0,'C');
        $this->Cell(50,10,'Output',1,0,'C');
        $this->Cell(50,10,'Performance',1,0,'C');
        $this->Cell(40,10,'Major Exam',1,0,'C');
        $this->Cell(31,10,'Prelim Grade',1,0,'C');
        $this->Cell(25,10,'Equivalent',1,0,'C');
        $this->Ln();
        $this->SetFont('Times','B',9);
        $this->Cell(25,10,'',1,0,'C');
        $this->Cell(55,10,'Higest Possible Score',1,0,'C');
        $this->Cell(10,10,'20',1,0,'C');
        $this->Cell(10,10,'20',1,0,'C');
        $this->Cell(10,10,'40',1,0,'C');
        $this->Cell(10,10,'60',1,0,'C');
        $this->Cell(10,10,'0.40',1,0,'C');
        $this->Cell(10,10,'20',1,0,'C');
        $this->Cell(10,10,'20',1,0,'C');
        $this->Cell(10,10,'40',1,0,'C');
        $this->Cell(10,10,'60',1,0,'C');
        $this->Cell(10,10,'0.40',1,0,'C');
        $this->Cell(13.33,10,'70',1,0,'C');
        $this->Cell(13.33,10,'60',1,0,'C');
        $this->Cell(13.33,10,'0.20',1,0,'C');
        $this->Cell(31,10,'',1,0,'C');
        $this->Cell(25,10,'',1,0,'C');
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

        if($grade_period == "prelim"){
            if(isset($_GET["_y"])){
              if($year == $_GET["_y"]){
                if(isset($_GET["_c"])){
                  if($course == $_GET["_c"]){
                    // if(isset($_GET["_s"])){
                    //   if($subject == $_GET["_s"]){
                        if(isset($_GET["_s_e_"])){
                          if($semester == $_GET["_s_e_"]){
        
                            $grade_period = $grade_period . $semester[3];
                            $grading_period = mysqli_query($connections, "SELECT * FROM $grade_period WHERE course='$course' AND year='$year' ");
        
                            // prelim_query($grading_period);
                          }
                        }
                  }
                }
              }
            }
          }
          
        
        // function prelim_query($grading_period){
        
        while($row_prelim = mysqli_fetch_assoc($grading_period)){
        
          $student_no = $row_prelim["student_no"];
          $fullname = $row_prelim["student_name"];
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
          $prelim_written_test_base = $prelim_written_test / 70 * 40 + 60;
          $prelim_written_test_weight = $prelim_written_test_base * 0.20;
          $prelim_grade = $prelim_output_weight + $prelim_performance_weight + $prelim_written_test_weight;
        
          switch (true) {
            //   case ($prelim_grade <= 74.4):
            //       $prelim_grade_equivalent = "5";
            //       break;
              case ($prelim_grade >= 74.5 && $prelim_grade <= 76.49):
                  $prelim_grade_equivalent = "3";
                  break;
              case ($prelim_grade >= 76.5 && $prelim_grade <= 79.49):
                  $prelim_grade_equivalent = "2.75";
                  break;
              case ($prelim_grade >= 79.5 && $prelim_grade <= 82.49):
                  $prelim_grade_equivalent = "2.5";
                  break;
              case ($prelim_grade >= 82.5 && $prelim_grade <= 85.49):
                  $prelim_grade_equivalent = "2.25";
                  break;
              case ($prelim_grade >= 85.5 && $prelim_grade <= 88.49):
                  $prelim_grade_equivalent = "2";
                  break;
              case ($prelim_grade >= 88.5 && $prelim_grade <= 91.49):
                  $prelim_grade_equivalent = "1.75";
                  break;
              case ($prelim_grade >= 91.5 && $prelim_grade <= 94.49):
                  $prelim_grade_equivalent = "1.5";
                  break;
              case ($prelim_grade >= 94.5 && $prelim_grade <= 97.49):
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
        
          $year = $_GET["_y"];
          $course = $_GET["_c"];
          $semester = $_GET["_s_e_"];

          $this->Cell(25,10,$student_no,1,0,'C');
          $this->Cell(55,10,$fullname,1,0,'C');
          $this->Cell(10,10,$prelim_output_1,1,0,'C');
          $this->Cell(10,10,$prelim_output_2,1,0,'C');
          $this->Cell(10,10,$prelim_output_total_score,1,0,'C');
          $this->Cell(10,10,$prelim_output_base,1,0,'C');
          $this->Cell(10,10,$prelim_output_weight,1,0,'C');
          $this->Cell(10,10,$prelim_performance_1,1,0,'C');
          $this->Cell(10,10,$prelim_performance_2,1,0,'C');
          $this->Cell(10,10,$prelim_performance_total_score,1,0,'C');
          $this->Cell(10,10,$prelim_performance_base,1,0,'C');
          $this->Cell(10,10,$prelim_performance_weight,1,0,'C');
          $this->Cell(13.33,10,$prelim_written_test,1,0,'C');
          $this->Cell(13.33,10,number_format((float)$prelim_written_test_base,2,".",""),1,0,'C');
          $this->Cell(13.33,10,number_format((float)$prelim_written_test_weight,2,".",""),1,0,'C');
          $this->Cell(31,10,number_format((float)$prelim_grade,2,".",""),1,0,'C');
          $this->Cell(25,10,$prelim_grade_equivalent,1,0,'C');
          $this->Ln();
          }       
          // }    
          $this->Ln();
          $this->Ln();
          $this->SetFont('Times','',9);
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
$pdf->Output("I","prelim_file");

?>