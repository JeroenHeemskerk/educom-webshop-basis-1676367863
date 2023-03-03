<?php
    function showContactHead()
        {
            echo "Contact";
        } 
    function showContactHeader()
        {
            echo '<h1>Contact</h1>';
        }
    function showContactContent() 
        {
            echo '<div class="content">
            <h2>Contact opnemen?</h2>';
        }
   
    
define('TITLE_OPTIONS', array("dhr" => 'Dhr', "mvr" =>  'Mvr', "OTHER" => 'Anders')); 
define('CONTACT_OPTIONS', array("telefoon" => 'per Telefoon', "mail" => 'per E-mail'));

$titleErr = $nameErr = $emailErr = $telefoonErr = $favcontactErr = $commentErr = "";
$title = $name = $email = $telefoon = $favcontact = $comment = "";
$valid = false; // declaring variables

function validateContact()
{

if ($_SERVER["REQUEST_METHOD"] == "POST") {  //set conditions
    if  (($title) == "") {
        $titleErr="* Selecteer aanhef"; 
    } else {
        $title=test_input(getPostVar(["title"]));
        if (!array_key_exists($title, TITLE_OPTIONS)) {
            $titleErr = "Onbekende aanhef.";
        }
    }
    if  (empty($name)) {
        $nameErr="* Vul uw naam in";
    } else { 
        $name=test_input(getPostVar("name"));
    } if  (!preg_match("/^[a-zA-Z-' ]*$/", $name)) {
        $nameErr = "Alleen letters en spaties zijn toegestaan.";
    }


    if (empty($email)) {
        $emailErr ="* Vul een mailadres in";
    } else { 
        $email=test_input(getPostVar("email"));
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailErr="* Vul een geldig emailadres in";
        }
    }
    if (empty($telefoon)) {
        $telefoonErr="* Vul uw telefoonnummer in";
    }
    else  { 
        $telefoon=test_input(getPostVar("telefoon")); 
    } 
    
    if (empty($favcontact)) {
        $favcontactErr="* Selecteer een contact optie";
    }   
    else { 
        $favcontact=test_input(getPostVar("favcontact"));
        if (!array_key_exists($favcontact, CONTACT_OPTIONS)) {
            $favcontactErr = "Onbekende contactoptie";
        } 
    }
    
    if (empty($comment)) {
        $commentErr="* Vul uw reden voor contact in";
    }
    else { 
        $comment=test_input(getPostVar("comment")); 
    }
    
    if ( $titleErr === "" && $nameErr === "" && $emailErr === "" && $telefoonErr === "" && $favcontactErr === "" &&  $commentErr === "" ) {
   $valid = true; }
        
    }
    return array("title" => $title, "name" => $name, "email" => $email, "telefoon" => $telefoon,
    "favcontact" => $favcontact, "comment" => $comment, "titleErr" => $titleErr,
    "nameErr" => $nameErr, "emailErr" => $emailErr, "telefoonErr" => $telefoonErr,
    "favcontactErr" => $favcontactErr, "valid" => $valid);
}
    function test_input($data) {
        $data = trim($data);
        $data = htmlspecialchars($data);
        return $data;
        }               
      
    

        function showContactForm() { /* contact form */
            if (!$valid) {
                     echo  "<form  method='post' action='contact.php'>
                        <label for='title'>Aanhef:</label>
                        <select name='title'>
                        <option value=''>Selecteer een optie</option>";
                        
                               foreach(TITLE_OPTIONS as $key => $label)
                                {
                                echo "<option value='$key' " . ($title == $key ? 'selected' : '') . ">$label</option>";
                                }
                                echo "</select>
                                        <span class='error'>$titleErr</span><br>
                                <label class='NAW' for='name'>Naam:</label>
                                    <input type='text' name='name' id='name' value='$name'>
                                        <span class='error'>'$nameErr'</span><br>
                                <label class='NAW' for='email'>E-mail:</label>
                                    <input type='text' name='email' id='mailadres' value='$email'>
                                        <span class='error'>$emailErr</span><br>
                                <label class='NAW' for='telephone'>Telefoonnummer:</label>
                                    <input type='text' name='telefoon' id='telefoonnummer' value='$telefoon'>
                                        <span class='error'>$telefoonErr</span><br><br><br>
                                <label for='contact'>Hoe wilt u gecontacteerd worden:</label>
                                        <span class='error'>$favcontactErr</span><br><br>";
                  
                
                                foreach(CONTACT_OPTIONS as $key => $contact)
                                {
                                echo "<input type='radio' name='favcontact' value='$key' " . ($favcontact == $key ? 'checked' : '') . ">
                                <label for='$key'>$contact</label><br><br><br>"; 
                                } 
                                 "<label for='comment'>Beschrijf in het kort waar u contact over wilt opnemen:</label><br><br>";
                                echo "<textarea name='comment' rows='10' cols='50' maxlength='250' >$comment</textarea><br>";
                                echo "<span class='error'>$commentErr</span><br>"; 
                                echo "<input type='submit' name='versturen' value='Versturen'>
                                </form>";
                            } else  
        {
                echo '<p>Bedankt voor uw bericht, <?php echo $name; ?>.<br>
                            Wij zullen spoedig contact opnemen <?php echo $favcontact ?>.<br>
                            <br>
                            Uw gegevens zijn als volgt:<br>
                    </p>';
                echo $title. ' '; 
                echo $name;"<br>";
                echo $email;"<br>";
                echo $telefoon;               
        }
    }
    
         
?>    