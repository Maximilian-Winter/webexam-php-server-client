<?php
session_start();
include "helper.php";

// Add html header with site information
AddHtmlHeader("Prüfung starten", "html", "css/style.css", "utf-8", "de-DE");
if($_SESSION["Usertype"] == "Instructor" AND $_SESSION["LoggedIn"] == true)
{
    echo '<h3><a href="instructor_home.php">Zurück zur Startseite</a></h3>';

    // Connect to the mysql database.
    $DBconnection = ConnectToDatabase();

    // Read in the inputed instructor information from the form.
    $ExamSummaryTitle = $_POST["examsummarytitle"];
    $ExamSummaryCategoryID = $_POST["CategoryListForm"];
    $ExamSummaryGradingSystemID = $_POST["GradingSystemListForm"];
    $ExamSummaryExamID = $_POST["ExamListForm"];
    $ExamSummaryStartdate = $_POST["examsummarystartdate"];
    $ExamSummaryStarttime = $_POST["examsummarystarttime"];
    $ExamSummaryDuration = $_POST["examduration"];

    $ExamSummaryDurationAbsolute = false;

    if(isset($_POST["examsummarydurationabsolute"]))
    {
    if ($_POST["examsummarydurationabsolute"] == 'true')
    {
            $ExamSummaryDurationAbsolute = true;
    }
    }

    // Check if all inputs are valid.
    if(empty($ExamSummaryTitle) OR empty($ExamSummaryCategoryID) OR empty($ExamSummaryGradingSystemID)
    OR empty($ExamSummaryExamID) OR empty($ExamSummaryStartdate) OR empty($ExamSummaryStarttime)
    OR empty($ExamSummaryDuration))
    {
        echo "Eingabefehler. Bitte alle Felder ausfüllen. <br> <a href=\"exam_summary_createform.php\">Zurück</a>";
    }
    else
    {    
        $date = new DateTime($ExamSummaryStartdate . ' ' . $ExamSummaryStarttime);
        $ExamSummaryStartdate = $date->format('Y-m-d H:i:s');

        // Query to check if exam summary entry with the same title already exist.
        $query = "SELECT exam_id FROM exams_summary WHERE exam_summary_title LIKE '$ExamSummaryTitle'";
        $result = mysqli_query($DBconnection, $query);
        $count = mysqli_num_rows($result);

        // Check if the instructor with the username already exist.
        if($count == 0)
        {
            // Insert the instructor information into the database and check if the query is successful.
            $query = "INSERT INTO exams_summary (exam_id, grading_system_id, exam_summary_title, exam_summary_startdate, exam_summary_duration_in_min, exam_summary_duration_absolute, category_id) VALUES ('$ExamSummaryExamID', '$ExamSummaryGradingSystemID', '$ExamSummaryTitle', '$ExamSummaryStartdate', '$ExamSummaryDuration', '$ExamSummaryDurationAbsolute', '$ExamSummaryCategoryID')";
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
            echo "Prüfung mit dem gleichen Namen schon vorhanden! <br> <a href=\"exam_createform.php\">Zurück</a> <br>";
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