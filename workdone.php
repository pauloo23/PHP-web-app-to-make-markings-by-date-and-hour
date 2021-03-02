<?phpheader('Content-Type: text/html; charset=utf-8');
session_start();
define('TITLE', 'Trabalhos Completos');
define('PAGE', 'workdone');
include('includes/header.php');
include('includes/dbConnection.php');

if (isset($_SESSION['is_adminlogin'])) {
    $aEmail = $_SESSION['aEmail'];
} else {
    echo "<script> location.href='login.php'; </script>";
}

if (isset($_REQUEST['delete'])) {
    $sql = "DELETE FROM assignwork_tb WHERE request_id = {$_REQUEST['id']}";
    if ($conn->query($sql) === TRUE) {
        // echo "Record Deleted Successfully";
        // below code will refresh the page after deleting the record
        echo '<meta http-equiv="refresh" content= "0;URL=?deleted" />';
    } else {
        echo "Unable to Delete Data";
    }
}
?>



<?php
include('includes/footer.php');
?>

<div class="content">
    <div class="Input">

        <input type="text" name="search_text" id="search_text"
               placeholder="Procurar por nome cliente, número telemóvel ou tipo trabalho">

    </div>
    <div  style="overflow-x:auto;"  id="result"></div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>

</div>

    <script>
        $(document).ready(function () {

            load_data();

            function load_data(query) {
                $.ajax({
                    url: "fetch.php",
                    method: "POST",
                    data: {query: query},
                    success: function (data) {
                        $('#result').html(data);
                    }
                });
            }

            $('#search_text').keyup(function () {
                var search = $(this).val();
                if (search != '') {
                    load_data(search);
                } else {
                    load_data();
                }
            });
        });
    </script>
</div>