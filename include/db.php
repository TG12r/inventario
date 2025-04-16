<?php

class DB{
    private $host;
    private $db;
    private $user;
    private $password;
    private $charset;

    public function __construct(){
        $this->host     = 'shuttle.proxy.rlwy.net';
        $this->db       = 'railway';
        $this->user     = 'root';
        $this->password = 'BPvFlgOrBKTsjrgSIdYgNjQnNoRBasrh';
        $this->charset  = 'utf8mb4';
    }

    function connect(){
        try{
            $dsn = "mysql:host={$this->host};port=39095;dbname={$this->db};charset={$this->charset}";
            $pdo = new PDO($dsn, $this->user, $this->password);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $pdo;
        }catch(PDOException $e){
            print_r('Error connection: ' . $e->getMessage());
        }   
    }
}

?>