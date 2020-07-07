<?php
// if (isset($_COOKIE['username']) && isset($_COOKIE['identifier'])) {
//     header("Location: ../account.php?cookie=unset");
// } else {
session_start();
setcookie("mod_auth_openidc_session","",time() -3600);
session_unset();
session_destroy();
if ($_SERVER['REQUEST_URI'] == "m1igrades.msp.ccsn.ch" || $_SERVER['REQUEST_URI'] == "m1pgrades.msp.ccsn.ch") {
    $server = $_SERVER['REQUEST_URI'];
    header("Location: https://login-i-ng.xtra.netwatch.ch/auth/realms/MSP/protocol/openid-connect/logout?redirect_uri=https%3A%2F%2F$server");

} else {
    $server = $_SERVER['REQUEST_URI'];
    header("Location: https://login-i-ng.xtra.netwatch.ch/auth/realms/MSP/protocol/openid-connect/logout?redirect_uri=https%3A%2F%2F$server");
}
// }