<?php
include 'config.php';
include 'class_database.php';
include 'class_user.php';
 
$User = $user->read($_GET['id']);

echo '<pre>';
    print_r($User);
echo '</pre>';

echo "<br>";
echo "<a href='index.php'>BACK</a>";