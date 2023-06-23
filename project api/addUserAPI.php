<?php
require_once('connection.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    try {
        $query = "INSERT INTO users (username, password) VALUES (:username, :password)";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':password', $password);
        $stmt->execute();

        // Redirect to the desired page
        header('Location: testApi.html');
        exit();
    } catch (PDOException $e) {
        // Redirect to the error page
        header('Location: error.php');
        exit();
    }
}
?>
