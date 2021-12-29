var duplicated = false;

function validateForm_Course() {
    var name_course = document.forms["course"]["fname"].value;
    var datepost = document.forms["course"]["fdate"].value;
    var timepost = document.forms["course"]["ftime"].value;
    var fileUpload = document.forms["course"]["fileUpload"].value;
    let check = true;

    //  CHECK NAME COURSE
    if (name_course == '') {
        document.getElementById('error_namecourse').innerHTML = "Name Course must be filled out";
        check = false;
    } else if (!duplicated) {
        document.getElementById('error_namecourse').innerHTML = "";
    }

    //  CHECK DATETIME POST
    if (datepost == '' || timepost == '') {
        document.getElementById('error_datetime').innerHTML = "Date or Time post must be filled out";
        check = false;
    } else {
        document.getElementById('error_datetime').innerHTML = "";
    }

    // CHECK FILE 
    if (fileUpload == '') {
        document.getElementById('error_file').innerHTML = "File must be uploaded";
        check = false;
    } else {
        document.getElementById('error_file').innerHTML = "";
    }

    if (check && !duplicated) {
        document.getElementById('error_namecourse').innerHTML = "";
        document.getElementById('error_datetime').innerHTML = "";
        document.getElementById('error_file').innerHTML = "";
    }
    console.log(check, !duplicated);
    return check && !duplicated;
}

function existedCourse() {
    var name_course = document.forms["course"]["fname"].value;

    fetch("/web_chiasekienthuc/manage/existedCourse.php?name_course=" + name_course).then(
        res => res.json()
    ).then(
        data => {
            if (data['nameDuplicated']) {
                document.getElementById("error_namecourse").innerHTML = "Id is existed";
                duplicated = true;
            } else {
                document.getElementById("error_namecourse").innerHTML = "";
                duplicated = false;
            }

        }
    );
}