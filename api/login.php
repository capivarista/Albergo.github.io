<?php
ob_start();

$host = 'monorail.proxy.rlwy.net';
$user = 'root';    
$pass = 'NYUkrnQGlxlTYlYbsIYonDjvBTrdAPBn';  
$dbname = 'registroDB';    
$port = 19194;

$conn = new mysqli($host, $user, $pass, $dbname, $port);

if ($conn->connect_error) {
    die("Erro de conexão: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $conn->real_escape_string($_POST['email']);
    $password = $_POST['password']; 

    $sql = "SELECT senha FROM usuarios WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('s', $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($hashed_password);
        $stmt->fetch();

        if (password_verify($password, $hashed_password)) {
            setcookie("loggedIn", true, time() + (86400 * 30), "/");
            echo "<script>alert('Login realizado com sucesso!');</script>";
            header("Location: index.html"); 
            exit();
        } else {
            echo "<script>alert('Senha incorreta.');</script>";
        }
    } else {
        echo "<script>alert('Email não encontrado.');</script>";
    }

    $stmt->close();
}

$conn->close();
ob_end_flush(); 
?>


<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="styles/style2.css" rel="stylesheet">
    <link href="styles/header.css" rel="stylesheet" type="text/css" />
    <title>Login</title>
</head>
<body>
    <div class="header">
        <img class="iconMenu" src="imagens/icon.png" onclick="toggleSubMenu()">
        <a href="index.html">
          <img class="iconAlbergo" src="imagens/Albergo (3).png">
        </a>
        <h1 class="albergoNome">ALBERGO</h1>
        <div class="header2">
          <h1 class="headerInfos"><a class="link" href="produto.html">PRODUTO</a></h1>
          <h1 class="headerInfos"><a class="link" href="sobrenos.html">EMPRESA</a></h1>
          <h1 class="headerInfos"><a class="link" href="contato.html">CONTATO</a></h1>
          <h1 class="headerInfos"><a class="link" href="api/login.php">LOGIN</a></h1>
          </div>
      </div>

      <!-- Submenu -->
      <div id="submenu" class="submenu">
        <a href="infoJobs.html">Info jobs</a>
        <a href="sobrenos.html">Sobre nós</a>
        <a href="documentacao.html">Documentações</a>
      </div>

    <div class="container">
        <div class="card">
            <form class="form" action="login.php" method="post">
                <span class="input-span">
                    <label for="email" class="label">Email</label>
                    <input type="email" name="email" id="email" required />
                </span>
                <span class="input-span">
                    <label for="password" class="label">Senha</label>
                    <input type="password" name="password" id="password" required />
                </span>
                <span class="span"><a href="#">Esqueceu a senha?</a></span>
                <input class="submit" type="submit" value="Log in" />
                <span class="span">Não tem conta? <a href="api/registro.php">Registrar</a></span>
            </form>
        </div>
    </div>
</body>
</html>
