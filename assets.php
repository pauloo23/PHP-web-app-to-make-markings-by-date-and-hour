<?phpheader('Content-Type: text/html; charset=utf-8');
session_start();
define('TITLE', 'Inventário');
define('PAGE', 'assets');
include('includes/header.php');
include('includes/dbConnection.php');

 if(isset($_SESSION['is_adminlogin'])){
  $aEmail = $_SESSION['aEmail'];
 } else {
  echo "<script> location.href='login.php'; </script>";
 }
?>
    <div class="content" >
  <!--Table-->
  <p class=" bg-dark text-white p-2">Detalhes de produtos</p>
  <?php
    $sql = "SELECT * FROM assets_tb";
    $result = $conn->query($sql);
    if($result->num_rows > 0){
  echo ' <div style="overflow-x:auto;">
 <table class="content-table">
    <thead>
      <tr>
        <th scope="col">Identificador de produto</th>
        <th scope="col">Nome</th>
        <th scope="col">Data</th>
        <th scope="col">Disponibilidade para venda</th>
        <th scope="col">Total Adquirido</th>
        <th scope="col">Preço de custo</th>
        <th scope="col">Preço de venda</th>
        <th scope="col">Ação</th>
        <th></th>
        <th></th>
        
      </tr>
    </thead>
    <tbody>';
    while($row = $result->fetch_assoc()){
      echo '<tr>
        <th scope="row">'.$row["pid"].'</th>
        <td>'.$row["pname"].'</td>
        <td>'.$row["pdop"].'</td>
        <td>'.$row["pava"].'</td>
        <td>'.$row["ptotal"].'</td>
        <td>'.$row["poriginalcost"].'</td>
        <td>'.$row["psellingcost"].'</td>
        <td>
          <form action="editproduct.php" method="POST" class="d-inline"> <input type="hidden" name="id" value='. $row["pid"] .'><button type="submit" class="btn btn-info" name="view" value="View"><i class="fas fa-pen"></i></button></form>  </td>
       <td>
          <form action="" method="POST" class="d-inline"><input type="hidden" name="id" value='. $row["pid"] .'><button type="submit" class="btn btn-secondary" name="delete" value="Delete"><i class="far fa-trash-alt"></i></button></form> </td>
          <td>
          <form action="sellproduct.php" method="POST" class="d-inline"><input type="hidden" name="id" value='. $row["pid"] .'><button type="submit" class="btn btn-success" name="issue" value="Issue"><i class="fas fa-handshake"></i></button></form> </td>
        </td>
      </tr>';
    }
    echo '</tbody>
  </table>';
  } else {
    echo "0 Result";
  }
  if(isset($_REQUEST['delete'])){
    $sql = "DELETE FROM assets_tb WHERE pid = {$_REQUEST['id']}";
    if($conn->query($sql) === TRUE){
      // echo "Record Deleted Successfully";
      // below code will refresh the page after deleting the record
      echo '<meta http-equiv="refresh" content= "0;URL=?deleted" />';
      } else {
        echo "Unable to Delete Data";
      }
    }
  ?>
</div>
</div>
<a class="btn btn-danger box" href="addproduct.php"><i class="fas fa-plus fa-2x"></i></a>
</div>

<?php
include('includes/footer.php'); 
?>