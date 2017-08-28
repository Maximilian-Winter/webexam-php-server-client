<?php
session_start();
include "helper.php";

// Add html header with site information
AddHtmlHeader("Webexam", "html", "css/style.css", "utf-8", "de-DE");
AddJSScript("js/ajax.js");

if($_SESSION["Usertype"] == "Instructor" AND $_SESSION["LoggedIn"] == true)
{
    // Connect to the mysql database.
    $DBconnection = ConnectToDatabase();

    // Read in the inputed instructor information from the form.
    $ExamId = $_REQUEST["ExamID"];
    $ExamSearch = $_REQUEST["ExamSearch"];

    // Check if all inputs are empty.
    if(empty($ExamId) AND empty($ExamSearch))
    {
        echo "Eingabefehler. Bitte Prüfung auswählen oder Suchbegriff eingeben.";
    }
    else
    {
        if(!empty($ExamId))
        {
            // Query to search for exams with the same id (should be one!).
            $Query = "SELECT * FROM exams WHERE exam_id LIKE '$ExamId'";
        }
        else 
        {
            // Query to search for exam with searchword in title.
            $Query = "SELECT * FROM exams WHERE exam_title LIKE '%$ExamSearch%'";
        }

        $Result = mysqli_query($DBconnection, $Query);
        $Count = mysqli_num_rows($Result);

        // Create a list with checkboxes to select the corresponding exam.
        echo '<form name = "ExamSearchResultForm">';
        echo '<fieldset>';
        echo '<div id= "title">'; 
        echo '<label> Gefundene Prüfungen:</label> <br>';

        $ExamIterator = 0;

        if($Count > 0)
        {      
            while($Rs=mysqli_fetch_array($Result))
            {
                echo '<label>' . $Rs['exam_title'] ;
                echo '<input type="radio" id = "ExamIDForm' . $ExamIterator . '" name="ExamSearchResultListForm" value="' . $Rs['exam_id'] . '">';
                echo '</label> <br>';

                $ExamIterator += 1;
            }
        }
        else
        {
            echo "Keine Ergebnisse gefunden!";
        } 
        echo '</div>';
        echo '<div class = "button">';
        echo '<input type="button" name="ChooseExam" class="Button" value="Prüfung auswählen" onclick = "SubmitSearchExamResultForm()">';
        echo '</div>';
        echo '</fieldset>';
        echo '</form>';   
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