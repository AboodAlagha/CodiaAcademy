<?php
include "include/header.php";
include 'admin/config.php';
if (!isset($_SESSION['id'])) {
    header('Location:login.php');
}

$user = "SELECT * FROM `users` where id = " . $_SESSION['id'];
$resalt = mysqli_query($config, $user);
$userdata = mysqli_fetch_assoc($resalt);

$userId = $userdata['id'];
$courseid = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
$chec = "SELECT * FROM `order` WHERE user_id =$userId and course_id = " . $courseid . ";";
$resaltchec = mysqli_query($config, $chec);
$checdata = mysqli_fetch_assoc($resaltchec);
if (mysqli_num_rows($resaltchec) > 0) {
    echo "<script>window.location.href='course'</script>";
}
if (isset($_GET['id'])) {
    $sql2 = "SELECT * FROM `course` where id = " . $courseid . ";";
    $res2 = mysqli_query($config, $sql2);
    $data2 = mysqli_fetch_assoc($res2);
}
if (isset($_POST['submit1'])) {
    $discount_code = $_POST['code'];
    $sql = "SELECT * FROM `discount_code` where code = '$discount_code';";
    $res = mysqli_query($config, $sql);
    if (mysqli_num_rows($res) == 0) {
        $error1 =
            '
                <div>
                    <span class="text-danger">كود الخصم غير متاح حاليا.</span>
                </div>
            ';
    } else {
        $error1 =  '
                    <div class="col-sm-12">
                    <div class="alert alert-success d-flex align-items-center w-50"  role="alert">
                        <div>
                            <span class="text-success">تمت عملية الخصم</span>
                        </div>
                        <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                </div>
                ';
    }
    $data = mysqli_fetch_assoc($res);
}




if (isset($_POST['subscribe']) && !empty($_POST['name']) && !empty($_POST['email']) && !empty($_POST['phone'])) {
    $course_id = $data2['id'];
    $user_id = $userdata['id'];
    if (isset($_POST['code'])) {
        $code = $_POST['code'];
        $checkout = "INSERT INTO `order`(`course_id`, `user_id`, `discount_code`, `status`) VALUES ('$course_id','$user_id','$code','0');";
        $checkoutres = mysqli_query($config, $checkout);
    } else {
        $checkout = "INSERT INTO `order`(`course_id`, `user_id`, `status`) VALUES ('$course_id','$user_id','0');";
        $checkoutres = mysqli_query($config, $checkout);
    }

    if (!$checkoutres) {
        $error =
            '
                    <div class="col-sm-12">
                            <div class="alert alert-danger d-flex align-items-center w-50"  role="alert">
                                <div>
                                    <span class="text-danger">حدث خطأ ما</span>
                                </div>
                                <button type="button" class ="btn-close ms-auto" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        </div>
                    ';
    } else {
        $error =  '
                    <div class="col-sm-12">
                    <div class="alert alert-success d-flex align-items-center w-50"  role="alert">
                        <div>
                            <span class="text-success">تمت العملية بنجاح</span>
                        </div>
                        <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                </div>
                ';
    }
}
?>

<div class="container mt-5">
    <main>

        <div class="row g-3">
            <div class="col-md-5 col-lg-4 order-md-last">
                <h4 class="d-flex justify-content-between align-items-center mb-3">
                    <span class="text-muted">عربة التسوق</span>
                    <span class="badge bg-secondary rounded-pill">1</span>
                </h4>
                <ul class="list-group mb-3 mt-5">
                    <li class="list-group-item d-flex justify-content-between lh-sm">
                        <div>
                            <h6 class="my-0">
                                <?php
                                if (isset($data2['name'])) {
                                    echo $data2['name'];
                                }
                                ?>
                            </h6>
                        </div>
                        <span class="text-muted">
                            <?php
                            if (isset($data2['price'])) {
                                echo $data2['price'] . "$";
                            }
                            ?>
                        </span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between bg-light">
                        <div class="text-success">
                            <h6 class="my-0">رمز ترويجي</h6>
                            <small class=" discount_code">
                                <?php
                                if (isset($discount_code)) {
                                    echo $discount_code;
                                } else {
                                    echo 'EXAMPLECODE';
                                }
                                ?>
                            </small>
                        </div>
                        <span class="text-success discount_value">
                            <?php if (isset($data['value'])) {
                                echo '-' . $data['value'] . '$';
                            } else {
                                echo '-0$';
                            } ?>
                        </span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between">
                        <span>مجموع (USD)</span>
                        <strong class="value">
                            <?php
                            if (isset($data['value']) && isset($data2['price'])) {
                                echo  $data2['price'] - $data['value'] . '$';
                            } else {
                                echo $data2['price'] . '$';
                            }
                            ?>
                        </strong>
                    </li>
                </ul>
                <div class="row mt-3">
                    <?php if (isset($error1)) echo $error1; ?>
                </div>
            </div>
            <div class="col-md-7 col-lg-8">
                <h4 class="mb-3">اشتراك في كورس امن المعلومات</h4>

                <form class="needs-validation" method="POST">
                    <div class="row g-3">
                        <div class="row mt-3 w-100">
                            <?php if (isset($error)) echo $error; ?>
                        </div>
                        <div class="col-sm-6">
                            <label for="firstName" class="form-label">الاسم كامل</label>
                            <input type="text" class="form-control" id="firstName" value="<?php if (isset($userdata['name'])) echo $userdata['name'];  ?>" name="name">
                            <div class="invalid-feedback">
                                يرجى إدخال الاسم صحيح.
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <label for="email" class="form-label">البريد الإلكتروني </label>
                            <input type="email" class="form-control text-start" id="email" name="email" placeholder="you@example.com" value="<?php if (isset($userdata['email'])) echo $userdata['email'];  ?>">
                            <div class="invalid-feedback">
                                يرجى إدخال عنوان بريد إلكتروني صحيح
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <label for="phone" class="form-label">رقم الهاتف</label>
                            <input type="number" class="form-control text-start" id="phone" name="phone" placeholder="00970 568774605" value="<?php if (isset($userdata['phone'])) echo $userdata['phone'];  ?>" required>
                            <div class="invalid-feedback">
                                يرجى إدخال رقم الهاتف الخاص بك.
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <label for="phone" class="form-label">العنوان</label>
                            <input type="text" class="form-control text-start" id="address" name="address" placeholder="" value="<?php if (isset($userdata['address'])) echo $userdata['address'];  ?>" required>
                            <div class="invalid-feedback">
                                يرجى إدخال العنوان الخاص بك.
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <label for="phone" class="form-label">المدينة</label>
                            <input type="text" class="form-control text-start" id="city" name="city" placeholder="" value="<?php if (isset($userdata['city'])) echo $userdata['city'];  ?>" required>
                            <div class="invalid-feedback">
                                يرجى إدخال المدينة الخاص بك.
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <label for="phone" class="form-label">كود الخصم</label>
                            <div class="input-group">
                                <input type="text" class="form-control discount" name="code" placeholder="">
                                <button type="submit" name="submit1" class="btn btn-secondary">تحقق</button>
                            </div>
                        </div>
                        <div class="col-12 ">
                            <label for="course" class="form-label">اسم الكورس:</label>
                            <input type="text" class="form-control" name="course" id="course" placeholder="<?php if (isset($data2['name'])) echo $data2['name']; ?>" disabled>
                        </div>
                    </div>
                    <button class="w-75 btn btn-primary mt-4" type="submit" name="subscribe">الاستمرار بالدفع</button>
                </form>
            </div>
        </div>
    </main>
</div>

<?php
include "include/footer.php";
?>