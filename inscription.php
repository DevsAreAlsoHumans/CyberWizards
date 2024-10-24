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
    $nom = htmlspecialchars(trim($_POST['nom']));
    $prenom = htmlspecialchars(trim($_POST['prenom']));
    $email = htmlspecialchars(trim($_POST['email']));
    $date_de_naissance = htmlspecialchars(trim($_POST['date_de_naissance']));
    $mot_de_passe = htmlspecialchars(trim($_POST['mot_de_passe']));  
    
    /// Validation des donnéees
    if (empty($nom)) {
        echo "Le nom est obligatoire.";
    } elseif (empty($email)) {
        echo "L'email est obligatoire.";
    } elseif (strlen($mot_de_passe) < 6) {  
        echo "Le mot de passe doit contenir au moins 6 caractères.";
    } elseif (!DateTime::createFromFormat('Y-m-d', $date_de_naissance)) {
        echo "La date de naissance doit être au format YYYY-MM-DD.";
    } else {
        /// Hachage du mot de passe avant l'insertion dans la base de données
        $mot_de_passe_hache = password_hash($mot_de_passe, PASSWORD_DEFAULT);

        /// Préparation de la requête d'insertion
        $sql = "INSERT INTO users (nom, prenom, date_de_naissance, email, mot_de_passe) 
                VALUES (:nom, :prenom, :date_de_naissance, :email, :mot_de_passe)";
        $stmt = $cnx->prepare($sql);

        /// Exécution de la requête avec les données de l'utilisateur
        $stmt->execute([
            ':nom' => $nom,
            ':prenom' => $prenom,
            ':date_de_naissance' => $date_de_naissance,
            ':email' => $email,
            ':mot_de_passe' => $mot_de_passe_hache
        ]);

    }
}

?>
