<?php
// Inclua o arquivo de conexão
include 'database.php';

function busca_ponto($identificacao, $conn) {
    // Sanitize a entrada para evitar injeção de SQL
    $identificacao = htmlspecialchars($identificacao);

    // Consulta SQL usando uma declaração preparada para evitar injeção de SQL
    $sql = "SELECT * FROM rede_topografica_pontos WHERE identificacao = :identificacao";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':identificacao', $identificacao, PDO::PARAM_STR);
    $stmt->execute();

    // Obtém os resultados
    $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Retorna os resultados
    return $resultados;
}

function busca_ponto_periodo($identificacao, $periodo, $conn) {
    // Sanitize a entrada para evitar injeção de SQL
    $identificacao = htmlspecialchars($identificacao);

    // Consulta SQL usando uma declaração preparada para evitar injeção de SQL
    $sql = "SELECT * FROM rede_topografica_pontos WHERE identificacao = :identificacao AND periodo = :periodo";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':identificacao', $identificacao, PDO::PARAM_STR);
    $stmt->bindParam(':periodo', $periodo, PDO::PARAM_STR);
    $stmt->execute();

    // Obtém os resultados
    $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Retorna os resultados
    return $resultados;
}

function generateCaptcha($width = 200, $height = 50, $length = 6) {
    $image = imagecreate($width, $height);

    // Cores
    $backgroundColor = imagecolorallocate($image, 255, 255, 255); // branco
    $textColor = imagecolorallocate($image, 0, 0, 0); // preto
    $lineColor = imagecolorallocate($image, 64, 64, 64); // cinza

    // Preencher o fundo
    imagefilledrectangle($image, 0, 0, $width, $height, $backgroundColor);

    // Adicionar linhas aleatórias para o ruído
    for ($i = 0; $i < 5; $i++) {
        imageline($image, 0, rand() % $height, $width, rand() % $height, $lineColor);
    }

    // Gerar o texto do CAPTCHA
    $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
    $text = '';
    for ($i = 0; $i < $length; $i++) {
        $text .= $characters[rand(0, strlen($characters) - 1)];
    }

    // Armazenar o texto do CAPTCHA na sessão
    session_start();
    $_SESSION['captcha'] = $text;

    // Caminho para a fonte
    $fontPath = __DIR__ . '/nunito.ttf';

    // Verificar se a fonte existe
    if (!file_exists($fontPath)) {
        die('Erro: Fonte não encontrada.');
    }

    // Adicionar o texto à imagem
    $fontSize = $height * 0.65;
    $x = 10;
    $y = $height * 0.7;

    // Verificar se imagettftext retorna false
    if (imagettftext($image, $fontSize, 0, $x, $y, $textColor, $fontPath, $text) === false) {
        die('Erro: Não foi possível renderizar o texto.');
    }

    // Exibir a imagem
    header('Content-Type: image/png');
    imagepng($image);
    imagedestroy($image);
}

?>
