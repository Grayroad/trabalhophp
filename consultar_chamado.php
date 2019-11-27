<?php
require_once("validador_acesso.php");
require_once("db.class.php");
//array de chamados

$sql = "select c.*, cat.categoria from tb_chamado c
          inner join tb_categoria cat on cat.idCategoria = c.idCategoria";

if ($_SESSION['perfil_id'] != 1) {
  $idUsuario = $_SESSION["id"];
  $sql .= " where c.idUsuario = $idUsuario";
}

$objDb = new db();

$linq = $objDb->conecta_mysql();
$resultado_id = mysqli_query($linq, $sql);
?>
<html>

<head>
  <meta charset="utf-8" />
  <title>App Help Desk</title>

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

  <style>
    .card-consultar-chamado {
      padding: 30px 0 0 0;
      width: 100%;
      margin: 0 auto;
    }
  </style>
</head>

<body>

  <nav class="navbar navbar-dark bg-dark">
    <a class="navbar-brand" href="#">
      <img src="logo.png" width="30" height="30" class="d-inline-block align-top" alt="">
      App Help Desk
    </a>
    <ul class="navbar-nav">
      <li class="nav-item">
        <a href="logoff.php" class="nav-link">
          SAIR
        </a>
      </li>
    </ul>
  </nav>

  <div class="container">
    <div class="row">

      <div class="card-consultar-chamado">
        <div class="card">
          <div class="card-header">
            Consulta de chamado
          </div>

          <div class="card-body">

            <?php while ($chamado = mysqli_fetch_array($resultado_id)) { ?>
              <div class="card mb-3 bg-light">
                <div class="card-body">
                  <h5 class="card-title"><?= $chamado["titulo"] ?></h5>
                  <h6 class="card-subtitle mb-2 text-muted"><?= $chamado["categoria"] ?></h6>
                  <p class="card-text"><?= $chamado["descricao"] ?></p>
                </div>
              </div>
            <?php } ?>
            <div class="row mt-5">
              <div class="col-6">
                <a href="home.php" class="btn btn-lg btn-warning btn-block">Voltar</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>

</html>