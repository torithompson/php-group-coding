<?php
    // http://localhost/phpcoding/main.php
    

    require_once("teamCodingInclude.php");

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
    echo"<div class = heading>";
        writeHeaders("Tori Thompson, Trevor Withers, Nick Eliopoulos", "Abdellah Gada, Nelson Monsanto and Anuj Kumar", "Group coding Assignment");
    echo"</div>";
    function openFile() 
    {
        return "A long time ago, a group of friends were sitting around a table discussing life and the universe. One of them, a programmer, said \"You know, I bet we could create a universe if we just wrote a program for it.\" The others laughed, but the programmer was serious.

        So the programmer set to work, and after many long nights, they had created a universe. It was a beautiful thing, full of stars and planets and possibility. The programmer's friends were amazed, and they all wanted to live in this new universe.

        But then something went wrong. The programmer made a mistake in the code, and the universe began to unravel. The stars winked out of existence, the planets crumbled, and all of the friends were forced to evacuate.

        The programmer was devastated. They had created this universe, and now it was gone. But they were determined to fix their mistake and bring their universe back to life. So they sat down and wrote a new program, and this time, they made sure it was perfect.

        And sure enough, their universe came back to life. The stars were shining bright again, the planets were spinning in their orbits, and the friends were all safe.
        ";
    }
    $textFile = "Enter your text here";
    if (isset($_POST['f_OpenFile'])) 
    {
        $textFile = openFile();

    }
        else if(isset($_POST['f_SaveFile']))
        {
            saveFile($textToBeSaved);
        }
            else if(isset($_POST['f_FindText']))
            {
                findTextInFile($textToSearch);
            }
                else if(isset($_POST['f_DrawMenu']))
                {
                    drawMenu();
                }
                    else if(isset($_POST['f_NewFile']))
                    {
                        $textFile = "Enter your text here";                
                    }

    echo"<form action = ? method=post>";
        echo "<div class = navcontainer>";
            displayButton("f_OpenFile", "Open File");
            displayButton("f_edit", "Edit File");
            displayButton("f_font", "Change Font");
        echo "</div>";
        echo "<div class = maincontainer>";
            echo "<textarea id = textArea name=textArea rows=20 cols=100 wrap=hard spellcheck=true 
            autofocus>$textFile</textarea>";
        echo "</div>";
    echo"</form>";

    writeFooters();

?>