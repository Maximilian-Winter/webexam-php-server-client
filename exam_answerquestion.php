<?php
include "helper.php";
AddJSScript("js/ajax.js");
$DBconnection = ConnectToDatabase();

$ExamSummaryID = $_REQUEST["ExamSummaryID"]; 
$StudentID = $_REQUEST["StudentID"]; 
$QuestionID = $_REQUEST["QuestionID"]; 
$AnswerCount = $_REQUEST["AnswerCount"];

// Check if all inputs are empty.
if(empty($ExamSummaryID) OR empty($StudentID) OR empty($QuestionID) OR empty($AnswerCount))
{
    echo "Fehler: Nicht alle Angaben zum Speichern der Antwort.";
}
else
{
    // Query to search for exam in the summary with the same id (should be one!).
    $Query = "SELECT * FROM exams_summary WHERE exam_summary_id= '$ExamSummaryID'";
    $ExamSummaryResult = mysqli_query($DBconnection, $Query);
    $ExamSummaryCount = mysqli_num_rows($ExamSummaryResult);

    if($ExamSummaryCount == 1)
    {      
        // Query to search for students with the same id (should be one!).
        $Query = "SELECT * FROM students WHERE student_id= '$StudentID'";
        $StudentsResult = mysqli_query($DBconnection, $Query);
        $StudentsCount = mysqli_num_rows($StudentsResult);

         if($StudentsCount == 1)
        {   
            // Query to search for questions with the same id (should be one!).
            $Query = "SELECT * FROM questions WHERE question_id= '$QuestionID'";
            $QuestionResult = mysqli_query($DBconnection, $Query);
            $QuestionCount = mysqli_num_rows($QuestionResult);

            if($QuestionCount == 1)
            {   
                // Check if student already answer the qustion and update the entry.
                $Query = "SELECT * FROM exam_student_answers WHERE exam_summary_id = '$ExamSummaryID' AND question_id= '$QuestionID' AND student_id =  '$StudentID'";
                $StudentAnswerResult = mysqli_query($DBconnection, $Query);
                $StudentAnswerCount = mysqli_num_rows($StudentAnswerResult);

                if($StudentAnswerCount > 0)
                {   
                    while($StudentAnswerRs=mysqli_fetch_array($StudentAnswerResult))
                    {
                        $AnswerID = $StudentAnswerRs['answer_id'];
                        // Insert the questions studen answers into the database and check if the query is successful.
                        $query = "DELETE FROM exam_student_answers WHERE exam_summary_id = '$ExamSummaryID' AND question_id= '$QuestionID' AND answer_id= '$AnswerID' AND student_id =  '$StudentID'";

                        if (!mysqli_query($DBconnection, $query)) 
                        {
                            echo "Fehler beim Speichern.<br>";
                            echo "Error: " . $query . "<br>" . mysqli_error($DBconnection);
                            exit;
                        }
                    }
                }
                for($i =0; $i < $AnswerCount; $i++)
                {
                    $AnswerID = $_REQUEST['AnswerID'.$i];
                    // Insert the questions studen answers into the database and check if the query is successful.
                    $query = "INSERT INTO exam_student_answers (exam_summary_id, question_id, answer_id, student_id) VALUES ($ExamSummaryID, $QuestionID, $AnswerID, $StudentID)";

                    if (!mysqli_query($DBconnection, $query)) 
                    {
                        echo "Fehler beim Speichern.<br>";
                        echo "Error: " . $query . "<br>" . mysqli_error($DBconnection);
                        exit;
                    } 
                }         
            }
            else
            {
                echo "Fehler: Frage nicht gefunden!";
            } 
        }
        else
        {
            echo "Fehler: Student nicht gefunden!";
        } 
    }
    else
    {
        echo "Fehler: Prüfung nicht gefunden!";
    } 
}
?> 
