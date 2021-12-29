<!DOCTYPE html>
<html lang="en">

<?php
include_once('connect.php');
// Random ID 
function generateRandomString($length) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}
// Đặt các giá trị 
$NameErr = "";
$EmailErr = "";
$QuestionErr = "";
$alert_success = "";
// Kiểm tra form
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $Name = $_POST["Name"];
    $Email = $_POST["Email"];
    $Question = $_POST["Question"];
    $flag = 1;

    // Check name
    if (empty($Name)) {
        $NameErr = "Please enter full name";
        $flag = 0;
    } else {
        $flag = 1 & $flag;
        $NameErr = "";
    }

    // Check email
    if (empty($Email)) {
        $EmailErr = "Please enter email";
        $flag = 0;
    } else {
        $flag = 1 & $flag;
        $EmailErr = "";
    }

    // Check question
    if (empty($Question)) {
        $QuestionErr = "Please enter question";
        $flag = 0;
    } else {
        $flag = 1 & $flag;
        $QuestionErr = "";
    }
    
    $id_question = generateRandomString(5);
    if ($flag == 1) {
        $addquestion = "
            INSERT INTO contact(id_question, questioner, email, question)
            VALUES (    '$id_question',
                        '$Name',
                        '$Email',
                        '$Question' 
                    )";

        // thực thi câu $sql với biến conn lấy từ file connection.php
        mysqli_query($conn, $addquestion);
        $alert_success =  "Succesfullly";
    }
}
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About me</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="./assets/css/main.css">
    <link rel="stylesheet" href="./assets/css/base.css">
    <link rel="stylesheet" href="./assets/css/contact.css">
    <link rel="stylesheet" href="./assets/font/fontawesome-free-5.15.2/css/all.min.css">
</head>

<body>
    <div class="main">
        <div class="header">
            <div class="overlay"></div>
            <div class="grid">
                <nav class="header__navbar">
                    <ul class="header__navbar-list">
                        <li class="header__navbar-item"><a class="header__navbar-item-link" href="index.php">HOME</a>
                        </li>
                        <li class="header__navbar-item"><a class="header__navbar-item-link" href="about.html">ABOUT</a></li>
                        <!-- <li class="header__navbar-item"><a class="header__navbar-item-link" href="">CATEGORY</a></li> -->
                        <li class="header__navbar-item"><a class="header__navbar-item-link" href="#">CONTACT</a></li>
                        <li class="header__navbar-item"><a class="header__navbar-item-link" href="login.php" target="_blank">MANANGE</a></li>
                    </ul>
                </nav>

                <div class="header__introduce">
                    <!-- <h1>Contact Me</h1> -->
                </div>
            </div>
        </div>

        <div class="container">
            <div class="grid">
                <p>Want to get in touch? Fill out the form below to send me a
                    message and I will get back to you <br> as soon as possible!</p>

                <form action="#" method="POST">
                    <div class="form-controls">
                        <input type="text" id="fname" name="Name" placeholder="Full name">
                    </div>
                    <span class="category-error"><?php echo $NameErr; ?></span>

                    <div class="form-controls">
                        <input type="text" id="email" name="Email" placeholder="Email">
                    </div>
                    <span class="category-error"><?php echo $EmailErr; ?></span>

                    <div class="form-controls">
                        <input type="text"  id="question" name="Question"  placeholder="Question">
                        
                    </div>
                    <span class="category-error"><?php echo $QuestionErr; ?></span>

                    <div class="form-controls">
                        <button><a href="./index.php">RETURN</a></button>
                        <input type="submit" value="ADD">
                    </div>

                    <span class="category-susscess"><?php echo $alert_success; ?></span>

                </form>
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
    </div>
</body>

</html>