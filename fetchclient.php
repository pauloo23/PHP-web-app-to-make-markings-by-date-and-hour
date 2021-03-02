<?php
$db_host = "localhost";
$db_user = "root";
$db_password = "";
$db_name = "cabeleireiro";


//fetch.php
$connect = mysqli_connect($db_host, $db_user, $db_password, $db_name);
$outputclient = '';

if (isset($_POST["query"])) {
    $searchclient = mysqli_real_escape_string($connect, $_POST["query"]);
    $upper = ucfirst($searchclient);
    $query = "
SELECT * FROM technician_tb
  WHERE empName LIKE '%" . $searchclient . "%'
  OR empMobile LIKE '%" . $searchclient . "%'
  OR empName LIKE '%" . $upper . "%'
 ";
} else {
    $query = "    SELECT * FROM technician_tb";
}
$resultclient = mysqli_query($connect, $query);
if (mysqli_num_rows($resultclient) > 0) {
    $outputclient .= '

  <div style="overflow-x:auto;"> <table class="content-table">
  <thead>
   <tr>
    <th scope="col">Identificador Cliente</th>
    <th scope="col">Nome</th>
    <th scope="col">Número Telemóvel</th>
    <th scope="col">Email</th>
    <th scope="col">Ação</th>
   </tr>     </thead>
 ';
while ($row = mysqli_fetch_array($resultclient)) { $outputclient .= '
   <tr>      <td>' . $row["empid"] . '</td>
         <td>' . $row["empName"] . '</td>
    <td>' . $row["empMobile"] . '</td>      <td>' . $row["empEmail"] . '</td>
    <td><form action="editemp.php" method="POST" class="d-inline"> <input type="hidden" name="id" value='. $row["empid"] .'><button type="submit" class="btn btn-info mr-3" name="view" value="View"><i class="fas fa-pen"></i></button></form>  <form action="" method="POST" class="d-inline"><input type="hidden" name="id" value='. $row["empid"] .'><button type="submit" class="btn btn-secondary" name="delete" value="Delete"><i class="far fa-trash-alt"></i></button></form></td>
   </tr>';
  }

 echo $outputclient;
} else {
  echo "Nenhum dado encontrado!";
}
?>
