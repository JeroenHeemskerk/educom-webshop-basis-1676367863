<!DOCTYPE html>
<html lang="NL"> <!-- page language -->
    <head>
        <link rel="stylesheet" href="mystyle.css"> <!-- style document -->
        <title>Contact</title> <!-- titel van pagina -->
                    <h1>Contact</h1> <!-- header van pagina -->
        
    </head>
        <body>
            
                <ul id="menu"> <!-- menu -->
                    <li><a href="home.php">Home</a></li>
                    <li><a href="about.php">About</a></li>
                    <li><a href="contact.php" class="active">Contact</a></li>
                </ul>
<div class="content">
      <h2>Contact opnemen?</h2> <!-- Titel van de contact form-->
<?php



define('TITLE_OPTIONS', array("dhr" => 'Dhr', "mvr" =>  'Mvr', "OTHER" => 'Anders')); 
define('CONTACT_OPTIONS', array("telefoon" => 'per Telefoon', "mail" => 'per E-mail'));

$titleErr = $nameErr = $emailErr = $telefoonErr = $favcontactErr = $commentErr = "";
$title = $name = $email = $telefoon = $favcontact = $comment = "";
$valid = false; // declaring variables


if ($_SERVER["REQUEST_METHOD"] == "POST") {  //set conditions
    if  ($_POST["title"] == "") {
        $titleErr="* Selecteer aanhef"; 
    } else {
        $title=test_input($_POST["title"]);
        if (!array_key_exists($title, TITLE_OPTIONS)) {
            $titleErr = "Onbekende aanhef.";
        }
    }
    if  (empty($_POST["name"])) {
        $nameErr="* Vul uw naam in";
    } else { 
        $name=test_input($_POST["name"]);
    }

    if (empty($_POST["email"])) {
        $emailErr ="* Vul een mailadres in";
    } else { 
        $email=test_input($_POST["email"]);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailErr="* Vul een geldig emailadres in";
        }
    }
    if (empty($_POST["telefoon"])) {
        $telefoonErr="* Vul uw telefoonnummer in";
    }
    else  { 
        $telefoon=test_input($_POST["telefoon"]); 
    } 
    
    if (empty($_POST["favcontact"])) {
        $favcontactErr="* Selecteer een contact optie";
    }   
    else { 
        $favcontact=test_input($_POST["favcontact"]);
        if (!array_key_exists($favcontact, CONTACT_OPTIONS)) {
            $favcontactErr = "Onbekende contactoptie";
        } 
    }
    
    if (empty($_POST["comment"])) {
        $commentErr="* Vul uw reden voor contact in";
    }
    else { 
        $comment=test_input($_POST["comment"]); 
    }
    
    if ( $titleErr === "" && $nameErr === "" && $emailErr === "" && $telefoonErr === "" && $favcontactErr === "" &&  $commentErr === "" ) {
   $valid = true; }
        
}
     
    function test_input($data) {
        $data = trim($data);
        $data = htmlspecialchars($data);
        return $data;
        }               
      

?>
    <section>
    <?php if (!$valid) { ?>
                <form  method="post" action="contact.php"> <!-- contact form -->
                                                         
                    <label for="title">Aanhef:</label>
                            <?php 
                                
                                echo "<select name='title'>";
                                echo "<option value=''>Selecteer een optie</option>";

                                foreach(TITLE_OPTIONS as $key => $label)
                                {
                                echo "<option value=$key " . ($title == $key ? "selected" : "") . ">$label</option>";
                                }
                                echo "</select>"
                            ?>
                            <span class="error"><?php echo $titleErr; ?></span><br>
                    <label class="NAW" for="name">Naam:</label><!-- kopje waar men hun naam kan invullen -->
                        <input type="text" name="name" id="name" value="<?php echo $name;?>">
                        <span class="error"><?php echo $nameErr; ?></span><br>
                    <label class="NAW"for="email">E-mail:</label> <!-- kopje waar men hun email kan invullen -->
                        <input type="text" name="email" id="mailadres" value="<?php echo $email;?>">
                        <span class="error"><?php echo $emailErr; ?></span><br>
                    <label class="NAW" for="telephone">Telefoonnummer:</label> <!-- kopje waar men hun Telefoonnummer kan invullen -->
                        <input type="text" name="telefoon" id="telefoonnummer" value="<?php echo $telefoon;?>">
                        <span class="error"><?php echo $telefoonErr; ?></span><br><br><br>   
                
                              
                    <label for="contact">Hoe wilt u gecontacteerd worden:</label> <!-- In de opdracht stond communicatievoorkeur, maar ik vond dit wat netter staan -->
                    <span class="error"><?php echo $favcontactErr; ?></span>
                    <br>
                    <br>
                <?php
                    foreach(CONTACT_OPTIONS as $key => $contact)
                    {
                    echo "<input type='radio' name='favcontact' value='$key' " . ($favcontact == $key ? "checked" : "") ." >". // de radio buttons met opties telefoon nummer & email
                        "<label for='$key'>$contact</label><br>"; 
                    }
                ?>    
                <br>
                <br>
                    <label for="comment">Beschrijf in het kort waar u contact over wilt opnemen:</label> <!-- textarea waar men kort en bondig kan opschrijven waarover ze contact willen hebben -->
                <br>
                <br>
                    <textarea name="comment" rows="10" cols="50" maxlength="250" ><?php echo $comment;?></textarea><br> <!-- ik heb gelijkt een maximum aantal characters toegevoegd zodat er geen gigantische verhalen verstuurd worden -->
                        <span class="error"><?php echo $commentErr; ?></span>
                        
                <br>
                        <input type="submit" name="versturen" value="Versturen">
                </form>
    
        <?php     
                     
          
                
                
                 } else { ?>
                <p>Bedankt voor uw bericht, <?php echo $name; ?>.<br>
                Wij zullen spoedig contact opnemen <?php echo $favcontact ?>.<br>
                <br>
                Uw gegevens zijn als volgt:<br></p>
                <?php
                echo $title. ' '; 
                echo $name; ?><br>
                <?php
                echo $email; ?><br>
                <?php
                echo $telefoon;
                ?>
                <?php } 
                 ?>
</section>

            </div>
            <footer>&copy Created by Ruben van der Zouw 2023</footer>
        </body>
</html>