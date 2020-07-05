<?php
if (!defined('SECURE')) exit('No direct script access allowed');

class DB{
 
     // specify your own database credentials
     private $host = DB_HOST;
     private $db_name = DB_NAME;
     private $username = DB_USERNAME;
     private $password = DB_PASSWORD;
     public $conn;
  
     // get the database connection
     public function getConnection() {
  
         $this->conn = null;
  
         try{
             $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
             $this->conn->exec("set names utf8");
         }catch(PDOException $exception){
             echo "Connection error: " . $exception->getMessage();
             exit;
         }
  
         return $this->conn;
    }

    public function run($sql, $args = NULL){
        $conn = $this->getConnection();
        if (!$args)
        {
            return $conn->query($sql);
        }
        $result = $conn->prepare($sql);
        $result->execute($args);
        return $result;
    }
 
    // insert data - table / values
    public function insertQuery($data=array()){

        $conn = $this->getConnection();

        if(!empty($data['table']) && !empty($data['values']) && is_array($data['values'])):

            $columnString   = implode(',', array_keys($data['values']));
            $valueString    = ":".implode(',:', array_keys($data['values']));
            
            $sql = "INSERT INTO ".$data['table']." (".$columnString.")  VALUES (".$valueString.")";

            $query = $conn->prepare($sql);
            $conn->exec("set names utf8");
            
            foreach($data['values'] as $key => $val):
                $query->bindValue(':'.$key, $val);
            endforeach;

            $result = $query->execute();
            return $result ? $conn->lastInsertId() : false;
        else:
            return false; 
        endif;
    }


    // udpate data - table / set / condition
    public function updateQuery($data=array()){
       
        $conn = $this->getConnection();

        if(!empty($data['table']) && !empty($data['set']) && is_array($data['set'])):

            $colvalSet = '';$colvalSet2 = '';
            $whereSql = '';
            $i = 0;$x = 0; 

            foreach($data['set'] as $key=>$val):
                $pre = ($i > 0)?', ':'';
                $colvalSet .= "`".str_replace("`", "``", $pre.$key)."` = :".$key."";
                $i++;
            endforeach;

            foreach($data['set'] as $key=>$val):
                $pre = ($x > 0)?', ':'';
                $colvalSet2 .= $pre."'".$val."'";
                $x++;
            endforeach;

            if(!empty($data['condition'])&& is_array($data['condition'])):
                $whereSql .= ' WHERE ';
                $i = 0;
                foreach($data['condition'] as $key => $value):
                    $pre = ($i > 0)?' AND ':'';
                    $whereSql .= $pre.$key." = '".$value."'";
                    $i++;
                endforeach;
            endif;


            $sql = "UPDATE ".$data['table']." SET ".$colvalSet.$whereSql;
            $query = $this->conn->prepare($sql);

            foreach($data['set'] as $key=>$val):
                $query->bindValue(':'.$key, $val);
            endforeach;

            $update = $query->execute();

            return $update ? true : false;

        else:
            return false;
        endif;        

    } 


    


}


$db = new DB();