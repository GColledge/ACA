<?php
session_start();
include ('dbConnect.php');

if(!isset($_SESSION['username'])){
    header("Location:Login.php");
}

//first time on the page.  Create questions array. Insert row into Test table
if($_SESSION["count"] == 0){
    $test = new Test();
    $test->generateTest();
    $_SESSION["questions"] = $test->getTestQuestions();
    $_SESSION["section"] = 0;
    $_SESSION["question"] = ($_SESSION["count"] % 20) + 1;

    //CHECK WITH UPDATED DB
    $addTest = $dbh->prepare("INSERT INTO TEST (StudentUsername, StartTime) VALUES (:StudentUsername, :DateAndTime)");
    $data = array("StudentUsername"=> $_SESSION["username"], "DateAndTime"=> date("Y-m-d H:i:s"));
    $addTest->execute($data);
    $_SESSION["TestID"] = $dbh->lastInsertID();

}else{
    if(isset($_POST["Submit"])){
        //enter answer into database
        $addAssignedQuestion = $dbh->prepare("INSERT INTO ASSIGNEDQUESTION (QuestionID, TestID, StudentAnswer, isCorrect)
            VALUES(:QuestionID, :TestID, :StudentAnswer, :isCorrect)");
        $data = array("QuestionID"=>$_SESSION["questions"][$_SESSION["section"]][0][$_SESSION["question"]],
                        "TestID" => $_SESSION["TestID"],
                        "StudentAnswer" => $_POST["multiple_choice"],
                        "isCorrect" => ($_POST["multiple_choice"] == $_SESSION["questions"][$_SESSION["section"]][2][$_SESSION["question"]])
        );
        $addAssignedQuestion->execute($data);

        //update variables
        $_SESSION["count"]++;
        $_SESSION["section"] = $_SESSION["count"] / 20;
        $_SESSION["question"] = ($_SESSION["count"] % 20) + 1;
    }
}

//show next question
$formString = '<br /><br />
        <form action = "/TestForm.php" method = "post">
        <label>#' . $_SESSION["questions"] . '</label>
        <img src = ' . $_SESSION["questions"][$_SESSION["section"]][1][$_SESSION["question"]] .
    '><br />
        <input type = "radio" name = "multiple_choice" value = "A">A<br />
        <input type = "radio" name = "multiple_choice" value = "B">B<br />
        <input type = "radio" name = "multiple_choice" value = "C">C<br />
        <input type = "radio" name = "multiple_choice" value = "D">D<br />
        <br /><br /><br />
        <input type = "submit" name = "Submit"/>';

echo $formString;