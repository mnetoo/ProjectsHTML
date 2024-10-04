<?php

include 'functions.php';

///////////////////////////////////////////////////////////////////////////////////////
  // Fazer login
  if (session_status() == PHP_SESSION_NONE) {
    // Se não houver uma sessão ativa, inicie uma nova sessão
    session_start();
    }
   ini_set('include_path', '/var/www/campusmap/usuarios');
   include_once "/var/www/campusmap/usuarios/config/core.php";
if (!(isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true)) { // Verifica se o usuário está logado
  session_start(); // Inicia a sessão 
  $_SESSION['redirect_url'] = $_SERVER['REQUEST_URI']; // Se o usuário não estiver logado, redirecione-o para a página de login
  header("Location: https://campusmap.ufpr.br/usuarios/login.php");
  exit; // Certifique-se de que o código pare de ser executado após o redirecionamento
}
///////////////////////////////////////////////////////////////////////////////////////
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if ($_POST['captcha'] == $_SESSION['captcha']) {
        // Se o CAPTCHA estiver correto, não define $_SESSION['captcha_verified']
        $captcha_verified = true; // Isso indica que o CAPTCHA foi verificado nesta requisição
        //header('Location: ' . $_SERVER['PHP_SELF'] . $query_string);
        $_SESSION['captcha_verified'] = true;
        $query_string = $_SERVER['QUERY_STRING'] ? '?' . $_SERVER['QUERY_STRING'] : '';
        header('Location: ' . $_SERVER['PHP_SELF'] . $query_string);
        exit;
  
      } else {
        $error = 'CAPTCHA incorreto!';
        // Redireciona de volta para a página anterior com os parâmetros GET preservados
        $query_string = $_SERVER['QUERY_STRING'] ? '?' . $_SERVER['QUERY_STRING'] : '';
        header('Location: ' . $_SERVER['PHP_SELF'] . $query_string);
        exit;
    }
  }
///////////////////////////////////////////////////////////////////////////////////////
// Inicializa a variável $resultados
$resultados = [];
// Verifique se o parâmetro de identificação foi fornecido via GET
if (isset($_GET['identificacao'])) {
  // Obtenha a identificação do parâmetro GET
  $identificacao = $_GET['identificacao'];

  if (isset($_GET['periodo'])) {
    $periodo = $_GET['periodo'];

    // Chame a função busca_ponto
    $resultados = busca_ponto_periodo($identificacao, $periodo, $db);
    } else{
      $resultados = busca_ponto($identificacao, $db);
    }
  
  // Exiba os resultados
  if ($resultados) {
    // Atribui o primeiro resultado a $resultado (assumindo que a identificação é única)
    $resultado = $resultados[0];
  }
}
///////////////////////////////////////////////////////////////////////////////////////

// Cria o QRCODE
$scheme = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http"; // Obtenha o esquema (http ou https)
$host = $_SERVER['HTTP_HOST']; // Obtenha o nome do host (domínio)
$path = $_SERVER['PHP_SELF']; // Obtenha o caminho da URL do script atual
$queryString = $_SERVER['QUERY_STRING']; // Obtenha os parâmetros da consulta (GET)

// Combine as partes para formar o URL completo da página
$url = $scheme . "://" . $host . $path . ($queryString ? '?' . $queryString : '');

$tamanho = 300; // Tamanho do QR Code (ajuste conforme necessário)

// Crie a URL da API do Google Charts (do próprio link da monografia)
//$urlAPI = "https://chart.googleapis.com/chart?chs={$tamanho}x{$tamanho}&cht=qr&chl=" . urlencode($url);

// Crie a URL do ponto para Google
//$urlAPI = "https://chart.googleapis.com/chart?cht=qr&chs={$tamanho}x{$tamanho}&chl=" . "https://www.google.com/maps/place/{$resultado['latitude_dec']},{$resultado['longitude_dec']}";
$urlAPI = "https://quickchart.io/qr?width=300&height=300&text=https://www.google.com/maps/place/{$resultado['latitude_dec']},{$resultado['longitude_dec']}";

