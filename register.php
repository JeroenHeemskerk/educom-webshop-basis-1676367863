<?php

function showRegisterHead()
{
    echo "Registreren";
}

function showRegisterHeader()
{
    echo "<h1>Registreren?</h1>";
}    
    function showRegisterContent($data) 
    {
        echo '<h2>Vul hier uw gegevens in:</h2>';
        showRegisterForm($data);        
    }       
?>