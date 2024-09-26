<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Formulário de Cadastro</title>

    <!-- Adicionando Javascript -->
    <script>
        function limpa_formulário_cep() {
            //Limpa valores do formulário de cep.
            document.getElementById('rua').value = ("");
            document.getElementById('bairro').value = ("");
            document.getElementById('cidade').value = ("");
            document.getElementById('estado').value = ("");
        }

        function meu_callback(conteudo) {
            if (!("erro" in conteudo)) {
                //Atualiza os campos com os valores.
                document.getElementById('rua').value = (conteudo.logradouro);
                document.getElementById('bairro').value = (conteudo.bairro);
                document.getElementById('cidade').value = (conteudo.localidade);
                document.getElementById('estado').value = (conteudo.uf);
            } //end if.
            else {
                //CEP não Encontrado.
                limpa_formulário_cep();
                alert("CEP não encontrado.");
            }
        }

        function pesquisacep(valor) {

            //Nova variável "cep" somente com dígitos.
            var cep = valor.replace(/\D/g, '');

            //Verifica se campo cep possui valor informado.
            if (cep != "") {

                //Expressão regular para validar o CEP.
                var validacep = /^[0-9]{8}$/;

                //Valida o formato do CEP.
                if (validacep.test(cep)) {

                    //Preenche os campos com "..." enquanto consulta webservice.
                    document.getElementById('rua').value = "";
                    document.getElementById('bairro').value = "";
                    document.getElementById('cidade').value = "";
                    document.getElementById('estado').value = "";

                    //Cria um elemento javascript.
                    var script = document.createElement('script');

                    //Sincroniza com o callback.
                    script.src = 'https://viacep.com.br/ws/' + cep + '/json/?callback=meu_callback';

                    //Insere script no documento e carrega o conteúdo.
                    document.body.appendChild(script);

                } //end if.
                else {
                    //cep é inválido.
                    limpa_formulário_cep();
                    alert("Formato de CEP inválido.");
                }
            } //end if.
            else {
                //cep sem valor, limpa formulário.
                limpa_formulário_cep();
            }
        };
    </script>
</head>

<body>
    <div class="container">
        <div class="form-image">
            <img src="imagens/undraw_shopping_re_hdd9.svg">
        </div>
        <div class="form">
            <form action="./php/cadastraUser.php" method="post">
                <?php
                $nome = $_POST["firstname"];
                $date = $_POST["date"];
                $cpf = $_POST["cpf"];
                $email = $_POST["email"];
                $tel = $_POST["number"];
                $password = $_POST["password"];
                // $confirmPassword = $_POST["confirmpassword"];
                echo ("<input type = 'hidden' id = 'nome' name = 'firstname' value= '$nome'/>");
                echo ("<input type = 'hidden' id = 'date' name = 'date' value= '$date'/>");
                echo ("<input type = 'hidden' id = 'cpf' name = 'cpf' value= '$cpf'/>");
                echo ("<input type = 'hidden' id = 'email' name = 'email' value= '$email'/>");
                echo ("<input type = 'hidden' id = 'number' name = 'number' value= '$tel'/>");
                echo ("<input type = 'hidden' id = 'password' name = 'password' value= '$password'/>");
                // echo("<input type = 'hidden' id = 'confirmpassword' name = 'confirmPassword' value= '$confirmPassword'/>");

                $birthDate = new DateTime($_POST['date']);
                $currentDate = new DateTime();
                $age = $currentDate->diff($birthDate)->y;
                
                if ($age < 18) {
                    die('Você deve ter pelo menos 18 anos para se cadastrar.');
                }
    
                ?>
                <div class="form-header">
                    <div class="title">
                        <h1>Endereço</h1>
                    </div>
                </div>

                <div class="input-group">
                    <div class="input-box">
                        <label for="cep">CEP</label>
                        <input id="cep" type="text" name="cep" onblur="pesquisacep(this.value);" autocomplete="off" placeholder="Informe seu cep" required>
                    </div>

                    <div class="input-box">
                        <label for="rua">Rua</label>
                        <input id="rua" type="text" name="rua" autocomplete="off" placeholder="Informe sua rua" required>
                    </div>

                    <div class="input-box">
                        <label for="bairro">Bairro</label>
                        <input id="bairro" type="text" name="bairro" autocomplete="off" placeholder="Informe seu bairro" required>
                    </div>

                    <div class="input-box">
                        <label for="cidade">Cidade</label>
                        <input id="cidade" type="text" name="cidade" autocomplete="off" placeholder="Informe sua cidade" required>
                    </div>

                    <div class="input-box">
                        <label for="estado">Estado</label>
                        <input id="estado" type="text" name="estado" autocomplete="off" placeholder="Informe seu estado" required>
                    </div>

                    <div class="input-box">
                        <label for="numero">Número</label>
                        <input id="numero" type="text" name="numero" autocomplete="off" placeholder="Informe seu numero" required>
                    </div>

                    <div class="input-box">
                        <label for="complemento">Complemento</label>
                        <input id="complemento" type="text" name="complemento" autocomplete="off" placeholder="Informe seu complemento">
                    </div>
                </div>

                <div class="continue-button">
                    <button>Concluir</button>
                </div>
            </form>
        </div>
    </div>
</body>

</html>

