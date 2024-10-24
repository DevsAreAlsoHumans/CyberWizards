<!DOCTYPE html>
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
        <form action="inscription.php" method="post">
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