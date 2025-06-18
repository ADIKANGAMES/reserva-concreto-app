<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Reserva de entrega de concreto</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
</head>

<body class="bg-light">
  <div class="container my-5">
    <!-- Header Card -->
    <div class="card shadow-lg border-0 mb-4">
      <div class="card-header bg-primary text-white py-4">
        <div class="text-center">
          <h1 class="card-title mb-2 fw-bold">
            <i class="bi bi-truck me-3"></i>
            Reserva de Entrega de Concreto
          </h1>
          <p class="card-text mb-0 fs-5">
            <i class="bi bi-calendar3 me-2"></i>
            Calendario de entregas
          </p>
        </div>

        <div class="text-end mt-3">
          <button class="btn btn-light px-4 fw-semibold shadow-sm" data-bs-toggle="modal" data-bs-target="#modalHistorial">
            <i class="bi bi-clock-history me-2"></i> Ver historial de reservas
          </button>
        </div>

      </div>

      <!-- Contenido del calendario -->
      <div class="card-body p-4 bg-light">
        <div class="card shadow-sm border-0">
          <div class="card-header bg-white border-bottom-0 py-3">
            <div class="row align-items-center">
              <div class="col-md-6">
                <h5 class="card-title mb-0 text-primary fw-semibold">
                  <i class="bi bi-calendar-week me-2"></i>
                  Junio 2025
                </h5>
              </div>
              <div class="col-md-6">
                <div class="d-flex justify-content-md-end justify-content-start mt-2 mt-md-0">
                  <div class="d-flex align-items-center me-4">
                    <div class="bg-success rounded-circle me-2" style="width: 12px; height: 12px;"></div>
                    <small class="text-muted">Disponible</small>
                  </div>
                  <div class="d-flex align-items-center">
                    <div class="bg-danger rounded-circle me-2" style="width: 12px; height: 12px;"></div>
                    <small class="text-muted">Ocupado</small>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="card-body p-3">
            <div id="calendar"></div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal de Reserva -->
  <div class="modal fade" id="modalReserva" tabindex="-1">
    <div class="modal-dialog modal-lg">
      <form class="modal-content shadow-lg border-0" action="index.php?action=guardar" method="POST">
        <div class="modal-header bg-primary text-white">
          <h5 class="modal-title fw-semibold">
            <i class="bi bi-calendar-plus me-2"></i>
            Reservar entrega
          </h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
        </div>

        <div class="modal-body p-4 bg-light">
          <input type="hidden" name="fecha" id="fechaSeleccionada">

          <!-- Sección de Horarios -->
          <div class="card mb-4 border-0 shadow-sm">
            <div class="card-header bg-white border-bottom">
              <h6 class="card-title mb-0 text-primary fw-semibold">
                <i class="bi bi-clock me-2"></i>
                Horarios disponibles
              </h6>
            </div>
            <div class="card-body">
              <div id="horarios"></div>
            </div>
          </div>

          <!-- Sección de Información del Cliente -->
          <div class="card border-0 shadow-sm">
            <div class="card-header bg-white border-bottom">
              <h6 class="card-title mb-0 text-primary fw-semibold">
                <i class="bi bi-person me-2"></i>
                Información del cliente
              </h6>
            </div>
            <div class="card-body">
              <div class="row g-3">
                <div class="col-md-6">
                  <div class="form-floating">
                    <input class="form-control" name="nombre" id="nombre" placeholder="Nombre completo" required>
                    <label for="nombre">
                      <i class="bi bi-person me-1"></i>
                      Nombre completo
                    </label>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-floating">
                    <input class="form-control" name="email" id="email" type="email" placeholder="Correo electrónico" required>
                    <label for="email">
                      <i class="bi bi-envelope me-1"></i>
                      Correo electrónico
                    </label>
                  </div>
                </div>
                <div class="col-12">
                  <div class="form-floating">
                    <input class="form-control" name="telefono" id="telefono" placeholder="Número de teléfono" required>
                    <label for="telefono">
                      <i class="bi bi-telephone me-1"></i>
                      Número de teléfono
                    </label>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="modal-footer bg-white border-top-0">
          <button class="btn btn-primary btn-lg px-4 fw-semibold shadow-sm" type="submit">
            <i class="bi bi-check-circle me-2"></i>
            Confirmar Reserva
          </button>
        </div>
      </form>
    </div>
  </div>

  <!-- Modal Historial -->
  <div class="modal fade" id="modalHistorial" tabindex="-1">
    <div class="modal-dialog">
      <form class="modal-content" action="index.php?action=historial" method="POST">
        <div class="modal-header bg-primary text-white">
          <h5 class="modal-title">
            <i class="bi bi-clock-history me-2"></i> Historial de Reservas
          </h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body bg-light">
          <div class="form-floating">
            <input type="email" name="email_historial" class="form-control" id="emailHistorial" placeholder="Correo del usuario" required>
            <label for="emailHistorial">Correo del usuario</label>
          </div>
        </div>
        <div class="modal-footer bg-white">
          <button type="submit" class="btn btn-outline-primary btn-lg">
            <i class="bi bi-search me-1"></i> Ver historial
          </button>
        </div>
      </form>
    </div>
  </div>


  <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      const calendarEl = document.getElementById('calendar');
      const modal = new bootstrap.Modal(document.getElementById('modalReserva'));
      const fechaInput = document.getElementById('fechaSeleccionada');
      const horariosDiv = document.getElementById('horarios');

      const dia = new Date();
      dia.setHours(0, 0, 0, 0);

      const calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        initialDate: '2025-06-01',
        locale: 'es',
        height: 'auto',
        aspectRatio: 1.8,

        headerToolbar: {
          left: 'prev',
          center: 'title',
          right: 'next'
        },

        buttonText: {
          prev: '‹',
          next: '›'
        },

        dayHeaderFormat: {
          weekday: 'short'
        },
        dayHeaderClassNames: 'text-primary fw-semibold',

        dayCellClassNames: function(info) {
          const cellDate = new Date(info.date);
          cellDate.setHours(0, 0, 0, 0);

          // Añadir clase para días pasados
          if (cellDate < dia) {
            return 'text-center fw-medium past-day';
          }
          return 'text-center fw-medium';
        },

        windowResizeDelay: 100,
        eventDisplay: 'background',
        eventBackgroundColor: 'transparent',

        validRange: {
          start: '2025-06-01',
          end: '2025-07-01'
        },

        selectable: false,
        selectMirror: false,

        navLinks: false,
        weekends: true,
        selectConstraint: {
          start: '2025-06-01',
          end: '2025-07-01'
        },

        events: Object.entries(<?= json_encode($disponibilidad) ?>).map(([fecha, info]) => {
          const eventoFecha = new Date(fecha);
          eventoFecha.setHours(0, 0, 0, 0);

          if (eventoFecha < dia) {
            return {
              title: '',
              start: fecha,
              display: 'background',
              backgroundColor: 'transparent',
              classNames: 'past-day'
            };
          }

          return {
            title: '',
            start: fecha,
            display: 'background',
            backgroundColor: info.estado === 'ocupado' ? '#ff0000' : '#009929',
            borderColor: info.estado === 'ocupado' ? '#dc3545' : '#198754',
            classNames: info.estado === 'ocupado' ? 'border border-danger' : 'border border-success'
          };
        }),

        dateClick: function(info) {
          const cliqueoFecha = new Date(info.dateStr);
          cliqueoFecha.setHours(0, 0, 0, 0);

          if (cliqueoFecha < dia) {
            return;
          }

          document.querySelectorAll('.fc-day').forEach(day => {
            day.classList.remove('bg-primary', 'bg-opacity-10');
          });

          const cliqueoDia = document.querySelector(`[data-date="${info.dateStr}"]`);
          if (cliqueoDia) {
            cliqueoDia.classList.add('bg-primary', 'bg-opacity-10');
          }

          fetch(`index.php?action=horarios&fecha=${info.dateStr}`)
            .then(r => r.json())
            .then(data => {
              horariosDiv.innerHTML = '';
              data.forEach(h => {
                const isDisabled = h.estado === 'ocupado';
                const badgeClass = isDisabled ? 'bg-danger' : 'bg-success';
                const icon = isDisabled ? 'bi-x-circle' : 'bi-check-circle';
                const cardClass = isDisabled ? 'border-danger bg-light' : 'border-success';

                horariosDiv.innerHTML +=
                  `<div class="card mb-2 ${cardClass}" style="cursor: ${isDisabled ? 'not-allowed' : 'pointer'};">
                <div class="card-body py-2">
                  <div class="form-check mb-0">
                    <input class="form-check-input" type="radio" name="hora" value="${h.hora}" 
                          id="hora_${h.hora.replace(':', '')}" ${isDisabled ? 'disabled' : ''}>
                    <label class="form-check-label d-flex justify-content-between align-items-center w-100" 
                          for="hora_${h.hora.replace(':', '')}">
                      <span class="fw-medium">
                        <i class="bi bi-clock me-2 text-primary"></i>
                        ${h.hora}
                      </span>
                      <span class="badge ${badgeClass} rounded-pill">
                        <i class="bi ${icon} me-1"></i>
                        ${h.estado}
                      </span>
                    </label>
                  </div>
                </div>
              </div>`;
              });
              fechaInput.value = info.dateStr;
              modal.show();
            });
        },

        dayCellDidMount: function(info) {
          const fecha = info.dateStr;
          const cellDate = new Date(fecha);
          cellDate.setHours(0, 0, 0, 0);

          if (cellDate < dia) {
            info.el.classList.add('past-day');
            info.el.style.backgroundColor = '#f8f9fa';
            info.el.style.color = '#adb5bd';
            return;
          }

          const disponibilidad = <?= json_encode($disponibilidad) ?>;

          if (disponibilidad[fecha]) {
            const estado = disponibilidad[fecha].estado;
            const dayEl = info.el;

            if (estado === 'ocupado') {
              dayEl.classList.add('border-danger', 'border-2');
              dayEl.style.backgroundColor = 'rgba(220, 53, 69, 0.05)';
            } else {
              dayEl.classList.add('border-success', 'border-2');
              dayEl.style.backgroundColor = 'rgba(25, 135, 84, 0.05)';
            }

            dayEl.style.transition = 'all 0.2s ease';
            dayEl.addEventListener('mouseenter', function() {
              this.style.transform = 'scale(1.02)';
              this.style.boxShadow = '0 4px 8px rgba(0,0,0,0.1)';
            });

            dayEl.addEventListener('mouseleave', function() {
              this.style.transform = 'scale(1)';
              this.style.boxShadow = 'none';
            });
          }
        }
      });

      calendar.render();

      setTimeout(() => {
        const prevButton = document.querySelector('.fc-prev-button');
        const nextButton = document.querySelector('.fc-next-button');
        const titleEl = document.querySelector('.fc-toolbar-title');

        if (prevButton) {
          prevButton.className = 'btn btn-outline-primary btn-sm';
          prevButton.innerHTML = '<i class="bi bi-chevron-left"></i>';
        }

        if (nextButton) {
          nextButton.className = 'btn btn-outline-primary btn-sm';
          nextButton.innerHTML = '<i class="bi bi-chevron-right"></i>';
        }

        if (titleEl) {
          titleEl.className = 'h4 mb-0 text-primary fw-bold';
        }

        document.querySelectorAll('.fc-col-header-cell').forEach(cell => {
          cell.classList.add('bg-light', 'border-bottom', 'border-primary');
        });

        document.querySelectorAll('.fc-daygrid-day').forEach(day => {
          day.classList.add('border');
          day.style.minHeight = '60px';
        });

        document.querySelectorAll('.fc-daygrid-day-number').forEach(number => {
          number.classList.add('fw-semibold', 'text-dark');
          number.style.padding = '8px';
        });

      }, 100);
    });
  </script>
</body>

</html>