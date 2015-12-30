<?php

class Test
{
    private $questions = array(
        //section 1 questions
        array(
            //ID array, location array, and correct answer
            array(),
            array(),
            array()

        ),

        //section 2 questions
        array(
            array(),
            array(),
            array()
        ),

        //section 3 questions
        array(
            array(),
            array(),
            array()
        ),

        //section 4 questions
        array(
            array(),
            array(),
            array()
        )
    );


    public function generateTest()
    {
        $this->assignQuestions(1);
        $this->assignQuestions(2);
        $this->assignQuestions(3);
        $this->assignQuestions(4);
    }

    //This function queries the database and pulls random questions for each section
    private function assignQuestions($section)
    {
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

        $statement = $dbh->prepare('SELECT QuestionID, FileLocation, CorrectAnswer FROM QUESTION WHERE TestSection = :testSection ORDER BY RANDOM() LIMIT 20');
        $statement->execute(array("testSection"=>$section));
        $results = $statement->fetchAll();

        //fill array with the question information
        foreach($results as $result){
            array_push($this->questions[$section-1][0] , $result['QuestionID']);
            array_push($this->questions[$section-1][1], $result['FileLocation']);
            array_push($this->questions[$section-1][2], $result['CorrectAnswer']);
        }
    }

    public function getTestQuestions(){
        return $this->questions;
    }
}