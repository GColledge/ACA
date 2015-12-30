<?php
session_start();
if(!isset($_SESSION['username'])){
    header("Location:Login.php");
}

//TODO: check that the question was answered

if($_SESSION["count"] == 0){
    $test = new Test();
    $test->generateTest();
    $_SESSION["count"]++;

    $_SESSION["questions"] = $test->getTestQuestions();
}else{
    //TODO: enter into database
}

$formString = '<br /><br />
        <form action = "/TestForm.php" method = "post">
        <label>#' . $_SESSION["questions"] . '</label>
        <img src = ' . $_SESSION["questions"][0][1][$_SESSION["count"]] .
        '><br />
        <input type = "radio" name = "multiple_choice" value = "A">A<br />
        <input type = "radio" name = "multiple_choice" value = "B">B<br />
        <input type = "radio" name = "multiple_choice" value = "C">C<br />
        <input type = "radio" name = "multiple_choice" value = "D">D<br />
        <br /><br /><br />
        <input type = "submit" name = "Submit"/>';
;

