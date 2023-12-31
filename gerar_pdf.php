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
            <div style='font-weight: bold; text-align: center;'>Pastoral de Acólitos</div>
            <div style='font-weight: bold; text-align: center;'>Diocese de Franca-SP</div>
            <div style='font-weight: bold; text-align: center;'>Paróquia São Sebastião e Santo Antônio</div>
            <hr>
        ";

        // Informações do acólito
        $nome_aco = $row["nome_aco"];
        $tel_celular = $row["tel_celular"];
        $nome_mae = $row["nome_mae"];
        $crisma = $row["crisma"];
        $igreja_serve = $row["igreja_serve"];
        $disponibilidade_servico = $row["disponibilidade_servico"];

        $acolito_info = "
            <fieldset style='background-color:#E6E6FA;'>
                <legend>Informações do Acólito</legend>
                <div><strong>Nome:</strong> $nome_aco</div>
                <div><strong>Telefone:</strong> $tel_celular</div>
                <div><strong>Nome da Mãe:</strong> $nome_mae</div>
                <div><strong>O acolito é crismado?:</strong> $crisma</div>
                <div><strong>Igreja de Preferência:</strong> $igreja_serve</div>
                <div><strong>Tem disponibilidade de servir em quais períodos?</strong> $disponibilidade_servico</div>


            </fieldset>
        ";

        // Texto de compromisso
        $compromisso = "
            <br><br>
            <div>Caro Acólito <strong>$nome_aco</strong>,</div>
            <br>
            <div>Aceita servir a santa igreja de cristo, cuidando e zelando com responsabilidade da liturgia, paramentos e objetos sagrados:(   ) SIM  /  (    ) NÃO</div>


            <div style='position: fixed; bottom: 300; left: 0; right: 0; text-align: center;'>Eu,<strong> $nome_mae</strong>, autorizo meu/minha filho(a)<strong> $nome_aco </strong>, a participar da Pastoral de Acólitos e Ancilas, ciente das seguintes condições:
            <br><br> <br>
            <strong> 1º Meu(minha) filho(a) poderá sair das celebrações desacompanhado(a) em horários tardios, conforme necessário.</strong>
             <br>
           <strong> 2º Eventuais viagens serão realizadas apenas com a devida autorização dos pais ou responsáveis legais.</strong>
            <br><br>
            
            Estou ciente dos compromissos e responsabilidades associados à participação na Pastoral de Acólitos e Ancilas e confio que meu(minha) filho(a) agirá de acordo com os valores e orientações transmitidos pela pastoral e pela equipe responsável.
            
            Assumo a responsabilidade de informar à pastoral sobre quaisquer alterações relevantes, como mudanças de contato ou questões médicas que possam afetar a participação do meu(minha) filho(a) nas atividades.</div>
            <hr style='border: none; border-top: 1px solid #000;; width: 30%; position: fixed; bottom: 240; left: 0; right: 0;'>
            <div style='position: fixed; bottom: 230; left: 0; right: 0; text-align: center;'>Assinatura do responsável.</div>
   
         
        ";

        // Rodapé do PDF
        $footer = "
         
       
        <div style='position: fixed; bottom: 60; left: 0; right: 250; text-align: center;'>Coordenador Geral</div>
         <hr style='border: none; border-top: 1px solid #000;; width: 30%; position: fixed; bottom: 70; left: 0; right: 250;'>

         <div style='position: fixed; bottom: 60; left: 250; right: 0; text-align: center;'>Vice-Coordenador</div>
            <hr style='border: none; border-top: 1px solid #000;; width: 30%; position: fixed; bottom: 70; left: 250; right: 0;'>


          <div style='position: fixed; bottom: 0; left: 0; right: 0; text-align: center; font-size:15px'>Bem como o Filho do homem não veio para ser servido, 
          mas para servir, e para dar a sua vida em resgate de muitos. 
          </div>
          <div  style='position: fixed; bottom: -25; left: 0; right: 0; text-align: center; font-size:15px'>  Mateus 20:28</div>
    
        ";  

        // Criação do objeto Dompdf
        $dompdf = new Dompdf();

        // Montagem do conteúdo do PDF
        $html = $header. $acolito_info . $compromisso . $footer;

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
