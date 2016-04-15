<?php

class MySQLHandler {
    
    private $dbHost = null;
    private $dbUserName = null;
    private $dbPassword = null;
    private $command = null;
    private $db = null;
    private $dbResult = null;
    private $dbToexe = null;
    private $dbName = null;
    
    function __construct($dbHost = 'localhost', $dbname, $dbUserName, $dbPassword, $command = null) {
        
        $this->dbHost = $dbHost;
        $this->dbUserName = $dbUserName;
        $this->dbPassword = $dbPassword;
        $this->command = $command;
        $this->dbName = $dbname;
        
        $this->init();
        
    }
    
    function init() {
        
        $toexe = 'mysql:host='.$this->dbHost.';dbname='.$this->dbName;
        $this->db = new PDO($toexe, $this->dbUserName, $this->dbPassword);
        
        
    }
    
    function executeCommand($command = null) {
        
        if ($command==null) {
            
            $toexe = $this->command;
            
        } else {
            
            $toexe = $command;
            
        }
        
        
        $this->dbToexe = $this->db->prepare($toexe);
        
        if ($this->dbToexe->execute(array())) {
            
            $this->dbResult = $this->dbToexe->fetchAll();
            
            return $this->dbResult;
            
        } else {
            
            return $this->dbToexe->ErrorInfo();
            
        }
        
    }
    
    function getResult() {
        
        return $this->dbResult;
        
    }
    
    function hide() {
        
        $this->dbResult = null;
        $this->dbPassword = null;
        $this->command = null;
        $this->dbToexe = null;
        
    }
    
}

?>
