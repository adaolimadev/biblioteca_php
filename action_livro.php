<?php 
    include_once 'connection_mysql.php';
    //echo "<br> Ação =".$_REQUEST['action']. "<br>";
    //echo "<br> ID =".$_REQUEST['id_livro']. "<br>";

    switch(@$_REQUEST["action"]){

        case "saveNew":

            $titulo = $_POST['txtTitulo'];
            $autor = $_POST['txtAutor'];
            $editora = $_POST['txtEditora'];
            $genero = $_POST['txtGenero'];
            $ano = $_POST['txtAno'];

            $stmt = $conn->prepare("INSERT INTO livros (titulo, autor, editora, genero, ano, disponivel) VALUES (?, ?, ?, ?, ?, true)");
            $stmt->bind_param("sssss", $titulo, $autor, $editora, $genero, $ano);

            if($stmt->execute()){
                    echo "<script>
                     if (confirm ('Livro cadastrado com sucesso! Deseja cadastrar outro livro? ')){
                        location.href='cad_livro.php';
                    }else{
                        location.href='index.php';
                     } 
                     </script>";
            }else{
                echo "<script> alert ('Erro ao realizar cadastro:  " .$stmt->error ."');location.href='index.php'; </script>";
            }
            $stmt->close();
            $conn->close();
            break;

        case "saveEdit": 

            $id_livro = $_POST['txtId_livro'];
            $titulo = $_POST['txtTitulo'];
            $autor = $_POST['txtAutor'];
            $editora = $_POST['txtEditora'];
            $genero = $_POST['txtGenero'];
            $ano = $_POST['txtAno'];

            $stmt = $conn->prepare("UPDATE livros SET titulo = ?, autor = ?, editora = ?, genero = ?, ano = ? WHERE id_livro = ?; ");
            $stmt->bind_param("ssssss", $titulo, $autor, $editora, $genero, $ano, $id_livro);

            if($stmt->execute()){
                    echo "<script> alert ('Livro alterado com sucesso!');
                    location.href='list_livro.php'; </script>";
            }else{
            echo "<script> alert ('Erro ao alterar cliente: " .$stmt->error ."'); </script>";
            }
            $stmt->close();
            $conn->close();
            break;

        case "delete":   

           // echo  "chegou no delete ID: ".$_REQUEST['id_livro']; ;
            $id_livro = $_REQUEST['id_livro']; 
            //Prepara o tratamento    
            $stmt = $conn->prepare("DELETE from livros where id_livro = ?");
            $stmt->bind_param("s", $id_livro);

            if($stmt->execute()){
                    echo "<script> alert ('Livro excluido com sucesso!');
                    location.href='list_livro.php'; </script>";
            }else{
            echo "<script> alert ('Erro ao excluir livro: " .$stmt->error ."'); </script>";
            }
            $stmt->close();
            $conn->close();
            break;  
            
            case "newEmp":
                $id_livro = $_POST['txtId_livro']; 
                $id_cliente = $_POST['txtId_cliente']; 
                echo "chegou no newEmp";
                echo "<br> id livro: ".$id_livro;
                echo "<br> id cliente: ".$id_cliente;

                break;

            case "exit":
                //destroi a sessão e redireciona para o login
                session_start();
                unset($_SESSION['user']);
                unset($_SESSION['pass']);
                header('Location: login.php');
            break; 

        default:
        echo "chegou nada!";
        //header('Location: index.php');
    }


?>