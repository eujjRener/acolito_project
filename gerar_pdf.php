<?php
require_once 'dompdf/autoload.inc.php';
use Dompdf\Dompdf;

// Verificar se o ID do acólito foi enviado via POST
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["id"])) {
    $id = $_POST["id"];

    // Consultar os detalhes do acólito no banco de dados
    require_once 'config.php';
    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Falha na conexão: " . $conn->connect_error);
    }

    $sql = "SELECT * FROM acolitos WHERE id = $id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        // Cabeçalho do PDF
        $header = "
            <div style='font-weight: bold; text-align: center; '>Pastoral de Acólitos</div>
            <div style='font-weight: bold; text-align: center; '> Diocese de Franca-SP</div>
            <div style='font-weight: bold; text-align: center; '>Paróquia São Sebastião e Santo Antônio</div>
            <hr>
        ";

        // Informações do acólito
        $nome_aco = $row["nome_aco"];
        $igreja_serve = $row["igreja_serve"];
        $cpf = $row["cpf"];
        $tel_celular = $row["tel_celular"];
        $nome_mae = $row["nome_mae"];

        $acolito_info = "
            <fieldset style='background-color:#E6E6FA;'>
                <div >Nome: $nome_aco</div>
                <div>Igreja que serve: $igreja_serve</div>
                <div > CPF: $cpf</div>
                <div >Telefone: $tel_celular</div>
                <div>Nome do responsável: $nome_mae</div>
            </fieldset>
        ";

        // Texto de compromisso
        $compromisso = "
        <br> <br>
            <div>Caro Acólito,</div>
            <div>Aqui vai o texto de compromisso. Você pode adicionar seu conteúdo personalizado aqui.</div>
            <div>Atenciosamente,</div>
            <div>Coordenação</div>
           
        ";

        // Rodapé do PDF
        $footer = "
            <div>Coordenador Geral</div>
        ";

        // Criação do objeto Dompdf
        $dompdf = new Dompdf();

        // Montagem do conteúdo do PDF
        $html = $header . $acolito_info . $compromisso . $footer;

        // Carregar o HTML para o dompdf
        $dompdf->loadHtml($html);

        // Definir opções de renderização
        $dompdf->setPaper('A4', 'portrait');

        // Renderizar o HTML como PDF
        $dompdf->render();

        // Gerar a saída do PDF
        $dompdf->stream("acolito.pdf", array("Attachment" => false));
    } else {
        echo "Acólito não encontrado.";
    }

    $conn->close();
} else {
    echo "ID do acólito não especificado.";
}
?>

