<?php
    
    $page = getRequestedPage();
    showResponsePage($page);
 

        function getRequestedPage()
        {
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                return $_POST["page"];
            } else {
                return (isset($_GET["page"]) ? $_GET["page"] : 'home');
            }
        }
        function showResponsePage($page)
            { 
            showDocumentstart(); 
            showHeadSection($page);
            showBodySection($page);
            showDocumentEnd();
            }
    
        function showDocumentStart()
            {
                echo   "<!DOCTYPE html>
                        <html lang='NL'>
                        <link rel='stylesheet' href='mystyle.css'>";
            }

                
        function showHeadSection($page) 
            { 
                echo '<head><title>';  
                  switch  ($page) {
                    case 'home' :
                        require_once('home.php');
                        showHomeHead();
                    break;
                    
                    case 'about' :
                        require_once('about.php');
                        showAboutHead();
                    break;
                    
                    case 'contact' :
                        require_once('contact.php');
                        showContactHead();
                    break;
                    }

                echo '</title></head>' ;   
            }
        
        function showBodySection($page)
            {
                echo '<body>';
                showHeader($page);
                showMenu();
                showContent($page);
                showFooter();
                echo '</body>';
            }
        function showHeader($page) {
            
            {
                switch($page) 
                    { 
                        case 'home':
                            require_once('home.php');
                            showHomeHeader();
                            break;
                        case 'about':
                            require_once('about.php');
                            showAboutHeader();
                            break;
                        case 'contact':
                            require_once('contact.php');
                            showContactHeader();
                            break;  
                }     
             }
            }
      
        function showMenu()
        {
                echo    '<ul id="menu">
                            <li><a href="http://localhost/educom-webshop-basis/index.php?page=home">Home</a></li>
                            <li><a href="http://localhost/educom-webshop-basis/index.php?page=about">About</a></li>
                            <li><a href="http://localhost/educom-webshop-basis/index.php?page=contact">Contact</a></li>
                            
                        </ul>';
        }
        function showContent($page) {
            
            {
                switch($page) 
                    { 
                        case 'home':
                            require_once('home.php');
                            showHomeContent();
                            break;
                        case 'about':
                            require_once('about.php');
                            showAboutContent();
                            break;
                        case 'contact':
                            require_once('contact.php');
                            showContactContent();
                            break;
                        default:
                        echo "ERROR, Page not found";  
                }     
             }
            }

        function showFooter()
            {
                echo '<footer>
                <div>&copy Created by R. van der Zouw 2023</div>
                </footer>';
            }
        function showDocumentEnd()
            {
            echo "</div>
            </html>";
        }