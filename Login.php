<?php

session_start();

if(isset($_POST['login'])){
    include('dbConnect.php');

    $username = strip_tags($_POST["username"]);
    $password = strip_tags($_POST["password"]);

    $loginStatement = $dbh->prepare("SELECT * FROM STUDENT WHERE Username = :Username");
    $loginStatement->execute(array("Username"=>$username));
    $users = $loginStatement->fetchAll();

    //if the username is in the database
    if(isset($users[0])){

        foreach($users as $user){
            $dbPassword = $user['Password'];
        }

        //if username and password match, redirect to test
        if(password_verify($password, $dbPassword)){
            $_SESSION["count"] = 0;
            $_SESSION["username"] = $username;
            header('Location: TestForm.php');
            exit;
        //if the password does not match username
        }else{
            echo "<script>
            alert('Incorrect Password');
            window.location.href='Login.php';
            </script>";
        }
    }
    //if the username was not found in the database
    else{
        echo "<script>
            alert('Username does not exist');
            window.location.href='Login.php';
            </script>";
    }
}


