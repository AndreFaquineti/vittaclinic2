<?php session_start();?>
<!DOCTYPE html>
<html lang="eng">
<meta charset="UTF-8">
<head>
    <title>Entrar</title>
</head>
<body>
    <p><a href="/vittaclinic2/index.php"><h1>Vitta.Clinic</h1></a></p>
    <p>Usuário: * Tipo: *</p>
    <p><h2>Entrar</h2></p>
    <p>Nessa página o usuario deve poder fazer login.</p>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        Email: <input type="email"> <br>
        Senha: <input type="password"> <br>
        <input type="submit">
    </form>
    <p><a href="/vittaclinic2/paginas/comum/registro.php">Registrar</a></p>
</body>
</html>