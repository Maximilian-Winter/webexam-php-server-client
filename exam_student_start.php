<?php
include "helper.php";
// Connect to the mysql database.
$DBconnection = ConnectToDatabase();

// Read in the inputed instructor information from the form.
$ExamSummaryID = $_REQUEST["ExamSummaryID"];
$StudentID = $_REQUEST["StudentID"];

// Check if all inputs are empty.
if(empty($ExamSummaryID) OR empty($StudentID))
{
    echo "Fehler: Prüfung oder Frage nicht angegeben.";
}
else
{
    // Query to search for exams with the same id (should be one!).
    $Query = "SELECT * FROM exams_summary WHERE exam_summary_id= '$ExamSummaryID'";
    $ExamSummaryResult = mysqli_query($DBconnection, $Query);
    $ExamSummaryCount = mysqli_num_rows($ExamSummaryResult);

     if($ExamSummaryCount == 1)
    {      
        // Query to search for exams with the same id (should be one!).
        $Query = "SELECT * FROM students WHERE student_id= '$StudentID'";
        $StudentsResult = mysqli_query($DBconnection, $Query);
        $StudentsCount = mysqli_num_rows($StudentsResult);

         if($StudentsCount == 1)
        {   

            // Query to search for exams with the same id (should be one!).
            $Query = "SELECT * FROM exam_student_start WHERE student_id= '$StudentID' AND exam_summary_id= '$ExamSummaryID'";
            $ExamStudentStartResult = mysqli_query($DBconnection, $Query);
            $ExamStudentStartCount = mysqli_num_rows($ExamStudentStartResult);

            if($ExamStudentStartCount == 0)
            {   
                
                $now = date("Y-m-d H:i:s");
                // Insert the questions information into the database and check if the query is successful.
                $query = "INSERT INTO exam_student_start (exam_student_startdate, exam_summary_id, student_id) VALUES (NOW(), $ExamSummaryID, $StudentID)";

                if (!mysqli_query($DBconnection, $query)) 
                {
                    echo "Fehler beim Speichern.<br>";
                    echo "Error: " . $query . "<br>" . mysqli_error($DBconnection);
                    exit;
                }
                
                echo '<input type = "hidden" id = "StudentStartExam" value = "1"> </input>';
                echo '<input type = "hidden" id = "StudentStartDate" value = "'.  $now .'"> </input>';
            }
            else
            {
                 // Query to search for exams with the same id (should be one!).
                $Query = "SELECT * FROM exam_student_end WHERE student_id= '$StudentID' AND exam_summary_id= '$ExamSummaryID'";
                $ExamStudentEndResult = mysqli_query($DBconnection, $Query);
                $ExamStudentEndCount = mysqli_num_rows($ExamStudentEndResult);
                
                if($ExamStudentEndCount == 0)
                {   
                    
                    $now = date("Y-m-d H:i:s");
                    // Insert the questions information into the database and check if the query is successful.
                    $query = "UPDATE exam_student_start SET exam_student_startdate = '$now' WHERE student_id= '$StudentID' AND exam_summary_id= '$ExamSummaryID'";

                    if (!mysqli_query($DBconnection, $query)) 
                    {
                        echo "Fehler beim Speichern.<br>";
                        echo "Error: " . $query . "<br>" . mysqli_error($DBconnection);
                        exit;
                    }
                    
                    echo '<input type = "hidden" id = "StudentStartExam" value = "1"> </input>';
                    echo '<input type = "hidden" id = "StudentStartDate" value = "'.  $now .'"> </input>';
                }
                else
                {
                    echo "Fehler Prüfung wurde von Student schon beendet!";
                } 
            } 
        }
        else
        {
            echo "Fehler Student nicht gefunden!";
        } 
    }
    else
    {
        echo "Fehler Prüfung nicht gefunden!";
    } 
}
?> 