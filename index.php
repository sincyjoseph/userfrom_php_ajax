<?php
include 'database.php';

$update = false;
$isEditOnly = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $username = isset($_POST['username'])?$_POST['username']:'';
    $password = isset($_POST['password'])?$_POST['password']:'';
    $email = isset($_POST['email'])?$_POST['email']:'';
    $gender = isset($_POST['gender'])?$_POST['gender']:'';
    $address = isset($_POST['address'])?$_POST['address']:'';
    $declaration = isset($_POST['checkbox'])?$_POST['checkbox']:'';
    //Save  or update
    if(isset($_POST['save'])){
        $insertData = new Database();
        $insertStatus = $insertData->insert($username,$password,$email,$gender,$address,$declaration);
        if($insertStatus){
            echo "Insert success";
        }else {
            echo "Failed";
        }
    }
    else if(isset($_POST['update'])){
        $updateData = new Database();
        $isEditOnly = true;
        $HI = $_POST['HI'];
        if(is_numeric($HI) && $HI > 0){
            $updateStatus = $updateData->update($username,$password,$email,$gender,$address,$declaration,$HI);
            if($updateStatus){
                echo "Update success";
            }else {
                echo "Failed";
            }
        } 
    }
}
// edit
if(isset($_GET['edit']) && !($isEditOnly)){
    $editData = new Database();
    $id = isset($_GET['edit'])?$_GET['edit']:0;
    $update = true;
    $result = $editData->edit($id);
    if ($result){
        $row = $result->fetch_array();
        $username = isset($row['username'])?$row['username']:'';
        $password = isset($row['password'])?$row['password']:'';
        $email = isset($row['email'])?$row['email']:'';
        $gender = isset($row['gender'])?$row['gender']:'';
        $address = isset($row['address'])?$row['address']:'';
        $declaration = isset($row['declaration'])?$row['declaration']:'';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="main.css">
</head>
<body>
    <br/>
    <div class="container">
    <div class="row">
        <div class="col-3">&nbsp;</div>
        <div class="col-6">
                    <form id="reg" method="POST" action="">
                        <h3>Registration form</h3>
                        <br/>
                    <input type="hidden" name="HI" value="<?php echo $id = isset($_GET['edit'])?$_GET['edit']:0; ?>"/>

                    <div class="form-group col-12">
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
                                <label class="control-label">Username</label>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8 col-xl-8">
                                <input class="form-control" type="text" name="username" value="<?php echo $username = isset($row['username'])?$row['username']:''; ?>"/>
                            </div>
                        </div>
                        </br>
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
                                <label class="control-label">Password</label>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8 col-xl-8">
                                <input class="form-control" type="password" name="password" id="password" value="<?php echo $password = isset($row['password'])?$row['password']:''; ?>"/>
                            </div>
                        </div>
                        </br>
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
                                <label class="control-label">Confirm password</label>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8 col-xl-8">
                                <input class="form-control" type="password" name="confirmpass"/>
                            </div>
                        </div>
                        </br>
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
                                <label class="control-label">Email</label>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8 col-xl-8">
                                <input class="form-control" type="email" name="email" value="<?php echo $email = isset($row['email'])?$row['email']:''; ?>"/>
                            </div>
                        </div>
                        </br>
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
                                <label class="control-label">Gender</label>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8 col-xl-8 gender">
                                <input type="radio" class="form-check-input" name="gender" value="male">
                                <label class="form-check-label">Male</label>
                                <input type="radio" class="form-check-input" name="gender" value="female">
                                <label class="form-check-label">Female</label>
                            </div>
                        </div>
                        </br>
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
                                <label class="control-label">Address</label>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8 col-xl-8">
                                <textarea class="form-control" name="address" rows="3"><?php echo $address = isset($row['address'])?$row['address']:''; ?></textarea>
                            </div>
                        </div>
                        </br>
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
                                <label class="control-label">Declaration</label>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8 col-xl-8 declaration">
                                <input type="checkbox" class="form-check-input" name="checkbox" value="checked">
                            </div>
                        </div>
                        </br>
                        <div class="row">
                            <div class="col-8">&nbsp;</div>
                            <div class="col-xs-12 col-sm-12 col-md-2 col-lg-2 col-xl-2">
                                <button type="reset" class="btn btn-danger">Reset</button>
                            </div>
                            <?php if($update == true): ?>
                                <div class="col-xs-12 col-sm-12 col-md-2 col-lg-2 col-xl-2">
                                    <button type="submit" class="btn btn-info" name="update">Update</button>
                                </div>
                            <?php else: ?>
                                <div class="col-xs-12 col-sm-12 col-md-2 col-lg-2 col-xl-2">
                                    <button type="submit" class="btn btn-primary" name="save">Save</button>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                    </form>
        </div>
        <div class="col-3">&nbsp;</div>
    </div>
    </div>
<hr>
<table>
    <tr>
        <th>Sl. No.</th>
        <th>ID</th>
        <th>Username</th>
        <th>Password</th>
        <th>Email</th>
        <th>Gender</th>
        <th>Address</th>
        <th>Declaration</th>
        <th>Created</th>
        <!-- <th>Updated</th> -->
        <th>Status</th>
        <th>Actions</th>
    </tr>
    <!-- Table rendering from database -->
    <?php 
        $servername = "newproject";
        $username = "root";
        $password = "";
        $dbname = "userform";

        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);

        //Querying data from database
        $sql = "SELECT * FROM users";
        $result = $conn->query($sql);
        $i = 0;
        // output data of each row
        while($row = $result->fetch_assoc()) { 
            $i++;
            echo "<tr>";
            echo "<td>$i</td>";
            echo "<td>".$row['id']."</td>";
            echo "<td>".$row['username']."</td>";
            echo "<td>".$row['password']."</td>";
            echo "<td>".$row['email']."</td>";
            echo "<td>".$row['gender']."</td>";
            echo "<td>".$row['address']."</td>";
            echo "<td>".$row['declaration']."</td>";
            echo "<td>".$row['created_at']."</td>";
            // echo "<td>".$row['updated_at']."</td>";
            echo "<td>".$row['status']."</td>";
            echo "<td>
            <a href='index.php?edit=".$row['id']."' class='btn btn-info'>Edit</span></a>
            &nbsp;
            <span class='btn btn-danger delete' data-id=".$row['id'].">Delete</span>
            </td>";
            echo "</tr>";
        }   
    ?>
    </table>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/jquery.validate.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>
    <script src="register.js"></script>
</body>
</html>
