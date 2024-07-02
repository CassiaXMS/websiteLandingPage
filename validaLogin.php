<?php
$servername = "localhost";
$username = 'root';
$password = '';
$dbname =  "landing_page";

// Criando a conexão
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificando a conexão
if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}

// Obtém os dados do formulário de login
$email = $_POST['email'];
$senha = $_POST['senha'];

// Consulta para verificar se o usuário existe
$stmt = $conn->prepare("SELECT id_user, senha FROM login WHERE email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows > 0) {
    // Usuário encontrado, verificar a senha
    $stmt->bind_result($id_user, $hashed_password);
    $stmt->fetch();
    
    if (password_verify($senha, $hashed_password)) {
        // Senha correta, login bem-sucedido
        
        echo '<script>location.href = "logout.html";</script>';
        // Aqui você pode redirecionar ou fazer qualquer outra ação após o login
    } else {
        // Senha incorreta
        print "<script>alert('Senha e/ou email incorretos, tente novamente!')</script>";
        echo '<script>location.href = "login.html";</script>';
        
    }
} else {
    // Usuário não encontrado
    print "<script>alert('Usuário não encontrado')</script>";
    echo '<script>location.href = "login.html";</script>';
}

// Fecha a conexão
$stmt->close();
$conn->close();
?>
