<?php
    require 'navbar.php';
    require 'connection_mysql.php';

    $id_cliente = $_REQUEST["id_cliente"];    

    //Prepara o tratamento    
    $stmt = $conn->prepare("DELETE from clientes where id_cliente = ?");
    

    $stmt->bind_param("s", $id_cliente);

    if ($stmt->execute()) {
            echo "<script> alert ('Cliente excluido com sucesso!');
            location.href='index.php'; </script>";
    } else {
    echo "<script> alert ('Erro ao excluir cliente: " .$stmt->error ."'); </script>";
    }

    $stmt->close();
    $conn->close();
?>

<html>

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
        
        <title>CLIENTE DELETADO</title>
        
    </head>

    <body>
        

     
   </body>
    
</html>



