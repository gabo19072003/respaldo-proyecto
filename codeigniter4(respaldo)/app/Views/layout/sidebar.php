    <!-- partial:./partials/_sidebar.html -->
    <nav class="sidebar  sidebar-offcanvas" id="sidebar">

      <ul class="nav">

        <li class="nav-item sidebar-category">
          <p>Navegación</p>
          <span></span>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="<?= base_url('inicio'); ?>">
            <i class="bi bi-grid-3x3-gap-fill"></i>
            <span class="menu-title px-2">Tablero</span>
          </a>
        </li>

        <li class="nav-item sidebar-category">
          <p>Componetes</p>
          <span></span>
        </li>

        <li class="nav-item">

          <a class="nav-link" data-bs-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
            <i class="mdi mdi-book menu-icon"></i>
            <span class="menu-title">Registros</span>
            <i class="menu-arrow"></i>
          </a>

          <div class="collapse" id="ui-basic">
            <ul class="nav flex-column sub-menu">
              <li class="nav-item"> 
                <a class="nav-link" href="<?= base_url('casillero'); ?>">Lista</a>
              </li>
              <li class="nav-item"> 
                <a class="nav-link" href="<?= base_url('cubiculo'); ?>">Cubículos</a>
              </li>
              <li class="nav-item"> 
                <a class="nav-link" href="<?= base_url('libro'); ?>">Libros</a>
              </li>
              <li class="nav-item"> 
                <a class="nav-link" href="<?= base_url('persona'); ?>">Personas</a>
              </li>
             
              <li class="nav-item"> 
                <a class="nav-link" href="<?= base_url('recurso'); ?>">Recursos</a>
              </li>
            </ul>
          </div>

        </li>

        <li class="nav-item">
          <a class="nav-link" href="<?= base_url('evento'); ?>">
            <i class="mdi mdi-tag menu-icon"></i>
            <span class="menu-title">Eventos</span>
          </a>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="<?= base_url('usuario'); ?>">
            <i class="mdi mdi-account-multiple menu-icon"></i>
            <span class="menu-title">Usuarios del Sistema</span>
          </a>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="<?= base_url('bitacora'); ?>">
            <i class="mdi mdi-calendar menu-icon"></i>
            <span class="menu-title">Bitácora</span>
          </a>
        </li>

      </ul>

    </nav>