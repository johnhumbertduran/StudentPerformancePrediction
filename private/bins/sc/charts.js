var overAllSemesterText = document.getElementById("overAllSemesterText");
var overAllSemester = document.getElementById("overAllSemester");
var firstSemester = document.getElementById("firstSemester");
var secondSemester = document.getElementById("secondSemester");
var secondSemesterValue = document.getElementById("secondSemester").value;


function semester(){
    var semester = document.getElementById("overAllSemester");
    var selected_semester = semester.options[semester.selectedIndex].value;

        window.location.href = "?sem="+selected_semester;
  }



var overAllByCourseText = document.getElementById("overAllByCourseText");
var bscs = document.getElementById("bscs");
var bsit = document.getElementById("bsit");



function course(){
    var course = document.getElementById("overAllByCourse");
    var selected_course = course.options[course.selectedIndex].value;
  
    window.location.href = "?course="+selected_course;
    // window.location.href = "#bsit";
    // overAllByCourseText.value = selected_course;

    // if(overAllByCourseText.value == "BSIT"){
    //     bsit.style.display = "block";
    //     bsit.width = window.innerWidth;
    //     bscs.style.display = "none";
    //     // $("#bsit").load(location.href+" #bsit>*","");
    //     // barChart_BSIT.render();
    // }else{
    //     bscs.style.display = "block";
    //     bsit.style.display = "none";
    // }
    // alert("hay");
  }
