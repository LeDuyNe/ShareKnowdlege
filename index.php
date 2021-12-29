<?php
session_start();
//tiến hành kiểm tra là người dùng đã đăng nhập hay chưa
//nếu chưa, chuyển hướng người dùng ra lại trang đăng nhập
if (!isset($_SESSION['username'])) {
    header('location: ../login.php');
}

?>
<?php
// File kết nối với database
include('../connect.php');
//  utf-8 hiển thị tiếng Việt
header('Content-Type: text/html; charset=UTF-8');
// Đặt các giá trị
$username = $password = "";
$userErr = $alert_success =  "";

if ($_SERVER["REQUEST_METHOD"] == "POST" && !array_key_exists("page_layout", $_GET)) {
    $username = $_POST["txtUsername"];
    $password = $_POST["txtPassword"];
    //làm sạch thông tin, xóa bỏ các tag html, ký tự đặc biệt 
    //mà người dùng cố tình thêm vào để tấn công theo phương thức sql injection
    $username = strip_tags($username);
    $username = addslashes($username);
    $password = strip_tags($password);
    $password = addslashes($password);

    // $password = md5($password);
    if ($username == "" || $password == "") {
        $_SESSION['userError'] = 'Please enter your account or password';
    } else {
        if ($username !== 'admin' || $password !== '123456789') {
            $_SESSION['userError'] = 'Account or password is incorrect !';
        } else {
            //tiến hành lưu tên đăng nhập vào session để tiện xử lý sau này
            $_SESSION['username'] = $username;
        }
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MANAGE</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/base.css">
    <link rel="stylesheet" href="../assets/css/contact.css">
    <link rel="stylesheet" href="../assets/css/main.css">
    <link rel="stylesheet" href="../assets/css/manage.css">

    <link rel="stylesheet" href="../assets/font/fontawesome-free-5.15.2/css/all.min.css">
    <link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">
    <link rel="stylesheet" href="../assets/css/table.css">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <!-- AJAX -->
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
</head>

<body>
    <div class="main">
        <div class="header">
            <div class="overlay"></div>
            <div class="grid">
                <nav class="header__navbar">
                    <ul class="header__navbar-list">
                        <li class="header__navbar-item header__navbar-user">
                            <img src="../assets/img/avatar.jpg" alt="" class="header__navbar-user-img">

                            <span class="header__navbar-user-name">
                                <?php echo  $_SESSION['username']; ?>
                            </span>

                            <ul class="header__navbar-user-menu">
                                <li class="header__navbar-user-item"><a href="./logout.php">
                                        Log out</a></li>
                            </ul>
                        </li>
                </nav>
            </div>

            <div class="header__introduce">
                <!-- <h1>Manage</h1> -->
            </div>
        </div>


    </div>
    </div>
    <div class="container" style="min-width:100%;margin:0;">
        <div class="grid">
            <div class="grid__row content">
                <div class="gird__column-3 gird__column-3-sm">
                    <nav class="category">
                        <h3 class="category__heading">MENU</h3>

                        <ul class="category-list">
                            <li class="category-item category-item--active">
                                <a href="index.php?page_layout=information" class="category-item__link 
                                    <?php $cate = $_GET['page_layout'] ? $_GET['page_layout'] : '';
                                    if (isset($cate) and $cate == 'information')
                                        echo 'category-item__link--active';

                                    ?>">Information</a>
                            </li>

                            <li class="category-item category-item--active">
                                <a href="index.php?page_layout=course" class="category-item__link <?php $cate = $_GET['page_layout'] ? $_GET['page_layout'] : '';
                                                                                                    if (isset($cate) and $cate == 'course')
                                                                                                        echo 'category-item__link--active';

                                                                                                    ?>">Course</a>
                            </li>

                            <li class="category-item category-item--active">
                                <a href="index.php?page_layout=category" class="category-item__link <?php $cate = $_GET['page_layout'] ? $_GET['page_layout'] : '';
                                                                                                    if (isset($cate) and $cate == 'category')
                                                                                                        echo 'category-item__link--active';

                                                                                                    ?>">Category</a>
                            </li>

                            <li class="category-item category-item--active">
                                <a href="index.php?page_layout=question" class="category-item__link <?php $cate = $_GET['page_layout'] ? $_GET['page_layout'] : '';
                                                                                                    if (isset($cate) and $cate == 'question')
                                                                                                        echo 'category-item__link--active';

                                                                                                    ?>">Question</a>
                            </li>
                        </ul>
                    </nav>
                </div>
                <?php
                // trang chủ 
                if (array_key_exists('page_layout', $_GET)) {
                    switch ($_GET["page_layout"]) {
                        case 'info':
                            include_once('information.php');
                            break;
                        case 'course':
                            include_once('course.php');
                            break;
                        case 'add_course':
                            include_once('add_course.php');
                            break;
                        case 'update_course':
                            include_once('update_course.php');
                            break;
                        case 'delete_course':
                            include_once('delete_course.php');
                            break;
                        case 'category':
                            include_once('category.php');
                            break;
                        case 'add_category':
                            include_once('add_category.php');
                            break;
                        case 'update_category':
                            include_once('update_category.php');
                            break;
                        case 'question':
                            include_once('question.php');
                            break;
                        case 'question':
                            include_once('delete_question.php');
                            break;
                    }
                } else {
                    include_once 'index.php';
                }
                ?>
            </div>
        </div>
    </div>

    <div class="footer">
        <div class="grid">
            <div class="footer__list-contanct">
                <ul class="footer__list">
                    <li class="footer__item">
                        <a href="" class="footer__item-link">
                            <i class="fab fa-facebook footer__item-icon"></i>
                            FaceBook
                        </a>
                    </li>

                    <li class="footer__item">
                        <a href="" class="footer__item-link">
                            <i class="fab fa-instagram footer__item-icon"></i>
                            Instagram
                        </a>
                    </li>
                </ul>
            </div>
        </div>

        <div class="footer__bottom">
            <div class="grid">
                <p class="footer__text">DuyLe's Website 2021 </p>
            </div>
        </div>
    </div>
</body>

<script src="https://unpkg.com/boxicons@latest/dist/boxicons.js"></script>
<!-- Bootstrap -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>

</html>