<?php
session_start(); 
include "helper.php";
// Add html header with site information
AddHtmlHeader("Prüfung erstellen", "html", "css/style.css", "utf-8", "de-DE");

if($_SESSION["Usertype"] == "Instructor" AND $_SESSION["LoggedIn"] == true)
{
    echo '<h3><a href="instructor_home.php">Zurück zur Startseite</a></h3>';
    // Connect to the mysql database.
    $DBconnection = ConnectToDatabase();

    // Read in the inputed instructor information from the form.
    $examtitle = $_POST["ExamTitle"];
    $examdescription = $_POST["ExamDescription"];
    $examcategory = $_POST["CategoryListForm"];

    // Check if all inputs are valid.
    if(empty($examtitle) OR empty($examdescription) OR empty($examcategory))
    {
        echo "Eingabefehler. Bitte alle Felder ausfüllen. <br> <a href=\"exam_createform.php\">Zurück zur Erstellung</a>";
    }
    else
    {
        // Query to check if user already exist.
        $query = "SELECT exam_id FROM exams WHERE exam_title LIKE '$examtitle'";
        $result = mysqli_query($DBconnection, $query);
        $count = mysqli_num_rows($result);

        // Check if the instructor with the username already exist.
        if($count == 0)
        {
            // Insert the instructor information into the database and check if the query is successful.
            $query = "INSERT INTO exams (exam_title, exam_description, category_id) VALUES ('$examtitle', '$examdescription', '$examcategory')";
            if (mysqli_query($DBconnection, $query)) 
            {
                // echo $query;
                echo "Erstellung erfolgreich! <br>";
            }
            else 
            {
                echo "Fehler beim Speichern des Tests. <br>";
                echo "Error: " . $query . "<br>" . mysqli_error($DBconnection);
                echo "<br> <a href=\"exam_createform.php\">Zurück</a>";
            }
        }
        else
        {
            echo "Test mit dem gleichen Namen schon vorhanden! <br> <a href=\"exam_createform.php\">Zurück</a> <br>";
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