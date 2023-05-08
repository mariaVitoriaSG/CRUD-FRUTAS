<div class="container"><?php
include 'db.php';

if (!isset($_GET['id'])) {
    header('Location: listar.php');
    exit;
}

$id = $_GET['id'];
$stmt = $pdo->prepare('SELECT *FROM produtos WHERE id = ?');
$stmt->execute([$id]);
$appointment = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$appointment) {
    header('Location: listar.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $stmt = $pdo->prepare('DELETE FROM produtos WHERE id = ?');
    $stmt->execute([$id]);

    header('Location: listar.php');
    exit;
}

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styl.css">
    <title>Cliente</title>
</head>
<body style="background-color:rgb(88, 138, 135)">
    <title>Cancelar Compra</title>
</head>
<body >
    <h1>Cancelar Compra</h1>
    <p>Tem certeza que deseja cancelar sua a compra de
    <?php echo $appointment['nome']; ?>?</p>
    <form method="post">
        <button type="submit">Sim</button>
        <a href="listar.php">Não</a>
</form>        
</body>
</html>