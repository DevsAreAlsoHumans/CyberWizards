<?php
session_start();
if (isset($_POST['email']) && isset($_POST['password'])) {
    $db_name = "doranco_hackaton";
    $db_host = "localhost";
    $db_username = "root";
    $db_password = "root";
    $db = mysqli_connect($db_host, $db_username, $db_password, $db_name)
    or die('could not connect to database');

    $email = mysqli_real_escape_string($db, htmlspecialchars($_POST['email']));
    $password = mysqli_real_escape_string(
        $db,
        htmlspecialchars($_POST['password'])
    );

    if ($email !== "" || $password !== "") {
        $requete = "SELECT count(*) FROM users where email = '".$email."'and password = '".password_hash($password, PASSWORD_DEFAULT)."' ";
        $exec_requete = mysqli_query($db, $requete);
        $reponse = mysqli_fetch_array($exec_requete);
        $count = $reponse['count(*)'];
        setcookie('coo',password_hash("test", PASSWORD_DEFAULT));
        if ($count != 0) {
            setcookie("user_email", $email);

            header('Location: home.php');
        } else {
            header('Location: home.php?erreur=1');
        }
    } else {
        header('Location: home.php?erreur=2');
    }
} else {
    header('Location: home.php');
}
mysqli_close($db);
?>


