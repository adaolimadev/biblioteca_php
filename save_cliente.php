<?php
    require 'navbar.php';
    require 'connection_mysql.php';

    //Pegando as info do form e colocando em variáveis
    $nome = $_POST['txtNome'];
    $email = $_POST['txtEmail'];
    $cpf = $_POST['txtCpf'];
    $telefone = $_POST['txtTelefone'];
    $senha = md5($_POST['txtSenha']);

    //Prepara o tratamento    
    $stmt = $conn->prepare("INSERT INTO clientes (nome, cpf, email, telefone, senha) VALUES (?, ?, ?, ?, ?)");

    $stmt->bind_param("sssss", $nome, $cpf, $email, $telefone, $senha);

    if ($stmt->execute()) {
        //echo "<br> <h1> Dados inseridos com sucesso! </h1>";
            echo "<script> alert ('Cliente Cadastrado com sucesso!');
            location.href='index.php'; </script>";
       

    } else {
        //echo "<br> <h1> Erro ao inserir dados: <h1>" . $stmt->error;
    echo "<script> alert ('Erro ao cadastrar: " .$stmt->error ."'); </script>";
    }

    $stmt->close();

    $conn->close();
?>

<html>

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
        
        <title>CLIENTE CADASTRADO</title>
        
    </head>

    <body>
        

     
   </body>
    
</html>



