<?php
$db_host = "localhost";
$db_user = "root";
$db_password = "";
$db_name = "cabeleireiro";


//fetch.php
$connect = mysqli_connect($db_host, $db_user, $db_password, $db_name);
$outputwork = '';

if (isset($_POST["query"])) {
    $searchwork = mysqli_real_escape_string($connect, $_POST["query"]);
    $upper = ucfirst($searchwork);
    $date = date("Y-m-d");

    $query = "
SELECT ADDTIME(requester_hour,SEC_TO_TIME(requester_duration*60)), request_id,request_info,request_desc,requester_name,requester_hour,requester_mobile,request_state,assign_date FROM assignwork_tb
  WHERE requester_name LIKE '%" . $searchwork . "%'  AND request_state='0' AND assign_date LIKE '%" . $date . "%'
  OR requester_mobile LIKE '%" . $searchwork . "%' AND request_state='0' AND assign_date LIKE '%" . $date . "%'
  OR request_info LIKE '%" . $searchwork . "%' AND request_state='0' AND assign_date LIKE '%" . $date . "%'
  OR requester_name LIKE '%" . $upper . "%'AND request_state='0' AND assign_date LIKE '%" . $date . "%'
  OR request_info LIKE '%" . $upper . "%' AND request_state='0' AND assign_date LIKE '%" . $date . "%'
 ORDER BY assign_date,
  requester_hour";
} else {
    $date = date("Y-m-d");
    $query = "
SELECT ADDTIME(requester_hour,SEC_TO_TIME(requester_duration*60)), request_id,request_info,request_desc,requester_name,requester_hour,requester_mobile,request_state,assign_date FROM assignwork_tb  WHERE assign_date LIKE '%" . $date . "%' AND request_state='0'   ORDER BY assign_date, requester_hour
 ";
}
$resultwork = mysqli_query($connect, $query);
if (mysqli_num_rows($resultwork) > 0) {
    $outputwork .= '

  <div style="overflow-x:auto;">
 <table class="content-table">   <thead>
    <tr>
     <th>Tipo Trabalho</th>
     <th>Descrição Trabalho</th>
     <th>Nome</th>
     <th>Número Telemóvel</th>
     <th>Data</th>
     <th>Hora Inicio</th>
     <th>Hora Fim</th>
     <th>Ação</th>         <th></th>
          <th></th>
    </tr>      </thead>
   
 ';
    while ($row = mysqli_fetch_array($resultwork)) {

        $outputwork .= '
   <tr>
   <td>' . $row["request_info"] . '</td>
    <td>' . $row["request_desc"] . '</td>
    <td>' . $row["requester_name"] . '</td>
     <td>' . $row["requester_mobile"] . '</td>
    <td>' . $row["assign_date"] . '</td>
     <td>' . substr_replace($row["requester_hour"], "", "5") . '</td>
         <td>' . substr_replace($row["ADDTIME(requester_hour,SEC_TO_TIME(requester_duration*60))"], "", "5") . '</td>
     <td><form action="viewassignwork3.php" method="POST" class="d-inline"> <input type="hidden" name="id" value=' . $row["request_id"] . '><button type="submit" class="btn btn-warning" name="view" value="View"><i class="far fa-eye"></i></button></form></td>
    <td><form action="" method="POST" class="d-inline"><input type="hidden" name="id" value=' . $row["request_id"] . '><button type="submit" class="btn btn-secondary" name="delete" value="Delete"><i class="far fa-trash-alt"></i></button></form></td>
    <td><form action="" method="POST" class="d-inline"><input type="hidden" name="id" value=' . $row["request_id"] . '><button style=" color: #1c7430; background-color: #171a1d;" type="submit" class="btn btn-secondary" name="finish" value="Finish"><i class="fa fa-check-circle"></i></button></form></td>
    </td>
   </tr>
   
 
  ';
    }
    echo $outputwork;
} else {
    echo 'Nenhum dado encontrado!';
}

if (isset($_REQUEST['delete'])) {
    $sql = "DELETE FROM assignwork_tb WHERE request_id = {$_REQUEST['id']}";
    if ($connect->query($sql) === TRUE) {
        // echo "Record Deleted Successfully";
        // below code will refresh the page after deleting the record
        echo '<meta http-equiv="refresh" content= "0;URL=?deleted" />';
    } else {
        echo "Unable to Delete Data";
    }
}
if (isset($_REQUEST['finish'])) {
    $sql = "UPDATE assignwork_tb
            SET request_state='1'
            WHERE request_id = {$_REQUEST['id']}";
    if ($connect->query($sql) === TRUE) {
        // echo "Success alteration ";
        // below code will refresh the page after deleting the record
        echo '<meta http-equiv="refresh" content= "0;URL=?deleted" />';
    } else {
        echo "Unable to modify";
    }
}
?>
