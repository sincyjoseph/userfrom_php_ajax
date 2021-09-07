<?php
class Database {

    private $servername = 'localhost';
    private $dbusername = 'root';
    private $dbpassword = '';
    private $dbname = 'userform';
    private $conn = null;

    private function getConnection(){
       if(!$this->conn){
        $this->conn = new mysqli($this->servername,$this->dbusername,$this->dbpassword,$this->dbname);
       }
    }

    //Data insert function
    public function insert($username,$password,$email,$gender,$address,$declaration){
        $this->getConnection();
        $insertRecord=$this->conn->query("INSERT INTO users (username, password, email, gender, address, declaration) 
                                 VALUES ('$username', '$password', '$email', '$gender', '$address', '$declaration')");
        return $insertRecord;
    }

    //Data update function
    public function update($username,$password,$email,$gender,$address,$declaration,$HI){
        $this->getConnection();
        $updateRecord=$this->conn->query("UPDATE users 
                                 SET username='$username', password='$password', email='$email', gender='$gender', address='$address', declaration='$declaration' 
                                 WHERE id=$HI ");
        return $updateRecord;
    }

    //Data edit function
    public function edit($id){
        $this->getConnection();
        $editRecord=$this->conn->query("SELECT * FROM users WHERE id=$id");
        return $editRecord;
    }

    //Data delete function
    public function delete($deleteId){
        $this->getConnection();
        $deleteRecord=$this->conn->query("DELETE FROM users WHERE id=".$deleteId);
        return $deleteRecord;
    }

    function __destruct(){
        $this->conn->close();
    }

}

?>