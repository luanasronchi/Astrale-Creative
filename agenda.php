<?php
session_start();
// Verifique se o usuário está logado, se não, redirecione-o para uma página de login
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: login.html");
    exit;
}
?>

<?php 
    include("php/conecta.php");
    $comando_hora ="SELECT hora FROM procedimentos";
    $comando_dia ="SELECT dia FROM procedimentos";
    $resultado_hora = $pdo->query($comando_hora)->fetchAll(); 
    $resultado_dia = $pdo->query($comando_dia)->fetchAll(); 
    $count = count($resultado_dia);
    

    $i_procedimentos = $count-1;        
    echo $i_procedimentos;
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  
  <link href="https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>
  <title>Unic Stetic Center - Agenda </title>
  <link rel="stylesheet" href="assets/style.css">
  <script src="assets/script.js" defer></script>
</head>

<body class="body-panel white_theme">
    <div class="panel mt-5">
      <div class="margin-top">
        <h1 class="h1">Agenda</h1>
        <br>
        <h3 class="h3">Procedimentos</h3>
        <table class="table   table-bordered table-condensed table-hover">
          <thead>
              <tr>
                <td>Média</td>
                <td>Paciente</td>
                <td>Telefone</td>
                <td>Data</td>
                <td>Hora</td>
                <td>Complemento</td>
                <td>Status</td>
              </tr>
          </thead>
          <tbody>
            <?php
              include("php/schedule.php");
              //verifica se a variável tem os valores da tabela.
              if (!empty($agenda_procedimento)) {
                  //seleciona linha por linha.
                  foreach ($agenda_procedimento as $linha) { ?>
                    <tr>
                        <td> <?php echo $linha['nomeMed']; ?></td>
                        <td> <?php echo $linha['nomePac']; ?></td>
                        <td> <?php echo $linha['telefone']; ?></td>
                        <td> <?php echo $linha['dia']; ?></td>
                        <td> <?php echo $linha['hora']; ?></td>
                        <td> <?php echo $linha['complemento']; ?></td>
                        <td> <?php echo $linha['status']; ?></td>
                    </tr>
              <?php }
              } 
            ?>
          </tbody>
        </table>

        <h3 class="h3">Consultas</h3>
        <table class="table table-striped table-bordered table-condensed table-hover">
          <thead>
              <tr>
                <td>Média</td>
                <td>Paciente</td>
                <td>Telefone</td>
                <td>Data</td>
                <td>Hora</td>
                <td>Complemento</td>
                <td>Status</td>
              </tr>
            
          </thead>
          <tbody>
          <?php
              include("php/schedule.php");
              //verifica se a variável tem os valores da tabela.
              if (!empty($agenda_consulta)) {
                  //seleciona linha por linha.
                  foreach ($agenda_consulta as $linha) { ?>
                    <tr>
                        <td> <?php echo $linha['nomeMed']; ?></td>
                        <td> <?php echo $linha['nomePac']; ?></td>
                        <td> <?php echo $linha['telefone']; ?></td>
                        <td> <?php echo $linha['dia']; ?></td>
                        <td> <?php echo $linha['hora']; ?></td>
                        <td> <?php echo $linha['complemento']; ?></td>
                        <td> <?php echo $linha['status']; ?></td>
                    </tr>
              <?php }
              } 
            ?>
          </tbody>
        </table>
      </div>
    </div>

<!-- ------------------------ -->

<nav>
  <div class="logo">
    <i class="bx bx-menu bx-sm menu-icon"></i>
    <span class="logo-name">Unic Stetic Center</span>
  </div>
  <div class="sidebar">
    <div class="logo">
      <i class="bx bx-menu bx-sm menu-icon"></i>
      <img id="sidebar_logo" src="assets/img/sidebar_logo_black.svg" alt="" width="50%">
    </div>

    <div class="sidebar-content">
      <ul class="p-1 lists">
        <li class="list">
          <a href="pacientes.html" class="nav-link">
            <i class="bx bx-home icon"></i>
            <span class="link">Pacientes</span>
          </a>
        </li>
        <li class="list">
          <a href="consultas.html" class="nav-link">
            <i class="bx bx-clipboard icon"></i>
            <span class="link">Consultas</span>
          </a>
        </li>
        <li class="list">
            <a href="procedimentos.html" class="nav-link">
              <i class="bx bx-clipboard icon"></i>
              <span class="link">Procedimentos</span>
            </a>
        </li>
        <li class="list">
          <a href="#" class="nav-link">
            <i class="bx bx-box icon"></i>
            <span class="link">Estoque</span>
          </a>
        </li>
        <li class="list">
          <a href="agenda.php" class="nav-link">
            <i class="bx bx-time-five icon"></i>
            <span class="link">Agenda</span>
          </a>
        </li>
      </ul>

      <div class="bottom-cotent">
        <li class="list">
          <a href="#" class="nav-link">
            <i class="icon">
            <div class="form-check form-switch">
             <input class="form-check-input" name="change-theme" id="change-theme" type="checkbox" >
            </div>
            </i>
            <span class="link">Tema</span>
          </a>
        </li>
        <li class="list">
          <form id="logout" action="php/logout.php" method="POST">
          <a class="nav-link" href="#" onclick="document.getElementById('logout').submit()">
            <i class="bx bx-log-out icon"></i>
            <input style="display:none" type="submit" class="link" value="Logout">
            <span class="link">Logout</span>
          </a>
          </form>
        </li>
      </div>
    </div>
  </div>
</nav>





  <!-- --------------------------------- -->
  
  <!-- --------------------------------- -->

</div>
<script src="assets/script.js"></script>
  <script>
    const navBar = document.querySelector("nav"),
      menuBtns = document.querySelectorAll(".menu-icon");

    menuBtns.forEach((menuBtn) => {
      menuBtn.addEventListener("click", () => {
        navBar.classList.toggle("closed");
      });
    });

    overlay.addEventListener("click", () => {
      navBar.classList.remove("closed");
    });
  </script>

  
</body>
</html>