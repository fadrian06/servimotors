<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">

  <ul class="sidebar-nav" id="sidebar-nav">

    <li class="nav-item">
      <a class="nav-link " href="../dashboard/dashboard.php">
        <i class="bi bi-grid"></i>
        <span>Dashboard</span>
      </a>
    </li><!-- Fin Nav de Dashboard -->

    <li class="nav-heading">Gestión Automotriz</li>

    <li class="nav-item">
      <a class="nav-link " href="../Clientes/clientes-agregar.php">
        <i class="bi bi-grid"></i>
        <span>Clientes</span>
      </a>
    </li>

    <li class="nav-item">
      <a class="nav-link collapsed" data-bs-toggle="collapse" href="#vehiculos-nav">
        <i class="bi bi-car"></i>
        <span>Vehículos</span>
        <i class="bi bi-chevron-down ms-auto"></i>
      </a>
      <ul id="vehiculos-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav">
        <li>
          <a href="vehiculos-lista.html">
            <i class="bi bi-circle"></i>
            <span>Lista de Vehículos</span>
          </a>
        </li>
        <li>
          <a href="../Vehiculos/vehiculos-agregar.php">
            <i class="bi bi-circle"></i>
            <span>Agregar Vehículo</span>
          </a>
        </li>
      </ul>
    </li><!-- Fin Nav de Vehículos -->

    <li class="nav-item">
      <a class="nav-link collapsed" data-bs-toggle="collapse" href="#servicios-nav">
        <i class="bi bi-tools"></i>
        <span>Servicios</span>
        <i class="bi bi-chevron-down ms-auto"></i>
      </a>
      <ul id="servicios-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav">
        <li>
          <a href="servicios-lista.html">
            <i class="bi bi-circle"></i>
            <span>Lista de Servicios</span>
          </a>
        </li>
        <li>
          <a href="views/Servicios/servicios-agregar.php">
            <i class="bi bi-circle"></i>
            <span>Agregar Servicio</span>
          </a>
        </li>
      </ul>
    </li><!-- Fin Nav de Servicios -->

    <!-- Inventario de Repuestos -->
    <li class="nav-heading">Gestión Empresa</li>
    <li class="nav-item">
      <a class="nav-link collapsed" data-bs-toggle="collapse" href="#inventario-nav">
        <i class="bi bi-box-seam"></i>
        <span>Inventario de Repuestos</span>
        <i class="bi bi-chevron-down ms-auto"></i>
      </a>
      <ul id="inventario-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav">
        <li>
          <a href="inventario-creacion.html">
            <i class="bi bi-circle"></i>
            <span>Creación de Productos</span>
          </a>
        </li>
        <li>
          <a href="inventario-ingresos.html">
            <i class="bi bi-circle"></i>
            <span>Ingresos de Productos</span>
          </a>
        </li>
        <li>
          <a href="inventario-venta.html">
            <i class="bi bi-circle"></i>
            <span>Venta de Repuestos</span>
          </a>
        </li>
      </ul>
    </li><!-- Fin Nav de Inventario de Repuestos -->

    <!-- Módulo de Empleados -->
    <li class="nav-heading">Gestión De Empleados</li>
    <li class="nav-item">
      <a class="nav-link collapsed" data-bs-toggle="collapse" href="#empleados-nav">
        <i class="bi bi-people"></i>
        <span>Empleados</span>
        <i class="bi bi-chevron-down ms-auto"></i>
      </a>
      <ul id="empleados-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav">
        <li>
          <a href="empleados-lista.html">
            <i class="bi bi-circle"></i>
            <span>Lista de Empleados</span>
          </a>
        </li>
        <li>
          <a href="views/Empleados/empleados-agregar.php">
            <i class="bi bi-circle"></i>
            <span>Agregar Empleado</span>
          </a>
        </li>
      </ul>
    </li><!-- Fin Nav de Empleados -->

    <!-- Módulo de Reportes -->
    <li class="nav-heading">Gestión De Reportes</li>
    <li class="nav-item">
      <a class="nav-link collapsed" data-bs-toggle="collapse" href="#reportes-nav">
        <i class="bi bi-file-earmark-text"></i>
        <span>Reportes</span>
        <i class="bi bi-chevron-down ms-auto"></i>
      </a>
      <ul id="reportes-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav">
        <li>
          <a href="reportes-clientes.html">
            <i class="bi bi-circle"></i>
            <span>Listados de Clientes</span>
          </a>
        </li>
        <li>
          <a href="reportes-vehiculos.html">
            <i class="bi bi-circle"></i>
            <span>Listados de Vehículos</span>
          </a>
        </li>
        <li>
          <a href="reportes-servicios.html">
            <i class="bi bi-circle"></i>
            <span>Servicios Individuales</span>
          </a>
        </li>
        <li>
          <a href="reportes-semanales-empleados.html">
            <i class="bi bi-circle"></i>
            <span>Reportes Semanales por Empleados</span>
          </a>
        </li>
      </ul>
    </li><!-- Fin Nav de Reportes -->



    <li class="nav-item">
      <a class="nav-link collapsed" href="../auth/register.php">
        <i class="bi bi-card-list"></i>
        <span>Registrar</span>
      </a>
    </li><!-- Fin Nav de Registro -->

    <li class="nav-item">
      <a class="nav-link collapsed" href="pages-login.html">
        <i class="bi bi-box-arrow-in-right"></i>
        <span>Iniciar Sesión</span>
      </a>
    </li><!-- Fin Nav de Iniciar Sesión -->


  </ul>

</aside><!-- Fin Sidebar -->
