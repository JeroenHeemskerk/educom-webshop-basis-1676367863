<?php

    function showRegisterHead()
    {
        echo "Register";
    } 
    function showRegisterHeader()
    {
        echo '<h1>Registreren</h1>';
    }
    function showRegisterContent() 
    {
        echo '<div class="content">
        <h2>Vul hier uw gegevens in:</h2>';
        $data = validateRegister();
        if ($data['valid']) {
            showRegisterThanks($data);
        } else {
            showRegisterForm($data);
        }
    }
    function validateRegister() /* validating register form */
    {
        
$nameErr = $emailErr = $passwordErr = $repeatpasswordErr = "";
$name = $email = $password = $repeatpassword = "";
$valid = false; // declaring variables

        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            if (empty(getPostVar('email'))) {
            $emailErr ="* Vul een mailadres in";
        } else {
            $email=test_input(getPostVar('email')); 
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailErr="* Vul een geldig emailadres in";
        }
        }
        
        if (empty(getPostVar('name'))) { 
            $nameErr="* Vul uw naam in";
        } else { 
            $name=test_input(getPostVar("name"));
        }
        if (empty(getPostVar('password'))) {
            $passwordErr="* Vul uw wachtwoord in";
            } else {
            $password=test_input(getPostVar("password"));     
            } 
        if (empty(getPostVar('repeatpassword'))) {
            $repeatpasswordErr="* Herhaal uw wachtwoord";
        } else { $repeatpassword=test_input(getPostVar("repeatpassword"));
            if (getPostVar('repeatpassword') !== (getPostVar('password'))) {
                $repeatpasswordErr ="* Uw wachtwoorden zijn niet gelijk";
            }
        }
        
        if ( $emailErr === "" && $nameErr === "" && $passwordErr === "" && $repeatpasswordErr === "" ) {
            $users_file = fopen("Users/users.txt", "r");
            while (!feof($users_file)) { 
                $row= fgets($users_file);
                $parts = explode("|", $row);
                if ($parts[0] == $email) {
                    $emailErr = "* Emailadres is al in gebruik";
                }
            }
            fclose($users_file);

            if ($emailErr === "") {
            $valid = true; 
            
            $users_file = fopen("Users/users.txt", "a");
            $new_user = PHP_EOL ."$email|$name|$password";
            fwrite($users_file, $new_user);
            fclose($users_file);
            }
        }
    }
    return array("email" => $email, "name" => $name, "password" => $password, "repeatpassword" => $repeatpassword,
                 "emailErr" => $emailErr, "nameErr" => $nameErr, "passwordErr" => $passwordErr, "repeatpasswordErr" => $repeatpasswordErr,
                  "valid" => $valid);

} 

function debug_to_console($data) {
    $output = $data;
    if (is_array($output))
        $output = implode(',', $output);
    echo "<script>console.log('Debug Objects: " . $output . "' );</script>";
  }
    
    function test_input($data) {
        $data = trim($data);
        $data = htmlspecialchars($data);
        return $data;
        } 
    
    function showRegisterForm($data) /* register form */
        {
            echo '<form method="post" action="index.php">
            <label for="email">E-mail:</label>
            <input type="text" name="email" value="' . $data["email"] . '"><br>
            <span class="error">' . $data["emailErr"] . '</span><br>
            <label for="name">Naam:</label>
            <input type="text" name="name" value="' . $data["name"] . '"><br>
            <span class="error">' . $data["nameErr"] . '</span><br>
            <label for="password">Wachtwoord:</label>
            <input type="password" name="password" value="' . $data["password"] . '"><br>
            <span class="error">' . $data["passwordErr"] . '</span><br>
            <label for="repeatpassword">Herhaal Wachtwoord:</label>
            <input type="password" name="repeatpassword" value="' . $data["repeatpassword"] . '"><br>
            <span class="error">' . $data["repeatpasswordErr"] . '</span><br>';
            echo '<input name="page" value="register" type="hidden">';
            echo '<input type="submit" name="versturen" value="Registreren">';
            echo '</form>'; // end of form
        }

    function showRegisterThanks($data)
        {
            echo 'Bedankt voor het registreren, ' . $data['name'] . '.';
            echo 'U kunt nu inloggen.';

        }
       
?>