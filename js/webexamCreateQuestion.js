    var answercounter = 0;
    
    function addAnswer(divName)
    {
        var form = document.create_question_form;
        var answerdiv = document.createElement('div');
        answerdiv.id = "answer" + answercounter; 
        answerdiv.innerHTML = "<p><label>Antwort " + (answercounter + 1) + ": <br> Titel: <input type='text' value = 'Antwort " + (answercounter + 1) + ": ' name='AnswerTitle" + (answercounter) + "'>Soll der Titel angezeigt werden? <input type='checkbox' name='ShowAnswerTitle" + (answercounter) + "' value='true' checked> <br> Text: <input type='text' name='AnswerText" + (answercounter) + "'> <br> Punkte: <input type='number' step = '0.01' name='AnswerPoints" + (answercounter) + "'> </label></p>";
        document.getElementById(divName).appendChild(answerdiv);
        answercounter++;
              
        form.numberOfAnswers.value = answercounter;
    }
    
    function removeAnswer(divName)
    {
        var form = document.create_question_form;
        var answerssection = document.getElementById(divName);
        if (answerssection.hasChildNodes() && answercounter > 1) 
        {
            answerssection.removeChild(answerssection.childNodes[answercounter]);
            answercounter--;
        }
        
        form.numberOfAnswers.value = answercounter;
    }
    
   