 <?php
 
include "helper.php";
// Connect to the mysql database.
$DBconnection = ConnectToDatabase();

 // Add html header with site information
 AddHtmlHeader("Admin registrieren", "html", "css/style.css", "utf-8", "de-DE");
 
// Read in the inputed instructor information from the form.
$username = $_POST["username"];
$password = $_POST["password"];
$passwordRepeat = $_POST["passwordRepeat"];

// Check if all inputs are valid.
if($password != $passwordRepeat OR empty($username ) OR empty($password))
{
    echo "Eingabefehler. Bitte alle Felder korekt ausfüllen. <br> <a href=\"admin_registerform.php\">Zurück</a>";
}
else
{   
    // Hash password for saving in database
    $password = hash('sha512', $password);

    // Query to check if user already exist.
    $query = "SELECT admin_id FROM admins WHERE admin_username LIKE '$username'";
    $result = mysqli_query($DBconnection, $query);
    $count = mysqli_num_rows($result);

    // Check if a admin with the username already exist.
    if($count == 0)
    {
        // Insert the admin information into the database and check if the query is successful.
        $query = "INSERT INTO admins (admin_username, admin_password) VALUES ('$username', '$password')";
        if (mysqli_query($DBconnection, $query)) 
        {
            // echo $query;
            echo "Registrierung erfolgreich! <br> <a href=\"admin_registerform.php\">Anmelden</a> <br>";
        }
        else 
        {
            echo "Fehler beim Speichern des Admins. <br>";
            echo "Error: " . $query . "<br>" . mysqli_error($DBconnection);
            echo "<br> <a href=\"admin_registerform.php\">Zurück</a>";
        }
    }
    else
    {
        echo "Benutzername schon vorhanden! <br> <a href=\"admin_registerform.php\">Zurück</a> <br>";
    }
}

 // Add html footer.
 AddHtmlFooter();
 
?> 