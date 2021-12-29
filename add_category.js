var duplicated = false;

// CHECK FORM
function validateForm_Category() {
    var id_category = document.forms["category"]["fid"].value;
    var name_category = document.forms["category"]["fname"].value;
    let check = true;

    if (id_category == '') {
        document.getElementById('error_id').innerHTML = "ID must be filled out";
        check = false;
    } else if (!duplicated) {
        document.getElementById('error_id').innerHTML = "";
    }

    if (name_category == '') {
        document.getElementById('error_name').innerHTML = "Name Category must be filled out";
        check = false;
    } else {
        document.getElementById('error_name').innerHTML = "";
    }

    if (check && !duplicated) {
        document.getElementById('error_name').innerHTML = "";
        document.getElementById('error_id').innerHTML = "";
    }

    return check && !duplicated;
}

//  AJAX
function existedCategory() {
    var id_category = document.forms["category"]["fid"].value;

    fetch("/web_chiasekienthuc/manage/existedCategory.php?id=" + id_category).then(
        res => res.text()
    ).then(
        data => {
            if (data.includes('true')) {
                document.getElementById("error_id").innerHTML = "ID is existed";
                duplicated = true;
            } else {
                document.getElementById("error_id").innerHTML = "";
                duplicated = false;
            }
        }
    );
}
