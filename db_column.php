<?php
include 'config.php';
include 'dbconnection.php';
include 'class_user.php';
 
echo "DB COLUMN: ";
echo "<br><br>";

$db_column = $user->db_column();
 
