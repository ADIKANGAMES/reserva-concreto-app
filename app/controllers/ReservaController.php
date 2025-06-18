<?php
require_once './app/models/ReservaModel.php';

class ReservaController
{
    private $model;

    public function __construct()
    {
        $this->model = new ReservaModel();
        session_start();
    }

    public function mostrarCalendario()
    {
        $disponibilidad = $this->model->getDisponibilidad();
        include './app/views/calendar.php';
    }

    public function getHorariosPorFecha($fecha)
    {
        header('Content-Type: application/json');
        echo json_encode($this->model->getHorarios($fecha));
    }

    public function guardarReserva($post)
    {
        $this->model->guardar($post);
        $_SESSION['resumen'] = $post;
        include './app/views/resumen.php';
    }

    public function historial($email)
    {
        if (empty($email)) {
            echo "<div class='alert alert-danger'>No se proporcionó un correo electrónico para consultar el historial.</div>";
            return;
        }

        $reservas = $this->model->getReservasPorEmail($email);

        if (!$reservas || count($reservas) === 0) {
            echo "<div class='alert alert-info'>No hay reservas registradas para el correo: <strong>$email</strong></div>";
            return;
        }

        include './app/views/historial.php';
    }
}
