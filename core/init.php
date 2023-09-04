<?php
    include('database/config.php');
    include('classes/GlobalClass.php');
    include('classes/User.php');

    global $pdo;

    $globalclass = new GlobalClass($pdo);
    $user = new User($pdo);

    date_default_timezone_set("Africa/Lagos");

?>