 <?php
 include "helper.php";
 // Add html header with site information
AddHtmlHeader("Admin einloggen", "html", "css/style.css", "utf-8", "de-DE");
?>
<form action="admin_login.php" method="post">	
	<h1>Anmeldung</h1>
    <?php
	if(isset($_POST['anmelden']))
	{
	?>
		<h1>Fehlermeldung...</h1>
		<h1>Passwort oder Benutzername falsch!</h1>
	<?php
	}
	?>
	<div id = "username">			
		<p>Benutzername:</p>
		<input type="text" Class="Feld" size="16" maxlength="50" name="username">
	</div>
	<div id = "password">
		<p>Passwort:<p>
		<input type="password" Class="Feld" size="16" maxlength="50" name="password">
	</div>
	<input type="submit" name='anmelden' class="button" value="Anmelden">
</form>
<?php
// Add html footer.
AddHtmlFooter();
?> 