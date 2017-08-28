<?php
session_start();
include "helper.php";
// Add html header with site information
AddHtmlHeader("Katerogie erstellen", "html", "css/style.css", "utf-8", "de-DE");


if($_SESSION["Usertype"] == "Instructor" AND $_SESSION["LoggedIn"] == true)
{
    echo '<h3><a href="instructor_home.php">Zurück zur Startseite</a></h3>';
    // Connect to the mysql database.
    $DBconnection = ConnectToDatabase();
    // Read in the inputed category information from the form.
    $categorytitle = $_POST["CategoryTitle"];
    $categorydescription = $_POST["CategoryDescription"];
    // Check if all inputs are valid.
    if(empty($categorytitle) OR empty($categorydescription))
    {
        echo "Eingabefehler. Bitte alle Felder ausfüllen. <br> <a href=\"category_createform.php\">Zurück</a>";
    }
    else 
    {
        // Query to check if category already exist.
        $query = "SELECT category_id FROM categories WHERE category_title LIKE '$categorytitle'";
        $result = mysqli_query($DBconnection, $query);
        $count = mysqli_num_rows($result);
        // Check if the category with the username already exist.
        if($count > 0)
        {
            echo "Kategorie schon vorhanden! <br> <a href=\"category_createform.php\">Zurück</a> <br>";
        }
        else
        {
            // Insert the category information into the database and check if the query is successful.
            $query = "INSERT INTO categories (category_title, category_description) VALUES ('$categorytitle', '$categorydescription')";
            if (mysqli_query($DBconnection, $query)) 
            {
                echo "Kategorie erfolgreich gespeichert!<br>";
            }
            else 
            {
                echo "Fehler beim Speichern der Kategorie. <br> <a href=\"category_createform.php\">Zurück</a> <br>";
                echo "Error: " . $query . "<br>" . mysqli_error($DBconnection);
                echo "<br> <a href=\"category_createform.php\">Zurück</a> <br>";
            }
        }
    }
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