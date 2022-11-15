<?php
function WriteHeaders($Heading="Welcome",$TitleBar="MySite")
{
    echo "
        <!doctype html>
        <html lang = \"en\">
        <head>
            <meta charset = \"UTF-8\">
            <link rel =\"stylesheet\" type = \"text/css\" href=\"Styles.css\"/>
            <script src =\"websiteScript.js\"></script>
        </head>
        <title> $TitleBar </title>\n
        <body>\n
        <h1>$Heading</h1>\n
        <h2>By: Nick, Abdul, Tori, Trevor, Anuj, Nelson</h2>
    ";
}
function DisplayLabel($passLabel = "")
{
    echo "<label>$passLabel</label>";
}
function DisplayTextbox($type,$name,$size,$value = 0)
{
    echo "
    <input type = $type name = $name Size = $size value = $value >
    ";
}
function DisplayTextArea($name,$rows,$cols,$wrap,$spellcheck,$autofocus,$placeholder, $text = "")
{
    echo "
    <textarea name = $name rows = $rows cols = $cols wrap = $wrap spellcheck = $spellcheck autofocus = $autofocus placeholder = $placeholder>$text</textarea>
    ";
}
function DisplayImage($fileName,$alt,$height=40,$width=100)
{
    echo "<img src = $fileName height=$height width=$width alt=$alt/>";
}
function DisplayButton($name,$text, $type = "submit", $disabled = "", $fileName = "",$alt="")
{
    if ($fileName != "")
    {
        echo "<button type = $type name=$fileName class=\"dropbtn\">";
        displayImage($fileName, $alt);
        echo" </button>";
    }
    else 
    {
        echo"<button type=Submit name=$name class=\"dropbtn\" $disabled>$text</button>";
    }
}
function displayContactInfo()
{
    echo "Questions? Comments? ";
    echo "<a href=\"mailto:nick.eliopoulos@student.sl.on.ca\">
            Nick.Eliopoulos@student.sl.on.ca</a></p>";

}
function WriteFooters()
{  
    echo "<footer>";
    displayContactInfo();
    echo "</footer>";
    echo "</body>\n";
    echo "</html>\n";
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
    echo "<form action = http://localhost/EliopoulosNickCodingAsst/asstMain.php 
        method = post>";
    echo "<form>";
    return ($mysqlObj);

}
// main
?>
