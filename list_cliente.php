
<html>

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
        
        <title>Listar Clientes</title>
    
        <style>
                .box-search{
                    display:flex;
                    gap: .2%;
                }
        </style>
    </head>

    <body>
    <?php require 'navbar.php'; require 'connection_mysql.php';?>


        <div class="container " >
            <div class ="row"> 
                <div class = "col mt-5">
                  <h1>Lista de clientes cadastrados</h1>
                
                  <div class ="box-search">
                    <input type="search" class="form-control w-25" placeholder="Pesquisar" id="pesquisar" >
                    <button class="btn btn-primary" onclick="searchData()"> <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                    <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
                    </svg>
                    </button><br>
                  </div>  

                    <?php  
                       //verifica se foi digitado algo no campo search
                       if (!empty($_GET['search'])) {
                        $data = $_GET['search'];
                        $sql = "SELECT * FROM clientes WHERE id_cliente LIKE '%$data%' or nome LIKE '%$data%' or email LIKE '%$data%' ";

                       }else{
                        $sql = "SELECT * FROM clientes;";
                       }
                       
                       $res = $conn->query($sql);
                       $qtd = $res->num_rows;

                        if($qtd >0){
                            echo " <table class='table table-hover' >";
                            //cria o cabeçalho da tabela
                            echo "<tr>"; 
                            echo "<th> # </th>";
                            echo "<th> Nome </th>";
                            echo "<th> CPF </th>";
                            echo "<th> Email </th>";
                            echo "<th> Telefone </th>";
                            echo "<th> Ações </th>";
                            echo "</tr>";  

                            //navega entre as linhas para preencher a tabela 
                            while($row = $res->fetch_object()){
                                //coluna
                                echo "<tr>"; 
                                //linhas
                                echo "<td> ".$row->id_cliente."</td>";
                                echo "<td> ".$row->nome."</td>";
                                echo "<td> ".$row->cpf."</td>";
                                echo "<td> ".$row->email."</td>";
                                echo "<td> ".$row->telefone."</td>";
                                echo "<td> 
                                        <button class='btn btn-primary' onclick=\"location.href='edit_cliente.php?id_cliente=".$row->id_cliente."';\">Editar</button>
                                        <button class='btn btn-danger' onclick=\"if(confirm('Tem certeza que deseja excluir?')){location.href='del_cliente.php?id_cliente=".$row->id_cliente."';}else{false;}\">Excluir</button>";
                                echo "</tr>";  
                            }                           
                            echo " </table>";
                        }else{
                            echo "<script> <p class='alert alert-danger'> Não foi encontrado resultados! </p> </script> ";
                        }

                        $conn->close();
                    ?>
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
           window.location = 'list_cliente.php?search='+search.value ;
        }

        </script> 
   </body>
    
</html>



