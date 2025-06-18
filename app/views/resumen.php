<?php $reserva = $_SESSION['resumen']; ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resumen de Reserva</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-8 col-md-10">
                <!-- Header -->
                <div class="card shadow-sm mb-4">
                    <div class="card-header bg-primary text-white text-center py-3">
                        <h2 class="card-title mb-0">
                            <i class="bi bi-check-circle-fill me-2"></i>
                            Resumen de Reserva
                        </h2>
                        <p class="mb-0 opacity-75">Confirmación de tu reserva</p>
                    </div>
                </div>

                <!-- Detalles de reserva -->
                <div class="card shadow-sm mb-4">
                    <div class="card-body p-4">
                        <h5 class="card-title text-primary mb-4">
                            <i class="bi bi-info-circle me-2"></i>
                            Detalles de la Reserva
                        </h5>
                        
                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="d-flex align-items-center p-3 bg-light rounded">
                                    <div class="flex-shrink-0">
                                        <i class="bi bi-calendar-event text-primary fs-4"></i>
                                    </div>
                                    <div class="flex-grow-1 ms-3">
                                        <h6 class="mb-1 text-muted">Fecha</h6>
                                        <p class="mb-0 fw-semibold"><?= htmlspecialchars($reserva['fecha']) ?></p>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="d-flex align-items-center p-3 bg-light rounded">
                                    <div class="flex-shrink-0">
                                        <i class="bi bi-clock text-primary fs-4"></i>
                                    </div>
                                    <div class="flex-grow-1 ms-3">
                                        <h6 class="mb-1 text-muted">Hora</h6>
                                        <p class="mb-0 fw-semibold"><?= htmlspecialchars($reserva['hora']) ?></p>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-12">
                                <div class="d-flex align-items-center p-3 bg-light rounded">
                                    <div class="flex-shrink-0">
                                        <i class="bi bi-person text-primary fs-4"></i>
                                    </div>
                                    <div class="flex-grow-1 ms-3">
                                        <h6 class="mb-1 text-muted">Nombre</h6>
                                        <p class="mb-0 fw-semibold"><?= htmlspecialchars($reserva['nombre']) ?></p>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="d-flex align-items-center p-3 bg-light rounded">
                                    <div class="flex-shrink-0">
                                        <i class="bi bi-envelope text-primary fs-4"></i>
                                    </div>
                                    <div class="flex-grow-1 ms-3">
                                        <h6 class="mb-1 text-muted">Email</h6>
                                        <p class="mb-0 fw-semibold"><?= htmlspecialchars($reserva['email']) ?></p>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="d-flex align-items-center p-3 bg-light rounded">
                                    <div class="flex-shrink-0">
                                        <i class="bi bi-telephone text-primary fs-4"></i>
                                    </div>
                                    <div class="flex-grow-1 ms-3">
                                        <h6 class="mb-1 text-muted">Teléfono</h6>
                                        <p class="mb-0 fw-semibold"><?= htmlspecialchars($reserva['telefono']) ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Acciones -->
                <div class="card shadow-sm">
                    <div class="card-body text-center p-4">
                        <h6 class="text-muted mb-3">¿Qué deseas hacer ahora?</h6>
                        <div class="d-grid gap-2 d-md-flex justify-content-md-center">
                            <a href="index.php?action=historial&email=<?= urlencode($reserva['email']) ?>" 
                            class="btn btn-outline-primary btn-lg">
                                <i class="bi bi-clock-history me-2"></i>
                                Ver Historial
                            </a>
                            <a href="index.php" class="btn btn-primary btn-lg">
                                <i class="bi bi-house me-2"></i>
                                Volver al Inicio
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>