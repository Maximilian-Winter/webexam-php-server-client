 <?php
 include "helper.php";
 // Add html header with site information
AddHtmlHeader("Webexam", "html", "css/style.css", "utf-8", "de-DE");
?>
<h1>Willkommen!</h1>
<div id = "site-start">
    <h3><a href="student_loginform.php">Student anmelden</a></h3>
    <h3><a href="student_registerform.php">Student registrieren</a></h3>
    <h3><a href="admin_loginform.php">Admin anmelden</a></h3>
    <h3><a href="instructor_loginform.php">Dozent anmelden</a></h3>
</div>
 <?php
 // Add html footer.
AddHtmlFooter();
?>