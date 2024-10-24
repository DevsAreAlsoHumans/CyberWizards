<!DOCTYPE html>
<html>
    <head>
        <title>CyberWizard</title>
        <link rel="stylesheet" type="text/css" href="style.css" />
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    </head>
    <body>
        <div id = "champsAccueil">
            <div id = "grosTitre">
                <h2>Bienvenue sur Cyber Wizard</h2>
            </div>
            <?php
                if( isset($_COOKIE["user_email"]))
                echo "Vous êtes connecté ";
                else 
                echo "<div id = 'duoBouton'>
                <p>
                   <div id = 'button-56'><button><a href = './connexion.php'>Connexion</a></button></div> <div id = 'button-56'><button><a href = './inscription.php'>Inscription</a></button></div>
                </p>
                </div>"
            ?>
        </div>
    </body>
</html>