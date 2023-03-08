<?php
    require_once('forms.php');
    require_once('validations.php');

    $page = getRequestedPage();
    $data = processRequest($page);
    showResponsePage($data);

    function processRequest($page) {
        switch($page) {
            case 'contact':
                $data = validateContact();
                if ($data['valid']) { $page = 'thanks'; }
                // showContactThanks($data); }
                // } else { 
                //     showContactForm($data);
                // }
                break;
            case 'register' :
                $data = validateRegister();
                if ($data['valid']) { $page = 'registerthanks'; }
                //  showRegisterThanks($data);
                // } else {
                //     showRegisterForm($data);
                // }
                break;
        }
        $data['page'] = $page;
        return $data;

    }

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
        
    function showResponsePage($data)
    { 
        showDocumentstart(); 
        showHeadSection($data);
        showBodySection($data);
        showDocumentEnd();
    }
    
    function showDocumentStart()
    {
        echo   "<!DOCTYPE html>
                <html lang='NL'>";
                
    }

                
    function showHeadSection($data) 
    { 
        echo "<head><link rel='stylesheet' href='mystyle.css'>";
        echo '<title>';  
        switch($data['page']) 
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
                case 'login' :
                    require_once('login.php');
                    showLoginHead();
                    break;
            }
        echo '</title></head>' ;   
    }
        
    function showBodySection($data)
    {
                echo '<body>';
                showHeader($data);
                showMenu();
                showContent($data);
                showFooter();
                echo '</body>';
    }
    
    function showHeader($data) 
    {
            switch($data['page']) 
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
                case 'thanks' :
                    require_once('contact.php');
                    showContactHeader();
                    break;  
                case 'register' :
                case 'registerthanks' :
                    require_once('register.php');
                    showRegisterHeader();
                    break;
                case 'login' :
                    require_once('login.php');
                    showLoginHeader();
                    break;
            }      
    }

          
    
    function showMenu()
    { 
        define('MENU_OPTIONS', array("home" => "Home", "about" => "About", "contact" => "Contact", "register" => "Register", "login" => "Log in"));
        echo    '<ul id="menu">';

        foreach(MENU_OPTIONS as $key => $MenuOptions) {
                echo '<li><a href="index.php?page=' . $key . '">' . $MenuOptions. '</a></li>';
        }
        echo '</ul>';
    }
    
    function showContent($data) 
    {
        echo 	'<div class="content">';
        switch($data['page']) 
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
                    showContactContent($data);
                    break;
                case 'register' :
                    require_once('register.php');
                    showRegisterContent($data);
                    break;
                case 'thanks' :
                    require_once('forms.php');
                    showContactThanks($data);
                    break;
                case 'registerthanks' :
                    require_once('forms.php');
                    showRegisterThanks($data);
                    break;
                case 'login' :
                    require_once ('login.php');
                    showLoginContent($data);
                    break;
                default:
                echo "ERROR, Page not found"; 
                echo "</div>"; 
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
        echo "</html>";
    }
?>        