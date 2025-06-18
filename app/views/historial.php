<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Historial de Reservas</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
</head>

<body class="bg-light">
  <div class="container py-5">
    <!-- Header -->
    <div class="row mb-4">
      <div class="col-12">
        <div class="d-flex align-items-center justify-content-between">
          <div>
            <h1 class="display-6 fw-bold text-primary mb-1">
              <i class="bi bi-clock-history me-2"></i>Historial de Reservas
            </h1>
            <p class="text-muted mb-0">Consulta todas tus reservas anteriores</p>
          </div>
          <a href="index.php" class="btn btn-outline-secondary">
            <i class="bi bi-arrow-left me-2"></i>Volver
          </a>
        </div>
        <hr class="mt-3">
      </div>
    </div>

    <!-- Contenido -->
    <div class="row">
      <div class="col-12">
        <?php if (count($reservas) == 0): ?>
          <!-- Estado vacío -->
          <div class="card border-0 shadow-sm">
            <div class="card-body text-center py-5">
              <div class="mb-4">
                <i class="bi bi-calendar-x display-1 text-muted"></i>
              </div>
              <h4 class="text-muted mb-3">No hay reservas anteriores</h4>
              <p class="text-muted mb-4">Aún no has realizado ninguna reserva. ¡Haz tu primera reserva ahora!</p>
              <a href="index.php" class="btn btn-primary">
                <i class="bi bi-plus-circle me-2"></i>Hacer Reserva
              </a>
            </div>
          </div>
        <?php else: ?>
          <!-- Lista de reservas -->
          <div class="card border-0 shadow-sm">
            <div class="card-header bg-white border-bottom">
              <div class="d-flex align-items-center justify-content-between">
                <h5 class="mb-0 text-dark">
                  <i class="bi bi-list-ul me-2"></i>Mis Reservas 
                </h5>
                <span class="badge bg-primary rounded-pill">
                  <?= count($reservas) ?> reserva<?= count($reservas) != 1 ? 's' : '' ?>
                </span>
              </div>
            </div>
            <div class="card-body p-0">
              <div class="list-group list-group-flush">
                <?php foreach ($reservas as $index => $r): ?>
                  <div class="list-group-item border-0 py-3">
                    <div class="row align-items-center">
                      <div class="col">
                        <div class="row">
                          <div class="col-md-6">
                            <h6 class="mb-1 fw-semibold text-dark">
                              <i class="bi bi-person me-1"></i><?= htmlspecialchars($r['nombre']) ?>
                            </h6>
                            <small class="text-muted">
                              <i class="bi bi-envelope me-1"></i><?= htmlspecialchars($r['email']) ?>
                            </small>
                            <br>
                            <small class="text-muted">
                              <i class="bi bi-telephone me-1"></i><?= htmlspecialchars($r['telefono']) ?>
                            </small>
                          </div>
                          <div class="col-md-6 text-md-end">
                            <div class="d-flex flex-column align-items-md-end">
                              <span class="badge bg-success mb-1">
                                <i class="bi bi-calendar-date me-1"></i>Fecha: <?= htmlspecialchars($r['fecha']) ?>
                              </span>
                              <span class="badge bg-info">
                                <i class="bi bi-clock me-1"></i>Horario: <?= htmlspecialchars($r['hora']) ?>
                              </span>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <?php if ($index < count($reservas) - 1): ?>
                    <hr class="my-0">
                  <?php endif; ?>
                <?php endforeach; ?>
              </div>
            </div>
            <div class="card-footer bg-light border-top">
              <div class="d-flex justify-content-between align-items-center">
                <small class="text-muted">
                  <i class="bi bi-info-circle me-1"></i>
                  Total de reservas: <?= count($reservas) ?>
                </small>
                <a href="index.php" class="btn btn-primary btn-sm">
                  <i class="bi bi-plus-circle me-1"></i>Nueva Reserva
                </a>
              </div>
            </div>
          </div>
        <?php endif; ?>
      </div>
    </div>
  </div>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>