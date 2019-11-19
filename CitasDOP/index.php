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
    <link href="vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- Animate.css -->
    <link href="vendors/animate.css/animate.min.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="css/custom.min.css" rel="stylesheet">
  </head>
  <script type="text/javascript">
    function verificarUsuario(){
            var usuarioText = document.getElementById("usuarioText").value;
            var contraseniaText = document.getElementById("contraseniaText").value;
            if (window.XMLHttpRequest) {
                // code for IE7+, Firefox, Chrome, Opera, Safari
                xmlhttp = new XMLHttpRequest();
            } else {
                // code for IE6, IE5
                xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
            }
            xmlhttp.onreadystatechange = function () {
                if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                  if(this.responseText == "Estudiante"){
                    location.href = "php/cita.php";
                  }
                  else if(this.responseText == "Psicologa"){
                    location.href = "php/editarCatalogos.php";
                  }
                  else{
                    alert("Usuario o contraseña incorrectos");
                  }
                }
            };
            xmlhttp.open("GET", "php/verificarUsuario.php?usuario=" + usuarioText + "&contrasenia=" + contraseniaText , true);
            xmlhttp.send();
        }
        function registrarEstudiante(){
          var nombreText = document.getElementById("nombreText").value;
          var apellido1Text = document.getElementById("apellido1Text").value;
          var apellido2Text = document.getElementById("apellido2Text").value;
          var carnetText = document.getElementById("carnetText").value;
          var telefonoText = document.getElementById("telefonoText").value;
          var fechaNacText = document.getElementById("fechaNacText").value;
          var fechaNacTextArray = fechaNacText.split("/");
          var correoText = document.getElementById("correoText").value;
          var carreraText = document.getElementById("carreraText").value;
          var sexoText = document.getElementById("sexoText").value;
          var usuarioText2 = document.getElementById("usuarioText2").value;
          var contraseniaText2 = document.getElementById("contraseniaText2").value;
          if(nombreText == "" || apellido1Text == "" || apellido2Text == "" || carnetText == "" || telefonoText == "" || fechaNacText == "" || correoText == "" || carreraText == "" || sexoText == "" || usuarioText2 == "" || contraseniaText2 == ""){
            alert("Deben llenarse todos los campos");
          }
          else{
            if (window.XMLHttpRequest) {
                  // code for IE7+, Firefox, Chrome, Opera, Safari
                  xmlhttp = new XMLHttpRequest();
              } else {
                  // code for IE6, IE5
                  xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
              }
              xmlhttp.onreadystatechange = function () {
                  if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                    if(this.responseText == "Registro exitoso"){
                      alert("Registro exitoso");
                      location.href = "index.php";
                    }
                    else{
                      alert(this.responseText);
                    }
                  }
              };
              xmlhttp.open("GET", "php/registrarUsuario.php?nombre=" + nombreText + "&apellido1=" + apellido1Text + "&apellido2=" + apellido2Text + "&carnet=" + carnetText + "&telefono=" + telefonoText + "&dia=" + fechaNacTextArray[0] + "&mes=" + fechaNacTextArray[1] + "&anio=" + fechaNacTextArray[2] + "&correo=" + correoText + "&carrera=" + carreraText + "&sexo=" + sexoText + "&usuario2=" + usuarioText2 + "&contrasenia2=" + contraseniaText2 , true);
              xmlhttp.send();
          }
        }
        function verificarUsuarioEnter(event){
          if(event.keyCode == 13){
            verificarUsuario();
          }
        }
  </script>
  <body class="login">
     <?php
       include("php/database.php");
     ?>
    <div>
      <a class="hiddenanchor" id="signup"></a>
      <a class="hiddenanchor" id="signin"></a>

      <div class="login_wrapper">
        <div class="animate form login_form">
          <section class="login_content">
            <form>
              <h1>Inicio de Sesión</h1>
              <div>
                <input id = "usuarioText" type="text" class="form-control" placeholder="Usuario" required="" />
              </div>
              <div>
                <input onkeyup = "verificarUsuarioEnter(event)" id = "contraseniaText" type="password" class="form-control" placeholder="Contraseña" required ="" />
              </div>
              <div>
                <input class = 'btn btn-success' type='button' value='Ingresar' onclick = 'verificarUsuario()'>
              </div>
              <div class="clearfix"></div>

              <div class="separator">
                <p class="change_link">Regístrate aquí ->
                  <a href="#signup" class="to_register"> Crear cuenta </a>
                </p>
                <br>
                
                  <a onclick = 'location.href = "php/recuperarContrasena.php"' class="to_register"> Recuperar Contraseña </a>
        
                <div class="clearfix"></div>
                <br />

                <div>
                  <h1>Departamento de Orientación y Psicología</h1>
                </div>

              </div>
            </form>
          </section>
        </div>

        <div id="register" class="animate form registration_form">
          <section class="login_content">
            <form>
              <h1>Crear Cuenta</h1>
              <div>
                Nombre: <input id = "nombreText" type="text" name="nombre"  class="form-control" placeholder="Nombre" value="" required=""/>
              </div>
              <div>
                Primer apellido: <input id = "apellido1Text" type="text" name="Primer Apellido" class="form-control" placeholder="Primer apellido" value="" required=""/>
              </div>
              <div>
                Segundo apellido: <input id = "apellido2Text" type="text" name="Segundo Apellido" class="form-control" placeholder="Segundo apellido" value="" required=""/>
              </div>
              <div>
                Carné: <input id = "carnetText" type ="text" name="Carnet" class="form-control" placeholder="Numero de carné" value="" maxlength='10' value="" required=""/>
              </div>
              <div>
                Correo electrónico: <input id = "correoText" type="email" name="Correo Electronico" class="form-control" placeholder= "Correo electrónico" value="" required="" />
              </div>
              <div>
                Teléfono: <input id = "telefonoText" type="text" name="telefono" class="form-control" placeholder="Número telefónico" value="" maxlength='8' />
              </div>
              <div>
                Fecha de nacimiento:
                <div class='input-group date' id='myDatepicker2'>
                      <input id = "fechaNacText" type="text" class="form-control" />
                      <span class="input-group-addon">
                         <span class="glyphicon glyphicon-calendar"></span>
                      </span>
                  </div>
              </div>
              <div>
                Carrera:
                <?php
                   $sql = "SELECT * FROM `Carrera`";
                   $result = mysqli_query($conn, $sql);
                   echo "<select id = 'carreraText' class='form-control'>";
                   while($row = mysqli_fetch_assoc($result)) {
                      echo "<option value='".$row["idCarrera"]."'>".$row["carrera"]."</option>";
                   }
                   echo "</select><br>";
                ?>
              </div>    
              <div>
                Sexo:       
                <?php
                  $sql = "SELECT * FROM `Sexo`";
                  $result = mysqli_query($conn, $sql);
                  echo "<select id = 'sexoText' class='form-control'>";
                  while($row = mysqli_fetch_assoc($result)) {
                    echo "<option value='".$row["idSexo"]."'>".$row["sexo"]."</option>";
                  }
                  echo "</select><br>";
                ?>
              </div>
              <div>
                Usuario: <input id = "usuarioText2" type="text" name="usuario" class="form-control" placeholder="Usuario" value="" required=""/>
              </div>
              <div>
                Contraseña: <input id = "contraseniaText2" type="password" name="contrasena" class="form-control" placeholder="Contraseña" value="" required=""/>
              </div>

              <div>
                <input class = 'btn btn-success' type='button' value='Registrarme' onclick = 'registrarEstudiante()'>
              </div>

              <div class="clearfix"></div>

              <div class="separator">
                <p class="change_link">Iniciar Sesión ->
                  <a href="index.php" class="to_register"> Inicio </a>
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
    <script src="vendors/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- Custom Theme Scripts -->

    <script src="vendors/moment/min/moment.min.js"></script>
    <script src="vendors/bootstrap-daterangepicker/daterangepicker.js"></script>
    <script src="vendors/bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js"></script>

    <script>
    $('#myDatepicker').datetimepicker();
    
    $('#myDatepicker2').datetimepicker({
        format: 'DD/MM/YYYY'
    });
    
    $('#myDatepicker3').datetimepicker({
        format: 'hh:mm A'
    });
    </script>
  </body>
</html>
