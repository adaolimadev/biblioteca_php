<?php 
    include_once 'connection_mysql.php';
    //echo "<br> Ação =".$_REQUEST['action']. "<br>";
    //echo "<br> ID =".$_REQUEST['id_livro']. "<br>";

    switch(@$_REQUEST["action"]){

        case "save_livro":

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

        case "saveEdit_livro": 

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

        case "del_livro":   
           
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

        case "save_cliente":  
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
                        echo "<script>
                        if (confirm ('Cliente cadastrado com sucesso! Deseja cadastrar outro cliente? ')){
                        location.href='cad_cliente.php';
                    }else{
                        location.href='list_cliente.php';
                        } 
                        </script>";
                } else {
                    //echo "<br> <h1> Erro ao inserir dados: <h1>" . $stmt->error;
                echo "<script> alert ('Erro ao realziar cadastro:  " .$stmt->error ."'); </script>";
                }

                $stmt->close();

                $conn->close();
            break;

        case "saveEdit_cliente":
            
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

            if($stmt->execute()){
                    echo "<script> alert ('Cliente alterado com sucesso!');
                    location.href='index.php'; </script>";
            }else{
            echo "<script>alert ('Erro ao alterar cliente: " .$stmt->error ."');</script>";
            }
            $stmt->close();
            $conn->close();
            break;
        case "del_cliente":
            $id_cliente = $_REQUEST["id_cliente"];    

            //Prepara o tratamento    
            $stmt = $conn->prepare("DELETE from clientes where id_cliente = ?");
            
            $stmt->bind_param("s", $id_cliente);

            if ($stmt->execute()) {
                    echo "<script> alert ('Cliente excluido com sucesso!');
                    location.href='list_cliente.php'; </script>";
            } else {
            echo "<script> alert ('Erro ao excluir cliente: " .$stmt->error ."'); </script>";
            }

            $stmt->close();
            $conn->close();
            break;    

        case "save_emp":
            $livros = $_POST['livros'];
            $id_cliente = $_POST['txtId_cliente']; 
            $obs = $_POST['txtObs'];

            //Verifica se o ID do cliente existe
            $sqlCliente = "SELECT id_cliente FROM clientes WHERE id_cliente = ".$id_cliente.";";
            $res = $conn->query($sqlCliente);
            $qtd = $res->num_rows;
            if($qtd >0){
                //Se o cliente existir cria o emprestimo 
                $stmt = $conn->prepare("INSERT INTO emprestimos (id_cliente, data_emp, obs, status) values (?,CURRENT_TIMESTAMP,?, true);");
                $stmt->bind_param("is", $id_cliente, $obs);
                
                if($stmt->execute()){
                    //Recupera o último id do emprestimo criado
                     $lastIdEmp = $conn->insert_id;

                    foreach($livros as $idLivros ){
                        //Altera Status do livro
                        $stmtUpdate = $conn->prepare("UPDATE livros set disponivel = false WHERE id_livro = ? ;");
                        $stmtUpdate->bind_param("i", $idLivros);
                        $stmtUpdate->execute();
                        
                        //Criar registro na tabela 'Livros_Emp'
                        $stmtLivrosEmp = $conn->prepare("INSERT INTO livros_emp (id_livro, id_emprestimo) values (?,?);");
                        $stmtLivrosEmp->bind_param("ii", $idLivros, $lastIdEmp);
                        $stmtLivrosEmp->execute();
                    }
                    echo "<script> alert ('Emprestimo criado com sucesso!');
                    location.href='index.php'; </script>";
                }else{
                echo "<script> alert ('Erro ao criar emprestimo: " .$stmt->error ."'); </script>";
                }
            }else{
                echo "<script> alert('Atenção! Cliente não encontrado! Insira um ID válido!');
                     location.href='cad_emprestimo.php';
                    </script>";
            }
            $conn->close();
            break;

        case "devolution":
            $id_emp = $_REQUEST['id_emprestimo'];
            
            //alterar o status do emprestimo para Fechado
            $stmtUpdate = $conn->prepare("UPDATE emprestimos set status = false, data_dev = CURRENT_TIMESTAMP WHERE id_emprestimo = ? ;");
            $stmtUpdate->bind_param("i", $id_emp);
            
            if($stmtUpdate->execute()){
                //Altera os status dos livros para disponível
                $stmtUpdateLivros = $conn->prepare("UPDATE livros SET disponivel = true WHERE id_livro IN (
                                                     SELECT id_livro FROM livros_emp WHERE id_emprestimo = ?);");
                $stmtUpdateLivros->bind_param("i", $id_emp);
                $stmtUpdateLivros->execute();

                echo "<script> alert ('Empréstimo fechado com sucesso!');
                    location.href='list_emprestimo.php'; </script>";
            }else{
                echo "Erro ao Fechar empréstimo: ".$stmtUpdate->error;
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