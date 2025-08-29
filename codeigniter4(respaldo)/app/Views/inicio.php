<?= $this->extend('layout/template_home');?>

<?= $this->section('content');?>

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-center mb-4">
    <h1 class="h3 mb-0 text-gray-800">Panel de Administración</h1>
</div>

<!-- Content Row -->
<div class="row">

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
               <a href="#" style="text-decoration: none;">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            Usuarios del Sistema (Total)</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800" id="totalUsuarios">01</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-users-cog fa-2x text-gray-300"></i>
                    </div>
                </div>
               </a>
            </div>
        </div>
    </div>

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
              <a href="#" style="text-decoration: none;">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            Personal Ivic (Total)</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800" id="totalEst">02</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-user-friends fa-2x text-gray-300"></i>
                    </div>
                </div>
              </a>
            </div>
        </div>
    </div>

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-info shadow h-100 py-2">
            <div class="card-body">
              <a href="#" style="text-decoration: none;">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            Personas Externas (Total)</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800" id="totalAsistencia">00</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-users fa-2x text-gray-300"></i>
                    </div>
                </div>
              </a>
            </div>
        </div>
    </div>

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-info shadow h-100 py-2">
            <div class="card-body">
              <a href="#" style="text-decoration: none;">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            Personas Encargadas (Total)</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800" id="totalAsistencia">01</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-user-tie fa-2x text-gray-300"></i>
                    </div>
                </div>
              </a>
            </div>
        </div>
    </div>

    <!-- Pending Requests Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-warning shadow h-100 py-2">
            <div class="card-body">
              <a href="#" style="text-decoration: none;">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            Secciones Realizadas (Total)</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800" id="totalCarreras">04</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-server fa-2x text-gray-300"></i>
                    </div>
                </div>
              </a>
            </div>
        </div>
    </div>

   
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-warning shadow h-100 py-2">
            <div class="card-body">
              <a href="#" style="text-decoration: none;">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            Secciones Activas (Total)</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800" id="totalCarreras">01</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-stream fa-2x text-gray-300"></i>
                    </div>
                </div>
              </a>
            </div>
        </div>
    </div>


    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-warning shadow h-100 py-2">
            <div class="card-body">
              <a href="#" style="text-decoration: none;">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            Eventos (Total)</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800" id="totalCarreras">04</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-tags fa-2x text-gray-300"></i>
                    </div>
                </div>
              </a>
            </div>
        </div>
    </div>

     <!-- Pending Requests Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-warning shadow h-100 py-2">
            <div class="card-body">
              <a href="#" style="text-decoration: none;">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            Eventos Suspendidos (Total)</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800" id="totalCarreras">01</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-user-tag fa-2x text-gray-300"></i>
                    </div>
                </div>
              </a>
            </div>
        </div>
    </div>


</div>

<?= $this->endSection();?>