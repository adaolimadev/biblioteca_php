<?php

?>
<html>
    <head>
    <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
       
        <title>Cadastrar Livro</title>
        
    </head>

    <body>
    <?php require 'navbar.php';?>
        <br>
         <div class="container bg-light">
            <div class ="row"> 
                <div class = "col mt-5">
                    <h1 >Cadastro de Livros</h1>

                        <form  action="action_livro.php?action=novo" method="POST" role="form">
                            <div class="form-group">
                                    <label for="inputTitulo">Título:</label>
                                    <input type="text" class="form-control" name="txtTitulo" id="inputTitulo"> <br>  
                            </div>
                            <div class="form-group">
                                    <label for="inputAutor">Autor:</label>
                                    <input type="text" class="form-control" name="txtAutor" id="inputAutor"> <br>  
                            </div>
                            <div class="form-group">
                                    <label for="inputTitulo">Editora:</label>
                                    <input type="text" class="form-control" name="txtEditora" id="inputEditora"> <br>  
                            </div>
                            <div class="form-group">
                                    <label for="inputGenero">Gênero:</label>
                                    <input type="text" class="form-control" name="txtGenero" id="inputGenero"> <br>  
                            </div>
                            <div class="form-group">
                                    <label for="inputAno">Ano:</label>
                                    <input type="number" class="form-control" name="txtAno" id="inputAno"> <br>  
                            </div>
                            <button type="submit" class="btn btn-primary">Enviar</button>
                        </form>
                </div>
            </div>  
         </div>
    </body> 
</html>