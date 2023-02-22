<!DOCTYPE html>
<html lang="NL"> <!-- ik heb bij deze pagina vooralsnog maar even geen poging gedaan om alles gecentreerd te krijgen -->
    <head>
        <link rel="stylesheet" href="mystyle.css">
        <title>Contact</title> <!-- wederom een klein beetje styling -->
                    <h1>Contact</h1> <!-- in ieder geval deze knoppen op de zelfde plekken houden door de hele website heen -->
        
    </head>
        <body>
                <ul id="menu">
                    <li id="keuzemenu"><a href="index.html" class="inactive">Home</a></li>
                    <li id="keuzemenu"><a href="about.html" class="inactive">About</a></li>
                    <li id="keuzemenu"><a href="contact.php" class="active">Contact</a></li>
                </ul>
<div class="content">
<   <h2>Contact opnemen?</h2>
<?php          
                  

$nameErr = $emailErr = $telefoonErr = $favcontactErr = $commentErr = "";
$aanhef = $name = $email = $telefoon = $favcontact = $comment = "";



if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["name"])) {
        $nameErr = " * Vul uw naam in";
    }
    else { $name = test_input($_POST["name"]);
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $emailErr = " * Vul een geldig mailadres in";
    }
    else { $email = test_input($_POST["email"]); }

    if (empty($_POST["telefoon"])) {
        $telefoonErr = " * Vul uw telefoonnummer";
    }
    else  { $telefoon = test_input($_POST["telefoon"]); } 
    
    if (empty($_POST["favcontact"])) {
        $favcontactErr = " * Selecteer een contact optie";
    }   
    else { $favcontact = test_input($_POST["favcontact"]); }
    
    if (empty($_POST["comment"])) {
        $commentErr = " * Vul uw reden voor contact in";
    }
    else { $comment = test_input($_POST["comment"]); }
}

function test_input($data) {
  $data = trim($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>

                <form  method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"> <!-- idee wat ik had was alles onder 1 form te doen zodat het als 1 gegeven verstuurd kan worden. -->
                                                         <!-- In het voorbeeld op W3schools hebben ze het over /action.php/ maar aangezien ik nog geen soort gelijk document hebt stuur ik ze terug naar de homepage.-->
                                                         <!-- bij deze instantie leek het mij beter om de method "post" te gebruiken omdat de textarea gevoelige gegevens kan bevatten. -->
                    <label for="Aanhef">Aanhef:</label>
                        <select id="aanhef" name="aanhef"> <!-- opties voor beide geslachten -->
                            <option value="Dhr">Dhr</option>
                            <option value="Mvr">Mvr</option>
                        </select>
                <br>
                    <label class="NAW" for="name">Naam:</label><!-- kopje waar men hun naam kan invullen -->
                        <input type="text" id="naam" name="name">
                        <span class="error"><?php echo $nameErr ?></span><br>
                    <label class="NAW"for="email">E-mail:</label> <!-- kopje waar men hun email kan invullen -->
                        <input type="text" id="email" name="email">
                        <span class="error"><?php echo $emailErr ?></span><br>
                    <label class="NAW" for="telephone">Telefoonnummer:</label> <!-- kopje waar men hun Telefoonnummer kan invullen -->
                        <input type="text" id="telefoon" name="telefoon">
                        <span class="error"><?php echo $telefoonErr ?></span><br>   
                    
                <br>
                <br>
                    <label for="contact">Hoe wilt u gecontacteerd worden:</label> <!-- In de opdracht stond communicatievoorkeur, maar ik vond dit wat netter staan -->
                    <span class="error"><?php echo $favcontactErr ?></span>
                    <br>
                <br>
                    <input type="radio" id="favcontactphone" name="favcontact" value="per Telefoon"> <!-- de radio buttons met opties telefoon nummer & email -->
                    <label for="per telefoon">Telefoon</label><br>
                    <input type="radio" id="favcontactmail" name="favcontact" value="per E-mail"> <!-- id veranderd naar mailradio omdat de id email al voorkomt. -->
                    <label for="mailradio">E-mail</label>
                <br>
                <br>
                    <label for="comment">Beschrijf in het kort waar u contact over wilt opnemen:</label> <!-- textarea waar men kort en bondig kan opschrijven waarover ze contact willen hebben -->
                <br>
                <br>
                        <textarea name="comment" rows="10" cols="50" maxlength="250"></textarea><br> <!-- ik heb gelijkt een maximum aantal characters toegevoegd zodat er geen gigantische verhalen verstuurd worden -->
                        <span class="error"><?php echo $commentErr ?></span>
                        
                <br>
                        <input type="submit" name="versturen" value="Versturen">
                </form>
                <?php
                    echo $aanhef;
                    echo $name;
                    echo "<br>";
                    echo $email;
                    echo "<br>";
                    echo $telefoon;
                    echo "<br>";
                    echo $favcontact;
                    echo "<br>";
                    echo $comment;
                    ?>

            </div>
        </body>
</html>