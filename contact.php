<?php
    function showContactHead()
        {
            echo "Contact";
        } 
    function showContactHeader()
        {
            echo '<h1>Contact</h1>';
        }
    function showContactContent($data) 
        {
            echo '<h2>Contact opnemen?</h2>';
            showContactForm($data);          
        }
        
        
?>    