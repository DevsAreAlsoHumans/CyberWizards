<!DOCTYPE html>
<html>
    <head>
        <title>CyberWizard</title>
        <link rel="stylesheet" type="text/css" href="style.css" />
    </head>
    <body>
        <div id = "champsAccueil">
            <div id = "grosTitre">
                <h2>Bienvenue sur Cyber Wizard</h2>
            </div>
            <?php
                if( isset($_COOKIE["coo"]))
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