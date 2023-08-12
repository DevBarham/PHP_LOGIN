<?php
session_start();

$host = 'your_host';
$dbname = 'your_database';
$user = 'your_user';
$password = 'your_password';

try {
    $pdo = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    $username = $_POST['username'];
    $password = $_POST['password'];
    
    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = :username AND password = :password");
    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':password', $password);
    $stmt->execute();
    
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if ($user) {
        $_SESSION['user_id'] = $user['id'];
        header('Location: profile.php');
    } else {
        echo "Invalid credentials. <a href='index.php'>Try again</a>";
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
