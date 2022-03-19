<?php
    class Pessoa{
    
        private $nome;
        private $email;
        private $telefone;
        private $nascimento;

        // public function __construct($nome, $email, $telefone, $nascimento){
        //     $this->nome = $nome;
        //     $this->email = $email;
        //     $this->telefone = $telefone;
        //     $this->nascimento = $nascimento;
        // }

        public function __construct(){}

        public function __set($atrib, $value){
            $this->$atrib = $value;
        }

        public function __get($atrib){
            return $this->$atrib;
        }

    }
?>