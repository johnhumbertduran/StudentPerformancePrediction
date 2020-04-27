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
          $get_course_name = "Application Programming 1";
          $get_semester = "First Semester";
        }else{
          $get_course_name = "Application Programming 2";
          $get_semester = "Second Semester";
        }

        $this->Cell(70,10,'Course Name: '.$get_course_name,0,0,'L');
        $this->Cell(25,10,'Year: '.$year,0,0,'L');
        $this->Cell(70,10,'Semester: '.$get_semester,0,0,'L');
        $this->Ln();
        $this->Cell(276,10,'Pre-final Period',1,0,'C');
        $this->Ln();
        $this->SetFont('Times','B',9);
        $this->Cell(20,10,'Student ID',1,0,'C');
        $this->Cell(45,10,'Student Name',1,0,'C');
        $this->Cell(50,10,'Output',1,0,'C');
        $this->Cell(50,10,'Performance',1,0,'C');
        $this->Cell(40,10,'Major Exam',1,0,'C');
        $this->Cell(25,10,'3rd Quarter',1,0,'C');
        $this->Cell(26,10,'Pre-final Grade',1,0,'C');
        $this->Cell(20,10,'Equivalent',1,0,'C');
        $this->Ln();
        $this->SetFont('Times','B',9);
        $this->Cell(20,10,'',1,0,'C');
        $this->Cell(45,10,'Higest Possible Score',1,0,'C');
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
        $this->Cell(25,10,'',1,0,'C');
        $this->Cell(26,10,'',1,0,'C');
        $this->Cell(20,10,'',1,0,'C');
        $this->Ln();
    }
    function viewTable($connections){
        $this->SetFont('Times','B',9);
        
        $prefinal_output_1 = $prefinal_output_2 =
        $prefinal_output_total_score = $prefinal_output_base =
        $prefinal_output_weight = $prefinal_performance_1 =
        $prefinal_performance_2 = $prefinal_performance_total_score =
        $prefinal_performance_base = $prefinal_performance_weight =
        $prefinal_written_test = $prefinal_written_test_base =
        $prefinal_written_test_weight = $prefinal_3rd_quarter =
        $prefinal_grade = $prefinal_grade_equivalent = "0";

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

        if($grade_period == "prefinal"){
          if(isset($_GET["_y"])){
            if($year == $_GET["_y"]){
              if(isset($_GET["_c"])){
                if($course == $_GET["_c"]){
                    if(isset($_GET["_s_e_"])){
                        if($semester == $_GET["_s_e_"]){
      
                        $grade_period = $grade_period . $semester[3];
                        $semester_no = $semester[3];
                        $midterm_no = "midterm$semester_no"; 
                        $prelim_no = "prelim$semester_no"; 
      
      
                        $grading_period = mysqli_query($connections, "SELECT * FROM $grade_period WHERE course='$course' AND year='$year' ");
                        $midterm_qry = mysqli_query($connections, "SELECT * FROM $midterm_no WHERE course='$course' AND year='$year' ");
                        $prelim_qry = mysqli_query($connections, "SELECT * FROM $prelim_no WHERE course='$course' AND year='$year' ");
                          
                        // prefinal_query($grading_period,$midterm_qry,$prelim_qry);
                    }
                  }
                }
              }
            }
          }
        }
        
      
      
      
      // function prefinal_query($grading_period,$midterm_qry,$prelim_qry){
      while($row_student = mysqli_fetch_assoc($grading_period)){
      
          
        $row_midterm = mysqli_fetch_assoc($midterm_qry);
        $row_prelim = mysqli_fetch_assoc($prelim_qry);
        $student_no = $row_student["student_no"];
        $fullname = $row_student["student_name"];
        $prefinal_output_1 = $row_student["prefinal_output_1"];
        $prefinal_output_2 = $row_student["prefinal_output_2"];
        $prefinal_output_total_score = $row_student["prefinal_output_total_score"];
        $prefinal_output_base = $row_student["prefinal_output_base"];
        $prefinal_output_weight = $row_student["prefinal_output_weight"];
        $prefinal_performance_1 = $row_student["prefinal_performance_1"];
        $prefinal_performance_2 = $row_student["prefinal_performance_2"];
        $prefinal_performance_total_score = $row_student["prefinal_performance_total_score"];
        $prefinal_performance_base = $row_student["prefinal_performance_base"];
        $prefinal_performance_weight = $row_student["prefinal_performance_weight"];
        $prefinal_written_test = $row_student["prefinal_written_test"];
        $prefinal_written_test_base = $row_student["prefinal_written_test_base"];
        $prefinal_written_test_weight = $row_student["prefinal_written_test_weight"];
        $prefinal_grade = $row_student["prefinal_grade"];
        $prefinal_grade_equivalent = $row_student["prefinal_grade_equivalent"];
        
        $midterm_output_1 = $row_midterm["midterm_output_1"];
        $midterm_output_2 = $row_midterm["midterm_output_2"];
        $midterm_performance_1 = $row_midterm["midterm_performance_1"];
        $midterm_performance_2 = $row_midterm["midterm_performance_2"];
        $midterm_written_test = $row_midterm["midterm_written_test"];
      
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
        
      
        $prelim_output_1 = $row_prelim['prelim_output_1'];
        $prelim_output_2 = $row_prelim['prelim_output_2'];
        $prelim_performance_1 = $row_prelim['prelim_performance_1'];
        $prelim_performance_2 = $row_prelim['prelim_performance_2'];
        $prelim_written_test = $row_prelim['prelim_written_test'];
      
        $prelim_output_total_score = $prelim_output_1 + $prelim_output_2;
        $prelim_performance_total_score = $prelim_performance_1 + $prelim_performance_2;
      
        $prelim_output_base = $prelim_output_total_score / 40 * 40 + 60;
        $prelim_performance_base = $prelim_performance_total_score / 40 * 40 + 60;
        $prelim_written_test_base =  $prelim_written_test / 70 * 40 + 60;
      
        $prelim_output_weight = $prelim_output_base * 0.40;
        $prelim_performance_weight = $prelim_performance_base * 0.40;
        $prelim_written_test_weight = $prelim_written_test_base * 0.20;
      
        $prelim_grade = $prelim_output_weight + $prelim_performance_weight + $prelim_written_test_weight;
      
        
        
        $midterm_grade = $prelim_grade * 0.3 + $midterm_2nd_quarter * 0.7;
      
        $check_prelim_grade = $prelim_output_1 + $prelim_output_2 + $prelim_performance_1 + $prelim_performance_2 + $prelim_written_test;
        $check_midterm_grade = $midterm_output_1 + $midterm_output_2 + $midterm_performance_1 + $midterm_performance_2 + $midterm_written_test;
      // echo $midterm_grade;
      // $midterm_qry = mysqli_query($connections, "SELECT * FROM midterm");
      // $row_midterm = mysqli_fetch_assoc($midterm_qry);
      // $midterm_grade = $row_midterm["midterm_grade"];
      
      
          // ####################______Prefinal Formulas______####################
          // $prefinal_formative_assessment_total_score =
          // $prefinal_formative_assessment_1 + $prefinal_formative_assessment_2 +
          // $prefinal_formative_assessment_3 + $prefinal_formative_assessment_4 +
          // $prefinal_formative_assessment_5 + $prefinal_formative_assessment_6 +
          // $prefinal_formative_assessment_7 + $prefinal_formative_assessment_8 +
          // $prefinal_formative_assessment_9 + $prefinal_formative_assessment_10;
        
          // $prefinal_formative_assessment_base = $prefinal_formative_assessment_total_score / 100 * 40 + 60;
          $prefinal_output_total_score = $prefinal_output_1 + $prefinal_output_2;
          $prefinal_output_base = $prefinal_output_total_score / 40 * 40 + 60;
          $prefinal_output_weight = $prefinal_output_base * 0.40;
          $prefinal_performance_total_score = $prefinal_performance_1 + $prefinal_performance_2;
          $prefinal_performance_base = $prefinal_performance_total_score / 40 * 40 + 60;
          $prefinal_performance_weight = $prefinal_performance_base * 0.40;
          $prefinal_written_test_base = $prefinal_written_test / 70 * 40 + 60;
          $prefinal_written_test_weight = $prefinal_written_test_base * 0.20;
          $prefinal_3rd_quarter = $prefinal_output_weight + $prefinal_performance_weight + $prefinal_written_test_weight;
          $prefinal_grade = $midterm_grade * 0.3 + $prefinal_3rd_quarter * 0.7;
        
          switch (true) {
            //   case ($prefinal_grade <= 74.4):
            //       $prefinal_grade_equivalent = "5";
            //       break;
              case ($prefinal_grade >= 74.5 && $prefinal_grade <= 76.49):
                  $prefinal_grade_equivalent = "3";
                  break;
              case ($prefinal_grade >= 76.5 && $prefinal_grade <= 79.49):
                  $prefinal_grade_equivalent = "2.75";
                  break;
              case ($prefinal_grade >= 79.5 && $prefinal_grade <= 82.49):
                  $prefinal_grade_equivalent = "2.5";
                  break;
              case ($prefinal_grade >= 82.5 && $prefinal_grade <= 85.49):
                  $prefinal_grade_equivalent = "2.25";
                  break;
              case ($prefinal_grade >= 85.5 && $prefinal_grade <= 88.49):
                  $prefinal_grade_equivalent = "2";
                  break;
              case ($prefinal_grade >= 88.5 && $prefinal_grade <= 91.49):
                  $prefinal_grade_equivalent = "1.75";
                  break;
              case ($prefinal_grade >= 91.5 && $prefinal_grade <= 94.49):
                  $prefinal_grade_equivalent = "1.5";
                  break;
              case ($prefinal_grade >= 94.5 && $prefinal_grade <= 97.49):
                  $prefinal_grade_equivalent = "1.25";
                  break;
              case ($prefinal_grade >= 97.5 && $prefinal_grade <= 100):
                  $prefinal_grade_equivalent = "1";
                  break;
        
              default:
                  $prefinal_grade_equivalent = "5";
          }
        
      
          $year = $_GET["_y"];
          $course = $_GET["_c"];
          $semester = $_GET["_s_e_"];
      

          $this->Cell(20,10,$student_no,1,0,'C');
          $this->Cell(45,10,$fullname,1,0,'C');
          $this->Cell(10,10,$prefinal_output_1,1,0,'C');
          $this->Cell(10,10,$prefinal_output_2,1,0,'C');
          $this->Cell(10,10,$prefinal_output_total_score,1,0,'C');
          $this->Cell(10,10,$prefinal_output_base,1,0,'C');
          $this->Cell(10,10,$prefinal_output_weight,1,0,'C');
          $this->Cell(10,10,$prefinal_performance_1,1,0,'C');
          $this->Cell(10,10,$prefinal_performance_2,1,0,'C');
          $this->Cell(10,10,$prefinal_performance_total_score,1,0,'C');
          $this->Cell(10,10,$prefinal_performance_base,1,0,'C');
          $this->Cell(10,10,$prefinal_performance_weight,1,0,'C');
          $this->Cell(13.33,10,$prefinal_written_test,1,0,'C');
          $this->Cell(13.33,10,number_format((float)$prefinal_written_test_base,2,".",""),1,0,'C');
          $this->Cell(13.33,10,number_format((float)$prefinal_written_test_weight,2,".",""),1,0,'C');
          $this->Cell(25,10,number_format((float)$prefinal_3rd_quarter,2,".",""),1,0,'C');
          $this->Cell(26,10,number_format((float)$prefinal_grade,2,".",""),1,0,'C');
          $this->Cell(20,10,$prefinal_grade_equivalent,1,0,'C');
          $this->Ln();
          }       
          // } 
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