
<html>

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
        
        <title>Listar Clientes</title>
        
    </head>

    <body>
    <?php require 'navbar.php'; ?>


        <div class="container " >
            <div class ="row"> 
                <div class = "col mt-5">
                    <?php
                        require 'connection_mysql.php';

                        $sql = "SELECT * FROM clientes;";

                        $res = $conn->query($sql);

                        $qtd = $res->num_rows;

                        echo "<h1>Lista de clientes cadastrados</h1><br><br>";

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
    
    

   </body>
    
</html>



