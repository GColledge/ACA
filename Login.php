<?php

session_start();

if(isset($_POST['Submit'])){
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
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title></title>
</head>
<body>
<form action="Login.php" method="post">
    Username:
    <input type = 'text' name='username' id = 'username' maxlength="60">
    <br />
    <br />
    Password:
    <input type = 'password' name='password' id='password' maxlength="30">
    <br />
    <br />
    <input type='submit' name='Submit' value = 'Login' />
</form>
</body>
</html>


