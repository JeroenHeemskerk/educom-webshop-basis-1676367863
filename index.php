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
                echo '<ul id="menu">
                    <li><a href="home.php">Home</a></li> 
                    <li><a href="about.php">About</a></li>
                    <li"><a href="contact.php">Contact</a></li>
                    </ul>'