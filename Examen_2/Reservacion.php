<?php

// Definimos el metodo de recepcion de dato POST //

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    /* Almacenamos toda la informacion del POST en las variables*/
   
    $hotel = $_POST['hotel'] ?? '';
    $nombre = htmlspecialchars($_POST['nombre'] ?? '');
    $apellido = htmlspecialchars($_POST['apellido'] ?? '');
    $telefono = htmlspecialchars($_POST['telefono'] ?? '');
    $fecha = $_POST['fecha'] ?? '';
    $observaciones = htmlspecialchars($_POST['observaciones'] ?? '');

    if (!empty($hotel) && !empty($nombre) && !empty($apellido) && !empty($telefono) && !empty($fecha)) {

        // Almacenaje de la informacion recopilada por el formulario para ser procesada//
       
        $reserva = "Hotel: $hotel\n";
        $reserva .= "Nombre: $nombre\n";
        $reserva .= "Apellido: $apellido\n";
        $reserva .= "Teléfono: $telefono\n";
        $reserva .= "Fecha de Reservación: $fecha\n";
        $reserva .= "Observaciones:\n$observaciones\n\n";

        $archivo = 'reservaciones.txt';
        file_put_contents($archivo, $reserva, FILE_APPEND);

        // Basicamente esta es la estructura de la tabla o matriz de datos que se imprime al ejecutar el codigo//

        echo '<h2>¡Solicitud de Reservación enviada!</h2>';
        echo '<p>Gracias por enviar tu solicitud.</p>';
        echo '<h3>Detalles de la Reservación:</h3>';
        echo '<table border="1">';
        echo '<tr><th>Hotel</th><td>' . htmlspecialchars($hotel) . '</td></tr>';
        echo '<tr><th>Nombre</th><td>' . htmlspecialchars($nombre) . '</td></tr>';
        echo '<tr><th>Apellido</th><td>' . htmlspecialchars($apellido) . '</td></tr>';
        echo '<tr><th>Teléfono</th><td>' . htmlspecialchars($telefono) . '</td></tr>';
        echo '<tr><th>Fecha de Reservación</th><td>' . htmlspecialchars($fecha) . '</td></tr>';
        echo '<tr><th>Observaciones</th><td>' . nl2br(htmlspecialchars($observaciones)) . '</td></tr>';
        echo '</table>';
    } else {
       
        // Los ciclos son idoneos para depurar errores en el codigo especialmente el else que significa todo lo demas que no se necesita presente esto o haga esto otro.
        echo '<h2>Error en la solicitud de reservación</h2>';
        echo '<p>Por favor completa todos los campos obligatorios.</p>';
    }
} else {
   
    echo '<h2>Error en la solicitud de reservación</h2>';
    echo '<p>Ha ocurrido un error en el envío de datos.</p>';
}
?>