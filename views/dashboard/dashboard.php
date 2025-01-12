<?php require_once '../../config/ManejoUsuario.php' ?>

<!doctype html>
<html>

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width" />

  <title>Pantalla Principal</title>

  <!-- Favicons -->
  <link rel="icon" href="../../assets/img/favicon.png" />
  <link rel="apple-touch-icon" href="../../assets/img/apple-touch-icon.png" />

  <!-- Google Fonts -->
  <link
    rel="stylesheet"
    href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" />

  <!-- Vendor CSS Files -->
  <link
    rel="stylesheet"
    href="../../assets/vendor/bootstrap/css/bootstrap.min.css" />
  <link
    rel="stylesheet"
    href="../../assets/vendor/bootstrap-icons/bootstrap-icons.min.css" />
  <link
    rel="stylesheet"
    href="../../assets/vendor/simple-datatables/style.css" />

  <!-- Template Main CSS File -->
  <link href="../../assets/css/style.css" rel="stylesheet">

  <!-- Vendor JS Files -->
  <script src="../../assets/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="../../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="../../assets/vendor/tinymce/tinymce.min.js"></script>
  <script src="../../assets/vendor/simple-datatables/simple-datatables.js"></script>

  <!-- Template Main JS File -->
  <script defer src="../../assets/js/main.js"></script>
</head>

