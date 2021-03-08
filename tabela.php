<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "registro";

$conn = mysqli_connect($servername, $username, $password, $dbname);

//Receber a requisão da pesquisa 
$requestData= $_REQUEST;


//Indice da coluna na tabela visualizar resultado => nome da coluna no banco de dados
$columns = array( 
	0 =>'placa', 
	1 => 'data',
	2 => 'imagem',
	3 => 'modelo',
	4 => 'cor',
	5 => 'uf',
	6 => 'municipio'
);

//Obtendo registros de número total sem qualquer pesquisa
$result_user = "SELECT placa, data, imagem, modelo, cor, uf, municipio FROM dados";

$resultado_user =mysqli_query($conn, $result_user);
$qnt_linhas = mysqli_num_rows($resultado_user);

//Obter os dados a serem apresentados
$result_usuarios = "SELECT placa, data, imagem, modelo, cor, uf, municipio FROM dados WHERE 1=1";
if( !empty($requestData['search']['value']) ) {   // se houver um parâmetro de pesquisa, $requestData['search']['value'] contém o parâmetro de pesquisa
	$result_usuarios.=" AND ( placa LIKE '".$requestData['search']['value']."%' ";    
	$result_usuarios.=" OR data LIKE '".$requestData['search']['value']."%' ";
	$result_usuarios.=" OR imagem LIKE '".$requestData['search']['value']."%' )";
	$result_usuarios.=" OR modelo LIKE '".$requestData['search']['value']."%' ";
	$result_usuarios.=" OR cor LIKE '".$requestData['search']['value']."%' ";
	$result_usuarios.=" OR uf LIKE '".$requestData['search']['value']."%' ";
	$result_usuarios.=" OR municipio LIKE '".$requestData['search']['value']."%' ";

}

$resultado_usuarios=mysqli_query($conn, $result_usuarios);
$totalFiltered = mysqli_num_rows($resultado_usuarios);
//Ordenar o resultado
$result_usuarios.=" ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']."  LIMIT ".$requestData['start']." ,".$requestData['length']."   ";
$resultado_usuarios=mysqli_query($conn, $result_usuarios);

// Ler e criar o array de dados
$dados = array();
while( $row_usuarios =mysqli_fetch_array($resultado_usuarios) ) {  
	$dado = array(); 
	$dado[] = $row_usuarios["placa"];
    $dado[] = $row_usuarios["data"];
	$dado[] = '<img src="data:image/jpg;base64,' . $row_usuarios["imagem"]. '" height="100" onMouseOver="aumenta(this)" onMouseOut="diminui(this)"/>';		
	$dado[] = $row_usuarios["modelo"];
	$dado[] = $row_usuarios["cor"];
	$dado[] = $row_usuarios["uf"];
	$dado[] = $row_usuarios["municipio"];
	$dados[] = $dado;
}

//Cria o array de informações a serem retornadas para o Javascript
$json_data = array(
	"draw" => intval( $requestData['draw'] ),//para cada requisição é enviado um número como parâmetro
	"recordsTotal" => intval( $qnt_linhas ),  //Quantidade de registros que há no banco de dados
	"recordsFiltered" => intval( $totalFiltered ), //Total de registros quando houver pesquisa
	"data" => $dados   //Array de dados completo dos dados retornados da tabela 
);

echo json_encode($json_data);  //enviar dados como formato json
