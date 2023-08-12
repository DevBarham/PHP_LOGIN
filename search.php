<?php
$host = 'your_host';
$dbname = 'your_database';
$user = 'your_user';
$password = 'your_password';

try {
    $pdo = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt = $pdo->prepare("SELECT * FROM user_info");
    $stmt->execute();
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Search Results</title>
</head>
<body>
    <h2>Search Results</h2>
    <table border="1">
        <tr>
            <th>Name</th>
            <th>Mobile</th>
            <th>Address</th>
            <th>Gender</th>
            <th>Occupation</th>
        </tr>
        <?php foreach ($results as $row): ?>
            <tr>
                <td><?php echo $row['name']; ?></td>
                <td><?php echo $row['mobile']; ?></td>
                <td><?php echo $row['address']; ?></td>
                <td><?php echo $row['gender']; ?></td>
                <td><?php echo $row['occupation']; ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>
