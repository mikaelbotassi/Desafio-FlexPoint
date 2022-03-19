<?php

    require '../pessoa.php';


    session_start();

    function validaData(){

        $atual = new DateTime();
        $dataNascimento = new DateTime(rtrim($_POST["nascimento"], ";\n"));

        if($dataNascimento > $atual){
            $_SESSION['dataInvalida'] = "Data de nascimento é maior que a data atual.";
            $url = "http://localhost/desafio-flexpoint/index.php";
            echo "
            <META HTTP-EQUIV=REFRESH CONTENT = '0; URL = $url'>
            ";
            return false;
        }
        else{
            return true;
        }


    }

    function newPessoa(){
        $pessoa = new Pessoa();
        $pessoa->nome = $_POST["nome"];
        $pessoa->email = $_POST["email"];
        $pessoa->telefone = $_POST["telefone"];
        if(validaData()){
            $pessoa->nascimento = $_POST["nascimento"];
            return $pessoa;
        }
        return null;
    }

    function inserePessoa($fp, Pessoa $pessoa){
        fwrite($fp, $pessoa->nome . "\n");
        fwrite($fp, $pessoa->email . "\n");
        fwrite($fp, $pessoa->telefone . "\n");
        fwrite($fp, $pessoa->nascimento . "\n");
    }

    function gravar(Pessoa $pessoa){

        $arquivo = "../pessoas.txt";
    
        $fp = fopen($arquivo, "a");

        inserePessoa($fp, $pessoa);

        
        
        fclose($fp);
    }

    $pessoa = newPessoa();
    if(!empty($pessoa)){
        
        gravar($pessoa);  

        $_SESSION['sucess'] = "Os dados foram salvos com êxito.";

        $url = "http://localhost/desafio-flexpoint/listagem/listagem.php";

        echo "
            <META HTTP-EQUIV=REFRESH CONTENT = '0; URL = $url'>
            ";
    }

?>