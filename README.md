# CitasDOP
 Sistema para control de citas del Departamento de Orientación y Psicología del Campus Tecnológico Local de San José.

## Instalación

### Dependencias

La aplicación fue diseñada para una arquitectura LAMP o WAMP, por lo que necesita los siguientes servicios y paquetes preinstalados y funcionando:

- Apache 2.4.x
- PHP 7.2.x
- MySQL 5.7.x

### Preparación

El sistema requiere una base de datos en MySQL con un único usuario dedicado con privilegios absolutos sobre la base. Una vez creada la base y el usuario se debe correr el script **citaDOP.sql**. Al completar la ejecución deberían existir 14 tablas:

- carrera
- cita
- cita_has_motivo
- diassemana
- estudiante
- horario
- motivo
- nivel
- persona
- plantilla
- psicologa
- referencia
- sexo
- urgencia

Se requieren los siguientes datos de conexión:

- **Nombre del servidor**: Si el MySQL está instalado en el mismo equipo que el sistema, puede dejarse *localhost*.
- **Nombre de la base de datos**: El nombre que se le dio a la base MySQL que se creó para el sistema.
- **Nombre de usuario**: El nombre del usuario dedicado creado para la base de datos.
- **Contraseña**: La contraseña del usuario dedicado para la base de datos.

Los datos de conexión deben actualizarse en el archivo **database.php**: 

``` php
$servername =  "localhost";
$username   =  "cita";
$password   =  "citaDOP";
$dbname = "citaDOP";
```

## Primer uso

El índice del sistema muestra al usuario el formulario de autenticación. Para el primer uso se debe mantener el nombre de usuario y contraseña vacíos, el sistema se autenticará como administrador y automáticamente se redirigirá al formulario de registro de Psicológas, es indispensable registrar este primer usuario para el uso correcto del sistema.



