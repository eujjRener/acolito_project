<?php
require_once 'config.php';

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}
// Verificar se o ID do acólito foi fornecido
if (isset($_GET["id"])) {
    $id = $_GET["id"];

    // Consultar o acólito pelo ID
    $select_sql = "SELECT * FROM acolitos WHERE id=$id";
    $result = $conn->query($select_sql);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();

        // Exibir o formulário de edição
        echo "<html>";
        echo "<head>";
        echo "<title>Editar Acólito</title>";
        echo "<link rel='stylesheet' type='text/css' href='style.css'>";
        echo "</head>";
        echo "<body>";
        echo "<h1>Editar Acólito</h1>";
        echo "<form action='index.php?id=$id' method='POST'>"; // Adicionado o parâmetro ?id=$id na URL do formulário
        echo "<input type='hidden' name='id' value='" . $row["id"] . "'>";

        echo "<label for='nome_aco'>Nome:</label>";
        echo "<input type='text' id='nome_aco' name='nome_aco' value='" . $row["nome_aco"] . "' required>";
        echo "<label for='data_nasc'>Data de Nascimento:</label>";
        echo "<input type='date' id='data_nasc' name='data_nasc' value='" . $row["data_nasc"] . "' required>";
        echo "<label for='cpf'>CPF:</label>";
        echo "<input type='text' id='cpf' name='cpf' value='" . $row["cpf"] . "' required>";
        echo "<label for='nome_mae'>Nome da Mãe:</label>";
        echo "<input type='text' id='nome_mae' name='nome_mae' value='" . $row["nome_mae"] . "' required>";
        echo "<label for='tel_celular'>Telefone/Celular:</label>";
        echo "<input type='text' id='tel_celular' name='tel_celular' value='" . $row["tel_celular"] . "' required>";
        echo "<label for='endereco'>Endereço:</label>";
        echo "<input type='text' id='endereco' name='endereco' value='" . $row["endereco"] . "' required>";
        echo "<label for='bairro'>Bairro:</label>";
        echo "<input type='text' id='bairro' name='bairro' value='" . $row["bairro"] . "' required>";
        
       
        echo "<label for='igreja_serve'>Igreja que Serve:</label><br>";

        echo "<label>";
        echo "<input type='radio' id='matriz' name='igreja_serve' value='Matriz'" . ($row["igreja_serve"] === 'Matriz' ? ' checked' : '') . ">";
        echo "Matriz";
        echo "</label><br>";
        
        echo "<label>";
        echo "<input type='radio' id='nossa_senhora_aparecida' name='igreja_serve' value='Nossa Senhora Aparecida'" . ($row["igreja_serve"] === 'Nossa Senhora Aparecida' ? ' checked' : '') . ">";
        echo "Nossa Senhora Aparecida";
        echo "</label><br>";
        
        echo "<label>";
        echo "<input type='radio' id='bom_jesus' name='igreja_serve' value='Bom Jesus'" . ($row["igreja_serve"] === 'Bom Jesus' ? ' checked' : '') . ">";
        echo "Bom Jesus";
        echo "</label><br>";
        
        echo "<label>";
        echo "<input type='radio' id='sao_pedro' name='igreja_serve' value='São Pedro'" . ($row["igreja_serve"] === 'São Pedro' ? ' checked' : '') . ">";
        echo "São Pedro";
        echo "</label><br>";



        echo "<input type='submit' name='update' value='Atualizar'>";
        echo "</form>";
        echo "</body>";
        echo "</html>";
    } else {
        echo "Acólito não encontrado.";
    }
} else {
    echo "ID do acólito não fornecido.";
}

$conn->close();
