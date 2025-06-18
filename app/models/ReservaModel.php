<?php
class ReservaModel
{

    private $dataFile = './database/DB_simulada.php';

    public function getDisponibilidad()
    {
        $data = include $this->dataFile;
        $result = [];

        $horarios = ['08:00-09:00', '09:00-10:00', '10:00-11:00', '11:00-12:00', '12:00-13:00'];

        $inicio = new DateTime('2025-06-01');
        $fin = new DateTime('2025-06-30');

        while ($inicio <= $fin) {
            $fecha = $inicio->format('Y-m-d');
            $horasOcupadas = $data['ocupados'][$fecha] ?? [];

            if (count(array_intersect($horarios, $horasOcupadas)) === count($horarios)) {
                $result[$fecha] = ['estado' => 'ocupado'];
            } else {
                $result[$fecha] = ['estado' => 'disponible'];
            }

            $inicio->modify('+1 day');
        }

        return $result;
    }

    public function getHorarios($fecha)
    {
        $data = include $this->dataFile;
        $ocupados = $data['ocupados'][$fecha] ?? [];

        $horarios = ['08:00-09:00', '09:00-10:00', '10:00-11:00', '11:00-12:00', '12:00-13:00'];
        $disponibles = [];

        foreach ($horarios as $hora) {
            $disponibles[] = [
                'hora' => $hora,
                'estado' => in_array($hora, $ocupados) ? 'ocupado' : 'disponible'
            ];
        }

        return $disponibles;
    }

    public function guardar($reserva)
    {
        $data = include $this->dataFile;
        $data['reservas'][] = $reserva;
        $data['ocupados'][$reserva['fecha']][] = $reserva['hora'];

        file_put_contents($this->dataFile, '<?php return ' . var_export($data, true) . ';');
    }

    public function getReservasPorEmail($email)
    {
        $data = include $this->dataFile;
        return array_filter($data['reservas'], fn($r) => $r['email'] === $email);
    }
}
