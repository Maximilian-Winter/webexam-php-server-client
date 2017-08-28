<?php
session_start();
include "helper.php";

// Add html header with site information
AddHtmlHeader("Home", "html", "css/style.css", "utf-8", "de-DE");

if($_SESSION["Usertype"] == "Instructor" AND $_SESSION["LoggedIn"] == true)
{
	// Connect to the mysql database.
	$DBconnection = ConnectToDatabase();

	// Read in the username from the session varialble.
	$Username = $_SESSION["Username"];

	// Query to get the title and the lastname from the student for a greeting.
	$Query = "SELECT instructor_title, instructor_lastname FROM instructors WHERE instructor_username = '$Username' LIMIT 1";;
			
	$Result = mysqli_query($DBconnection, $Query);
	$Row = mysqli_fetch_object($Result);

	PrintTitle($Row->instructor_title, $Row->instructor_lastname);

	echo '<h3><a href="category_createform.php">Kategorie erstellen</a></h3><br>';
	echo '<h3><a href="exam_createform.php">Prüfung erstellen</a></h3><br>';
	echo '<h3><a href="question_createform.php">Frage erstellen</a></h3><br>';
	echo '<h3><a href="exam_searchform.php">Prüfung bearbeiten</a></h3><br><br>';

	echo '<h3><a href="exam_summary_createform.php">Prüfung starten</a></h3>';
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