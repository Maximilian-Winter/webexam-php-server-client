<script type="text/javascript" src="js/updateForm.js"></script>
<form name = "question_creatform" method="POST">
    <div id="answerList">
    </div>

    <div id= "question-answers">
        <input type = "hidden" value = "Anzahl an Antworten" name = "numberOfAnswers">
        <input type = "button" value = "Antwort hinzufuegen" onClick="addAnswer('answerList');">
        <input type = "button" value = "Antwort entfernen" onClick="removeAnswer('answerList');">
    </div>
</form>