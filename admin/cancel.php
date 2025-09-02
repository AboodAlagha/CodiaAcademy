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
if (isset($_GET['id'])) {
    include 'config.php';
    $sql = "UPDATE `subscribers` SET `status`= 0 WHERE  user_id = " . $_SESSION['id'];
    $resalt = mysqli_query($config, $sql);
    $userdata = mysqli_fetch_assoc($resalt);
    if ($userdata == TRUE) {
        header('Location:../mycourse.php?status=true');
    } else {
        header('Location:../mycourse.php?status=fales');
    }
}
