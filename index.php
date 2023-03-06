<?php
    
    $page = getRequestedPage();
    showResponsePage($page);

    function getPostVar($key, $default = '') 
    {
        return isset($_POST[$key]) ? $_POST[$key] : $default;
    }
    function getUrlVar($key, $default = '') 
    {
        return isset($_GET[$key]) ? $_GET[$key] : $default;
    }
  
    function getRequestedPage()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") { 
            return getPostVar("page", "home"); 
        } else { 
            return getUrlVar("page", "home"); 
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
        switch($page) 
            {
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
                case 'register' :
                    require_once('register.php');
                    showRegisterHead();
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
    
    function showHeader($page) 
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
                case 'register' :
                    require_once('register.php');
                    ShowRegisterHeader();
                break;
            }      
    }

          
    
    function showMenu()
    { 
        define('MENU_OPTIONS', array("home" => "Home", "about" => "About", "contact" => "Contact", "register" => "Register"));
        echo    '<ul id="menu">';

        foreach(MENU_OPTIONS as $key2 => $MenuOptions) {
                echo '<li><a href="http://localhost/educom-webshop-basis/index.php?page=' . $key2 . '">' . $MenuOptions. '</a></li>';
        }
        echo '</ul>';
    }
    
    function showContent($page) 
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
                case 'register' :
                    require_once('register.php');
                    showRegisterContent();
                default:
                echo "ERROR, Page not found";  
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
?>        