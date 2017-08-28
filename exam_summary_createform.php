<?php
session_start();
include "helper.php";
 // Add html header with site information
AddHtmlHeader("Prüfung starten", "html", "css/style.css", "utf-8", "de-DE");
if($_SESSION["Usertype"] == "Instructor" AND $_SESSION["LoggedIn"] == true)
{
  echo '<h3><a href="instructor_home.php">Zurück zur Startseite</a></h3>';
  echo '  <h1>Prüfung starten</h1>';
  echo '    <form action="exam_summary_create.php" onSubmit="" method="post">';
  echo '      <fieldset>';
  echo '      <fieldset>';
  echo '        <label>';
  echo '          <label>Prüfungsname: <input type="text" class="Feld" size="16" maxlength="50" name="examsummarytitle"></label>';
  echo '        </label>';
  echo '        </fieldset>';
  echo '        <fieldset>';
  echo CreateFormExamlist();
  echo CreateFormGradingSystemlist();
  echo CreateFormCategorylist();
  echo '        </fieldset>';
  echo '        <fieldset>';
  echo '        <label>';
  echo '          <label>Prüfungsstartdatum (z.B: 11.12.1991): <input type="text" class="Feld" size="16" maxlength="255" name="examsummarystartdate"></label><br>';
  echo '          <label>Prüfungsstartzeit (z.B: 10:30): <input type="text" class="Feld" size="16" maxlength="255" name="examsummarystarttime"></label><br>';
  echo '        </label>';
  echo '        </fieldset>';
  echo '        <fieldset>';
  echo '        <label>';
  echo '          <label>Prüfungsdauer in Minuten: <input type="text" class="Feld" size="16" maxlength="50" name="examduration"></label>';
  echo '          <label>Prüfungsdauer von Startzeit der Prüfung aus berechenen?<input type="checkbox" name="examsummarydurationabsolute" value="true" unchecked></label>';
  echo '        </label>';
  echo '        </fieldset>';
  echo '        <div id = "button-create">';
  echo '          <input type="submit" name="create_exam" class="button" value="Prüfung starten">';
  echo '        </div>';
          
  echo '        <div id="error" style="errorformat color: #F00;">';
  echo '        </div>';
  echo '       </fieldset>';
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