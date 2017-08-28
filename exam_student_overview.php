 <?php
include "helper.php";
AddJSScript("js/ajax.js");

// Connect to the mysql database.
$DBconnection = ConnectToDatabase();

// Read in the inputed instructor information from the form.
$ExamSummaryID = $_REQUEST["ExamSummaryID"];
$StudentID = $_REQUEST["StudentID"];

// Check if all inputs are empty.
if(empty($ExamSummaryID))
{
    echo "Eingabefehler. Bitte Prüfung auswählen.";
}
else
{
    // Query to search for exams with the same id (should be one!).
    $Query = "SELECT * FROM exams_summary WHERE exam_summary_id= '$ExamSummaryID'";
    $ExamSummaryResult = mysqli_query($DBconnection, $Query);
    $ExamSummaryCount = mysqli_num_rows($ExamSummaryResult);

    //Fetch results.
    $ExamSummaryRs = mysqli_fetch_array($ExamSummaryResult);

    // Create a overview with infos about the exam.
    echo '<form name = "ExamStudentStart">';
    echo '<fieldset>'; 
    echo '<label> Prüfung: '. $ExamSummaryRs['exam_summary_title'] .'</label><br>';

    $ExamID = $ExamSummaryRs['exam_id'];
    
    // Query to search for all exam questions.
    $Query = "SELECT * FROM exams WHERE exam_id= '$ExamID'";
    $ExamResult = mysqli_query($DBconnection, $Query);
    $ExamCount = mysqli_num_rows($ExamResult);

    //Fetch results.
    $ExamRs = mysqli_fetch_array($ExamResult);

    echo '<label> Prüfungstitel: '. $ExamRs['exam_title'] .'</label><br>';
    echo '<label> Prüfungsstart: '. $ExamSummaryRs['exam_summary_startdate'] .'</label><br>';
    echo '<label> Prüfungsdauer in Minuten: '. $ExamSummaryRs['exam_summary_duration_in_min'] .'</label><br>';

    // Query to search for all exam questions.
    $Query = "SELECT * FROM exam_questions WHERE exam_id= '$ExamID' ORDER BY question_id ASC";
    $ExamQuestionsResult = mysqli_query($DBconnection, $Query);
    $ExamQuestionsCount = mysqli_num_rows($ExamQuestionsResult);

    echo '<label> Fragen Anzahl: '. $ExamQuestionsCount .'</label><br>';

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

    $ExamSummaryStartDate = $ExamSummaryRs['exam_summary_startdate'];
    $ExamSummaryDuration = $ExamSummaryRs['exam_summary_duration_in_min'];
    $ExamSummaryDurationAbsolute = $ExamSummaryRs['exam_summary_duration_absolute'];
    
    echo '<label> Gesamt Punktzahl: '. $ExamQuestionsPoints .'</label><br>';
    echo '<input type = "hidden" id = "ExamSummaryIDForm" value = "'. $ExamSummaryID .'"> </input><br>';
    echo '<div id="DateTime"></div>';
    echo '<input type = "hidden" id = "ExamIDForm" value = "'. $ExamID .'"> </input><br>';
    echo '<input type = "hidden" id = "ExamSummaryStartDateForm" value = "'. $ExamSummaryStartDate .'"> </input><br>';
    echo '<input type = "hidden" id = "ExamSummaryDurationForm" value = "'. $ExamSummaryDuration .'"> </input><br>';
    echo '<input type = "hidden" id = "ExamSummaryDurationAbsoluteForm" value = "'. $ExamSummaryDurationAbsolute .'"> </input><br>';
    echo '<input type="button" id="StartExamButtonForm" name="StartExamButton" class="Button" value="Prüfung starten!" onclick = "StartExam()">';
    echo '</fieldset>';
    echo '</form>';
}
?> 


