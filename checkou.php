<?php 
include "connect.php"; 

// Initialize variables
$name = isset($_POST['name']) ? $_POST['name'] : ''; 
$email = isset($_POST['email']) ? $_POST['email'] : ''; 
$address = isset($_POST['address']) ? $_POST['address'] : ''; 
$country = isset($_POST['country']) ? $_POST['country'] : ''; 
$checkout = false;

// Check if required fields are filled
if ($name != "" && $email != "" && $address != "" && $country != "") { 
    $checkout = true; 
} else { 
    echo "Não pode deixar campos vazios "; 
    echo "<a href='checkout.php'>Voltar atras</a><br>"; 
}

if ($checkout) { 
    echo "Nome: " . htmlspecialchars($name) . "<br>"; 
    echo "Email: " . htmlspecialchars($email) . "<br>"; 
    echo "Endereço: " . htmlspecialchars($address) . "<br>"; 
    echo "País: " . htmlspecialchars($country) . "<br>"; 

    // Prepare the SQL statement
    $sql = "INSERT INTO tb_user(name, email, address, country) VALUES ('$name', '$email', '$address', '$country');"; 
    mysqli_query($link, $sql); 
    echo "<a href='loja.php'>Ir para a loja</a><br>"; 
    echo "<a href='index'>voltar para o inicio</a>"; 
} 
?>