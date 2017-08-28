<?php
session_start();
 include "helper.php";
 // Add html header with site information
AddHtmlHeader("Frage erstellen", "html", "css/style.css", "utf-8", "de-DE");
AddJSScript("js/webexamCreateQuestion.js");


if($_SESSION["Usertype"] == "Instructor" AND $_SESSION["LoggedIn"] == true)
{
  echo '<h3><a href="instructor_home.php">Zurück zur Startseite</a></h3>';
  echo '  <h1>Frage erstellen</h1>';
  echo '  <form name = "create_question_form" action="question_create.php" onSubmit="" method="post">';
  echo '      <fieldset> ';
  echo '       <div id= "question-title">';
  echo '          <label>Fragen Titel:';
  echo '            <input type="text" class="Feld" size="16" maxlength="50" name="QuestionTitle">';
  echo '          </label>';
  echo '          <label>';
  echo '           Soll der Titel angezeigt werden? <input type="checkbox" name="ShowQuestionTitle" value="true" checked>';
  echo '          </label>';
  echo '        </div>';
  echo '        <div id= "question-text">';
  echo '          <label>Fragen Text:';
  echo '            <input type="textarea" class="Feld" size="16" maxlength="255" name="QuestionText">';
  echo '          </label>';
  echo '       </div>';

  echo CreateFormCategorylist();

  echo '      </fieldset>';
        
  echo '      <fieldset>  ';
  echo '        <input type = "hidden" value = "Anzahl an Antworten" name = "numberOfAnswers">';
  echo '        <div id="answerList">';
  echo '        </div>';
  echo '        <script type="text/javascript">';
  echo '          addAnswer(\'answerList\');';
  echo '        </script>';
  echo '        <div id= "question-answers">';
  echo '          <input type = "button" value = "Antwort hinzufuegen" onClick="addAnswer(\'answerList\');">';
  echo '          <input type = "button" value = "Antwort entfernen" onClick="removeAnswer(\'answerList\');">';
  echo '        </div>';
  echo '      </fieldset>';
        
  echo '      <fieldset> ';
  echo '        <p><label>';
  echo '            Ist die Frage eine Multiple Choice Frage? <input type="checkbox" name="QuestionIsMultipleChoice" value="true" unchecked>';
  echo '        </label></p>';
  echo '      </fieldset> ';
  echo '      <fieldset> ';
  echo '        <p><label>';
  echo '           Die Frage mit Null Punkten bewerten, wenn alle Antworten ausgewählt werden? <input type="checkbox" name="ZeroPointIfAllAnswersSelected" value="true" unchecked>';
  echo '        </label></p>';
  echo '      </fieldset> ';
        
  echo '      <div id = "button-create">';
  echo '        <input type="submit" name="CreateQuestion" value="Frage erstellen">';
  echo '      </div>';
        
  echo '      <div id="error" style="errorformat color: #F00;">';
  echo '      </div>';
  echo '     </form>';
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