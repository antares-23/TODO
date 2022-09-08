<?php
class User{
    public $id;
    public $name;
    public $email;
    public $password;
    public $isAdmin;
    private  $conn;

    public function __construct($db)
    {
        $this->conn =  $db;
    }


    public function create(){

        $q="INSERT INTO users SET name=:name, email=:email, password=:password";
        $stmt = $this->conn->prepare($q);

        $this->name =  htmlspecialchars(strip_tags($this->name));
        $this->email =  htmlspecialchars(strip_tags($this->email));
        $this->password =  htmlspecialchars(strip_tags($this->password));
       $this->password=password_hash( $this->password,PASSWORD_DEFAULT);

        $stmt->bindParam(":name",$this->name);
        $stmt->bindParam(":email",$this->email);
        $stmt->bindParam(":password",$this->password);

        
        //$stmt->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION ); 

        if($stmt->execute()){
            return true;            
        }else{
            print_r($stmt->errorInfo());
            return false;
            //echo "\nPDO::errorCode(): ", $this->conn->errorCode();
            
        }

    }

    public function check($email, $pass){

       $q= "SELECT * from users WHERE email=:email ";
        $stmt= $this->conn->prepare($q);
        $this->email=htmlspecialchars(strip_tags($email));
        $stmt->bindParam(":email", $email);

//        $this->password=htmlspecialchars(strip_tags($this->password));

        if($stmt->execute())
        {
           
            if($stmt->rowCount()>0){
                
                $row =  $stmt->fetch(PDO::FETCH_ASSOC);
    
                $this->id =  $row['id'];
                $this->name =  $row['name'];
                $this->email =  $row['email'];
                $this->password =  $row['password'];
                $this->idAdmin =  $row['isAdmin'];
    
    
                if(password_verify($pass,$this->password))            
                    return true;
                else
                    return false;
    
            }
            //echo "User does not exists!";
            return false;

        }
        else  print_r($stmt->errorInfo());
        
       


    }
}



?>