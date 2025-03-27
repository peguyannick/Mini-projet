<?php

use PHPUnit\Framework\TestCase;

class PasswordHashTest extends TestCase
{
    public function testPasswordHashing()
    {
        $motDePasse = "MonSuperMotDePasse123";

        // Hachage du mot de passe
        $hashedPassword = password_hash($motDePasse, PASSWORD_BCRYPT);

        // Vérifier que le mot de passe haché n'est pas identique au mot de passe brut
        $this->assertNotEquals($motDePasse, $hashedPassword, "Le hash ne doit pas être identique au mot de passe brut.");

        // Vérifier que le mot de passe correspond au hash généré
        $this->assertTrue(password_verify($motDePasse, $hashedPassword), "Le mot de passe doit correspondre au hash généré.");
    }
}
