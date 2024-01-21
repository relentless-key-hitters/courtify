<?php 
session_start();

if (isset($_SESSION['id'])) {?>
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
  <link rel="stylesheet" href="//cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
  <link rel="stylesheet" href="../../dist/libs/sweetalert2/dist/sweetalert2.min.css">

  <!-- Core Css -->
  <link id="themeColors" rel="stylesheet" href="../../dist/css/style.min.css" />

  <style>
    body {
      overflow-x: hidden;
    }
  </style>

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
  <div class="page-wrapper" id="main-wrapper" data-theme="blue_theme" data-layout="vertical" data-sidebartype="full"
    data-sidebar-position="fixed" data-header-position="fixed">
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
            <li class="sidebar-item selected">
              <a class="sidebar-link fs-4 link-active" href="#" aria-expanded="false">
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
            <li class="sidebar-item">
              <a class="sidebar-link fs-4" href="./membros_dash.php" aria-expanded="false">
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
    <div class="row">
      <div class="col-lg-3">

      </div>
      <div class="col-lg-7" style="position: relative;">
        <div>
          <h1 class="text-dark fw-bolder pt-4" style="letter-spacing: 1px; font-size: 30px">
            Bem-Vindo,</h1>
        </div>
      </div>
      <div class="col-lg-2">

      </div>
    </div>

    <div class="row">
      <div class="col-lg-3">

      </div>
      <div class="col-lg-7" style="position: relative;">
        <div>
          <h1 class="text-dark fw-bolder" style="letter-spacing: 1px; font-size: 65px" id="nomeClube">
            </h1>
        </div>
      </div>
      <div class="col-lg-2">

      </div>
    </div>
  </div>
  <div class="dark-transparent sidebartoggler"></div>
  <div class="dark-transparent sidebartoggler"></div>



  <div class="row">
    <div class="col-lg-3">

    </div>

    <div class="col-lg-7">
      <div class="container-fluid pt-5">
        <div class="row">
          <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-8">
            <div class="card w-100 bg-light overflow-hidden shadow">
              <div class="card-body position-relative">
                <p class="mb-2 fs-4 fw-semibold"><i class="fs-5 ti ti-currency-euro"></i> Ganhos</p>
                <div class="row pe-5">
                  <div class="col-sm-6">
                    <div class="d-flex align-items-center">
                      <span class="fw-semibold fs-3">
                        Mês Atual (<?php
                          setlocale(LC_TIME, 'pt_PT', 'pt_PT.utf-8', 'Portuguese_Portugal.1252');
                          $month = strftime("%B");
                          echo mb_convert_case($month, MB_CASE_TITLE, "UTF-8");
                          ?>)
                      </span>
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="d-flex align-items-center">
                      <span class="fw-semibold fs-3">
                      Mês Anterior (<?php
                      setlocale(LC_TIME, 'pt_PT', 'pt_PT.utf-8', 'Portuguese_Portugal.1252');

                      $primDiaUltimoMes = strtotime("first day of last month");
                      $ultimoMesNome = strftime("%B", $primDiaUltimoMes);

                      // Capitalize the first letter
                      echo mb_convert_case($ultimoMesNome, MB_CASE_TITLE, "UTF-8");
                      ?>)
                      </span>
                    </div>
                  </div>
                </div>

                <div class="row pe-5">
                  <div class="col-sm-6">
                    <div class="d-flex align-items-center">
                      <div class="pe-4 border-muted border-opacity-10">
                        <h3 class="mb-1 fw-semibold fs-8 d-flex align-content-center" id="ganhosMesAtual"><i
                            class="ti ti-arrow-up-right fs-5 lh-base text-success"></i></h3>
                        
                      </div>
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="d-flex align-items-center">
                      <div class=" pe-4 border-muted border-opacity-10">
                        <h3 class="mb-1 fw-semibold fs-8 d-flex align-content-center" id= "ganhosMesAnterior"></h3>
                        
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-xxl-2">
            <div class="card w-100 shadow">
              <div class="card-body p-4">
                <p class="mb-1 fs-4 fw-semibold"><i class="me-1 fs-5 ti ti-file-invoice"></i> Reservas</p>
                <h4 class="fw-semibold" id="nReservas"><i class="ti ti-arrow-up-right fs-5 lh-base text-success"></i></h4>
                <div id="sales" class="sales-chart"></div>
                <div class="container pt-3">
                  <a href="./reserva_dash.php"><button type="button"
                      class="btn btn-sm btn-light">Consultar</button></a>
                </div>
              </div>
            </div>
          </div>

          <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-xxl-2">
            <div class="card w-100 shadow">
              <div class="card-body p-4">
                <p class="mb-1 fs-4 fw-semibold"><i class="me-1 fs-5 ti ti-tournament"></i> Torneios </p>
                <h4 class="fw-semibold" id="nTorneios"><i class="ti ti-arrow-up-right fs-5 lh-base text-success"></i></h4>
                <div id="expense"></div>
                <div class="container pt-3">
                  <a href="./torneios_dash.html"><button type="button"
                      class="btn btn-sm btn-light">Consultar</button></a>
                </div>
              </div>
            </div>
          </div>

          <div class="col-sm-6 col-md-6 col-lg-6 col-xl-4 d-flex align-items-stretch">
            <div class="card w-100 shadow">
              <div class="card-body">
              <div id="grafico1"></div>
              <div class="d-flex align-items-end justify-content-between mt-7">
                <div>
                  <h4 class="mb-0 fw-semibold"><i class="ti ti-clipboard"></i> Marcações</h4>
                  <div class="mt-2">
                    <span class="fs-4 fw-bold">Últimos 5 meses</span>
                  </div>
                </div>
              </div>
              </div>
            </div>
          </div>

          <div class="col-sm-6 col-md-6 col-lg-6 col-xl-4 d-flex align-items-stretch">
            <div class="card w-100 shadow">
              <div class="card-body">
              <div id="grafico2"></div>
              <div class="d-flex align-items-end justify-content-between mt-7">
                <div>
                  <h4 class="mb-0 fw-semibold"><i class="ti ti-currency-euro"></i> Ganhos</h4>
                  <div class="mt-2">
                    <span class="fs-4 fw-bold">Últimos 5 meses</span>
                  </div>
                </div>
              </div>
              </div>
            </div>
          </div>

          <div class="col-sm-6 col-md-6 col-lg-6 col-xl-4 d-flex align-items-stretch">
            <div class="row">

              <div class="col-sm-12 col-md-4 col-md-12">
                <div class="card shadow">
                  <div class="card-body">
                    <div class="row alig n-items-start">
                      <div class="col-12">
                        <div class="d-flex justify-content-between">
                          <div class="div">
                            <span class="fs-4 fw-semibold"><i class="me-1 fs-5 ti ti-soccer-field"></i> Top Campo</span>
                          </div>
                          <div class="div">
                            <?php echo date("Y"); ?>
                          </div>
                        </div>
                        <div class="d-flex align-items-center">
                          <div class="border-end pe-4 border-muted border-opacity-10">
                            <h4 class="mb-1 fw-semibold fs-7 d-flex align-content-center" id = "nomeCampo"><i
                                class="ti ti-arrow-up-right fs-5 lh-base text-danger"></i></h4>
                          </div>
                          <div class="ps-4">
                            <h4 class="mb-1 fw-semibold fs-7 d-flex align-content-center" id = "horasCampo"></h4>
                          </div>
                        </div>
                        <div class="d-flex align-items-center">
                          <div class="pe-4">
                            <p class="mb-0 text-dark">Nome</p>
                          </div>
                          <div class="ps-5">
                            <p class="mb-0 text-dark">Nº horas</p>
                          </div>
                        </div>
                      </div>
                      <div class="col-4">
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <div class="col-sm-6 col-md-4 col-md-12">
                <div class="card shadow">
                  <div class="card-body">
                    <div class="row align-items-start">
                      <div class="col-12">
                        <span class="fs-4 fw-semibold"><i class="me-1 fs-5 ti ti-credit-card-off"></i> Pagamentos Pendentes
                        </span>
                        <div class="d-flex justify-content-between align-items-center mb-2">
                          <h4 class="fw-semibold mb-0 me-8 mt-2" id="nPend"></h4>
                          <a href="./pagamentos_dash.html"><button type="button"
                              class="btn btn-light mt-2">Consultar</button></a>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-sm-6 col-md-4 col-md-12">
                <div class="card shadow">
                  <div class="card-body">
                    <div class="row alig n-items-start">
                      <div class="col-12">
                        <span class="fs-4 fw-semibold"><i class="me-1 fs-5 ti ti-credit-card"></i> Pagamentos Efetuados 
                        </span>
                        <div class="d-flex justify-content-between align-items-center mb-2">
                          <h4 class="fw-semibold mb-0 mt-2 me-8" id="nFeitos"></h4>
                          <a href="./pagamentos_dash.html"><button type="button"
                              class=" btn btn-light mt-2">Consultar</button></a>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="col-sm-6 col-md-6 col-lg-6 col-xl-4 d-flex align-items-stretch">
            <div class="card w-100 shadow" style="max-height: 300px">
              <div class="card-body">
                <span class="fs-4 fw-semibold"><i class="me-1 fs-5 ti ti-device-desktop-analytics"></i> Painel de Informação</span>
                <div class="row">
                  <div class="col-12 mt-1 mb-3">
                    <span class="fs-3 fw-bold"><i class="ti ti-clock"></i> Horários mais procurados:</span>
                  </div>
                  <div class="col-12 mb-4">
                    <div class="d-flex flex-column align-items-start gap-2">
                      <div class="d-flex gap-2">
                        <span class="fw-bolder">1º:</span>
                        <h5 class="fw-semibold mb-0 me-8" id="horario1"></h5>
                      </div>
                      <div class="d-flex gap-2">
                        <span class="fw-bolder">2º:</span>
                        <h5 class="fw-semibold mb-0 me-8" id="horario2"></h5>
                      </div>
                      <div class="d-flex gap-2">
                        <span class="fw-bolder">3º:</span>
                        <h5 class="fw-semibold mb-0 me-8" id="horario3"></h5>
                      </div>
                    </div>
                  </div>
                  <div class="col-12 mt-1 mb-2">
                    <span class="fs-3 fw-bold"><i class="ti ti-file-invoice"></i> Nº Reservas Hoje:</span>
                  </div>
                  <div class="col-12 mt-2 mb-2">
                    <h4 class="fw-semibold mb-0 me-8" id="nMarcacoesHoje"></h4>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="col-sm-6 col-md-6 col-lg-12 col-xl-8 d-flex align-items-stretch">
            <div class="card w-100 shadow overflow-y-auto" style="max-height: 300px">
              <div class="card-body">
                <div class="d-sm-flex d-block align-items-center justify-content-between mb-3">
                  <div class="mb-3 mb-sm-0">
                    <span class="fs-4 fw-semibold"><i class="me-1 fs-5 ti ti-award"></i> Classificação </span>
                    <p class="card-subtitle mt-1">Melhores Atletas nas suas Equipas</p>
                  </div>
                </div>
                <div class="">
                  <table class="table align-middle text-nowrap mb-0" id="tabelaMelhoresAtletas">
                    <thead>
                      <tr class="text-muted fw-semibold text-center">
                        <th scope="col" class="ps-0">Atleta</th>
                        <th scope="col">Data Nascimento</th>
                        <th scope="col">Nº Vitórias</th>
                        <th scope="col">Nº Jogos Realizados</th>
                      </tr>
                    </thead>
                    <tbody class="border-top" id= "bodyMelhoresAtletas">
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>

        
      </div>
    </div>
    <div class="col-lg-2">
      
    </div>
  </div>


  <div class="row">
    <div class="col-lg-2"></div>
    <div class="col-lg-9">
      <div style="margin-left: 60px; margin-right: 60px;">
        <footer class="d-flex flex-wrap justify-content-between align-items-center py-3 my-4 border-top">
          <p class="col-md-4 mb-0 text-muted">Copyright © 2023 Courtify</p>

          <a href="#"
            class="col-md-4 d-flex align-items-center justify-content-center mb-3 mb-md-0 me-md-auto link-dark text-decoration-none">
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






  <!--  Import Js Files -->
  <script src="../../dist/libs/jquery/dist/jquery.min.js"></script>
  <script src="../../dist/libs/simplebar/dist/simplebar.min.js"></script>
  <script src="../../dist/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <!--  core files -->
  <script src="../../dist/js/app.min.js"></script>
  <script src="../../dist/js/app.init.js"></script>
  <script src="../../dist/js/app-style-switcher.js"></script>
  <script src="../../dist/js/sidebarmenu.js"></script>
  <script src="../../dist/js/custom.js"></script>
  <!--  current page js files -->
  <script src="../../dist/libs/owl.carousel/dist/owl.carousel.min.js"></script>
  <script src="../../dist/libs/apexcharts/dist/apexcharts.min.js"></script>
  <script src="../../dist/js/dashboard.js"></script>
  <script src="../../dist/js/js_courtify/dashboardClube.js"></script>


  <script src="../../dist/js/widgets-charts.js"></script>
  <script src="../../dist/libs/datatables.net/js/jquery.dataTables.min.js"></script>
  <script src="../../dist/js/js_courtify/clube/clubeLogout.js"></script>
  <script src="../../dist/libs/sweetalert2/dist/sweetalert2.all.min.js"></script>

</body>

</html>
<?php
} else {
  header("Location: ../horizontal/authentication-error.html");
  exit();
}


?>