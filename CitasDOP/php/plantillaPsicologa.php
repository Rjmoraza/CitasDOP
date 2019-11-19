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
    function guardarPlantilla(){
      var x = 0;
      var y = 0;
      var plantilla = "";
      var elemento = "";
      while(x < 11){
        y = 0;
        while(y < 5){
          elemento = (x+1).toString().concat("-",(y+2).toString());
          if(!(document.getElementById(elemento).checked)){
            plantilla = plantilla.concat(elemento, "!");
          }
          y++;
        }
        x++;
      }
      if(plantilla != ""){
        if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function () {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
              alert("Cambios guardados");
            }
        };
        xmlhttp.open("GET", "guardarPlantilla.php?plantilla=" + plantilla, true);
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
                <h3>Mi Horario</h3>
              </div>
            </div>

            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12">
                <div class="x_panel">
                  <div class="x_content">

                  <table class="table table-striped">
                      <thead>
                        <tr>
                          <th> Hora </th>
                          <th> Lunes </th>
                          <th> Martes </th>
                          <th> Miércoles </th>
                          <th> Jueves </th>
                          <th> Viernes </th>

                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        $listaHoras = array("8:00 am -9:00 am", "9:00 am -10:00 am", "10:00 am -11:00 am", "11:00 am -12:00 md", "1:00 pm -2:00 pm", "2:00 pm -3:00 pm", "3:00 pm -4:00 pm", "4:00 pm - 5:00 pm", "5:00 pm -6:00 pm", "6:00 pm -7:00 pm", "7:00 pm -8:00 pm");
                        
                        $sql = "SELECT idPsicologa from Psicologa where Persona_idPersona = ".$_SESSION["usuarioActivo"]."";
                        $result = mysqli_query($conn, $sql);
                        while($row = mysqli_fetch_assoc($result)) {
                            $idPsicologa = $row["idPsicologa"];
                        }

                        $listaPlantilla = array();
                        $sql = "SELECT * FROM `Plantilla` WHERE Psicologa_idPsicologa = '".$idPsicologa."' order by Horario_idHorario, DiasSemana_idDiasSemana";
                        $result = mysqli_query($conn, $sql);
                        while($row = mysqli_fetch_assoc($result)) {
                          array_push($listaPlantilla, $row["Horario_idHorario"]."-".$row["DiasSemana_idDiasSemana"]);
                        }

                        $x = 0;
                        while($x < 11){
                          echo "<tr><th scope='row'>".$listaHoras[$x]."</th>";
                          $y = 0;
                          while($y < 5){
                            $hd = strval($x+1)."-".strval($y+2);
                            if(in_array($hd, $listaPlantilla)){
                              echo "<td> <div class='checkbox'><label><input id = '".$hd."' type= 'checkbox' class='js-switch' ></label></div></td>";
                            }
                            else{
                              echo "<td> <div class='checkbox'><label><input id = '".$hd."' type= 'checkbox' class='js-switch' checked></label></div></td>";
                            }
                            
                            $y++;
                          }
                          echo"</tr>";
                          $x++;
                        }
                        ?>
                    </tbody>
                    </table>
                    <button type="button" class="btn btn-success" onclick = 'guardarPlantilla()'>Guardar cambios</button>
                    <button type="button" class="btn btn-danger" onclick = 'location.href = "plantillaPsicologa.php"'>Eliminar cambios</button>
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