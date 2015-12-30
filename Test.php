<?php

class Test
{
    private $questions = array(
        array(
            array(),
            array()
        ),

        array(
            array(),
            array()
        ),

        array(
            array(),
            array()
        ),

        array(
            array(),
            array()
        )
    );


    public function generateTest()
    {
        $this->assignQuestions(0);
        $this->assignQuestions(1);
        $this->assignQuestions(2);
        $this->assignQuestions(3);
    }

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

        $statement = $dbh->prepare('SELECT QuestionID, FileLocation FROM QUESTION WHERE TestSection = :testSection ORDER BY RANDOM() LIMIT 20');
        $statement->bindParam(':testSection', $section, PDO::PARAM_INT);
        $statement->execute();
        $results = $statement->fetchAll();

        foreach($results as $result){
            array_push($this->questions[$section][1] , $result['FileLocation']);
            array_push($this->questions[$section][2], $result['QuestionID']);
        }
    }

    public function getTestQuestions(){
        return $this->questions;
    }
}