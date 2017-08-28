 <?php
 include "helper.php";
 // Add html header with site information
AddHtmlHeader("Admin registrieren", "html", "css/style.css", "utf-8", "de-DE");
?>
<h1>Willkommen!</h1>
<div id = "site-start">
    <h3><a href="admin_registerform.php">Admin registrieren</a></h3>
    <h3><a href="admin_loginform.php">Admin login</a></h3>
    <h3><a href="admin_loginform.php">Admin Übersicht</a></h3>
    <h3><a href="category_createform.php">Kategorie erstellen</a></h3>
    <h3><a href="student_registerform.php">Student registrieren</a></h3>
    <h3><a href="student_loginform.php">Student anmelden</a></h3>
    <h3><a href="instructor_registerform.php">Dozent registrieren</a></h3>
    <h3><a href="instructor_loginform.php">Dozent anmelden</a></h3>
    <h3><a href="exam_createform.php">Prüfung erstellen</a></h3>
    <h3><a href="exam_searchform.php">Prüfung bearbeiten</a></h3>
    <h3><a href="question_createform.php">Frage erstellen</a></h3>
    <h3><a href="exam_summary_start_exam_form.php">An Prüfung teilnehmen!</a></h3>
</div>
<?php
// Add html footer.
AddHtmlFooter();
?> 