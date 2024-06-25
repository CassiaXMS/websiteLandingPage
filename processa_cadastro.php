<?php
$servername = "localhost";
$username = 'root';
$password = '';
$dbname =  "landing_page";


echo "Username: " . $username . "<br>";
echo "Password: " . ($password === "" ? "empty" : $password) . "<br>";
echo "Servername: " . $servername . "<br>";
echo "Database: " . $dbname . "<br>";



//criando a conexão
$conn = new mysqli($servername, $username, $password, $dbname);
//processa_cadastro.php
//verifificando a conexão

if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}

// Obtém os dados do formulário
$nome = $_POST['nome'];
$sobrenome = $_POST['sobrenome'];
$email = $_POST['email'];
$senha = password_hash($_POST['senha'], PASSWORD_DEFAULT);

$conn->begin_transaction();

try {
// Insere dados na tabela `cadastro`
$stmt = $conn->prepare("INSERT INTO cadastro (nome, sobrenome, email) VALUES (?, ?, ?)");
$stmt->bind_param("sss", $nome, $sobrenome, $email);
$stmt->execute();
$id_user = $stmt->insert_id; // Obtém o ID inserido

// Insere dados na tabela `login`
$stmt = $conn->prepare("INSERT INTO login (id_user, username, password) VALUES (?, ?, ?)");
$stmt->bind_param("iss", $id_user, $email, $senha);
$stmt->execute();

// Confirma a transação
$conn->commit();
if ($stmt->execute()) {
    // Mensagem de sucesso com Bootstrap
    echo '<div class="alert alert-success" role="alert">Cadastro realizado com sucesso!</div>';

    // JavaScript para redirecionar após 3 segundos
    echo '<script>
            setTimeout(function() {
                window.location.href = "index.html";
            }, 2); 
          </script>';
} else {
    echo "Erro: " . $stmt->error;
}
} catch (Exception $e) {
// Reverte a transação em caso de erro
$conn->rollback();
echo "Erro: " . $e->getMessage();
}

// Fecha a conexão
$conn->close();

?>