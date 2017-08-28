    function LoadDoc(filename)
    {
        var xmlhttp;
        if (window.XMLHttpRequest)
        {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp=new XMLHttpRequest();
        }
        else
        {
            // code for IE6, IE5
            xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange=function()
        {
            if (xmlhttp.readyState==4 && xmlhttp.status==200)
            {
                document.getElementById("sitecontent").innerHTML=xmlhttp.responseText;
            }
        }
        xmlhttp.open("GET", "index.php", true);
        xmlhttp.send();
    }

    function LoadContent(Filename, ContentSection, async)
    {
        var xmlhttp;
        if (window.XMLHttpRequest)
        {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp=new XMLHttpRequest();
        }
        else
        {
            // code for IE6, IE5
            xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange=function()
        {
            if (xmlhttp.readyState==4 && xmlhttp.status==200)
            {
                document.getElementById(ContentSection).innerHTML=xmlhttp.responseText;
            }
        }
        xmlhttp.open("GET", Filename, async);
        xmlhttp.send();
    }

    function AddContent(Filename, ContentSection, async)
    {
        var xmlhttp;
        if (window.XMLHttpRequest)
        {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp=new XMLHttpRequest();
        }
        else
        {
            // code for IE6, IE5
            xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange=function()
        {
            if (xmlhttp.readyState==4 && xmlhttp.status==200)
            {
                document.getElementById(ContentSection).innerHTML += xmlhttp.responseText;
            }
        }
        xmlhttp.open("GET", Filename, async);
        xmlhttp.send();
    }

    function startTime() 
    {
        var today = new Date();

        var day = today.getDate();
        var month = today.getMonth();
        month += 1;
        var year = today.getFullYear();
        var h = today.getHours();
        var m = today.getMinutes();
        var s = today.getSeconds();
        day = checkTime(day)
        month = checkTime(month);
        year = checkTime(year);
        h = checkTime(h)
        m = checkTime(m);
        s = checkTime(s);

        var DateNow = new Date(year + "-" + month + "-" + day + " " + h + ":" + m + ":" + s);
        var StudentStartDate = new Date(document.getElementById('StudentStartDate').value);

        document.getElementById('DateTime').innerHTML = " <br> Uhrzeit: " + DateNow;
        document.getElementById('DateTime').innerHTML += "<br><br><br> Startzeitpunkt:" +  StudentStartDate;

        var timeDiff = Math.abs(StudentStartDate.getTime() - DateNow.getTime());
        var diffSeconds = Math.ceil(timeDiff / (1000)); 
        var ExamSummaryDurationInSec = document.getElementById('ExamSummaryDurationForm').value * 60;

        var StudentRemainingTimeInSec = ExamSummaryDurationInSec - diffSeconds;

        var ExamEnded = document.getElementById('ExamEnded') !== null;

        if(ExamEnded == false)
        {
             
            if(StudentRemainingTimeInSec <= 0)
            {
                EndExam();
            }
            else
            {
                var t = setTimeout(startTime, 500);
            }

            document.getElementById('DateTime').innerHTML += " <br> Übrige Zeit in Sekunden: " +  StudentRemainingTimeInSec;
        }
    }

    function checkTime(i)
    {
        if (i < 10)     // add zero in front of numbers < 10
        {
            i = "0" + i
        };
          
        return i;
    }

    function ClearContent(ContentSection)
    {
        document.getElementById(ContentSection).innerHTML="";
    }

    function SubmitSearchExamForm()
    {
        var ExamID = document.getElementById('ExamIDForm').value;
        var ExamSearchForm = document.getElementById('ExamSearchForm').value;
        ClearContent("headcontent");
        LoadContent("exam_searchresultform.php?ExamSearch=" + ExamSearchForm + "&ExamID=" + ExamID, "headcontent", false);
    }

    function SubmitStudentExamSummaryForm()
    {
        var ExamSummaryID = document.getElementById('ExamSummaryIDForm').value ;
        var StudentID = document.getElementById('StudentIDForm').value ;
        ClearContent("headcontent");
        LoadContent("exam_student_overview.php?ExamSummaryID=" + ExamSummaryID+ "&StudentID=" + StudentID, "headcontent", false);
    }

    function SubmitSearchExamResultForm()
    {
        var ExamID = document.querySelector('input[name = "ExamSearchResultListForm"]:checked').value;        
        LoadContent("exam_overviewform.php?ExamID=" + ExamID, "headcontent", false);
        ClearContent("maincontent");
    }

    function LoadAddExistingQuestionForm()
    {
        LoadContent("exam_addexistingquestionform.php", "maincontent", false);
    }

    function LoadQuestionOverviewForm()
    {   
        var QuestionID = document.getElementById('QuestionIDForm').value;
        LoadContent("question_overviewform.php?QuestionID=" + QuestionID, "maincontent", false);
    }

    function AddExistingQuestionToExam()
    {   
        var ExamID = document.getElementById('ExamIDForm').value;
        var QuestionID = document.getElementById('QuestionIDForm').value;

        LoadContent("exam_addquestion.php?ExamID=" + ExamID  +"&QuestionID=" + QuestionID, "maincontent", false);
    }

    function StartExam()
    {   
        var ExamSummaryID = document.getElementById('ExamSummaryIDForm').value;
        var ExamID = document.getElementById('ExamIDForm').value;
        var StudentID = document.getElementById('StudentIDForm').value;

        LoadContent("exam_student_start.php?ExamSummaryID=" + ExamSummaryID + "&StudentID=" + StudentID, "footcontent", false);
        if(document.getElementById('StudentStartExam') != null)
        {
            startTime();
            LoadContent("exam_getquestion.php?ExamID=" +  ExamID + "&QuestionNumber= 0", "maincontent", false);
            document.getElementById( "StartExamButtonForm" ).setAttribute( "value", "Prüfung beenden!" );
            document.getElementById( "StartExamButtonForm" ).setAttribute( "onClick", "javascript: EndExam();" );
        }
    }

    function EndExam()
    {   
        var ExamResultForm = document.forms['ExamStudentStart'];
        AddHiddenInputValue(ExamResultForm, 'ExamEnded', 'true');
        var ExamSummaryID = document.getElementById('ExamSummaryIDForm').value;
        var ExamID = document.getElementById('ExamIDForm').value;
        var StudentID = document.getElementById('StudentIDForm').value;
        var AnswersSelected = document.querySelector('input[name = "StudentAnswerIDForm"]:checked') !== null;
        
        if(AnswersSelected == true)
        {
            SendFormQuestionAnswers();
        }

        LoadContent("exam_student_end.php?ExamSummaryID=" +  ExamSummaryID + "&StudentID=" + StudentID, "maincontent", false);
        LoadContent("exam_student_resultoverviewform.php?ExamSummaryID=" +  ExamSummaryID + "&StudentID=" + StudentID + "&ExamID=" + ExamID, "headcontent", false);
    }
    
    function GetNextExamQuestion()
    {   
        var ExamID = document.getElementById('ExamIDForm').value;
        var AnswersSelected = document.querySelector('input[name = "StudentAnswerIDForm"]:checked') !== null;
        var QuestionNumber = document.getElementById('QuestionNumber').value;

        if(AnswersSelected == true)
        {
            SendFormQuestionAnswers();
        }

        LoadContent("exam_getquestion.php?ExamID=" + ExamID + "&QuestionNumber= " + (parseInt(QuestionNumber) + 1), "maincontent", false);
    }

    function GetPreviousExamQuestion()
    {   
        var ExamID = document.getElementById('ExamIDForm').value;
        var AnswersSelected = document.querySelector('input[name = "StudentAnswerIDForm"]:checked') !== null;
        var QuestionNumber = document.getElementById('QuestionNumber').value;
        
        if(AnswersSelected == true)
        {
            SendFormQuestionAnswers();
        }

        LoadContent("exam_getquestion.php?ExamID=" + ExamID + "&QuestionNumber= " + (parseInt(QuestionNumber) - 1), "maincontent", false);
    }

    function SendFormQuestionAnswers()
    {
        var ExamSummaryID = document.getElementById('ExamSummaryIDForm').value;
        var StudentID = document.getElementById('StudentIDForm').value;
        var QuestionID = document.getElementById('QuestionIDForm').value;
        var AnswerID = document.querySelector('input[name = "StudentAnswerIDForm"]:checked').value; 
        var QuestionNumber = document.getElementById('QuestionNumber').value;
        var QuestionIsMultipleChoice = document.getElementById('QuestionIsMultipleChoice').value;

        if(parseInt(QuestionIsMultipleChoice))
        {
            var AnswerIDs = document.querySelectorAll('input[name = "StudentAnswerIDForm"]:checked');
            var i;

            var AnswerIDString = "";

            for (i = 0; i < AnswerIDs.length; i++)
            {
                AnswerIDString += ("&AnswerID" + i + "=" + AnswerIDs[i].value);
            }

            AddContent("exam_answerquestion.php?ExamSummaryID=" + ExamSummaryID + "&StudentID= " + StudentID + "&QuestionID= " + QuestionID +"&AnswerCount="+ AnswerIDs.length + AnswerIDString, "footcontent" , false);
        }
        else
        {
            AddContent("exam_answerquestion.php?ExamSummaryID=" + ExamSummaryID + "&StudentID= " + StudentID + "&QuestionID= " + QuestionID +"&AnswerCount=1" + "&AnswerID0= " + AnswerID, "footcontent" , false);
        }
    }

    function AddHiddenInputValue(theForm, key, value)
    {
        // Create a hidden input element, and append it to the form:
        var input = document.createElement('input');
        input.type = 'hidden';
        input.id = key;
        input.value = value;
        theForm.appendChild(input);
    }