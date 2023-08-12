<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: index.php');
    exit();
}

$host = 'your_host';
$dbname = 'your_database';
$user = 'your_user';
$password = 'your_password';

try {
    $pdo = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $name = $_POST['name'];
        $mobile = $_POST['mobile'];
        $address = $_POST['address'];
        $gender = $_POST['gender'];
        $occupation = $_POST['occupation'];
        
        $stmt = $pdo->prepare("INSERT INTO user_info (name, mobile, address, gender, occupation) VALUES (:name, :mobile, :address, :gender, :occupation)");
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':mobile', $mobile);
        $stmt->bindParam(':address', $address);
        $stmt->bindParam(':gender', $gender);
        $stmt->bindParam(':occupation', $occupation);
        $stmt->execute();
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Profile</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
    <h2>Welcome, User!</h2>
    <form method="post">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required><br><br>
        <label for="mobile">Mobile:</label>
        <input type="text" id="mobile" name="mobile" required><br><br>
        <label for="address">Address:</label>
        <input type="text" id="address" name="address" required><br><br>
        <label for="gender">Gender:</label>
        <input type="radio" id="male" name="gender" value="male" required>
        <label for="male">Male</label>
        <input type="radio" id="female" name="gender" value="female" required>
        <label for="female">Female</label><br><br>
        <label for="occupation">Occupation:</label>
        <input type="text" id="occupation" name="occupation" required><br><br>
        <input type="submit" value="Save">
    </form>
</body>
</html>


<!-- <!DOCTYPE html>
<html>
<head>
    <title>User Info Form</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
    <div class="info-container">
        <h2>User Information</h2>
        <form action="save_info.php" method="post">
            <input type="text" name="name" placeholder="Name" required><br><br>
            <input type="text" name="mobile" placeholder="Mobile" required><br><br>
            <input type="text" name="address" placeholder="Address" required><br><br>
            <input type="radio" name="gender" value="male" required> Male
            <input type="radio" name="gender" value="female" required> Female<br><br>
            <input type="text" name="occupation" placeholder="Occupation" required><br><br>
            <button type="submit">Save</button>
        </form>
    </div>
</body>
</html> -->
