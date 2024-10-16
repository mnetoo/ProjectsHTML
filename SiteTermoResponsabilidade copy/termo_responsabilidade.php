<!DOCTYPE html>
<html lang="pt-br">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link rel="icon" href="img/cepag.png">
  <meta name="description" content="">
  <title>Termo de Responsabilidade</title>

  <link rel="stylesheet" type="text/css" href="css/tabelas.css"> <!-- Formulário Cadastro -->

  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <!-- Mask -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
  <!-- Bootstrap v5.3: CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">

  <!-- Font Awesome CSS -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" rel="stylesheet">

  <!--CSS -->
  <link rel="stylesheet"  href="css/style.css">

   <script>
    $(document).ready(function () {
      $('#telefone').mask('(00) 0000-0000');
    });

    function habilitaTextarea() {
      var radio = document.getElementById('equipamento_danos');
      var textarea = document.getElementById('textarea');

      if (radio.checked) {
        textarea.disabled = false;
      } else {
        textarea.disabled = true;
      }
    }
  </script>

</head>

<body>

 <?php 
include_once('cabecalho.php')
 ?>
  
  <!-- Conteúdo da Página -->

  <main>
    <form id="form">

<!--------------------------------------- INFORMAÇÕES DO SOLICITANTE ----------------------------------------->

              <section class="tabela duasColunas">
                <div class="duasColunas">
                    <p class="titulo"> Informações do solicitante</p>
                    <div class="linha branca">
                        <p>Solicitante</p>
                        <input class="form-control" type="text" name="solicitante" id="solicitante">
                    </div>
                </div>

                <div class="duasColunas">
                    <div class="linha cinza">
                        <p>Setor/Unidade</p>
                        <input class="form-control" type="text" name="setor" id="setor">
                    </div>
                </div>

                <div class="duasColunas">
                    <div class="linha branca fim">
                        <p>Telefone</p>
                        <input class="form-control" type="text" name="telefone" id="telefone" maxlength="14">
                    </div>
                </div>
              </section>

<!--------------------------------------- INFORMAÇÕES DO EMPRÉSTIMO ----------------------------------------->

              <section class="tabela duasColunas">
                <div class="duasColunas">
                    <p class="titulo"> Informações do empréstimo</p>
                    <div class="linha branca">
                        <p>Número do registro patrimonial</p>
                        <input class="form-control" type="text" name="registro" id="registro">
                    </div>
                </div>

                <div class="duasColunas">
                    <div class="linha cinza">
                        <p>Tipo do Equipamento</p>
                        <input class="form-control" type="text" id="tipo" name="tipo">
                    </div>
                </div>

                <div class="duasColunas">
                    <div class="linha branca">
                        <p>Marca e Modelo</p>
                        <input class="form-control" type="text" id="marca" name="marca">
                    </div>
                </div>

                <div class="duasColunas">
                    <div class="linha cinza">
                        <p>Data de retirada</p>
                        <input class="form-control" type="date" id="retirada" name="retirada">
                    </div>
                </div>

                <div class="duasColunas">
                    <div class="linha branca">
                        <p>Data de Devolução</p>
                        <input class="form-control" type="date" id="devolucao" name="devolucao">
                    </div>
                </div>

                <div class="duasColunas">
                    <div class="linha cinza">
                        <p>Objetivo de uso</p>
                        <input class="form-control" type="text" id="obj_uso" name="obj_uso">
                    </div>
                </div>

                <div class="duasColunas">
                    <div class="linha branca fim">
                        <p>Local de uso (cidade, estado, pais)</p>
                        <input class="form-control" type="text" id="local_uso" name="local_uso">
                    </div>
                </div>
              </section>

<!--------------------------------------- ESTADO DO EQUIPAMENTO ----------------------------------------->

              <section class="tabela duasColunas">
                <div class="duasColunasEquip">
                    <p class="titulo">Estado do Equipamento</p>
                    <div class="linha branca">
                        <p>Grau de fragilidade ou perecibilidade do material</p>
                        <div class="form-check form-check-inline" style="margin-top: 10px;">
                        <div class="form-check form-check-inline">
                          <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="Alto" />
                          <label class="form-check-label" for="inlineRadio1" >Alto</label>
                        </div>
                        <div class="form-check form-check-inline">
                          <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="Médio" />
                          <label class="form-check-label" for="inlineRadio2" >Médio</label>
                        </div>
                        <div class="form-check form-check-inline">
                          <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio3" value="Baixo" />
                          <label class="form-check-label" for="inlineRadio3">Baixo</label>
                        </div>
  </div>
                    </div>
                </div>

                <div class="duasColunasEquip">
                    <div class="linha cinza fim">
                        <p>Declaro utilizar com cuidado e zelo o equipamento solicitado.<br> Afirmo ter verificado, antes da retirada, que o equipamento se encontrava: </p>
                        <div class="form-check form-check-inline" style="margin-top: 10px;">
                          <input class="form-check-input" type="radio" name="equipamento_estado" id="equipamento_sem_danos" value="Equipamento sem danos">
                          <label class="form-check-label" for="equipamento_sem_danos">Em perfeitas condições de uso e bom estado de conservação</label>
                          <br>
                          <input class="form-check-input" type="radio" name="equipamento_estado" id="equipamento_danos" value="Equipamento com danos">
                          <label class="form-check-label" for="equipamento_danos">Com os seguintes problemas e/ou danos (descrevê-los):</label>
                        </div>
                    </div>
                </div>
              </section>

              <section class="tabela">
                <textarea class="form-control" id="textarea" name="textarea" maxlength="200" enable></textarea>
              </section>

<!--------------------------------------------------------------------------------------------------------->

              <!-- DATA -->
              <section class="tabela" style="text-align:right;">
                  <p id="data"></p>
              </section>

              <!-- ASSINATURA -->
              <section class="tabela" style="text-align:center; ">
                  <div class="line"></div>
                  <p class="ass">Nome Completo e Assinatura do Solicitante</p>
              </section>

              <!-- IMPRESSÃO -->
            <section class="tabela no-print" style="text-align:center; ">
                <button type="button" class="btn btn-light botaoAzul" onclick="imprimirPagina()">Imprimir/Gerar PDF</button>

                <button type="button" class="btn btn-light botaoAzul" onclick="submitForm()">Salvar Informações</button>


                <label class="upload-txt inputButton botaoAzul" title="Carregar arquivo .txt">
                    <input type="file" name="arquivo" id="" onchange="readCSV(this)" accept=".csv" required>Carregar Informações
                </label>
            </section>
    </form>
  </main>

  <script src="javascript/termo.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"crossorigin="anonymous"></script>

  <!-- Rodapé -->
<?php 
include_once('rodape.php')
?>

</body>

</html>