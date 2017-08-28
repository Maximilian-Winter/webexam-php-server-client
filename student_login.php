<?php
session_start();
include "helper.php";
// Connect to the mysql database.

$DBconnection = ConnectToDatabase();
 
// Save the username from the loginform and hash the password.
$Username = $_POST["Username"];
$Password = hash('sha512', $_POST["Password"]);

// Query to check if student exist.
$Query = "SELECT student_id, student_username, student_password FROM students WHERE student_username = '$Username' LIMIT 1";
$Result = mysqli_query($DBconnection, $Query);

$Count = mysqli_num_rows($Result);
$Row = mysqli_fetch_object($Result);

// Check if the student exist. 
if(	$Count == 0)
{
	echo '<h3><a href="student_loginform.php">Login nicht erfolgreich! Benutzername oder Passwort falsch! Hier klicken um es erneut zu versuchen.</a></h3>';
	exit;
}

// Check if the saved hash of the student password equal to the inputed password. 
if($Row->student_password == $Password)
{
	$_SESSION["Username"] = $Username;
	$_SESSION["Usertype"] = "Student";
	$_SESSION["LoggedIn"] = true;
	$_SESSION["StudentID"] =  $Row->student_id;
	
		
	echo '<h3><a href="student_home.php">Login erfolgreich! Hier klicken um fortzufahren.</a></h3>';
	exit;
}
else
{
	echo '<h3><a href="student_loginform.php">Login nicht erfolgreich! Benutzername oder Passwort falsch! Hier klicken um es erneut zu versuchen.</a></h3>';
	exit;
}
?> 