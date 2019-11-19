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
  <?php
    include("database.php");
    session_start();
  ?>
  <script type="text/javascript">
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

    function registrarCarrera(){
          var carreraTextIn = document.getElementById("carreraTextIn").value;
          if(carreraTextIn == ""){
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
                      alert(this.responseText);
                      location.href = "editarCatalogos.php";
                  }
              };
              xmlhttp.open("GET", "registrarCarrera.php?carrera=" + carreraTextIn, true);
              xmlhttp.send();
          }
        }

    function eliminarCarrera(){
      var carreraText = document.getElementById("carreraText").value;
      if(carreraText == ""){
        alert("Debe elegir una opcion a eliminar");
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
                  alert(this.responseText);
                  location.href = "editarCatalogos.php";
              }
          };
          xmlhttp.open("GET", "eliminarCarrera.php?idCarrera=" + carreraText, true);
          xmlhttp.send();
      }
    }
    function registrarMotivo(){
      var motivoTextIn = document.getElementById("motivoTextIn").value;
      if(motivoTextIn == ""){
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
                  alert(this.responseText);
                  location.href = "editarCatalogos.php";
              }
          };
          xmlhttp.open("GET", "registrarMotivo.php?motivo=" + motivoTextIn, true);
          xmlhttp.send();
      }
    }

    function eliminarMotivo(){
      var motivoText = document.getElementById("motivoText").value;
      if(motivoText == ""){
        alert("Debe elegir una opcion a eliminar");
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
                  alert(this.responseText);
                  location.href = "editarCatalogos.php";
              }
          };
          xmlhttp.open("GET", "eliminarMotivo.php?idMotivo=" + motivoText, true);
          xmlhttp.send();
      }
    }
    function registrarReferencia(){
      var referenciaTextIn = document.getElementById("referenciaTextIn").value;
      if(referenciaTextIn == ""){
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
                  alert(this.responseText);
                  location.href = "editarCatalogos.php";
              }
          };
          xmlhttp.open("GET", "registrarReferencia.php?referencia=" + referenciaTextIn, true);
          xmlhttp.send();
      }
    }

    function eliminarReferencia(){
      var referenciaText = document.getElementById("referenciaText").value;
      if(referenciaText == ""){
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
                  alert(this.responseText);
                  location.href = "editarCatalogos.php";
              }
          };
          xmlhttp.open("GET", "eliminarReferencia.php?idReferencia=" + referenciaText, true);
          xmlhttp.send();
      }
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
									if($_SESSION["usuarioActivo"] !== "-1")
									{
										$sql = "SELECT * from Persona where idPersona = '".$_SESSION["usuarioActivo"]."'";
										$result = mysqli_query($conn, $sql);
										while($row = mysqli_fetch_assoc($result)) {
												echo "<h2>".$row["nombre"]." ".$row["primerApellido"]." ".$row["segundoApellido"]."</h2>";
										}
									}
                ?>
              </div>
            </div>
            <!-- /menu profile quick info -->

            <br>

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
                <h3>Edición</h3>
              </div>
            </div>

            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12">
                <div class="x_panel">
                  <div class="x_content">

                      <!-- required for floating -->
                      <!-- Nav tabs -->
                      <ul class="nav nav-tabs tabs-left">

                        <li class="active"><a href="#Carrera" data-toggle="tab">Carrera</a>
                        </li>
                        <li><a href="#Motivo" data-toggle="tab">Motivo</a>
                        </li>
                        <li><a href="#Referencia" data-toggle="tab">Referencia</a>
                        </li>
                      </ul>


                      <!-- Tab panes -->
                      <div class="tab-content">
                        <div class="tab-pane active" id="Carrera">

                          <div class="form-group">
                            <br><br>
                            <label class="col-md-6 col-sm-12 col-xs-12 control-label"> Carreras registradas: </label>
                            <br><br>

                            <div class="col-md-6 col-sm-12 col-xs-12">
                              <?php
                                $sql = "SELECT * FROM `Carrera`";
                                $result = mysqli_query($conn, $sql);
                                echo "<select id = 'carreraText' class='form-control'>";
                                while($row = mysqli_fetch_assoc($result)) {
                                  echo "<option value='".$row["idCarrera"]."'>".$row["carrera"]."</option>";
                                }
                                echo "</select>";
                              ?>
                            </div>
                          <br><br><br>
                          <label class="col-md-6 col-sm-12 col-xs-12 control-label">Inserte la nueva carrera:</label>
                          <br><br>
                          <div class="col-md-6 col-sm-12 col-xs-12 form-group">

                            <input id = "carreraTextIn" type="text" placeholder="Carrera" class="form-control">

                          </div>

                          </div>
                          <br><br>
                          <input class = 'btn btn-success' type='button' value='Registrar' onclick = 'registrarCarrera()'>
                          <input class = 'btn btn-success' type='button' value='Eliminar' onclick = 'eliminarCarrera()'>

                        </div>
                        <div class="tab-pane" id="Motivo">
                        <div class="form-group">
                          <br><br>
                          <label class="col-md-6 col-sm-12 col-xs-12 control-label">Motivos de consulta actuales:</label>
                          <br><br>
                          <div class="col-md-6 col-sm-12 col-xs-12">
                          <?php
                              $sql = "SELECT * FROM `Motivo`";
                              $result = mysqli_query($conn, $sql);
                              echo "<select id = 'motivoText' class='form-control'>";
                              while($row = mysqli_fetch_assoc($result)) {
                                echo "<option value='".$row["idMotivo"]."'>".$row["motivo"]."</option>";
                              }
                              echo "</select>";
                          ?>
                          </div>
                          <br><br><br>
                          <label class="col-md-6 col-sm-12 col-xs-12 control-label">Inserte el nuevo motivo de consulta:</label>
                          <br><br>
                          <div class="col-md-6 col-sm-12 col-xs-12 form-group">

                          <input id = "motivoTextIn" type="text" placeholder="Nuevo motivo" class="form-control">

                          </div>
                          <br><br><br>
                          <input class = 'btn btn-success' type='button' value='Registrar' onclick = 'registrarMotivo()'>
                          <input class = 'btn btn-success' type='button' value='Eliminar' onclick = 'eliminarMotivo()'>
                        </div>

                        </div>

                        <div class="tab-pane" id="Referencia">

                          <div class="form-group">
                            <br><br>
                            <label class="col-md-6 col-sm-12 col-xs-12 control-label"> Referencias registradas: </label>
                            <br><br>
                            <div class="col-md-6 col-sm-12 col-xs-12">
                              <?php
                                $sql = "SELECT * FROM `Referencia`";
                                $result = mysqli_query($conn, $sql);
                                echo "<select id = 'referenciaText' class='form-control'>";
                                while($row = mysqli_fetch_assoc($result)) {
                                  echo "<option value='".$row["idReferencia"]."'>".$row["referencia"]."</option>";
                                }
                                echo "</select>";
                                ?>
                            </div>
                          <br><br><br>
                          <label class="col-md-6 col-sm-12 col-xs-12 control-label">Inserte la nueva referencia:</label>
                          <br><br>
                          <div class="col-md-6 col-sm-12 col-xs-12 form-group">

                          <input id = "referenciaTextIn" type="text" placeholder="referencia" class="form-control">

                          </div>


                          <br><br><br>
                          <input class = 'btn btn-success' type='button' value='Registrar' onclick = 'registrarReferencia()'>
                          <input class = 'btn btn-success' type='button' value='Eliminar' onclick = 'eliminarReferencia()'>
                          </div>
                        </div>
                      </div>
                    <div class="clearfix"></div>
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
