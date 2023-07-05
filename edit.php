<?php
require_once 'config.php';

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}

// Verificar se o ID do acólito foi fornecido
if (isset($_GET["id"])) { // Alterado de $_POST para $_GET
    $id = $_GET["id"]; // Alterado de $_POST para $_GET

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
        echo "<form action='index.php' method='POST'>"; // Ajuste na ação do formulário
        echo "<input type='hidden' name='id' value='" . $row["id"] . "'>";
       

        echo "<label for='nome_aco'>Nome:</label>";
        echo "<input type='text' id='nome_aco' name='nome_aco' value='" . $row["nome_aco"] . "' required><br>";

        echo "<label for='tel_celular'>Telefone/Celular:</label>";
        echo "<input type='text' id='tel_celular' name='tel_celular' value='" . $row["tel_celular"] . "' required placeholder='(XX) 99999-999'><br>";

        echo "<label for='data_nasc'>Data de Nascimento:</label>";
        echo "<input type='date' id='data_nasc' name='data_nasc' value='" . $row["data_nasc"] . "' required><br>";

        echo "<label for='cpf'>CPF:</label>";
        echo "<input type='text' id='cpf' name='cpf' value='" . $row["cpf"] . "' required><br>";

        echo "<label for='nome_mae'>Nome da Mãe:</label>";
        echo "<input type='text' id='nome_mae' name='nome_mae' value='" . $row["nome_mae"] . "' required><br>";

        echo "<label for='tel_mae'>Telefone da Mãe:</label>";
        echo "<input type='text' id='tel_mae' name='tel_mae' value='" . $row["tel_mae"] . "' required placeholder='(XX) 99999-9999'><br>";

        echo "<label for='endereco'>Endereço:</label>";
        echo "<input type='text' id='endereco' name='endereco' value='" . $row["endereco"] . "' required><br>";

        echo "<label for='bairro'>Bairro:</label>";
        echo "<input type='text' id='bairro' name='bairro' value='" . $row["bairro"] . "' required><br>";

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

        echo "<label for='crisma'>O acólito é crismado?</label><br>";
        echo "<label>";
        echo "<input type='radio' id='crismado_sim' name='crisma' value='Sim'" . ($row["crisma"] === 'Sim' ? ' checked' : '') . ">";
        echo "Sim";
        echo "</label><br>";
        echo "<label>";
        echo "<input type='radio' id='crismado_nao' name='crisma' value='Não'" . ($row["crisma"] === 'Não' ? ' checked' : '') . ">";
        echo "Não";
        echo "</label><br>";

     

        echo "<label for='disponibilidade_servico'>Disponibilidade em servir em quais períodos?</label><br>";
        $disponibilidade_servico = explode(", ", $row["disponibilidade_servico"]);
        echo "<label>";
        echo "<input type='checkbox' id='disponibilidade_manha' name='disponibilidade[]' value='Manhã'" . (in_array("Manhã", $disponibilidade_servico) ? ' checked' : '') . ">";
        echo "Manhã";
        echo "</label><br>";
        echo "<label>";
        echo "<input type='checkbox' id='disponibilidade_noite' name='disponibilidade[]' value='Noite'" . (in_array("Noite", $disponibilidade_servico) ? ' checked' : '') . ">";
        echo "Noite";
        echo "</label><br>";
        echo "<label>";
        echo "<input type='checkbox' id='disponibilidade_fds' name='disponibilidade[]' value='Final de semana'" . (in_array("Final de semana", $disponibilidade_servico) ? ' checked' : '') . ">";
        echo "Final de semana";
        echo "</label><br>";
        echo "<label>";
        echo "<input type='checkbox' id='disponibilidade_multipla' name='disponibilidade[]' value='Em Mais de Uma igreja'" . (in_array("Em Mais de Uma igreja", $disponibilidade_servico) ? ' checked' : '') . ">";
        echo "Em Mais de Uma igreja";
        echo "</label><br>";
        echo "<label>";
        echo "<input type='checkbox' id='disponibilidade_unica' name='disponibilidade[]' value='Somente em uma igreja'" . (in_array("Somente em uma igreja", $disponibilidade_servico) ? ' checked' : '') . ">";
        echo "Somente em uma igreja";
        echo "</label><br>";

        echo "<input type='submit' value='Atualizar' name='update'>"; // Adicionado o atributo name ao botão de submit
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
?>
