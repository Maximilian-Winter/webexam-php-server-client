<?php
include "helper.php";
AddJSScript("js/ajax.js");
$DBconnection = ConnectToDatabase();

$ExamSummaryID = $_REQUEST["ExamSummaryID"]; 
$StudentID = $_REQUEST["StudentID"];
$ExamID = $_REQUEST["ExamID"];

// Check if all inputs are empty.
if(empty($ExamSummaryID) OR empty($StudentID) OR empty($ExamID))
{
    echo "Fehler: Nicht alle Angaben zum Speichern des Ergebnis der Prüfung.";
}
else
{
    // Query to get student start date.
    $Query = "SELECT * FROM exam_student_results WHERE student_id= '$StudentID' AND exam_summary_id= '$ExamSummaryID'";
    $StudentExamResult = mysqli_query($DBconnection, $Query);
    $StudentExamCount = mysqli_num_rows($StudentExamResult);

    $StudentExamRs = mysqli_fetch_array($StudentExamResult);
    $StudentResultGradeTitle = $StudentExamRs['exam_student_result_grade_title'];
    $StudenExamPoints = $StudentExamRs['exam_student_result_points'];
    $StudentExamPointPercent = $StudentExamRs['exam_student_result_percent'];

     // Query to search for all exam questions.
    $Query = "SELECT * FROM exam_questions WHERE exam_id= '$ExamID' ORDER BY question_id ASC";
    $ExamQuestionsResult = mysqli_query($DBconnection, $Query);
    $ExamQuestionsCount = mysqli_num_rows($ExamQuestionsResult);

    $ExamQuestionsPoints = 0;
    while($ExamQuestionsRs=mysqli_fetch_array($ExamQuestionsResult))
    {
        $QuestionID = $ExamQuestionsRs['question_id'];
        // Query to search for all exam questions.
        $Query = "SELECT SUM(answer_points) AS question_points  FROM answers WHERE question_id= '$QuestionID'";
        $AnswerResult = mysqli_query($DBconnection, $Query);
        $AnswerCount = mysqli_num_rows($AnswerResult);
        $AnswerRs=mysqli_fetch_array($AnswerResult);

        $ExamQuestionsPoints += $AnswerRs['question_points'];
    }

    echo '<form name = "ExamSummaryStudentResults">';
    echo '<fieldset>';

    echo "<label>Ergebnis:</label><br>";
    echo "<label>Note: " . $StudentResultGradeTitle . "</label><br>";
    echo "<label>Ereichte Punkt: " . $StudenExamPoints . " von " . $ExamQuestionsPoints . " Punkten</label> <br>";
    echo "<label>Ereichte Punkte in Prozent: " . $StudentExamPointPercent . "%</label><br>";

    echo '</fieldset>';
    echo '</form>';
}
?> 
