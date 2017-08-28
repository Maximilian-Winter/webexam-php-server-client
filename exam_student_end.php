<?php
include "helper.php";
AddJSScript("js/ajax.js");
$DBconnection = ConnectToDatabase();

$ExamSummaryID = $_REQUEST["ExamSummaryID"]; 
$StudentID = $_REQUEST["StudentID"]; 

// Check if all inputs are empty.
if(empty($ExamSummaryID) OR empty($StudentID))
{
    echo "Fehler: Nicht alle Angaben zum Speichern des Ergebnis der Prüfung.";
}
else
{
    // Query to search for exam in the summary with the same id (should be one!).
    $Query = "SELECT * FROM exams_summary WHERE exam_summary_id= '$ExamSummaryID'";
    $ExamSummaryResult = mysqli_query($DBconnection, $Query);
    $ExamSummaryCount = mysqli_num_rows($ExamSummaryResult);
    
     if($ExamSummaryCount == 1)
    {   
        //Fetch results.
        $ExamSummaryRs = mysqli_fetch_array($ExamSummaryResult);

        $ExamID = $ExamSummaryRs['exam_id'];
        $GradingSystemID = $ExamSummaryRs['grading_system_id'];

        // Query to search for students with the same id (should be one!).
        $Query = "SELECT * FROM students WHERE student_id= '$StudentID'";
        $StudentsResult = mysqli_query($DBconnection, $Query);
        $StudentsCount = mysqli_num_rows($StudentsResult);

         if($StudentsCount == 1)
        {   
            // Check if student already answer the qustion and update the entry.
            $Query = "SELECT * FROM exam_student_answers WHERE exam_summary_id = '$ExamSummaryID' AND student_id =  '$StudentID'";
            $StudentAnswerResult = mysqli_query($DBconnection, $Query);
            $StudentAnswerCount = mysqli_num_rows($StudentAnswerResult);

            $Query = "SELECT * FROM exam_student_end WHERE student_id= '$StudentID' AND exam_summary_id= '$ExamSummaryID'";
            $ExamStudentEndResult = mysqli_query($DBconnection, $Query);
            $ExamStudentEndCount = mysqli_num_rows($ExamStudentEndResult);

            if($ExamStudentEndCount == 0)
            {   
                // Insert the questions information into the database and check if the query is successful.
                $query = "INSERT INTO exam_student_end (exam_student_enddate, exam_summary_id, student_id) VALUES (NOW(), $ExamSummaryID, $StudentID)";

                if (!mysqli_query($DBconnection, $query)) 
                {
                    echo "Fehler beim Speichern.<br>";
                    echo "Error: " . $query . "<br>" . mysqli_error($DBconnection);
                    exit;
                }
                
                $StudenExamPoints = 0;

                while($StudentAnswerRs=mysqli_fetch_array($StudentAnswerResult))
                {
                    $AnswerID = $StudentAnswerRs['answer_id'];
                    $QuestionID = $StudentAnswerRs['question_id'];

                    // Query to get question data.
                    $Query = "SELECT * FROM questions WHERE question_id LIKE '$QuestionID'";
                    $QuestionResult = mysqli_query($DBconnection, $Query);
                    $QuestionCount = mysqli_num_rows($QuestionResult);
                    
                    //Fetch results.
                    $QuestionRs = mysqli_fetch_array($QuestionResult);

                    $QuestionIsMultipleChoice = $QuestionRs['question_is_multiplechoice'];
                    $ZeroPointsIfAllAnswersSelected = $QuestionRs['question_zero_points_if_all_answers_selected'];

                    // Query to get answer count.
                    $Query = "SELECT * FROM answers WHERE question_id LIKE '$QuestionID'";
                    $QuestionAnswerResult = mysqli_query($DBconnection, $Query);
                    $QuestionAnswerCount = mysqli_num_rows($QuestionAnswerResult);

                    // Check if student already answer the qustion and update the entry.
                    $Query = "SELECT * FROM exam_student_answers WHERE exam_summary_id = '$ExamSummaryID' AND student_id =  '$StudentID' AND question_id = '$QuestionID'";
                    $StudentQuestionAnswerResult = mysqli_query($DBconnection, $Query);
                    $StudentQuestionAnswerCount = mysqli_num_rows($StudentQuestionAnswerResult);

                    if($StudentQuestionAnswerCount == $QuestionAnswerCount AND $QuestionIsMultipleChoice == true AND $ZeroPointsIfAllAnswersSelected == true)
                    {
                        //Add zero points if all answers of a multiply choice question are selected and the flag is set.
                        $StudenExamPoints += 0;
                    }
                    else 
                    {
                        // Query to get answer data.
                        $Query = "SELECT * FROM answers WHERE answer_id LIKE '$AnswerID'";
                        $AnswerResult = mysqli_query($DBconnection, $Query);
                        $AnswerCount = mysqli_num_rows($AnswerResult);
                        
                        //Fetch results.
                        $AnswerRs = mysqli_fetch_array($AnswerResult);

                        $AnswerPoints = $AnswerRs['answer_points'];
                        
                        //Add answer points to question
                        $StudenExamPoints += $AnswerPoints;
                    }
                }

                // Query to get student start date.
                $Query = "SELECT * FROM exam_student_start WHERE student_id= '$StudentID' AND exam_summary_id= '$ExamSummaryID'";
                $StudentStartResult = mysqli_query($DBconnection, $Query);
                $StudentStartCount = mysqli_num_rows($StudentStartResult);
                
                //Fetch results.
                $StudentStartRs = mysqli_fetch_array($StudentStartResult);
                $StudentStartDate = $StudentStartRs['exam_student_startdate'];

                // Query to get student end date.
                $Query = "SELECT * FROM exam_student_end WHERE student_id= '$StudentID' AND exam_summary_id= '$ExamSummaryID'";
                $StudentEndResult = mysqli_query($DBconnection, $Query);
                $StudentEndCount = mysqli_num_rows($StudentEndResult);
                
                //Fetch results.
                $StudentEndRs = mysqli_fetch_array($StudentEndResult);
                $StudentEndDate = $StudentEndRs['exam_student_enddate'];

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

                $StudentExamPointPercent = ($StudenExamPoints / $ExamQuestionsPoints) * 100;

                // Query to search for all exam questions.
                $Query = "SELECT * FROM grading_system_grades WHERE grading_system_id= '$GradingSystemID'";
                $GradingSystemResult = mysqli_query($DBconnection, $Query);
                $GradingSystemCount = mysqli_num_rows($GradingSystemResult);

                $StudentResultGradeTitle = "";

                while($GradingSystemRs=mysqli_fetch_array($GradingSystemResult))
                {
                    $GradeRangeStart = $GradingSystemRs['grade_point_range_start'];
                    $GradeRangeEnd = $GradingSystemRs['grade_point_range_end'];

                    if($GradeRangeStart <= $StudentExamPointPercent AND $GradeRangeEnd >= $StudentExamPointPercent)
                    {
                        $StudentResultGradeTitle = $GradingSystemRs['grade_title'];
                    }
                }

                // Query to get student start date.
                $Query = "SELECT * FROM exam_student_results WHERE student_id= '$StudentID' AND exam_summary_id= '$ExamSummaryID'";
                $StudentExamResult = mysqli_query($DBconnection, $Query);
                $StudentExamCount = mysqli_num_rows($StudentExamResult);
                
                if($StudentExamCount == 0)
                {
                    // Insert the student exam result into the database and check if the query is successful.
                    $query = "INSERT INTO exam_student_results (student_id, exam_summary_id, exam_student_result_startdate, exam_student_result_enddate, exam_student_result_points, exam_student_result_grade_title, exam_student_result_percent)
                    VALUES ('$StudentID', '$ExamSummaryID', '$StudentStartDate', '$StudentEndDate', '$StudenExamPoints', '$StudentResultGradeTitle' , '$StudentExamPointPercent')";

                    if (!mysqli_query($DBconnection, $query)) 
                    {
                        echo "Fehler beim Speichern.<br>";
                        echo "Error: " . $query . "<br>" . mysqli_error($DBconnection);
                        exit;
                    }
                }
                else
                {
                        echo "Fehler Prüfung wurde von Student schon beendet!";
                }
                
            }
            else
            {
                echo "Fehler Prüfung wurde von Student schon beendet!";
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
