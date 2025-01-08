<?php
function generateRandomPassword($minLength = 10, $maxLength = 18) {

    $upperCase = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $lowerCase = 'abcdefghijklmnopqrstuvwxyz';
    $numbers = '0123456789';
    $specialChars = '!@#$%^&*()-_=+<>?';

    
    $allCharacters = $upperCase . $lowerCase . $numbers . $specialChars;
    $password = '';
    $password .= $upperCase[random_int(0, strlen($upperCase) - 1)];
    $password .= $lowerCase[random_int(0, strlen($lowerCase) - 1)];
    $password .= $numbers[random_int(0, strlen($numbers) - 1)];
    $password .= $specialChars[random_int(0, strlen($specialChars) - 1)];

    
    $length = random_int($minLength, $maxLength);

    
    for ($i = 4; $i < $length; $i++) {
        $password .= $allCharacters[random_int(0, strlen($allCharacters) - 1)];
    }

    $password = str_shuffle($password);

    return $password;
}

$randomPassword = generateRandomPassword();
echo  $randomPassword;
?>
