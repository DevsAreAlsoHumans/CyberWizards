<?php

function getDbConnection() {
    $host = 'localhost';
    $dbname = 'hackaton';
    $username = 'root';
    $password = '';

    try {
        $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;
    } catch (PDOException $e) {
        echo "Erreur de connexion : " . $e->getMessage();
        exit();
    }
}

function createUser($last_name, $first_name, $date_of_birth, $email, $hashedPassword) {
    $pdo = getDbConnection();

    $sql = "INSERT INTO users (first_name, last_name, date_of_birth, email, password) VALUES (:first_name, :last_name, :date_of_birth, :email, :password)";
    $stmt = $pdo->prepare($sql);

    if ($stmt->execute([
        ':last_name' => $last_name,
        ':first_name' => $first_name,
        ':date_of_birth' => $date_of_birth,
        ':email' => $email,
        ':password' => $hashedPassword
    ])) {
        return $pdo->lastInsertId();
    } else {
        return false;
    }
}

function createRole($roleName) {
    $pdo = getDbConnection();

    $sql = "INSERT INTO roles (role_name) VALUES (:role_name)";
    $stmt = $pdo->prepare($sql);

    if ($stmt->execute([
        ':role_name' => $roleName
    ])) {
        return $pdo->lastInsertId();
    } else {
        return false;
    }
}

function assignRoleToUser($userId, $roleId) {
    $pdo = getDbConnection();

    $sql = "INSERT INTO user_roles (id_user, id_role) VALUES (:id_user, :id_role)";
    $stmt = $pdo->prepare($sql);

    return $stmt->execute([
        ':id_user' => $userId,
        ':id_role' => $roleId
    ]);
}

function checkEmail($email)
{
    $pdo = getDbConnection();
    $sql = "SELECT * FROM users WHERE email = :email";
    $stmt = $pdo->prepare($sql);

    $stmt->bindParam(':email', $email, PDO::PARAM_STR);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        return true;
    } else {
        return false;
    }
}





