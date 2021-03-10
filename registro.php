<?php
    session_start();
    if((!isset ($_SESSION['usuario']) == true) and (!isset ($_SESSION['senha']) == true)){
        unset($_SESSION['login']);
        unset($_SESSION['senha']);
        header('location:index.php');
    }
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <title>Registros</title>
    <link rel="stylesheet" href="https://getbootstrap.com/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
    <link rel="stylesheet"  href="css/estiloPrincipal.css">
    <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
	<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" language="javascript">
        $(document).ready(function() {
			$('#id_tabela').DataTable({
				"language": {
                      "lengthMenu": "Mostrando _MENU_ registros por página",
                      "zeroRecords": "Nada encontrado",
                      "info": "Mostrando página _PAGE_ de _PAGES_",
                      "infoEmpty": "Nenhum registro disponível",
                      "infoFiltered": "(filtrado de _MAX_ registros no total)",
                      "sSearch": "Pesquisar",
                      "oPaginate": {
                        "sNext": "Próximo",
                        "sPrevious": "Anterior",
                        "sFirst": "Primeiro",
                        "sLast": "Último"
                    },                       
                  },			
				    "processing": true,
				    "serverSide": true,
				    "ajax": {
					    "url": "tabela.php",
					    "type": "POST"
				    }
			});
		} );
        </script>
        <script language="javascript">
            function aumenta(obj){
                obj.height=obj.height*2;
	            obj.width=obj.width*2;
            }
 
            function diminui(obj){
	            obj.height=obj.height/2;
	            obj.width=obj.width/2;
            }
        </script>
</head>
<nav class="navbar navbar-light navbar-expand-md navigation-clean">
    <div class="container">
        <div class="collapse navbar-collapse" id="navcol-1">
            <a class="navbar-brand">Registros</a>
        </div>
      <ul class="nav navbar-nav">
        <li><input type="submit" value="SAIR" class="sair" onclick="location.href='sair.php'"/></li>
      </ul>
    </div>
</nav>
<body>
        <table id="id_tabela" class="display" style="width:100%">
			<thead>
				<tr>
					<th>Placa</th>
					<th>Data</th>
					<th>Imagem</th>
				</tr>
			</thead>
		</table>
</body>
    
</html>