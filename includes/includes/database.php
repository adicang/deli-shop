<?php
 
require_once('config.php');

class Database{
    
    private $connection;
    
    function __construct(){
        $this->open_db_connection();
    }
    private function open_db_connection(){
        header('Content-Type: text/html; charset=utf-8');
        $this->connection=new mysqli(DB_HOST,DB_USER,DB_PASS,DB_NAME);
		$this->connection->query("SET NAMES 'utf8'");
        if ($this->connection->connect_error){
            $this->connection=null;
        }
    }
    public function get_connection(){
        return $this->connection;
    }
    public function query($sql){
        
        $result=$this->connection->query($sql);
        if (!$result){
            return null;

        }
        else{
            return $result;
        }
    }  
}
$database=new Database();
?>