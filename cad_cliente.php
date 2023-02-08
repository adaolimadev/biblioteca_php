<html>
    <head>
    <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
       
        <title>Cadastrar Cliente</title>
        
    </head>

    <body>
    <?php require 'navbar.php';?>
        <br>
         <div class="container bg-light">
            <div class ="row"> 
                <div class = "col mt-5">
                    <h1 >Cadastro de Clientes</h1>

                        <form  action="actions.php?action=save_cliente" method="POST" role="form">
                            <div class="form-group">
                                    <label for="exampleInputEmail1">Nome:</label>
                                    <input type="text" class="form-control" name="txtNome"> <br>  
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">Email:</label>
                                <input type="email" class="form-control" name="txtEmail"> <br>
                            
                            </div>

                            <div class="form-group">
                                    <label for="exampleInputEmail1">CPF:</label>
                                    <input type="text" class="form-control"  name="txtCpf"> <br>  
                            </div>

                            <div class="form-group">
                                    <label for="exampleInputEmail1">Telefone:</label>
                                    <input type="text" class="form-control"  name="txtTelefone"> <br>  
                            </div>

                            <div class="form-group">
                                <label for="exampleInputPassword1">Senha:</label>
                                <input type="password" class="form-control" name="txtSenha" ><br> 
                            </div>

                            <div class="form-group form-check">
                                <input type="checkbox" class="form-check-input" >
                                <label class="form-check-label" for="exampleCheck1" >Sou estudante.</label> <br><br>
                            </div>

                            <button type="submit" class="btn btn-primary">Enviar</button>
                        </form>
                </div>
            </div>  
         </div>
    </body> 
</html>
