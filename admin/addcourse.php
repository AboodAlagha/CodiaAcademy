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
                    <?php if (isset($_GET['id'])) {
                        echo 'تعديل على كورس';
                    } else {
                        echo 'اضافة كورس جديد';
                    } ?>
                </h1>
            </div>
        </div>
        <?php
        if (isset($_GET['id'])) {
            include "config.php";
            $sqlGetDepData = "select * from course where id=" . $_GET['id'];
            $result = mysqli_query($config, $sqlGetDepData);
            $row = mysqli_fetch_assoc($result);
            if (isset($_POST['edit'])) {
                $name = $_POST['name'];
                $description = $_POST['description'];
                $price = $_POST['price'];
                $language = $_POST['language'];
                $user_id = $_POST['user_id'];
                $hours = $_POST['hours'];
                if (file_exists($_FILES['image']['tmp_name'])) {
                    $old_img_path = "../images/" . $row['image'];
                    unlink($old_img_path);
                    $new_img_name = $_FILES['image']['name'];
                    $expload_name = explode(".", $new_img_name);
                    $ext = end($expload_name);
                    $imageName = "img" . time() . "." . $ext;
                    move_uploaded_file($_FILES['image']['tmp_name'], '../images/' . $imageName);
                    $sql = "UPDATE `course` SET `name`='$name',`description`='$description',`price`='$price',`language`='$language',`user_id`='$user_id',`hours`='$hours',`image`='$imageName' where id=" . $_GET['id'];
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
                    $sql = "UPDATE `course` SET `name`='$name',`description`='$description',`price`='$price',`language`='$language',`user_id`='$user_id',`hours`='$hours' where id=" . $_GET['id'];
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
        }
        if (isset($_POST['submit']) && !empty($_POST['name']) && !empty($_POST['description']) && !empty($_POST['price']) && !empty($_POST['language']) && !empty($_POST['user_id']) && !empty($_POST['hours'])) {
            $name = $_POST['name'];
            $description = $_POST['description'];
            $price = $_POST['price'];
            $language = $_POST['language'];
            $user_id = $_POST['user_id'];
            $hours = $_POST['hours'];
            if (file_exists($_FILES['image']['tmp_name'])) {
                $old_img_name = $_FILES['image']['name'];
                $expload_name = explode(".", $old_img_name);
                $ext = end($expload_name);
                $imageName = "img" . time() . "." . $ext;
                move_uploaded_file($_FILES['image']['tmp_name'], '../images/' . $imageName);
                include 'config.php';
                $sql = "INSERT INTO `course` (`name`, `description`, `price`, `language`, `user_id`, `hours`, `image`) VALUES ('$name','$description','$price','$language','$user_id','$hours','$imageName')";
                $result = mysqli_query($config, $sql);
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
                    <label for="name" class="form-label">اسم الكورس</label>
                    <input type="text" value="<?php if (isset($row['name'])) echo $row['name']; ?>" class="form-control w-75 text-start" id="name" name="name">
                </div>
                <div class="col-sm-6 mb-3">
                    <label for="description" class="form-label">وصف الكورس</label>
                    <textarea class="form-control w-75 text-start" id="description" name="description" rows="3"><?php if (isset($row['description'])) echo $row['description']; ?></textarea>
                </div>
                <div class="col-sm-6 mb-3">
                    <label for="price" class="form-label">السعر</label>
                    <input type="number" value="<?php if (isset($row['price'])) echo $row['price']; ?>" class="form-control w-75 text-start" id="price" name="price">
                </div>
                <div class="col-sm-6 mb-3">
                    <label for="language" class="form-label">لغة الكورس</label>
                    <input type="text" value="<?php if (isset($row['language'])) echo $row['language']; ?>" class="form-control w-75 text-start" id="language" name="language">
                </div>
                <div class="col-sm-6 mb-3">
                    <label for="user_id" class="form-label">مقدم الكورس</label>
                    <select class="form-select w-75" name="user_id">
                        <?php
                        if ($_GET['id']) {
                            include "config.php";
                            $sql1 = "SELECT * FROM `users` where role = 'presenter' or role = 'admin';";
                            $result1 = mysqli_query($config, $sql1);
                            if (mysqli_num_rows($result1) > 0) {
                                $row = mysqli_fetch_assoc($result1);
                                echo
                                '
                                <option value="' . $row['id'] . '">' . $row['username'] . '</option>
                                ';
                            }
                        } else {
                            include "config.php";
                            $sql1 = "SELECT * FROM `users` where role = 'presenter' or role = 'admin';";
                            $result1 = mysqli_query($config, $sql1);
                            if (mysqli_num_rows($result1) > 0) {
                                $key = 0;
                                while ($data = mysqli_fetch_assoc($result1)) {
                                    echo
                                    '
                                <option value="' . $data['id'] . '">' . $data['username'] . '</option>
                                ';
                                }
                            }
                        }
                        ?>

                    </select>
                </div>
                <div class="col-sm-6 mb-3">
                    <label for="hours" class="form-label">عدد ساعات الكورس</label>
                    <input type="number" value="<?php if (isset($row['hours'])) echo $row['hours']; ?>" class="form-control w-75 text-start" id="hours" name="hours">
                </div>
                <div class="col-sm-6 mb-3">
                    <label for="image" class="form-label">صورة الكورس</label>
                    <input type="file" class="form-control w-75 text-start" id="image" name="image">
                </div>
            </div>
            <div class="mb-3">
                <button type="submit" name="<?php if (isset($_GET['id'])) {
                                                echo 'edit';
                                            } else {
                                                echo 'submit';
                                            } ?>" class="btn btn-success" style="width: 100px;"><?php if (isset($_GET['id'])) {
                                                                                                    echo 'تعديل';
                                                                                                } else {
                                                                                                    echo 'حفظ';
                                                                                                } ?></button>
                <a href="course.php" class="btn btn-secondary">الغاء</a>

            </div>
        </form>
    </div>
</main>
<?php
include 'footer.php';
?>