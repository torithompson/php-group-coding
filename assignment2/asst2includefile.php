<?php
 //Nelson - Anuj

function WriteHeaders($Heading = "Welcome", $TitleBar ="MySite")
{
    echo 
    "
        <!doctype html>
        <html lang = \"en\">
        <head>
            <meta charset = \"UTF 8\">
            <title>$TitleBar</title>\n
            <link rel =\"stylesheet\" type = \"text/css\" href=\"asstStyle.css\"/>
            <script src =\"websiteScript.js\"></script>
        </head>
        <body>\n
        <h1>$Heading</h1>\n
    ";
}

function DisplayLabel($Label = "")
{
    echo
    "
        <label>$Label</label>
    ";
}
function DisplayTextbox($Name, $Size, $Value = 0)
{
    echo
    "
        <input type = text name = \"$Name\" size = \"$Size\" 
        value = \"$Value\">
    ";
}
function DisplayTextArea($Name, $Rows = 5, $Columns = 20)
{
    echo
    "
    <textarea name = \"$Name\" rows = \"$Rows\" 
    columns = \"$Columns\"></textarea>
    ";
}
function DisplayContactInfo()
{
    echo 
    "
        <div class = \"footerflexeitem\">
        <span>Questions? Comments?</span>
        </div>
        <a href=\"mailto:nelsonrafael.perezmonsanto@Student.SL.On.Ca\">nelsonrafael.perezmonsanto@Student.SL.On.Ca</a>
    ";
}
function DisplayImage($Filename, $Alt, $height, $width)
{

   echo 
   "
        <img src = \"$Filename\" height=\"$height\" width=\"$width\" alt=\"$Alt\"/>
   ";
}

function DisplayButton($Name, $Text,$type = "Submit",$Filename = "",$Alt = "",)
{

    if($Filename == "")
    {
        echo "<button type=\"$type\" name=\"$Name\">$Text</button>";
    }
    else
    {
        echo "<button type=\"$type\" name=\"$Name\">";
        echo DisplayImage($Filename,$Alt,50,100);
        echo "</button>";
    }
}

function WriteFooters()
{
    DisplayContactInfo();
    echo  "</body>\n";
    echo  "</html>\n";
}

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

?>
