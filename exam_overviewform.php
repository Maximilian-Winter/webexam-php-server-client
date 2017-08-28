<?php
session_start();
include "helper.php";
 // Add html header with site information
AddHtmlHeader("Webexam", "html", "css/style.css", "utf-8", "de-DE");
AddJSScript("js/ajax.js");


if($_SESSION["Usertype"] == "Instructor" AND $_SESSION["LoggedIn"] == true)
{
    $DBconnection = ConnectToDatabase();

    $ExamID = $_REQUEST["ExamID"];
    CreateFormExamOverview($DBconnection, $ExamID);
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