<?php
session_start();
define('TITLE', 'Work Order');
define('PAGE', 'work');
include('includes/header.php');
include('includes/dbConnection.php');
if (isset($_SESSION['is_adminlogin'])) {
    $aEmail = $_SESSION['aEmail'];
} else {
    echo "<script> location.href='login.php'; </script>";
}

?>

<?php
if (isset($_REQUEST['finish'])) {

    // Assigning User Values to Variable
    $new_desc = $_POST['input_desc'];
    echo $new_desc;
    $sql = "UPDATE assignwork_tb
    SET request_desc= '$new_desc'
    WHERE request_id = {$_REQUEST['id']}";
   if (isset($_SESSION['is_adminlogin'])) {
    $aEmail = $_SESSION['aEmail'];     echo "<script> location.href='work.php'; </script>";
} else {
    echo "<script> location.href='login.php'; </script>";
}
    if ($conn->query($sql) === TRUE) {
        // echo "Success alteration ";
        echo '<meta http-equiv="refresh" content= "0;URL=?deleted" />';
    } else {
        echo "Unable to modify";
    }
}

?>
<div class="content">
<div class="col-sm-6 mt-5  mx-3">
    <h3 class="text-center">Detalhes da marcação</h3>
    <?php
    if (isset($_REQUEST['view'])) {
        $sql = "SELECT * FROM assignwork_tb WHERE request_id = {$_REQUEST['id']}";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
    }
    ?>

    <table class="table table-bordered">
        <tbody>
        <tr>
            <td>Identificador do pedido</td>
            <td id="request_id" name="request_id">
                <?php if (isset($row['request_id'])) {
                    echo $row['request_id'];
                } ?>
            </td>
        </tr>
        <tr>
            <td>Tipo de Trabalho</td>
            <td>
                <?php if (isset($row['request_info'])) {
                    echo $row['request_info'];
                } ?>
            </td>
        </tr>
        <tr>
            <td style="background:#FFFF00;">Descrição do trabalho</td>
            <td contenteditable="true" id="new_desc" name="new_desc">
                <?php if (isset($row['request_desc'])) {
                    echo $row['request_desc'];
                } ?>
            </td>
        </tr>
        <tr>
            <td>Nome</td>
            <td>
                <?php if (isset($row['requester_name'])) {
                    echo $row['requester_name'];
                } ?>
            </td>
        </tr>


        <tr>
            <td>Hora</td>
            <td>
                <?php if (isset($row['requester_hour'])) {
                    echo $row['requester_hour'];
                } ?>
            </td>
        </tr>
        <tr>
            <td>Número Telemóvel</td>
            <td>
                <?php if (isset($row['requester_mobile'])) {
                    echo $row['requester_mobile'];
                } ?>
            </td>
        </tr>

        </tbody>
    </table>
    <div class="text-center">
        <form class='d-print-none d-inline mr-3'><input class='btn btn-danger' type='submit' value='Print'
                                                        onClick='window.print()'></form>
        <form class='d-print-none d-inline' action="work.php"><input class='btn btn-secondary' type='submit'
                                                                     value='Close'></form>

        <form id="form_desc" action="" method="POST" class="d-inline">
            <input type="hidden" id="request_id" name="id" value="<?php if (isset($row)) echo $row["request_id"];  ?>"/>

            <input type="hidden" id="input_desc" name="input_desc" value="<?php if (isset($row)) echo $row["request_desc"]; ?>"/>
            <button style=" color: #1c7430; background-color: white;" onclick="getdesc();" class="btn btn-secondary"
                    name="finish" value="Finish"><i class="fa fa-check-circle"></i> Salvar</button>
        </form>
    </div>
</div>

<script>
    function getdesc() {
        var new_desc = document.getElementById("new_desc").innerHTML;
        console.log(new_desc);
        document.getElementById("input_desc").value = new_desc;
        document.getElementById("form_desc").submit();
    }
</script>
<?php

include('includes/footer.php');
?>


