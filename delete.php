<?php
include 'config.php';
include 'class_database.php';
include 'class_user.php';
 
$deleteUser = $user->delete($_GET['id']);
  
header('location:index.php');