<script>
  function calcularIdade() {
    var dataNascimento = document.getElementById('data_nasc').value;
    var dataAtual = new Date();

    var anoNascimento = parseInt(dataNascimento.substr(0, 4));
    var mesNascimento = parseInt(dataNascimento.substr(5, 2));
    var diaNascimento = parseInt(dataNascimento.substr(8, 2));

    var anoAtual = dataAtual.getFullYear();
    var mesAtual = dataAtual.getMonth() + 1;
    var diaAtual = dataAtual.getDate();

    var idade = anoAtual - anoNascimento;

    if (mesAtual < mesNascimento || (mesAtual === mesNascimento && diaAtual < diaNascimento)) {
      idade--;
    }

    return idade;
  }

  function exibirIdade() {
    var idade = calcularIdade();
    alert("Sua idade atual é: " + idade + " anos.");
  }
</script>

<input type="date" id="data_nasc" name="data_nasc" required>
<button onclick="exibirIdade()">Calcular Idade</button>
