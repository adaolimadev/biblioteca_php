<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <title>Livros Disponíveis</title>
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
                <h1 class="text-center" >Livros Disponíveis</h1><br>
                <div class ="box-search">
                    <input type="search" class="form-control w-25" placeholder="Pesquisar" id="pesquisar" >
                    <button class="btn btn-primary" onclick="searchData()"> <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                    <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
                    </svg>
                    </button><br>
                  </div>  
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
                                or editora LIKE '%$data%' or ano LIKE '%$data%' where disponivel = 1 ";
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
                                        <button class='btn btn-primary' onclick=\"location.href='cad_emprestimo.php?id_livro=".$linha['id_livro']."';\">
                                        <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-book' viewBox='0 0 16 16'>
                                        <path d='M1 2.828c.885-.37 2.154-.769 3.388-.893 1.33-.134 2.458.063 3.112.752v9.746c-.935-.53-2.12-.603-3.213-.493-1.18.12-2.37.461-3.287.811V2.828zm7.5-.141c.654-.689 1.782-.886 3.112-.752 1.234.124 2.503.523 3.388.893v9.923c-.918-.35-2.107-.692-3.287-.81-1.094-.111-2.278-.039-3.213.492V2.687zM8 1.783C7.015.936 5.587.81 4.287.94c-1.514.153-3.042.672-3.994 1.105A.5.5 0 0 0 0 2.5v11a.5.5 0 0 0 .707.455c.882-.4 2.303-.881 3.68-1.02 1.409-.142 2.59.087 3.223.877a.5.5 0 0 0 .78 0c.633-.79 1.814-1.019 3.222-.877 1.378.139 2.8.62 3.681 1.02A.5.5 0 0 0 16 13.5v-11a.5.5 0 0 0-.293-.455c-.952-.433-2.48-.952-3.994-1.105C10.413.809 8.985.936 8 1.783z'/>
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