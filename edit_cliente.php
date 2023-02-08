<?php

?>
<html>
    <head>
    <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
       
        <title>Editar Cliente</title>
        
    </head>
    <body>
   
    <?php
        require 'navbar.php';
        require 'connection_mysql.php';
        //echo "ID que chegou: ".$_REQUEST["id_cliente"];

        $sql = "SELECT * FROM clientes WHERE id_cliente =".$_REQUEST["id_cliente"];

        //recebe o retorno da Query e armazena no Array $res 
        $res = $conn-> query($sql);

        //busca resultado como um objeto e armazena em $row
        $row = $res-> fetch_object ();
    ?>
        <br>
         <div class="container bg-light">
            <div class ="row"> 
                <div class = "col mt-5">
                    <h1 >Edição de Cliente</h1>

                        <form  action="actions.php?action=saveEdit_cliente" method="POST" role="form">
                            <input type="hidden" name ="Xid_cliente" value ="<?php print $row->id_cliente; ?>">
                        <div class="form-group">
                                    <label >ID:</label>
                                    <div id="emailHelp" class="form-text">O id não poderá ser alterado.</div>
                                    <input type="text" class="form-control" name="txtId_cliente" value="<?php print $row->id_cliente; ?>" readonly> <br>  
                                </div>
                            <div class="form-group">
                                    <label >Nome:</label>
                                    <input type="text" class="form-control" name="txtNome" value="<?php print $row->nome;?>"> <br>  
                            </div>
                            <div class="form-group">
                                <label>Email:</label>
                                <input type="email" class="form-control" name="txtEmail" value="<?php print $row->email;?>"> <br>
                            </div>
                            <div class="form-group">
                                    <label>CPF:</label>
                                    <input type="text" class="form-control"  name="txtCpf" value="<?php print $row->cpf;?>"> <br>  
                            </div>
                            <div class="form-group">
                                    <label>Telefone:</label>
                                    <input type="text" class="form-control"  name="txtTelefone" value="<?php print $row->telefone;?>"> <br>  
                            </div>
                            <div class="form-group">
                                <label>Senha:</label>
                                <div id="emailHelp" class="form-text">É necessário criar uma nova senha.</div>
                                <input type="password" class="form-control" name="txtSenha" required ><br> 
                            </div>
                            <div class="form-group form-check">
                                <input type="checkbox" class="form-check-input" >
                                <label class="form-check-label">Sou estudante.</label> <br><br>
                            </div>
                            <button type="submit" class="btn btn-primary">Atualizar Cadastro</button>
                            <a  class="btn btn-danger" onclick="if(confirm('Tem certeza que deseja cancelar?')){location.href='index.php';}else{false;}">Cancelar</a>
                        </form>
                </div>
            </div>  
         </div>
    </body> 
</html>
