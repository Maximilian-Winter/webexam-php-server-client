<?php
include "helper.php";
// Connect to the mysql database.
$DBconnection = ConnectToDatabase();

// Read in the inputed instructor information from the form.
$ExamID = $_REQUEST["ExamID"];
$QuestionID = $_REQUEST["QuestionID"];

// Check if all inputs are empty.
if(empty($ExamID) OR empty($QuestionID))
{
    echo "Fehler: Prüfung oder Frage nicht angegeben.";
}
else
{
    // Query to search for exams with the same id (should be one!).
    $Query = "SELECT * FROM exams WHERE exam_id LIKE '$ExamID'";
    $Result = mysqli_query($DBconnection, $Query);
    $Count = mysqli_num_rows($Result);

     if($Count == 1)
    {      
        // Query to search for exams with the same id (should be one!).
        $Query = "SELECT * FROM questions WHERE question_id LIKE '$QuestionID'";
        $Result = mysqli_query($DBconnection, $Query);
        $Count = mysqli_num_rows($Result);

         if($Count == 1)
        {   
            // Query to search for exams with the same id (should be one!).
            $Query = "SELECT exam_question_id FROM exam_questions WHERE exam_id LIKE '$ExamID' AND question_id LIKE '$QuestionID' ";
            $Result = mysqli_query($DBconnection, $Query);
            $Count = mysqli_num_rows($Result);

             if($Count > 0)
            {   
                echo "Frage schon in Prüfung vorhanden!";
            }
            else
            {
                // Insert the questions information into the database and check if the query is successful.
                $query = "INSERT INTO exam_questions (exam_id, question_id) VALUES ($ExamID, $QuestionID)";

                if (!mysqli_query($DBconnection, $query)) 
                {
                    echo "Fehler beim Speichern.<br>";
                    echo "Error: " . $query . "<br>" . mysqli_error($DBconnection);
                    echo "<br> <a href=\"question_createform.php\">Zurück</a> <br>";
                    exit;
                }

                echo "Erfolgreich gespeichert.";
            } 
        }
        else
        {
            echo "Fehler Frage nicht gefunden!";
        } 
    }
    else
    {
        echo "Fehler Prüfung nicht gefunden!";
    } 
}
?> 