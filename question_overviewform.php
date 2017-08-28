<?php
include "helper.php";

$DBconnection = ConnectToDatabase();

$QuestionID = $_REQUEST["QuestionID"];

CreateFormQuestionOverview($DBconnection, $QuestionID);

?> 