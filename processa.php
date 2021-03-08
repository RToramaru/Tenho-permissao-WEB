<?php
    session_start(); 
    include_once("conexao.php");
    if((isset($_POST['usuario'])) && (isset($_POST['senha']))){
		$usuario = $_POST['usuario'];
        $senha = $_POST['senha'];
        $result_usuario = "SELECT * FROM acesso WHERE usuario = '$usuario' && senha = '$senha' LIMIT 1";
        $resultado_usuario = mysqli_query($conn, $result_usuario);
		$resultado = mysqli_fetch_assoc($resultado_usuario);
        if(isset($resultado)){
			$_SESSION['usuario'] = $resultado['usuario'];
            $_SESSION['senha'] = $resultado['senha'];
            header("Location: registro.php");
        }else{    
            $_SESSION['loginErro'] = "Usuário ou senha Inválido";
            header("Location: index.php");
        }
    }else{
        $_SESSION['loginErro'] = "Usuário ou senha inválido";
        header("Location: index.php");
    }
?>