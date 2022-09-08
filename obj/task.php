<?php


class Task{

    private $conn;
   

    public $id;
    public $name;
    public $status;
    public $description;
    public $idUser;
    public $created;
    public $due;


    public function __construct($db)
    {
        $this->conn =  $db;
    }

    public function create(){

        $q= "INSERT INTO tasks 
        SET  
        name=:name, 
        
        description=:description,
        idUser=:idUser, 
        created=:created, 
        dueDate=:due";

        $stmt = $this->conn->prepare($q);

         $this->name =  htmlspecialchars(strip_tags($this->name));
         $this->status =  0;
         $this->description =  htmlspecialchars(strip_tags($this->description));
         $this->dueDate =  htmlspecialchars(strip_tags($this->due));
         $this->timestamp = date('Y-m-d H:i:s');
       
        $stmt->bindParam(":name",$this->name);
        //$stmt->bindParam(":status",$status);
        $stmt->bindParam(":description",$this->description);
        $stmt->bindParam(":due",$this->dueDate);
        $stmt->bindParam(":created",$this->timestamp);
        $stmt->bindParam(":idUser",$this->idUser);


        if($stmt->execute()){
            return true;            
        }else{
            print_r($stmt->errorInfo());
            return false;
        }
    }

    public function listUser($idUser){

        $q= "SELECT * FROM tasks WHERE idUser=:idUser ORDER BY dueDate ASC";
        $stmt = $this->conn->prepare($q);

        $this->idUser =  htmlspecialchars(strip_tags($idUser));
        $stmt->bindParam(":idUser",$this->idUser);

        if($stmt->execute()){
            return $stmt;            
        }else{
            echo "??";
             print_r($stmt->errorInfo());
            return false;
        }

    }

    public function listAll(){
               
        $q= "SELECT * FROM tasks WHERE 1 ORDER BY dueDate ASC";
        $stmt = $this->conn->prepare($q);
        
        if($stmt->execute()){
            return $stmt;            
        }else{
            echo "??";
             print_r($stmt->errorInfo());
            return false;
        }

    }


    public function checkTask($currStatus, $id){

        $q="UPDATE tasks set status=:status WHERE id=:id";
        $stmt = $this->conn->prepare($q);      
        $stmt->bindParam(":id", $id);

       // echo "curr".$this->status;        
        //echo "no".!$this->status;
//echo $currStatus;
         $status=$currStatus==1?0:1;

        $stmt->bindParam(":status", $status);
        if($stmt->execute()){
            return $stmt;            
        }else{
            echo "??";
             print_r($stmt->errorInfo());
            return false;
        }
    }

    public function deleteTask($id)
    {
       
        $q="DELETE FROM tasks WHERE id=:id";
        $stmt = $this->conn->prepare($q);  
        $stmt->bindParam(":id", $id);

        if($stmt->execute()){
            return $stmt;            
        }else{
            echo "??";
             print_r($stmt->errorInfo());
            return false;
        }

    }


    public function readOne(){
       // echo "here!";
        $q="SELECT * FROM tasks WHERE id=:id LIMIT 0,1";

        $stmt = $this->conn->prepare( $q );
        $stmt->bindParam(':id', $this->id);
        if($stmt->execute()){

        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $this->name = $row['name'];
        $this->status = $row['status'];
        $this->description = $row['description'];
        $this->due = $row['dueDate'];
        }else{            
            print_r($stmt->errorInfo());
            return false;
        }
    }


    public function update(){
        $q= "UPDATE tasks 
        SET  
        name=:name,        
        description=:description,
        idUser=:idUser, 
        created=:created, 
        dueDate=:due WHERE id=:id";

        $stmt = $this->conn->prepare($q);

        
         $this->name =  htmlspecialchars(strip_tags($this->name));
        
         $this->description =  htmlspecialchars(strip_tags($this->description));
         $this->dueDate =  htmlspecialchars(strip_tags($this->due));
         $this->timestamp = date('Y-m-d H:i:s');
        $stmt->bindParam(":id",$this->id);
        $stmt->bindParam(":name",$this->name);
        $stmt->bindParam(":description",$this->description);
        $stmt->bindParam(":due",$this->dueDate);
        $stmt->bindParam(":created",$this->timestamp);
        $stmt->bindParam(":idUser",$this->idUser);


        if($stmt->execute()){
            return true;            
        }else{
            print_r($stmt->errorInfo());
            return false;
        }
    }


}

?>