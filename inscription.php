<?php
$serveur = "localhost";
$user = "root";
$nombd = "hackaton";
$mdp = "";

try {
    /// Connexion à la base de données avec PDO
    $cnx = new PDO("mysql:host=$serveur;dbname=$nombd;charset=utf8", $user, $mdp, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ]);
} catch (PDOException $e) {
    /// Afficher un message d'erreur en cas d'échec de la connexion à la base de données
    echo "Erreur de connexion : " . $e->getMessage();
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    /// Récupérer et filtrer les données
    $lastName = htmlspecialchars(trim($_POST['lastname'])); 
    $firstName = htmlspecialchars(trim($_POST['firstname'])); 
    $email = htmlspecialchars(trim($_POST['email']));
    $birthDate = htmlspecialchars(trim($_POST['birthDate'])); 
    $password = htmlspecialchars(trim($_POST['password'])); 
    
    /// Validation 
    if (empty($lastName)) {
        echo "Le nom est obligatoire.";
    } 
    /// Vérifiez si l'e-mail est déjà utilisé
    elseif ($cnx->query("SELECT * FROM users WHERE email = '$email'")->rowCount() > 0) {
        echo "Cet e-mail est déjà utilisé.";
    } 
    elseif (strlen($password) < 6) {  
        echo "Le mot de passe doit contenir au moins 6 caractères.";
    } elseif (!DateTime::createFromFormat('Y-m-d', $birthDate)) {
        echo "La date de naissance doit être au format YYYY-MM-DD.";
    } else {
        /// Hachage du mot de passe 
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        /// Préparation de la requête d'insertion
        $sql = "INSERT INTO users (last_name, first_name, date_of_birth, email, password) 
                VALUES (:last_name, :first_name, :date_of_birth, :email, :password)";
        $stmt = $cnx->prepare($sql);

        /// Exécution de la requête avec les données de l'utilisateur
        $stmt->execute([
            ':last_name' => $lastName,
            ':first_name' => $firstName,
            ':date_of_birth' => $birthDate,
            ':email' => $email,
            ':password' => $hashedPassword
        ]);
    }
}


?>
<DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="styleInscription.css" rel="stylesheet">
    <title>Formulaire d'inscription</title>
</head>
<body>
    <div class="inscription">
        <h1>Inscription</h1>
        
        <?php if (!empty($message)) : ?>
            <p><?php echo $message; ?></p>
        <?php endif; ?>
        
        <form action="" method="post">
            <div>
                <label for="lastname">Nom</label>
                <input type="text" id="lastname" name="lastname" placeholder="Nom" required>
            </div>
            <div>
                <label for="firstname">Prénom</label>
                <input type="text" id="firstname" name="firstname" placeholder="Prénom" required>
            </div>
            <div>
                <label for="birthDate">Date de naissance</label>
                <input type="date" id="birthDate" name="birthDate" required>
            </div>
            <div>
                <label for="email">E-mail</label>
                <input type="email" id="email" name="email" placeholder="monadresse@mail.com" required>
            </div>
            <div>
                <label for="password">Mot de passe</label>
                <input type="password" id="password" name="password" placeholder="Mot de passe" required>
            </div>
            <div>
                <button type="submit">S'inscrire</button>
            </div>
        </form>
    </div>
</body>
</html>
