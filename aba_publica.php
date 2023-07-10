
<?php


session_start();
$_SESSION['cadastro_aba_publica'] = true;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Processar os dados do formulário aqui

    // Redirecionar para o index.php após o processamento
    header("Location: obrigado.php");
    exit();
}
?>





<!DOCTYPE html>
<html>
<head>
    <title>Cadastro de Acólitos</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <meta charset="utf-8">
</head>
<body>
    <h1>Cadastro de Acólitos</h1>
    <form action="index.php" method="POST">
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
        <label>
            <input type="radio" id="matriz" name="igreja_serve" value="Matriz" required>
            Matriz
        </label><br>

        <label>
            <input type="radio" id="nossa_senhora_aparecida" name="igreja_serve" value="Nossa Senhora Aparecida" required>
            Nossa Senhora Aparecida
        </label><br>

        <label>
            <input type="radio" id="bom_jesus" name="igreja_serve" value="Bom Jesus" required>
            Bom Jesus
        </label><br>

        <label>
            <input type="radio" id="sao_pedro" name="igreja_serve" value="São Pedro" required>
            São Pedro
        </label><br>

        <label for="crisma">O acólito é crismado?</label><br>
        <label>
            <input type="radio" id="crismado_sim" name="crisma" value="Sim" required>
            Sim
        </label><br>

        <label>
            <input type="radio" id="crismado_nao" name="crisma" value="Não" required>
            Não
        </label><br>

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
