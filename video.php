<?php
include "include/header.php";
include 'admin/config.php';
if (!isset($_SESSION['id'])) {
    echo "<script>window.location.href='login'</script>";
}
if (isset($_GET['id']) && isset($_GET['lesson'])) {
    $subscribers = 'SELECT * FROM `subscribers` where user_id =' . $_SESSION['id'] . ';';
    $resaltsubscribers = mysqli_query($config, $subscribers);
    if (!mysqli_num_rows($resaltsubscribers) > 0) {
        echo "<script>window.location.href='index'</script>";
    }
    $sql = 'select * from lessons where course_id=' . $_GET['id'] . ' AND id=' . $_GET['lesson'] . ';';
    $result = mysqli_query($config, $sql);
    if (!mysqli_num_rows($result) > 0) {
        echo "<script>window.location.href='index'</script>";
    }
    $row = mysqli_fetch_assoc($result);
} else {
    echo "<script>window.location.href='course'</script>";
}
?>
<main class="container-fluid">
    <div class="row">
        <div class="col-md-4 col-sm-10 ">
            <div class="">
                <?php
                $courseid = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
                $sql2 = "select * from lessons where course_id = " . $courseid . ";";
                $result1 = mysqli_query($config, $sql2);
                if (mysqli_num_rows($result1) > 0) {
                    foreach ($result1 as $key => $data) {
                        echo '
                                    <a href="video?id=' . $_GET['id'] . '&&lesson=' . $data['id'] . '" class="list-group-item list-group-item-action mb-2">' . $data['name'] . '</a>
                                    ';
                    }
                }
                ?>
            </div>
            <div class="mt-1">
                <a href="course?id=<?php echo $_GET['id'] ?>" class="btn btn-primary">رجوع</a>
            </div>
        </div>
        <div class="col-md-8 col-sm-10 ">
            <div class="text-center mt-3">
                <span class="h5"><?php if (isset($row['name'])) echo $row['name']; ?></span>
            </div>
            <div class="d-flex justify-content-center align-items-center mt-5">
                <?php
                if (isset($row['video'])) {
                ?>
                    <div class="container">
                        <video controls crossorigin playsinline poster="images/Picsart_22-06-28_22-43-56-771.jpg" id="player">
                            <source src="videos/<?php if (isset($row['video'])) echo $row['video'] ?>" size="500">
                            <a href="videos/<?php if (isset($row['video'])) echo $row['video']; ?>" download>Download</a>
                        </video>
                    </div>
                <?php
                }
                ?>
                <?php
                if (!isset($row['video'])) {
                ?>
                    <h1>لا يوجد فيديوهات</h1>
                <?php
                }
                ?>
            </div>

        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // This is the bare minimum JavaScript. You can opt to pass no arguments to setup.
            const player = new Plyr('#player');
            // Expose
            window.player = player;

            // Bind event listener
            function on(selector, type, callback) {
                document.querySelector(selector).addEventListener(type, callback, false);
            }

            // Play
            on('.js-play', 'click', () => {
                player.play();
            });

            // Pause
            on('.js-pause', 'click', () => {
                player.pause();
            });

            // Stop
            on('.js-stop', 'click', () => {
                player.stop();
            });

            // Rewind
            on('.js-rewind', 'click', () => {
                player.rewind();
            });

            // Forward
            on('.js-forward', 'click', () => {
                player.forward();
            });
        });
    </script>
</main>
<?php
include 'include/footer.php';
?>