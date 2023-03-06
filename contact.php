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
            $data = validateContact();
            if ($data['valid']) {
                showContactThanks($data);
            } else { showContactForm($data);
            }
        }
        
        
define('TITLE_OPTIONS', array("dhr" => 'Dhr', "mvr" =>  'Mvr', "OTHER" => 'Anders')); 
define('CONTACT_OPTIONS', array("telefoon" => 'per Telefoon', "mail" => 'per E-mail'));

    function validateContact()
        {

$titleErr = $nameErr = $emailErr = $telefoonErr = $favcontactErr = $commentErr = "";
$title = $name = $email = $telefoon = $favcontact = $comment = "";
$valid = false; // declaring variables



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
    "favcontactErr" => $favcontactErr,"commentErr" => $commentErr, "valid" => $valid);
}
    function test_input($data) {
        $data = trim($data);
        $data = htmlspecialchars($data);
        return $data;
        }               
      
    

    function showContactForm($data) /* contact form */
    { 
            
        echo  "<form  method='post' action='index.php'>
                <label for='title'>Aanhef:</label>
                    <select name='title'>
                    <option value=''>Selecteer een optie</option>";
        foreach(TITLE_OPTIONS as $key => $label)
        {
            echo "<option value='$key'" . ($data['title'] == $key ? 'selected' : '') . ">$label</option>";
        }
            echo "</select>
                    <span class='error'>" . $data['titleErr'] . "</span><br>
            <label class='NAW' for='name'>Naam:</label>
                <input type='text' name='name' id='name' value='" . $data['name'] . "'>
                    <span class='error'>" . $data['nameErr'] . "</span><br>
            <label class='NAW' for='email'>E-mail:</label>
                <input type='text' name='email' id='mailadres' value='" . $data['email'] . "'>
                    <span class='error'>" . $data['emailErr'] . "</span><br>
            <label class='NAW' for='telephone'>Telefoonnummer:</label>
                <input type='text' name='telefoon' id='telefoonnummer' value='" .$data['telefoon'] . "'>
                    <span class='error'>" . $data['telefoonErr'] . "</span><br><br><br>
            <label for='contact'>Hoe wilt u gecontacteerd worden:</label>
                <span class='error'>" . $data['favconactErr'] . "</span><br><br>";
            
        foreach(CONTACT_OPTIONS as $key => $contactoptions)
        {
             echo "<input type='radio' name='favcontact' value='$key' " . ($data['favcontact'] == $key ? 'checked' : '') . ">
                        <label for='$key'>$contactoptions</label><br>"; 
        } 
            echo "<br><label for='comment'>Beschrijf in het kort waar u contact over wilt opnemen:</label><br><br>
                    <textarea name='comment' rows='10' cols='50' maxlength='250' >" . $data['comment'] . "</textarea><br>
                        <span class='error'>" . $data['commentErr'] . "</span><br>";
            echo "<input name='page' value='contact' type='hidden'>";
            echo "<input type='submit' name='versturen' value='Versturen'></form>";
    }
                
    function showContactThanks($data) //Showing a Thank you for filling in the form correctly.
    {       
        echo "<p>Bedankt voor uw bericht, " . $data['name'] . ".<br>
                Wij zullen spoedig contact opnemen" . $data['favcontact'] . ".<br>
                <br>
                Uw gegevens zijn als volgt:<br>
                </p>";
        echo $data['title']; 
        echo $data['name']."<br>";
        echo $data['email']."<br>";
        echo $data['telefoon'];              
    }
    
    
         
?>    