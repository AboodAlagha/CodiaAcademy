<?php
session_start();
if (!isset($_SESSION['id'])) {
    header('Location:../login.php');
} elseif ($_SESSION['role'] == 'user') {
    header('Location:../index.php');
}
include 'header.php';
?>
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="row">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <div class="col-sm-8">
                <h1 class="h3">لوحة التحكم الخاصة في قسم (الدروس)</h1>
            </div>
            <div class="col-sm-4 text-end ">
                <a href="addlessons.php" class="btn btn-success">اضافة درس جديد</a>
            </div>
        </div>
        <div class="">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">اسم الدرس</th>
                        <th scope="col">الفيديو</th>
                        <th scope="col">اسم الكورس</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($_SESSION['role'] == 'presenter') {
                        include "config.php";
                        $sql1 = "SELECT lessons.id ,  lessons.name , lessons.video , course.id as Cid , course.name as Cname , course.user_id  FROM `lessons` join course on lessons.course_id = course.id where course.user_id =   " . $_SESSION['id'];
                        $result1 = mysqli_query($config, $sql1);
                        if (mysqli_num_rows($result1) > 0) {
                            $key = 0;
                            while ($row = mysqli_fetch_assoc($result1)) {
                                echo
                                '
                                <tr class="align-middle">
                                    <th scope="row">' . ++$key . '</th>
                                    <td>' . $row['name'] . '</td>
                                    <td>
                                        <video width="320" height="240" controls>
                                            <source src="../videos/'.$row['video'].'">
                                        </video></td>
                                    <td>' . $row['Cname'] . '</td>
                                </tr>
                            
                            ';
                            }
                        } else {
                            echo '
                        <tr class="align-middle">
                            <td colspan="55" scope="row">لا يوجد بيانات يمكن عرضها...</td>
                        </tr>';
                        }
                    } elseif ($_SESSION['role'] == 'admin') {
                        include "config.php";
                        $sql1 = "SELECT lessons.id ,  lessons.name , lessons.video , course.id as Cid , course.name as Cname  FROM `lessons` join course on lessons.course_id = course.id ";
                        $result1 = mysqli_query($config, $sql1);
                        if (mysqli_num_rows($result1) > 0) {
                            $key = 0;
                            while ($row = mysqli_fetch_assoc($result1)) {
                                echo
                                '
                                <tr class="align-middle">
                                    <th scope="row">' . ++$key . '</th>
                                    <td>' . $row['name'] . '</td>
                                    <td>
                                        <video width="320" height="240" controls>
                                            <source src="../videos/' . $row['video'] . '">
                                        </video></td>
                                    <td>' . $row['Cname'] . '</td>
                                    <td>
                                        <div class="dropdown">
                                            <button class="btn btn-light dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-three-dots-vertical" viewBox="0 0 16 16">
                                                    <path d="M9.5 13a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z"/>
                                                </svg>
                                            </button>
                                            <ul class="dropdown-menu">
                                                <li><a class="dropdown-item text-danger" href="dellesson.php?id=' . $row['id'] . '"> <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16">
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