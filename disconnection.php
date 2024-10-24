<?php

if(array_key_exists('ButtonLogout', $_POST)) {
    //delete all variables session. 
    $_SESSION = array(); 
 
    // If you want delete the cookie session, destroy the cookie.
    if (ini_get("session.use_cookies")) { 
        $params = session_get_cookie_params(); 
        setcookie(session_name(), '', time() - 42000, 
        $params["path"], $params["domain"],  
        $params["secure"], $params["httponly"] 
    ); 
} 
    session_destroy(); 
    header("Location: home.php"); 
    exit(); 
}  
?>