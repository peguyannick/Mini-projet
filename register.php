<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulaire d'inscription</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            padding: 20px;
        }
        .container {
            width: 400px;
            margin: auto;
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        input[type="text"], input[type="email"], input[type="password"] {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        button {
            width: 100%;
            padding: 10px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Inscription</h2>

    <?php
    require "includes/config.php";
    // Gestion des erreurs et validation
    if (!empty($_POST)) {
        $username = trim($_POST['username']);
        $password = $_POST['password'];
        $confirm_password = $_POST['confirm_password'];

        // Validation des champs
        if (empty($username) ||  empty($password) || empty($confirm_password)) {
            echo "<p style='color: red;'>Tous les champs doivent être remplis !</p>";
        } elseif ($password !== $confirm_password) {
            echo "<p style='color: red;'>Les mots de passe ne correspondent pas !</p>";
        } else {
            // Ici, vous pouvez ajouter des actions comme l'enregistrement dans la base de données
            
            $sql = "SELECT Username FROM users WHERE Username = ?";
            $stmt = $dbh->prepare($sql);
            $stmt->execute([$username]);
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            
            if ($user) {
                echo "<p style='color: red;'>Ce nom d'utilisateur est déjà pris !</p>";
            } else {
                // Insertion de l'utilisateur dans la base de données
                $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
                $hashed_password = password_hash($password, PASSWORD_DEFAULT); // Utilisation du hash pour stocker le mot de passe
                $sql = "INSERT INTO users (Username, Password) VALUES (?, ?)";
                $stmt = $dbh->prepare($sql);
                $stmt->execute([$username, $hashed_password]);
                echo "<p style='color: green;'>Inscription réussie !</p>";
                
            }
        }
    }
    ?>

    <form method="POST" action="">
        <label for="username">Nom d'utilisateur :</label>
        <input type="text" name="username" id="username" required>

        <label for="password">Mot de passe :</label>
        <input type="password" name="password" id="password" required>

        <label for="confirm_password">Confirmer le mot de passe :</label>
        <input type="password" name="confirm_password" id="confirm_password" required>

        <button type="submit" value="valid">S'inscrire</button>
    </form>
</div>

</body>
</html>
