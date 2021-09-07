<?php
$servername = "newproject";
$dbusername = "root";
$dbpassword = "";
$dbname = "userform";
$conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $deleteId = isset($_POST['deleteId'])?($_POST['deleteId']): 0;
    
    if(isset($_POST['deleteId'])){
        $deleteId = mysqli_real_escape_string($conn,$_POST['deleteId']);
        $query = "DELETE FROM users WHERE id=".$deleteId;
        if(mysqli_query($conn,$query)){
            $del = new stdClass();
            $del->statusCode=200;
            $del->statusMessage='success';
            echo json_encode($del);
        } else{
            $del = new stdClass();
            $del->statusCode=201;
            $del->statusMessage="Error: " . $query . "<br>" . mysqli_error($conn);
            echo json_encode($del);
        }   
        mysqli_close($conn);
    }
}
?>