<?php
// Exemple de mot de passe utilisateur
$motDePasse = "MonSuperMotDePasse123";

// Hachage du mot de passe avec password_hash()
$hashedPassword = password_hash($motDePasse, PASSWORD_BCRYPT);

// Vérification que le mot de passe a bien été haché (le hash ne doit pas être égal au mot de passe brut)
if ($hashedPassword === $motDePasse) {
    echo "Échec du hachage : le mot de passe brut et le hash ne devraient pas être identiques !";
} else {
    echo "Le mot de passe a bien été haché.<br>";
}

// Test de la correspondance du mot de passe brut avec le hash
if (password_verify($motDePasse, $hashedPassword)) {
    echo "Vérification réussie : le mot de passe correspond au hash !";
} else {
    echo "Échec de la vérification : le mot de passe ne correspond pas au hash.";
}
?>
