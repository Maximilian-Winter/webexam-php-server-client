<?php
session_start();
include "helper.php";

// Connect to the mysql database.
$DBconnection = ConnectToDatabase();

// Add html header with site information
AddHtmlHeader("Home", "html", "css/style.css", "utf-8", "de-DE");
 
// Read in the username from the session varialble.
$Username = $_SESSION["Username"];

// Query to get the title and the lastname from the student for a greeting.
$Query = "SELECT student_title, student_lastname FROM students WHERE student_username = '$Username' LIMIT 1";
		
$Result = mysqli_query($DBconnection, $Query);
$Row = mysqli_fetch_object($Result);

PrintTitle($Row->student_title, $Row->student_lastname);

echo '<h3><a href="exam_summary_start_exam_form.php">An Prüfung teilnehmen!</a></h3>';
// Add html footer.
 AddHtmlFooter();
?> 
