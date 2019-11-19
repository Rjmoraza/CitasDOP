
<?php
include("database.php");
session_start();

$sql = "SELECT * FROM `Motivo` order by idMotivo ASC";
$result = mysqli_query($conn, $sql);
$conti = 0;
while($row = mysqli_fetch_assoc($result)) {
  $conti++;
}

$sql = "SELECT CONCAT(nombre, ' ', primerApellido, ' ', segundoApellido) as title, fecha as start, idCita as id, cantidadCursos as cursos, cantidadCreditos as creditos, observacion as observacion, urgencia as urgencia, Horario_idHorario as horario, nivel as nivel, ausencia as ausencia, carnet as carnet, correo as correo, telefono as telefono, carrera as carrera, Cita.Psicologa_idPsicologa as psicologa FROM Persona, Estudiante, Nivel, Cita, Carrera, Urgencia where Cita.Estudiante_idEstudiante = Estudiante.idEstudiante AND Estudiante.Persona_idPersona = Persona.idPersona and Nivel.idNivel = Cita.Nivel_idNivel and Carrera.idCarrera = Estudiante.Carrera_idCarrera and Urgencia.idUrgencia = Cita.Urgencia_idUrgencia";
$result = mysqli_query($conn,$sql); 
$myArray = array();
if ($result->num_rows > 0) {
// output data of each row
    while($row = $result->fetch_assoc()) {
        $myArray[] = $row;
    }
}
?>

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

    <!--Full Calendar-->
    <link rel="stylesheet" href="../css/fullcalendar.min.css">
    <script src="../js/fullcalendar.min.js"></script>
    <script src="../js/es.js"></script>

    <!-- Custom styling plus plugins -->
     <link href="../build/css/custom.min.css" rel="stylesheet">
     <script src="../build/js/custom.min.js"></script>

    <!--JQuery para bootsrap-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

    <style>
