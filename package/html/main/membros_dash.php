<?php
session_start();

if (isset($_SESSION['id'])) { ?>
  <!DOCTYPE html>
  <html lang="en">

  <head>
    <!--  Title -->
    <title>Courtify</title>
    <!--  Required Meta Tag -->
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="handheldfriendly" content="true" />
    <meta name="MobileOptimized" content="width" />
    <meta name="description" content="Mordenize" />
    <meta name="author" content="" />
    <meta name="keywords" content="Courtify" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!--  Favicon -->
    <link rel="shortcut icon" type="image/png" href="../../dist/images/logos/logo_icone.png" />
    <!-- Owl Carousel  -->

    <link rel="stylesheet" href="//cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">

    <link rel="stylesheet" href="../../dist/libs/sweetalert2/dist/sweetalert2.min.css">

    <!-- Core Css -->
    <link id="themeColors" rel="stylesheet" href="../../dist/css/style.min.css" />

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.js"></script>





  </head>

  <body>
    <!-- Preloader -->
    <div class="preloader">
      <img src="../../dist/images/logos/logo_icone.png" alt="loader" class="lds-ripple img-fluid" />
    </div>
    <!-- Preloader -->
    <div class="preloader">
      <img src="../../dist/images/logos/logo_icone.png" alt="loader" class="lds-ripple img-fluid" />
    </div>
    <!--  Body Wrapper -->
    <div class="page-wrapper" id="main-wrapper" data-theme="blue_theme" data-layout="vertical" data-sidebartype="full" data-sidebar-position="fixed" data-header-position="fixed">
      <!-- Sidebar Start -->
      <aside class="left-sidebar">
        <!-- Sidebar scroll-->
        <div>
          <div class="mt-2 d-flex align-items-center justify-content-center">
            <a href="./visao_dash.php" class="text-nowrap d-none d-xl-block">
              <img src="../../dist/images/logos/logo_courtify.png" class="dark-logo img-fluid" width="180" alt="" />
            </a>


            <a href="./visao_dash.php" class="text-nowrap d-block d-xl-none">
              <img src="../../dist/images/logos/favicon_svg.svg" class="dark-logo img-fluid" width="60" alt="" />
            </a>

            <div class="close-btn d-lg-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
              <i class="ti ti-x fs-8 text-muted"></i>
            </div>
          </div>
          <!-- Sidebar navigation-->
          <nav class="sidebar-nav scroll-sidebar" data-simplebar>
            <ul id="sidebarnav">
              <!-- ============================= -->
              <!-- Home -->
              <!-- ============================= -->
              <!-- =================== -->
              <!-- Dashboard -->
              <!-- =================== -->
              <li class="nav-small-cap">
                <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                <span class="hide-menu fs-6">Dashboard</span>
              </li>
              <li class="sidebar-item">
                <a class="sidebar-link fs-4" href="./visao_dash.php" aria-expanded="false">
                  <span>
                    <i class="ti ti-aperture"></i>
                  </span>
                  <span class="hide-menu">Visão Geral</span>
                </a>
              </li>
              <li class="sidebar-item">
                <a class="sidebar-link fs-4" href="./reserva_dash.php" aria-expanded="false">
                  <span>
                    <i class="ti ti-file-invoice"></i>
                  </span>
                  <span class="hide-menu">Reservas</span>
                </a>
              </li>
              <li class="sidebar-item">
                <a class="sidebar-link fs-4" href="./campos_dash.php" aria-expanded="false">
                  <span>
                    <i class="ti ti-soccer-field"></i>
                  </span>
                  <span class="hide-menu">Campos</span>
                </a>
              </li>
              <li class="sidebar-item selected">
                <a class="sidebar-link fs-4 link-active" href="#" aria-expanded="false">
                  <span>
                    <i class="ti ti-users"></i>
                  </span>
                  <span class="hide-menu">Membros</span>
                </a>
              </li>
              <li class="sidebar-item">
                <a class="sidebar-link fs-4" href="./equipas_dash.php" aria-expanded="false">
                  <span>
                    <i class="ti ti-shirt-sport"></i>
                  </span>
                  <span class="hide-menu">Equipas</span>
                </a>
              </li>
              <li class="sidebar-item">
                <a class="sidebar-link fs-4" href="./torneios_dash.php" aria-expanded="false">
                  <span>
                    <i class="ti ti-tournament"></i>
                  </span>
                  <span class="hide-menu">Torneios</span>
                </a>
              </li>
              <li class="sidebar-item">
                <a class="sidebar-link fs-4" href="./pagamentos_dash.php" aria-expanded="false">
                  <span>
                    <i class="ti ti-report-money"></i>
                  </span>
                  <span class="hide-menu">Pagamentos</span>
                </a>
              </li>
              <li class="sidebar-item">
                <a class="sidebar-link fs-4" href="./definicoes_dash.php" aria-expanded="false">
                  <span>
                    <i class="ti ti-settings"></i>
                  </span>
                  <span class="hide-menu">Definições</span>
                </a>
              </li>
              <li class="sidebar-item mt-4">
                <a class="sidebar-link fs-4" style="background-color: #45702d; color: white; cursor: pointer;" onclick="logout()" aria-expanded="false">
                  <span>
                    <i class="ti ti-logout"></i>
                  </span>
                  <span class="hide-menu">Logout</span>
                </a>
              </li>
          </nav>
          <!-- End Sidebar navigation -->
        </div>
        <!-- End Sidebar scroll-->
      </aside>
      <!--  Sidebar End -->
      <!--  Main wrapper -->
    </div>

  <div class="body-wrapper">
    <div class="row pe-5 mb-3">
        <div class="col-lg-3">

        </div>
        <div class="col-lg-7">
          <div class="container">
            <div>
              <h1 class="text-dark fw-bolder pt-4" style="letter-spacing: 1px; font-size: 65px" id="nomeClube"></h1>
            </div>
          </div>
        </div>
        <div class="col-lg-2"></div>
    </div>
  </div>
  <div class="dark-transparent sidebartoggler"></div>
  <div class="dark-transparent sidebartoggler"></div>






  <div class="row">
    <div class="col-lg-3">

    </div>

    <div class="col-lg-7">
      <div class="badge-container2">
        <div class="row mb-4 mt-3">
          <div class="col-lg-12">
            <div class="card bg-light-info shadow-none position-relative overflow-hidden">
              <div class="card-body px-4 py-3">
                <div class="row align-items-center">
                  <div class="col-9">
                    <h3 class="fw-semibold mb-8"><i class="ti ti-users me-2"></i>Membros</h3>
                    <nav aria-label="breadcrumb">
                      <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a class="text-muted text-decoration-none" href="./visao_dash.php">Home</a></li>
                        <li class="breadcrumb-item" aria-current="page">Membros</li>
                      </ol>
                    </nav>
                  </div>
                  <div class="col-3">
                    
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>


        <div class="card shadow">
          <div class="card-body">
          
          <div class="d-flex justify-content-between">
            <img src="../../dist/images/logos/favicon.ico" alt="" height="40" width="40" class="me-2 mt-1">
            <h1 class="mb-2 fw-semibold fs-9 card-title me-auto">Os seus Membros</h1>
            <button class="btn btn-primary btn-sm" style="height: 40px;" data-bs-toggle="modal" data-bs-target="#exampleModal" data-toggle='tooltip' data-placement='top' title='Adicione um novo campo' onclick="getMembrosAdicionar()"><i class=" ti ti-plus me-2"></i>Adicionar Membro</button>
          </div>
            <span class="card-subtitle">Consulte e administre informação sobre os membros das suas equipas nesta tabela.</span>
            <div class="card-text">
              <div class="row">
                <div class="container mt-5">
                  <table class="table" id="tabelaMembros">
                      <thead>
                        <tr class="text-center">
                          <th scope="col">ID (NIF)</th>
                          <th scope="col">Foto</th>
                          <th scope="col">Nome</th>
                          <th scope="col">Data de Nascimento</th>
                          <th scope="col">Email</th>
                          <th scope="col">Nº Jogos Realizados</th>
                          <th scope="col">Equipa</th>
                          <th scope="col">Remover</th>
                        </tr>
                      </thead>
                      <tbody id="tableMembros">
                      </tbody>
                    </table>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>
    </div>
    <div class="col-lg-2"></div>
  </div>








  <div class="row">
    <div class="col-lg-2"></div>
    <div class="col-lg-9">
      <div style="margin-left: 60px; margin-right: 60px;">
        <footer class="d-flex flex-wrap justify-content-between align-items-center py-3 my-4 border-top">
          <p class="col-md-4 mb-0 text-muted">Copyright © 2023 Courtify</p>

          <a href="#" class="col-md-4 d-flex align-items-center justify-content-center mb-3 mb-md-0 me-md-auto link-dark text-decoration-none">
            <img src="../../../landingpage/dist/images/logos/logo_icone.png" width="50">
          </a>
          <div>
            <p class="mb-0 text-muted">Todos os direitos reservados.</p>
          </div>

        </footer>
      </div>
    </div>
    <div class="col-lg-1"></div>
  </div>






  <div class="modal fade" id="modalRemoverMembro" tabindex="-1" aria-labelledby="modalRemoverMembroLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class='modal-header'>
          <div class='d-flex'>
            <img src='../../dist/images/logos/favicon.ico' alt='' height='40' width='40' class='mt-2 ms-2'>
            <h1 class='mb-0 mt-2 ms-2 fs-6 p-1' id='modalAlterarPrecoLabel'>Remover Membro</h1>
          </div>
          <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Fechar'></button>
        </div>
        <div class='modal-body'>
          <div class='row'>
            <div class='col-lg-12'>
              <p id ="corpoModalRemoverMembro"></p>
            </div>
          </div>
        </div>
        <div class='modal-footer'>
          <button type='button' class='btn btn-primary' data-bs-dismiss='modal' id="botaoGuardar">Salvar</button>
          <button type='button' class='btn btn-light' data-bs-dismiss='modal'>Fechar</button>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="exampleModal" tabindex="-1" aria-hidden="true">
      <div class="modal-dialog modal-dialog-scrollable modal-lg">
        <div class="modal-content rounded-1">
          <div class='d-flex'>
          <img src="../../dist/images/logos/favicon.ico" alt="" height="40" width="40" class="mt-2 ms-2">
          <h4 class="mb-0 mt-2 ms-2 fs-7 p-1">Novo Membro</h4>
          </div>
          <div class='pt-3 pb-2 ps-3 pe-3'>
            <span>
              Através desta pesquisa, consegue facilmente encontrar Membros para adicionar ás suas Equipas. 
            </span>
          </div> 
          <div class="modal-header border-bottom">
            <button type="button" class="btn-close position-absolute top-0 end-0 mt-2 me-2" data-bs-dismiss="modal" aria-label="Close"></button>
            <input type="text" class="form-control fs-3" placeholder="Introduza um termo de pesquisa..." id="search" name="pesquisa" />
          </div>
          <div class="modal-body message-body" data-simplebar="">
            <h5 class="mb-0 fs-4 p-1">Resultados</h5>
            <ul class="list mb-0 py-2" id="pesquisaAtletasNavbar">

            </ul>
          </div>
        </div>
      </div>
    </div>

    <div class="modal fade" id="modalAdicionarMembroEquipa" tabindex="-1" aria-labelledby="modalAdicionarMembroEquipaLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <div class='d-flex'>
          <img src="../../dist/images/logos/favicon.ico" alt="" height="40" width="40" class="mt-2 ms-2">
          <h4 class="mb-0 mt-2 ms-2 fs-6 p-1">Adicionar Membro</h4>
        </div>
        <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Fechar'></button>
      </div>
      <div class="modal-body" id="corpoAdicionarMembroModal">

    </div>
  </div>
</div>


    <!--  Import Js Files -->
    <script src="../../dist/libs/simplebar/dist/simplebar.min.js"></script>
    <script src="../../dist/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <!--  core files -->
    <script src="../../dist/js/app.min.js"></script>
    <script src="../../dist/js/app.init.js"></script>
    <script src="../../dist/js/app-style-switcher.js"></script>
    <script src="../../dist/js/sidebarmenu.js"></script>
    <script src="../../dist/js/custom.js"></script>
    <!--  current page js files -->
    <script src="../../dist/js/js_courtify/clube/clubeLogout.js"></script>
    <script src="../../dist/libs/sweetalert2/dist/sweetalert2.all.min.js"></script>
    <script src="../../dist/js/js_courtify/clube/membros.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>


  </body>


  </html>
<?php
} else {
  header("Location: ../horizontal/authentication-error.html");
  exit();
}


?>