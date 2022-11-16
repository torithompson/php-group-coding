<?php
    // http://localhost/PhpGroupAssignment/partA.php
    require_once("partAInclude.php");
        //echo "<form action = ? method = post>";


        
            //echo "</form>";
    function drawMenu($incomeText="")
    {
        //Code function drawMenu to create the GUI for the dropdown menus. To build the dropdown menu design, 
        //you can create your own or use one from the internet. Call drawFileDropDown, drawEditDropDown and 
        //drawFontDropDown as appropriate. 
        //$text = openfile();
        $text = $incomeText;
        echo "<form action = ? method = post>";
        echo "<div class = buttonHead>";
        drawFileDropDown();
        drawEditDropDown();
        drawFontDropDown();
        echo "</div>";
    
    }


    //Code function saveFile and function openFile. Handy functions are fwrite and fread. 
    //The filename is editor.dat. Display the messages below as appropriate:
    //-	File saved.
    //-	Error Saving File.
    //-	File opened.
    //-	Error opening file. 
    function saveFile($textToSave)
    {   
        $openFile = fopen("editor.dat","a");
        $saveSuccess = fwrite($openFile, $textToSave);
        if($saveSuccess!=FALSE)
        {
            echo "<script>alert(\"File Saved.\");</script>";
        }
        else
        {
            echo "<script>alert(\"Error Saving File.\");</script>";
        }
        fclose($openFile);
       
    //Function saveFile has one parameter: the text to be saved to the file (one long string)
    //It does not return a value. 
    }
    function openFile()
    {
        $openFile = fopen("editor.dat","r");
        if(file_exists("editor.dat"))
        {
            echo "<script>alert(\"File Opened.\");</script>";
            $infoText = fread($openFile,filesize("editor.dat"));
            fclose($openFile);
        }
        else
        {
            echo "<script>alert(\"Editor.dat does not exist. Please save file first.\");</script>";
            $infoText="";
        }
        return $infoText;
    //Function openFile has no parameters and returns the text retrieved from the file.
    //Note that an error is given if the user tries to open a file when editor.dat does not exist. 
    //Use the file_exists function in openFile. If the file does not exist, display Editor.dat does not exist. 
    //Please save file first. 
    }
    //Functions can be written and tested before main is ready. File New does not require its own function. 
    //You do not have to account for the user forgetting to click Save.

    function drawFileDropDown()
    {
        echo "<form action = ? method = post>
                <div class=\"dropdown\">
                    <button class=\"dropbtn\">File</button>
                    <div class=\"dropdown-content\">
                        <button submit name=\"f_new\">New</button><br>
                        <button submit name=\"f_open\">Open</button><br>
                        <button submit name=\"f_save\">Save</button><br>
                    </div>
                </div>";
        echo "</form>";
    }
    function drawEditDropDown()
    {
        echo "<form action = ? method = post>
            <div class=\"dropdown\">
            <button class=\"dropbtn\">Edit</button>
                <div class=\"dropdown-content\">
                    <div class = \"textFind\">";
                        DisplayTextBox("textbox","f_findMe",10,"");
                    echo "</div>";
                echo "<button>";
                    DisplayTextBox("checkbox","f_caseSens",0,"");
                echo "Case Sensitive</button>
                <button submit name=\"f_find\">Find</button><br>
                </div>
            </div>";
        echo "</form>";

    }
     function drawFontDropDown()
    {
        $mysqlObj = CreateConnectionObject();// call create connection function in Example 3 page 2

        $TableName = "fontNames";// Important: always assume the data came from the user
        
        // so be sure to account for injection
        
        $query = "select fontName from $TableName";
        
        $stmtObj = $mysqlObj->prepare($query);
        
        $stmtObj -> execute();
        
        $BindResult = $stmtObj->bind_result($fontNames);
        
        echo "<div class=\"dropdown\">";
            echo "<button class=\"dropbtn\">Font</button>";
            echo "<div class=\"dropdown-content\">";
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
                    displayLabel("Size");
                    echo "<select onchange=changeSize(this.value)>";
                    echo "<option disabled>Choose a font size</option>";
                    echo "<option value=\"small\">small</option>";    
                    echo "<option value=\"medium\">medium</option>";  
                    echo "<option value=\"large\">large</option>";      
                    echo "</select>";
                echo "</div>";
                
                $mysqlObj->close();        
                $stmtObj->close();
            echo "</div>";
        echo "</div>";
    }
    function findTextInFile($textToSearch) 
    {
        $textInFile = openFile();
        for($i = 0; $i < strlen($textInFile); $i++)
        {
            if (strpos($textInFile, $textToSearch) !== false)
            {
                echo "$textToSearch was found at position " . strpos($textInFile, $textToSearch)+1;
                break;
            }
            else
                echo $textToSearch . ' not found';
        }
    }
    function fillTextArea($textToFill = "")
    {
        echo "<div class = textArea>";
            echo "<textarea id = textArea placeholder = \"Enter text here\" name=\"f_textArea\" rows=20 cols=100 wrap=hard spellcheck=true autofocus>$textToFill</textarea>";
        echo "</div>";
    }
    //main
    
    echo"<div class = heading>";
        WriteHeaders("Text Editor","Best Group");
    echo"</div>";
    echo"<form action = ? method=post>";
    drawMenu();
        if (isset($_POST['f_open'])) 
        {
            $textToOpen = openFile();
            fillTextArea($textToOpen);
        }
            else if(isset($_POST['f_save']))
            { 
                $textToSave = $_POST['f_textArea'];
                saveFile($textToSave);
                $textToOpen = openFile();
                fillTextArea($textToOpen);
            }
                else if(isset($_POST['f_find']))
                {
                    $textToSearch = $_POST['f_findMe'];
                    findTextInFile($textToSearch);
                    $textToOpen = openFile();
                    fillTextArea($textToOpen);
                }
                        else if(isset($_POST['f_new']))
                        {
                            fillTextArea("");         
                        }
                            else
                            {
                                fillTextArea("");    
                            }

    echo"</form>";
        
        


    writeFooters();


?>