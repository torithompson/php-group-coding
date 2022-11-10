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
            echo "<script>alert(\"Editor.dat does not exist.\");</script>";
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
        echo "<form action = ? method = post>";
            echo "<div class=\"fileDropDown dropdown\">
                    <button class=\"dropbtn\">File</button>
                    <div class=\"dropdown-content\">";
                    echo   "<button submit name=\"f_new\">New</button><br>
                        <button submit name=\"f_open\">Open</button><br>
                        <button submit name=\"f_save\">Save</button><br>
                    </div>
                </div>";
        echo "</form>";
    }
    function drawEditDropDown()
    {
        echo "<div class=\"dropdown\">
        <button class=\"dropbtn\">Edit</button>
        <div class=\"dropdown-content\">
        <a>";
        DisplayTextBox("textbox","f_findMe",10,"");
        echo "</a>
        <a>";
        DisplayTextBox("checkbox","f_caseSens",0,"");
        echo "Case Sensitive</a>
        <a href=\"#\">Find</a>
        </div>
        </div>";
    }
        // http://localhost/phpcoding/main.php
    


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
    //main
    echo"<form action = ? method=post>";
    echo"<div class = heading>";
        WriteHeaders("Text Editor","Best Group");

    echo"</div>";
    $text = "";
    
    if (isset($_POST['f_open'])) 
    {
        $text = openFile();
        drawMenu();
    }
        else if(isset($_POST['f_save']))
        { 
            $text = $_POST["f_textArea"];
            saveFile($text);
            drawMenu();
        }
            else if(isset($_POST['f_FindText']))
            {
                findTextInFile($textToSearch);
            }
                else if(isset($_POST['f_DrawMenu']))
                {
                    drawMenu();
                }
                    else if(isset($_POST['f_New']))
                    {               
                    }
                        else
                        {
                            drawMenu();
                        }

    
        echo "<div class = maincontainer>";
            echo "<textarea id = textArea placeholder = \"Enter text here\" name=\"f_textArea\" rows=20 
            cols=100 wrap=hard spellcheck=true autofocus>$text</textarea>";
        echo "</div>";
    echo"</form>";
    writeFooters();


?>