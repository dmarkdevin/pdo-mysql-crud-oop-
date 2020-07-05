<?php
include 'config.php';
include 'class_database.php';

$data['table'] = "users";
$data['set']['name'] = rand(10000,999999).time();
$data['condition']['id'] = $_GET['id'];

$updateUser = $db->updateQuery($data);

echo $updateUser;
 
header('location:index.php');