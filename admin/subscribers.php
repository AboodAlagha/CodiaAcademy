<?php
session_start();
if (!isset($_SESSION['id'])) {
    header('Location:../login.php');
} elseif ($_SESSION['role'] == 'user') {
    header('Location:../index.php');
}
include 'header.php';
include "config.php";
?>
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="row">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <div class="col-sm-12">
                <h1 class="h3">لوحة التحكم الخاصة في قسم ( المشتركين في الكورسات)</h1>
            </div>
        </div>
        <div class="">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">اسم المشترك</th>
                        <th scope="col">بريد المشترك</th>
                        <th scope="col">اسم الكورس</th>
                        <th scope="col">حالة الاشتراك </th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($_SESSION['role'] == "presenter") {
                        $sql1 = "SELECT users.id,users.username,users.email,course.name,course.id as Id, course.name as NameC,subscribers.id as ID,subscribers.user_id,subscribers.status,subscribers.course_id FROM users JOIN subscribers ON users.id = subscribers.user_id JOIN course ON course.id = subscribers.course_id";
                        $result1 = mysqli_query($config, $sql1);
                        if (mysqli_num_rows($result1) > 0) {
                            $key = 0;
                            while ($row = mysqli_fetch_assoc($result1)) {
                                if ($row['status'] == 0) {
                                    $status = 'قام المستخدم بحذف الاشتراك';
                                } else {
                                    $status = 'مشترك';
                                }
                                echo
                                '
                                <tr class="align-middle">
                                    <th scope="row">' . ++$key . '</th>
                                    <td>' . $row['username'] . '</td>
                                    <td>' . $row['email'] . '</td>
                                    <td>' . $row['NameC'] . '</td>
                                    <td>' . $status . '</td>
                                </tr>
                            
                            ';
                            }
                        } else {
                            echo '
                        <tr class="align-middle">
                            <td colspan="55" scope="row">لا يوجد بيانات يمكن عرضها...</td>
                        </tr>';
                        }
                    } elseif ($_SESSION['role'] == "admin") {
                        $sql1 = "SELECT users.id,users.username,users.email,course.name,course.id as Id, course.name as NameC,subscribers.id as ID,subscribers.user_id,subscribers.status,subscribers.course_id FROM users JOIN subscribers ON users.id = subscribers.user_id JOIN course ON course.id = subscribers.course_id";
                        $result1 = mysqli_query($config, $sql1);
                        if (mysqli_num_rows($result1) > 0) {
                            $key = 0;
                            while ($row = mysqli_fetch_assoc($result1)) {
                                if ($row['status'] == 0) {
                                    $status = 'قام المستخدم بحذف الاشتراك';
                                } else {
                                    $status = 'مشترك';
                                }
                                echo
                                '
                                <tr class="align-middle">
                                    <th scope="row">' . ++$key . '</th>
                                    <td>' . $row['username'] . '</td>
                                    <td>' . $row['email'] . '</td>
                                    <td>' . $row['NameC'] . '</td>
                                    <td>' . $status . '</td>
                                </tr>
                            
                            ';
                            }
                        } else {
                            echo '
                        <tr class="align-middle">
                            <td colspan="55" scope="row">لا يوجد بيانات يمكن عرضها...</td>
                        </tr>';
                        }
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