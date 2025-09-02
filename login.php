<?php
if (isset($_POST['login']) && !empty($_POST['email']) && !empty($_POST['password'])) {
    $email = $_POST['email'];
    $password = md5(md5($_POST['password']));
    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo ("خطأ في البريد الالكتروني");
    } elseif (empty($password)) {
        $inputError = "Enter Your Password";
    } else {
        include 'admin/config.php';
        $sqlLogin = "SELECT users.* FROM `users` WHERE `email`='$email' and `password` = '$password';";
        $result = mysqli_query($config, $sqlLogin);
        if (mysqli_num_rows($result) == 0) {
            $error =
                '
            <div class="mb-3">
                    <div class="alert alert-danger d-flex align-items-center w-50"  role="alert">
                        <div>
                            <span class="text-danger">خطأ في البريد الالكتروني او كلمة المرور</span>
                        </div>
                        <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                </div>
            ';
        } else {
            $user = mysqli_fetch_assoc($result);
            session_start();
            $_SESSION['id'] = $user['id'];
            $_SESSION['role'] = $user['role'];
            $_SESSION['username'] = $user['username'];
            header('Location:index.php');
        }
    }
}

include "include/header.php";
?>
<main class="container-fluid d-flex justify-content-center align-items-center">
    <div class="row container-fluid d-flex justify-content-center align-items-center mt-5">
        <div class="col-md-8 col-sm-12 ">
            <form method="POST">
                <h2 class="mb-4">تسجيل دخول</h2>
                <?php if (isset($error)) echo $error; ?>
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">البريد الالكتروني:</label>
                    <input type="email" name="email" class="form-control w-50 text-start rounded-pill" id="exampleFormControlInput1" placeholder="name@example.com">
                    <span class="text-danger"><?php if (isset($inputError)) echo $inputError; ?></span>
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">كلمة السر:</label>
                    <input type="password" name="password" class="form-control w-50 rounded-pill" id="exampleFormControlInput1" placeholder="********">
                    <span class="text-danger"><?php if (isset($inputError)) echo $inputError; ?></span>
                </div>
                <div class="mb-3">
                    <a href="" class="pe-2">هل نسيت كلمة المرور؟</a>
                </div>
                <button type="submit" name="login" class="btn btn-success w-50 rounded-pill mb-3">تسجيل دخول</button>
                <div class="mb-3">
                    ليس لديك حساب؟ <a href="register" class="pe-2">انشاء حساب جديد</a>
                </div>
            </form>
        </div>
        <div class="col-md-4 col-sm-12 d-flex justify-content-center align-items-center mt-5">
            <img src="images/login_pdn4.svg" width="350px" alt="">
        </div>
    </div>
</main>

<?php
include "include/footer.php";
?>