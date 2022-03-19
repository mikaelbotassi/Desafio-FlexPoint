<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <title>Título da página</title>
    <meta charset="utf-8">
    <link rel="stylesheet" type = "text/css" href="./style.scss" media="screen">
  </head>
  <body>

    <header>
        <ul>
            <a href="./index.php"><li>Cadastrar</li></a>
            <a href="./listagem/listagem.php"><li>Listar</li></a>
        </ul>
    </header>

    <main>
        <?php
            if(!empty($_SESSION['dataInvalida'])){
        ?>
            <div class = "my-toastr warning" #toastr>
                <p class = "toastr-tytle">DATA INVÁLIDA!</p>
                <p><?php
                echo $_SESSION['dataInvalida'];
                ?></p>
            </div>
        <?php
            unset($_SESSION['dataInvalida']);
            }
        ?>

        <form action="./cadastro/cadastro.php" method="post">
            <div class = "styles-frames styles-input">
                <input type="text" placeholder = "Nome..." name = "nome" pattern="[A-Za-záàâãéèêíïóôõöúçñÁÀÂÃÉÈÍÏÓÔÕÖÚÇÑ ]+$" #nome>
            </div>

            <div class = "styles-frames styles-input">
                <input type="email" placeholder = "E-mail..." name = "email" required #email>
            </div>
            
            <div class = "styles-frames styles-input">
                <input type="tel" placeholder = "Telefone..." name = "telefone" pattern="[0-9]+$" required #telefone>
            </div>

            <div class = "style-data styles-input">
                <p class = "tytle-data">Data de Nascimento</p>
                <input type="date" placeholder = "dd/mm/yyyy" name="nascimento" required #nascimento>
            </div>

            <div class = "style-btn">
                <button type="submit">CADASTRAR</button>
            </div>

        </form>
    </main>

  </body>
</html>