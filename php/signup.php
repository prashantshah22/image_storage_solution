<?php
require("database.php");
require("authcode.php");
require("mail.php"); // Include the mail.php script

$fullname = base64_decode($_POST["fullname"]);
$username = base64_decode($_POST["email"]);
$password = md5(base64_decode($_POST["password"]));
$authcode = authcode(5, 8);

$store_user = "INSERT INTO user (fullname, username, password, activation_code)
VALUES ('$fullname', '$username', '$password', '$authcode')";

if ($db->query($store_user)) {
    if (sendActivationEmail($username, $authcode)) {
        echo "sending success";
    } else {
        echo "sending fail";
    }
} else {
    echo "Sign-up failed";
}
?>
