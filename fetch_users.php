<?php
// Configuração do banco de dados
$servername = "localhost";
$username = "root"; // Nome de usuário padrão do XAMPP
$password = ""; // Senha padrão do XAMPP
$dbname = "crud_db";

// Cria conexão com o banco de dados
$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica a conexão
if ($conn->connect_error) {
    die("Erro de conexão: " . $conn->connect_error);
}

// Busca todos os usuários na tabela usuarios
$sql = "SELECT * FROM usuarios";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Exibe os usuários em uma tabela HTML com botões de editar e excluir
    echo "<table>";
    echo "<tr><th>Nome</th><th>Email</th><th>Telefone</th><th>Ações</th></tr>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row['nome'] . "</td>";
        echo "<td>" . $row['email'] . "</td>";
        echo "<td>" . $row['telefone'] . "</td>";
        echo "<td> <button onclick='deleteUser(" . $row['id'] . ")'>Excluir</button></td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "Nenhum usuário cadastrado.";
}

// Fecha a conexão com o banco de dados
$conn->close();

?>
