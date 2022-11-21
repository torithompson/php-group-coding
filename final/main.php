<?php
    // http://localhost/PhpGroupAssignment/Main.php
    require_once("mainInclude.php");
    function drawMenu()
    { // main buttons on all pages
        echo "<div class = buttonHead>";
            drawFileDropDown();
            drawEditDropDown();
            drawFontDropDown(); 
        echo "</div>";
    }
    //Function Save file make us to save file with parameter passed to it
    function saveFile($textToSave)
    {
        $openFile = fopen("editor.dat","w");//open the file to save to
        $saveSuccess = fwrite($openFile, $textToSave); 
        //rewrite the information in "editor.dat"
        if($saveSuccess==TRUE) 
        {
            echo "<div class=\"alert1\">";
            echo "  <span class=\"closebtn\" 
                        onclick=\"this.parentElement.style.display='none';\">
                            &times;
                    </span>
                    File Saved.
                  </div>";
        }// if fwrite is succesful green alert displayed
        else
        {
            echo "<div class=\"alert2\">
                      <span class=\"closebtn\" 
                        onclick=\"this.parentElement.style.display='none';\">
                            &times;
                      </span>
                      Error Saving File.
                  </div>";
        }// if fwrite unsuccesful red alert displayed
        fclose($openFile); // closes the file
    }
    function openFile()
    {
        $openFile = fopen("editor.dat","r+"); //open the file
        if(file_exists("editor.dat"))
        {
           echo "<div class=\"alert1\">
                    <span class=\"closebtn\" 
                        onclick=\"this.parentElement.style.display='none';\">
                            &times;
                    </span>
                    File Open.
                 </div>";
                if(filesize("editor.dat")>0)
                {
                    $infoText = fread($openFile,filesize("editor.dat")); 
                    //reads whats in the file and assigns it to $infoText
                    fclose($openFile); // closes file
                }
                else
                {
                    $infoText = "";
                }

        } //if file_exists is succesful green alert displayed
        else
        {
            echo "<div class=\"alert2\">
                    <span class=\"closebtn\" 
                        onclick=\"this.parentElement.style.display='none';\">
                        &times;
                    </span>
                    Editor.dat does not exist.
                  </div>";
            $infoText=""; // &infoText empty if nothing read
        } // if file_exists is unsucessful red alert displayed
        return $infoText; // returns string
    }

    function drawFileDropDown()
    {// User Interface for file drop down
        echo "<div class=\"fileDropDown dropdown\">";  
                 displayButton("f_new","File","dropbtn", "submit", "disabled"); // File Button
        echo    "<div class=\"dropdown-content\">";
                    DisplayButton("f_new","New");   // new button in file button
                    DisplayButton("f_open","Open"); // open button in file button
                    DisplayButton("f_save","Save"); // save button in file button
        echo    "</div>";
        echo "</div>";
    }
    function drawEditDropDown()
    {// User Interface for edit drop down

        echo "<div class=\"dropdown\">";
                 displayButton("f_font",
                               "Edit","dropbtn", "submit", "disabled"); // Edit Button
        echo    "<div class=\"dropdown-content\">";
        echo         "<div class = \"textFind\">";
                            DisplayTextBox("text","f_findMe",10,"", "off");//search bar
        echo         "</div>";
        echo         "<div class=\"check\">";
                            DisplayTextBox("checkbox","f_caseSens",0,""); 
        echo                "Case Sensitive";       //check box for case sensitive
        echo         "</div>";
                      DisplayButton("f_find","Find");  // Button to find the text in search bar
        echo     "</div>";
        echo "</div>";
    }
    function drawFontDropDown()
    {// the function Retrieve font names from table 
    //fontNames and load into the list box

    // establishing connection to the database
        $mysqlObj = CreateConnectionObject();   

        $TableName = "fontNames";
        
        $query = "select fontName from $TableName";
        
        $stmtObj = $mysqlObj->prepare($query);
        
        $success =  $stmtObj -> execute();
        
        $BindResult = $stmtObj->bind_result($fontNames);

        echo "<div class=\"dropdown\">";
        echo      DisplayButton("f_font","Font","dropbtn", 
                                "submit", "disabled");
        echo     "<div class=\"dropdown-content\">";
        echo         "<div class = listboxContainer>";
                          displayLabel("Font");
        echo             "<select onchange=changeFont(this.value)>";  // start of list box
        echo                "<option disabled selected>Choose a colour scheme</option>";
                            if($success)
                            {
                                while ($stmtObj->fetch())    
                                {      
                                    echo "<option value=\"$fontNames\">" 
                                        . $fontNames ."</option>";    
                                    $counter++;
                                }
                            }
        echo             "</select>";
        echo         "</div>";
        echo         "<div class = listboxContainer>";
        echo              displayLabel("Size");
        echo             "<select onchange=changeSize(this.value)>";
        echo                 "<option disabled>Choose a font size</option>";
        echo                 "<option value=\"small\">small</option>";    
        echo                 "<option value=\"medium\" selected>medium</option>";  
        echo                 "<option value=\"large\">large</option>";      
        echo             "</select>";
        echo         "</div>";
        
                      $mysqlObj->close();        
                      $stmtObj->close();
        echo     "</div>
              </div>";
    }
    // Function to find position of text in the text area
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
                              <span class=\"closebtn\" 
                                    onclick=
                                        \"this.parentElement.style.display=
                                        'none';\">
                                  &times;
                              </span>
                              $textToSearch was found at position "
                               . strpos($textInFile, $textToSearch)+1 . 
                          "</div>";
                    $textFound = true;
                    break;
                }
            }
            else if (stripos($textInFile, $textToSearch) !== false)
            {
                echo "<div class=\"alert1\">
                          <span class=\"closebtn\" 
                                  onclick=
                                      \"this.parentElement.style.display=
                                          'none';\">
                              &times;
                          </span>
                          $textToSearch was found at position "
                          . stripos($textInFile, $textToSearch)+1 . 
                     "</div>";
                
                $textFound = true;
                break;
            }
        }
        if($textFound == false)
        {
            echo "<div class=\"alert2\">
                      <span class=\"closebtn\" 
                            onclick=
                                \"this.parentElement.style.display=
                                     'none';\">
                          &times;
                      </span>
                      $textToSearch not found
                  </div>";
        }
    }
    //Function to redraw textarea as needed
    function fillTextArea($textToFill = "")
    {
        echo "<div class = maincontainer>";
        echo    "<textarea id = textArea placeholder = \"Enter text here\" 
                name=\"f_textArea\" rows=20 cols=100 wrap=hard spellcheck=true 
                autofocus>$textToFill</textarea>";
        echo "</div>";
    }
    //main
    //Add the header
    WriteHeaders("Cloud Nine Text Editor","Cloud Nine");
    //Start the form
    echo"<form action = ? method=post>";
            //Add the buttons
             drawMenu();
             //If the user has clicked on the open button
             if (isset($_POST['f_open'])) 
             {
                 $textAreaContent = openFile();
             }
                //If the user has clicked on the save button
                 else if(isset($_POST['f_save']))
                 { 
                    $textAreaContent = $_POST['f_textArea'];
                    saveFile($textAreaContent);
                 }
                    //If the user has clicked on the find button
                     else if(isset($_POST['f_find']))
                     {
                         $textAreaContent = $_POST['f_textArea'];
                         $textToSearch = $_POST['f_findMe'];                
                         findTextInFile($textToSearch);
                     }
                        //First page
                         else
                         { 
                             $textAreaContent = "";    
                         }
             //Add the text area            
           fillTextArea($textAreaContent);
    echo"</form>";  //End the form
    //Add the footer
    writeFooters();
?>
