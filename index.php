<?php
$email = "";
$senha = "";

if ($_SERVER["REQUEST_METHOD"] == 'POST') {
  $email = $_POST["email"];
  $senha = $_POST["senha"];
  if (empty($email) || empty($senha)) {
    $mensagem = "Informe seu e-mail e senha!";
  } else {
    require_once('db.class.php');

    //VARIAVEL QUE VERIFICA SE A AUTENTICAÇÃO FOI REALIZADA
    $usuario_autenticado = false;
    $usuario_id = null;
    $usuario_perfil_id = null;

    $sql = "select * from tb_usuario where email='$email' and senha='$senha'";
    $objDb = new db();

    $linq = $objDb->conecta_mysql();
    $resultado_id = mysqli_query($linq, $sql);
    if ($resultado_id) {
      $dados_usuario = mysqli_fetch_array($resultado_id);
      if (!is_null($dados_usuario)) {

        session_start();

        $_SESSION['autenticado'] = 'SIM';
        $_SESSION['id'] = $dados_usuario["id"];
        $_SESSION['perfil_id'] = $dados_usuario["perfil_id"];
        header('Location: home.php');
      } else {
        $mensagem = "E-mail/senha inválidos";
      }
    } else {
      $mensagem = 'Erro na conexão com o BD';
    }
  }
}
?>

<html>

<head>
  <meta charset="utf-8" />
  <title>App Help Desk</title>

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

  <style>
    .card-login {
      padding: 30px 0 0 0;
      width: 350px;
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
  </nav>

  <div class="container">
    <div class="row">

      <div class="card-login">
        <div class="card">
          <div class="card-header">
            Login
          </div>
          <div class="card-body">
            <form method="post">
              <div class="form-group">
                <input name="email" value="<?= $email ?>" type="email" class="form-control" placeholder="E-mail">
              </div>
              <div class="form-group">
                <input name="senha" type="password" class="form-control" placeholder="Senha">
              </div>

              <?php if (!empty($mensagem)) { ?>

                <div class="text-danger">
                  <?= $mensagem ?>
                </div>

              <?php } ?>

              <button class="btn btn-lg btn-info btn-block" type="submit">Entrar</button>
            </form>
          </div>
        </div>
      </div>
    </div>
</body>

</html>