<?php

if(array_key_exists('ButtonLogout', $_POST)) {
        buttonlogout();
    }
    function buttonlogout() {

        echo "Vous êtes déconnecté !";
    }

?>