.nav-md {
         height: 100%;
         width: 1200px;
         z-index: 1;
         top: 0;
         left: 0;
         padding-top: 20px;
      }

      .nav-md a {
        text-decoration: none;
        font-size: 25px;
        display: block;

      }

      .right_col {
        position:;
        z-index: 1;
        height: 100%;
        width: 1150px;
        overflow: auto;
        padding-top: 0px;
      }


       .fc th{
        
        vertical-align: middle;    
      }

      .fc-title{
        font-size: .8em;
        color: #000000;
        padding-right: 100px;
        
      }

      .fc-time{
        font-size: 17pt;
        color: #000000;
        padding-right: 0px;
        
      }

      .pull-right {
        position:;
        z-index: 1;
        width: 1500px;
        padding-top: 0px;
      }
    </style>
    
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
    function verificarCarnet(){
      var carnetText = document.getElementById("carnetText").value;
      if (window.XMLHttpRequest) {
          // code for IE7+, Firefox, Chrome, Opera, Safari
          xmlhttp = new XMLHttpRequest();
      } else {
          // code for IE6, IE5
          xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
      }
      xmlhttp.onreadystatechange = function () {
          if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            document.getElementById("carnetDiv").innerHTML = this.responseText;
          }
      };
      xmlhttp.open("GET", "cargarEstudiante.php?carnet=" + carnetText , true);
      xmlhttp.send();
      }
      function cargarReferencia(refi){
        
        if(refi.checked){
            if (window.XMLHttpRequest) {
                // code for IE7+, Firefox, Chrome, Opera, Safari
                xmlhttp = new XMLHttpRequest();
            } else {
                // code for IE6, IE5
                xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
            }
            xmlhttp.onreadystatechange = function () {
                if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                  document.getElementById("referenciaDiv").innerHTML = this.responseText;
                }
            };
            xmlhttp.open("GET", "cargarReferencia.php", true);
            xmlhttp.send();
        }
        else{
          document.getElementById("referenciaDiv").innerHTML = "";
        }
      }
      function cargarReferenciaAux(){
        document.getElementById("referenciaDiv").innerHTML = "";
        document.getElementById("carnetDiv").innerHTML = "";
       }
       function agregarCitaPsicologa(conti){
          var cantidadMotivos = parseInt(conti);
          var i = 0;
          var motivoText = "";
          var motivoActual = "";
          while(i < cantidadMotivos){
            motivoActual = "motivoText" + i.toString();
            if(document.getElementById(motivoActual).checked){
              motivoText += document.getElementById(motivoActual).value + "¬";
            }        
            i++;
          }

          var referenciaText = "¬";
          if(document.getElementById("referenciaDiv").innerHTML != ""){
            referenciaText = document.getElementById("referenciaText").value;
          }
          var estudianteText = "¬";
          if(document.getElementById("carnetDiv").innerHTML != ""){
            estudianteText = document.getElementById("estudianteText").value;
          }
          var fechaText = document.getElementById("fechaText").value;
          var fechaTextArray = fechaText.split("-");
          var horarioText = document.getElementById("horarioText").value;
          var urgenciaText = document.getElementById("urgenciaText").value;
          var nivelText = document.getElementById("nivelText").value;
          var cursosText = document.getElementById("cursosText").value;
          var creditosText = document.getElementById("creditosText").value;
          var observacionText = document.getElementById("observacionText").value;
          var psicologaText = document.getElementById("psicologaText").value;

          if(estudianteText == "¬" || horarioText == "" || fechaText == "" || motivoText == "" || urgenciaText == "" || nivelText == "" || cursosText == "" || creditosText == "" || psicologaText == ""){
            alert("Deben llenarse todos los espacios.");
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
                    alert("Cita creada exitosamente");
                    location.href = "calendarioPsicologa.php";
                  }
              };
              xmlhttp.open("GET", "agregarCitaPsicologa.php?dia=" + fechaTextArray[2] + "&mes=" +  fechaTextArray[1] + "&anio=" +  fechaTextArray[0] + "&horario=" +  horarioText + "&motivo=" +  motivoText + "&urgencia=" +  urgenciaText + "&nivel=" +  nivelText + "&cursos=" +  cursosText + "&creditos=" +  creditosText + "&observacion=" +  observacionText + "&referencia=" + referenciaText + "&estudiante=" + estudianteText + "&psicologa=" + psicologaText, true);
              xmlhttp.send();
          }
       }
       function cargarCita(idCita, idPsicologa){
        var fecha = document.getElementById("fechaTextEvento").value;
          if (window.XMLHttpRequest) {
              // code for IE7+, Firefox, Chrome, Opera, Safari
              xmlhttp = new XMLHttpRequest();
          } else {
              // code for IE6, IE5
              xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
          }
          xmlhttp.onreadystatechange = function () {
              if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                document.getElementById("divEvento").innerHTML = this.responseText;
              }
          };
          xmlhttp.open("GET", "cargarCita.php?idCita=" + idCita + "&idPsicologa=" + idPsicologa + "&fecha=" + fecha, true);
          xmlhttp.send();
       }
       function eliminarCita(idCita){
          var idCita = document.getElementById("idTextEvento").value;
          if (window.XMLHttpRequest) {
              // code for IE7+, Firefox, Chrome, Opera, Safari
              xmlhttp = new XMLHttpRequest();
          } else {
              // code for IE6, IE5
              xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
          }
          xmlhttp.onreadystatechange = function () {
              if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                alert("Cita eliminada exitosamente");
                location.href = "calendarioPsicologa.php";
              }
          };
          xmlhttp.open("GET", "eliminarCitaPsicologa.php?idCita=" + idCita, true);
          xmlhttp.send();
       }
       function editarCita(idCita){
          var idCita = document.getElementById("idTextEvento").value;
          var horario = document.getElementById("horarioTextEvento").value;
          var fecha = document.getElementById("fechaTextEventoGet").value;
          var idPsicologa = document.getElementById("psicologaTextEventoGet").value;
          var ausencia = document.getElementById("ausenciaCheck").checked;
          var ausenciaAux = 0;
          if(ausencia){ausenciaAux = 1;}
          var fechaTextArray = fecha.split("-");
          if (window.XMLHttpRequest) {
              // code for IE7+, Firefox, Chrome, Opera, Safari
              xmlhttp = new XMLHttpRequest();
          } else {
              // code for IE6, IE5
              xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
          }
          xmlhttp.onreadystatechange = function () {
              if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                alert("Cita editada exitosamente");
                location.href = "calendarioPsicologa.php";
              }
          };
          xmlhttp.open("GET", "editarCitaPsicologa.php?dia=" + fechaTextArray[2] + "&mes=" +  fechaTextArray[1] + "&anio=" +  fechaTextArray[0] + "&psicologa=" +  idPsicologa +"&idCita=" + idCita +"&horario=" + horario +"&ausencia=" + ausenciaAux, true);
          xmlhttp.send();
       }
    function cambiarHorarioEvento(){
      var fecha = document.getElementById("fechaTextEventoGet").value;
      var idPsicologa = document.getElementById("psicologaTextEventoGet").value;
      var fechaTextArray = fecha.split("-");
      if(fecha == ""){
      
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
                document.getElementById("horarioTextEvento").innerHTML = this.responseText;
              }
          };
          xmlhttp.open("GET", "cargarHoraPsicologa.php?dia=" + fechaTextArray[2] + "&mes=" +  fechaTextArray[1] + "&anio=" +  fechaTextArray[0] + "&psicologa=" +  idPsicologa, true);
          xmlhttp.send();
      }
    }
    function cambiarHorario(){
      var fecha = document.getElementById("fechaText").value;
      var idPsicologa = document.getElementById("psicologaText").value;
      var fechaTextArray = fecha.split("-");
      if(fecha == ""){
      
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
                document.getElementById("horarioText").innerHTML = this.responseText;
              }
          };
          xmlhttp.open("GET", "cargarHoraPsicologa.php?dia=" + fechaTextArray[2] + "&mes=" +  fechaTextArray[1] + "&anio=" +  fechaTextArray[0] + "&psicologa=" +  idPsicologa, true);
          xmlhttp.send();
      }
    }
       
