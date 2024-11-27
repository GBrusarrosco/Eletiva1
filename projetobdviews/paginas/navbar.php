<?php
    session_start();
    if(!isset($_SESSION['acesso'])){
        header('Location: login.php');        
    }
?>

<nav class="navbar navbar-expand-lg bg-primary" data-bs-theme="dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="/dashboard">Sistema de Gerenciamento de pontos</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
        <ul class="navbar-nav">
            <?php if ($_SESSION['nivel'] == 'adm'): ?>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Funcionários
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="funcionarios.php">Gerenciar</a></li>
                    </ul>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Cargos
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="cargos.php">Gerenciar</a></li>
                    </ul>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Turnos
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="turnos.php">Gerenciar</a></li>
                    </ul>
                </li>
            <?php else: ?>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Ponto
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="pontos.php">Gerenciar</a></li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="minhas_informacoes.php">Minhas Informações</a>
                </li>
            <?php endif; ?>
        </ul>
      <ul class="navbar-nav ms-auto">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Seja bem vindo(a) 
                    <?php
                      if (isset($_SESSION['funcionario']))
                        echo $_SESSION['funcionario'];
                    ?>
                </a>
                <ul class="dropdown-menu dropdown-menu-end">
                        <li><a class="dropdown-item" href="editar_funcionario.php">Editar dados</a></li>
                    <li><a class="dropdown-item" href="logout.php">Sair</a></li>
                </ul>
            </li>
        </ul>
    </div>
  </div>
</nav>
