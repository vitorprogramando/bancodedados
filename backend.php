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

// Se o formulário for enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $telefone = $_POST['telefone'];

    if (empty($_POST['userId'])) {
        // Se o ID do usuário não estiver definido, insira os dados na tabela usuarios
        $sql = "INSERT INTO usuarios (nome, email, telefone) VALUES ('$nome', '$email', '$telefone')";
    } else {
        // Se o ID do usuário estiver definido, atualize os dados na tabela usuarios
        $id = $_POST['userId'];
        $sql = "UPDATE usuarios SET nome='$nome', email='$email', telefone='$telefone' WHERE id=$id";
    }

    if ($conn->query($sql) === TRUE) {
        echo "Informações salvas com sucesso!";
    } else {
        echo "Erro ao salvar informações: " . $conn->error;
    }
}

// Se o ID do usuário para exclusão for enviado
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['delete'])) {
    $id = $_GET['delete'];

    // Exclua o usuário com o ID especificado
    $sql = "DELETE FROM usuarios WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        echo "Informações excluídas com sucesso!";
    } else {
        echo "Erro ao excluir informações: " . $conn->error;
    }
}

// Fecha a conexão com o banco de dados
$conn->close();
?>
