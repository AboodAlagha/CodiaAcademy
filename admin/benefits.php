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
            <div class="">
                <h1 class="h2">لوحة التحكم الخاصة في قسم (الفوائد)</h1>
            </div>
        </div>
        <div class="">
            <?php
            if (isset($_POST['submit']) && !empty($_POST['title']) && !empty($_POST['description'])) {
                $description = $_POST['description'];
                $title = $_POST['title'];
                if (empty($description)) {
                    $inputError = "الرجاء ادخال العنوان";
                } elseif (empty($title)) {
                    $inputError = "الرجاء ادخال الوصف";
                } else {
                    if (file_exists($_FILES['image']['tmp_name'])) {
                        $new_img_name = $_FILES['image']['name'];
                        $expload_name = explode(".", $new_img_name);
                        $ext = end($expload_name);
                        $imageName = "img" . time() . "." . $ext;
                        move_uploaded_file($_FILES['image']['tmp_name'], '../images/' . $imageName);
                        include 'config.php';
                        $sql = "INSERT INTO `benefits`(`title`, `description`,`image`) VALUES ('$title','$description' ,'$imageName')";
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
            }
            if (isset($_GET['id'])) {
                include "config.php";
                $sql2 = "SELECT * FROM `benefits` where id =" . $_GET['id'];
                $result2 = mysqli_query($config, $sql2);
                $data = mysqli_fetch_assoc($result2);
                if (isset($_POST['edit'])) {
                    $description = $_POST['description'];
                    $title = $_POST['title'];
                    if (file_exists($_FILES['image']['tmp_name'])) {
                        $old_img_path = "../images/" . $data['image'];
                        unlink($old_img_path);
                        $new_img_name = $_FILES['image']['name'];
                        $expload_name = explode(".", $new_img_name);
                        $ext = end($expload_name);
                        $imageName = "img" . time() . "." . $ext;
                        move_uploaded_file($_FILES['image']['tmp_name'], '../images/' . $imageName);
                        $sql = "UPDATE `benefits` SET `title`='$title',`description`='$description' , `image` = '$imageName' WHERE id = " . $data['id'];
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
                    } else {
                        $sql = "UPDATE `benefits` SET `title`='$title',`description`='$description' , `image` = '$imageName' WHERE id = " . $data['id'];
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
            }
            ?>
            <form method="POST" class="mb-3 border-bottom" enctype="multipart/form-data">
                <div class="row mb-3">
                    <?php if (isset($error)) echo $error; ?>
                </div>
                <div class="row mb-3">
                    <label for="title" class="col-sm-1 col-form-label">العنوان</label>
                    <div class="col-sm-11">
                        <input type="text" value="<?php if (isset($data['title'])) echo $data['title']; ?>" class="form-control w-50" id="title" name="title">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="image" class="col-sm-1 col-form-label">صورة </label>
                    <div class="col-sm-11">
                        <input type="file" class="form-control w-50 text-start" id="image" name="image">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="description" class="col-sm-1 col-form-label">الوصف</label>
                    <div class="col-sm-11">
                        <textarea class="form-control w-50" id="description" name="description" rows="4"><?php if (isset($data['description'])) echo $data['description']; ?></textarea>
                    </div>
                </div>
                <div class="row mb-3">
                    <button type="submit" name="<?php if (isset($_GET['id'])) {
                                                    echo 'edit';
                                                } else {
                                                    echo 'submit';
                                                } ?>" class="btn btn-primary m-2" style="width: 100px;"><?php if (isset($_GET['id'])) {
                                                                                                            echo 'تعديل';
                                                                                                        } else {
                                                                                                            echo 'حفظ';
                                                                                                        } ?></button>
                    <a href="benefits.php" class="btn btn-secondary m-2" style="width: 100px;">الغاء</a>
                </div>
            </form>
        </div>
        <div class="">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">العنوان</th>
                        <th scope="col">الوصف</th>
                        <th scope="col">صورة</th>
                        <th scope="col">العمليات</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    include "config.php";
                    $sql1 = "SELECT * FROM `benefits`";
                    $result1 = mysqli_query($config, $sql1);
                    if (mysqli_num_rows($result1) > 0) {
                        $key = 0;
                        while ($row = mysqli_fetch_assoc($result1)) {
                            echo
                            '
                                <tr class="align-middle">
                                    <th scope="row">' . ++$key . '</th>
                                    <td>' . $row['title'] . '</td>
                                    <td class"text-wrap text-break">' . $row['description'] . '</td>
                                    <td><img src="../images/' . $row['image'] . '" alt="' . $row['image'] . '" width="150px"></td>
                                    <td>
                                        <div class="dropdown">
                                            <button class="btn btn-light dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-three-dots-vertical" viewBox="0 0 16 16">
                                                    <path d="M9.5 13a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z"/>
                                                </svg>
                                            </button>
                                            <ul class="dropdown-menu">
                                                <li><a class="dropdown-item" href="benefits.php?id=' . $row['id'] . '"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pen" viewBox="0 0 16 16">
                                                <path d="m13.498.795.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001zm-.644.766a.5.5 0 0 0-.707 0L1.95 11.756l-.764 3.057 3.057-.764L14.44 3.854a.5.5 0 0 0 0-.708l-1.585-1.585z"/>
                                              </svg> تعديل</a></li>
                                                <li><a class="dropdown-item text-danger" href="delbenefits.php?id=' . $row['id'] . '"> <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16">
                                                <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5ZM11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H2.506a.58.58 0 0 0-.01 0H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1h-.995a.59.59 0 0 0-.01 0H11Zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5h9.916Zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47ZM8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5Z"/>
                                              </svg> حذف</a></li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                            
                            ';
                        }
                    } else {
                        echo '
                        <tr class="align-middle">
                            <td colspan="5" scope="row">لا يوجد بيانات يمكن عرضها...</td>
                        </tr>';
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</main>
<?php
include 'footer.php';
?>