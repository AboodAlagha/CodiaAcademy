<?php
session_start();
if (!isset($_SESSION['id'])) {
    header('Location:../login.php');
} elseif ($_SESSION['role'] == 'user') {
    header('Location:../index.php');
}
?>
<?php
include 'header.php';
include "config.php";

if (isset($_POST['but_upload']) && !empty($_POST['name'])) {
    $name = $_POST['name'];
    $fileName = $_FILES['file1']['name'];
    $course_id = $_POST['course_id'];
    $query = "INSERT INTO lessons( name ,video , course_id) VALUES('$name','$fileName' , '$course_id')";
    $res = mysqli_query($config, $query);
    if ($res) {
        $_SESSION['message'] = '<div class="alert alert-success" role="alert">
                        تمت العملية بنجاح
                        </div>';
    } else {
        $_SESSION['message'] = '<div class="alert alert-danger" role="alert">
                    لم تتم العملية هناك خطأ ما!
                    </div>';
    }
}

?>
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="row">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <div class="col-sm-8">
                <h1 class="h3">
                    اضافة درس جديد
                </h1>
            </div>
        </div>
        <form method="post" id="upload_form" action="" enctype='multipart/form-data'>
            <div class="row mb-3 w-50">
                <?php
                if (isset($_SESSION['message'])) {
                    echo $_SESSION['message'];
                    unset($_SESSION['message']);
                }
                ?>
            </div>
            <input type='text' name='name' class="form-control w-50 mb-2" placeholder="اسم الدرس">
            <select class="form-select form-control w-50 mb-2" name="course_id">
                <?php
                include "config.php";
                $sql1 = "SELECT * FROM `course`";
                $result1 = mysqli_query($config, $sql1);
                if (mysqli_num_rows($result1) > 0) {
                    $key = 0;
                    while ($row = mysqli_fetch_assoc($result1)) {
                        echo '<option value="' . $row['id'] . '">' . $row['name'] . '</option>';
                    }
                }
                ?>
            </select>
            <input type='file' id="file1" name='file1' class="form-control w-50 mb-2" onchange="uploadFile()">
            <progress id="progressBar" class="progress-bar w-50" role="progressbar" value="0" max="100">
            </progress>
            <p id="status"></p>
            <p id="loaded_n_total"></p>
            <button type="submit" name="but_upload" class="btn mb-2 btn-primary">حفظ</button>
        </form>
</main>
<script>
    function _(el) {
        return document.getElementById(el);
    }

    function uploadFile() {
        var file = _("file1").files[0];
        var formdata = new FormData();
        formdata.append("file1", file);
        var ajax = new XMLHttpRequest();
        ajax.upload.addEventListener("progress", progressHandler, false);
        ajax.addEventListener("load", completeHandler, false);
        ajax.addEventListener("error", errorHandler, false);
        ajax.addEventListener("abort", abortHandler, false);
        ajax.open("POST", "file_upload_parser.php"); // http://www.developphp.com/video/JavaScript/File-Upload-Progress-Bar-Meter-Tutorial-Ajax-PHP
        //use file_upload_parser.php from above url
        ajax.send(formdata);
    }

    function progressHandler(event) {
        // _("loaded_n_total").innerHTML = "" + event.loaded + " bytes of " + event.total;
        var percent = (event.loaded / event.total) * 100;
        _("progressBar").value = Math.round(percent);
        _("status").innerHTML = Math.round(percent) + "% جاري التحميل";
    }

    function completeHandler(event) {
        _("status").innerHTML = event.target.responseText;
        _("progressBar").value = 0; //wil clear progress bar after successful upload
    }

    function errorHandler(event) {
        _("status").innerHTML = "Upload Failed";
    }

    function abortHandler(event) {
        _("status").innerHTML = "Upload Aborted";
    }
</script>
<?php
include 'footer.php';
?>