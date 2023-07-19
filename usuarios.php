<?php 

// Configuração para a conexão com o banco de dados MySQL
$host = "localhost"; // Endereço do servidor do banco de dados (normalmente "localhost")
$user = "root"; // Nome de usuário do banco de dados (pode ser diferente dependendo da configuração)
$senha = ""; // Senha do banco de dados (normalmente vazia para ambiente de desenvolvimento local)
$database = "sistema"; // Nome do banco de dados a ser utilizado

// Conecta ao banco de dados usando as informações de configuração acima
$conn = mysqli_connect($host, $user, $senha, $database) or die("Erro de conexão");

if(isset($_GET['id'])){
    $id = $_GET['id'];
    $excluir = mysqli_query($conn, "DELETE FROM usuarios WHERE id='$id'");
}

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Usuários</title>
</head>
<body>
    <main>
        <h1>Usuários</h1>
        <table>
            <thead>
                <tr><th>#id</th><th>Nome</th><th>User</th><th>Acesso</th><th>Editar</th></tr>
                <tbody>
                    
                    <?php 
                    
                        $resultado = mysqli_query($conn, "SELECT * FROM usuarios");
                        while ($linha = mysqli_fetch_array($resultado)){
                    ?>

                    <tr><td><?php echo $linha['id'];?></td><td><?php echo $linha['nome'];?></td><td><?php echo $linha['user'];?></td><td><?php echo $linha['nivel'];?></td><td><a href="atualizar.php?id=<?php echo $linha ['id'];?>">Editar</a> <a href="?id=<?php echo $linha ['id'];?>">Excluir</a></td></tr>
                    <?php } ?>
                </tbody>
            </thead>
        </table>
        <a href="index.php"><button>Voltar</button></a>
    </main>
</body>
</html>