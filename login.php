<?php

function showLoginHead() {
    echo "Log in";
}

function showLoginHeader() {
    echo "<h1>Log in</h1>";
}

function showLoginContent($data) {
    
    echo '<h2>Vul uw logingegevens in.</h2>';
    showLoginForm($data);
}   