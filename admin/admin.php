<?php
session_start();
if (!isset($_SESSION['authenticated'])) {
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['username'] == 'admin' && $_POST['password'] == 'adminpass') {
        $_SESSION['authenticated'] = true;
    } else {
        // Login Form
        echo '<form method="POST"><label>Username: <input type="text" name="username"></label><br><label>Password: <input type="password" name="password"></label><br><input type="submit" value="Login"></form>';
        exit;
    }
}

try {
    $dsn = 'mysql:host=db;dbname=registration_db';
    $pdo = new PDO($dsn, 'root', 'example');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt = $pdo->query("SELECT * FROM registrations");
    $registrations = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo '<h2>Admin Dashboard</h2>';
    echo '<table border="1"><tr><th>ID</th><th>First Name</th><th>Last Name</th><th>Email</th><th>DOB</th><th>Gender</th><th>Phone</th><th>Actions</th></tr>';
    foreach ($registrations as $registration) {
        echo '<tr><td>' . $registration['id'] . '</td><td>' . $registration['first_name'] . '</td><td>' . $registration['last_name'] . '</td><td>' . $registration['email'] . '</td><td>' . $registration['dob'] . '</td><td>' . $registration['gender'] . '</td><td>' . $registration['phone'] . '</td><td>Edit | Delete</td></tr>';
    }
    echo '</table>';
} catch (PDOException $e) {
    echo 'Database error: ' . $e->getMessage();
}
?>