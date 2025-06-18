<?php
require 'app/controllers/ReservaController.php';

$action = $_GET['action'] ?? 'calendario';
$controller = new ReservaController();

switch ($action) {
    case 'calendario':
        $controller->mostrarCalendario();
        break;
    case 'horarios':
        $fecha = $_GET['fecha'] ?? '';
        $controller->getHorariosPorFecha($fecha);
        break;
    case 'guardar':
        $controller->guardarReserva($_POST);
        break;
    case 'historial':
        $email = $_POST['email_historial'] ?? $_GET['email'] ?? '';
        $controller->historial($email);
        break;
    default:
        echo "Acción no válida.";
}
