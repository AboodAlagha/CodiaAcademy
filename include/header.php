<?php
session_start();
?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="موقع عربي كورسات">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.c
    om/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdn.plyr.io/3.7.2/plyr.css" />

    <link rel="stylesheet" href="css/bootstrap.rtl.min.css">
    <link rel="shortcut icon" href="images/logo.png" type="image/x-icon">
    <!-- <link rel="stylesheet" href="css/swiper.css"> -->
    <link rel="stylesheet" href="css/swiper-bundle.min.css">
    <title>Codia Academy</title>
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-light">
            <div class="container-fluid">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse navPages" id="navbarSupportedContent">
                    <a class="navbar-brand mt-5 mt-lg-0" href="#">
                        <img src="images/logo.png" height="45" alt="Codia Academy Logo">
                    </a>
                    <ul class="navbar-nav me-auto ms-3 mb-lg-0 ">
                        <li><a href="index">الرئيسية</a></li>
                        <li><a href="courses">الكورسات</a></li>
                        <li><a href="index#about">من نحن</a></li>                        
                    </ul>
                </div>
                <?php
                if (isset($_SESSION['id'])) {
                    if ($_SESSION['role'] == 'admin' or $_SESSION['role'] == 'presenter') {
                        echo '
                    <div class="d-flex align-items-center ">
                        <div class="btn-group dropstart navbar-nav">
                            <a type="button" href="#" class=" nav-link" data-bs-toggle="dropdown" aria-expanded="false">
                            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-person" viewBox="0 0 16 16">
                                <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z"/>
                            </svg> ' . $_SESSION['username'] . '
                            </a>
                            <ul class="dropdown-menu p-2">
                                <li><a class="dropdown-item" href="profile">حسابي</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item" href="admin/index">لوحدة التحكم</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item" href="logout">تسجيل خروج</a></li>
                            </ul>
                        </div>
                    </div>';
                    } elseif ($_SESSION['role'] == 'user') {
                        echo '
                    <div class="d-flex align-items-center ">
                        <div class="btn-group dropstart navbar-nav">
                            <a type="button" class=" nav-link" data-bs-toggle="dropdown" aria-expanded="false">
                            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-person" viewBox="0 0 16 16">
                                <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z"/>
                            </svg>
                            </a>
                            <ul class="dropdown-menu p-2">
                                <li><a class="dropdown-item" href="profile">' . $_SESSION['username'] . '</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item" href="logout">تسجيل خروج</a></li>
                            </ul>
                        </div>
                    </div>';
                    }
                } else {
                    echo '<div class="d-flex">
                    <div class="d-flex w-auto">
                    <div class="navUser">
                    <ul>
                        <li><a href="register">سجل مجانا</a></li>
                        <li><a href="login">تسجيل دخول</a></li>
                    </ul>
                </div>
                    </div>
                </div>';
                }
                ?>

                <!-- Right elements -->
            </div>
            <!-- Container wrapper -->
        </nav>
        <!-- Navbar -->
        <!-- Background image -->