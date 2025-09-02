<?php
include "include/header.php";
include 'admin/config.php';

if (!isset($_SESSION['id'])) {
    echo "<script>window.location.href='login.php'</script>";
} elseif (isset($_SESSION['id'])) {
    $user = 'SELECT * FROM `users` where id =' . $_SESSION['id'] . ';';
    $resalt = mysqli_query($config, $user);
    $userdata = mysqli_fetch_assoc($resalt);
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
                            <li class="list-group-item w-100"><a href="profile.php" class="text-decoration-none mb-2">اعدادت الحساب</a></li>
                            <li class="list-group-item w-100"><a href="mycourse.php" class="text-decoration-none mb-2">كورساتي</a></li>
                        </ul>
                    </span>
                </div>
            </div>
            <div class="col-md-8 border-right">
                <div class="p-3 py-5">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h4 class="text-right">كورساتي</h4>
                    </div>
                    <div class="row d-flex justify-content-between align-items-center mb-3">
                        <?php
                        $sql1 =
                            "SELECT users.id,users.username,users.email,course.name, course.image,course.id as Id, course.name as NameC,subscribers.id as ID,subscribers.user_id,subscribers.course_id FROM users JOIN subscribers ON users.id = subscribers.user_id JOIN course ON course.id = subscribers.course_id where status= 1 and users.id = " . $_SESSION['id'] . ";";
                        $result1 = mysqli_query($config, $sql1);
                        if (mysqli_num_rows($result1) > 0) {
                            $key = 0;
                            while ($row = mysqli_fetch_assoc($result1)) {
                                echo
                                '
                                <div class="col-md-6 col-sm-12 mb-2 d-flex justify-content-center align-items-center">
                            <div class="card" style="width: 25rem; height:19rem;">
                                <img src="images/' . $row['image'] . '" class="card-img-top" alt="' . $row['name'] . '">
                                <div class="card-body d-flex justify-content-between align-items-center">
                                    <div class="float-statr w-50" style="display: inline-block;">' . $row['name'] . '</div>
                                    <div class= float-end w-50" style="display: inline-block;">
                                        <div class="dropdown">
                                            <button class="btn btn-light" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" fill="currentColor" class="bi bi-three-dots-vertical" viewBox="0 0 16 16">
                                                    <path d="M9.5 13a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z"/>
                                                </svg>
                                            </button>
                                            <ul class="dropdown-menu">
                                                <li><a class="dropdown-item" href="admin/cancel.php?id=' . $_SESSION['id'] . '">الغاء الاشتراك</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3 d-flex justify-content-center align-items-center">
                                    <a href="course.php?id=' . $row['Id'] . '" class="btn btn-success btn-sm">واصل التعلم</a>
                                </div>
                            </div>
                        </div>
                                ';
                            }
                        } else {
                            echo '
                            <tr class="align-middle">
                                <td colspan="55" scope="row">لم تشترك في اي كورس بعد</td>
                            </tr>';
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>


<?php
include "include/footer.php";
?>