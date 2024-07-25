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
    $nome = $conn->real_escape_string($_POST['nome']);
    $idade = $conn->real_escape_string($_POST['idade']);
    $cpf = $conn->real_escape_string($_POST['cpf']);
    $email = $conn->real_escape_string($_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $cnpj = $conn->real_escape_string($_POST['cnpj']);
    $endereco = $conn->real_escape_string($_POST['endereco']);
    $telefone = $conn->real_escape_string($_POST['telefone']);
    $cidade = $conn->real_escape_string($_POST['cidade']);
    $cep = $conn->real_escape_string($_POST['cep']);

    $sql = "INSERT INTO usuarios (nome, idade, cpf, email, senha, cnpj, endereco, telefone, cidade, cep)
            VALUES ('$nome', '$idade', '$cpf', '$email', '$password', '$cnpj', '$endereco', '$telefone', '$cidade', '$cep')";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Usuário registrado com sucesso!');</script>";
        header("Location: index.html"); 
        exit();
    } else {
        echo "<script>alert('Erro ao registrar usuário: " . $conn->error . "');</script>";
    }

    $conn->close();
}
ob_end_flush();
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="styles/registro.css" rel="stylesheet">
    <link href="styles/header.css" rel="stylesheet" type="text/css" />
    <title>Registro</title>
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
            <form class="form" action="registro.php" method="post" id="registroForm">
                <div class="form-columns">
                    <div class="form-column">
                        <span class="input-span">
                            <label for="nome" class="label">Nome</label>
                            <input type="text" name="nome" id="nome" required />
                        </span>
                        <span class="input-span">
                            <label for="idade" class="label">Idade</label>
                            <input type="number" name="idade" id="idade" min="18" max="80" required />
                        </span>
                        <span class="input-span">
                            <label for="cpf" class="label">CPF</label>
                            <input type="text" name="cpf" id="cpf" pattern="\d{3}\.\d{3}\.\d{3}-\d{2}" maxlength="14" required />
                        </span>
                        <span class="input-span">
                            <label for="email" class="label">Email</label>
                            <input type="email" name="email" id="email" required />
                        </span>
                        <span class="input-span">
                            <label for="password" class="label">Senha</label>
                            <input type="password" name="password" id="password" required />
                        </span>
                    </div>
                    <div class="form-column">
                        <span class="input-span">
                            <label for="cnpj" class="label">CNPJ</label>
                            <input type="text" name="cnpj" minlength="12" maxlength="20" id="cnpj" placeholder="00.000.000/0000-00" required>
                        </span>
                        <span class="input-span">
                            <label for="endereco" class="label">Endereço</label>
                            <input type="text" name="endereco" id="endereco" required />
                        </span>
                        <span class="input-span">
                            <label for="telefone" class="label">Telefone</label>
                            <input type="tel" name="telefone" id="telefone" pattern="\(\d{2}\) \d{4,5}-\d{4}" maxlength="15" required />
                        </span>
                        <span class="input-span">
                            <label for="cidade" class="label">Cidade</label>
                            <input type="text" name="cidade" id="cidade" required />
                        </span>
                        <span class="input-span">
                            <label for="cep" class="label">CEP</label>
                            <input type="text" name="cep" id="cep" pattern="\d{5}-\d{3}" maxlength="9" required />
                        </span>
                    </div>
                </div>
                <div class="form-footer">
                    <span class="span"><a href="contato.html">Precisa de ajuda?</a></span>
                    <input class="submit" type="submit" value="Registrar" />
                    <span class="span">Já tem conta? <a href="api/login.php">Login</a></span>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Máscaras de entrada
        document.getElementById('cpf').addEventListener('input', function (e) {
            this.value = this.value
                .replace(/\D/g, '')
                .replace(/(\d{3})(\d)/, '$1.$2')
                .replace(/(\d{3})(\d)/, '$1.$2')
                .replace(/(\d{3})(\d{1,2})$/, '$1-$2');
        });

        document.getElementById('telefone').addEventListener('input', function (e) {
            this.value = this.value
                .replace(/\D/g, '')
                .replace(/(\d{2})(\d)/, '($1) $2')
                .replace(/(\d{4,5})(\d{4})$/, '$1-$2');
        });

        document.getElementById('cep').addEventListener('input', function (e) {
            this.value = this.value
                .replace(/\D/g, '')
                .replace(/(\d{5})(\d)/, '$1-$2');
        });

        document.getElementById('cnpj').addEventListener('input', function (e) {
            this.value = this.value
                .replace(/\D/g, '') 
                .replace(/(\d{2})(\d)/, '$1.$2')
                .replace(/(\d{3})(\d)/, '$1.$2')
                .replace(/(\d{3})(\d{4})$/, '$1/$2')
                .replace(/(\d{4})(\d{2})$/, '$1-$2');
        });
    </script>
</body>
</html>
