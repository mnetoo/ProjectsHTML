<!DOCTYPE html>
<html lang="pt-br">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <meta name="description" content="">
  <title>Termo de Responsabilidade</title>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <!-- Mask -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
  <!-- Bootstrap v5.3: CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">

  <!-- Font Awesome CSS -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" rel="stylesheet">

  <!--CSS -->
  <link rel="stylesheet" type="text/css" href="css/style.css"> <!-- Formulário Cadastro -->

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


<style type="text/css">
    @media print {
      @page {
        size: A4;
        margin:1cm;
      }

       header {
        position: static;
        margin-top: 0px;
      }

      header img{
        height:9.2vh;
      }

      footer.text-muted {
      position: static;
      bottom: 0;
      width: 100%;
      }

       body {
        padding: 0px;
              }

       form {
        margin:auto;
        width:1080px;
      }

       .float-left {
    display: flex;
    align-items: center;
  }

  .float-left a:first-child {
    margin-right: 4vh; /* Move o primeiro elemento para a extrema esquerda */
  }

      .footer-link {
        font-size:14px;
    white-space: nowrap; /* Evitar quebra de palavras */
       }

      main {
        margin-left:0px;
      }


      .page-content {
        margin:0px;
      }

      .btn-secondary {
        display: none;
      }
    }

    @media screen {
      header {
        width: 100%;
      }

      footer {
        width: 100%;
      }

      body {
        padding-top: 0;
        padding-bottom: 0;
      }

      form {
        margin:auto;
      }
    }

  </style>

</head>

<body>

 <?php 
include_once('cabecalho.php')
 ?>
  
  <!-- Conteúdo da Página -->

  <main class="page-content">
  <form style="width:1080px;">
 <table class="table table-striped" style="border-radius: 15px; overflow: hidden;">
  <br>
  <br>
            <tbody>
              <tr style="background-color: #4157a3;">
                <!-- TÍTULO: -->
                <td style="background-color: #4157a3; color: white;" colspan="6"> <b> Informações do solicitante </b> </td>
              </tr>
              <tr>

                <!-- 1ªLINHA/ 1ªCOLUNA: -->
                <td style="width: 18%;">Solicitante</td>


                <!-- 1ªLINHA/ 2ªCOLUNA: -->
                <td style="width: 82%; text-align:center;">
                  <input class="form-control" type="text" name="solicitante">
                </td>

              </tr>

              <tr>
                <!-- 2ªLINHA/ 1ªCOLUNA: -->
                <td> Setor/Unidade</td>

                <!-- 2ªLINHA/ 2ªCOLUNA: -->
                <td>
                   <input class="form-control" type="text" name="setor">
                </td>

              </tr>

                <tr style="background-color: #4157a3;">

                <td> Telefone</td>
                <td>
                 <input class="form-control" type="text" name="telefone" id="telefone" maxlength="14">
                </td>

              </tr>
            </tbody>
          </table>


          <br>


          <!--************************************************ Tabela 02 - Coordenadas Geodésicas Espaciais: -->
          <table class="table table-striped" style="border-radius: 15px; overflow: hidden;">
            <tbody>
              <tr style="background-color: #4157a3;">
                <!-- TÍTULO: -->
                <td style="background-color: #4157a3; color: white;" colspan="6"> <b> Informações do empréstimo</b> </td>
              </tr>
              <tr>

                <!-- 1ªLINHA/ 1ªCOLUNA: -->
                <td style="width: 18%;">Número do registro patrimonial</td>

                <!-- 1ªLINHA/ 2ªCOLUNA: -->
                <td style="width: 82%; text-align:center;">
                 <input class="form-control" type="text" name="registro">
                </td>

              </tr>
              <tr>

                <!-- 2ªLINHA/ 1ªCOLUNA: -->
                <td> Tipo do Equipamento </td>

                <!-- 2ªLINHA/ 2ªCOLUNA: -->
                <td style="width: 16%; text-align:center;">
                  <input class="form-control" type="text" id="tipo" name="tipo">
                </td>

              </tr>
              <tr>

                <!-- 3ªLINHA/ 1ªCOLUNA: -->
                <td> Marca e Modelo </td>

                <!-- 3ªLINHA/ 2ªCOLUNA: -->
                <td style="width: 30%; text-align:center;">
                    <input class="form-control" type="text" id="marca" name="marca">
                </td>
              
              </tr>
              <tr>

                <!-- 4ªLINHA/ 1ªCOLUNA: -->
                <td> Data de retirada </td>

                <!-- 4ªLINHA/ 2ªCOLUNA: -->
                <td style="width: 30%; text-align:center;">
                  <input class="form-control" type="date" id="retirada" name="retirada">
                </td>


              </tr>
              <tr>
                  <td>Data de devolução</td>

                <!-- 4ªLINHA/ 4ªCOLUNA: VARIÁVEL N (Ondulação Geoidal) -->
                <td style="text-align:center;">
                  <input class="form-control" type="date" id="devolucao" name="devolucao">
                </td>
              </tr>
              <tr>

                <!-- 5ªLINHA/ 1ªCOLUNA: -->
                <td> Objetivo de uso </td>

                <!-- 5ªLINHA/ 2ªCOLUNA: -->
                <td style="width: 30%; text-align:center;">
                  <input class="form-control" type="text" id="obj_uso" name="obj_uso">
                </td>

              </tr>
              <tr>

                <!-- 6ªLINHA/ 1ªCOLUNA: -->
                <td> Local de uso (cidade, estado, pais) </td>

                <!-- 6ªLINHA/ 2ªCOLUNA: -->
                <td style="width: 30%; text-align:center;">
                                    <input class="form-control" type="text" id="local_uso" name="local_uso">

                </td>
            
              </tr>
      

            </tbody>
          </table>

          <br>


          <!--************************************************ Tabela 03 - Coordenadas no Sistema Universal Transverso de Mercator (UTM): -->
          <table class="table table-striped" style="border-radius: 15px; overflow: hidden;">
            <tbody>
              <tr style="background-color: #4157a3;">
                <!-- TÍTULO: -->
                <td style="background-color:#4157a3 ;color: white;" colspan="6"><b> Estado do Equipamento </b></td>

              </tr>
              <tr>
                <!-- 1ªLINHA/ 1ªCOLUNA: -->
                <td style="width: 50%;"> Grau de fragilidade ou perecibilidade do material </td>

                <!-- 1ªLINHA/ 2ªCOLUNA: -->
                <td style="width: 50%; text-align:left;">
                 <div class="form-check form-check-inline" style="margin-top: 10px;">
  <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="option1">
  <label class="form-check-label" for="inlineRadio1">Alto</label>
