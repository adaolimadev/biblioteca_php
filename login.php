<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
        
    <title>Login</title>

    <style></style>
</head>
<body>
        <div class="container mt-4">
            <div class="row align-items-center">
                <div class="col-md-10 mx-auto col-lg-5">
                    <h1 align="center" class="display-2" >BIBLIOTECA <br><img class=" mx-auto mb-4" src="https://www.svgrepo.com/show/373969/php2.svg" alt="" width="80" height="90">
                   </h1>
                       <form action="testeLogin.php" class="p-4 p-md-5 border rounded-3 bg-light" method="POST">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" name="txtUser" id="txtUser" placeholder="Usuário">
                            <label for="txtUser">Usuário</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="password" class="form-control" name="txtPass" id="txtPass" placeholder="Senha">
                            <label for="txtPass">Senha</label>
                        </div>
                        <div class="d-grid gap-2">
                        <input type="submit" class="btn large btn-primary" name="submit" value="Entrar">
                        </div>     
                    </form>
                </div>
            </div>
        </div>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>
</html>