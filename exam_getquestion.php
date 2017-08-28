<?php
include "helper.php";
AddJSScript("js/ajax.js");
$DBconnection = ConnectToDatabase();

$ExamID = $_REQUEST["ExamID"];
$QuestionNumber = $_REQUEST["QuestionNumber"];

 // Query to search for all exam questions.
$Query = "SELECT * FROM exam_questions WHERE exam_id = '$ExamID' ORDER BY question_id ASC";
$ExamQuestionResult = mysqli_query($DBconnection, $Query);
$ExamQuestionCount = mysqli_num_rows($ExamQuestionResult);

if($ExamQuestionCount > 0)
{
   $QuestionIterator = 0;
   $QuestionID = 0;

    while($row = mysqli_fetch_array($ExamQuestionResult))
    {
        if($QuestionIterator == $QuestionNumber)
        {
            $QuestionID = $row['question_id'];
        }

         $QuestionIterator += 1;
    }

    // Query to search for all exam questions.
    $Query = "SELECT * FROM questions WHERE question_id = '$QuestionID' ORDER BY question_id ASC";
    $QuestionResult = mysqli_query($DBconnection, $Query);
    $QuestionCount = mysqli_num_rows($QuestionResult);
        
    if($QuestionCount > 0)
    {
        
        //Fetch results.
        $QuestionRs = mysqli_fetch_array($QuestionResult);
        $QuestionIsMultipleChoice = $QuestionRs['question_is_multiplechoice'];

        // Create a overview with infos about the exam.
        echo '<form name = "ExamStudentQuestion">';
        echo '<fieldset>'; 
        echo '<label> '. $QuestionRs['question_title'] .'</label><br>';
        echo '<label> '. $QuestionRs['question_text'] .'</label><br>';

        // Query to search for all exam questions.
        $Query = "SELECT * FROM answers WHERE question_id LIKE '$QuestionID'";
        $AnswerResult = mysqli_query($DBconnection, $Query);
        $AnswerCount = mysqli_num_rows($AnswerResult);

        $AnswerIterator = 0;
        while($AnswerRs=mysqli_fetch_array($AnswerResult))
        {
            echo '<fieldset>'; 
            echo '<label>'. $AnswerRs['answer_title'] .'</label><br>';
            echo '<label>'. $AnswerRs['answer_text'] .'</label>';
            if($QuestionIsMultipleChoice)
            {
                echo '<input type="checkbox" id ="AnswerIDForm'.$AnswerIterator.'" name="StudentAnswerIDForm" value="' . $AnswerRs['answer_id'] . '" unchecked><br>';
            }
            else
            {
                echo '<input type="radio" id ="AnswerIDForm'.$AnswerIterator.'" name="StudentAnswerIDForm" value="' . $AnswerRs['answer_id'] . '"><br>';
            }
            echo '</fieldset>';
            $AnswerIterator += 1;
            //echo '<br><br>';   
        }
        echo '<input type = "hidden" id = "AnswerCount" value = "'. $AnswerCount .'"> </input><br>';
        echo '<input type = "hidden" id = "QuestionIsMultipleChoice" value = "'. $QuestionIsMultipleChoice .'"> </input><br>';
        echo '<input type = "hidden" id = "QuestionIDForm" value = "'. $QuestionID .'"> </input><br>';
        echo '<input type = "hidden" id = "QuestionNumber" value = "'. $QuestionNumber .'"> </input><br>';

        if($QuestionNumber > 0)
        {
            echo '<input type="button" id="GetPreviousExamQuestionButtonForm" name="GetPreviousExamQuestionButton" class="Button" value="< - Vorherige Frage" onclick = "GetPreviousExamQuestion()">';
        }

        if(($ExamQuestionCount - 1) > $QuestionNumber)
        {
            echo '<input type="button" id="GetNextExamQuestionButtonForm" name="GetNextExamQuestionButton" class="Button" value="Nächste Frage - >" onclick = "GetNextExamQuestion()">';
        }
        
        echo '</fieldset>';
        echo '</form>';
    }
    else
    {
        echo 'Fehler: Frage in Datenbank nicht gefunden!';
        echo 'ExamID: ' . $ExamID . '<br>';
        echo 'QuestionNumber: ' . $QuestionNumber . '<br>';
        echo 'ExamID: ' . $QuestionID . '<br>';
        
    }
}
else
{
    echo 'Fehler: Keine Fragen zu Prüfung in Datenbank gefunden!';
}

?> 