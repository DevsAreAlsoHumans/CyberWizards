<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <!-- importer le fichier de style -->
  <link rel="stylesheet" href="styleConnexion.css" media="screen" type="text/css" />
</head>

<body>
  <div id="container">
  <!-- zone de connexion -->
  
    <form action="verification.php" method="POST">
      <h1>Connexion</h1>
        
      <label><b>E-Mail</b></label>
      <input type="text" placeholder="Entre ton E-Mail" name="email" required>
       
      <label><b>Mot de passe</b></label>
      <input type="password" placeholder="Entre ton mot de passe" name="password" required>
       
      <input type="submit" id='submit' value='Connecte-Toi' >
    </form>
  </div>
</body>

</html>