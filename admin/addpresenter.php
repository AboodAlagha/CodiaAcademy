<?php
session_start();
if (!isset($_SESSION['id'])) {
    header('Location:../login.php');
} elseif ($_SESSION['role'] == 'user') {
    header('Location:../index.php');
} elseif ($_SESSION['role'] == 'presenter') {
    header('Location:index.php');
}
?>
<?php
include 'header.php';
?>
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="row">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <div class="col-sm-8">
                <h1 class="h3">
                </h1>
            </div>
        </div>
        <?php
        if (isset($_POST['submit']) && !empty($_POST['username']) && !empty($_POST['email']) && !empty($_POST['password'])) {
            $username = $_POST['username'];
            $email = $_POST['email'];
            $password = md5(md5($_POST['password']));
            include 'config.php';
            $sqlregister = "SELECT users.* FROM `users` WHERE `email`='$email' and `username` = '$username'";
            $result = mysqli_query($config, $sqlregister);
            $sqlregister1 = "SELECT users.* FROM `users` WHERE `email`='$email'";
            $result1 = mysqli_query($config, $sqlregister1);
            $sqlregister2 = "SELECT users.* FROM `users` WHERE `username`='$username'";
            $result2 = mysqli_query($config, $sqlregister2);
            if (mysqli_num_rows($result) > 0) {
                $error = '
            <div class="mb-3">
                    <div class="alert alert-danger d-flex align-items-center w-100"  role="alert">
                        <div>
                            <span class="text-danger">هذا الحساب مستخدم من قبل</span>
                        </div>
                        <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                </div>
            ';
            } elseif (mysqli_num_rows($result1) > 0) {
                $error = '<div class="mb-3">
            <div class="alert alert-danger d-flex align-items-center w-100"  role="alert">
                <div>
                    <span class="text-danger">هذا البريد مستخدم من قبل</span>
                </div>
                <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        </div>';
            } elseif (mysqli_num_rows($result2) > 0) {
                $error = '
            <div class="mb-3">
                    <div class="alert alert-danger d-flex align-items-center w-100"  role="alert">
                        <div>
                            <span class="text-danger">اسم المستخدم مستخدم من قبل</span>
                        </div>
                        <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                </div>';
            } else {
                $sqlregister = "INSERT INTO `users`(`username`, `email`, `password`,`role`) VALUES ('$username','$email','$password','presenter')";
                $result = mysqli_query($config, $sqlregister);
                if (!$result) {
                    $error =
                        '
                    <div class="col-sm-12">
                            <div class="alert alert-danger d-flex align-items-center w-50"  role="alert">
                                <div>
                                    <span class="text-danger">حدث خطأ ما</span>
                                </div>
                                <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert" aria-label="Close"></button>
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
        }
        ?>
        <form action="" method="post" enctype="multipart/form-data">
            <div class="row mb-3">
                <?php if (isset($error)) echo $error; ?>
            </div>
            <div class="row">
                <div class="col-sm-6 mb-3">
                    <label for="name" class="form-label">البريد الالكتروني للمحاضر</label>
                    <input type="email" class="form-control w-75 text-start" id="email" name="email">
                </div>
                <div class="col-sm-6 mb-3">
                    <label for="name" class="form-label">اسم المستخدم</label>
                    <input type="text" class="form-control w-75 text-start" id="username" name="username">
                </div>
                <div class="col-sm-6 mb-3">
                    <label for="name" class="form-label">كلمة المرور المحاضر</label>
                    <input type="password" class="form-control w-75 text-start" id="password" name="password">
                </div>
            </div>
            <div class="mb-3">
                <button type="submit" name="submit" class="btn btn-success" style="width: 100px;">اضافة</button>
                <a href="course.php" class="btn btn-secondary">الغاء</a>

            </div>
        </form>
    </div>
</main>
<?php
include 'footer.php';
?>