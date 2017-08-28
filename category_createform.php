<?php
session_start();

include "helper.php";
// Add html header with site information
AddHtmlHeader("Kategorie erstellen", "html", "css/style.css", "utf-8", "de-DE");

if($_SESSION["Usertype"] == "Instructor" AND $_SESSION["LoggedIn"] == true)
{
  echo '<h3><a href="instructor_home.php">Zurück zur Startseite</a></h3>';
  echo '<h1>Kategorie erstellen</h1> ';
  echo '<form action="category_create.php" onSubmit="" method="post">';

  echo '  <div id= "category-title">';
  echo '    <p>Kategorie Title: </p>';
  echo '    <input type="text" class="Feld" size="16" maxlength="50" name="CategoryTitle">';
  echo '  </div>';
    
  echo '  <div id = "category-description">';
  echo '    <p>Kategorie Beschreibung: </p>';
  echo '    <input type="text" class="Feld" size="16" maxlength="255" name="CategoryDescription">';
  echo '  </div>';
    
  echo '  <div id = "button-create">';
  echo '      <input type="submit" name="CreateCategory" value="Kategorie erstellen">';
  echo '  </div>';
    
  echo '  <div id="error" style="errorformat color: #F00;">';
  echo '</div>';
    
  echo ' </form>';
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
