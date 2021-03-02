<?phpheader('Content-Type: text/html; charset=utf-8');
session_start();
define('TITLE', 'Definições');
define('PAGE', 'changepass');
include('includes/header.php');
include('../dbConnection.php');

if (isset($_SESSION['is_adminlogin'])) {
    $aEmail = $_SESSION['aEmail'];
} else {
    echo "<script> location.href='login.php'; </script>";
}
$aEmail = $_SESSION['aEmail'];
if (isset($_REQUEST['passupdate'])) {
    if (($_REQUEST['aPassword'] == "")) {
        // msg displayed if required field missing
        $passmsg = '<div class="alert alert-warning col-sm-6 ml-5 mt-2" role="alert"> Fill All Fileds </div>';
    } else {
        $sql = "SELECT * FROM adminlogin_tb WHERE a_email='$aEmail'";
        $result = $conn->query($sql);
        if ($result->num_rows == 1) {
            $aPass = $_REQUEST['aPassword'];
            $sql = "UPDATE adminlogin_tb SET a_password = '$aPass' WHERE a_email = '$aEmail'";
            if ($conn->query($sql) == TRUE) {
                // below msg display on form submit success
                $passmsg = '<div class="alert alert-success col-sm-6 ml-5 mt-2" role="alert"> Updated Successfully </div>';
            } else {
                // below msg display on form submit failed
                $passmsg = '<div class="alert alert-danger col-sm-6 ml-5 mt-2" role="alert"> Unable to Update </div>';
            }
        }
    }
}

if (isset($_REQUEST['deleteall'])) {
    $sql = "DELETE FROM assignwork_tb WHERE request_state='1'";
    if ($conn->query($sql) === TRUE) {
        // echo "Record Deleted Successfully";
        // below code will refresh the page after deleting the record
        echo '<script>alert("Todos os trabalhos foram eliminados!")</script>';
    } else {
        echo "Impossivel limpar dados!";
    }
}

if (isset($_REQUEST['deleteallwork'])) {
    $sql = "DELETE FROM assignwork_tb WHERE request_state='0'";
    if ($conn->query($sql) === TRUE) {
        // echo "Record Deleted Successfully";
        // below code will refresh the page after deleting the record
        echo '<script>alert("Todas asmarcaçõs foram eliminadas!")</script>';
    } else {
        echo "Impossivel limpar dados!";
    }
}

?>
<div class="content">
    <div class="col-sm-9 col-md-10">
        <div class="row">
            <div class="col-sm-6">
                <form class="mt-5 mx-5">
                    <div class="form-group">
                        <label for="inputEmail">Email</label>
                        <input type="email" class="form-control" id="inputEmail" value=" <?php echo $aEmail ?>"
                               readonly>
                    </div>
                    <div class="form-group">
                        <label for="inputnewpassword">Nova password</label>
                        <input type="text" class="form-control" id="inputnewpassword" placeholder="New Password"
                               name="aPassword">
                    </div>
                    <button type="submit" class="btn btn-danger mr-4 mt-4" name="passupdate">Guardar</button>
                    <button type="reset" class="btn btn-secondary mt-4">Reset</button>
                    <?php if (isset($passmsg)) {
                        echo $passmsg;
                    } ?>
                </form>
            </div>
        </div>
    </div>
        <link rel="stylesheet" href="../css/button.css">
        <form action="" method="POST" class="d-inline"><input type="hidden" name="xpto">
            <button style="top: 50px;left: 50px; width:80%;" type="submit" class="learn-more" name="deleteall" value="Delete"><i class="far fa-trash-alt"></i> Apagar TODOS os trabalhos completos
            </button>
        </form>
        <form action="" method="POST" class="d-inline"><input type="hidden" name="xpto">
            <button style="top: 50px;left: 50px; width:80%; margin-top:5vh;" type="submit" class="learn-more" name="deleteallwork" value="Delete"><i class="far fa-trash-alt"></i> Apagar TODAS as marcações
            </button>
        </form>

</div>
<?php
include('includes/footer.php');
?>