<?php
//  Connect dtb
include('../connect.php');
if (!isset($_SESSION['username'])) {
    header('location: ../login.php');
}
$result = mysqli_query($conn, "SELECT * FROM course");

// Random ID 
function generateRandomString($length)
{
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

// Check form
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Set time zone
    date_default_timezone_set('Asia/Ho_Chi_Minh');
    $id_course = generateRandomString(5);
    $Name = $_POST["Name"];
    $Id = $_POST["Id"];
    $FileErr = "";
    // Date time post
    $datetime_update = date("Y-m-d h:i:s");
    $time_post = $_POST['time-post'];
    $date_post = $_POST['date-post'];

    $flag = 1;

    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    $file_type = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    $file_type_allow = array('docx', 'pptx', 'ppt', 'doc', 'xls', 'pdf');

    if (file_exists($target_file)) {
        echo '<script>alert("Sorry, file already exists")</script>';
        $flag = 0;
    } else if ($_FILES["fileToUpload"]["size"] > 2097152) {
        echo '<script>alert("Sorry, your file is too large")</script>';
        $flag = 0;
    } else if (!in_array($file_type,  $file_type_allow)) {
        echo '<script>alert("Sorry, only doc, docx, pptx, ppt and xls")</script>';
        $flag = 0;
    } else {
        $flag = 1 & $flag;
        $FileErr = "";
    }

    // 5. Ktra file và up vào hệ thống
    if ($flag == 1) {
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
            $flag = 1 & $flag;
        } else {
            $flag = 0;
            echo '<script>alert("The file you just uploaded has problems")</script>';
        }
    }


    // IV. Insert into mysql
    if ($flag == 1) {
        $datetime_post = $date_post . ' ' . $time_post;
        $addcourse = "
            INSERT INTO course(id_course, namecourse, id_category, time_update, time_post, file)
            VALUES (    '$id_course',
                        '$Name',
                        '$Id',
                        '$datetime_update',
                        '$datetime_post',
                        '$target_file'   
                    )";

        // thực thi câu $sql với biến conn lấy từ file connection.php
        mysqli_query($conn, $addcourse);
        echo '<script>alert("Succesfullly")</script>';
        header('location: /web_chiasekienthuc/manage/index.php?page_layout=course');
    }
}
?>
<script src="add_course.js"></script>
<script src="update_course.js"></script>
<div class="gird__column-9">
    <div class="user-info">
        <p style="font-size: 20px;font-weight:600;">COURSE</p>
        <!-- Button trigger modal -->
        <div class="category__subnest">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop" style="font-size: 1.6rem; margin: 0px 0px 20px 0px; padding: 8px 20px;">
                ADD
            </button>
        </div>
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th scope="col" style="width: 10%;font-size:14px;">ID</th>
                    <th scope="col" style="width: 30%;font-size:14px;">NAME</th>
                    <th scope="col" style="width: 20%;font-size:14px;">CATEGORY</th>
                    <th scope="col" style="width: 20%;font-size:14px;">TIME UPDATE</th>
                    <th scope="col" style="width: 20%;font-size:14px;">TIME POST</th>
                    <th scope="col" style="width: 5%;font-size:14px;">UPDATE</th>
                    <th scope="col" style="width: 5%;font-size:14px;">DELETE</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($row = mysqli_fetch_array($result)) {
                    ?>
                    <tr>
                        <td style="font-size: 1.4rem;">
                            <?php echo $row['id_course']; ?>
                        </td>
                        <td style="font-size: 1.4rem;">
                            <?php echo $row['namecourse']; ?>
                        </td>
                        <td style="font-size: 1.4rem;">
                            <?php echo $row['id_category'] ?>
                        </td>
                        <td style="font-size: 1.4rem;">
                            <?php echo $row['time_update'] ?>
                        </td>
                        <td style="font-size: 1.4rem;">
                            <?php echo $row['time_post'] ?>
                        </td>

                        <td><a class="category__link" href="/web_chiasekienthuc/manage/index.php?page_layout=update_course&id_course=<?php echo $row['id_course'] ?>&name_course=<?php echo $row['namecourse']; ?>">
                                <i class='bx bxs-edit'></i></a></td>
                        <td><a class="category__link" href="delete_course.php?id_course=<?php echo $row['id_course']; ?>" onClick="return confirm('Do you want to delete ?');">
                                <i class='bx bx-trash-alt'></a></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>


<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel" style="font-size: 1.5rem;">ADD COURSE</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" style="text-align: center; justify-content: center;">
                <form onsubmit="return validateForm_Course();" action="/web_chiasekienthuc/manage/index.php?page_layout=course" method="POST" name="course" enctype="multipart/form-data">
                    <!-- Fill Name Course -->
                    <div class="form-controls">
                        <input type="text" id="fname" name="Name" placeholder="NAME COURSE" onchange="existedCourse();">
                    </div>
                    <span id="error_namecourse" class="category-error"></span>

                    <!--Fill Id Category -->
                    <div class="form-controls">
                        <select name="Id" id="" style="font-size:18px">
                            <?php
                            $sql_Name1 = "SELECT * FROM `category` WHERE 1";
                            $sql_query1 = mysqli_query($conn, $sql_Name1);
                            while ($rows = mysqli_fetch_array($sql_query1)) {
                                ?>
                                <option value="<?php echo $rows['id_category'] ?>"> <?php echo $rows['name'] ?></option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>

                    <!-- Fill date & time post -->
                    <div class="form-controls">
                        <input type="date" id="fdate" name="date-post" class="date-input">
                        <input type="time" id="ftime" name="time-post" class="date-input">
                    </div>
                    <span id="error_datetime" class="category-error"></span>

                    <!-- Fill file -->
                    <div class="form-controls" style="width: 100%; text-align:center;">
                        <input type="file" name="fileToUpload" id="fileUpload" style="font-size: 1.5rem;">
                    </div>
                    <span class="category-error" id="error_file"></span>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Agree</button>
            </div>
            </form>
        </div>
    </div>
</div>