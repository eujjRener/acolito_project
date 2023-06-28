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
        <input type="text" id="nome_aco" name="nome_aco" required>

        <label for="data_nasc">Data de Nascimento:</label>
        <input type="date" id="data_nasc" name="data_nasc" required>

        <label for="cpf">CPF:</label>
        <input type="text" id="cpf" name="cpf" required>

        <label for="nome_mae">Nome da Mãe:</label>
        <input type="text" id="nome_mae" name="nome_mae" required>

        <label for="tel_celular">Telefone/Celular:</label>
        <input type="text" id="tel_celular" name="tel_celular" required placeholder="(XX) 99999-999">

        <label for="endereco">Endereço:</label>
        <input type="text" id="endereco" name="endereco" required>

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

        <input type="submit" value="Cadastrar Acólito">
    </form>
</body>

</html>