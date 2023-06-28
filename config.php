<?php
// Conexão com o banco de dados
$servername = "localhost";
$username = "root";
$password = "skol123";
$dbname = "paacolitos";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}
