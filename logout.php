<?php
session_start();
if (!isset($_SESSION['id'])) {
    header('Location:login.php');
}
if (isset($_SESSION['id'])) {
   session_destroy();
   header('Location:login.php');
}