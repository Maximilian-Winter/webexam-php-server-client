<?php
session_start();
include "helper.php";
 // Add html header with site information
AddHtmlHeader("Webexam", "html", "css/style.css", "utf-8", "de-DE");
AddJSScript("js/ajax.js");

if($_SESSION["Usertype"] == "Instructor" AND $_SESSION["LoggedIn"] == true)
{
  echo '<h3><a href="instructor_home.php">Zurück zur Startseite</a></h3>';
  echo '<div id = "headcontent">';
  echo '  <h1>Prüfung auswählen oder suchen:</h1>';
  echo '  <form name = "SearchExamForm">';
  echo '    <fieldset>';
  echo CreateFormExamlist();
  echo '      <label>Prüfungstitel suchen: <input id = "ExamSearchForm" type="text" class="Feld" size="16" maxlength="255" name="ExamSearch"></label>';
  echo '      <input type="button" name="SubmitBttSearchExam" class="Button" value="Test auswählen" onclick="SubmitSearchExamForm()"> ';     
  echo '    </fieldset>';
  echo '  </form>';
  echo '</div>';
  echo '<div id = "maincontent">';
  echo '</div>';
  echo '<div id = "footcontent">';
  echo '</div>';
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