<?php
include "include/header.php";
if (!isset($_SESSION['id'])) {
    echo "<script>window.location.href='login'</script>";
}
if (isset($_SESSION['id'])) {
    include 'admin/config.php';
    $user = 'SELECT * FROM `users` where id =' . $_SESSION['id'];
    $resalt = mysqli_query($config, $user);
    $userdata = mysqli_fetch_assoc($resalt);
}
?>

<main>
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
                        <h4 class="text-right">إعدادات الملف الشخصي</h4>
                    </div>
                    <?php
                    if (isset($_POST['edit'])) {
                        $username = $_POST['username'];
                        $name = $_POST['name'];
                        $email = $_POST['email'];
                        $phone = $_POST['phone'];
                        $address = $_POST['address'];
                        $city = $_POST['city'];
                        $genderr = $_POST['genderr'];
                        if (file_exists($_FILES['image']['tmp_name'])) {
                            $old_img_path = "images/" . $userdata['image'];
                            $new_img_name = $_FILES['image']['name'];
                            $expload_name = explode(".", $new_img_name);
                            $ext = end($expload_name);
                            $imageName = "user" . time() . "." . $ext;
                            move_uploaded_file($_FILES['image']['tmp_name'], 'images/' . $imageName);
                            $sql = "UPDATE `users` SET `username`='$username', `name`='$name' , `email`='$email',`phone`='$phone',`address`='$address',`city`='$city',`genderr`='$genderr',`image`='$imageName' WHERE id=" . $_SESSION['id'];
                            $res = mysqli_query($config, $sql);
                            if (!$res) {
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
                        } else {
                            $sql = "UPDATE `users` SET `username`='$username', `name`='$name' ,`email`='$email',`phone`='$phone',`address`='$address',`city`='$city',`genderr`='$genderr' WHERE id=" . $_SESSION['id'];
                            $res = mysqli_query($config, $sql);
                            if (!$res) {
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
                        <div class="row mt-2">
                            <div class="col-md-6 mb-2">
                                <label class="labels">اسم المسخدم: </label>
                                <input type="text" name="username" class="form-control" value="<?php if (isset($userdata['username'])) echo $userdata['username']; ?>">
                            </div>
                            <div class="col-md-6 mb-2">
                                <label class="labels"> الاسم: </label>
                                <input type="text" name="name" class="form-control" value="<?php if (isset($userdata['name'])) echo $userdata['name']; ?>">
                            </div>
                            <div class="col-md-6 mb-2">
                                <label class="labels">البريد الالكتروني: </label>
                                <input type="email" name="email" class="form-control" value="<?php if (isset($userdata['email'])) echo $userdata['email']; ?>">
                            </div>
                            <div class="col-md-6 mb-2">
                                <label class="labels">كلمة المرور: </label>
                                <a href="reset_password" class="form-control">تغير كلمة المرور</a>
                            </div>
                            <div class="col-md-6 mb-2">
                                <label class="labels">رقم الهاتف : </label>
                                <input type="text" name="phone" class="form-control" value="<?php if (isset($userdata['phone'])) echo $userdata['phone']; ?>">
                            </div>
                            <div class="col-md-6 mb-2">
                                <label class="labels"> العنوان: </label>
                                <input type="text" name="address" class="form-control" value="<?php if (isset($userdata['address'])) echo $userdata['address']; ?>">
                            </div>
                            <div class="col-md-6 mb-2">
                                <label class="labels"> المدينة: </label>
                                <input type="text" name="city" class="form-control" value="<?php if (isset($userdata['city'])) echo $userdata['city']; ?>">
                            </div>
                            <div class="col-md-6 mb-2">
                                <label class="labels"> الجنس: </label>
                                <select class="form-select" name="genderr">
                                    <option value="1" <?php if ($userdata['genderr'] == NULL) echo 'selected'; ?>>غير محدد</option>
                                    <option value="1" <?php if ($userdata['genderr'] == 1) echo 'selected'; ?>>ذكر</option>
                                    <option value="2" <?php if ($userdata['genderr'] == 2) echo 'selected' ?>>انثى</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="labels"> صورة: </label>
                                <input type="file" name="image" class="form-control">
                            </div>
                            <div class="mt-5 text-center">
                                <button class="btn btn-primary" type="submit" name="edit">حفظ التغيرات</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>

<?php
include 'include/footer.php';
?>