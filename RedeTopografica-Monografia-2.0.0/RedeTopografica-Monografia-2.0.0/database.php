<?php
// Configurações do banco de dados
$host = "200.17.248.19"; // Endereço do servidor PostgreSQL
$port = "5432"; // Porta do PostgreSQL
$dbname = "redetopografica"; // Nome do banco de dados
$user = "rede_topografica_adm"; // Nome de usuário do PostgreSQL
$password = "*Topografia*"; // Senha do PostgreSQL

// Conecta ao banco de dados
try {
    $db = new PDO("pgsql:host=$host;port=$port;dbname=$dbname;user=$user;password=$password");
    // Configuração para lançar exceções em caso de erros
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erro na conexão com o banco de dados: " . $e->getMessage());
}
?>
