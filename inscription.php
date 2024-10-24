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
    $lastName = htmlspecialchars(trim($_POST['nom']));
    $firstName = htmlspecialchars(trim($_POST['prenom']));
    $email = htmlspecialchars(trim($_POST['email']));
    $birthDate = htmlspecialchars(trim($_POST['date_de_naissance']));
    $password = htmlspecialchars(trim($_POST['mot_de_passe']));  
    
    /// Validation 
    if (empty($lastName)) {
        echo "Le nom est obligatoire.";
    } elseif (empty($email)) {
        echo "L'email est obligatoire.";
    } elseif (strlen($password) < 6) {  
        echo "Le mot de passe doit contenir au moins 6 caractères.";
    } elseif (!DateTime::createFromFormat('Y-m-d', $birthDate)) {
        echo "La date de naissance doit être au format YYYY-MM-DD.";
    } else {
        /// Hachage du mot de passe 
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        /// Préparation de la requête d'insertion
        $sql = "INSERT INTO users (nom, prenom, date_de_naissance, email, mot_de_passe) 
                VALUES (:nom, :prenom, :date_de_naissance, :email, :mot_de_passe)";
        $stmt = $cnx->prepare($sql);

        /// Exécution de la requête avec les données de l'utilisateur
        $stmt->execute([
            ':nom' => $lastName,
            ':prenom' => $firstName,
            ':date_de_naissance' => $birthDate,
            ':email' => $email,
            ':mot_de_passe' => $hashedPassword
        ]);
    }
}


?>
