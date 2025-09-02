<?php
include "include/header.php";
?>
<div class="container-fluid d-flex justify-content-center align-items-center pt-5">
    <div class="row d-flex justify-content-center align-items-center" style="margin-left: 15px;
    margin-right: 15px;">
        <div class="col-md-6 col-sm-10 d-flex justify-content-center align-items-center">
            <div>
                <h3 class="mb-3 header-title">اطمح، تعلّم، تقدّم</h3>
                <h5 class="mb-3 text-start header-body">قم ببناء مهاراتك العمليّة من خلال الالتحاق ببرامج تدريبيّة
                    متطوّرة،
                    واكتسب مهارات تساعدك للدخول في سوق العمل وتطوير مسيرتك المهنية في مجالات الأمن
                    السيبراني و
                    البرمجة .</h5>
                <a class="header-btn" href="#">اكتشف المزيد</a>
            </div>
        </div>
        <div class="col-md-6 col-sm-10 d-flex justify-content-center align-items-center">
            <div>
                <img src="images/img1672252713.png" alt="header" width="600px" style="border-radius: 12px;">
            </div>
        </div>
    </div>
</div>
<img src="images/wave-svg.png" class="header-bg" width="100%" alt="">
<div class="container-fluid d-flex justify-content-center align-items-center mb-5" style="margin-top: 11rem;">
    <iframe width="1000" height="500" src="https://www.youtube.com/embed/zsggcq07VX0" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
</div>
</header>
<main>
    <div class="container-fluid d-flex justify-content-around align-items-around" style="position: relative;">
        <div class="row d-flex justify-content-around align-items-around w-50 benefits">
            <?php
            include "admin/config.php";
            $sql = "select * from benefits LIMIT 4;";
            $result = mysqli_query($config, $sql);
            if (mysqli_num_rows($result) > 0) {
                foreach ($result as $key => $row) {
                    echo '
                    <div class="col-md-3 col-sm-10">
                        <img src="images/' . $row['image'] . '" class="icon" alt="' . $row['title'] . '">
                        <h4 class="head-ben">' . $row['title'] . '</h4>
                        <p class="body-ben">
                        ' . $row['description'] . '</p>
                    </div>
                        ';
                }
            }
            ?>
        </div>
    </div>
    <div class="container-fluid d-flex justify-content-center align-items-center mt">
        <div class="row" id="about" style="padding: 0 20px 0 20px;">
            <?php
            include "admin/config.php";
            $sql = "select * from about_us LIMIT 1;";
            $result = mysqli_query($config, $sql);
            if (mysqli_num_rows($result) > 0) {
                foreach ($result as $key => $row) {
                    echo '
                    <div class="col-md-6 col-sm-10">
                    <h3 class="header-title about-title">' . $row['title'] . '</h3>
                        <p class="mt-2 h6 fw-bold p-2 header-body">' . $row['description'] . '</p>
                    </div>
                    <div class="col-md-6 col-sm-10 text-center d-flex justify-content-center align-items-center">
                <img src="images/' . $row['image'] . '" width="500px" alt="">
            </div>
                ';
                }
            }
            ?>
        </div>
    </div>
    <div class="container">
        <div class="row d-flex justify-content-center align-items-center">
            <div class="col-md-6 col-sm-10">
                <div class="mb-5">
                    <h1 class="header-title">كورسات</h1>
                </div>
            </div>
            <div class="col-md-6 col-sm-10">
                <div class="text-end mb-5">
                    <a href="courses" style="font-size: 17px;
        font-weight: 800 !important;
        color: #24343F !important;">المزيد <i class="fa-solid fa-arrow-left" style="color: #086f71; font-size: 15px"></i></a>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid d-flex justify-content-center align-items-center mb-5">
        <div class="" id="course">
            <div class="row d-flex justify-content-center align-items-center">
                <?php
                include "admin/config.php";
                $sql = "select * from course lIMIT 4;";
                $result = mysqli_query($config, $sql);
                if (mysqli_num_rows($result) > 0) {
                    foreach ($result as $key => $row) {
                        echo '
                        <div class="col-md-4 col-sm-10 mb-2 d-flex justify-content-center align-items-center">
                            <div class="card card-res" style="width: 25rem; height: 430px;">
                                <img src="images/' . $row['image'] . '" class="card-img-top" alt="' . $row['name'] . '" width="300px" height="400px">
                                <div class="card-body">
                                    <h5 class="card-title">' . $row['name'] . '</h5>
                                    <p style="overflow: hidden; max-height: 120px !important;">' . $row['description'] . '</p>
                                    <span class="float-end" style="color: #F7A24E;">دائم</span>
                                    <span class="float-start">' . $row['hours'] . ' ساعات</span>                                </div>
                                <div class="card-footer d-flex justify-content-center align-items-center">
                                    <a href="course?id=' . $row['id'] . '" class="course-btn">عرض مزيد من التفاصيل</a>
                                </div>
                            </div>
                        </div>
                        ';
                    }
                }
                ?>
            </div>
        </div>
    </div>
</main>
<?php
include 'include/footer.php';
?>