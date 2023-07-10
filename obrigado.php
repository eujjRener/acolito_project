<!DOCTYPE html>
<html>
<head>
    <title>Obrigado por cadastrar</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <meta charset="utf-8">
</head>
<body>
    <div class="container">
        <h1>Obrigado por cadastrar <?php echo isset($_GET['nome']) ? $_GET['nome'] : ''; ?></h1>
        <p>Seu cadastro foi realizado com sucesso!</p>
    </div>
</body>
</html>
