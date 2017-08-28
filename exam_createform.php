<?php
session_start();
include "helper.php";
// Add html header with site information
AddHtmlHeader("Prüfung erstellen", "html", "css/style.css", "utf-8", "de-DE");

if($_SESSION["Usertype"] == "Instructor" AND $_SESSION["LoggedIn"] == true)
{
  echo '<h3><a href="instructor_home.php">Zurück zur Startseite</a></h3>';

  echo '<h1>Prüfung erstellen</h1>';    
  echo '  <form action="exam_create.php" onSubmit="" method="post">';
  echo '    <fieldset>';
  echo '      <div id= "exam-title">';
  echo '        <label>Prüfungstitel: <input type="text" class="Feld" size="16" maxlength="50" name="ExamTitle"></label>';
  echo '      </div>';
        
  echo '     <div id= "exam-description">';
  echo '        <label>Prüfungsbeschreibung: <input type="text" class="Feld" size="16" maxlength="255" name="ExamDescription"></label>';
  echo '      </div>';
            
  echo CreateFormCategorylist();
        
  echo '       <div id = "button-create">';
  echo '         <input type="submit" name="CreateExam" class="button" value="Prüfung erstellen">';
  echo '       </div>';
        
  echo '       <div id="error" style="errorformat color: #F00;">';
  echo '       </div>';
  echo '      </fieldset>';
  echo '    </form>';
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