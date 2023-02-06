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
            // echo "chegou no newEmp";
            // echo "<br> id livro: ".$id_livro;
            // echo "<br> id cliente: ".$id_cliente;
            $id_livro = $_POST['txtId_livro']; 
            $id_cliente = $_POST['txtId_cliente']; 
            $obs = $_POST['txtObs'];


            $sqlCliente = "SELECT id_cliente FROM clientes WHERE id_cliente = ".$id_cliente;
            $res = $conn->query($sqlCliente);
            $qtd = $res->num_rows;

            if($qtd >0){
                //Alterar Status do Livro
                $sqlDispLivro = "UPDATE livros set disponivel = false where id_livro =".$id_livro.";";
                $res = $conn->query($sqlDispLivro);

                //Adicionar uma linha a tabela Emprestimos com id_cliente e id_livro
                $stmt = $conn->prepare("INSERT INTO emprestimos (id_cliente, id_livro,data_emprestimo, obs) values (?,?,CURRENT_TIMESTAMP,?);" );
                
                $stmt->bind_param("sss", $id_cliente, $id_livro, $obs);
                if ($stmt->execute()) {
                        echo "<script> alert ('Cadastro de empréstimo realizado com sucesso!');
                        location.href='list_emprestimo.php'; </script>";
                }else{
                echo "<script> alert ('Erro ao realziar cadastro:  " .$stmt->error ."'); </script>";
                 }
                 $stmt->close();
            }else{
                echo "<script> alert('Atenção! Cliente não encontrado! Insira um ID válido!');
                     location.href='cad_emprestimo.php?id_livro=".$id_livro."'
                    </script>";
                }
                $conn->close();
                break;

        case "devolver":
            $id_emprestimo = $_REQUEST['id_emprestimo'];
            $id_livro = $_REQUEST['id_livro'];
            echo "Chegou no devolver: ";
            echo "<br> chegou ID EMPRESTIMO:  ".$id_emprestimo;
            echo "<br> chegou ID LIVRO:  ".$id_livro;

            $stmt = $conn->prepare("DELETE FROM emprestimos WHERE id_emprestimo = ?");

            $stmt->bind_param("s", $id_emprestimo);
            if($stmt->execute()){
                
                $sqlDispLivro = "UPDATE livros set disponivel = true where id_livro =".$id_livro.";";
                $res = $conn->query($sqlDispLivro);
                echo "<script> alert ('Empréstimo devolvido com sucesso!');
                    location.href='list_emprestimo.php'; </script>";
            }else{
                echo "<script> alert ('Erro ao devolver emprestimo:  " .$stmt->error ."'); </script>";
            }

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