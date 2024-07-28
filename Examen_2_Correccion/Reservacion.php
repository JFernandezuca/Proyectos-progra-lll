<?php

/* La creació de una clase para poder almacenar las instrucciones de trabajo predeterminadamente */

class Reservacion
{
    private $hotel;
    private $nombre;
    private $apellido;
    private $telefono;
    private $fecha;
    private $observaciones;
    private $archivoReservas = 'reservaciones.txt';

    /* La función pública nos permite invocarla y utilizarla durante cualquier fracción del código con una tarea específica, en este caso un constructor visto en la lectura */

    public function __construct($hotel, $nombre, $apellido, $telefono, $fecha, $observaciones)
    {
        if (empty($hotel) || empty($nombre) || empty($apellido) || empty($telefono) || empty($fecha)) {
            throw new Exception("Por favor completa todos los campos obligatorios.");
        }
        
        $this->hotel = htmlspecialchars($hotel);
        $this->nombre = htmlspecialchars($nombre);
        $this->apellido = htmlspecialchars($apellido);
        $this->telefono = htmlspecialchars($telefono);
        $this->fecha = htmlspecialchars($fecha);
        $this->observaciones = htmlspecialchars($observaciones);
    }

    /* Función pública para almacenar los datos en cada variable para luego ser procesada */

    public function guardar()
    {
        $reserva = "Hotel: $this->hotel\n";
        $reserva .= "Nombre: $this->nombre\n";
        $reserva .= "Apellido: $this->apellido\n";
        $reserva .= "Teléfono: $this->telefono\n";
        $reserva .= "Fecha de Reservación: $this->fecha\n";
        $reserva .= "Observaciones:\n$this->observaciones\n\n";

        file_put_contents($this->archivoReservas, $reserva, FILE_APPEND);
    }

    /* Esta función nos permite mediante echo mostrar los datos almacenados en la BD en forma de output */

    public function mostrarDetalleNuevaReservacion()
    {
        echo '<h2>¡Solicitud de Reservación enviada!</h2>';
        echo '<p>Gracias por enviar tu solicitud.</p>';
        echo '<h3>Detalles de la Reservación:</h3>';
        echo '<table border="1">';
        echo '<tr><th>Hotel</th><td>' . htmlspecialchars($this->hotel) . '</td></tr>';
        echo '<tr><th>Nombre</th><td>' . htmlspecialchars($this->nombre) . '</td></tr>';
        echo '<tr><th>Apellido</th><td>' . htmlspecialchars($this->apellido) . '</td></tr>';
        echo '<tr><th>Teléfono</th><td>' . htmlspecialchars($this->telefono) . '</td></tr>';
        echo '<tr><th>Fecha de Reservación</th><td>' . htmlspecialchars($this->fecha) . '</td></tr>';
        echo '<tr><th>Observaciones</th><td>' . nl2br(htmlspecialchars($this->observaciones)) . '</td></tr>';
        echo '</table>';
    }

    public function mostrarTodasLasReservaciones()
    {
        if (file_exists($this->archivoReservas)) {
            $contenido = file_get_contents($this->archivoReservas);
            echo '<h3>Todas las Reservaciones:</h3>';
            echo '<pre>' . htmlspecialchars($contenido) . '</pre>';
        } else {
            echo '<p>No hay reservaciones.</p>';
        }
    }
}

/* Los ciclos preventivos son muy utiles ya que ordenan la parte grafica al depurar errores */

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $hotel = $_POST['hotel'] ?? '';
    $nombre = $_POST['nombre'] ?? '';
    $apellido = $_POST['apellido'] ?? '';
    $telefono = $_POST['telefono'] ?? '';
    $fecha = $_POST['fecha'] ?? '';
    $observaciones = $_POST['observaciones'] ?? '';

        $reservacion = new Reservacion($hotel, $nombre, $apellido, $telefono, $fecha, $observaciones);
        $reservacion->guardar();
        $reservacion->mostrarDetalleNuevaReservacion();
        $reservacion->mostrarTodasLasReservaciones();
} else {
    echo '<h2>Error en la solicitud de reservación</h2>';
    echo '<p>Ha ocurrido un error en el envío de datos.</p>';
}
?>