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

    // Handle form submission for adding or updating products
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if (isset($_POST['add_product'])) {
            // Add product
            $stmt = $pdo->prepare("INSERT INTO tb_checkout (pessoa, mail, Address, Country) VALUES (?, ?, ?, ?)");
            $stmt->execute([$_POST['pessoa'], $_POST['mail'], $_POST['Address'], $_POST['Country']]);
        }
    }
 } catch (PDOException $e) {
   echo "Database connection failed: " . $e->getMessage();
   exit;
        }
        ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Page - Manage Products</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/admin.css">
</head>
<body>
<div id="header">    
        <ul>
        <li><a href="index.php">Home</a></li>
             <li><a href="#chat">Chat</a></li>
             <li><a href="loja.php">Loja</a></li>
             <li><a href="contacts.php">Contact</a></li>
             <li><a href="admin.php">admin</a></li> 
             <li><a href="https://www.cuf.pt/saude-a-z/sindrome-de-asperger">About</a></li>                                                     
        </ul>		
    </div>
<div id="wrapper">
    <h1>Manage Products</h1>

    <form method="POST" action="" enctype="multipart/form-data">
        <h2>Add / Update Product</h2>
        <label for="pessoa">Name:</label>
        <input type="text" name="pessoa" id="pessoa" required>
        <label for="mail">email:</label>
        <input type="text" name="mail" id="mail" required>
        <label for="Address">Address:</label>
        <input type="text" name="Address" id="Address" required></input>
        <label for="Country">Country:</label>
        <input type="text" name="Country" id="Country" required></input>
        <button type="submit" name="add_product">Add Product</button>
    </form>
</div>

<footer class="credit">Author: A Place call Me - Distributed By: A Place call Me</footer>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script src="javascript/loja.js"></script>

</body>
</html>