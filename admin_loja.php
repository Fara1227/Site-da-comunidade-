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
            // Handle image uploads
            $imagePath = 'uploads/' . basename($_FILES['image']['name']);
            move_uploaded_file($_FILES['image']['tmp_name'], $imagePath);
            
            $image2Path = 'uploads/' . basename($_FILES['image2']['name']);
            move_uploaded_file($_FILES['image2']['tmp_name'], $image2Path);
            
            $image3Path = 'uploads/' . basename($_FILES['image3']['name']);
            move_uploaded_file($_FILES['image3']['tmp_name'], $image3Path);

            // Add product
            $stmt = $pdo->prepare("INSERT INTO products (name, price, description, image, image2, image3) VALUES (?, ?, ?, ?, ?, ?)");
            $stmt->execute([$_POST['name'], $_POST['price'], $_POST['description'], $imagePath, $image2Path, $image3Path]);
        } elseif (isset($_POST['update_product'])) {
            // Handle image uploads
            $imagePath = 'uploads/' . basename($_FILES['image']['name']);
            move_uploaded_file($_FILES['image']['tmp_name'], $imagePath);
            
            $image2Path = 'uploads/' . basename($_FILES['image2']['name']);
            move_uploaded_file($_FILES['image2']['tmp_name'], $image2Path);
            
            $image3Path = 'uploads/' . basename($_FILES['image3']['name']);
            move_uploaded_file($_FILES['image3']['tmp_name'], $image3Path);

            // Update product
            $stmt = $pdo->prepare("UPDATE products SET name = ?, price = ?, description = ?, image = ?, image2 = ?, image3 = ? WHERE id = ?");
            $stmt->execute([$_POST['name'], $_POST['price'], $_POST['description'], $imagePath, $image2Path, $image3Path, $_POST['id']]);
        }
    }

    // Handle product deletion
    if (isset($_GET['delete'])) {
        $stmt = $pdo->prepare("DELETE FROM products WHERE id = ?");
        $stmt->execute([$_GET['delete']]);
    }

    // Fetch all products
    $stmt = $pdo->query("SELECT * FROM products");
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
    <title>Admin Page - Manage Products</title>
</head>
<body>
<div class="menu">
    <ul>
        <li><a href="admin/admin.php">Usuários</a></li>
        <li><a href="admin/comentarios.php">Comentários</a></li>
        <li><a href="admin_loja.php">Produtos</a></li>
        <li><a href="index.php">Voltar</a></li>
        <li><a href="logout.php">Sair</a></li>
    </ul>
</div>
<div id="wrapper">
    <h1>Manage Products</h1>

    <form method="POST" action="" enctype="multipart/form-data">
    <h2>Add / Update Product</h2>
    <input type="hidden" name="id" id="product_id" value="">

    <label for="name">Product Name:</label>
    <input type="text" name="name" id="name" required>

    <label for="price">Price:</label>
    <input type="number" name="price" id="price" step="0.01" required>

    <label for="description">Description:</label>
    <textarea name="description" id="description" required></textarea>

    <label for="image">Image:</label>
    <input type="file" name="image" id="image" accept="image/*" required>

    <label for="image2">Second Image:</label>
    <input type="file" name="image2" id="image2" accept="image/*" required>

    <label for="image3">Third Image:</label>
    <input type="file" name="image3" id="image3" accept="image/*" required>

    <button type="submit" name="add_product">Add Product</button>
    <button type="submit" name="update_product">Update Product</button>
