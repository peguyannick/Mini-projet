<?php
session_start();
error_reporting(1);
include 'includes/config.php';

if ($_SESSION['alogin'] != '') {
    $_SESSION['alogin'] = '';
}

if (isset($_POST['login'])) {
    $uname = $_POST['username'];
    $password = $_POST['password'];

    // Requête préparée pour éviter les injections SQL
    $stmt = $dbh1->prepare("SELECT UserName, Password, is_admin FROM users WHERE UserName = ?");
    $stmt->bind_param("s", $uname);  // Protection contre injection SQL avec bind_param()
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        // Vérification du mot de passe avec password_verify() pour un meilleur hachage
        if (password_verify($password, $row['Password'])) {
            $_SESSION['alogin'] = $row['UserName'];
            $_SESSION['is_admin'] = $row['is_admin'];

            header('Location: dashboard.php');
            exit();
        } else {
            $_SESSION['msgErreur'] = "Mauvais identifiant ou mot de passe.";
        }
    } else {
        $_SESSION['msgErreur'] = "Mauvais identifiant ou mot de passe.";
    }
}
?>
