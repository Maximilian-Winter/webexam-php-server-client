 <?php
 include "helper.php";
 // Add html header with site information
AddHtmlHeader("Admin registrieren", "html", "css/style.css", "utf-8", "de-DE");
AddJSScript("js/form_validation.js");
?>

<div class = "form-container">
  <h1>Registrieren</h1>    
  <form name = "register_form" action="admin_register.php" onSubmit="return ValidateAdminRegisterform();" method="post">
    <fieldset>
      <div id= "username">
        <label> Benutzername:  
          <input type="text" class="Feld" size="16" maxlength="50" name="username">
        </label> 
      </div>
      <div id = "password">
        <label> Passwort: 
          <input type="password" class="Feld" size="16" maxlength="50" name="password">
        </label> 
      </div>
      <div id = "password">
        <label> Passwort wiederholen: 
          <input type="password" class="Feld" size="16" maxlength="50" name="passwordRepeat">
        </label> 
      </div>
    </fieldset> 
    <div id = "button-register">
      <input type="submit" name='register' class="button" value="Registrieren">
    </div>

    <div id="error" style="errorformat color: #F00;">
    </div>
  </form>
</div>
<?php
// Add html footer.
AddHtmlFooter();
?> 