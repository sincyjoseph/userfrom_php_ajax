<?php
$servername = "newproject";
$dbusername = "root";
$dbpassword = "";
$dbname = "userform";
$conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //delete
    $deleteId = isset($_POST['deleteId'])?($_POST['deleteId']): 0;
    if(isset($_POST['deleteId'])){
        $deleteId = mysqli_real_escape_string($conn,$_POST['deleteId']);
    }
    if ($deleteId > 0){
        // Check record exists
        $checkRecord = mysqli_query($conn,"SELECT * FROM users WHERE id=".$deleteId);
        $totalrows = mysqli_num_rows($checkRecord);
        if ($totalrows > 0){
            // Delete record
            $query = "DELETE FROM users WHERE id=".$deleteId;
            mysqli_query($conn,$query);
            echo 1;
            exit;
        } else{
            echo 0;
            exit;
        }
    }
    echo 0;
    exit;

}

?>