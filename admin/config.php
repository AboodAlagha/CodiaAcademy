<?php
$config = mysqli_connect("localhost", "root", "", "codia_academy_db");
if (!$config) {
    die('No Connected');
}