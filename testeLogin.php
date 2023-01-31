<?php
    session_start();
    

    //verifica se existe o submit juntamente com os campos de senha
    if(isset($_POST['submit']) && !empty($_POST['txtUser']) && !empty($_POST['txtPass'])){
        
        //Se deu boa, Acessa o arquivo de conexão com bd e verifica se os dados existem no banco
        include_once('connection_mysql.php');
       
        $user = $_POST['txtUser'];
        $pass = $_POST['txtPass'];

        $sql = "SELECT * FROM admins WHERE user = '$user' AND pass = '$pass' ";

        $result = $conn->query($sql);

        //Verifica se o numero de linhas do result é maior q 0
        if(mysqli_num_rows($result) > 0 ){
            //Se existir linhas acessa o sistema

            //joga os valores recebido pelo post em variaveis da sessao.
            $_SESSION['user'] = $user;
            $_SESSION['pass'] = $pass;

            //header('Location: index.php');
            echo "<script> alert ('Login e senha corretos, Bem vindo ao sistema!');
             location.href='index.php'; </script>";


        }else{
            unset($_SESSION['user']);
            unset($_SESSION['pass']);

            //senão redireciona ao login novamente
            echo "<script> alert ('ERRO! Login ou senha incorretos!');
            location.href='login.php'; </script>";
        }
        
    
    }else{
        //Caso contrario redireciona novamente para o login
        header('Location: login.php');
    }

?>