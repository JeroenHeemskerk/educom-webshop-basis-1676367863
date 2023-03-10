<?php
    function doesEmailExist($email) {
        $user = findUserByEmail($email);
        if (empty($user)) {
            return FALSE;
        } else {
        return TRUE;
        }
    } 
    
    function StoreUser($email, $name, $password) {
        saveNewUser($email, $name, $password);
    }
?>