<?php
if (isset($_COOKIE['username']) && isset($_COOKIE['identifier'])) {
    setcookie('username','',time()-100,'');
    setcookie('identifier','',time()-100,'');
    session_start();
    session_unset();
    session_destroy();
    header("Location: ../account.php?cookie=unset");
} else {
    session_start();
    session_unset();
    session_destroy();
    header("Location: ../account.php");
}