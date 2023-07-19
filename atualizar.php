<?php
// Configuração para a conexão com o banco de dados MySQL
$host = "localhost"; // Endereço do servidor do banco de dados (normalmente "localhost")
$user = "root"; // Nome de usuário do banco de dados (pode ser diferente dependendo da configuração)
$senha = ""; // Senha do banco de dados (normalmente vazia para ambiente de desenvolvimento local)
$database = "sistema"; // Nome do banco de dados a ser utilizado

// Conecta ao banco de dados usando as informações de configuração acima
$conn = mysqli_connect($host, $user, $senha, $database) or die("Erro de conexão");

// Verifica se o formulário foi submetido (o botão "Enviar" foi clicado)
if (isset($_POST['atualizar'])) {
    // Coleta os valores enviados através do formulário
    $nome = $_POST['nome']; // Recebe o valor do campo "nome" do formulário
    $user = $_POST['user']; // Recebe o valor do campo "user" do formulário
    $password = $_POST['password']; // Recebe o valor do campo "password" do formulário
    $nivel = $_POST['nivel']; // Recebe o valor do campo "nivel" do formulário
    $id = $_POST['atualizar']; //Recebe o valor do campo "id" do formulário

    // Executa a consulta SQL para inserir os dados na tabela "usuarios"
    // Note que esta consulta está vulnerável a ataques de SQL injection, pois os valores do formulário são inseridos diretamente na consulta.
    $query = mysqli_query($conn, "UPDATE usuarios SET nome='$nome', user='$user', senha='$password', nivel='$nivel' WHERE id='$id'");

    if ($query) {
        echo "Update realizado com Sucesso!";
        // Redireciona o usuário para a página de usuários após a atualização
        header("Location: usuarios.php");
        exit; // Encerra a execução do script para garantir que o redirecionamento ocorra
    } else {
        echo "Não foi possível atualizar...";
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

    <?php 
    
    if(isset($_GET['id'])){
        $id = $_GET['id'];
        $result = mysqli_query($conn, "SELECT * FROM usuarios WHERE id='$id'");
        
        // Verifica se a consulta foi executada corretamente
        if($result === false) {
            echo "Erro na consulta: " . mysqli_error($conn);
        } else {
            // Verifica se a consulta retornou algum resultado
            if(mysqli_num_rows($result) > 0) {
                foreach ($result as $linha){
                    // Resto do código para exibir o formulário com os dados do usuário
                }
            } else {
                echo "Usuário não encontrado.";
            }
     
    


    ?>

    <main>  
        <h1>Sistema de Cadastro PHP - MySql</h1>
        <form action="<?=$_SERVER['PHP_SELF']?>" method="post">
            <label for="name">Name:</label>
            <input type="text" value="<?php echo $linha['nome'];?>" name="nome" id="nome">
            <label for="user">User:</label>
            <input type="text" value="<?php echo $linha['user'];?>" name="user" id="user">
            <label for="password">Password:</label>
            <input type="password" value="<?php echo $linha['senha'];?>" name="password" id="password">

            <label for="nivel">Nível:</label>
            <select name="nivel" id="nivel">
                <option <?php if($linha['nivel']=="user"){echo'SELECTED';}?> value="user">User</option>
                <option <?php if($linha['nivel']=="admin"){echo'SELECTED';}?> value="admin">Admin</option>
            </select>
            
        <button name="atualizar" value="<?php echo $id; ?>" type="submit">Atualizar</button></a>
        </form>
        <a href="usuarios.php"><button>Usuários</button>

        <?php 
        
            }
            }
        ?>

    </main>
</body>
</html>
