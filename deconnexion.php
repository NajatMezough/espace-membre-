<?php
session_start();

// Réinitialiser toutes les variables de session
$_SESSION = [];

// Détruire la session
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(
        session_name(),
        '',
        time() - 42000,
        $params["path"],
        $params["domain"],
        $params["secure"],
        $params["httponly"]
    );
}

session_destroy();

// Redirection vers la page de connexion
header("Location: connexion.php");
exit();
?>
