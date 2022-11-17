<?php
//Function to write headers and main
function WriteHeaders($Heading="Welcome",$TitleBar="MySite")
{
    echo "
        <!doctype html>
            <html lang = \"en\">
            <head>
                <meta charset = \"UTF-8\">
                <title> $TitleBar </title>\n
                <link rel =\"stylesheet\" 
                      type = \"text/css\" href=\"Styles.css\"/>
                <script src =\"websiteScript.js\"></script>
            </head>
            <body>\n
                <h1>$Heading</h1>\n
                <h2>
                    By: Nick Eliopoulos, Abdul Gada, 
                        Tori Thompson, Trevor Withers, 
                        Anuj Kumar, Nelson Perez
                </h2>
        ";
}
//Function to display labels
function DisplayLabel($passLabel = "")
{
    echo "<label>$passLabel</label>";
}
//Function to display textboxes
function DisplayTextbox($type,$name,$size,$value = 0, $autocomplete = "on")
{
    echo 
    "
        <input type = $type 
               name = $name 
               Size = $size autocomplete = $autocomplete value = $value >
    ";
}
//Function to display textareas
function DisplayTextArea($name,$rows,$cols,$wrap,$spellcheck,$autofocus,
                         $placeholder,$text = "")
{
    echo
    "
        <textarea id = $name rows = $rows cols = $cols wrap = $wrap spellcheck = $spellcheck autofocus = $autofocus placeholder = $placeholder>$text</textarea>
    ";
}
//Function to display images
function DisplayImage($fileName,$alt,$height=40,$width=100)
{
    echo "<img src = $fileName height=$height width=$width alt=$alt/>";
}
//Function to display buttons
function DisplayButton($name,$text,$class="", $type = "", $disabled = "", 
                       $fileName = "",$alt="")
{
    if ($fileName != "")
    {
        echo "<button type = $type name=$fileName class=$class>";
                  displayImage($fileName, $alt);
        echo" </button>";
    }
    else 
    {
        echo"<button type=Submit name=$name class=$class $disabled>
                 $text
             </button>";
    }
}
//Function to display group contact info
function displayContactInfo()
{
    echo "Questions? Comments? ";
    echo "<a href=\"mailto:nick.eliopoulos@student.sl.on.ca\">
            Email Nick</a> -&nbsp";
    echo "<a href=\"mailto:tori.thompson@student.sl.on.ca\">
            Email Tori</a> -&nbsp";
    echo "<a href=\"mailto:trevor.withers@student.sl.on.ca\">
            Email Trevor</a> -&nbsp";
    echo "<a href=\"mailto:abdellah.gada@student.sl.on.ca\">
            Email Abdellah</a> -&nbsp";
    echo "<a href=\"mailto:nelsonrafael.perezmonsanto@student.sl.on.ca\">
            Email Nelson</a> -&nbsp";
    echo "<a href=\"mailto:anuj.kumar@student.sl.on.ca\">
            Email Anuj</a>&nbsp";

}
//Function to write footers
function WriteFooters()
{  
    echo         "<footer>";
                      displayContactInfo();
    echo        "</footer>";
    echo     "</body>\n";
    echo "</html>\n";
}
//Function to open database connection
function CreateConnectionObject()
{
    $fh = fopen('auth.txt','r');
    $Host =  trim(fgets($fh));
    $UserName = trim(fgets($fh));
    $Password = trim(fgets($fh));
    $Database = trim(fgets($fh));
    $Port = trim(fgets($fh)); 
    fclose($fh);
    $mysqlObj = new mysqli($Host, $UserName, $Password,$Database,$Port);
    // if the connection and authentication are successful, 
    // the error number is 0
    // connect_errno is a public attribute of the mysqli class.
    if ($mysqlObj->connect_errno != 0) 
    {
     echo "<p>Connection failed. Unable to open database $Database. Error: "
              . $mysqlObj->connect_error . "</p>";
     // stop executing the php script
     exit;
    }
    return ($mysqlObj);
}