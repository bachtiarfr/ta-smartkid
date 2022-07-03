<?php 

function filterFileName($string) {
    // return preg_replace('/[a-zA-Z.]/', '', $string);
    return str_replace( array( '\'', '"' , '[' , ';', ']', '>' ), ' ', $string);
}

?>