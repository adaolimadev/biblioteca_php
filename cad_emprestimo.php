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
                    <h1 >Emprestar Livro</h1>

                        <form  action="action_livro.php?action=newEmp" method="POST" role="form">
                             <div class="form-group">
                                    <label for="inputTitulo">ID:</label>
                                    <input type="text" class="form-control" id="inputTitulo" value="<?php echo $id_livro?>" disabled > <br> 
                                    <input type="hidden" name="txtId_livro" value="<?php echo $id_livro?>"  > 
                            </div>
                            <div class="form-group">
                                    <label for="inputTitulo">Título:</label>
                                    <input type="text" class="form-control" name="txtTitulo" id="inputTitulo" value="<?php echo $titulo?>" disabled> <br>  
                            </div>
                            <div class="form-group">
                                    <label for="inputAutor">ID do cliente:</label>
                                    <div id="emailHelp" class="form-text"><strong> Inserir ID do cliente que deseja emprestar: </strong></div>
                                    <input type="text" class="form-control" name="txtId_cliente" id="inputAutor" > <br>  
                            </div>
                            <button type="submit" class="btn btn-primary">Emprestar</button>
                            <a  class="btn btn-danger" onclick="if(confirm('Tem certeza que deseja cancelar?')){location.href='index.php';}else{false;}">Cancelar</a>
                        </form>
                </div>
            </div>  
         </div>
    </body> 
</html>
