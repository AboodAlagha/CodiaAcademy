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
    $querySelect = 'select * from lessons where id=' . $_GET['id'];
    $ResultSelectStmt = mysqli_query($config, $querySelect);
    $fetchRecords = mysqli_fetch_assoc($ResultSelectStmt);
    $createDeletePath  = '../videos/' . $fetchRecords['video'];
    if (unlink($createDeletePath)) {
        $sql = "delete from lessons where id=" . $_GET["id"];
        $rsDelete = mysqli_query($config, $sql);
        if ($rsDelete) {
            header('location:lessons.php');
            exit();
        }
    }
}
