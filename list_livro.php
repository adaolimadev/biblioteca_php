<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <title>Lista de Livros</title>
    <style>
                .box-search{
                    display:flex;
                    gap: .2%;
					allign: center;
                }
        </style>
</head>
<body>
    <?php include_once 'navbar.php';?>
    <br>
    <div class="container bg-light">
        <div class ="row"> 
            <div class = "col mt-5">
                <h1 class="text-center" >Lista de Livros</h1><br>
                <div class ="box-search">
                <a class ="btn btn-success" href="cad_livro.php">Novo Livro</a> 
                    <input type="search" class="form-control w-25" placeholder="Pesquisar" id="pesquisar" >
                    <button class="btn btn-primary" onclick="searchData()"> <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                    <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
                    </svg>
                    </button><br>
                  </div>  <br>
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
                                or editora LIKE '%$data%' or ano LIKE '%$data%' ";
                            }else{
                                    $sql = "SELECT * FROM livros ORDER BY 1 DESC;";
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
                                        <button class='btn btn-primary' onclick=\"location.href='edit_livro.php?id_livro=".$linha['id_livro']."';\">
                                        <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-pencil' viewBox='0 0 16 16'>
                                        <path d='M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z'/>
                                        </svg>
                                        </button>
                                        <button class='btn btn-danger' onclick=\"
                                        if(confirm('Tem certeza que deseja excluir o livro de ID:".$linha['id_livro']." ? \\nEsta operação não poderá ser desfeita!')){
                                            location.href='action_livro.php?action=delete&id_livro=".$linha['id_livro']."';
                                        }else{false;}\">
                                        <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-trash3' viewBox='0 0 16 16'>
                                        <path d='M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5ZM11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H2.506a.58.58 0 0 0-.01 0H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1h-.995a.59.59 0 0 0-.01 0H11Zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5h9.916Zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47ZM8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5Z'/>
                                        </svg>
                                        </button>";
                                echo "</tr>"; 
                            }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>    
    </div>
    <script> 
        //pega o valor digitado na caixa pesquisar e armazena em $search
        var search = document.getElementById('pesquisar');
        
        //verifica se a tecla Enter foi pressionada
        search.addEventListener("keydown", function(event){
            if(event.key === "Enter"){
                searchData();
            }
        });
        function searchData(){
           window.location = 'list_livro.php?search='+search.value ;
        }
        </script> 
</body>
</html>