<?php


function cleanData($con, $data){

     $sql_clean = mysqli_real_escape_string($con, $data);
     $clean_html = htmlspecialchars(strip_tags($sql_clean));
     
     return $clean_html;
}

function cleanAmount($con, $data){

    $sql_clean = mysqli_real_escape_string($con, $data);
    
    return $sql_clean;
}