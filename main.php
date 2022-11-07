<?php
function findTextInFile($file, $text) {
    $file = fopen($file, 'r');
    while (!feof($file)) {
        $line = fgets($file);
        if (strpos($line, $text) !== false) {
            echo $text . ' was found at position ' . $line;
        }
    }
    echo $text . ' not found';
}


?>