</form>

    <h2>Current Products</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Price</th>
                <th>Description</th>
                <th>Image</th>
                <th>Second Image</th>
                <th>Third Image</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($products as $product): ?>
                <tr>
                    <td><?php echo htmlspecialchars($product['id']); ?></td>
                    <td><?php echo htmlspecialchars($product['name']); ?></td>
                    <td>$<?php echo number_format($product['price'], 2); ?></td>
                    <td><?php echo htmlspecialchars($product['description']); ?></td>
                    <td><img src="<?php echo htmlspecialchars($product['image']); ?>" alt="<?php echo htmlspecialchars($product['name']); ?>" width="50"></td>
                    <td><img src="<?php echo htmlspecialchars($product['image2']); ?>" alt="<?php echo htmlspecialchars($product['name']); ?>" width="50"></td>
                    <td><img src="<?php echo htmlspecialchars($product['image3']); ?>" alt="<?php echo htmlspecialchars($product['name']); ?>" width="50"></td>
                    <td>
                        <a href="?edit=<?php echo $product['id']; ?>">Edit</a> 
                        |
                        <a href="?delete=<?php echo $product['id']; ?>" onclick="return confirm('Are you sure you want to delete this product?');">Delete</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <?php
    // Populate the form with product data for editing
    if (isset($_GET['edit'])) {
        $stmt = $pdo->prepare("SELECT * FROM products WHERE id = ?");
        $stmt->execute([$_GET['edit']]);
        $product = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($product) {
            echo "<script>
                document.getElementById('product_id').value = " . json_encode($product['id']) . ";
                document.getElementById('name').value = " . json_encode($product['name']) . ";
                document.getElementById('price').value = " . json_encode($product['price']) . ";
                document.getElementById('description').value = " . json_encode($product['description']) . ";
            </script>";
        }
    }
    ?>
</div>

<footer class="credit">Todos o dinheiro ganho sera doado</footer>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script src="javascript/loja.js"></script>

<style>
/* Estilo básico para o menu */
/* Reset básico para garantir que todos os navegadores renderizem de forma consistente */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

/* Corpo da página */
body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f4;
    color: #333;
    margin: 20px;
}

/* Estilo para o título principal */
h1 {
    font-size: 2.5em;
    margin-bottom: 20px;
    color: #2c3e50;
}

/* Menu de navegação */
.menu {
    background-color: #34495e;
    padding: 10px;
    margin-bottom: 20px;
    border-radius: 5px;
}

.menu ul {
    list-style-type: none;
    display: flex;
    justify-content: space-around;
}

.menu li {
    display: inline-block;
}

.menu li a {
    color: white;
    padding: 12px 20px;
    text-decoration: none;
    font-size: 1.1em;
    border-radius: 5px;
    transition: background-color 0.3s ease;
}

.menu li a:hover {
    background-color: #1abc9c;
}

/* Estilo da tabela */
table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
}

table, th, td {
    border: 1px solid #ddd;
}

th, td {
    padding: 12px;
    text-align: left;
}

th {
    background-color: #34495e;
    color: white;
    font-size: 1.1em;
}

td {
    background-color: #fff;
    font-size: 1em;
    color: #333;
}

td img {
    border-radius: 50%;
}

/* Estilo para o botão "Editar" e "Excluir" */
a {
    text-decoration: none;
    color: #2980b9;
    font-weight: bold;
}

a:hover {
    color: #e74c3c;
}

/* Estilo para a linha vazia na tabela */
table tbody tr td {
    text-align: center;
}

/* Estilo de alerta de confirmação */
.confirmation {
    background-color: #f39c12;
    padding: 5px;
    color: white;
    font-weight: bold;
    text-align: center;
}

 /* Estilo para o formulário */
 form {
        background-color: #fff;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        margin-top: 20px;
    }

    h2 {
        font-size: 1.8em;
        margin-bottom: 20px;
        color: #34495e;
    }

    label {
        font-size: 1.1em;
        color: #34495e;
        margin-bottom: 8px;
        display: block;
    }

    input[type="text"], input[type="number"], textarea, input[type="file"] {
        width: 100%;
        padding: 10px;
        margin-bottom: 15px;
        border: 1px solid #ccc;
        border-radius: 5px;
        font-size: 1em;
    }

    input[type="file"] {
        padding: 5px;
    }

    textarea {
        height: 150px;
        resize: vertical;
    }

    button {
        padding: 12px 20px;
        background-color: #1abc9c;
        color: white;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        font-size: 1.1em;
        margin-right: 10px;
        transition: background-color 0.3s ease;
    }

    button:hover {
        background-color: #16a085;
    }

    button[type="submit"]:nth-of-type(2) {
        background-color: #3498db;
    }

    button[type="submit"]:nth-of-type(2):hover {
        background-color: #2980b9;
    }

</style>
</body>
</html>