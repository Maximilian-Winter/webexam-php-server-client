 <?php
 
include "helper.php";
// Connect to the mysql database.
$DBconnection = ConnectToDatabase();

 // Add html header with site information
 AddHtmlHeader("Student erstellen", "html", "css/style.css", "utf-8", "de-DE");
 
// Read in the inputed student information from the form.
$username = $_POST["Username"];
$password = $_POST["Password"];
$passwordRepeat = $_POST["PasswordRepeat"];
$title = $_POST["Title"];
$firstname = $_POST["Firstname"];
$lastname = $_POST["Lastname"];
$birthdate = $_POST["Birthdate"];
$student_category = $_POST["CategoryListForm"];

// Check if all inputs are valid.
if($password != $passwordRepeat OR empty($username) OR empty($password) OR empty($birthdate) OR empty($firstname) OR empty($lastname) OR empty($student_category))
{
    echo "Eingabefehler. Bitte alle Felder ausfüllen. <br> <a href=\"student_registerform.php\">Zurück</a>";
}
else
{
    
    // Hash password for saving in database
    $password = hash('sha512', $password);

    // Query to check if user already exist.
    $query = "SELECT student_id FROM students WHERE student_username LIKE '$username'";
    $result = mysqli_query($DBconnection, $query);
    $count = mysqli_num_rows($result);

    // Check if the studen with the username already exist.
    if($count == 0)
    {
        // Insert the student information into the database and check if the query is successful.
        $query = "INSERT INTO students (student_username, category_id, student_password, student_title, student_firstname, student_lastname, student_birthdate) VALUES ('$username', '$student_category', '$password', '$title', '$firstname', '$lastname', '$birthdate')";
        if (mysqli_query($DBconnection, $query)) 
        {
            echo "Registrierung erfolgreich! <br> <a href=\"student_loginform.php\">Anmelden</a> <br>";
        }
        else 
        {
            echo "Fehler beim Speichern des Benutzernames. <br> <a href=\"student_registerform.php\">Zurück</a> <br>";
            echo "Error: " . $query . "<br>" . mysqli_error($DBconnection);
            echo "<br> <a href=\"student_registerform.php\">Zurück</a> <br>";
        }
    }
    else
    {
        echo "Benutzername schon vorhanden! <br> <a href=\"student_registerform.php\">Zurück</a> <br>";
    }   
}

 // Add html footer.
 AddHtmlFooter();
?> 