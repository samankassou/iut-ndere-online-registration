<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>IUT Concours| Admin</title>
  <link rel="shortcut icon" href="<?= img_url('logos/logo_iut.jpg')?>">
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?= base_url() ?>assets/template/plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="<?= base_url() ?>assets/template/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?= base_url() ?>assets/template/dist/css/adminlte.min.css">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href="<?= base_url() ?>assets/template/index2.html"><b>IUT Concours</b> Admin</a>
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <p class="text-center"><a href="<?= site_url('admin') ?>">
        <img src="<?= img_url('logos/logo_iut.jpg')?>" class="img-rounded text-center img-circle elevation-3 w-25 h-25" alt="IUT Logo">
      </a>
    </p>
      <p class="login-box-msg">Veuillez vous connecter pour continuer</p>

      <form action="<?= base_url() ?>login/index" method="post">
        <div class="input-group mb-3 <?= empty(form_error('password'))?'':'has-error' ?>">
          <input type="text" class="form-control" name="email"  value="<?= set_value('email') ?>" placeholder="Email">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3 <?= empty(form_error('password'))?'':'has-error' ?>">
          <input type="password" class="form-control" name="password" placeholder="Mot de passe">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="help-block text-light text-center <?= empty(validation_errors())?'':'alert-danger'?> <?= (!empty($msg))?'alert-danger':'' ?>" id="error">
          <small><?= validation_errors() ?></small><p><?= (!empty($msg))?$msg:'' ?></p>
        </div>
        <div class="row">
          <div class="col-7">
            <div class="icheck-primary">
              <input type="checkbox" id="remember">
              <label for="remember">
                Se souvenir
              </label>
            </div>
          </div>
          <!-- /.col -->
          <div class="col-5">
            <button type="submit" class="btn btn-primary btn-block">Connexion</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

      <p class="mb-1">
        <a href="Login/forgot_password">Mot de passe oublié?</a>
      </p>
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="<?= base_url() ?>assets/template/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="<?= base_url() ?>assets/template/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="<?= base_url() ?>assets/template/dist/js/adminlte.min.js"></script>

</body>
</html>
