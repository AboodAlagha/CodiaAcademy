<?php
session_start();
if (!isset($_SESSION['id'])) {
    header('Location:../login.php');
} elseif ($_SESSION['role'] == 'user') {
    header('Location:../index.php');
} elseif ($_SESSION['role'] == 'presenter') {
    header('Location:index.php');
}
if (isset($_GET['id'])) {
    include 'config.php';
    $sql = "delete from about_us where id=" . $_GET["id"];
    $rsDelete = mysqli_query($config, $sql);
    if ($rsDelete) {
        header('location:about.php');
        exit();
    }
}
