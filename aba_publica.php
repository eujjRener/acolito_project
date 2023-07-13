<?php
require_once 'config.php';

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}

session_start();
$_SESSION['cadastro_aba_publica'] = true;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Processar os dados do formulário aqui
    $nome_aco = $_POST["nome_aco"];
    $tel_celular = $_POST["tel_celular"];
    $data_nasc = $_POST["data_nasc"];
    $cpf = $_POST["cpf"];
    $nome_mae = $_POST["nome_mae"];
    $tel_mae = $_POST["tel_mae"];
    $endereco = $_POST["endereco"];
    $bairro = $_POST["bairro"];
    $igreja_serve = $_POST["igreja_serve"];
    $crisma = $_POST["crisma"];
    $disponibilidade_servico = isset($_POST["disponibilidade"]) ? implode(", ", $_POST["disponibilidade"]) : "";

    $insert_sql = "INSERT INTO acolitos (nome_aco, tel_celular, data_nasc, cpf, nome_mae, tel_mae, endereco, bairro, igreja_serve, crisma, disponibilidade_servico) VALUES ('$nome_aco', '$tel_celular', '$data_nasc', '$cpf', '$nome_mae', '$tel_mae', '$endereco', '$bairro', '$igreja_serve', '$crisma', '$disponibilidade_servico')";

    if ($conn->query($insert_sql) === TRUE) {
        $nome_acolito = $_POST["nome_aco"];
        header("Location: obrigado.php?nome=$nome_acolito");
        exit();
    } else {
        echo "Erro ao cadastrar o acólito: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Cadastro de Acólitos</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
    <h1>Cadastro de Acólitos</h1>
    <form action="aba_publica.php" method="POST">
        <label for="nome_aco">Nome:</label>
        <input type="text" id="nome_aco" name="nome_aco" required placeholder="Nome Completo">

        <label for="tel_celular">Telefone/Celular:</label>
        <input type="text" id="tel_celular" name="tel_celular" required placeholder="(XX) 99999-999">

        <label for="data_nasc">Data de Nascimento:</label>
        <input type="date" id="data_nasc" name="data_nasc" required>

        <label for="cpf">CPF:</label>
        <input type="text" id="cpf" name="cpf" required placeholder="999.999.999-00">

        <label for="nome_mae">Nome da Mãe:</label>
        <input type="text" id="nome_mae" name="nome_mae" required>

        <label for="tel_mae">Telefone da Mãe:</label>
        <input type="text" id="tel_mae" name="tel_mae" required placeholder="(XX) 99999-9999">

        <label for="endereco">Endereço:</label>
        <input type="text" id="endereco" name="endereco" required placeholder="Jardim da Teresinha nº000">

        <label for="bairro">Bairro:</label>
        <input type="text" id="bairro" name="bairro" required>

        <label for="igreja_serve">Igreja que Serve:</label><br>
        <select id="igreja_serve" name="igreja_serve" required>
            <option value="">Selecione a Igreja</option>
            <option value="Matriz">Matriz</option>
            <option value="Nossa Senhora Aparecida">Nossa Senhora Aparecida</option>
            <option value="Bom Jesus">Bom Jesus</option>
            <option value="São Pedro">São Pedro</option>
        </select><br>

        <label for="crisma">O acólito é crismado?</label><br>
        <select id="crisma" name="crisma" required>
            <option value="">Selecione uma opção</option>
            <option value="Sim">Sim</option>
            <option value="Não">Não</option>
        </select><br>

        <label for="disponibilidade_servico">Disponibilidade em servir em quais períodos?</label><br>
        <label>
            <input type="checkbox" id="disponibilidade_manha" name="disponibilidade[]" value="Manhã">
            Manhã
        </label><br>

        <label>
            <input type="checkbox" id="disponibilidade_noite" name="disponibilidade[]" value="Noite">
            Noite
        </label><br>

        <label>
            <input type="checkbox" id="disponibilidade_fds" name="disponibilidade[]" value="Final de semana">
            Final de semana
        </label><br>

        <label>
            <input type="checkbox" id="disponibilidade_multipla" name="disponibilidade[]" value="Em Mais de Uma igreja">
            Em Mais de Uma igreja
        </label><br>

        <label>
            <input type="checkbox" id="disponibilidade_unica" name="disponibilidade[]" value="Somente em uma igreja">
            Somente em uma igreja
        </label><br>

        <input type="submit" value="Cadastrar Acólito">
    </form>
</body>
</html>
