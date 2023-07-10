<?php
require_once 'config.php';

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}

session_start(); // Inicia a sessão

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Verifica as credenciais do administrador no banco de dados
    $select_sql = "SELECT * FROM admin WHERE username = '$username' AND password = '$password'";
    $result = $conn->query($select_sql);

    if ($result->num_rows == 1) {
        // Credenciais corretas, define a sessão de admin
        $_SESSION['admin'] = true;
        // Redireciona para a página inicial
        header('Location: index.php');
        exit();
    } else {
        // Credenciais incorretas, exibe mensagem de erro
        echo "<script>alert('Credenciais inválidas. Tente novamente.');</script>";
    }
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Login de Administrador</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
        }
        .container {
            width: 300px;
            margin: 0 auto;
            margin-top: 100px;
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        .container h1 {
            text-align: center;
            margin-bottom: 20px;
        }
        .container label {
            display: block;
            margin-bottom: 10px;
        }
        .container input[type="text"],
        .container input[type="password"] {
            width: 100%;
            padding: 5px;
            border: 1px solid #ccc;
            border-radius: 3px;
        }
        .container input[type="submit"] {
            width: 100%;
            margin-top: 10px;
            padding: 8px;
            background-color: #4caf50;
            border: none;
            color: #fff;
            font-weight: bold;
            cursor: pointer;
            border-radius: 3px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Login de Administrador</h1>
        <form method="post" action="">
            <label for="username">Usuário:</label>
            <input type="text" id="username" name="username" required><br>
            <label for="password">Senha:</label>
            <input type="password" id="password" name="password" required><br>
            <input type="submit" value="Login">
        </form>
    </div>
</body>
</html>
