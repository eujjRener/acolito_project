<?php
require_once 'config.php';

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome_aco = $_POST["nome_aco"];
    $data_nasc = $_POST["data_nasc"];
    $cpf = $_POST["cpf"];
    $nome_mae = $_POST["nome_mae"];
    $tel_celular = $_POST["tel_celular"];
    $endereco = $_POST["endereco"];
    $bairro = $_POST["bairro"];
    $igreja_serve = $_POST["igreja_serve"];
    $crisma = $_POST["crisma"];
    $tel_mae = $_POST["tel_mae"];
    $disponibilidade_servico = isset($_POST["disponibilidade"]) ? implode(", ", $_POST["disponibilidade"]) : "";


    if (isset($_POST["update"])) {
        $id = $_POST["id"];

        $update_sql = "UPDATE acolitos SET nome_aco='$nome_aco', data_nasc='$data_nasc', cpf='$cpf', nome_mae='$nome_mae', tel_celular='$tel_celular', endereco='$endereco', bairro='$bairro', igreja_serve='$igreja_serve', crisma='$crisma', tel_mae='$tel_mae', disponibilidade_servico='$disponibilidade_servico' WHERE id=$id";

        if ($conn->query($update_sql) === TRUE) {
            echo "<script>alert('Informações do acólito atualizadas com sucesso!');</script>";
        } else {
            echo "<script>alert('Erro ao atualizar as informações do acólito: " . $conn->error . "');</script>";
        }
    } else {
        $insert_sql = "INSERT INTO acolitos (nome_aco, data_nasc, cpf, nome_mae, tel_celular, endereco, bairro, igreja_serve, crisma, tel_mae, disponibilidade_servico) VALUES ('$nome_aco', '$data_nasc', '$cpf', '$nome_mae', '$tel_celular', '$endereco', '$bairro', '$igreja_serve', '$crisma', '$tel_mae', '$disponibilidade_servico')";

        if ($conn->query($insert_sql) === TRUE) {
            echo "<script>alert('Acólito cadastrado com sucesso!');</script>";
        } else {
            echo "<script>alert('Erro ao cadastrar o acólito: " . $conn->error . "');</script>";
        }
    }
}

// Deletar acólito
if (isset($_GET["delete"])) {
    $id = $_GET["delete"];

    $delete_sql = "DELETE FROM acolitos WHERE id=$id";

    if ($conn->query($delete_sql) === TRUE) {
        echo "<script>alert('Acólito deletado com sucesso!');</script>";
    } else {
        echo "<script>alert('Erro ao deletar o acólito: " . $conn->error . "');</script>";
    }
}

// Consulta dos acólitos cadastrados
$sql = "SELECT * FROM acolitos";

// Verifica se o filtro de igreja foi enviado
if (isset($_GET["filtro_igreja"]) && !empty($_GET["filtro_igreja"])) {
    $filtro_igreja = $_GET["filtro_igreja"];
    $sql .= " WHERE igreja_serve = '$filtro_igreja'";
}

// Verifica se o filtro de nome foi enviado
if (isset($_GET["filtro_nome"]) && !empty($_GET["filtro_nome"])) {
    $filtro_nome = $_GET["filtro_nome"];
    if (strpos($sql, 'WHERE') === false) {
        $sql .= " WHERE nome_aco LIKE '%$filtro_nome%'";
    } else {
        $sql .= " AND nome_aco LIKE '%$filtro_nome%'";
    }
}

$result = $conn->query($sql);

echo "<html>";
echo "<head>";
echo "<title>Lista de Acólitos</title>";
echo "<link rel='stylesheet' type='text/css' href='style.css'>";
echo "</head>";
echo "<body>";
echo "<div class='container'>";
echo "<h1>Lista de Acólitos</h1>";

// Formulário de filtro de igreja
// Formulário de filtro de igreja
echo "<form method='GET' action='index.php'>";
echo "<label for='filtro_igreja'>Selecione a igreja:</label>";
echo "<select id='filtro_igreja' name='filtro_igreja'>";
echo "<option value=''>Todas as igrejas</option>";
echo "<option value='Matriz'>Matriz</option>";
echo "<option value='Nossa Senhora Aparecida'>Nossa Senhora Aparecida</option>";
echo "<option value='Bom Jesus'>Bom Jesus</option>";
echo "<option value='São Pedro'>São Pedro</option>";
echo "</select>";
echo "<br> <br>";
echo "<label for='filtro_nome'>Nome do acólito:</label>";
echo "<input type='text' id='filtro_nome' name='filtro_nome'>";
echo "<input type='submit' value='Filtrar'>";
echo "</form>";
echo "<a href='cadastrar_acolito.php' class='add-button'>Adicionar novo acólito</a>";

if ($result->num_rows > 0) {
    echo "<table>";
    echo "<tr><th>Nome</th><th>Telefone</th><th>Nome da Mãe</th><th>Crisma</th><th>Igreja de Preferência</th><th>Ações</th></tr>";

    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["nome_aco"] . "</td>";
        echo "<td>" . $row["tel_celular"] . "</td>";
        echo "<td>" . $row["nome_mae"] . "</td>";
        echo "<td>" . $row["crisma"] . "</td>";
        echo "<td>" . $row["igreja_serve"] . "</td>";
        echo "<td class='actions'><a href='index.php?delete=" . $row["id"] . "' class='delete'>Deletar</a> <a href='edit.php?id=" . $row["id"] . "' class='edit'>Alterar</a> <form action='gerar_pdf.php' method='post'><input type='hidden' name='id' value='" . $row["id"] . "'><input type='submit' value='Gerar PDF' name='gerar_pdf' class='pdf'></form></td>";

        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "Nenhum acólito cadastrado.";
}

echo "</div>"; // Fechamento da div container
echo "</body>";
echo "</html>";

$conn->close();
?>