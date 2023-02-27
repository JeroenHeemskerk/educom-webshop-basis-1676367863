<!DOCTYPE html>
<html lang="NL"> <!-- ik heb bij deze pagina vooralsnog maar even geen poging gedaan om alles gecentreerd te krijgen -->
    <head>
        <link rel="stylesheet" href="mystyle.css">
        <title>Contact</title> <!-- wederom een klein beetje styling -->
                    <h1>Contact</h1> <!-- in ieder geval deze knoppen op de zelfde plekken houden door de hele website heen -->
        
    </head>
        <body>
            
                <ul id="menu">
                    <li><a href="home.php">Home</a></li>
                    <li><a href="about.php">About</a></li>
                    <li><a href="contact.php" class="active">Contact</a></li>
                </ul>
<div class="content">
      <h2>Contact opnemen?</h2>
<?php  

 
$titleErr = $nameErr = $emailErr = $telefoonErr = $favcontactErr = $commentErr = "";
$title = $name = $email = $telefoon = $favcontact = $comment = "";
$valid = false;


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if  ($_POST["title"] == "noneselected") {
        $titleErr="* Selecteer aanhef"; 
    } else {
        $aanhef=test_input($_POST["title"]);
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
                        <select id="title" name="title"> <!-- options for title -->
                            <option id="none" value="noneselected">Selecteer een optie</option>
                            <option id="male" value="Dhr"<?php echo (isset($_POST['title']) && $_POST['title'] == 'Dhr') ? ' selected="selected"' : '' ; ?>>Dhr</option>
                            <option id="female" value="Mvr"<?php echo (isset($_POST['title']) && $_POST['title'] == 'Mvr') ? ' selected="selected"' : '' ; ?>>Mvr</option>
                            <option id="else" value="Anders"<?php echo (isset($_POST['title']) && $_POST['title'] == 'Anders') ? ' selected="selected"' : '' ; ?>>Anders</option>
                        </select>
                        <span class="error"><?php echo $titleErr; ?></span>
                        
                <br>
                    <label class="NAW" for="name">Naam:</label><!-- kopje waar men hun naam kan invullen -->
                        <input type="text" name="name" id="name" value="<?php echo $name;?>">
                        <span class="error"><?php echo $nameErr; ?></span><br>
                    <label class="NAW"for="email">E-mail:</label> <!-- kopje waar men hun email kan invullen -->
                        <input type="text" name="email" id="mailadres" value="<?php echo $email;?>">
                        <span class="error"><?php echo $emailErr; ?></span><br>
                    <label class="NAW" for="telephone">Telefoonnummer:</label> <!-- kopje waar men hun Telefoonnummer kan invullen -->
                        <input type="text" name="telefoon" id="telefoonnummer" value="<?php echo $telefoon;?>">
                        <span class="error"><?php echo $telefoonErr; ?></span><br>   
                    
                <br>
                <br>
                    <label for="contact">Hoe wilt u gecontacteerd worden:</label> <!-- In de opdracht stond communicatievoorkeur, maar ik vond dit wat netter staan -->
                    <span class="error"><?php echo $favcontactErr; ?></span>
                    <br>
                <br>
                    <input type="radio" id="favcontactphone" name="favcontact" value="per Telefoon" <?php echo($favcontact =='per Telefoon')?'checked':''?>> <!-- de radio buttons met opties telefoon nummer & email -->
                        <label for="per telefoon">Telefoon</label><br>
                    <input type="radio" id="favcontactmail" name="favcontact" value="per Email" <?php echo($favcontact =='per Email')?'checked':''?>> <!-- id veranderd naar mailradio omdat de id email al voorkomt. -->
                        <label for="mailradio">E-mail</label>
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