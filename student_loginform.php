<?php
 include "helper.php";
 // Add html header with site information
AddHtmlHeader("Student einloggen", "html", "css/style.css", "utf-8", "de-DE");
?>
    <h1>Anmeldung</h1>
    <?php
if(isset($_POST['anmelden']))
{
?>
    <h1>Fehlermeldung....</h1>
    <h1>Passwort oder Benutzername falsch!</h1>
<?php
}
?>

<form action="student_login.php" method="post">	
	<div id = "username">			
		<p>Benutzername:</p>
		<input type="text" Class="Feld" size="16" maxlength="50" name="Username">
	</div>

	<div id = "password">
		<p>Passwort:<p>
		<input type="password" Class="Feld" size="16" maxlength="50" name="Password">
	</div>

	<input type="submit" name='anmelden' class="button" value="Anmelden">
</form>

 <?php
 // Add html footer.
AddHtmlFooter();
?>
