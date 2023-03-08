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
                if ($data['valid']) { 
                    showContactThanks($data);
                } else { 
                    showContactForm($data);
                }
                break;
            case 'register' :
                $data = validateRegister();
                if ($data['valid']) {
                    showRegisterThanks($data);
                } else {
                    showRegisterForm($data);
                }
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
                <html lang='NL'>
                <link rel='stylesheet' href='mystyle.css'>";
    }

                
    function showHeadSection($data) 
    { 
        echo '<head><title>';  
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

        foreach(MENU_OPTIONS as $key => $MenuOptions) {
                echo '<li><a href="index.php?page=' . $key . '">' . $MenuOptions. '</a></li>';
        }
        echo '</ul>';
    }
    
    function showContent($data) 
    {
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
                    showContactContent();
                    break;
                case 'register' :
                    require_once('register.php');
                    showRegisterContent();
                    break;
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