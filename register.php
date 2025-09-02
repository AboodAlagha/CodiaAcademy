<?php
if (isset($_POST['submit']) && !empty($_POST['email']) && !empty($_POST['password']) && !empty($_POST['username'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $uppercase = preg_match('@[A-Z]@', $password);
    $lowercase = preg_match('@[a-z]@', $password);
    $number    = preg_match('@[0-9]@', $password);
    $username = htmlspecialchars($_POST['username']);
    if (!$uppercase && !$lowercase && !$number && strlen($password) < 8) {
        $passError =
            "خطأ في كلمة المرور
        <ul>
            <li>يجب ألا يقل عدد الأحرف عن 8 أحرف</li>
            <li>يجب أن يحتوي على رقم واحد على الأقل</li>
            <li>يجب أن يحتوي على حرف كبير واحد على الأقل</li>
            <li>يجب أن يحتوي على حرف صغير واحد على الأقل</li>
        </ul>
        ";
    } else {
        $newpassword = md5(md5($password));
    }
    if (empty($email) ||  !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $emailError = "خطأ في البريد الإلكتروني";
    } elseif (empty($username) || !filter_var($username, FILTER_SANITIZE_STRING)) {
        $inputError = "يرجي ادخال اسم المستخدم";
    } else {
        include 'admin/config.php';
        $sqlregister = "SELECT users.* FROM `users` WHERE `email`='$email' and `username` = '$username';";
        $result = mysqli_query($config, $sqlregister);
        $sqlregister1 = "SELECT users.* FROM `users` WHERE `email`='$email';";
        $result1 = mysqli_query($config, $sqlregister1);
        $sqlregister2 = "SELECT users.* FROM `users` WHERE `username`='$username';";
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
            $sqlregister = "INSERT INTO `users`(`username`, `email`, `password`) VALUES ('$username','$email','$newpassword');";
            $result = mysqli_query($config, $sqlregister);
            if ($result) {
                echo "<script>window.location.href='login'</script>";
            }
        }
    }
} elseif (isset($_POST['submit']) && empty($_POST['email']) && empty($_POST['password']) && empty($_POST['username'])) {
    $error = '
            <div class="mb-3">
                    <div class="alert alert-danger d-flex align-items-center w-100"  role="alert">
                        <div>
                            <span class="text-danger">يرجى منك عدم ترك اي من الحقول التالية فارغة</span>
                        </div>
                        <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                </div>
            ';
}
?>
<?php
include "include/header.php";
?>
<main class="container-fluid d-flex justify-content-center align-items-center">

    <div class="row container-fluid d-flex justify-content-center align-items-center ">
        <div class="col-md-4 col-sm-12 d-flex justify-content-center align-items-center mt-5">
            <img src="images/undraw_Profile_re_4a55.png" width="450px" alt="">
        </div>
        <div class="col-md-8 col-sm-12 d-flex justify-content-center align-items-center mt-5">
            <form method="POST" action="">
                <h2 class="mb-4">مرحبا بك ، تسجيل حساب جديد</h2>
                <?php if (isset($error)) echo $error; ?>
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">البريد الالكتروني:</label>
                    <input type="email" name="email" class="form-control w-100 text-start rounded-pill" id="exampleFormControlInput1" placeholder="name@example.com">
                    <span class="text-danger">
                        <?php if (isset($emailError)) echo $emailError; ?>
                    </span>
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label"> اسم المستخدم:</label>
                    <input type="text" name="username" class="form-control w-100 text-start rounded-pill" placeholder="@name_example">
                    <span class="text-danger">
                        <?php if (isset($inputError)) echo $inputError; ?>
                    </span>
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">كلمة المرور:</label>
                    <input type="password" name="password" class="form-control w-100 rounded-pill" placeholder="********">
                    <span class="text-danger">
                        <?php if (isset($passError)) echo $passError; ?>
                    </span>
                </div>
                <button type="submit" name="submit" class="btn btn-success w-100 rounded-pill mb-3">تسجيل جديد</button>
                <div class="mb-3">
                    هل لديك حساب؟ <a href="login" class="pe-2">تسجيل دخول</a>
                </div>
            </form>
        </div>
    </div>
</main>

<?php
include "include/footer.php";
?>