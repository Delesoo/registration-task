<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $firstName = filter_input(INPUT_POST, 'firstName', FILTER_SANITIZE_STRING);
    $lastName = filter_input(INPUT_POST, 'lastName', FILTER_SANITIZE_STRING);
    $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
    $dob = $_POST['dob'];
    $gender = $_POST['gender'];
    $phone = filter_input(INPUT_POST, 'phone', FILTER_SANITIZE_STRING);

    if ($firstName && $lastName && $email && $dob && $gender && $phone) {
        try {
            $dsn = 'mysql:host=db;dbname=registration_db';
            $pdo = new PDO($dsn, 'root', 'example');
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $sql = "INSERT INTO registrations (first_name, last_name, email, dob, gender, phone) VALUES (?, ?, ?, ?, ?, ?)";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$firstName, $lastName, $email, $dob, $gender, $phone]);

            echo 'Registration successful!';
        } catch (PDOException $e) {
            echo 'Database error: ' . $e->getMessage();
        }
    } else {
        echo 'Invalid input!';
    }
}
?>