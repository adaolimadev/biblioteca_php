<html>
    <head>
    <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
        <title>Editar Livro</title>  
    </head>

    <body>
    <?php
        require 'navbar.php';

        $id_livro = $_REQUEST["id_livro"];
       // echo "ID que chegou: ".$id_livro;

        require 'connection_mysql.php';
        
        $sql = "SELECT * FROM livros WHERE id_livro =".$id_livro;

        $result = $conn->query($sql);

        if($result->num_rows >0){
            while($linha = mysqli_fetch_assoc($result)){
                $id_livro = $linha['id_livro'];
                $titulo = $linha['titulo'];
                $autor = $linha['autor'];
                $editora = $linha['editora'];
                $genero = $linha['genero'];
                $ano = $linha['ano'];    
            }
            
        }else{
            echo "<script> <p class='alert alert-danger'> Livro não encontrado! </p>; location.href='index.php'; </script> ";
        }
    ?>
        <br>
        <div class="container bg-light">
            <div class ="row"> 
                <div class = "col mt-5">
                    <h1 >Editar Livro</h1>

                        <form  action="actions.php?action=saveEdit_livro" method="POST" role="form">
                             <div class="form-group">
                                    <label for="inputTitulo">ID:</label>
                                    <div id="emailHelp" class="form-text">O id não poderá ser alterado.</div>
                                    <input type="text" class="form-control" id="inputTitulo" value="<?php echo $id_livro?>" disabled > <br> 
                                    <input type="hidden" name="txtId_livro" value="<?php echo $id_livro?>"  > 
                            </div>
                            <div class="form-group">
                                    <label for="inputTitulo">Título:</label>
                                    <input type="text" class="form-control" name="txtTitulo" id="inputTitulo" value="<?php echo $titulo?>" > <br>  
                            </div>
                            <div class="form-group">
                                    <label for="inputAutor">Autor:</label>
                                    <input type="text" class="form-control" name="txtAutor" id="inputAutor" value="<?php echo $autor?>"> <br>  
                            </div>
                            <div class="form-group">
                                    <label for="inputTitulo">Editora:</label>
                                    <input type="text" class="form-control" name="txtEditora" id="inputEditora" value="<?php echo $editora?>"> <br>  
                            </div>
                            <div class="form-group">
                                    <label for="inputGenero">Gênero:</label>
                                    <input type="text" class="form-control" name="txtGenero" id="inputGenero" value="<?php echo $genero?>"> <br>  
                            </div>
                            <div class="form-group">
                                    <label for="inputAno">Ano:</label>
                                    <input type="number" class="form-control" name="txtAno" id="inputAno" value="<?php echo $ano?>"> <br>  
                            </div>
                            <button type="submit" class="btn btn-primary">Atualizar Cadastro</button>
                            <a  class="btn btn-danger" onclick="if(confirm('Tem certeza que deseja cancelar?')){location.href='list_livro.php';}else{false;}">Cancelar</a>
                        </form>
                </div>
            </div>  
         </div>
    </body> 
</html>
