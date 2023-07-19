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
    // Verifica se o parâmetro 'id' está presente na URL (por exemplo, usuarios.php?id=123)
    if(isset($_GET['id'])){
        $id = $_GET['id']; // Obtém o valor de 'id' da URL

        // Executa uma consulta SQL para obter os dados do usuário na tabela 'usuarios' com base no 'id' fornecido
        $result = mysqli_query($conn, "SELECT * FROM usuarios WHERE id='$id'");
        
        // Verifica se a consulta SQL foi executada com sucesso
        if($result === false) {
            echo "Erro na consulta: " . mysqli_error($conn); // Exibe uma mensagem de erro caso a consulta falhe
        } else {
            // Verifica se a consulta retornou algum resultado (dados do usuário)
            if(mysqli_num_rows($result) > 0) {
                // Se houver dados do usuário, entra em um loop para obter cada linha de dados (embora o loop esteja incorreto, deveria ser substituído conforme mencionado antes)
                foreach ($result as $linha){
                    // O restante do código incluiria a exibição do formulário com os dados do usuário para atualização.
                    // Nota: O uso de 'foreach' aqui está incorreto. Deveria ser substituído por 'mysqli_fetch_assoc()' ou algo similar para obter uma única linha.
                }
            } else {
                echo "Usuário não encontrado."; // Se nenhum usuário for encontrado com o 'id' fornecido, exibe uma mensagem indicando que o usuário não foi encontrado.
            }
        }
    }
?>

<main>  
    <!-- O elemento <main> é usado para conter o conteúdo principal da página. -->
    <h1>Sistema de Cadastro PHP - MySql</h1>
    <!-- Um título de nível 1 (h1) que informa o nome do sistema. -->
    <form action="<?=$_SERVER['PHP_SELF']?>" method="post">
        <!-- Um formulário que envia dados para a própria página (action="<?=$_SERVER['PHP_SELF']?>") usando o método POST. -->
        <label for="name">Name:</label>
        <!-- Uma etiqueta para o campo de entrada de nome. -->
        <input type="text" value="<?php echo $linha['nome'];?>" name="nome" id="nome">
        <!-- Um campo de entrada de texto para inserir o nome. O valor é preenchido com o nome do usuário obtido anteriormente ($linha['nome']). -->
        <label for="user">User:</label>
        <!-- Uma etiqueta para o campo de entrada de usuário. -->
        <input type="text" value="<?php echo $linha['user'];?>" name="user" id="user">
        <!-- Um campo de entrada de texto para inserir o nome de usuário. O valor é preenchido com o usuário do usuário obtido anteriormente ($linha['user']). -->
        <label for="password">Password:</label>
        <!-- Uma etiqueta para o campo de entrada de senha. -->
        <input type="password" value="<?php echo $linha['senha'];?>" name="password" id="password">
        <!-- Um campo de entrada de senha para inserir a senha do usuário. O valor é preenchido com a senha do usuário obtido anteriormente ($linha['senha']). -->

        <label for="nivel">Nível:</label>
        <!-- Uma etiqueta para o campo de seleção de nível. -->
        <select name="nivel" id="nivel">
            <!-- Um elemento de seleção (dropdown) que permite ao usuário escolher o nível de acesso. -->
            <option <?php if($linha['nivel']=="user"){echo'SELECTED';}?> value="user">User</option>
            <!-- Uma opção para o nível de usuário. Se o nível do usuário for "user", essa opção é selecionada (através do atributo "SELECTED"). -->
            <option <?php if($linha['nivel']=="admin"){echo'SELECTED';}?> value="admin">Admin</option>
            <!-- Uma opção para o nível de administrador. Se o nível do usuário for "admin", essa opção é selecionada (através do atributo "SELECTED"). -->
        </select>
        
        <button name="atualizar" value="<?php echo $id; ?>" type="submit">Atualizar</button></a>
        <!-- Um botão com o nome "atualizar" e valor igual ao ID do usuário. Quando o botão é clicado, o formulário é enviado para atualizar os dados do usuário. -->
    </form>
    <a href="usuarios.php"><button>Usuários</button>
    <!-- Um botão que redireciona o usuário para a página "usuarios.php" que lista todos os usuários. -->
</main>
</body>
</html>
