<?php
require_once('connection.php');

try {
    // Function to validate the user credentials and retrieve the API key
    function validateUserCredentials($username, $password)
    {
        global $pdo;

        // Prepare and execute the query to check if the user exists
        $query = "SELECT * FROM users WHERE username = :username AND password = :password";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':password', $password);
        $stmt->execute();

        // Check if the query returned a row
        if ($stmt->rowCount() > 0) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            return $row['api_key']; // Return the API key
        }

        return false; // User credentials are invalid
    }

    // Get the request parameters
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Check if the user credentials are valid and retrieve the API key
    $userApiKey = validateUserCredentials($username, $password);

    // Prepare the response
    $response = array();
    if ($userApiKey) {
        $response['status'] = 'success';
        $response['message'] = 'Login successful';
        $response['api_key'] = $userApiKey;
    } else {
        $response['status'] = 'error';
        $response['message'] = 'Invalid username or password';
    }

    // Return the response as JSON
    header('Content-Type: application/json');
    echo json_encode($response);
} catch (PDOException $e) {
    // Handle database connection errors
    echo "Connection failed: " . $e->getMessage();
}
