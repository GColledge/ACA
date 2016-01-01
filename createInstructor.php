<?php

session_start();

//TODO: CHECK WITH UPDATED DB
if(!isset($_SESSION['username'])){
    header("Location:Login.php");
}

if(isset($_POST['Submit'])) {

    include('dbConnect.php');

    //make sure the first and last name were both filled in
    if(empty($_POST["first_name"]) || empty($_POST["last_name"])){
        echo "<script>
            alert('Please insert a first and last name');
            window.location.href='createInstructor.php';
            </script>";
    }

    //get the first and last names
    $firstName = strip_tags($_POST["first_name"]);
    $lastName = strip_tags($_POST["last_name"]);

    //insert the new instructor into the database
    $statement = $dbh->prepare("INSERT INTO INSTRUCTOR (FirstName, LastName, isCurrent)
                                VALUES (:FirstName, :LastName, :isCurrent)");
    $data = array("FirstName"=> $firstName, "LastName"=> $lastName, "isCurrent"=>1);
    $statement->execute($data);
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title></title>
</head>
<body>
<form action="createInstructor.php" method="post">
    First Name:
    <input type = 'text' name='first_name' id = 'first_name' maxlength="20">
    <br />
    <br />
    Last Name:
    <input type = 'text' name='last_name' id='last_name' maxlength="20">
    <br />
    <br />
    <input type='submit' name='Submit' value = 'Create Instructor' />
</form>
</body>
</html>


