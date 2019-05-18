<?php
//fetch.php
$connect = include('localhost', 'casasen3_bim', 'casasenventamorelosbim..11', 'casasen3_casasbim', 3306);
$request = mysqli_real_escape_string($connect, $_POST["query"]);
$query = "SELECT * FROM CIUDAD WHERE Nombre LIKE '%".$request."%'";

$result = mysqli_query($connect, $query);

$data = array();

if(mysqli_num_rows($result) > 0)
{
 while($row = mysqli_fetch_assoc($result))
 {
  $data[] = $row["Nombre"];
 }
 echo json_encode($data);
}

?>
