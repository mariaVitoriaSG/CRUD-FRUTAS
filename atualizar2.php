<div class="container"><?php
    include 'db.php';
    if (!isset($_GET['id'])) {
        header('Location: listar2.php');
        exit;
    }
    $id = $_GET['id'];

    $stmt = $pdo->prepare('SELECT * FROM cliente WHERE id =? ');
    $stmt->execute([$id]);
    $appointment = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$appointment) {
        header('Location: listar2.php');
        exit;
    }
    $nome = $appointment['nome'];
    $email = $appointment['email'];
    $telefone = $appointment['telefone'];
    $data = $appointment['data'];
    ?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styl.css">
            <title>Atualizar Cadastro</title>
</head>
<body style="background-color:rgb(88, 138, 135)">

    <h1>Atualizar Cadastro</h1>
    <form method="post">
        <label for="nome">Nome:</label>
        <input type="text" name="nome" value="<?php echo $nome; ?>" required><br>
        
        <label for="email">Email:</label>
        <input type="email" name="email" value="<?php echo $email; ?>" required><br>
        
        <label for="telefone">Telefone:</label>
        <input type="tel" name="telefone" value="<?php echo $telefone; ?>" required><br>
        
        <label for="data">Data:</label>
        <input type="date" name="data" value="<?php echo $data; ?>" required><br>

        <button type="submit">Atualizar</button>
    </div>
</form>
</body>

</html>
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $telefone = $_POST['telefone'];
    $data = $_POST['data'];


$stmt = $pdo->prepare('UPDATE cliente SET nome = ?, email = ?, telefone = ?, data = ? WHERE id = ?');
$stmt->execute([$nome,$email,$telefone,$data,$id]);
header('Location: listar2.php');
exit;
}
?>


