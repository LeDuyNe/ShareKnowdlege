<?php include_once('connect.php') ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HOME</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="./assets/css/base.css">
    <link rel="stylesheet" href="./assets/css/main.css">
    <link rel="stylesheet" href="./assets/font/fontawesome-free-5.15.2/css/all.min.css">
    <link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">
</head>

<body>
    <div class="main">
        <div class="header">
            <div class="overlay"></div>
            <div class="grid">
                <nav class="header__navbar">
                    <ul class="header__navbar-list">
                        <li class="header__navbar-item"><a class="header__navbar-item-link" href="#">HOME</a></li>
                        <li class="header__navbar-item"><a class="header__navbar-item-link" href="./about.html">ABOUT</a></li>
                        <!-- <li class="header__navbar-item"><a class="header__navbar-item-link" href="">CATEGORY</a></li> -->
                        <li class="header__navbar-item"><a class="header__navbar-item-link" href="contact.php">CONTACT</a></li>
                        <li class="header__navbar-item"><a class="header__navbar-item-link" href="login.php" target="_blank">MANANGE</a></li>
                    </ul>
                </nav>

                <div class="header__introduce">
                    <!-- <h1>Knowledge Website</h1> -->
                    <!-- <p>WEBSITE MANANGED BY DUYLE</p> -->
                </div>
            </div>
        </div>

        <div class="container">
            <div class="grid">
                <div class="grid__row content">
                    <div class="gird__column-2">
                        <nav class="category">
                            <h3 class="category__heading">CATEGORY</h3>
                            <ul class="category-list">
                                <li class="category-item category-item--active">
                                    <a href="/web_chiasekienthuc" class="category-item__link">All</a>
                                </li>
                                <?php
                                $sql = "SELECT * FROM category";
                                $query = mysqli_query($conn, $sql);
                                while ($rows = mysqli_fetch_array($query)) {
                                    ?>
                                    <li class="category-item category-item--active">
                                        <a href="/web_chiasekienthuc?category=<?php echo $rows['id_category'] ?>" class="category-item__link"><?php echo $rows['name'] ?></a>
                                    </li>
                                <?php } ?>
                            </ul>
                        </nav>
                    </div>

                    <div class="gird__column-9" >
                        <?php
                        // $sql = "SELECT * FROM hanghoa WHERE MaLoaiHang ='CS'";
                        $query_str = "SELECT * FROM course WHERE time_post <= NOW()";
                        if (array_key_exists('category', $_GET))
                            $query_str = $query_str . " AND id_category='" . $_GET['category'] . "'";

                        $result = mysqli_query($conn, $query_str);
                        mysqli_close($conn);
                        ?>

                        <?php while ($row = mysqli_fetch_array($result)) { ?>

                            <div class="post-preview">
                                <a class="post__course-link" href="<?php echo './manage/' . $row['file'] ?>">
                                    <h2 class="post-title">
                                        <?php echo $row['namecourse'] ?>
                                    </h2>
                                    <h3 class="post-subtitle">

                                    </h3>
                                </a>
                                <p class="post-meta">
                                    Updated on <?php echo $row['time_update'] ?>
                                </p>
                            </div>

                        <?php } ?>
                    </div>

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