?>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    var identificacao = <?php echo json_encode($identificacao); ?>;
    var periodo = <?php echo json_encode($periodo); ?>;
    $.ajax({
    url: "../../usuarios/objects/log_monografia.php",
    method: "POST",
    data: {identificacao: periodo+'_'+identificacao},
    success: function(response) {
        console.log(response);
    }
    });
});
</script>

<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <link rel="icon" href="img/logo.png">
        <title>Monografia</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" rel="stylesheet">
        <link href="css/index.css" rel="stylesheet">
        <link href="css/header.css" rel="stylesheet">
        <link href="css/footer.css" rel="stylesheet">
        <link href="css/tabelas.css" rel="stylesheet">
    </head>
    <!---->
    <header>
            <img src="img/Ufpr.png"> 
            <img src="img/Cepag.png"> 
            <p>
                MINISTÉRIO DA EDUCAÇÃO<br>
                UNIVERSIDADE FEDERAL DO PARANÁ<br>
                SETOR DE CIÊNCIAS DA TERRA<br>
                CENTRO DE PESQUISAS APLICADAS EM GEOINFORMAÇÃO<br>
                <b>MONOGRAFIA DA REDE TOPOGRÁFICA DA UFPR</b>
            </p>
            <!-- Aqui vai o QRCode -->
            <?php echo '<img src="' . $urlAPI . '" alt="QR Code para ' . $url . '">'; ?>
            <img src="img/UCM.png"> 
    </header>
    <!---->
    <body>
        <main>
            <section class="tabela quatroColunas">
                <p class="titulo">Informações Gerais:</p>
                <div class="linha branca">
                    <p>Identificação:</p>
                    <div>
                        <input class="form-control" type="text" name="identificacao" readonly value="<?php echo $resultado['identificacao']; ?>">
                        <div id="erro-identificacao"></div>
                    </div>
                    <p class="bordaEsquerda">Localidade:</p>
                    <input class="form-control" type="text" name="localidade" readonly value="<?php echo $resultado['localidade']; ?>">
                </div>
                <div class="linha cinza">
                    <p>Tipo:</p>
                    <input class="form-control" type="text" name="tipo" readonly value="<?php echo $resultado['tipo']; ?>">
                    <p class="bordaEsquerda">Período:</p>
                    <input class="form-control" type="text" name="periodo" readonly value="<?php echo $resultado['periodo']; ?>">
                </div>
                <div class="linha branca fim">
                    <p>Materialização:</p>
                    <input class="form-control" type="text" name="materializacao" readonly value="<?php echo $resultado['materializacao']; ?>">
                    <p class="bordaEsquerda">Situação no Período:</p>
                    <input class="form-control" type="text" name="situacao" readonly value="<?php echo $resultado['situacao']; ?>">
                </div>
            </section>
            <!---->
            <section class="tabela seisColunas">
                <p class="titulo">Coordenadas Geodésicas Espaciais:</p>
                <div class="linha branca">
                    <p>Sist. Ref. Terrestre:</p>
                    <input class="form-control" type="text" name="sistema_ref_terrestre_geo" readonly value="<?php echo $resultado['sistema_ref_terrestre_geo']; ?>">
                    <p class="bordaEsquerda">Latitude(φ):</p>
                    <input class="form-control" type="text" name="latitude_dec" readonly value="<?php echo $resultado['latitude_dec']; ?>">
                    <p> ± </p>
                    <input class="form-control" type="text" name="latitude_m_dp" readonly value="<?php echo $resultado['latitude_m_dp']; ?>">
                </div>
                <div class="linha cinza">
                    <p>Elipsóide:</p>
                    <input class="form-control" type="text" name="elipsoide" readonly value="<?php echo $resultado['elipsoide']; ?>">
                    <p class="bordaEsquerda">Longitude(λ):</p>
                    <input class="form-control" type="text" name="longitude_dec" readonly value="<?php echo $resultado['longitude_dec']; ?>">
                    <p> ± </p>
                    <input class="form-control" type="text" name="longitude_m_dp" readonly value="<?php echo $resultado['longitude_m_dp']; ?>">
                </div>
                <div class="linha branca">
                    <p>Altitude elipsoidal via:</p>
                    <input class="form-control" type="text" name="fonte_altitude_geometrica" readonly value="<?php echo $resultado['fonte_altitude_geometrica']; ?>">
                    <p class="bordaEsquerda">h ± σ<sub>h</sub> (m):</p>
                    <input class="form-control" type="text" name="altitude_geometrica_m" readonly value="<?php echo $resultado['altitude_geometrica_m']; ?>">
                    <p> ± </p>
                    <input class="form-control" type="text" name="altitude_geometrica_m_dp" readonly value="<?php echo $resultado['altitude_geometrica_m_dp']; ?>">
                </div>
                <div class="linha cinza">
                    <p>Ondulação geoidal via:</p>
                    <input class="form-control" type="text" name="fonte_ond_geoidal" readonly value="<?php echo $resultado['fonte_ond_geoidal']; ?>">
                    <p class="bordaEsquerda">N ± σ<sub>N</sub> (m):</p>
                    <input class="form-control" type="text" name="ond_geoidal_m" readonly value="<?php echo $resultado['ond_geoidal_m']; ?>">
                    <p> ± </p>
                    <input class="form-control" type="text" name="ond_geoidal_m_dp" readonly value="<?php echo $resultado['ond_geoidal_m_dp']; ?>">
                </div>
                <div class="linha branca">
                    <p>Altitude ortométrica via:</p>
                    <input class="form-control" type="text" name="fonte_altitude_ortometrica" readonly value="<?php echo $resultado['fonte_altitude_ortometrica']; ?>">
                    <p class="bordaEsquerda">H ± σ<sub>H</sub> (m):</p>
                    <input class="form-control" type="text" name="altitude_ortometrica_m" readonly value="<?php echo $resultado['altitude_ortometrica_m']; ?>">
                    <p> ± </p>
                    <input class="form-control" type="text" name="altitude_ortometrica_m_dp" readonly value="<?php echo $resultado['altitude_ortometrica_m_dp']; ?>">
                </div>
                <div class="linha cinza">
                    <p>Fator de conversão via:</p>
                    <input class="form-control" type="text" name="fonte_fator_conversao" readonly value="<?php echo $resultado['fonte_fator_conversao']; ?>">
                    <p class="bordaEsquerda">η ± σ<sub>η</sub> (m):</p>
                    <input class="form-control" type="text" name="fator_conversao_m" readonly value="<?php echo $resultado['fator_conversao_m']; ?>">
                    <p> ± </p>
                    <input class="form-control" type="text" name="fator_conversao_m_dp" readonly value="<?php echo $resultado['fator_conversao_m_dp']; ?>">
                </div>
                <div class="linha branca">
                    <p>Altitude normal via:</p>
                    <input class="form-control" type="text" name="fonte_altitude_normal" readonly value="<?php echo $resultado['fonte_altitude_normal']; ?>">
                    <p class="bordaEsquerda">H<sup>N</sup> ± σ<sub>H<sup>N</sup></sub> (m):</p>
                    <input class="form-control" type="text" name="altitude_normal_m" readonly value="<?php echo $resultado['altitude_normal_m']; ?>">
                    <p> ± </p>
                    <input class="form-control" type="text" name="altitude_normal_m_dp" readonly value="<?php echo $resultado['altitude_normal_m_dp']; ?>">
                </div>
                <div class="linha cinza fim">
                    <p>Gravidade via:</p>
                    <input class="form-control" type="text" name="gravidade_via" readonly value="N/D">
                    <p class="bordaEsquerda">G ± σ<sub>G</sub> (mGal):</p>
                    <input class="form-control" type="text" name="gravidade_mgal" readonly value="<?php echo $resultado['gravidade_mgal']; ?>">
                    <p> ± </p>
                    <input class="form-control" type="text" name="gravidade_mgal_dp" readonly value="<?php echo $resultado['gravidade_mgal_dp']; ?>">
                </div>
            </section>
            <!---->
            <section class="tabela seisColunas">
                <p class="titulo">Coordenadas no Sistema Universal Transversa de Mercator (UTM):</p>
                <div class="linha branca">
                    <p>Sist. Ref. Terrestre:</p>
                    <input class="form-control" type="text" name="sistema_ref_terrestre_utm" readonly value="<?php echo $resultado['sistema_ref_terrestre_utm']; ?>">
                    <p class="bordaEsquerda">E ± σ<sub>E</sub> (m):</p>
                    <input class="form-control" type="text" name="utm_e" readonly value="<?php echo $resultado['utm_e']; ?>">
                    <p> ± </p>
                    <input class="form-control" type="text" name="utm_e_dp" readonly value="<?php echo $resultado['utm_e_dp']; ?>">
                </div>
                <div class="linha cinza">
                    <p>Fuso:</p>
                    <input class="form-control" type="text" name="utm_fuso" readonly value="<?php echo $resultado['utm_fuso']; ?>">
                    <p class="bordaEsquerda">N ± σ<sub>N</sub> (m):</p>
                    <input class="form-control" type="text" name="utm_n" readonly value="<?php echo $resultado['utm_n']; ?>">
                    <p> ± </p>
                    <input class="form-control" type="text" name="utm_n_dp" readonly value="<?php echo $resultado['utm_n_dp']; ?>">
                </div>
                <div class="linha branca fim">
                    <p>Meridiano Central (º):</p>
                    <input class="form-control" type="text" name="utm_meridiano_central" readonly value="<?php echo $resultado['utm_meridiano_central']; ?>">
                    <p class="bordaEsquerda">CM:</p>
                    <input class="form-control" type="text" name="utm_cm" readonly value="<?php echo $resultado['utm_cm']; ?>">
                    <p> K: </p>
                    <input class="form-control" type="text" name="utm_k" readonly value="<?php echo $resultado['utm_k']; ?>">
                </div>
            </section>
            <!---->
            <section class="tabela seisColunas">
                <p class="titulo">Coordenadas no Plano Topográfico Local (PTL):</p>
                <div class="linha branca">
                    <p> Sist. Ref. Terrestre: </p>
                    <input class="form-control" type="text" name="sistema_ref_terrestre_ptl" readonly value="<?php echo $resultado['sistema_ref_terrestre_ptl']; ?>">
                    <p class="bordaEsquerda">X ± σ<sub>X</sub> (m):</p>
                    <input class="form-control" type="text" name="ptl_x_m" readonly value="<?php echo $resultado['ptl_x_m']; ?>">
                    <p> ± </p>
                    <input class="form-control" type="text" name="ptl_x_dp_m" readonly value="<?php echo $resultado['ptl_x_dp_m']; ?>">
                </div>
                <div class="linha cinza">
                    <p> X origem(m): </p>
                    <input class="form-control" type="text" id="origem_ptl" readonly value="<?php echo $resultado['ptl_ori_x_m']; ?>">
                    <p class="bordaEsquerda">Y ± σ<sub>Y</sub> (m):</p>
                    <input class="form-control" type="text" name="ptl_y_m" readonly value="<?php echo $resultado['ptl_y_m']; ?>">
                    <p> ± </p>
                    <input class="form-control" type="text" name="ptl_y_dp_m" readonly value="<?php echo $resultado['ptl_y_dp_m']; ?>">
                </div>
                <div class="linha branca">
                    <p>Y origem(m):</p>
                    <input class="form-control" type="text" name="ptl_ori_x_m" readonly value="<?php echo $resultado['ptl_ori_y_m']; ?>">
                    <p class="bordaEsquerda">Z ± σ<sub>Z</sub> (m):</p>
                    <input class="form-control" type="text" name="ptl_z_m" readonly value="<?php echo $resultado['ptl_z_m']; ?>">
                    <p> ± </p>
                    <input class="form-control" type="text" name="ptl_z_dp_m" readonly value="<?php echo $resultado['ptl_z_dp_m']; ?>">
                </div>
                <div class="textOrigem fim">
                    <div class="linhaPTL linha1 cinza bordaDireita">
                        <div><p>Latitude origem(φ):</p></div>
                        <div><input class="form-control" type="text" name="ptl_ori_y_m" readonly value="<?php echo $resultado['ptl_lat_ori_dec']; ?>"></div>
                    </div>
                    <div class="linhaPTL linha2 branca bordaDireita">
                        <div><p>Longitude origem(λ):</p></div>
                        <div><input class="form-control" type="text" name="ptl_lat_ori_dec" readonly value="<?php echo $resultado['ptl_long_ori_dec']; ?>"></div>
                    </div>
                    <div class="linhaPTL fimPTL cinza bordaDireita">
                        <div><p>Altitude origem H(m):</p></div>
                        <div><input class="form-control" type="text" name="ptl_long_ori_dec" readonly value="<?php echo $resultado['ptl_alt_ori_m']; ?>"></div>
                    </div>
                    <div class="texto cinza">
                        <textarea class="form-control textoinformativo" rows="4" name="ptl_descricao_origem" style="resize: none;" readonly><?php echo $resultado['ptl_descricao_origem']; ?></textarea>
                    </div>

                </div>
                    
            </section>
            <!---->
            <section class="tabela duasColunas">
                <div class="titulo duplo">
                    <p>Foto em Detalhe:</p>
                    <p>Foto Geral:</p>
                </div>
                <div class="linha branca fim" style="text-align:center; align-itens:center">
                    <div>
                        <img class="fotos" src="<?php echo $resultado['foto_detalhe']; ?>" alt="Foto Vista Detalhe">
                    </div>
                    <div class="bordaEsquerda" style="padding-left: 0vw;">
                        <img class="fotos" src="<?php echo $resultado['foto_geral']; ?>" alt="Foto Vista Geral">
                    </div>
                </div>        
            </section>
            <!---->
            <!-- Avisos de impressão: -->
            <section class="tabela no-print" style="text-align:center; align-itens:center">
                <button class="btn btn-secondary no-print" onclick="window.print()" style="background-color:#4157a3; color: white">Imprimir / Gerar PDF</button>
                <p style="color:gray; text-align:right; font-size:13px; margin-top: -10px;">Versão 2.0.0 (Agosto/2024)</p>
            </section>
        </main>

        <!--Script-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

        <?php if (!isset($_SESSION['captcha_verified']) || $_SESSION['captcha_verified'] !== true): ?>
        <!-- Modal -->
        <div class="modal fade" id="captchaModal" tabindex="-1" role="dialog" aria-labelledby="captchaModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-sm" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="captchaModalLabel">Verificação CAPTCHA</h5>
                    </div>
                    <div class="modal-body">
                    <form method="post" action="<?php echo $_SERVER['PHP_SELF'] . '?' . $_SERVER['QUERY_STRING']; ?>">
                            <div class="form-group">
                                <img src="captcha.php" alt="CAPTCHA">
                                <input type="text" class="form-control" name="captcha" required autofocus style="background-color: #fff; color: #000; border: 2px solid #007bff;">
                            </div>
                            <?php if (isset($error)): ?>
                                <div class="alert alert-danger"><?php echo $error; ?></div>
                            <?php endif; ?>
                            <div class="text-center">
                            <button type="submit" class="btn btn-primary">Verificar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        
        <script>
            $(document).ready(function() {
                // Inicialização do modal Bootstrap
                $('#captchaModal').modal({
                    backdrop: 'static',
                    keyboard: false
                });

                // Exibe o modal
                $('#captchaModal').modal('show'); });
                <?php endif; ?>
                <?php if ($_SESSION['captcha_verified'] == true) : ?>
        <script>
            document.getElementById("mainContent").classList.remove("blur");
        </script>
            <?php
            $_SESSION['captcha_verified'] = false;
            ?>

            <?php endif; ?>
        </script>
        
    </body>
    <!---->
    <footer>
        <p class="d-none d-xl-inline d-print-inline">Desenvolvido pela Equipe do CEPAG</p>
        <p class="d-none d-xl-inline d-print-inline">Sala CT17 - Edifício Camil Gemael</p>
        <a href="mailto:cepag@ufpr.br" class="footer-link">
            <i class="fas fa-envelope" id="icon"></i>
            <span class="d-none d-xl-inline d-print-inline">cepag@ufpr.br</span>
        </a>
        <a href="tel:55 41 3361-3498" class="footer-link">
            <i class="fas fa-phone" id="icon"></i>
            <span class="d-none d-xl-inline d-print-inline">55 (41) 3361-3498</span>
        </a>
        <a href="https://www.facebook.com/cepagufpr/" target="_blank" class="footer-link facebook">
            <i class="fa-brands fa-facebook" id="icon"></i>
        </a>
        <a href="https://www.instagram.com/cepag_ufpr" target="_blank" class="footer-link instagram">
            <i class="fa-brands fa-instagram" id="icon"></i>
        </a>
    </footer>
</html>
