<?php
// if (isset($_COOKIE['username']) && isset($_COOKIE['identifier'])) {
//     header("Location: ../account.php?cookie=unset");
// } else {
session_start();
setcookie("mod_auth_openidc_session","",time() -3600);
session_unset();
session_destroy();
// header("Location: ../account.php?info=logout");
header("../account.php?logout=complete");
// }