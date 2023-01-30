<?php
    require 'navbar.php';
    require 'connection_mysql.php';

    //Pegando as info do form e colocando em variáveis
    $id_cliente = $_POST['txtId_cliente'];
    $nome = $_POST['txtNome'];
    $email = $_POST['txtEmail'];
    $cpf = $_POST['txtCpf'];
    $telefone = $_POST['txtTelefone'];
    $senha = md5($_POST['txtSenha']);

    //Prepara o tratamento    
    $stmt = $conn->prepare("UPDATE clientes set nome = ?, cpf = ?, email = ?, telefone = ?, senha = ? where id_cliente =".$id_cliente );


    $stmt->bind_param("sssss", $nome, $cpf, $email, $telefone, $senha);

    if ($stmt->execute()) {
            echo "<script> alert ('Cliente alterado com sucesso!');
            location.href='index.php'; </script>";
    } else {
    echo "<script> alert ('Erro ao alterar cliente: " .$stmt->error ."'); </script>";
    }

    $stmt->close();
    $conn->close();
?>

<html>

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
        
        <title>CLIENTE ALTERADO</title>
        
    </head>

    <body>
        

     
   </body>
    
</html>



