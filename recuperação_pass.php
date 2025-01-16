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
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);

    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        // Verificar se o email existe no banco de dados
        // Substitua pela sua lógica de conexão ao banco de dados
        $conn = new mysqli("localhost", "username", "password", "database");

        if ($conn->connect_error) {
            die("Conexão falhou: " . $conn->connect_error);
        }

        $stmt = $conn->prepare("SELECT id FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            // Gerar um token único
            $token = bin2hex(random_bytes(32));

            // Salvar o token no banco de dados
            $stmt = $conn->prepare("UPDATE users SET reset_token = ?, reset_expiry = DATE_ADD(NOW(), INTERVAL 1 HOUR) WHERE email = ?");
            $stmt->bind_param("ss", $token, $email);
            $stmt->execute();

            // Enviar email com o link de recuperação
            $resetLink = "https://APlaceCalledMe.com/reset-password.php?token=" . $token;
            $subject = "Recuperação de Palavra-Passe";
            $message = "Clique no link a seguir para redefinir sua palavra-passe: " . $resetLink;
            $headers = "From: no-reply@APlaceCalledMe.com";

            if (mail($email, $subject, $message, $headers)) {
                echo "Um link de recuperação foi enviado para o seu e-mail.";
            } else {
                echo "Erro ao enviar o e-mail.";
            }
        } else {
            echo "E-mail não encontrado.";
        }

        $stmt->close();
        $conn->close();
    } else {
        echo "E-mail inválido.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recuperação de Palavra-Passe</title>
    <link rel="stylesheet" href="css/recuperação_pass.css">
</head>
<body>
    <div class="recovery-container">
        <h1>Recuperação de Palavra-Passe</h1>
        <p>Insira o seu e-mail para receber um link de recuperação.</p>
        <form action="recover-password" method="POST">
            <input type="email" name="email" placeholder="Digite o seu e-mail" required>
            <button type="submit">Enviar Link de Recuperação</button>
        </form>
        <a href="loja.php" class="back-link">Voltar ao Login</a>
    </div>
</body>
</html>
