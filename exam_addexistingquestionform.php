<?php
include "helper.php";

$DBconnection = ConnectToDatabase();
CreateFormQuestionlist();

echo '<input type="button" name="OpenQuestion" class="Button" value="Frage zur Prüfung hinfügen" onclick = "AddExistingQuestionToExam()">';
?> 