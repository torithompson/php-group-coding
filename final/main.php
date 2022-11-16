<?php
    // http://localhost/PhpGroupAssignment/Main.php
    require_once("mainInclude.php");
    function drawMenu()
    {
        echo "<div class = buttonHead>";
        drawFileDropDown();
        drawEditDropDown();
        drawFontDropDown(); 
        echo "</div>";
    }

    function saveFile($textToSave)
    {
        $openFile = fopen("editor.dat","w");
        $saveSuccess = fwrite($openFile, $textToSave);
        if($saveSuccess!=FALSE)
        {
            echo "<div class=\"alert1\">";
            echo "<span class=\"closebtn\" onclick=\"this.parentElement.style.display='none';\">&times;</span>
                    File Saved.
                    </div>";
        }
        else
        {
            echo "<div class=\"alert2\">
                    <span class=\"closebtn\" onclick=\"this.parentElement.style.display='none';\">&times;</span>
                    Error Saving File.
                    </div>";
        }
        fclose($openFile);
    }
    function openFile()
    {
        $openFile = fopen("editor.dat","r+");
        if(file_exists("editor.dat"))
        {
           echo "<div class=\"alert1\">
                    <span class=\"closebtn\" onclick=\"this.parentElement.style.display='none';\">&times;</span>
                    File Open.
                    </div>";
            $infoText = fread($openFile,filesize("editor.dat"));
            fclose($openFile);
        }
        else
        {
            echo "<div class=\"alert2\">
                    <span class=\"closebtn\" onclick=\"this.parentElement.style.display='none';\">&times;</span>
                    Editor.dat does not exist.
                    </div>";
            $infoText="";
        }
        return $infoText;
    }

    function drawFileDropDown()
    {
        echo "<div class=\"fileDropDown dropdown\">";
            displayButton("f_new","File","dropbtn", "submit", "disabled");
            echo"<div class=\"dropdown-content\">";
                DisplayButton("f_new","New");
                DisplayButton("f_open","Open");
                DisplayButton("f_save","Save");
            echo "</div>";
        echo "</div>";
    }
    function drawEditDropDown()
    {
        echo "<div class=\"dropdown\">";
            displayButton("f_font","Edit","dropbtn", "submit", "disabled");
            echo "<div class=\"dropdown-content\">";
                echo "<div class = \"textFind\">";
                    DisplayTextBox("text","f_findMe",10,"", "off");
                echo "</div>";
                echo "<div class=\"check\">";
                    DisplayTextBox("checkbox","f_caseSens",0,"");
                    echo "Case Sensitive";
                echo "</div>";
                DisplayButton("f_find","Find");
            echo "</div>";
        echo "</div>";
    }

     function findTextInFile($textToSearch) 
    {
        $textInFile = $_POST["f_textArea"];
        $textFound = false;

        for($i = 0; $i < strlen($textInFile); $i++)
        {
            if(isset($_POST["f_caseSens"]))
            {
                if (strpos($textInFile, $textToSearch) !== false)
                {
                    echo "<div class=\"alert1\">
                    <span class=\"closebtn\" onclick=\"this.parentElement.style.display='none';\">&times;</span>
                    $textToSearch was found at position " . strpos($textInFile, $textToSearch)+1 . "</div>";
                    
                    $textFound = true;
                    break;
                }
            }
            else if (stripos($textInFile, $textToSearch) !== false)
            {
                echo "<div class=\"alert1\">
                <span class=\"closebtn\" onclick=\"this.parentElement.style.display='none';\">&times;</span>
                 $textToSearch was found at position " . stripos($textInFile, $textToSearch)+1 . "</div>";
                
                $textFound = true;
                break;
            }
                
        }
        if($textFound == false)
        {
            echo "<div class=\"alert2\">
            <span class=\"closebtn\" onclick=\"this.parentElement.style.display='none';\">&times;</span>
            $textToSearch not found
            </div>";
        }
    }
    function drawFontDropDown()
    {
        $mysqlObj = CreateConnectionObject();

        $TableName = "fontNames";
        
        $query = "select fontName from $TableName";
        
        $stmtObj = $mysqlObj->prepare($query);
        
        $stmtObj -> execute();
        
        $BindResult = $stmtObj->bind_result($fontNames);
        echo "<div class=\"dropdown\">";
        echo DisplayButton("f_font","Font","dropbtn", "submit", "disabled");
        echo " <div class=\"dropdown-content\">";
        echo "<div class = listboxContainer>";
        displayLabel("Font");
        echo "<select onchange=changeFont(this.value)>";  
        echo "<option disabled>Choose a colour scheme</option>";
        while ($stmtObj->fetch())    
        {      
            echo "<option value=\"$fontNames\">" . $fontNames ."</option>";    
            $counter++;
        }
        echo "</select>";
        echo "</div>";
        echo "<div class = listboxContainer>";
        echo displayLabel("Size");
        echo "<select onchange=changeSize(this.value)>";
        echo "<option disabled>Choose a font size</option>";
        echo "<option value=\"small\">small</option>";    
        echo "<option value=\"medium\">medium</option>";  
        echo "<option value=\"large\">large</option>";      
        echo "</select>";
        echo "</div>";
        
        $mysqlObj->close();        
        $stmtObj->close();
        echo "</div>
            </div>";
    }
    function fillTextArea($textToFill = "")
    {
        echo "<div class = maincontainer>";
            echo "<textarea id = textArea placeholder = \"Enter text here\" name=\"f_textArea\" rows=20 cols=100 wrap=hard spellcheck=true autofocus>$textToFill</textarea>";
        echo "</div>";
    }
    //main
    
    echo"<div class = heading>";
    WriteHeaders("Cloud Nine Text Editor","Best Group");
    echo"</div>";
    echo"<form action = ? method=post>";
    drawMenu();
    if (isset($_POST['f_open'])) 
    {
        $textAreaContent = openFile();
    }
        else if(isset($_POST['f_save']))
        { 
            $textAreaContent = $_POST['f_textArea'];
            saveFile($textAreaContent);
        }
            else if(isset($_POST['f_find']))
            {
                $textAreaContent = $_POST['f_textArea'];
                $textToSearch = $_POST['f_findMe'];                
                findTextInFile($textToSearch);
            }
                else
                {
                    $textAreaContent = "";    
                }
fillTextArea($textAreaContent);      

echo  "</form>";
    writeFooters();
?>