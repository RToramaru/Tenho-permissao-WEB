<?php
	session_start();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="utf-8">
	<link rel="stylesheet"  href="css/estilo.css">
	<title>Login</title>
</head>
<body>
<div id="corpo-form">
	<h1>Entrar</h1>
	<form method="POST" action = 'processa.php'>
		<input type="text" placeholder="Usuario" name='usuario'>
		<input type="password" placeholder="Senha" name='senha'>
		<input type="submit" value="ACESSAR" class="entrar">
	</form>
</div>
</body>
</html>
