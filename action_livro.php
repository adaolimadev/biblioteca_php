<?php 
    include_once 'connection_mysql.php';

    //echo "Ação =".$_REQUEST['action']. "<br>";

    switch(@$_REQUEST["action"]){
        case "novo":
            $titulo = $_POST['txtTitulo'];
            $autor = $_POST['txtAutor'];
            $editora = $_POST['txtEditora'];
            $genero = $_POST['txtGenero'];
            $ano = $_POST['txtAno'];

            $stmt = $conn->prepare("INSERT INTO livros (titulo, autor, editora, genero, ano) VALUES (?, ?, ?, ?, ?)");

            $stmt->bind_param("sssss", $titulo, $autor, $editora, $genero, $ano);

            if ($stmt->execute()) {
                    echo "<script> if (confirm ('Cadastro realizado com sucesso! /n Deseja realizar outro Cadastro? ')){location.href='cad_livro.php';}else{location.href='index.php'; } </script>";
            } else {
                
                echo "<script> alert ('Erro ao realziar cadastro:  " .$stmt->error ."'); </script>";
            }
        
            $stmt->close();
        
            $conn->close();

            break;

        case "editar":    
            //logica de editar livro
            break;

        case "excluir":    
            //logica de excluir livro
            break;    

        default:
        echo "chegou nada!";
        //header('Location: index.php');
    }


?>