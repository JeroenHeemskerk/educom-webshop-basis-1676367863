<?php
    $page = getRequestedPage();
    showResponsePage($page);

        function getRequestedPage()
         {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            return $_POST['page'];
        } else {
        return (isset($_GET["page"]) ? $_GET["page"] : 'home');
        }
        }

        function showDocumentStart()
                {
                    echo "<!DOCTYPE html>
                        <html lang='NL'>
                        <head>
                            <link rel='stylesheet' href='mystyle.css' />
                        </head>
                        <body>"
                }
        
        function showMenu ();
            $pages = ['home', 'about', 'contact'];
                echo '<ul class="menu">
                    <li id="keuzemenu"><a href="home.php" class="active">Home</li> 
                    <li id="keuzemenu"><a href="about.php" class="inactive">About</a></li>
                    <li id="keuzemenu"><a href="contact.php" class="inactive">Contact</a></li>
                    </ul>'