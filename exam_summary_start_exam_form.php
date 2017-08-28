<?php
session_start();
include "helper.php";
// Add html header with site information
AddHtmlHeader("Webexam", "html", "css/style.css", "utf-8", "de-DE");
AddJSScript("js/ajax.js");
?>
<div id = "headcontent">
  <h1>Test auswählen oder suchen:</h1>    
  <form name = "StudentExamSummaryForm">
    <fieldset>
      <?php
        echo CreateFormExamsSummarylist();
      ?>
      <input type="button" name='SubmitBttSearchExam' class="Button" value="Prüfung auswählen" onclick="SubmitStudentExamSummaryForm()">      
    </fieldset>
  </form>
</div>
<div id = "maincontent">

</div>
<div id = "footcontent">

</div>
<?php

  $StudentID = $_SESSION["StudentID"];

  echo '<input type = "hidden" id = "StudentIDForm" value = "'. $StudentID .'"> </input><br>';
  // Add html footer.
  AddHtmlFooter();
?>