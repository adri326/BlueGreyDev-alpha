<?php

class drawable {
    
    function __construct($type, $data) {
        
        $this->type = $type;
        $this->data = $data;
        
    }
    
    function draw() {
        
        $content = $this->data;
        return include("drawableIncludes/".$this-type.'.php');
    }
    
}


?>