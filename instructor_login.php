<?php
session_start();
include "helper.php";
// Connect to the mysql database.

$DBconnection = ConnectToDatabase();
 
// Save the username from the loginform and hash the password.
$Username = $_POST["Username"];
$Password = hash('sha512', $_POST["Password"]);

// Query to check if student exist.
$Query = "SELECT instructor_id, instructor_username, instructor_password FROM instructors WHERE instructor_username = '$Username' LIMIT 1";
$Result = mysqli_query($DBconnection, $Query);

$Count = mysqli_num_rows($Result);
$Row = mysqli_fetch_object($Result);

// Check if the student exist. 
if(	$Count == 0)
{
	echo '<h3><a href="instructor_loginform.php">Login nicht erfolgreich! Benutzername oder Passwort falsch! Hier klicken um es erneut zu versuchen.</a></h3>';
	exit;
}

// Check if the saved hash of the student password equal to the inputed password. 
if($Row->instructor_password == $Password)
{
	$_SESSION["Username"] = $Username;
	$_SESSION["Usertype"] = "Instructor";
	$_SESSION["LoggedIn"] = true;
	$_SESSION["InstructorID"] =  $Row->instructor_id;
	
		
	echo '<h3><a href="instructor_home.php">Login erfolgreich! Hier klicken um fortzufahren.</a></h3>';
	exit;
}
else
{
	echo '<h3><a href="instructor_loginform.php">Login nicht erfolgreich! Benutzername oder Passwort falsch! Hier klicken um es erneut zu versuchen.</a></h3>';
	exit;
}
?> 