
<!doctype html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.101.0">
    <title>Codia Academy</title>
    <link rel="canonical" href="../css/dashboard.css">
    <link href="../css/bootstrap.rtl.min.css" rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Quicksand:wght@500&family=Tajawal&display=swap');

        * {
            font-family: 'Tajawal', sans-serif;

        }

        .nav-link {
            color: #212529;
        }

        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }

        .b-example-divider {
            height: 3rem;
            background-color: rgba(0, 0, 0, .1);
            border: solid rgba(0, 0, 0, .15);
            border-width: 1px 0;
            box-shadow: inset 0 .5em 1.5em rgba(0, 0, 0, .1), inset 0 .125em .5em rgba(0, 0, 0, .15);
        }

        .b-example-vr {
            flex-shrink: 0;
            width: 1.5rem;
            height: 100vh;
        }

        .bi {
            vertical-align: -.125em;
            fill: currentColor;
        }

        .nav-scroller {
            position: relative;
            z-index: 2;
            height: 2.75rem;
            overflow-y: hidden;
        }

        .nav-scroller .nav {
            display: flex;
            flex-wrap: nowrap;
            padding-bottom: 1rem;
            margin-top: -1px;
            overflow-x: auto;
            text-align: center;
            white-space: nowrap;
            -webkit-overflow-scrolling: touch;
        }
    </style>

</head>

<body>

    <header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-2 shadow">
        <a class="navbar-brand col-md-3 col-lg-2 me-0 px-4 fs-5" href="../index.php">أكاديمية كوديا</a>
        <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="عرض/إخفاء لوحة التنقل">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="navbar-nav">
            <div class="nav-item text-nowrap">
                <a class="px-3 btn btn-success" href="../logout.php">تسجيل الخروج</a>
            </div>
        </div>
    </header>
    <div class="container-fluid">
        <div class="row">
            <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
                <div class="position-sticky pt-3 sidebar-sticky">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="index.php">
                                <span data-feather="home" class="align-text-bottom"></span>
                                لوحة القيادة
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="about.php">
                                <span data-feather="file" class="align-text-bottom"></span>
                                من نحن
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="benefits.php">
                                <span data-feather="file" class="align-text-bottom"></span>
                                الفوائد
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="course.php">
                                <span data-feather="file" class="align-text-bottom"></span>
                                الكورسات
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="lessons.php">
                                <span data-feather="file" class="align-text-bottom"></span>
                                الدروس
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="feedback.php">
                                <span data-feather="file" class="align-text-bottom"></span>
                                الااراء
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="order.php">
                                <span data-feather="users" class="align-text-bottom"></span>
                                طلبات اشتراك
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="subscribers.php">
                                <span data-feather="users" class="align-text-bottom"></span>
                                المشتركون
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="presenter.php">
                                <span data-feather="bar-chart-2" class="align-text-bottom"></span>
                                المحاضرين
                            </a>
                        </li>
                        
                    </ul>
                    <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted text-uppercase">
                        <span>الاعدادات</span>
                        <a class="link-secondary" href="#" aria-label="إضافة تقرير جديد">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-gear" viewBox="0 0 16 16">
                                <path d="M8 4.754a3.246 3.246 0 1 0 0 6.492 3.246 3.246 0 0 0 0-6.492zM5.754 8a2.246 2.246 0 1 1 4.492 0 2.246 2.246 0 0 1-4.492 0z" />
                                <path d="M9.796 1.343c-.527-1.79-3.065-1.79-3.592 0l-.094.319a.873.873 0 0 1-1.255.52l-.292-.16c-1.64-.892-3.433.902-2.54 2.541l.159.292a.873.873 0 0 1-.52 1.255l-.319.094c-1.79.527-1.79 3.065 0 3.592l.319.094a.873.873 0 0 1 .52 1.255l-.16.292c-.892 1.64.901 3.434 2.541 2.54l.292-.159a.873.873 0 0 1 1.255.52l.094.319c.527 1.79 3.065 1.79 3.592 0l.094-.319a.873.873 0 0 1 1.255-.52l.292.16c1.64.893 3.434-.902 2.54-2.541l-.159-.292a.873.873 0 0 1 .52-1.255l.319-.094c1.79-.527 1.79-3.065 0-3.592l-.319-.094a.873.873 0 0 1-.52-1.255l.16-.292c.893-1.64-.902-3.433-2.541-2.54l-.292.159a.873.873 0 0 1-1.255-.52l-.094-.319zm-2.633.283c.246-.835 1.428-.835 1.674 0l.094.319a1.873 1.873 0 0 0 2.693 1.115l.291-.16c.764-.415 1.6.42 1.184 1.185l-.159.292a1.873 1.873 0 0 0 1.116 2.692l.318.094c.835.246.835 1.428 0 1.674l-.319.094a1.873 1.873 0 0 0-1.115 2.693l.16.291c.415.764-.42 1.6-1.185 1.184l-.291-.159a1.873 1.873 0 0 0-2.693 1.116l-.094.318c-.246.835-1.428.835-1.674 0l-.094-.319a1.873 1.873 0 0 0-2.692-1.115l-.292.16c-.764.415-1.6-.42-1.184-1.185l.159-.291A1.873 1.873 0 0 0 1.945 8.93l-.319-.094c-.835-.246-.835-1.428 0-1.674l.319-.094A1.873 1.873 0 0 0 3.06 4.377l-.16-.292c-.415-.764.42-1.6 1.185-1.184l.292.159a1.873 1.873 0 0 0 2.692-1.115l.094-.319z" />
                            </svg>
                        </a>
                    </h6>
                    <ul class="nav flex-column mb-2">
                        <li class="nav-item">
                            <a class="nav-link" href="../profile.php">
                                <span data-feather="file-text" class="align-text-bottom"></span>
                                الحساب
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="users.php">
                                <span data-feather="file-text" class="align-text-bottom"></span>
                                المستخدمين
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../register.php">
                                <span data-feather="file-text" class="align-text-bottom"></span>
                                مستخدم جديد
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../reset_password.php">
                                <span data-feather="file-text" class="align-text-bottom"></span>
                                تغير كلمة المرور
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>