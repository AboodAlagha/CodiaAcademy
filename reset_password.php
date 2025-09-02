<?php
include "include/header.php";
include 'admin/config.php';

if (!isset($_SESSION['id'])) {
    echo "<script>window.location.href='login'</script>";
} elseif (isset($_SESSION['id'])) {
    $user_id = $_SESSION['id'];
    $user = "SELECT * FROM `users` where id ='$user_id'";
    $resalt = mysqli_query($config, $user);
    $userdata = mysqli_fetch_assoc($resalt);
}
if (isset($_POST['reset']) && !empty($_POST['old_password']) && !empty($_POST['new_password'])) {
    $old_password = md5(md5($_POST['old_password']));
    $new_password = md5(md5($_POST['new_password']));
    $sql = "SELECT * FROM `users` where password ='$old_password' and id = " . $_SESSION['id'];
    $resalt1 = mysqli_query($config, $user);
    if (mysqli_num_rows($resalt1) > 0) {
        $mysql = "UPDATE `users` SET `password`='$new_password' where id = " . $_SESSION['id'];
        $resalt_sql = mysqli_query($config, $mysql);
        if (!$resalt_sql) {
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

<main style="height: 1500px; overflow: hidden;">
    <div class="container rounded bg-white mt-5 mb-5">
        <div class="row">
            <div class="col-md-4 border-right">
                <div class="d-flex flex-column align-items-center text-center p-3 py-5">
                    <img class="rounded-circle mt-5" width="150px" src="images/<?php if (isset($userdata['image'])) echo $userdata['image']; ?>">
                    <span class="font-weight-bold"><?php if (isset($userdata['username'])) echo $userdata['username']; ?></span>
                    <span class="text-black-50"><?php if (isset($userdata['email'])) echo $userdata['email']; ?></span>
                    <span>
                        <ul class="list-group mt-2">
                            <li class="list-group-item w-100"><a href="profile" class="text-decoration-none mb-2">اعدادت الحساب</a></li>
                            <li class="list-group-item w-100"><a href="mycourse" class="text-decoration-none mb-2">كورساتي</a></li>
                        </ul>
                    </span>
                </div>
            </div>
            <div class="col-md-8 border-right">
                <div class="p-3 py-5">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h4 class="text-right">تغير كلمة المرور</h4>
                    </div>
                    <div class="row d-flex justify-content-between align-items-center mb-3">
                        <form action="" method="post" enctype="multipart/form-data">
                            <div class="row mb-3">
                                <?php if (isset($error)) echo $error; ?>
                            </div>
                            <div class="row mt-2">
                                <div class="col-md-12 mb-2">
                                    <label class="labels">كلمة المرور القديمة: </label>
                                    <input type="password" name="old_password" class="form-control w-75">
                                </div>
                                <div class="col-md-12 mb-2">
                                    <label class="labels">كلمة المرور الجديد: </label>
                                    <input type="password" name="new_password" class="form-control w-75">
                                </div>
                                <div class="mt-5 text-center">
                                    <button class="btn btn-primary" type="submit" name="reset">حفظ التغيرات</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<?php
include "include/footer.php";
?>