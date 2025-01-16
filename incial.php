<?php
// Database configuration
$host = 'localhost'; // Database host
$dbname = 'db_site'; // Database name
$username = 'root'; // Database username
$password = ''; // Database password

try {
    // Create a new PDO instance
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Prepare and execute the SQL statement
    $stmt = $pdo->query("SELECT * FROM products"); // Assuming you have a 'products' table
    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Database connection failed: " . $e->getMessage();
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Short Movie: The Disease</title>
    <link rel="stylesheet" href="css/incial.css">
</head>
<body>
    <header>
        <h1>The Disease</h1>
        <p>A short film exploring the impact of disease on society.</p>
    </header>
    <main>
        <section id="trailer">
            <h2>Watch the Trailer</h2>
            <video controls>
                <source src="trailer.mp4" type="video/mp4">
                Your browser does not support the video tag.
            </video>
        </section>
        <section id="about">
            <h2>About the Film</h2>
            <p>This short film delves into the emotional and social ramifications of a disease outbreak, showcasing personal stories and the resilience of the human spirit.</p>
        </section>
        </main>
    <footer>
        <p>&copy; 2024 A Placed Called ME All rights reserved.</p>
    </footer>
    <script src="javascript/incial.js"></script>
</body>
</html>