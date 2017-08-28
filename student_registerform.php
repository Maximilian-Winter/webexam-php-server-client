 <?php
 include "helper.php";
 // Add html header with site information
AddHtmlHeader("Student erstellen", "html", "css/style.css", "utf-8", "de-DE");
AddJSScript("js/form_validation.js");
?>
  <div class = "form-container">
    <h1>Registrieren</h1>    
    <form name = "register_form" action="student_register.php" onSubmit="return ValidateStudentRegisterform();" method="post">
      <fieldset>
        <div id= "username">
          <label> Benutzername:  
            <input type="text" class="Feld" size="16" maxlength="50" name="Username">
          </label> 
        </div>
        <div id = "password">
          <label> Passwort: 
            <input type="password" class="Feld" size="16" maxlength="50" name="Password">
          </label> 
        </div>
        <div id = "password">
          <label> Passwort wiederholen: 
            <input type="password" class="Feld" size="16" maxlength="50" name="PasswordRepeat">
          </label> 
        </div>
      </fieldset>

      <fieldset>
        <div id= "title"> 
          <label> Anrede: 
            <label> Herr 
              <input type="radio" name="Title" value="Herr">
            </label> 
            <label> Frau
              <input type="radio" name="Title" value="Frau">
            </label> 
          </label> 
        </div>
        <div id = "firstname">
          <label> Vorname: 
            <input type="text" class="Feld" size="16" maxlength="50" name="Firstname">
          </label> 
        </div>
        <div id = "lastname">
          <label> Nachname: 
            <input type="text" class="Feld" size="16" maxlength="50" name="Lastname">
          </label> 
        </div>
        <div id = "birthdate">
          <label> Geburtsdatum: 
            <input type="text" class="Feld" size="16" maxlength="50" name="Birthdate">
          </label> 
        </div>
        <?php
          echo CreateFormCategorylist();
        ?>
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