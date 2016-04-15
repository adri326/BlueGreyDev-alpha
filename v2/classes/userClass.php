<?php

class user {
    
    private $username = null;
    private $password = null;
    private $JoinDate = null;
    private $description = null;
    private $isAdmin = false;
    private $isDevelopper = false;
    private $id = 0;
    
    function __construct(Array $raw = array()) {
        
        $this->username = $raw['pseudo'];
        $this->password = $raw['password'];
        $this->JoinDate = $raw['JoinDate'];
        $this->description = $raw['desc'];
        $this->isAdmin = $raw['admin'];
        $this->isDevelopper = $raw['dev'];
        $this->id = $raw['id'];
        
    }
    
    /*function __construct($username, $password, $JoinDate, $description, $isAdmin, $isDevelopper, $id) {
        
        $this->username = $pseudo;
        $this->password = $password;
        $this->JoinDate = $JoinDate;
        $this->description = $description;
        $this->isAdmin = $isAdmin;
        $this->isDevelopper = $isDevelopper;
        $this->id = $id;
        
    }*/
    
    function getPseudo() {
        
        return $this->pseudo;
        
    }
    
    function getDescription() {
        
        return $this->description;
        
    }
    
    function getJoinDate() {
        
        return $this->JoinDate;
        
    }
    
    function getState() {
        
        if ($this->username != null) echo $this->username.': pseudoOK';
        if ($this->password != null) echo ' passwordOK';
        if ($this->JoinDate != null) echo ' JoinDateOK';
        if ($this->description != null) echo ' descriptionOK';
        if ($this->isAdmin) echo ' isAdmin';
        if ($this->isDevelopper) echo ' isDevelopper';
        if ($this->id != 0) echo ' id#'.$this->id;
        
    }
    
    function isConnected($password) {
        
        if (isset($password) AND $password==$this->password) return true; else return false;
        
    }
    
}

?>