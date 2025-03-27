<?php

use PHPUnit\Framework\TestCase;

class InputValidationTest extends TestCase
{
    public function testUsernameNotEmpty()
    {
        $username = "user123";
        $this->assertNotEmpty($username, "Le nom d'utilisateur ne doit pas être vide.");
    }

    public function testPasswordMinimumLength()
    {
        $password = "abc123";
        $this->assertTrue(strlen($password) >= 6, "Le mot de passe doit contenir au moins 6 caractères.");
    }

    public function testEmailValidation()
    {
        $email = "example@gmail.com";
        $this->assertMatchesRegularExpression("/^[\w._%+-]+@[\w.-]+\.[a-zA-Z]{2,}$/", $email, "L'adresse e-mail n'est pas valide.");
    }

    public function testInputSanitization()
    {
        $rawInput = "<script>alert('hacked');</script>";
        $sanitizedInput = htmlspecialchars($rawInput, ENT_QUOTES, 'UTF-8');
        $this->assertNotEquals($rawInput, $sanitizedInput, "L'entrée brute doit être différente de l'entrée nettoyée.");
    }
}
