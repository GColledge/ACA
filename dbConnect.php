<?php
//connect to the database
$host = "localhost";

//TODO: fix next 3 lines
$dbname = "";
$user = "";
$pass = "";


try{
    $dbh = new PDO("mysql:host=$host; dbname=$dbname", $user, $pass);

} catch(PDOException $e){
    echo "Something has gone wrong: " . $e->getMessage();
}