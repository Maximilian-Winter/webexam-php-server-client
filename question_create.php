<?php
session_start(); 
include "helper.php";
// Connect to the mysql database.
$DBconnection = ConnectToDatabase();

// Add html header with site information
AddHtmlHeader("Frage erstellen", "html", "css/style.css", "utf-8", "de-DE");
 
if($_SESSION["Usertype"] == "Instructor" AND $_SESSION["LoggedIn"] == true)
{
    echo '<h3><a href="instructor_home.php">Zurück zur Startseite</a></h3>';

    // Read in the inputed category information from the form.
    $questiontitle = $_POST["QuestionTitle"];
    $questiontext = $_POST["QuestionText"];
    $questioncategory = $_POST["CategoryListForm"];
    $numberOfAnswers =  $_POST["numberOfAnswers"];

    $showQuestionTitle = false;
    $zero_points_if_all_answers_selected = false;
    $question_is_multiplechoice = false;

    //Check if the check box is checked and save its value in a boolean variable.
    if(isset($_POST["ZeroPointIfAllAnswersSelected"]))
    {
        if ($_POST["ZeroPointIfAllAnswersSelected"] == 'true')
        {
            $zero_points_if_all_answers_selected = true;
        }
    }

    //Check if the check box is checked and save its value in a boolean variable.
    if(isset($_POST["QuestionIsMultipleChoice"]))
    {
        if ($_POST["QuestionIsMultipleChoice"] == 'true')
        {
            $question_is_multiplechoice = true;
        }
    }

    //Check if the check box is checked and save its value in a boolean variable.
    if(isset($_POST["ShowQuestionTitle"]))
    {
    if ($_POST["ShowQuestionTitle"] == 'true')
    {
            $showQuestionTitle = true;
    }
    }

    // Check if all inputs are valid.
    if(empty($questiontitle) OR empty($questiontext) OR empty($questioncategory))
    {
        echo "Eingabefehler. Bitte alle Felder ausfüllen. <br> <a href=\"question_createform.php\">Zurück</a>";
    }
    else 
    {     
        // Query to check if category already exist.
        $query = "SELECT question_id FROM questions WHERE question_title LIKE '$questiontitle'";
        $result = mysqli_query($DBconnection, $query);
        $count = mysqli_num_rows($result);

        // Check if the category with the username already exist.
        if($count == 0)
        {
            // Insert the questions information into the database and check if the query is successful.
            $query = "INSERT INTO questions (category_id, question_title, question_text, question_zero_points_if_all_answers_selected, question_show_title, question_is_multiplechoice) VALUES ($questioncategory,'$questiontitle', '$questiontext', ' $zero_points_if_all_answers_selected', '$showQuestionTitle', '$question_is_multiplechoice')";
            if (mysqli_query($DBconnection, $query)) 
            {
                $questionID = $DBconnection->insert_id;

                // Insert the questions answers into the database and check if the query is successful.
                for($i = 0; $i < $numberOfAnswers; $i++)
                {
                    $answertitle = $_POST["AnswerTitle" . $i];
                    $answertext = $_POST["AnswerText" . $i];
                    $answerpoints = $_POST["AnswerPoints" . $i];
                    $showAnswerTitle = false;
                    
                    if(isset($_POST["ShowAnswerTitle" . $i]))
                    {
                        if ($_POST["ShowAnswerTitle" . $i] == 'true')
                        {
                        $showAnswerTitle = true;
                        }
                    }
                            
                    $query = "INSERT INTO answers (question_id, answer_title, answer_text, answer_points, answer_show_title) VALUES ($questionID,'$answertitle', '$answertext', '$answerpoints', '$showAnswerTitle')";
                                
                    if (!mysqli_query($DBconnection, $query)) 
                    {
                        echo "Fehler beim Speichern der Antwort.<br>";
                        echo "Error: " . $query . "<br>" . mysqli_error($DBconnection);
                        echo "<br> <a href=\"question_createform.php\">Zurück</a> <br>";
                        exit;
                    }
                }
                echo "<br>Frage erfolgreich gespeichert!<br>";
                
            }
            else 
            {
                echo "Fehler beim Speichern der Frage.<br>";
                echo "Error: " . $query . "<br>" . mysqli_error($DBconnection);
                echo "<br> <a href=\"question_createform.php\">Zurück</a> <br>";
            }
        }
        else
        {
            echo "Frage schon vorhanden! <br> <a href=\"question_createform.php\">Zurück</a> <br>";
        }
    }

}
else
{
	echo 'Kein Zugriff auf diese Seite!';
	if($_SESSION["Usertype"] == "Student" AND $_SESSION["LoggedIn"] == true)
	{
		echo '<h3><a href="student_home.php">Zurück zur Startseite</a></h3>';
	}
	else
	{
		echo '<h3><a href="index.php">Zurück zur Startseite</a></h3>';
	}
}

 // Add html footer.
 AddHtmlFooter();
?> 