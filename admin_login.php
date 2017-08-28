<?php
include "helper.php";
// Connect to the mysql database.
$DBconnection = ConnectToDatabase();

// Save the username from the loginform and hash the password.
$username = $_POST["username"];
$password = hash('sha512', $_POST["password"]);

// Query to check if the admin exist.
$query = "SELECT * FROM admins WHERE admin_username = '$username' LIMIT 1";
$result = mysqli_query($DBconnection, $query);

$count = mysqli_num_rows($result);
$row = mysqli_fetch_object($result);

// Check if the instructor exist. 
if(	$count == 0)
{
	//include("admin_loginform.php");
	echo "FALSCH";
	exit;
}

// Check if the saved hash of the instructor password equal to the inputed password. 
if($row->admin_password == $password)
{
	// Start session and save username in session variable.
	session_start();
	$_SESSION["username"] = $username;
	$_SESSION["usertype"] = "admin";
	$_SESSION["loggedin"] = true;
	
	echo "RICHTIG";
	//include("admin_overview.php");
	exit;
}
else
{
	//include("admin_loginform.php");
	echo "FALSCH";
	exit;
}

?> 