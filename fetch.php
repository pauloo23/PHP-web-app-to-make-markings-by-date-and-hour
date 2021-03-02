<?php
$db_host = "localhost";
$db_user = "root";
$db_password = "";
$db_name = "cabeleireiro";

//fetch.php
$connect = mysqli_connect($db_host, $db_user, $db_password, $db_name);
$output = '';

if (isset($_POST["query"])) {
    $search = mysqli_real_escape_string($connect, $_POST["query"]);
    $upper = ucfirst($search);
    $query = "
  SELECT * FROM assignwork_tb 
  WHERE requester_name LIKE '%" . $search . "%' AND request_state='1'
  OR requester_mobile LIKE '%" . $search . "%' AND request_state='1'
  OR request_info LIKE '%" . $search . "%' AND request_state='1'
   OR requester_name LIKE '%" . $upper . "%' AND request_state='1'
  OR request_info LIKE '%" . $upper . "%' AND request_state='1'
 
 ";
} else {
    $query = "
  SELECT * FROM assignwork_tb WHERE request_state='1'
  ORDER BY request_id
 ";
}
$result = mysqli_query($connect, $query);
if (mysqli_num_rows($result) > 0) {
    $output .= '
  <div style="overflow-x:auto;">
 <table class="content-table">   <thead>
    <tr>
     <th>Tipo Trabalho</th>
     <th>Descrição Trabalho</th>
     <th>Nome</th>
     <th>Número Telemóvel</th>
     <th>Data</th>
     <th>Ação</th>     <th></th>
    </tr>      </thead>
    
 ';
    while ($row = mysqli_fetch_array($result)) {
        $output .= '
   <tr>
    <td>' . $row["request_info"] . '</td>
    <td>' . $row["request_desc"] . '</td>
    <td>' . $row["requester_name"] . '</td>
     <td>' . $row["requester_mobile"] . '</td>
    <td>' . $row["assign_date"] . '</td>
     <td><form action="viewassignwork2.php" method="POST" class="d-inline"> <input type="hidden" name="id" value=' . $row["request_id"] . '><button type="submit" class="btn btn-warning" name="view2" value="View2"><i class="far fa-eye"></i></button></form></td>
    <td><form action="" method="POST" class="d-inline"><input type="hidden" name="id" value=' . $row["request_id"] . '><button type="submit" class="btn btn-secondary" name="delete" value="Delete"><i class="far fa-trash-alt"></i></button></form></td>
   
    </td>
   </tr>
   
 
  ';
    }
    echo $output;
} else {
    echo 'Nenhum dado encontrado!';
}

?>
