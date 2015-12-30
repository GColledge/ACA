<?php
//connect to the database
$host = "localhost";

//TODO: fix next 3 lines
$dbname = "W01119526";
$user = "W01119526";
$pass = "Rachaelcs!";


try{
    $dbh = new PDO("mysql:host=$host; dbname=$dbname", $user, $pass);

} catch(PDOException $e){
    echo "Something has gone wrong: " . $e->getMessage();
}