<body>

  <?php include '../Partes/header.php'; ?>
  <?php include '../Partes/Sidebar.php'; ?>

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Panel de Control</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Inicio</a></li>
          <li class="breadcrumb-item active">Panel de Control</li>
        </ol>
      </nav>
    </div><!-- Fin del Título de Página -->

    <section class="section dashboard">
      <div class="row">

        <!-- Columnas de la Izquierda -->
        <div class="col-lg-8">
          <div class="row">

            <!-- Tarjeta de Servicios -->
            <div class="col-xxl-4 col-md-6">
              <div class="card info-card services-card">

                <div class="filter">
                  <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                  <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                    <li class="dropdown-header text-start">
                      <h6>Filtrar</h6>
                    </li>
                    <li><a class="dropdown-item" href="#">Hoy</a></li>
                    <li><a class="dropdown-item" href="#">Este Mes</a></li>
                    <li><a class="dropdown-item" href="#">Este Año</a></li>
                  </ul>
                </div>

                <div class="card-body">
                  <h5 class="card-title">Servicios <span>| Hoy</span></h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-wrench"></i>
                    </div>
                    <div class="ps-3">
                      <h6>145</h6>
                      <span class="text-success small pt-1 fw-bold">12%</span> <span class="text-muted small pt-2 ps-1">aumento</span>
                    </div>
                  </div>
                </div>

              </div>
            </div><!-- Fin Tarjeta de Servicios -->

            <!-- Tarjeta de Ingresos -->
            <div class="col-xxl-4 col-md-6">
              <div class="card info-card revenue-card">

                <div class="filter">
                  <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                  <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                    <li class="dropdown-header text-start">
                      <h6>Filtrar</h6>
                    </li>
                    <li><a class="dropdown-item" href="#">Hoy</a></li>
                    <li><a class="dropdown-item" href="#">Este Mes</a></li>
                    <li><a class="dropdown-item" href="#">Este Año</a></li>
                  </ul>
                </div>

                <div class="card-body">
                  <h5 class="card-title">Ingresos <span>| Este Mes</span></h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-currency-dollar"></i>
                    </div>
                    <div class="ps-3">
                      <h6>$3,264</h6>
                      <span class="text-success small pt-1 fw-bold">8%</span> <span class="text-muted small pt-2 ps-1">aumento</span>
                    </div>
                  </div>
                </div>

              </div>
            </div><!-- Fin Tarjeta de Ingresos -->

            <!-- Tarjeta de Clientes -->
            <div class="col-xxl-4 col-xl-12">
              <div class="card info-card customers-card">

                <div class="filter">
                  <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                  <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                    <li class="dropdown-header text-start">
                      <h6>Filtrar</h6>
                    </li>
                    <li><a class="dropdown-item" href="#">Hoy</a></li>
                    <li><a class="dropdown-item" href="#">Este Mes</a></li>
                    <li><a class="dropdown-item" href="#">Este Año</a></li>
                  </ul>
                </div>

                <div class="card-body">
                  <h5 class="card-title">Clientes <span>| Este Año</span></h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-people-fill"></i>
                    </div>
                    <div class="ps-3">
                      <h6>1,244</h6>
                      <span class="text-danger small pt-1 fw-bold">12%</span> <span class="text-muted small pt-2 ps-1">disminución</span>
                    </div>
                  </div>

                </div>
              </div>
            </div><!-- Fin Tarjeta de Clientes -->

            <!-- Reportes -->
            <div class="col-12">
              <div class="card">

                <div class="filter">
                  <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                  <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                    <li class="dropdown-header text-start">
                      <h6>Filtrar</h6>
                    </li>
                    <li><a class="dropdown-item" href="#">Hoy</a></li>
                    <li><a class="dropdown-item" href="#">Este Mes</a></li>
                    <li><a class="dropdown-item" href="#">Este Año</a></li>
                  </ul>
                </div>

                <div class="card-body">
                  <h5 class="card-title">Reportes <span>/ Hoy</span></h5>

                  <!-- Gráfico de Línea -->
                  <div id="reportsChart"></div>

                  <script>
                    document.addEventListener("DOMContentLoaded", () => {
                      new ApexCharts(document.querySelector("#reportsChart"), {
                        series: [{
                          name: 'Servicios',
                          data: [31, 40, 28, 51, 42, 82, 56],
                        }, {
                          name: 'Ingresos',
                          data: [11, 32, 45, 32, 34, 52, 41]
                        }, {
                          name: 'Clientes',
                          data: [15, 11, 32, 18, 9, 24, 11]
                        }],
                        chart: {
                          height: 350,
                          type: 'area',
                          toolbar: {
                            show: false
                          },
                        },
                        markers: {
                          size: 4
                        },
                        colors: ['#4154f1', '#2eca6a', '#ff771d'],
                        fill: {
                          type: "gradient",
                          gradient: {
                            shadeIntensity: 1,
                            opacityFrom: 0.3,
                            opacityTo: 0.4,
                            stops: [0, 90, 100]
                          }
                        },
                        dataLabels: {
                          enabled: false
                        },
                        stroke: {
                          curve: 'smooth',
                          width: 2
                        },
                        xaxis: {
                          type: 'datetime',
                          categories: ["2018-09-19T00:00:00.000Z", "2018-09-19T01:30:00.000Z", "2018-09-19T02:30:00.000Z", "2018-09-19T03:30:00.000Z", "2018-09-19T04:30:00.000Z", "2018-09-19T05:30:00.000Z", "2018-09-19T06:30:00.000Z"]
                        },
                        tooltip: {
                          x: {
                            format: 'dd/MM/yy HH:mm'
                          },
                        }
                      }).render();
                    });
                  </script>
                  <!-- Fin del Gráfico de Línea -->

                </div>

              </div>
            </div><!-- Fin Reportes -->


            <!-- Ventas Recientes -->
            <div class="col-12">
              <div class="card recent-sales overflow-auto">

                <div class="filter">
                  <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                  <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                    <li class="dropdown-header text-start">
                      <h6>Filtrar</h6>
                    </li>
                    <li><a class="dropdown-item" href="#">Hoy</a></li>
                    <li><a class="dropdown-item" href="#">Este Mes</a></li>
                    <li><a class="dropdown-item" href="#">Este Año</a></li>
                  </ul>
                </div>

                <div class="card-body">
                  <h5 class="card-title">Servicios Recientes <span>| Hoy</span></h5>

                  <table class="table table-borderless datatable">
                    <thead>
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col">Cliente</th>
                        <th scope="col">Servicio</th>
                        <th scope="col">Costo</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <th scope="row"><a href="#">#2457</a></th>
                        <td>Brandon Jacob</td>
                        <td><a href="#" class="text-primary">Cambio de aceite</a></td>
                        <td>$64</td>
                      </tr>
                      <tr>
                        <th scope="row"><a href="#">#2147</a></th>
                        <td>Bridie Kessler</td>
                        <td><a href="#" class="text-primary">Reparación de frenos</a></td>
                        <td>$47</td>
                      </tr>
                      <tr>
                        <th scope="row"><a href="#">#2049</a></th>
                        <td>Ashleigh Langosh</td>
                        <td><a href="#" class="text-primary">Alineación y balanceo</a></td>
                        <td>$147</td>
                      </tr>
                      <tr>
                        <th scope="row"><a href="#">#2644</a></th>
                        <td>Angus Grady</td>
                        <td><a href="#" class="text-primary">Cambio de batería</a></td>
                        <td>$67</td>
                      </tr>
                      <tr>
                        <th scope="row"><a href="#">#2644</a></th>
                        <td>Raheem Lehner</td>
                        <td><a href="#" class="text-primary">Diagnóstico general</a></td>
                        <td>$165</td>
                      </tr>
                    </tbody>
                  </table>

                </div>

              </div>
            </div><!-- Fin Ventas Recientes -->


          </div>
        </div><!-- End Left side columns -->

        <!-- Columnas del lado derecho -->
        <div class="col-lg-4">

          <!-- Actividad Reciente -->
          <div class="card">
            <div class="filter">
              <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
              <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                <li class="dropdown-header text-start">
                  <h6>Filtrar</h6>
                </li>
                <li><a class="dropdown-item" href="#">Hoy</a></li>
                <li><a class="dropdown-item" href="#">Este Mes</a></li>
                <li><a class="dropdown-item" href="#">Este Año</a></li>
              </ul>
            </div>

            <div class="card-body">
              <h5 class="card-title">Actividad Reciente <span>| Hoy</span></h5>

              <div class="activity">

                <div class="activity-item d-flex">
                  <div class="activite-label">32 min</div>
                  <i class='bi bi-circle-fill activity-badge text-success align-self-start'></i>
                  <div class="activity-content">
                    Se completó el <a href="#" class="fw-bold text-dark">cambio de aceite</a> del vehículo
                  </div>
                </div><!-- End activity item-->

                <div class="activity-item d-flex">
                  <div class="activite-label">56 min</div>
                  <i class='bi bi-circle-fill activity-badge text-danger align-self-start'></i>
                  <div class="activity-content">
                    Se detectaron <a href="#" class="fw-bold text-dark">fallas en los frenos</a>
                  </div>
                </div><!-- End activity item-->

                <div class="activity-item d-flex">
                  <div class="activite-label">2 hrs</div>
                  <i class='bi bi-circle-fill activity-badge text-primary align-self-start'></i>
                  <div class="activity-content">
                    Se realizó una <a href="#" class="fw-bold text-dark">alineación y balanceo</a>
                  </div>
                </div><!-- End activity item-->

                <div class="activity-item d-flex">
                  <div class="activite-label">1 día</div>
                  <i class='bi bi-circle-fill activity-badge text-info align-self-start'></i>
                  <div class="activity-content">
                    Se finalizó el <a href="#" class="fw-bold text-dark">diagnóstico general</a>
                  </div>
                </div><!-- End activity item-->

                <div class="activity-item d-flex">
                  <div class="activite-label">2 días</div>
                  <i class='bi bi-circle-fill activity-badge text-warning align-self-start'></i>
                  <div class="activity-content">
                    Se completó la <a href="#" class="fw-bold text-dark">reparación de suspensión</a>
                  </div>
                </div><!-- End activity item-->

                <div class="activity-item d-flex">
                  <div class="activite-label">4 semanas</div>
                  <i class='bi bi-circle-fill activity-badge text-muted align-self-start'></i>
                  <div class="activity-content">
                    Se registraron las <a href="#" class="fw-bold text-dark">ventajas del servicio</a> brindado
                  </div>
                </div><!-- End activity item-->

              </div>

            </div>
          </div><!-- End Actividad Reciente -->

        </div><!-- End Right side columns -->

      </div>
    </section>

  </main><!-- End #main -->

  <?php include '../Partes/footer.php' ?>

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
</body>

</html>
