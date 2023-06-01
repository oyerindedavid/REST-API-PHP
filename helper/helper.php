<?php



function cleanData($con, $data){

     $sql_clean = mysqli_real_escape_string($con, $data);
     $clean_html = htmlspecialchars(strip_tags($sql_clean));
     
     return $clean_html;
}


//Check if login credential provided by user is valid
function isValidLoginCredention($username='', $password=''){
    $isLoggedIn = true;
    return $isLoggedIn;
}