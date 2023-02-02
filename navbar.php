<?php
 
 session_start();

    if((!isset($_SESSION['user']) == true) and(!isset($_SESSION['pass']) == true) ){
        header('Location: login.php');
    }
        
?>

<nav class="navbar navbar-expand-lg navbar-dark bg-primary ">
            <a class="navbar-brand" href="index.php">BIBLIOTECA PHP</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="index.php">Home</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-expanded="false">
                    Cliente
                    </a>
                    <div class="dropdown-menu">
                    <a class="dropdown-item" href="cad_cliente.php">Cadastrar</a>
                    <a class="dropdown-item" href="list_cliente.php">Listar</a>
                    </div>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-expanded="false">
                    Livro
                    </a>
                    <div class="dropdown-menu">
                    <a class="dropdown-item" href="cad_livro.php">Cadastrar</a>
                    <a class="dropdown-item" href="list_livro.php">Listar</a>
                    </div>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-expanded="false">
                    Empréstimo
                    </a>
                    <div class="dropdown-menu">
                    <a class="dropdown-item" href="#">Novo empréstimo</a>
                    <a class="dropdown-item" href="#">Ver empréstimos</a>
                    </div>
                </li>
                </ul>
            </div>
            <div class="d-flex ">
                <span class="navbar-text me-5">User: <?php print_r($_SESSION['user']);?>  </span>
                <a onclick="if(confirm('Tem certeza que deseja sair do sistema?')){location.href='action_livro.php?action=exit';}else{false;}"  class="btn btn-danger me-5"> Sair </a>   
            </div>
        </nav>
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
        
       