</script>
</head>

  <body class="nav-md" onload = "cargarReferenciaAux()">
    <?php
      include("database.php");
    ?>
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
                $sql = "SELECT * from Persona where idPersona = ".$_SESSION["usuarioActivo"]."";
                $result = mysqli_query($conn, $sql);
                while($row = mysqli_fetch_assoc($result)) {
                    echo "<h2>".$row["nombre"]." ".$row["primerApellido"]." ".$row["segundoApellido"]."</h2>";
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
                <h3>Calendario de Psicóloga</h3>
              </div>
            </div>

            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Citas Asignadas</h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">

                    <div id="calendarioWeb"></div>

                    <script>
                      function limpiarFormulario(){
                         $('#carnetDiv').html('');
                         $('#referenciaDiv').html('');
                         $('#carnetText').val('');
                         $('#cursosText').val('');
                         $('#creditosText').val('');
                         $('#observacionText').val('');
                        var cantidadMotivos = parseInt(<?php echo $conti;?>);
                        var i = 0;
                        var motivoActual = "";
                        while(i < cantidadMotivos){
                          motivoActual = "motivoText" + i.toString();
                          if(document.getElementById(motivoActual).checked){
                            document.getElementById(motivoActual).checked = false;
                          }        
                          i++;
                        }                     
                       }
                        $(document).ready(function(){

                          $('#calendarioWeb').fullCalendar({
                            header:{
                              left: 'today,prev,next',
                              center: 'title',
                              right: 'month,agendaWeek,agendaDay'
                            },

                            dayClick:function(date,jsEvent,view){
                              limpiarFormulario();
                              $('#fechaText').val(date.format());
                              cambiarHorario();
                              $("#ModalAgregar").modal();
                            },
                            hiddenDays: [ 0 , 6 ],

                            droppable : false,

                            events: <?php echo json_encode($myArray); ?>,
                            
                            eventClick:function(calEvent,jsEvent,view){
                             $('#nombreTextEvento').html(calEvent.title);
                             $('#telefonoTextEvento').html(calEvent.telefono);
                             $('#correoTextEvento').html(calEvent.correo);
                             $('#carnetTextEvento').html(calEvent.carnet);
                             $('#nivelTextEvento').html(calEvent.nivel);
                             $('#cursosTextEvento').html(calEvent.cursos);
                             $('#creditosTextEvento').html(calEvent.creditos);
                             $('#urgenciaTextEvento').html(calEvent.urgencia);
                             $('#observacionTextEvento').html(calEvent.observacion);
                             if(calEvent.ausencia == "1"){
                              document.getElementById("ausenciaCheck").checked = true;
                             }
                             var FechaHora = calEvent.start._i.split(" ");
                             $('#fechaTextEvento').val(FechaHora[0]);
                             cargarCita(calEvent.id, calEvent.psicologa);
                           $('#idTextEvento').val(calEvent.id);
                           $('#psicologaTextEvento').val(calEvent.psicologa);
                           $("#ModalEventos").modal();
                            },
                          });
                        });

                    </script>
                      <div class="modal fade" id="ModalEventos" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="tituloEvento">Datos de la cita:</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <div class="modal-body">
                              <div id="descripcionEvento"></div>

                              <!--Input del ID-->
                              <input type="hidden" id="idTextEvento" name="txtID">
                              <!--Input de la fecha-->
                              <input type="hidden" id="fechaTextEvento" name="txtFecha">
                              <input type="hidden" id="psicologaTextEvento" name="txtFecha">


                              <!-- Para ordenar el modal del evento-->
                              <div class="form-row">

                              <div class="form-group">
                                <label class="control-label col-md-12 col-sm-12 col-xs-12">Nombre del estudiante: </label>
                                <div class="col-md-12 col-sm-12 col-xs-12">                                  
                                  <label id = "nombreTextEvento" class="control-label col-md-12 col-sm-12 col-xs-12"></label>
                                </div>
                              </div> 

                              <div class="form-group">
                                <label class="control-label col-md-12 col-sm-12 col-xs-12">Teléfono del estudiante: </label>
                                <div class="col-md-12 col-sm-12 col-xs-12">                                  
                                  <label id = "telefonoTextEvento" class="control-label col-md-12 col-sm-12 col-xs-12"></label>
                                </div>
                              </div> 

                              <div class="form-group">
                                <label class="control-label col-md-12 col-sm-12 col-xs-12">Correo del estudiante: </label>
                                <div class="col-md-12 col-sm-12 col-xs-12">                                  
                                  <label id = "correoTextEvento" class="control-label col-md-12 col-sm-12 col-xs-12"></label>
                                </div>
                              </div>  

                              <div class="form-group">
                                <label class="control-label col-md-12 col-sm-12 col-xs-12">Carné de Estudiante: </label>
                                <div class="col-md-12 col-sm-12 col-xs-12">                                  
                                  <label id = "carnetTextEvento" class="control-label col-md-12 col-sm-12 col-xs-12"></label>
                                </div>
                              </div>                              

                              <div class="form-group">
                                <label class="control-label col-md-12 col-sm-12 col-xs-12">Año de carrera que está cursando: </label>
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                  <label id = "nivelTextEvento" class="control-label col-md-12 col-sm-12 col-xs-12"></label>
                                </div>
                              </div>

                              <div class="form-group">
                                <label class="control-label col-md-12 col-sm-12 col-xs-12">Cantidad de cursos que cursa este semestre:</label>
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                  <label id = "cursosTextEvento" class="control-label col-md-12 col-sm-12 col-xs-12"></label>
                                </div>
                              </div>

                              <div class="form-group">
                                <label class="control-label col-md-12 col-sm-12 col-xs-12">Cantidad de créditos que contabiliza este semestre:</label>
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                  <label id = "creditosTextEvento" class="control-label col-md-12 col-sm-12 col-xs-12"></label>
                                </div>
                              </div>
                              <div class="form-group">
                                <label class="control-label col-md-12 col-sm-12 col-xs-12">Urgencia:</label>
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                  <label id = "urgenciaTextEvento" class="control-label col-md-12 col-sm-12 col-xs-12"></label>
                                </div>
                              </div>
                              <div class="form-group">
                              <label class="control-label col-md-12 col-sm-12 col-xs-12">Observación:</label>
                              <div class="col-md-12 col-sm-12 col-xs-12">
                                  <label id = "observacionTextEvento" class="control-label col-md-12 col-sm-12 col-xs-12"></label>
                                </div>
                             </div>
                             <div class="form-group">
                              <label class="control-label col-md-12 col-sm-12 col-xs-12">Asistencia a la cita:</label>
                              <div class="col-md-12 col-sm-12 col-xs-12">
                                  <div class="checkbox"><label><input id = "ausenciaCheck" type= "checkbox" class='js-switch'></label></div> 
                                </div>
                             </div>
                              <div id = "divEvento" class="form-group">
            
                              </div>
                              </div>
                            </div>
                            <div class="modal-footer">
                              <button type="button" id="btnModificar" class="btn btn-success" onclick = "editarCita()">Modificar</button>
                              <button type="button" id="btnEliminar" class="btn btn-danger" onclick = "eliminarCita()">Eliminar</button>
                              <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>

                            </div>
                          </div>
                        </div>
                      </div>
                      
                      <!-- Modal Para los Eventos-->
                      <div class="modal fade" id="ModalAgregar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="tituloEvento">Reservar una cita:</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <div class="modal-body">
                              <div id="descripcionEvento"></div>

                              <!--Input de la fecha-->
                              <input type="hidden" id="fechaText" name="txtFecha" />


                              <!-- Para ordenar el modal del evento-->
                              <div class="form-row">

                              

                              <div class="form-group">
                                <label class="control-label col-md-12 col-sm-12 col-xs-12">Carné de Estudiante: </label>
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                  <input id = "carnetText" onkeyup = "verificarCarnet()" type="text" class="form-control" placeholder="Carné">
                                </div>
                              </div> 

                              <div id = "carnetDiv" class="form-group">
                                
                              </div>                           

                              <div class="form-group">
                                <label class="control-label col-md-12 col-sm-12 col-xs-12">Indique el año de carrera que está cursando: </label>
                                <br><br>
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                  <?php
                                    $sql = "SELECT * FROM `Nivel`";
                                    $result = mysqli_query($conn, $sql);
                                    echo "<select id = 'nivelText' class='form-control'>";
                                    while($row = mysqli_fetch_assoc($result)) {
                                      echo "<option value='".$row["idNivel"]."'>".$row["nivel"]."</option>";
                                    }
                                    echo "</select>";
                                    ?>
                                </div>
                              </div>
                              <br><br>

                              <div class="form-group">
                                <label class="control-label col-md-12 col-sm-12 col-xs-12">Indique la cantidad de cursos que cursa este semestre:</label>
                                <br><br>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id = "cursosText" type="text" name="cursos"  class="form-control" placeholder="Cantidad cursos" >
                                </div>
                              </div>
                              <br><br>

                              <div class="form-group">
                                <label class="control-label col-md-12 col-sm-12 col-xs-12">Indique la cantidad de créditos que contabiliza este semestre:</label>
                                <br><br>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id = "creditosText" type="text" name="creditos" class="form-control" placeholder="Cantidad créditos">
                                </div>
                              </div>
                              <br><br>
                              <div class="form-group">
                                <label class="col-md-12 col-sm-12 col-xs-12 control-label">Seleccione su motivo de consulta:</label>
                                <br><br>
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                  <table>
                                <?php
                                    $sql = "SELECT * FROM `Motivo` order by idMotivo ASC";
                                        $result = mysqli_query($conn, $sql);
                                        $conti = 0;
                                        while($row = mysqli_fetch_assoc($result)) {
                                          if($row["motivo"] == "Referencia"){
                                            echo "<tr><td><input type='checkbox' class='form-control' id = 'motivoText".$conti."'' value='".$row["idMotivo"]."' onclick = 'cargarReferencia(this)'></td><td>".$row["motivo"]."</td></tr>";
                                          }
                                          else{
                                            echo "<tr><td><input type='checkbox' class='form-control' id = 'motivoText".$conti."'' value='".$row["idMotivo"]."'></td><td>".$row["motivo"]."</td></tr>";
                                          }
                                          $conti++;
                                        }
                                    ?>
                                    </table>
                              </div>
                              <br>
                              </div>
                              <div id = "referenciaDiv" class="form-group">
            
                              </div>

                              <div class="form-group">
                                <label class="control-label col-md-12 col-sm-12 col-xs-12">Seleccione la psicóloga:</label>
                                <br>
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                  <?php
                                    $sql = "SELECT idPsicologa, concat(nombre, ' ', primerApellido, ' ', segundoApellido) from Persona, Psicologa where Persona.idPersona = Psicologa.Persona_idPersona";
                                    $result = mysqli_query($conn, $sql);
                                    echo "<div class='col-md-12 col-sm-12 col-xs-12'>";
                                    echo "<select id = 'psicologaText' onchange = 'cambiarHorario()' class='form-control'>";
                                    while($row = mysqli_fetch_assoc($result)) {
                                      echo "<option value='".$row["idPsicologa"]."'>".$row["concat(nombre, ' ', primerApellido, ' ', segundoApellido)"]."</option>";
                                    } 
                                    echo "</select></div>";
                                  ?>
                                </div>
                              </div>
                              <div class="form-group">
                                <label class="control-label col-md-12 col-sm-12 col-xs-12">Hora de atención:</label>
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                  <select id = "horarioText" class='form-control'>
                                    
                                  </select>
                                </div>
                              </div> <br>

                              <div class="form-group">
                                <label class="control-label col-md-12 col-sm-12 col-xs-12">¿Cual sería el grado de urgencia? Indíquelo en rango de 1 a 5, donde 5 es muy urgente y 1 es poco urgente:</label>
                                <br><br><br>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                  <?php
                                    $sql = "SELECT * FROM `Urgencia`";
                                        $result = mysqli_query($conn, $sql);
                                        echo "<select id = 'urgenciaText' class='form-control'>";
                                        while($row = mysqli_fetch_assoc($result)) {
                                          echo "<option value='".$row["idUrgencia"]."'>".$row["urgencia"]."</option>";
                                        }
                                        echo "</select>";
                                    ?>
                                </div>
                              </div>

                              </div>
                              <div class="form-group">
                                <label class="control-label col-md-12 col-sm-12 col-xs-12">Si tiene alguna observación o información importante puede anotarla a continuación:</label>
                                <br><br><br>
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <textarea id = "observacionText" class="form-control" placeholder="Observación" maxlength="499"></textarea>
                                </div>
                              </div>
                            </div>
                            <div class="modal-footer">
                              <button onclick = "agregarCitaPsicologa('<?php echo $conti;?>')" type="button" id="btnAgregar" class="btn btn-success">Agregar</button>
                              <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                            </div>
                          </div>
                        </div>
                      </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- /page content -->

        <!-- footer content -->
        <footer class="col-md-13 col-sm-12 col-xs-12 pull-right">
          <div class="pull-right">
            <a>Calendario Departamento de Orientación y Psicología </a>
          </div>
          <div class="clearfix"></div>
        </footer>
        <!-- /footer content -->
      </div>
    </div>


    <!-- FastClick -->
    <script src="../vendors/fastclick/lib/fastclick.js"></script>

    <!-- PNotify -->
    <script src="../vendors/pnotify/dist/pnotify.buttons.js"></script>
    <script src="../vendors/pnotify/dist/pnotify.nonblock.js"></script>

  </body>
</html>