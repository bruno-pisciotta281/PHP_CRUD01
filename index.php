<?php
// Configuração para a conexão com o banco de dados MySQL
$host = "localhost"; // Endereço do servidor do banco de dados (normalmente "localhost")
$user = "root"; // Nome de usuário do banco de dados (pode ser diferente dependendo da configuração)
$senha = ""; // Senha do banco de dados (normalmente vazia para ambiente de desenvolvimento local)
$database = "sistema"; // Nome do banco de dados a ser utilizado

// Conecta ao banco de dados usando as informações de configuração acima
$conn = mysqli_connect($host, $user, $senha, $database) or die("Erro de conexão");

// Verifica se o formulário foi submetido (o botão "Enviar" foi clicado)
if (isset($_POST['cadastrar'])) {
    // Coleta os valores enviados através do formulário
    $nome = $_POST['nome']; // Recebe o valor do campo "nome" do formulário
    $user = $_POST['user']; // Recebe o valor do campo "user" do formulário
    $password = $_POST['password']; // Recebe o valor do campo "password" do formulário
    $nivel = $_POST['nivel']; // Recebe o valor do campo "nivel" do formulário

    // Executa a consulta SQL para inserir os dados na tabela "usuarios"
    // Note que esta consulta está vulnerável a ataques de SQL injection, pois os valores do formulário são inseridos diretamente na consulta.
    $query = mysqli_query($conn, "INSERT INTO usuarios (nome, user, senha, nivel) VALUES ('$nome', '$user', '$password', '$nivel')");

    // Verifica se a consulta foi executada com sucesso ou não
    if ($query) {
        echo '<script>alert("Usuário cadastrado com sucesso");</script>';
    } else {
        echo '<script>alert("Não foi possível cadastrar...")</script>';
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Sistema de Cadastro</title>
</head>
<body>
    <main>
        <h1>Sistema de Cadastro PHP - MySql</h1>
        <form action="<?=$_SERVER['PHP_SELF']?>" method="post">
            <label for="name">Name:</label>
            <input type="text" name="nome" id="nome">
            <label for="user">User:</label>
            <input type="text" name="user" id="user">
            <label for="password">Password:</label>
            <input type="password" name="password" id="password">

            <label for="nivel">Nível:</label>
            <select name="nivel" id="nivel">
                <option value="user">User</option>
                <option value="admin">Admin</option>
            </select>
            
            <button name="cadastrar" type="submit">Cadastrar</button>
        </form>
        <a href="usuarios.php"><button>Usuários</button></a>
    </main>
</body>
</html>
