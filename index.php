<?php
include 'config.php';
include 'class_database.php';
include 'class_user.php';
 
echo "TOTAL NUMBER OF USERS: ".$user->count();
echo "<br><br>";

echo "<a href='create.php'>CLICK HERE TO CREATE RANDOM DATA</a>";
echo "<br><br>";

$listUsers = $user->lists();

foreach($listUsers as $rowUser):
    echo "[".$rowUser['id']."] ";
    echo $rowUser['name'];
    echo " <a href='read.php?id=".$rowUser['id']."'>READ</a>";
    echo " <a href='update.php?id=".$rowUser['id']."'>UPDATE</a>";
    echo " <a href='delete.php?id=".$rowUser['id']."'>DELETE</a>";
    echo "<br>";
endforeach;

echo "<br><br>";


echo "DB COLUMN: ";
echo "<br><br>";

$db_column = $user->db_column();
 
