<?php
    class Field{
        public $value;
        public $error;
        public $required;

        function __construct($required)
        {
            $this->value = '';
            $this->error = '';
            $this->required = $required;
        }
    }
?>
