<?php
if (!defined('SECURE')) exit('No direct script access allowed');

class User{
 
    // database connection and table name
    private $conn;
    private $table_name = "users";
 
    // object properties

    public $username;
 
    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;        
    }

    function lists(){

        $result = $this->conn->run("SELECT * FROM ".$this->table_name)->fetchAll(PDO::FETCH_ASSOC);

        return  $result;
    }

    function read($id){
        
        $result = $this->data = $this->conn->run("SELECT * FROM ".$this->table_name." WHERE id = ?", [$id])->fetch(PDO::FETCH_ASSOC);

        return  $result;
    }

    function delete($id){
        
        $result = $this->data = $this->conn->run("DELETE FROM ".$this->table_name." WHERE id=?", [$id])->rowCount();

        return  $result;
    }

    function count(){

        $result = $this->conn->run("SELECT count(*) FROM ".$this->table_name)->fetchColumn();
        
        return  $result;
    }

    public function db_column(){
        
            $rs = $this->conn->run('SELECT * FROM users LIMIT 0');
            for ($i = 0; $i < $rs->columnCount(); $i++):
                $col = $rs->getColumnMeta($i);
                $columns[] = $col['name'];
            endfor;
            echo '<pre>';
            print_r($columns);
            echo '</pre>';
        
    } 
 
}


if(isset($db)){
    $user = new User($db);
}