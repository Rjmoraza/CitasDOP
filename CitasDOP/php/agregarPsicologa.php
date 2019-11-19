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
   <!-- <link href="../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">-->
    <!-- Bootstrap CSS -->
   <link  href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous" rel="stylesheet">
    
    <!-- Font Awesome -->
   <!-- <link href="../vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">-->

    <script src="../js/jquery.min.js"></script>
    <script src="../js/moment.min.js"></script>


    <!-- Custom styling plus plugins -->
     <link href="../build/css/custom.min.css" rel="stylesheet">
     <script src="../build/js/custom.min.js"></script>

    <!-- Switchery -->
    <link href="../vendors/switchery/dist/switchery.min.css" rel="stylesheet">

    <!--JQuery para bootsrap-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

  </head>
  <script type="text/javascript">
  	function registrarPsicologa(){
    	var nombreText = document.getElementById("nombreText").value;
    	var apellido1Text = document.getElementById("apellido1Text").value;
    	var apellido2Text = document.getElementById("apellido2Text").value;
    	var correoText = document.getElementById("correoText").value;
    	var usuarioText = document.getElementById("usuarioText").value;
    	var contraseniaText = document.getElementById("contraseniaText").value;
      if(nombreText == "" || apellido1Text == "" || apellido2Text == "" || correoText == "" || usuarioText == "" || contraseniaText == ""){
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
              		location.href = "psicologa.php";
              	}
              	else{
              		alert(this.responseText);
              	}
              }
          };
          xmlhttp.open("GET", "registrarPsicologa.php?nombre=" + nombreText + "&apellido1=" + apellido1Text + "&apellido2=" + apellido2Text + "&correo=" + correoText + "&usuario=" + usuarioText + "&contrasenia=" + contraseniaText , true);
          xmlhttp.send();
    	}
    }
    function cerrar(){
      if (window.XMLHttpRequest) {
          // code for IE7+, Firefox, Chrome, Opera, Safari
          xmlhttp = new XMLHttpRequest();
      } else {
          // code for IE6, IE5
          xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
      }
      xmlhttp.onreadystatechange = function () {
          if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            location.href = "../index.php";
          }
      };
      xmlhttp.open("GET", "cerrarSesion.php", true);
      xmlhttp.send();

    }
  </script>
  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">

            <div class="clearfix"></div>

            <!-- menu profile quick info -->
            <div class="profile clearfix">
              <div class="profile_info">
                <h2>Bienvenida: </h2>
                <?php
                  include("database.php");
                  session_start();
                  $sql = "SELECT * from Persona where idPersona = '".$_SESSION["usuarioActivo"]."'";
                  $result = mysqli_query($conn, $sql);
                  while($row = mysqli_fetch_assoc($result)) {
                      echo "<h2>".$row["nombre"]." ".$row["primerApellido"]." ".$row["segundoApellido"]."</h2>";
                  }
                ?>
              </div>
            </div>
            <!-- /menu profile quick info -->

            <br />

            <!-- sidebar menu -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
                <ul class="nav side-menu">
                  <h2>Menú Principal</h2>

                  <br>
                  <table>
                    <tr><td><button type="submit" class="btn btn-round btn-success" onclick = 'location.href = "calendarioPsicologa.php"'>Calendario</button></td></tr>
                    <tr><td><button type="submit" class="btn btn-round btn-success" onclick = 'location.href = "plantillaPsicologa.php"'>Horario</button></td></tr>
                    <tr><td><button type="submit" class="btn btn-round btn-success" onclick = 'location.href = "reportes.php"'>Reportes</button></td></tr>
                    <tr><td><button type="submit" class="btn btn-round btn-success" onclick = 'location.href = "agregarPsicologa.php"'>Agregar Psicóloga</button></td></tr>
                    <tr><td><button type="submit" class="btn btn-round btn-success" onclick = 'location.href = "editarCatalogos.php"'>Edición catálogos</button></td></tr>
                    <tr><td><button type="submit" class="btn btn-round btn-danger" onclick = 'cerrar()'>Cerrar sesión</button></td></tr>
                </table>

                </ul>
              </div> 
            </div>
            <div class="title-2" style="border: 0;">
                <h2>Departamento de Orientación y Psicología</h2>
            </div>
          </div>
        </div>

        <!-- page content -->
        <div class="right_col" role="main">

          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Registrar Psicóloga</h3>
              </div>
            </div>            
            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12">
                <div class="x_panel">
                  <div class="x_content">
                      <div class="login_wrapper">
                          <section class="login_content">
                            <form>
                              <h1>Ingrese los datos:</h1>
                              <div>
                                Nombre: <input id = "nombreText" type="text" name="nombre"  class="form-control" placeholder="Nombre" value="" required=""/>
                              </div>
                              <div>
                                Primer apellido: <input id = "apellido1Text" type="text" name="Primer apellido" class="form-control" placeholder="Primer Apellido" value="" required=""/>
                              </div>
                              <div>
                                Segundo apellido: <input id = "apellido2Text" type="text" name="Segundo apellido" class="form-control" placeholder="Segundo Apellido" value="" required=""/>
                              </div>
                              <div>
                                Correo electrónico: <input id = "correoText" type="email" name="Correo electrónico" class="form-control" placeholder= "Correo Electrónico" value="" required="" />
                              </div>
                              <div>
                                Usuario: <input id = "usuarioText" type="text" name="usuario" class="form-control" placeholder="Usuario" value="" required=""/>
                              </div>
                              <div>
                                Contraseña: <input id = "contraseniaText" type="password" name="contrasena" class="form-control" placeholder="Contrasena" value="" required=""/>
                              </div>

                              <div>
                                <input class = 'btn btn-success' type='button' value='Registrar' onclick = 'registrarPsicologa()'>
                              </div>

                              <div class="clearfix"></div>
                                  <div>
                                  <h1>Departamento de Orientación y Psicología</h1>
                                </div>
                            </form>
                          </section>
                    </div>
                  </div>
                </div>
              </div>
            </div>
           
          </div>
        </div>
         <!-- /page content -->
      </div>
    </div>

    <!-- Switchery -->
    <script src="../vendors/switchery/dist/switchery.min.js"></script>

    <!-- FastClick -->
    <script src="../vendors/fastclick/lib/fastclick.js"></script>

    <!-- PNotify -->
    <script src="../vendors/pnotify/dist/pnotify.buttons.js"></script>
    <script src="../vendors/pnotify/dist/pnotify.nonblock.js"></script>

  </body>
</html>
