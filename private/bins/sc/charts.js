var overAllSemesterText = document.getElementById("overAllSemesterText");
var firstSemester = document.getElementById("firstSemester");
var secondSemester = document.getElementById("secondSemester");

secondSemester.style.display= "none";

function semester(){
    var semester = document.getElementById("overAllSemester");
    var selected_semester = semester.options[semester.selectedIndex].value;
  
    // window.location.href = "?redir="+selected_grading;
    overAllSemesterText.value = selected_semester;

    if(overAllSemesterText.value == "secondSemester"){
        secondSemester.style.display = "block";
        firstSemester.style.display = "none";
        barChartSecondSemester.render()
    }else{
        firstSemester.style.display = "block";
        secondSemester.style.display = "none";
    }
    // alert("hay");
  }
