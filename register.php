<?php

    function showRegisterHead()
    {
        echo "Register";
    } 
    function showRegisterHeader()
    {
        echo '<h1>Registreren</h1>';
    }
    function showRegisterContent($data) 
    {
        echo '<div class="content">
        <h2>Vul hier uw gegevens in:</h2>';
        showRegisterForm($data);
        
    }       
?>