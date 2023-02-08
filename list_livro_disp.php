<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <title>Livros Disponíveis</title>
    <style>
        input[type="submit"] {
            display: block;
            margin: 0 auto;
            width: 300px;
        }
</style>
</head>
<body>
    <?php include_once 'navbar.php';?>
    <br>
    <div class="container bg-light">
        <div class ="row"> 
            <div class = "col mt-5">
                <h1 class="text-center" >Livros Disponíveis</h1><br>
                <h2 class="text-center" >Selecione os livros que deseja emprestar: </h2><br>
             
                <form action="cad_emprestimo.php" method="post">
                    
                    <table class="table table-hover text-center">
                        <thead>
                            <tr>
                                <th scope="col">COD</th>
                                <th scope="col">Titulo</th>
                                <th scope="col">Autor</th>
                                <th scope="col">Editora</th>
                                <th scope="col">Gênero</th>
                                <th scope="col">Ano</th>
                                <th scope="col">Status</th>
                                <th scope="col">Emprestar</th>
                            </tr>
                        </thead>
                        <tbody> 
                            <?php 
                                include_once 'connection_mysql.php';
                                
                                if(!empty($_GET['search'])){
                                    $data = $_GET['search'];
                                    $sql = "SELECT * FROM livros WHERE id_livro LIKE '%$data%' or titulo LIKE '%$data%' or autor LIKE '%$data%' or genero LIKE '%$data%' 
                                    or editora LIKE '%$data%' or ano LIKE '%$data%' AND disponivel = 1 ";
                                }else{
                                        $sql = "SELECT * FROM livros where disponivel = 1;";
                                }

                                $result = $conn->query($sql);

                                while($linha = mysqli_fetch_assoc($result)){
                                    
                                    if ($linha['disponivel']==1){
                                        $status = "Disponível";
                                    }else{
                                        $status = "Emprestado";
                                    }
                                    
                                    echo "<tr>";
                                    echo "<td>".$linha['id_livro']."</td>";
                                    echo "<td>".$linha['titulo']."</td>";
                                    echo "<td>".$linha['autor']."</td>";
                                    echo "<td>".$linha['editora']."</td>";
                                    echo "<td>".$linha['genero']."</td>";
                                    echo "<td>".$linha['ano']."</td>";
                                    echo "<td>".$status."</td>";
                                    echo "<td> 
                                            <input type ='checkbox' name = 'ckLivros[]' value = '".$linha['id_livro']."'>
                                          </td>" ;
                                    
                                    echo "</tr>"; 
                                }
                            ?>
                        </tbody>
                    </table>
                    <input type="submit" class ="btn btn-success" id="btnEmprestar" value="Emprestar Livros"><br>
                </form>                
            </div>
        </div>    
    </div>
</body>
</html>