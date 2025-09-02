<?php
session_start();
if (!isset($_SESSION['id'])) {
    header('Location:../login.php');
} elseif ($_SESSION['role'] == 'user') {
    header('Location:../index.php');
}
include 'header.php';
include "config.php";

$sql = "SELECT order.id , order.user_id, order.course_id, order.discount_code, order.status, course.id as CID, course.name as CNAME, course.price, course.user_id as CUID ,users.id as UID,users.name as UNAME, users.email as UEMAIL FROM `order` JOIN `users` ON order.user_id = users.id JOIN `course` ON order.course_id = course.id and status = 0";
$result = mysqli_query($config, $sql);
$data = mysqli_fetch_assoc($result);

$code = $data['discount_code'];
$course_id = $data['CID'];

$offer = "SELECT * FROM `discount_code` where code = '$code' and course_id= '$course_id'";
$offer_res = mysqli_query($config, $offer);
$data2 = mysqli_fetch_assoc($offer_res);
$final_price = 0;

if (mysqli_num_rows($offer_res) > 0) {
    $final_price = $data['price'] - $data2['value'];
    $final_price += '$';
} else {
    $final_price = 'لا يوجد خصم';
}

?>
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="row">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <div class="col-sm-12">
                <h1 class="h3">لوحة التحكم الخاصة في قسم (طلبات الاشتراك في الكورسات)</h1>
            </div>
        </div>
        <div class="">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">اسم المشترك</th>
                        <th scope="col">بريد المشترك</th>
                        <th scope="col">رقم هاتف المشترك </th>
                        <th scope="col">كود الخصم المستخدم</th>
                        <th scope="col">اسم الكورس</th>
                        <th scope="col">سعر الكورس</th>
                        <th scope="col">الحالة</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($_SESSION['role'] == "presenter") {
                        $sql1 = "SELECT order.id , order.user_id, order.course_id, order.discount_code, order.status, course.id as CID, course.name as CNAME, course.price, course.user_id as CUID ,users.id as UID,users.name as UNAME, users.email as UEMAIL , users.phone FROM `order` JOIN `users` ON order.user_id = users.id JOIN `course` ON order.course_id = course.id and status = 0 and course.user_id =" . $_SESSION['id'];
                        $result1 = mysqli_query($config, $sql1);
                        if (mysqli_num_rows($result1) > 0) {
                            $key = 0;
                            while ($row = mysqli_fetch_assoc($result1)) {
                                if ($row['status'] == 0) {
                                    $status = 'لم يتم الدفع';
                                } else {
                                    $status = 'تم الدفع';
                                }
                                echo
                                '
                                    <tr class="align-middle">
                                        <th scope="row">' . ++$key . '</th>
                                        <td>' . $row['UNAME'] . '</td>
                                        <td>' . $row['UEMAIL'] . '</td>
                                        <td>' . $row['phone'] . '</td>
                                        <td>' . $row['discount_code'] . $final_price . '</td>
                                        <td>' . $row['CNAME'] . '</td>
                                        <td>' . $row['price'] . '$</td>
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
                        $sql1 = "SELECT order.id , order.user_id, order.course_id, order.discount_code, order.status, course.id as CID, course.name as CNAME, course.price, course.user_id as CUID ,users.id as UID,users.name as UNAME, users.email as UEMAIL , users.phone FROM `order` JOIN `users` ON order.user_id = users.id JOIN `course` ON order.course_id = course.id  and status = 0";
                        $result1 = mysqli_query($config, $sql1);
                        if (mysqli_num_rows($result1) > 0) {
                            $key = 0;
                            while ($row = mysqli_fetch_assoc($result1)) {
                                if ($row['status'] == 0) {
                                    $status = 'لم يتم الدفع';
                                } else {
                                    $status = 'تم الدفع';
                                }
                                echo
                                '
                                    <tr class="align-middle">
                                    <th scope="row">' . ++$key . '</th>
                                    <td>' . $row['UNAME'] . '</td>
                                    <td>' . $row['UEMAIL'] . '</td>
                                    <td>' . $row['phone'] . '</td>
                                    <td>' . $row['discount_code'] . $final_price . '</td>
                                    <td>' . $row['CNAME'] . '</td>
                                    <td>' . $row['price'] . '$</td>
                                    <td>' . $status . '</td>
                                        <td>
                                            <div class="dropdown">
                                                <button class="btn btn-light dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-three-dots-vertical" viewBox="0 0 16 16">
                                                        <path d="M9.5 13a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z"/>
                                                    </svg>
                                                </button>
                                                <ul class="dropdown-menu">
                                                    <li><a class="dropdown-item" href="status.php?course=' . $row['CID'] . '&user=' . $row['user_id'] . '&status=' . $row['id'] . '"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pen" viewBox="0 0 16 16">
                                                    <path d="m13.498.795.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001zm-.644.766a.5.5 0 0 0-.707 0L1.95 11.756l-.764 3.057 3.057-.764L14.44 3.854a.5.5 0 0 0 0-.708l-1.585-1.585z"/>
                                                    </svg> تم الدفع</a></li>
                                                    <li><a class="dropdown-item text-danger" href="delcourse.php?id=' . $row['id'] . '"> <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16">
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