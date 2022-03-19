<?php
  session_start();
  define("FILE_NAME", "../pessoas.txt");
?>

<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <title>Título da página</title>
    <meta charset="utf-8">
    <link rel="stylesheet" type = "text/css" href="../style.scss" media="screen">

    <?php

      require '../pessoa.php';

      function atribuiDadosPessoa($arquivo){
          
          $pessoa = new Pessoa();

          $linha = fgets($arquivo, 50);

          if(strlen(trim($linha)) > 0){

            $pessoa->nome = $linha;

            $linha = fgets($arquivo, 50);
            $pessoa->email = $linha;

            $linha = fgets($arquivo, 50);
            $pessoa->telefone = $linha;

            $linha = fgets($arquivo, 50);
            $pessoa->nascimento = $linha;

            return $pessoa;

          }

          return null;
      }

      function lerPessoas(){

        if(!file_exists(FILE_NAME)){
          return null;
        }

        $arquivo = fopen (FILE_NAME, 'r');

        $pessoasList[] = [];

        $cont = 0;

        while(!feof($arquivo)){
          
          $pessoa = atribuiDadosPessoa($arquivo);

          if(!empty($pessoa)){
            $pessoasList[$cont] = $pessoa;
            $cont++;
          }

        }
        fclose($arquivo);
        return $pessoasList;
      }

    ?>

  </head>
  <body>

    <header>
        <ul>
            <a href="../index.php"><li>Cadastrar</li></a>
            <a href="./listagem.php"><li>Listar</li></a>
        </ul>
    </header>
  
    <main>

    <?php
            if(!empty($_SESSION['sucess'])){
        ?>
            <div class = "my-toastr sucess" #toastr>
                <p class = "toastr-tytle">PESSOA CADASTRADA!</p>
                <p><?php
                echo $_SESSION['sucess'];
                ?></p>
            </div>
        <?php
            unset($_SESSION['sucess']);
            }
        ?>
      
      <div class = "container-cards col-sm-11 col-md-6 col-lg-2">
      <?php
        $arrayPessoa = lerPessoas();
        if(!empty($arrayPessoa)){
          foreach($arrayPessoa as $pessoa){
            if(!empty($pessoa)){
              $dataNascimento = new DateTime(rtrim($pessoa->nascimento, ";\n"));
      ?>  

        <div class = "card-pessoa col-sm-12 col-md-7 col-lg-2">
            <div class = "card-pessoa-atributos">
              <p class = "atributo-style">NOME:</p>
              <p>
                <?php 
                  echo $pessoa->nome;
                ?>
              </p>
            </div>
            <div class = "card-pessoa-atributos">
              <p class = "atributo-style">E-MAIL:</p>
              <p>
                <?php
                  echo $pessoa->email;
                ?>
              </p>
            </div>
            <div class = "card-pessoa-atributos">
              <p class = "atributo-style">TELEFONE:</p>
              <p>
                <?php 
                  echo $pessoa->telefone;
                ?>
              </p>
            </div>
            <div class = "card-pessoa-atributos">
              <p class = "atributo-style">DATA DE NASCIMENTO:</p>
              <p>
                <?php
                  echo $dataNascimento->format('d/m');
                ?>
              </p>
            </div>

            <div class = "card-pessoa-atributos">
              <p class = "atributo-style">IDADE:</p>
              <p>
                <?php
                 $atual = new DateTime();
                 $interval = $atual->diff($dataNascimento);
                 echo $interval->format('%Y anos');
                ?>
              </p>
            </div>

        </div>
    <?php
        }
      }
    }
      ?>
      </div>
    </main>

  </body>
</html>