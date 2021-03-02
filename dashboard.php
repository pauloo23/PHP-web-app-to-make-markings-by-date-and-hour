<?php
session_start();
define('TITLE', 'Página Inicial');
define('PAGE', 'dashboard');
include('includes/header.php');
include('includes/dbConnection.php');

if (isset($_SESSION['is_adminlogin'])) {
    $aEmail = $_SESSION['aEmail'];
} else {echo "<script> location.href='login.php'; </script>";
  
}
$date = date("Y-m-d");
$sql = "SELECT max(request_id) FROM submitrequest_tb";
$result = $conn->query($sql);
$row = mysqli_fetch_row($result);
$submitrequest = $row[0];
if($submitrequest == null) {
   $submitrequest=0;
}


$sql = "SELECT COUNT(*) FROM assignwork_tb WHERE request_state='0' ";
$result = $conn->query($sql);
$row = mysqli_fetch_row($result);
$assignwork = $row[0];
if( $assignwork == null) {
   $assignwork=0;
}


$sql = "SELECT COUNT(*) FROM assignwork_tb WHERE request_state='0'  AND assign_date LIKE '%" . $date . "%'";
$result = $conn->query($sql);
$row = mysqli_fetch_row($result);
$assignworktoday = $row[0];
if($assignworktoday == null) {
   $assignworktoday=0;
}


$sql = "SELECT COUNT(*) FROM assignwork_tb WHERE request_state='1'";
$result = $conn->query($sql);
$row = mysqli_fetch_row($result);
$completework = $row[0];
if( $completework == null) {
    $completework =0;
}

$sql = "SELECT SUM(poriginalcost * ptotal) FROM assets_tb";
$result = $conn->query($sql);
$row = mysqli_fetch_row($result);
$investedvalue = $row[0];
if($investedvalue == null) {
    $investedvalue =0;
}

$sql = "SELECT SUM(psellingcost * ptotal) FROM assets_tb";
$result = $conn->query($sql);
$row = mysqli_fetch_row($result);
$totalvalue = $row[0];
if($totalvalue==null) {
    $totalvalue=0;
}

$sql = "SELECT SUM(cpquantity * cpeach) FROM customer_tb";
$result = $conn->query($sql);
$row = mysqli_fetch_row($result);
$sellingvalue = $row[0];

if( $sellingvalue==null) {
    $sellingvalue=0;
}

?>
    <div class="content" >

      <div class="row">
            <div class="col-sm">
                 <div class="card text-white bg-danger mb-3 Grid-cell" style="height:30vh;">
                    <div class="card-header">Marcações de hoje</div>                
                    <div class="card-body">
                        <h4 class="card-title">
                            <?php echo $assignworktoday; ?>
                        </h4>
                        <a class="btn text-white" href="request.php">Visualizar</a>
                    </div>
                </div>
            </div>
            
            <div class="col-sm">
                 <div class="card text-white bg-success mb-3 Grid-cell"style="height:30vh;">
                    <div class="card-header">Marcações</div>
                    <div class="card-body">
                        <h4 class="card-title">
                            <?php echo $assignwork; ?>
                        </h4>
                        <a class="btn text-white" href="work.php">Visualizar</a>
                    </div>
                </div>
            </div>
            <div class="col-sm">
                <div class="card text-white bg-info mb-3 Grid-cell" style="height:30vh;">
                    <div class="card-header">Trabalhos efetuados</div>
                    <div class="card-body">
                        <h4 class="card-title">
                            <?php echo $completework; ?>
                        </h4>
                        <a class="btn text-white" href="workdone.php">Visualizar</a>
                    </div>
                </div>
            </div>
            <div class="col-sm">
                <div class="card text-white bg-secondary text-white mb-3 Grid-cell" style="height:30vh";>
                    <div class="card-header">Valor Investido Inventário</div>
                    <div class="card-body">
                        <h4 class="card-title">
                            <?php echo $investedvalue, "€" ; ?>
                        </h4>
                        <a class="btn text-white" href="assets.php">Visualizar</a>
                    </div>
                </div>
            </div>
            <div class="col-sm">
                <div class="card text-white bg-warning text-dark mb-3 Grid-cell" style="height:30vh">
                    <div class="card-header">Valor Esperado em vendas de produtos</div>
                    <div class="card-body">
                        <h4 class="card-title">
                            <?php echo $totalvalue, "€"; ?>
                        </h4>
                        <a class="btn text-dark" href="assets.php">Visualizar</a>
                    </div>
                </div>
            </div>
            <div class="col-sm">
                <div class="card text-white bg-dark text-white mb-3 Grid-cell" style="height:30vh;">
                    <div class="card-header">Valor faturado em vendas</div>
                    <div class="card-body">
                        <h4 class="card-title">
                            <?php echo $sellingvalue,"€"; ?>
                        </h4>
                        <a class="btn text-white" href="assets.php">Visualizar</a>
                    </div>
                </div>
            </div>
        </div>

            <!--Table-->
            <p class=" bg-dark text-white p-2">Lista de vendas</p>
            <?php
            $sql = "SELECT * FROM `customer_tb`";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                echo ' <div style="overflow-x:auto;">
 <table class="content-table">
  <thead>
   <tr>
    <th scope="col">Identificador Venda</th>
    <th scope="col">Nome Cliente</th>
    <th scope="col">Nome produto</th>
     <th scope="col">Quantidade</th>
      <th scope="col">Custo do produto</th>
       <th scope="col">Total</th>
       <th scope="col">Data</th>
   </tr>
  </thead>
  
  <tbody>';
                while ($row = $result->fetch_assoc()) {
                    echo '<tr>';
                    echo '<th scope="row">' . $row["custid"] . '</th>';
                    echo '<td>' . $row["custname"] . '</td>';
                    echo '<td>' . $row["cpname"] . '</td>';
                    echo '<td>' . $row["cpquantity"] . '</td>';
                    echo '<td>' . $row["cpeach"] . '</td>';
                    echo '<td>' . $row["cptotal"] . '</td>';
                    echo '<td>' . $row["cpdate"] . '</td>';
                }
                echo '</tbody>
 </table>';
            } else {
                echo "Sem nenhuma venda de produtos efetuada";
            }
            ?>

    </div>
</div>
<?php
include('includes/footer.php');
?>