</div>
<div class="form-check form-check-inline">
  <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="option2">
  <label class="form-check-label" for="inlineRadio2">Médio</label>
</div>
<div class="form-check form-check-inline">
  <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio3" value="option3">
  <label class="form-check-label" for="inlineRadio3">Baixo</label>
</div>
                </td>

                <!-- 1ªLINHA/ 3ªCOLUNA: -->
              </tr>
              <tr>
                <!-- 2ªLINHA/ 1ªCOLUNA: -->
                <td style="width: 50%;"> Declaro utilizar com cuidado e zelo o equipamento solicitado. Afirmo ter verificado, antes da retirada, que o equipamento se encontrava: </td>

                <!-- 2ªLINHA/ 2ªCOLUNA: -->
  <td style="width: 50%; text-align:left;">
    <div class="form-check form-check-inline" style="margin-top: 10px;">
      <input class="form-check-input" type="radio" name="equipamento_estado" id="equiamento_sem_danos" value="option1">
      <label class="form-check-label" for="equipamento_sem_danos">Em perfeitas condições de uso e bom estado de conservação</label>
    </div>
    <div class="form-check form-check-inline">
      <input class="form-check-input" type="radio" name="equipamento_estado" id="equipamento_danos" value="option2" onChange="habilitaTextarea()">
      <label class="form-check-label" for="equipamento_danos">Com os seguintes problemas e/ou danos (descrevê-los):</label>
    </div>
  </td>
              </tr>
           
            </tbody>
          </table>

        <td><textarea class="form-control" id="textarea" name="textarea" style="background-color: transparent; outline: none; height:100px; resize:none;" maxlength="200" disabled></textarea></td>

          <br>

<div style="display: flex; align-items: center; width:23%;">
    <p style="margin-right: 10px;">Curitiba,</p>
    <input class="form-control" type="date" id="data" name="data">
</div>

<center>
    <div style="align-items: center; border-bottom:1px solid black; width: 50%; margin-top: 60px;"></div>
    <p>Nome Completo e Assinatura do Solicitante</p>
</center>

 <div style="text-align:center;">
  <button class="btn btn-secondary" onclick="window.print()" style="background-color:#4157a3">Imprimir/ Gerar PDF</button>
</div>

  </form>
  </main>
<br>
<br>
<br>
  <!-- Rodapé -->
<?php 
include_once('rodape.php')
?>

</body>

</html>