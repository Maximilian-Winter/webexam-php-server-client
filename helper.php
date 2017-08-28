<?php
    function &ConnectToDatabase()
    {
        $DBservername = "localhost";
        $DBusername = "webexam";
        $DBpassword = "1123581321";
        $DBname = "webexam";
        // Connect to the mysql database.
        $DBconnection = mysqli_connect($DBservername, $DBusername , $DBpassword, $DBname)
        or die("Connection to database failed.");
        return $DBconnection;
    }


    function AddHtmlHeader($SiteTitle, $Doctype, $StyleSheet, $Charset, $LanguageTag)
    {
       $HtmlHeader = '<!Doctype '. $Doctype .'>';
       $HtmlHeader .= '<html lang="'. $LanguageTag .'">';
       $HtmlHeader .= '<head>';
       $HtmlHeader .= '<title>'. $SiteTitle .'</title>';
       $HtmlHeader .= '<meta charset="'. $Charset .'">';
       $HtmlHeader .= '<link rel = "stylesheet" type = "text/css" href = "'. $StyleSheet .'">';
       $HtmlHeader .= '</head>';
       $HtmlHeader .= '<body>';
       echo $HtmlHeader;
    }
    
    function AddHtmlFooter()
    {
       $HtmlFooter = '</body>';
       $HtmlFooter .= '</html>';
       echo $HtmlFooter;
    }
    
    function AddJSScript($filename)
    {
       $ScriptTag = '<script type="text/javascript" src= "'. $filename .'"> </script>';
       echo $ScriptTag;
    }
    
    function CreateFormCategorylist()
    {
        // Connect to the mysql database.
        $DBconnection = ConnectToDatabase();

        // Query to check if user already exist.
        $query = "SELECT * FROM categories WHERE 1";
        $result = mysqli_query($DBconnection, $query);

        if(mysqli_num_rows($result))
        {
            echo "<label>Kategorie: ";
            $DropdownMenu= '<select id = "CategoryIDForm" name="CategoryListForm">';
             $DropdownMenu.='<option value=""> </option>';
            while($rs=mysqli_fetch_array($result))
            {
                $DropdownMenu.='<option value="'.$rs['category_id'].'">'.$rs['category_title'].'</option>';
            }
            $DropdownMenu.='</select>';
            echo $DropdownMenu;
            echo "</label>";
            echo "<br>";
        }
      
    }

    function CreateFormGradingSystemlist()
    {
        // Connect to the mysql database.
        $DBconnection = ConnectToDatabase();

        // Query to check if user already exist.
        $query = "SELECT * FROM grading_system WHERE 1";
        $result = mysqli_query($DBconnection, $query);

        if(mysqli_num_rows($result) > 0)
        {
            echo "<label>Benotungssystem: ";
            $DropdownMenu= '<select id = "GradingSystemIDForm" name="GradingSystemListForm">';
             $DropdownMenu.='<option value=""> </option>';
            while($rs=mysqli_fetch_array($result))
            {
                $DropdownMenu.='<option value="'.$rs['grading_system_id'].'">'.$rs['grading_system_title'].'</option>';
            }
            $DropdownMenu.='</select>';
            echo $DropdownMenu;
            echo "</label>";
            echo "<br>";
        }
      
    }
    
    function CreateFormExamlist()
    {
        // Connect to the mysql database.
        $DBconnection = ConnectToDatabase();

        // Query to check if user already exist.
        $query = "SELECT * FROM exams WHERE 1";
        $result = mysqli_query($DBconnection, $query);

        if(mysqli_num_rows($result))
        {
            echo '<fieldset>';
            echo "<label>Prüfungs Titel auswählen: ";
            $DropdownMenu= '<select id = "ExamIDForm" name="ExamListForm">';
            $DropdownMenu.='<option value=""> </option>';          
            while($rs=mysqli_fetch_array($result))
            {
              $DropdownMenu.='<option value="'.$rs['exam_id'].'">'.$rs['exam_title'].'</option>';
            }
            $DropdownMenu.='</select>';
            echo $DropdownMenu;
            echo "</label>";
            echo '</fieldset>';
            echo "<br>";
        }
      
    }

    function CreateFormExamsSummarylist()
    {
        // Connect to the mysql database.
        $DBconnection = ConnectToDatabase();

        // Query to check if user already exist.
        $query = "SELECT * FROM exams_summary WHERE 1";
        $result = mysqli_query($DBconnection, $query);

        if(mysqli_num_rows($result))
        {
            echo '<form name = "ExamList">';
            echo '<fieldset>';
            echo "<label>Prüfung auswählen: ";
            $DropdownMenu= '<select id = "ExamSummaryIDForm" name="ExamListForm">';
            $DropdownMenu.='<option value=""> </option>';          
            while($rs=mysqli_fetch_array($result))
            {
              $DropdownMenu.='<option value="'.$rs['exam_summary_id'].'">'.$rs['exam_summary_title'].'</option>';
            }
            $DropdownMenu.='</select>';
            echo $DropdownMenu;
            echo "</label>";
            echo '</fieldset>';
            echo '</form>';
        }
      
    }

    function CreateFormQuestionlist()
    {
        // Connect to the mysql database.
        $DBconnection = ConnectToDatabase();

        // Query to check if user already exist.
        $query = "SELECT * FROM questions WHERE 1";
        $result = mysqli_query($DBconnection, $query);

        if(mysqli_num_rows($result))
        {
            echo '<form name = "QuestionList">';
            echo '<fieldset>'; 
            echo "<label>Fragen Titel auswählen: ";
            $DropdownMenu= '<select id= "QuestionIDForm" name="QuestionListForm">';
            $DropdownMenu.='<option value=""> </option>';          
            while($rs=mysqli_fetch_array($result))
            {
              $DropdownMenu.='<option value="'.$rs['question_id'].'">'.$rs['question_title'].'</option>';
            }
            $DropdownMenu.='</select>';
            echo $DropdownMenu;
            echo "</label>";
            echo '<div id = "button">';
            echo '<input type="button" name="OpenQuestion" class="Button" value="Fragendetails öffnen" onclick = "LoadQuestionOverviewForm()">';
            echo '</div>';
            echo '</fieldset>';
            echo '</form>';
        }
      
    }

    function CreateFormExamOverview($DBconnection, $ExamID)
    {
        // Query to get all informations about the exam.
        $Query = "SELECT * FROM exams WHERE exam_id LIKE '$ExamID'";
        $ExamResult = mysqli_query($DBconnection, $Query);
        $ExamCount = mysqli_num_rows($ExamResult);

        if($ExamCount > 0)
        {     
        //Fetch results.
        $ExamRs = mysqli_fetch_array($ExamResult);
        // Create a overview with infos about the exam.
        echo '<form name = "ExamOverview">';
        echo '<fieldset>'; 
        echo '<input type = "hidden" id = "ExamIDForm" value = "'. $ExamID .'"> </input><br>';
        echo '<label> Prüfung Übersicht:</label> <br>';
        echo '<label> Titel: '. $ExamRs['exam_title'] .'</label><br>';
        echo '<label> Beschreibung: '. $ExamRs['exam_description'] .'</label><br>';

        echo '<label> Fragen:</label> <br>';

        // Query to search for all exam questions.
        $Query = "SELECT * FROM exam_questions WHERE exam_id LIKE '$ExamID'";
        $ExamQuestionResult = mysqli_query($DBconnection, $Query);
        $ExamQuestionCount = mysqli_num_rows($ExamQuestionResult);

        if($ExamQuestionCount > 0)
        {      
            while($ExamQuestionRs=mysqli_fetch_array($ExamQuestionResult))
            {
                $QuestionID = $ExamQuestionRs['question_id'];
                CreateFormQuestionOverview($DBconnection, $QuestionID);
            }
        }
        else
        {
            echo "Keine Fragen gefunden!";
        } 
        echo '<input type="button" name="AddExistingQuestion" class="Button" value="Vorhandene Frage hinzufügen" onclick = " LoadAddExistingQuestionForm()">';
        echo '</fieldset>';
        echo '</form>';   
        }
        else
        {
            echo "Fehler: Prüfung nicht in Datenbank gefunden!";
            echo $Query . "<br>";
        } 
    }


    function CreateFormQuestionOverview($DBconnection, $QuestionID)
    {
          // Query to search for all exam questions.
          $Query = "SELECT * FROM questions WHERE question_id LIKE '$QuestionID'";
          $QuestionResult = mysqli_query($DBconnection, $Query);
          $QuestionCount = mysqli_num_rows($QuestionResult);
          
          if($QuestionCount > 0)
          {
             //Fetch results.
            $QuestionRs = mysqli_fetch_array($QuestionResult);
            // Create a overview with infos about the exam.
            echo '<form name = "QuestionOverview">';
            echo '<fieldset>'; 
            echo '<label> Fragen Titel: '. $QuestionRs['question_title'] .'</label><br>';
            echo '<label> Fragen Text: '. $QuestionRs['question_text'] .'</label><br>';
            
            echo '<fieldset>'; 
            echo '<label> Antworten:</label> <br>';

            // Query to search for all exam questions.
            $Query = "SELECT * FROM answers WHERE question_id LIKE '$QuestionID'";
            $AnswerResult = mysqli_query($DBconnection, $Query);
            $AnswerCount = mysqli_num_rows($AnswerResult);

            while($AnswerRs=mysqli_fetch_array($AnswerResult))
            {
              echo '<fieldset>'; 
              echo '<label>Titel: '. $AnswerRs['answer_title'] .'</label><br>';
              echo '<label>Text: '. $AnswerRs['answer_text'] .'</label><br>';
              echo '<label>Punkte: '. $AnswerRs['answer_points'] .'</label><br>';
              echo '</fieldset>';
              //echo '<br><br>';   
            }
            echo '</fieldset>';
            echo '</fieldset>';
            echo '</form>';
          }
          else
          {
            echo 'Fehler: Frage nicht in Datenbank gefunden!';
          }
    }

    function GetQueryResults($DBconnection, $Query)
    {
          $QueryResult = mysqli_query($DBconnection, $Query);
          return $QueryResult;
    }

    function PrintTitle($Title, $Lastname)
    {
        // Check if student is female or male and output a corresponding text.
        if($Title == "Frau")
        {
            $Title = "sehr geehrte Frau ";
        }
        elseif($Title == "Herr")
        {
            $Title = "sehr geehrter Herr ";
        }

        echo "<H1>Guten Tag, " . $Title . $Lastname . ".</H1> <br>";
    }

   
?>