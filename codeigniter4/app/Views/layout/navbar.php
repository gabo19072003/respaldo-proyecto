      <!-- partial:./partials/_navbar.html -->
      <nav class="navbar col-lg-12 col-12 px-0 py-0 py-lg-0 d-flex flex-row">

        <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">

          <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
            <span class="mdi mdi-menu"></span>
          </button>

          <div class="navbar-brand-wrapper">
<!--
            <a class="navbar-brand brand-logo" href="#"><img src="<?= base_url('public/images/logo.png'); ?>" width="60" alt="logo"/></a>
            <a class="navbar-brand brand-logo-mini" href="#"><img src="<?= base_url('public/images/logo.png'); ?>" width="30" alt="logo"/></a>
         --> 
         
          </div>

          <h4 class="font-weight-bold mb-0 d-none d-md-block mt-1">. . .Bienvenido a la Biblioteca </h4><!-- Michel Roche --> 

          <ul class="navbar-nav navbar-nav-right">

            <li class="nav-item">
              <h4 class="mb-0 font-weight-bold d-none d-xl-block"><?php echo fecha(); ?></h4>
            </li>

            <li class="nav-item nav-profile dropdown">

              <button type="button" class="btn btn-dark btn-rounded btn-fw dropdown-toggle" href="#" data-bs-toggle="dropdown" id="profileDropdown">
                <i class="bi bi-person-circle"></i>
                <span class="nav-profile-name"><?= ucfirst($_SESSION['username']); ?></span>
              </button>

              <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
                <a class="dropdown-item" href="<?= base_url('perfil'); ?>">
                  <i class="bi bi-person-fill-gear text-primary"></i>
                  Perfil
                </a>
                <a class="dropdown-item" href="#" onclick="salir()">
                  <i class="mdi mdi-logout text-primary"></i>
                  Cerrar sesión
                </a>
              </div>

            </li>

          </ul>

          <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
            <span class="mdi mdi-menu"></span>
          </button>

        </div>

      </nav>