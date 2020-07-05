<?php
include 'config.php';
include 'class_database.php';

$data['table'] = "users";
$data['values']['name'] = rand(10000,999999).time();

$createUser = $db->insertQuery($data);

echo $createUser;

header('location:index.php');