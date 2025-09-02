<?php
session_start();
if (!isset($_SESSION['id'])) {
    header('Location:../login.php');
} elseif ($_SESSION['role'] == 'user') {
    header('Location:../index.php');
} elseif ($_SESSION['role'] == 'presenter') {
    header('Location:index.php');
}
$fileName = $_FILES['file1']['name'];
$fileTmpLoc = $_FILES["file1"]["tmp_name"]; // File in the PHP tmp folder
$fileType = $_FILES["file1"]["type"]; // The type of file it is
$fileSize = $_FILES["file1"]["size"]; // File size in bytes
$fileErrorMsg = $_FILES["file1"]["error"]; // 0 for false... and 1 for true
$maxsize = 5073741824; // 5GB
$target_dir = "../videos/";
$target_file = $target_dir . $fileName;
$extension = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
if ($_FILES['file1']['type'] == 'video/mp4' || $_FILES['file1']['type'] == 'video/mpeg' || $_FILES['file1']['type'] == 'video/avi' || $_FILES['file1']['type'] == 'video/3gp' || $_FILES['file1']['type'] == 'video/mov' || $_FILES['file1']['type'] == 'video/mp4') {
    $extensions_arr = array("mp4", "avi", "3gp", "mov", "mpeg");
    if (in_array($extension, $extensions_arr)) {
        if (($_FILES['file1']['size'] >= $maxsize) || ($_FILES["file1"]["size"] == 0)) {
            $_SESSION['message'] = "File too large. File must be less than 5GB.";
        }
    }
    if (!$fileTmpLoc) { // if file not chosen
        echo "ERROR: Please browse for a file before clicking the upload button.";
        exit();
    }
    if (move_uploaded_file($fileTmpLoc, "../videos/$fileName")) {
        echo "تم رفع الملف ";
    } else {
        echo "move_uploaded_file function failed";
    }
} else {
    echo
    '
<div class="alert alert-danger alert-dismissible fade show w-50 mt-2" role="alert">
    <span class="alert-icon"><i class="ni ni-like-2"></i></span>
    <span class="alert-text"><strong>خطأ!</strong> يا عرص اختار فيديو</span>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
';
}
