<?php
include "include/header.php";
include "admin/config.php";

if (isset($_GET['id'])) {
    $courseid = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
    $sql = "SELECT course.* , users.id as ID , users.username as Name, users.url FROM `course` Join users on course.user_id = users.id and course.id = " . $courseid . ";";
    $result = mysqli_query($config, $sql);
    if (!mysqli_num_rows($result) > 0) {
        echo "<script>window.location.href='index'</script>";
    }
    $row = mysqli_fetch_assoc($result);
} else {
    echo "<script>window.location.href='index'</script>";
}
?>

<main style="height: 1500px; overflow: hidden;">
    <div class="container-fluid">
        <div class="row">
            <div class="text-center bg-image position-relative" style="background-color:rgb(28,29,31);height: 300px; background-repeat: no-repeat;">
                <div class="position-absolute col-md-4 col-sm-12 d-flex justify-content-center align-items-center" style="right: 5px; top: 70px;">
                    <div class="card" style="width: 20rem; position: relative;">
                        <img src="images/<?php if (isset($row['image'])) echo $row['image']; ?>" class="card-img-top">
                        <div>
                            <div class="card-body text-start">
                                <span class="card-title" style="font-size: 1.5rem;">السعر: <?php if (isset($row['price'])) echo $row['price']; ?>$</span>
                                <div class="card-text">
                                    <a href="checkout?id=<?php if (isset($row['id'])) echo $row['id']; ?>" class="btn btn-success w-100">اشترك الان</a>
                                    <button type="button" class="btn btn-outline-success w-100 mt-2"> للاستفسار والتواصل</button>
                                </div>
                            </div>
                            <div class="card-body fw-bold text-start">
                                <div>
                                    <p>تشمل هذه الدورة:</p>
                                    <ul>
                                        <li>30 ساعة فيديو </li>
                                        <li>اختبار مهارات </li>
                                        <li>وصول كامل مدى الحياة</li>
                                        <li>الوصول على الهاتف المحمول والتلفزيون</li>
                                        <li>استشارات و متابعة شخصية </li>
                                        <li>جوائز و شهادة إتمام</li>
                                    </ul>
                                </div>
                                <div class="d-flex justify-content-center align-items-center">
                                    <a href="#" class="p-1 text-dark">مشاركة</a>
                                    <a href="#" class="p-1 text-dark">اهداء هذا الكورس</a>
                                    <a href="#" class="p-1 text-dark">تطبيق الخصم</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="position-absolute col-md-8 col-sm-10 text-start pe-5 " style="left: 5px; top: 70px;">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb h5">
                            <li class="breadcrumb-item active" style="color: #CEC0FC !important;"><a>تكنولوجيا
                                    المعلومات والبرمجيات</a></li>
                            <li class="breadcrumb-item active" aria-current="page" style="color: #CEC0FC !important;">شهادات تكنولوجيا المعلومات</li>
                            <li class="breadcrumb-item active" aria-current="page" style="color: #CEC0FC !important;">الأمن السيبراني</li>
                        </ol>
                    </nav>
                    <div style=" color: #fff; padding: 10px;" class="mb-5">
                        <h1><?php if (isset($row['name'])) echo $row['name']; ?></h1>
                        <p class="h4">مقدم الكورس: <a href="<?php if (isset($row['url'])) echo $row['url']; ?>" class="text-light"><?php if (isset($row['Name'])) echo $row['Name']; ?></a></p>
                        <br>
                        <div class="h6">
                            <span class="mb-2"><i class="bi bi-star-fill"></i> <i class="bi bi-star-fill"></i> <i class="bi bi-star-fill"></i> <i class="bi bi-star-fill"></i> <i class="bi bi-star-half"></i> (138 تقييم) 418 طالبًا</span>
                            <br>
                            <span><i class="bi bi-patch-exclamation-fill"></i> آخر تحديث: <?php if (isset($row['date'])) echo $row['date']; ?></span> <span class="ms-2">
                                <i class="bi bi-translate"></i><?php if (isset($row['language'])) echo $row['language']; ?></span>
                        </div>
                    </div>
                    <div class="card mt-5">
                        <div class="card-body ">
                            <h5 class="card-title">لماذا هذه الدورة: </h5>
                            <p><?php if (isset($row['description'])) echo $row['description']; ?></p>
                        </div>
                    </div>
                    <?php
                    $courseid = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
                    $sql2 = "select * from lessons where course_id = " . $courseid . ";";
                    $result1 = mysqli_query($config, $sql2);
                    ?>
                    <div class="card mt-5 p-3">
                        <?php
                        if (mysqli_num_rows($result1) > 0) {
                            echo '<p class="h5">محتوى الكورس:</p>';
                        }
                        ?>
                        <div class="list-group h6">
                            <?php
                            if (mysqli_num_rows($result1) > 0) {
                                foreach ($result1 as $key => $data) {
                                    echo '
                                    <a href="video?id=' . $row['id'] . '&&lesson=' . $data['id'] . '" class="list-group-item list-group-item-action mb-2">' . $data['name'] . '</a>
                                    ';
                                }
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>

</main>

<?php
include "include/footer.php";
?>