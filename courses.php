<?php
include "include/header.php";
?>
<main class="container">
    <div class="row d-flex justify-content-center align-items-center mb-1">
        <div class="col-md-6 col-sm-12 d-flex justify-content-center align-items-center">
            <div class="text-end  mb-5">
                <h1 class="header-title">تعرض جميع الكورسات هنا.</h1>
            </div>
        </div> 
        <!-- <div class="col-md-6 col-sm-12 d-flex justify-content-center align-items-center">
            <div class="text-end mb-5">
                <div class="input-group">
                    <input type="search" class="form-control" placeholder="ابحث هنا...">
                    <button class="input-group-text" style="background-color: #086f71;" id="basic-addon1"><i class="fa-solid fa-magnifying-glass" style="color: #fff;"></i></button>
                </div>
            </div>
        </div> -->
    </div>
    <div class="row d-flex justify-content-center align-items-center">
        <?php
        include "admin/config.php";
        $sql = "select * from course;";
        $result = mysqli_query($config, $sql);
        if (mysqli_num_rows($result) > 0) {
            foreach ($result as $key => $row) {
                echo '
                        <div class="col-md-4 col-sm-10 d-flex justify-content-center align-items-center mb-2">
                            <div class="card" style="width: 20rem; height: 473px; ">
                                <img src="images/' . $row['image'] . '" class="card-img-top" alt="' . $row['name'] . '" width="300px" height="400px">
                                <div class="card-body">
                                    <h5 class="card-title">' . $row['name'] . '</h5>
                                    <p style="overflow: hidden; max-height: 105px !important;">' . $row['description'] . '</p>
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
</main>
<?php
include 'include/footer.php';
?>