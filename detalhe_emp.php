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
                    <h1 >Livros Emprestados</h1>
                    <div class="form-group">
                            <label for="inputAutor">COD Emprestimo:</label>
                             <input type="text" class="form-control" name="txtId_cliente" id="inputAutor" value = "<?php print_r($_REQUEST['id_emp']);?>" disabled> <br>  
                    </div>
                               <?php
                                    require 'connection_mysql.php';  

                                    $id_emp = $_REQUEST['id_emp'];

                                    $sqlSelect = "SELECT id_livro, titulo from livros where id_livro IN (
                                        SELECT id_livro from livros_emp WHERE id_emprestimo = ".$id_emp.")";

                                    $result1 = $conn->query($sqlSelect);

                                    //Cria um Array $livros e preenche com os resultados do Select
                                    while($row = mysqli_fetch_assoc($result1)){
                                        $livros[]=$row;
                                    }
                                    $i=1;
                                    //Navega pelo Array trazendo o ID e Titulo
                                    foreach($livros as $idLinha){
                                        //Preenche o form com as info
                                        echo "
                                                <div class='form-group'>
                                                <label>Livro ".$i." Titulo:</label>
                                                <input type='text' class='form-control'value='".$idLinha['titulo']."' disabled > <br>  
                                                </div>
                                            ";
                                        $i++;    
                                    }
                                    $conn->close();
                            ?>
                            <a class="btn btn-danger"  href="list_emprestimo.php" >Voltar</a>
                </div>
            </div>  
         </div>
    </body> 
</html>
