<?php
$host = "127.0.0.1";
$user = "root"; 
$password = "";
$database = "lixo3";

$conn = new mysqli($host, $user, $password, $database);

if ($conn->connect_error) {
    die("❌ Erro: " . $conn->connect_error);
}

echo "🎉 CONECTADO AO BANCO 'lixo3'!<br>";

// Ver tabelas
$result = $conn->query("SHOW TABLES");
echo "<h3>📊 Tabelas no banco 'lixo3':</h3>";
while($row = $result->fetch_array()) {
    echo "• " . $row[0] . "<br>";
}

// Ver dados de exemplo
echo "<h3>📖 Primeiros livros:</h3>";
$livros = $conn->query("SELECT * FROM Livros LIMIT 5");
while($livro = $livros->fetch_assoc()) {
    echo "📚 " . $livro['titulo'] . " - " . $livro['autor'] . "<br>";
}

$conn->close();
?>