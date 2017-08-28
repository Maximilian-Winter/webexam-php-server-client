 <?php
 
include "helper.php";
// Connect to the mysql database.
$DBconnection = ConnectToDatabase();

 // Add html header with site information
 AddHtmlHeader("Dozent erstellen", "html", "css/style.css", "utf-8", "de-DE");
 
// Read in the inputed instructor information from the form.
$username = $_POST["Username"];
$password = $_POST["Password"];
$passwordRepeat = $_POST["PasswordRepeat"];
$title = $_POST["Title"];
$firstname = $_POST["Firstname"];
$lastname = $_POST["Lastname"];
$instructorcategory = $_POST["CategoryListForm"];

// Check if all inputs are valid.
if($password != $passwordRepeat OR empty($username) OR empty($password) OR empty($firstname) OR empty($lastname) OR empty($instructorcategory))
{
    echo "Eingabefehler. Bitte alle Felder korrekt ausfüllen. <br> <a href=\"instructor_registerform.php\">Zurück</a>";
}
else
{   
    // Hash password for saving in database
    $password = hash('sha512', $password);

    // Query to check if user already exist.
    $query = "SELECT instructor_id FROM instructors WHERE instructor_username LIKE '$username'";
    $result = mysqli_query($DBconnection, $query);
    $count = mysqli_num_rows($result);

    // Check if the instructor with the username already exist.
    if($count == 0)
    {
        // Insert the instructor information into the database and check if the query is successful.
        $query = "INSERT INTO instructors (instructor_username, category_id, instructor_password, instructor_title, instructor_firstname, instructor_lastname) VALUES ('$username', '$instructorcategory', '$password', '$title', '$firstname', '$lastname')";
        if (mysqli_query($DBconnection, $query)) 
        {
            // echo $query;
            echo "Registrierung erfolgreich! <br> <a href=\"instructor_loginform.php\">Anmelden</a> <br>";
        }
        else 
        {
            echo "Fehler beim Speichern des Benutzernames. <br> <a href=\"instructor_registerform.php\">Zurück</a> <br>";
            echo "Error: " . $query . "<br>" . mysqli_error($DBconnection);
            echo "<br> <a href=\"instructor_registerform.php\">Zurück</a> <br>";
        }
    }
    else
    {
        echo "Benutzername schon vorhanden! <br> <a href=\"instructor_registerform.php\">Zurück</a> <br>";
    }
}

 // Add html footer.
 AddHtmlFooter();
 
?> 