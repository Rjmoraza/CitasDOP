<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Citas DOP| </title>

    <!-- Bootstrap -->
    <link href="../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="../vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="../vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- Animate.css -->
    <link href="../vendors/animate.css/animate.min.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="../css/custom.min.css" rel="stylesheet">
  </head>

  <body class="login">
    <div>
      <a class="hiddenanchor" id="signup"></a>
      <a class="hiddenanchor" id="signin"></a>

      <div class="login_wrapper">
        <div class="animate form login_form">
          <section class="login_content">
            <form action = "recuperarPorCorreo.php" method="post">
              <h4>Recuperar Contraseña</h4>
              <div>
                <input name = "usuarioRText" type="text" placeholder="Usuario" required="" />
              </div>
              <div>
                <input name = "CorreoRText"  type="text" placeholder="Correo" required ="" />
              </div>
              <br>
              <div>
                <input class = 'btn btn-success' type='submit' value='Recuperar Contraseña'>
              </div>
              <div class="clearfix"></div>
              <br>
              <div class="separator">
                <p class="change_link">Página principal ->
                  <a onclick = 'location.href = "../index.php"' class="to_register"> inicio</a>
                </p>

                <div class="clearfix"></div>
                <br />

                <div>
                  <h1>Departamento de Orientación y Psicología</h1>
                </div>

              </div>
            </form>
          </section>
        </div>

      </div>
    </div>
    <script src="../vendors/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="../vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- Custom Theme Scripts -->

    <script src="../vendors/moment/min/moment.min.js"></script>
    <script src="../vendors/bootstrap-daterangepicker/daterangepicker.js"></script>
    <script src="../vendors/bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js"></script>
  </body>
</html>
