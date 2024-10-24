<?php
session_start();
if (isset($_POST['email']) && isset($_POST['password'])) {
    $db_name = "hackaton";
    $db_host = "localhost";
    $db_username = "root";
    $db_password = "";
    $db = mysqli_connect($db_host, $db_username, $db_password, $db_name)
    or die('could not connect to database');

    $email = mysqli_real_escape_string($db, htmlspecialchars($_POST['email']));
    $password = mysqli_real_escape_string(
        $db,
        htmlspecialchars($_POST['password'])
    );

    if ($email !== "" || $password !== "") {
        $requete = "SELECT password FROM users where email = '".$email."'";
        $exec_requete = mysqli_query($db, $requete);
        $response = mysqli_fetch_array($exec_requete);

        if (password_verify($password, $response[0])) {
            setcookie("user_email", $email);

            header('Location: index.php');
        } else {
            header('Location: index.php?erreur=1');
        }
    } else {
        header('Location: index.php?erreur=2');
    }
} else {
    header('Location: index.php');
}
mysqli_close($db);
?>
