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
    <!-- bootstrap-daterangepicker -->
    <link href="../vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">
    <!-- bootstrap-datetimepicker -->
    <link href="../vendors/bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.css" rel="stylesheet">
    <!-- Custom Theme Style -->
    <link href="../build/css/custom.min.css" rel="stylesheet">
      <style>
    .redtext {
            color: red;
    }
    </style>
  </head>

  <script type="text/javascript">
    function registrarCita(conti){
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
      var psicologaText = "¬";
      if(document.getElementById("psicologaDiv").innerHTML != ""){
        psicologaText = document.getElementById("psicologaText").value;
      }
      var fechaText = document.getElementById("fechaText").value;
      var fechaTextArray = fechaText.split("/");
      var horarioText = document.getElementById("horarioText").value;
      var urgenciaText = document.getElementById("urgenciaText").value;
      var nivelText = document.getElementById("nivelText").value;
      var cursosText = document.getElementById("cursosText").value;
      var creditosText = document.getElementById("creditosText").value;
      var observacionText = document.getElementById("observacionText").value;

      if(horarioText == "" || fechaText == "" || motivoText == "" || urgenciaText == "" || nivelText == "" || cursosText == "" || creditosText == ""){
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
                alert(this.responseText);
                location.href = "../index.php";
              }
          };
          xmlhttp.open("GET", "registrarCita.php?dia=" + fechaTextArray[0] + "&mes=" +  fechaTextArray[1] + "&anio=" +  fechaTextArray[2] + "&horario=" +  horarioText + "&motivo=" +  motivoText + "&urgencia=" +  urgenciaText + "&nivel=" +  nivelText + "&cursos=" +  cursosText + "&creditos=" +  creditosText + "&observacion=" +  observacionText + "&referencia=" +  referenciaText + "&psicologa=" +  psicologaText, true);
          xmlhttp.send();
      }
    }
    function addZero(i){
      if(i < 10){
        i = '0' + i;
      }
      return i;
    }
    function cargarHora(){
      var fechaText = document.getElementById("fechaText").value;
      if(fechaText == ""){
        var f = new Date();
        var hoy = f.getFullYear()+"-"+addZero(f.getMonth()+1)+"-"+addZero(f.getDate());
        document.getElementById("fechaText").value = hoy;
        fechaText = document.getElementById("fechaText").value;      
      }
      var fechaTextArray = fechaText.split("-");
      var psicologaText = "¬";
      if(document.getElementById("psicologaDiv").innerHTML != ""){
        psicologaText = document.getElementById("psicologaText").value;
      }
      if(fechaText == ""){
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
              xmlhttp.open("GET", "cargarHora.php?dia=" + fechaTextArray[2] + "&mes=" +  fechaTextArray[1] + "&anio=" +  fechaTextArray[0] + "&psicologa=" +  psicologaText, true);
              xmlhttp.send();
          }
    }
    function cerrarSesion(){
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
      $(document).ready(function () {
          $('#myModal').modal('show');
        });
      document.getElementById("referenciaDiv").innerHTML = "";
      document.getElementById("psicologaDiv").innerHTML = "";
      cargarHora();
      if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function () {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
              if(this.responseText != "Primera cita"){
                document.getElementById("psicologaDiv").innerHTML = this.responseText;
              }                
            }
        };
        xmlhttp.open("GET", "cargarPsicologa.php", true);
        xmlhttp.send();
    }

  </script>


  <body onload = "cargarReferenciaAux()">
    <?php
    include("database.php");
    ?>
  <div class="col-md-12 col-sm-6 col-xs-12 form-group pull-right top_search">
    <div class="x_panel">
      
      <div class="x_title">
        <h1>Registro de Citas</h1>
        <div class="clearfix"></div>
      </div>
      
      <div class="x_content">
        <br>

          <div id = "psicologaDiv" class="form-group">
            
          </div>

          <div class="form-group">
            <label class="control-label col-md-5 col-sm-5 col-xs-12">Indique el año de carrera que está cursando: </label>
            <br><br>
            <div class="col-md-3 col-sm-3 col-xs-12">
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

          <div class="form-group">
          <br><br>
          <label  class="col-md-3 col-sm-5 col-xs-12 control-label">Seleccionar día:</label>
          <br><br>
              <div class="col-md-3 col-sm-5 col-xs-12">
              <input onchange = 'cargarHora()' id = 'fechaText' type='date' class='form-control' value = ''>
              </div>
          
          </div>
          <br><br>
          <div class="form-group">
            <label class="control-label col-md-5 col-sm-5 col-xs-12">Hora de atención(Primero seleccione el día):</label>
            <br><br>
            <div class="col-md-3 col-sm-3 col-xs-12">
              <select id = "horarioText" class='form-control'>
                
              </select>
            </div>
          </div>
          <br><br>

          <div class="form-group">
            <label class="control-label col-md-5 col-sm-5 col-xs-12">¿Considera usted que su caso es urgente? Indíquelo en rango de 1 a 5, donde 5 es muy urgente y 1 es poco urgente:</label>
            <br><br><br>
            <div class="col-md-3 col-sm-3 col-xs-12">
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
          <br><br>

          <div class="form-group">
            <label class="control-label col-md-5 col-sm-5 col-xs-12">Indique la cantidad de cursos que cursa este semestre:</label>
            <br><br>
            <div class="col-md-3 col-sm-3 col-xs-12">
                <input id = "cursosText" type="text" name="cursos"  class="form-control" placeholder="Cantidad cursos" value="" required="">
            </div>
          </div>
          <br><br>

          <div class="form-group">
            <label class="control-label col-md-5 col-sm-5 col-xs-12">Indique la cantidad de créditos que contabiliza este semestre:</label>
            <br><br>
            <div class="col-md-3 col-sm-3 col-xs-12">
                <input id = "creditosText" type="text" name="creditos" class="form-control" placeholder="Cantidad creditos" value="" required="">
            </div>
          </div>
          <br><br>
 
           <div class="form-group">
            <label class="control-label col-md-5 col-sm-5 col-xs-12">Si tiene alguna observación o información que considera oportuno comunicar, anótela a continuación:</label>
            <br><br><br>
            <div class="col-md-3 col-sm-3 col-xs-12">
                <textarea id = "observacionText" class="form-control" placeholder="Observación" maxlength="499"></textarea>
            </div>
          </div>
          <br><br><br>
          <div class="form-group">
            <label class="col-md-3 col-sm-5 col-xs-12 control-label">Seleccione su motivo de consulta:</label>
            <br><br>
            <div class="col-md-3 col-sm-5 col-xs-12">
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
          <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
          </div>
          <div id = "referenciaDiv" class="form-group">
            
          </div>
  </div>
  
  </div>
  <div class="form-group">
      <div class="col-md-3 col-sm-3 col-xs-12">        
        <input class = 'btn btn-success' type='button' value='Aceptar' onclick = "registrarCita('<?php echo $conti;?>')">
        <button type="button" class="btn btn-danger" onclick = 'cerrarSesion()'>Cerrar Sesión</button>
      </div>
  </div>

    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">

        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
          </button>
          <h4 class="modal-title redtext"  id="myModalLabel2">Advertencia</h4>
        </div>
        <div class="modal-body">
          <p>-Si su consulta obedece a motivos de: salud física, seguimiento por psicología clínica(depresión, ansiedad u otros), psiquiatría o consumo de sustancias lícitas o ilícitas</p>
          <p>Dirigirse a la Clínica de Atención Integral del Campus Tecnológico Local San José.</p>
          <br>
          <p>-Si su consulta obedece a motivos de: hostigamiento sexual, violencia intrafamiliar, discriminación, diversidad sexual u acoso psicológico.</p>
          <p>Entonces diríjase a la oficina de Equidad de Género.</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Continuar</button>
        </div>

      </div>
    </div>
  </div>

  </div>

    <script src="../vendors/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="../vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- Custom Theme Scripts -->
    <script src="../build/js/custom.min.js"></script>

    <script src="../vendors/moment/min/moment.min.js"></script>
    <script src="../vendors/bootstrap-daterangepicker/daterangepicker.js"></script>
    <script src="../vendors/bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js"></script>

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