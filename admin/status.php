<?php
session_start();
if (!isset($_SESSION['id'])) {
    header('Location:../login.php');
} elseif ($_SESSION['role'] == 'user') {
    header('Location:../index.php');
}
if (isset($_GET['course']) && isset($_GET['user']) && isset($_GET['status'])) {
    include 'config.php';
    $user = 'SELECT * FROM `users` where id =' . $_GET['user'];
    $resalt = mysqli_query($config, $user);
    $userdata = mysqli_fetch_assoc($resalt);

    $status = "UPDATE `order` SET `status`= 1 where id =" . $_GET['status'];
    $resaltstatus = mysqli_query($config, $status);

    $course = 'SELECT * FROM `course` where id =' . $_GET['course'];
    $resaltcourse = mysqli_query($config, $course);
    $coursedata = mysqli_fetch_assoc($resaltcourse);

    $user_id = $userdata['id'];
    $course_id = $coursedata['id'];

    $sql = "INSERT INTO `subscribers`(`user_id`, `course_id`) VALUES ('$user_id','$course_id')";
    $resaltSql = mysqli_query($config, $sql);
    if ($resaltSql) {
        header('Location:subscribers.php');
    } else {
        header('Location:order.php?statu=fales');
    }
}
