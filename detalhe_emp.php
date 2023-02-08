<html>
    <head>
    <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
        <title>Novo Empréstimo</title>  
    </head>

    <body>
    <?php require 'navbar.php'; ?>
        <br>
        <div class="container bg-light">
            <div class ="row"> 
                <div class = "col mt-5">
                    <h1 >Detalhes do Emprestimo</h1>

                    <?php   require 'connection_mysql.php';  
                               $id_emp = $_REQUEST['id_emp'];?>

                    <div class="form-group">
                            <label for="inputAutor">COD Emprestimo:</label>
                             <input type="text" class="form-control" name="txtId_cliente" id="inputAutor" value = "<?php print_r($_REQUEST['id_emp']);?>" disabled> <br>  
                    </div>
                        
                               <?php

                               //Fazer select puxando do BD os livros associados a este emprestimo e preencher o form
                                
                                //verifica se não é nulo
                               if($livros !== null){
                                    $numLivros = 1;
                                    foreach($livros as $idLinha){
                                        //faz  a consulta no BD com o ID atual
                                        $sql = "SELECT id_livro, titulo FROM livros WHERE id_livro = ".$idLinha;
                                        $result = $conn->query($sql);
                                        //cria um array associativo com o resultado da consulta
                                        while($linhaBD = mysqli_fetch_assoc($result)){
                                            //preenche o form com o titulo 
                                            echo "
                                                <div class='form-group'>
                                                <label>Livro ".$numLivros." Titulo:</label>
                                                <input type='text' class='form-control'value='".$linhaBD['titulo']."' disabled > <br> 
                                                <input type='hidden' name='livros[]' value='".$linhaBD['id_livro']."'> 
                                                </div>
                                            ";
                                        }
                                        $numLivros++;
                                    }
                                    $conn->close();
                               }    
                            ?>
                            
                            <div class="form-group">
                                    <label for="inputAutor">Observações:</label>
                                    <input type="text" class="form-control" name="txtObs" id="inputObs" > <br>  
                            </div>
                            
                            <a class="btn btn-danger"  href="list_emprestimo.php" >Voltar</a>
                        
                </div>
            </div>  
         </div>
    </body> 
</html>
