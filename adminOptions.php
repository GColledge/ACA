<?php
session_start();
include ('dbConnect.php');

//TODO: CHECK WITH UPDATED DB
if(!isset($_SESSION['username'])){
    header("Location:Login.php");
}

//TODO: fix these addresses
$displayString = '<html><a href = "INSERT ADDRESS HERE">
<input type = "button" value = "Create New Student"/>
</a><br /><br />
<a href = "INSERT ADDRESS HERE">
<input type = "button" value = "Update Student\'s Enrollment"/>
</a><br /><br />
<a href = "INSERT ADDRESS HERE">
<input type = "button" value = "Create Instructor"/>
</a><br /><br />
</a></html>';